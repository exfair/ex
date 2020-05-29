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
