<?php
add_action('admin_menu', 'fastbot_admin_page_register');
function fastbot_admin_page_register()
{
    add_options_page('fastbot', 'Fastbot Ayarlar', 'manage_options', 'fastbot_ayarlar', 'fastbot_admin_page_content');
    add_action('load-settings_page_fastbot_ayarlar', 'fastbot_admin_page_content_action');
}

function fastbot_admin_page_content()
{
    if (isset($_SESSION["fastbot_error"])) {
        echo "<div class='error notice'><p>" . $_SESSION["fastbot_error"] . "</p></div>";
        unset($_SESSION["fastbot_error"]);
    }
    $tokens = get_option("tokens_of_users") ?: [];
    $cron_sleep = (int) get_option("cron_sleep")  ?: 1;
    $posts_per_page = (int) get_option("cron_posts_per_page")  ?: 25;
    $static_link = (string) get_option("cron_static_link")  ?: null;
    $blogspot_link = (string) get_option("cron_blogspot_link")  ?: null;
    $normal_link = (string) get_option("cron_normal_link")  ?: null;
    if (isset($_GET["board_getir"])) :
        $boards = [];
        $matched = get_option("matchs") ?: [];
        $client = new Pinterest\Http\BuzzClient();
        foreach ($tokens as $token) {
            $auth = Pinterest\Authentication::onlyAccessToken($client, $token["token"]);
            $api = new Pinterest\Api($auth);
            $response = $api->getUserBoards();
            if (!$response->ok()) {
                $_SESSION["fastbot_error"] = "Boardlar çekilirken hata oluştu, limit dolmuş olabilir. Pinterest: " . $response->getError();
            } else {
                foreach ($response->body->data as $data) {
                    $boards[] = rtrim(str_replace("https://www.pinterest.com/", "", $data->url), "/");
                }
            }
        }
    endif;
    include(__DIR__ . "/template/admin.php");
}


function fastbot_admin_page_content_action()
{
    if (isset($_GET["delete"])) {
        $tokens = get_option("tokens_of_users");
        $matchs = get_option("matchs");
        $username = $tokens[$_GET["delete"]]["username"];
        $matchs = array_map(function ($m) use ($username) {
            $sil = array_filter($m, function ($b) use ($username) {
                return startsWith($b, $username);
            });

            if ($sil) {
                $key = array_keys($sil);
                unset($m[$key[0]]);
            }
            return $m;
        }, $matchs);
        unset($tokens[$_GET["delete"]]);
        update_option("tokens_of_users", $tokens, false);
        update_option("matchs", $matchs, false);
        exit(wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false)));
    }

    if (isset($_GET["hata_kaydi"]) && isset($_GET["reset"])) {
        unlink(__DIR__ . "/error.bin");
    }
    return;
}

add_action('admin_post_token_of_users', 'prefix_admin_token_of_users');
function prefix_admin_token_of_users()
{
    if (isset($_POST["newtoken"])) {
        $token = $_POST["newtoken"];
        $client = new Pinterest\Http\BuzzClient();
        $auth = Pinterest\Authentication::onlyAccessToken($client, $token);
        $api = new Pinterest\Api($auth);
        $response = $api->getCurrentUser();
        if (isset($response->body->status) && "failure" == $response->body->status) {
            $_SESSION["fastbot_error"] = "Pinterest API çekerken hata oluştu, tokeni kontrol edin.";
            wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
            exit;
        }
        $new_obj = ["token" => $token, "username" => $response->body->data->username];
        $tokens = get_option("tokens_of_users") ?: [];
        array_push($tokens, $new_obj);
        update_option("tokens_of_users", $tokens, false);
        create_past_cats_to_boards($api);
    }
    wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
    exit;
}

add_action('admin_post_board_match', 'prefix_admin_board_match');
function prefix_admin_board_match()
{
    if (isset($_POST["matchs"])) {
        update_option("matchs", $_POST["matchs"], false);
    }
    wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
    exit;
}

add_action('admin_post_fastbot_za', 'prefix_admin_fastbot_za');
function prefix_admin_fastbot_za()
{
    if (isset($_POST["sleep"])) {
        update_option("cron_sleep", (int) $_POST["sleep"], false);
    }
    if (isset($_POST["posts_per_page"])) {
        update_option("cron_posts_per_page", (int) $_POST["posts_per_page"], false);
    }
    update_option("cron_static_link", (string) $_POST["static_link"], false);
    update_option("cron_blogspot_link", (string) $_POST["blogspot_link"], false);
    update_option("cron_normal_link", (string) $_POST["normal_link"], false);
    wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
    exit;
}

function create_past_cats_to_boards($api)
{
    $user_boards = [];
    $matchs = get_option("matchs") ?: [];
    $cats = get_categories(["hide_empty" => false, "taxonomy" => "category"]);

    $response = $api->getUserBoards();
    if (!$response->ok()) {
        $_SESSION["fastbot_error"] = "Hesaba board açılırken problem oluştu. Pinterest: " . $response->getError();
        wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
        exit;
    }
    $pagedList = $response->result();
    $user_boards = array_merge($user_boards, $pagedList->items());

    while ($pagedList->hasNext()) {
        $response = $api->getNextItems($pagedList);
        if (!$response->ok()) {
            $_SESSION["fastbot_error"] = "Hesabın mevcut boardlarını çekerken sorun oluştu. Pinterest: " . $response->getError();
            wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
            exit;
        }
        $nextPagedList = $response->result();
        $user_boards = array_merge($user_boards, $nextPagedList->items());
    }

    // $cat->slug // $cat->term_id;
    foreach ($cats as $cat) {
        $has = array_filter($user_boards, function ($board) use ($cat) {
            return sanitize_title($board->name) == $cat->slug;
        });

        $boards = [];
        if ($has) {
            foreach ($has as $board) {
                array_push($boards, rtrim(str_replace("https://www.pinterest.com/", "", $board->url), "/"));
            }
        } else {
            $response = $api->createBoard($cat->slug, $cat->description);
            if (!$response->ok()) {
                $_SESSION["fastbot_error"] = "Board oluştururken hata oldu. -- {$cat->slug} -- Pinterest: " . $response->getError();
                wp_redirect(admin_url("options-general.php?page=fastbot_ayarlar", false));
                exit;
            }
            $board = $response->result();
            array_push($boards, rtrim(str_replace("https://www.pinterest.com/", "", $board->url), "/"));
        }

        if (isset($matchs[$cat->term_id])) {
            $matchs[$cat->term_id] = array_merge($matchs[$cat->term_id], $boards);
        } else {
            $matchs[$cat->term_id] = $boards;
        }
    }

    update_option("matchs", $matchs, false);
}
