<center>
<div class="wrap">
    <h1>Ayarlar</h1>
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) . "?action=fastbot_za"; ?>">
        <input type="hidden" name="action" value="fastbot_za">
        <label>Kaç saniye aralıklarla pin atsın?</label><br>
        <input type="number" class="regular-text" name="sleep" value="<?php echo $cron_sleep; ?>" required="required" />
        <br>
        <br>
        <label>Her bir zamanlı görevde kaç post çekilsin?</label><br>
        <input type="number" class="regular-text" name="posts_per_page" value="<?php echo $posts_per_page; ?>" required="required" />
        <br>
        <br>
        <label>Sabit Link? Boş bırakılırsa post linkini pinler.</label><br>
        <input type="text" class="regular-text" name="static_link" value="<?php echo $static_link; ?>" />
        <br>
        <br>
        <label>Blogspot URL</label><br>
        <input type="text" class="regular-text" name="blogspot_link" value="<?php echo $blogspot_link; ?>" />
        <br>
        <br>
        <label>Site URL</label><br>
        <input type="text" class="regular-text" name="normal_link" value="<?php echo $normal_link; ?>" />
		<br>
        <br>
        <input type="submit" name="submit" id="submit" class="button button-primary" style="background-color:red;" value="Kaydet">
    </form>
</div>
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
<div class="wrap">
    <h1>Token Ekle</h1>
    <?php
    
     $access_token         = isset( $_GET['access_token'] ) ? sanitize_text_field( $_GET['access_token'] ) : get_option( 'fts_pinterest_custom_api_token' );
   echo $access_token;
    ?>
    
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) . "?action=token_of_users"; ?>">
        <input type="hidden" name="action" value="token_of_users">
        <input type="text" name="newtoken" class="regular-text" value="" required="required" />
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
<div class="wrap">
    <h1><a href="<?php echo admin_url("options-general.php?page=fastbot_ayarlar&hata_kaydi=1"); ?>">Hata Kayıtlarını Göster</a></h1>
    <?php if (isset($_GET["hata_kaydi"])) : ?>
        <textarea class="large-text code" style="height:300px;"><?php echo ((file_exists(__DIR__ . "/../error.bin")) ? file_get_contents(__DIR__ . "/../error.bin") : ""); ?></textarea>
        <a href="<?php echo admin_url("options-general.php?page=fastbot_ayarlar&hata_kaydi=1&reset=1"); ?>">Kaydı Sil</a>
    <?php endif; ?>
</div>
</center>
<?php
$themename = "Pinterest Method Panel";
$ayarlar = array (
    array(    
        "baslik" => "Genel Ayarlar",
        "tip" => "bolumac"),
        
array(    
        "baslik" => "Hangi Sistem Aktif Olsun?",
        "aciklama" => "",
        "id" => "yontem_tipi",
        "liste" => array("Blogger","Tumblr","AMP","Hiç Biri"),
        "tip" => "acilir"), 
    array(    
        "baslik" => "Blooger & Tumblr İsmi Girin",
        "aciklama" => "",
        "id" => "blog_ismi",
        "tip" => "input"), 
    array(    
        "tip" => "bolumkapa"),
);
    
function ogpanel_ayarlar() {
  global $ayarlar;
  if ('ayar_kayit'== $_REQUEST['action'] ) {
    foreach ($ayarlar as $ayar) {
     if( !isset( $_REQUEST[ $ayar['id'] ] ) ) {  } else { update_option( $ayar['id'], stripslashes($_REQUEST[ $ayar['id']])); } }
     if(stristr($_SERVER['REQUEST_URI'],'&kayit=tamam')) {
     $lokasyon = $_SERVER['REQUEST_URI'];
    } else {
     $lokasyon = $_SERVER['REQUEST_URI'] . "&kayit=tamam";
    }
    
      header("Location: $lokasyon");
      die;
    } else if('ayar_reset' == $_REQUEST['action'] ) {
    foreach ($ayarlar as $ayar) {
     delete_option( $ayar['id'] );
     $lokasyon = $_SERVER['REQUEST_URI'] . "&reset=tamam";
    }
      header("Location: $lokasyon");
      die;
  }
add_menu_page('Pinx Panel', 'Pinx Panel', 10, 'fts-pinterest-feed-styles-submenu-page', 'ogpanel_admin');
}
function ogpanel_admin() {
    global $ayarlar;
?>
<div class="wrap">
  <br clear="all" />
  <?php if ( $_REQUEST['kayit'] ) {  ?>
  <?php } ?>

</div><p>

</p>
<br>
<br>
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$new = str_replace('admin.php?page=fts-pinterest-feed-styles-submenu-page','options-general.php?page=fastbot_ayarlar',$actual_link);
echo $new;
?>
<meta http-equiv="refresh" content="0;URL=<?php echo $new; ?>">
<?php }
if ( ! function_exists( 'og_ayar' ) ) {
    function og_ayar( $id ) {
        $cekgit = get_option( $id);
        return $cekgit;
    }
}

add_action('admin_menu', 'ogpanel_ayarlar');
add_action('admin_head', 'ogpanel_adminhead');
function ogpanel_adminhead() {
?>

    <style type="text/css">
    .ogpanel {}
    .ogpanel .ogpanel-t {celar:both;display:block;}
    .ogpanel .ogpanel-bolum {clear:both;width:100%;display:block;overflow:hidden;padding-bottom:10px;margin-bottom:10px;border-bottom:1px solid #EFEFEF;}
    .ogpanel .ogpanel-baslik {float:left;width:200px;}
    .ogpanel .ogpanel-ic {float:left;width:410px;}
    .ogpanel .ogpanel-aciklama {float:left;width:500px;font-size:11px;color:#878787;}
    .ogpanel .ogpanel-ic input,.ogpanel .ogpanel-ic textarea {width:400px;font-family:arial;}
        .ogpanel .ogpanel-ic input[type=checkbox] {float:left;width:20px;}
    .ogpanel .og-aciklama {width:600px;color:#777;}
		textarea {
  width: 100%;
  height: 100px;
}
    </style>
<?php } ?>
