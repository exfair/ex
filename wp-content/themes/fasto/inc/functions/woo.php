<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
=================================================================================================================
fasto_woo_support() - Declare woocommerce support, and also product gallery, zoom and slider support
=================================================================================================================
*/
function fasto_woo_support() {
    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'fasto_woo_support' );

/*
=================================================================================================================
fasto_shop_widgets_init() - add widget areas to woo
=================================================================================================================
*/
function fasto_shop_widgets_init() {

	register_sidebar( array(
		'name'          => 'WooCommerce',
		'id'            => 'woocommerce',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );	

}
add_action( 'widgets_init', 'fasto_shop_widgets_init' );

/*
=================================================================================================================
fasto_woo_enqueue_styles() - Enquque theme custom woocommerce css file
=================================================================================================================
*/
function fasto_woo_enqueue_styles(){
	wp_enqueue_style( 'fasto-woocommerce', FASTO_URI.'/css/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts' , 'fasto_woo_enqueue_styles', 11 );


//product title
function fasto_woo_loop_product_title() {
	echo '<h2 class="post-title"><a href="'.esc_url( get_the_permalink() ).'">'.esc_html( get_the_title() ).'</a></h2>';
}
add_action('woocommerce_shop_loop_item_title', 'fasto_woo_loop_product_title', 10);

//shop breadcrumb 
function fasto_shop_breadcrumb() {
	return array(
            'delimiter'   => '&nbsp;&nbsp;&#187;&nbsp;&nbsp;',
			'wrap_before' => '<ul class="breadcrumb">',
			'wrap_after' => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => 'Home',
        );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'fasto_shop_breadcrumb' );
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1,1 );
add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 1,1 );

//removed actions
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar');
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

//sidebar grids
if ( fasto_mod('fasto_shop_layout') == 'grid-2-sidebar' || fasto_mod('fasto_shop_layout') == 'grid-3-sidebar' ){

	function fasto_before_shop_loop(){
		echo '<div class="fasto-inner-row"><!-- start .articles -->';
		echo '<div class="articles '.esc_attr( fasto_mod('fasto_shop_layout') ).' col-desktop-8 col-tablet-12 col-small-tablet-12 col-mobile-12 padding-left-0  padding-right-30 padding-right-tablet-0 padding-left-tablet-0 padding-right-mobile-0 padding-left-mobile-0"><!-- start .articles -->';
			echo '<div class="breadcrumb-navigation">';
			echo '<h2 class="page-title">'.esc_html( woocommerce_page_title( false ) ).'</h2>';
			woocommerce_breadcrumb();
			echo '</div>';	
		
	}
	add_action( 'woocommerce_before_shop_loop', 'fasto_before_shop_loop', 1,1 );

	function fasto_after_shop_loop(){
		echo '</div>';
		get_template_part( 'templates/woo-sidebar' );
		echo '</div>';
		
	}
	add_action( 'woocommerce_after_shop_loop', 'fasto_after_shop_loop', 1,1 );
}

//full grids
if ( fasto_mod('fasto_shop_layout') == 'grid-4' || fasto_mod('fasto_shop_layout') == 'grid-3' ){

	function fasto_before_shop_loop(){
		echo '<div class="articles '.esc_attr( fasto_mod('fasto_shop_layout') ).'"><!-- start .articles -->';
			echo '<div class="breadcrumb-navigation">';
			echo '<h2 class="page-title">'.esc_html( woocommerce_page_title( false ) ).'</h2>';
			woocommerce_breadcrumb();
			echo '</div>';	
		
	}
	add_action( 'woocommerce_before_shop_loop', 'fasto_before_shop_loop', 1,1 );
}

/*
=================================================================================================================
fasto_shop_sale_text() - Sale text
=================================================================================================================
*/
function fasto_shop_sale_text( $text, $post, $_product ){
    return '<span class="onsale"><div class="sale">'.esc_attr__( 'Sale','fasto' ).'</div></span>';
}
add_filter( 'woocommerce_sale_flash', 'fasto_shop_sale_text', 10, 3 );

/*
=================================================================================================================
fasto_shop_comment_args() - Review form
=================================================================================================================
*/
function fasto_shop_comment_args( $comment_form ){
	
	$commenter    = wp_get_current_commenter();	
	$name_email_required = (bool) get_option( 'require_name_email', 1 );
	$required = $name_email_required ? ' required' : '';

	$comment_form['comment_notes_before'] = '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.','fasto' ) . '</span></p>';
	$comment_form['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
	$comment_form['title_reply_after'] = '</h2>';
	$comment_form['fields']['author'] = '<div class="fasto-row"><div class="col-desktop-6"><input id="author" name="author" placeholder="'.esc_attr__( 'Your name','fasto' ).'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . esc_attr( $required ) . ' /></div>';
	$comment_form['fields']['email'] = '<div class="col-desktop-6"><input id="email" name="email" placeholder="'.esc_attr__( 'Your email','fasto' ).'" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . esc_attr( $required ) . ' /></div></div>';
	$comment_form['fields']['cookies'] = '';
	
	if ( wc_review_ratings_enabled() ) {
		$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'fasto' ) . '</label><select name="rating" id="rating" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'fasto' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'fasto' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'fasto' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'fasto' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'fasto' ) . '</option>
			<option value="1">' . esc_html__( 'Very poor', 'fasto' ) . '</option>
			</select></div>';
	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" placeholder="'.esc_attr__( 'Leave a review','fasto' ).'" name="comment" cols="45" rows="8" required></textarea></p>';	
	
	return $comment_form;
}
add_filter( 'woocommerce_product_review_comment_form_args','fasto_shop_comment_args' );

/*
=================================================================================================================
fasto_loop_columns() - Change number or products per row
=================================================================================================================
*/
add_filter('loop_shop_columns', 'fasto_loop_columns', 999);
function fasto_loop_columns() {
	if ( fasto_mod('fasto_shop_layout') == 'grid-4' ){
		return 4;
	}
	elseif ( fasto_mod('fasto_shop_layout') == 'grid-3' ){
		return 3;
	}		
	elseif ( fasto_mod('fasto_shop_layout') == 'grid-2-sidebar' ){
		return 2;
	}		
	elseif ( fasto_mod('fasto_shop_layout') == 'grid-3-sidebar' ){
		return 3;
	}
}

/*
=================================================================================================================
fasto_append_cart_icon() - Append cart item (and cart count) to end of main menu.
=================================================================================================================
*/
add_filter( 'wp_nav_menu_items', 'fasto_append_cart_icon', 10, 2 );
function fasto_append_cart_icon( $items, $args ) {
	$cart_item_count = WC()->cart->get_cart_contents_count();
	$cart_count_span = '';
	if ( $cart_item_count ) {
		$cart_count_span = '<span class="count">'. esc_html( $cart_item_count ).'</span>';
	}
	$cart_link = '<li class="woo-cart-menu menu-item menu-item-type-post_type menu-item-object-page"><a href="' . esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ) . '">'.fasto_brands_svg( 'cart', false ) . $cart_count_span.'</a></li>'; # fasto_brands_svg() - safely escaped in functions/theme.php
	// Add the cart link to the end of the menu.
	$items = $items . $cart_link;
	return $items;
}

/*
=================================================================================================================
fasto_loop_shop_per_page() - Change number of products that are displayed per page (shop page)
=================================================================================================================
*/
add_filter( 'loop_shop_per_page', 'fasto_loop_shop_per_page', 20 );

function fasto_loop_shop_per_page( $cols ) {
  $cols = fasto_mod( 'fasto_shop_per_page' );
  return $cols;
}