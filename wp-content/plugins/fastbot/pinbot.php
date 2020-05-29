<?php

/**
 * Plugin Name: FastBot
 * Plugin URI: https://naa7.com
 * Description: Shadowsuz hizli pin
 * Version: 2.2
 * Author: M.Furkan
 * Author URI: https://naa7.com
 */
defined('ABSPATH') or die('No script kiddies please!');
function register_session_new()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'register_session_new');

require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/hook.php");
require_once(__DIR__ . "/cronjob.php");

register_activation_hook(__FILE__, 'fastbot_activation_hook');
function fastbot_activation_hook()
{
    if (!wp_next_scheduled('fastbot_send_pin_e5m')) {
        wp_schedule_event(time(), '5dakika', 'fastbot_send_pin_e5m');
    }
}

register_deactivation_hook(__FILE__, 'fastbot_deactivation_hook');
function fastbot_deactivation_hook()
{
    $ts = wp_next_scheduled('fastbot_send_pin_e5m');
    wp_unschedule_event($ts, 'fastbot_send_pin_e5m');
}

add_action("created_term", "create_board_on_pinterest", 10, 3);
function create_board_on_pinterest($term_id, $tt_id, $taxonomy)
{
    if ($taxonomy == "category") {
        $client = new Pinterest\Http\BuzzClient();
        $tokens = get_option("tokens_of_users");
        $matchs = get_option("matchs");
        $term = get_term($term_id, $taxonomy);
        $boards = [];

        foreach ($tokens as $u) {
            $auth = Pinterest\Authentication::onlyAccessToken($client, $u->token);
            $api = new Pinterest\Api($auth);
            $response = $api->createBoard($term->slug, $term->description);
            if (!$response->ok()) {
                echo $response->getError();
                exit;
            }
            $board = $response->result();
            $boards[] = rtrim(str_replace("https://www.pinterest.com/", "", $board->url), "/");
        }

        if (isset($matchs[$term_id])) {
            $matchs[$term_id] = array_merge($matchs[$term_id], $boards);
        } else {
            $matchs[$term_id] = $boards;
        }
        update_option("matchs", $matchs, false);
    }
}

function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
$dir = plugin_dir_path( __FILE__ );

require_once( $dir."/panel.php" ); 
