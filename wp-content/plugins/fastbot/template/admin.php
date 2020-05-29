<center>
        <?php
    
        $access_token         = isset( $_GET['access_token'] ) ? sanitize_text_field( $_GET['access_token'] ) : get_option( 'fts_pinterest_custom_api_token' );
    ?>
    <?php
    
        echo sprintf(
                                esc_html( '%1$sLogin and get my Access Token%2$s', 'feed-them-social' ),
                                '<a href="' . esc_url( 'https://api.pinterest.com/oauth/?response_type=token&redirect_uri=https://www.slickremix.com/pinterest-token-plugin/&client_id=4852080225414031681&scope=read_public,write_public,read_relationships,write_relationships&state=' . admin_url( 'admin.php?page=fts-pinterest-feed-styles-submenu-page' ) ) . '" class="fts-pinterest-get-access-token">',
                                '</a>'
                            );
    ?>
<div class="wrap">
    <img src="https://i.ibb.co/85MTMhm/6-64358-rocket-icon-whatsapp-emoticons-rocket.png" width="60" alt="Fastbot"/>
    <h1>Ayarlar</h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) . "?action=fastbot_za"; ?>">
        <table>
            <tr>
                <td>
                    <input type="hidden" name="action" value="fastbot_za">
                    <label>Kaç saniye aralıklarla pin atsın?</label><br>
                    <input type="number" class="regular-text" name="sleep" value="<?php echo $cron_sleep; ?>" required="required" />
                </td>
                <td>
                    <label>Her bir zamanlı görevde kaç post çekilsin?</label><br>
                    <input type="number" class="regular-text" name="posts_per_page" value="<?php echo $posts_per_page; ?>" required="required" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Sabit Link? Boş bırakılırsa post linkini pinler.</label><br>
                    <input type="text" class="regular-text" name="static_link" value="<?php echo $static_link; ?>" />
                </td>
                <td>
                    <label>Blogspot URL</label><br>
                    <input type="text" class="regular-text" name="blogspot_link" value="<?php echo $blogspot_link; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                    <label>Site URL</label><br>
                    <input type="text" class="regular-text" name="normal_link" value="<?php echo $normal_link; ?>" />
                    <br>
                    <br>
                    <input type="submit" name="submit" id="submit" class="button button-primary" style="background-color:red;" value="Kaydet">
                    </center>
                </td>
            </tr>
        </table>
    </form>
</div>
<hr />
<div class="wrap">
    <h1>Kategori - Board</h1>
    <a href="<?php echo admin_url("options-general.php?page=fastbot_ayarlar&board_getir=1"); ?>">Boardları Getir</a>
    <?php if (isset($_GET["board_getir"])) : ?>
        <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) . "?action=board_match"; ?>">
            <input type="hidden" name="action" value="board_match">
            <?php $cats = get_categories(['hide_empty' => false]); ?>
            <?php foreach ($cats as $cat) : ?>
                <div>
                    <h4>- <?php echo $cat->name; ?></h4>
                    <p>
                        <?php foreach ($boards as $board) : ?>
                            <label>
                                <input type="checkbox" value="<?php echo $board; ?>" name="matchs[<?php echo $cat->term_id; ?>][]" <?php echo (isset($matched[$cat->term_id]) && in_array($board, $matched[$cat->term_id])) ? "checked" : ""; ?>>
                                <?php echo $board; ?>
                            </label><br>
                        <?php endforeach; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            <?php
            wp_nonce_field('fastbot_form_matches', 'form_match');
            ?>
            <br>
            <br>
            <input type="submit" name="submit" id="submit" class="button button-primary" style="background-color:red;" value="Kaydet">
        </form>
    <?php endif; ?>
</div>
<hr />
<div class="wrap">
    <h1>Token Ekle</h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) . "?action=token_of_users"; ?>">
        <input type="hidden" name="action" value="token_of_users">
        <input type="text" name="newtoken" class="regular-text" value="<?php
           echo $access_token;

        
        ?>" required="required" />
        <?php
        wp_nonce_field('fastbot_form_token', 'form_token');
        ?>
        <br>
        <br>
        <input type="submit" name="submit" id="submit" class="button button-primary" style="background-color:red;" value="Kaydet">
    </form>

    <h1>Kayıtlı Tokenler</h1>
    <ul>
        <?php foreach ($tokens as $key => $obj) : ?>
            <li><a href="<?php echo menu_page_url("fastbot_ayarlar", false) . "&delete=" . $key; ?>">×</a> <b><a href="https://pinterest.com/<?php echo $obj["username"]; ?>"><?php echo $obj["username"]; ?></a></b> - <small><?php echo $obj["token"]; ?></small> </li>
        <?php endforeach; ?>
    </ul>
</div>
<hr />
<div class="wrap">
    <h1><a href="<?php echo admin_url("options-general.php?page=fastbot_ayarlar&hata_kaydi=1"); ?>">Hata Kayıtlarını Göster</a></h1>
    <?php if (isset($_GET["hata_kaydi"])) : ?>
        <textarea class="large-text code" style="height:300px;"><?php echo ((file_exists(__DIR__ . "/../error.bin")) ? file_get_contents(__DIR__ . "/../error.bin") : ""); ?></textarea>
        <a href="<?php echo admin_url("options-general.php?page=fastbot_ayarlar&hata_kaydi=1&reset=1"); ?>">Kaydı Sil</a>
    <?php endif; ?>
</div>
</center>

