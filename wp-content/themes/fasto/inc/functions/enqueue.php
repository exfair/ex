<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
=================================================================================================================
fasto_load_styles() - enqueue CSS files
=================================================================================================================
*/
function fasto_load_styles(){
	
	wp_enqueue_style( 'fasto-style' , FASTO_URI.'/style.css', array(), '1.0', 'all' );
	fasto_enqueue_fonts();
	
}
add_action( 'wp_enqueue_scripts' , 'fasto_load_styles', 1 );

/*
=================================================================================================================
fasto_add_fonts_css() - Add theme default fonts
=================================================================================================================
*/
function fasto_add_fonts_css(){
	
	$body_font 		= ucwords( fasto_mod( 'fasto_body_font' ) );
	$body_font 		= str_replace( '-',' ', $body_font );
	
	$heading_font 	= ucwords( fasto_mod( 'fasto_heading_font' ) );
	$heading_font 	= str_replace( '-',' ', $heading_font );
	
	
	$css = '
			body,.primary-font{font-family:'.esc_attr( $body_font ).', Arial} 
			h1,h2,h3,h4,h5,h6,.secondary-font,.woocommerce-Price-amount,.woocommerce form .form-row label{font-family:'. esc_attr( $heading_font ) .', Arial}
		';
	wp_add_inline_style( 'fasto-custom-css', $css );
}
add_action( 'wp_enqueue_scripts','fasto_add_fonts_css' );

/*
=================================================================================================================
fasto_enqueue_fonts() - Enqueue Google Fonts
=================================================================================================================
*/
function fasto_enqueue_fonts(){

	$body_font 		= ucwords( fasto_mod( 'fasto_body_font' ) );
	$body_font 		= str_replace( '-',' ', $body_font );
	$body_font_w 	= fasto_mod( 'fasto_body_font_w' );	

	$heading_font 	= ucwords( fasto_mod( 'fasto_heading_font' ) );
	$heading_font 	= str_replace( '-',' ', $heading_font );
	$heading_font_w = fasto_mod( 'fasto_heading_font_w' );

	$google_fonts = esc_attr( $heading_font .':'. $heading_font_w .'|'. $body_font .':'. $body_font_w );
	
	wp_enqueue_style( 'fasto-custom-css', 'https://fonts.googleapis.com/css?family='.$google_fonts.'&display=swap' );
}

/*
=================================================================================================================
fasto_load_scripts() - enqueue js files
=================================================================================================================
*/
function fasto_load_scripts(){
	
	wp_enqueue_script( 'fasto-scripts', FASTO_URI."/js/scripts.js",  array( 'jquery' ), '', true );

	if ( fasto_mod( 'fasto_lazy_load' )  == '1' ){
		$data = array(
			'url' => FASTO_URI,
		);
		wp_enqueue_script( 'lazy', FASTO_URI."/js/lazy.js", array( 'jquery' ), '', true ); //no need to prefix as it's 3rd party script
		wp_localize_script( 'lazy', 'fasto_object_name', $data );
	}	 

	 
}
add_action( 'wp_enqueue_scripts' , 'fasto_load_scripts' , 1 );

/*
=================================================================================================================
fasto_gutenberg_gallery_enqueue() - enqueue CSS and JS gallery only if needed
=================================================================================================================
*/
function fasto_gutenberg_gallery_enqueue(){
		
	if ( is_singular('post') ){
			
		$post = get_post();
		
		//backward compatibility - this function was introduced in WordPress 5.0.0
		if ( function_exists( 'has_blocks' ) ){
			if ( has_blocks( $post->post_content ) ) {
				$blocks = parse_blocks( $post->post_content );
				foreach ( $blocks as  $block ){
					if( $block['blockName'] === 'core/gallery' ){
						wp_enqueue_style( 'simple-lightbox' , FASTO_URI.'/css/simple-lightbox.min.css', array(), '1.0', 'all' ); //no need to prefix as it's 3rd party style
						wp_enqueue_script( 'simple-lightbox', FASTO_URI."/js/simple-lightbox.min.js", array( 'jquery' ), '', true ); //no need to prefix as it's 3rd party script
					}
				}
			}
		}
		else{
			wp_enqueue_style( 'simple-lightbox' , FASTO_URI.'/css/simple-lightbox.min.css', array(), '1.0', 'all' ); //no need to prefix as it's 3rd party style
			wp_enqueue_script( 'simple-lightbox', FASTO_URI."/js/simple-lightbox.min.js", array( 'jquery' ), '', true );	//no need to prefix as it's 3rd party script
		}
	
	}
}

add_action( 'get_footer','fasto_gutenberg_gallery_enqueue',1 );
	

/*
=================================================================================================================
fasto_widget_gallery_enqueue() - enqueue CSS and JS if widget has gallery
=================================================================================================================
*/
function fasto_widget_gallery_enqueue(){
	$widgets = wp_get_sidebars_widgets();
	unset( $widgets['wp_inactive_widgets'] );
	foreach ( $widgets as $widget ){
		foreach ( $widget as $w ){
			if ( stripos ( $w, 'media_gallery'  ) !== false ){
				wp_enqueue_style( 'simple-lightbox' , FASTO_URI.'/css/simple-lightbox.min.css', array(), '1.0', 'all' ); //no need to prefix as it's 3rd party style
				wp_enqueue_script( 'simple-lightbox', FASTO_URI."/js/simple-lightbox.min.js", array( 'jquery' ), '', true ); //no need to prefix as it's 3rd party script					
			}
		}
	}
}
add_action( 'get_footer','fasto_widget_gallery_enqueue',1 );
/*
=================================================================================================================
fasto_load_admin_styles() - enqueue the CSS files in admin
=================================================================================================================
*/
function fasto_load_admin_styles() {
	
	if ( is_customize_preview() ){
		wp_enqueue_style( 'fasto-admin' , FASTO_URI.'/css/admin.css', array(), '1.0', 'all' );
	}
	
	$screen = get_current_screen();

	if ( $screen->id == 'post' || $screen->id == 'page' ) {
		wp_enqueue_style( 'fasto-admin-editor-font', 'https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap' );
	}	
}
add_action( 'admin_enqueue_scripts', 'fasto_load_admin_styles' );