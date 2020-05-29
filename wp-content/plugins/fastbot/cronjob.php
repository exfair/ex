<?php
add_filter('cron_schedules', 'fastbot_schedule_5dakika');
function fastbot_schedule_5dakika($schedules)
{
    $schedules['5dakika'] = array(
        'interval' => 300,
        'display' => esc_html__('5 Dakika'),
    );

    return $schedules;
}

add_action('fastbot_send_pin_e5m', 'fastbot_send_pin_every5min');
function fastbot_send_pin_every5min()
{
    $pp = (int) get_option("cron_posts_per_page")  ?: 25;

    $wpq = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $pp,
        'meta_query' => array(
            array(
                'key'     => 'fastbot_pinned',
                'compare' => 'NOT EXISTS',
            ),
        ),
    ]);
    $matchs = get_option("matchs");
    $cron_sleep = (int) get_option("cron_sleep")  ?: 1;
    $tokens = get_option("tokens_of_users");
    $static_link = get_option("cron_static_link")  ?: "";
    $client = new Pinterest\Http\BuzzClient();
    $blogspot_link = get_option("cron_blogspot_link");
    $normal_link = get_option("cron_normal_link");
    if ($wpq->have_posts()) :
        while ($wpq->have_posts()) : $wpq->the_post();
            $cats = get_the_category(get_the_ID());
            $target_boards = [];
            foreach ($cats as $cat) {
                $target_boards = array_merge($target_boards, $matchs[$cat->term_id]);
            }

            if (empty($target_boards)) {
                continue;
            }

            foreach ($target_boards as $pin_to_board) {
                $pin_exp = explode("/", $pin_to_board);
                $username = $pin_exp[0];
                $user = (array) current(array_filter($tokens, function ($o) use ($username) {
                    return $o["username"] == $username;
                }));
                if (!$user) {
                    continue;
                }
                $auth = Pinterest\Authentication::onlyAccessToken($client, $user["token"]);
                $api = new Pinterest\Api($auth);

                $featured_img_url = get_post_meta(get_the_ID(), 'fifu_image_url', true);
                $image = Pinterest\Image::url($featured_img_url);

                $note_sub = "";
                $tags = get_the_tags();
                foreach ($tags as $tag) {
                    $note_sub .= "#" . $tag->name . " ";
                }
                $limit = 500 - (strlen($note_sub) + 5);
                $note = mb_strimwidth(strip_shortcodes(strip_tags(wp_strip_all_tags(get_the_content()))), 0, $limit, '...');
                $note .= ' ' . $note_sub;
                if(empty($static_link)){
                    $pin_link = get_the_permalink();
                }else{
                    $pin_link = $static_link;
                }
                
                $blogspot_linked = str_replace($normal_link, $blogspot_link, $pin_link);
                $response = $api->createPin($pin_to_board, $note, $image, $blogspot_linked);
                if (!$response->ok()) {
                    file_put_contents(__DIR__ . "/error.bin", "#" . get_the_ID() . "# - (" . $user["username"] . ") " . $response->getError() . "  (" . $user["token"] . ")\n", FILE_APPEND);
                    // die($response->getError());
                    continue;
                }
                // $pin = $response->result();
            }
            update_post_meta(get_the_ID(), "fastbot_pinned", "1");
            sleep($cron_sleep);
        endwhile;
    endif;
}
