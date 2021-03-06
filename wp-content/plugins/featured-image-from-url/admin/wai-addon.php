<?php

include 'rapid-addon.php';

$fifu_wai_addon = new RapidAddon('<div style="color:#777"><span class="dashicons dashicons-camera" style="font-size:30px;padding-right:10px"></span> Featured Image from URL</div>', 'fifu_wai_addon');
$fifu_wai_addon->add_field('fifu_image_url', '<div title="fifu_image_url">Featured Image URL</div>', 'text', null, null, false, null);
$fifu_wai_addon->add_field('fifu_image_alt', '<div title="fifu_image_alt">Featured Image Alt/Title</div>', 'text', null, null, false, null);
$fifu_wai_addon->set_import_function('fifu_wai_addon_save');
$fifu_wai_addon->run();

function fifu_wai_addon_save($post_id, $data, $import_options, $article) {
    $fields = array();

    if (!empty($data['fifu_image_url']))
        array_push($fields, 'fifu_image_url');

    if (!empty($data['fifu_image_alt']))
        array_push($fields, 'fifu_image_alt');

    if (empty($fields)) {
        if (fifu_is_off('fifu_enable_default_url'))
            return;
    }

    $update = false;
    foreach ($fields as $field) {
        $current_value = get_post_meta($post_id, $field, true);
        if ($current_value != $data[$field]) {
            $update = true;
            update_post_meta($post_id, $field, $data[$field]);
        }
    }

    global $fifu_wai_addon;
    if (!$update && !$fifu_wai_addon->can_update_image($import_options))
        return;

    fifu_wai_save($post_id);

    /* metadata */
    add_action('pmxi_saved_post', 'fifu_update_fake_attach_id');
}

