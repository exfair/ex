<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
=================================================================================================================
CONSTANTS
=================================================================================================================
*/
if ( ! defined ( 'FASTO_DIR' ) ){
	define( 'FASTO_DIR', get_template_directory() );
}

if ( ! defined ( 'FASTO_URI' ) ){
	define( 'FASTO_URI', get_template_directory_uri() );
}


/*
=================================================================================================================
Fasto_Core_Setup - requires, enqueues , theme support etc.
=================================================================================================================
*/
class Fasto_Core_Setup{
	
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'requires' ), 4 );
		add_action( 'after_setup_theme', array( $this, 'theme_support') );
		add_action( 'admin_init', array( $this, 'add_editor_styles') );
	}

	public function requires(){
		//theme requires
		require_once( FASTO_DIR.'/inc/functions/theme.php' ); //theme related functions
		require_once( FASTO_DIR.'/inc/functions/enqueue.php' ); //enqueue css and js
		require_once( FASTO_DIR.'/inc/functions/wordpress.php' ); //wordpress related functions
		require_once( FASTO_DIR.'/inc/functions/svg-brands.php' ); //svg brand icons
		require_once( FASTO_DIR.'/inc/widgets/categories.php' ); //categories widget
		require_once( FASTO_DIR.'/inc/widgets/posts.php' ); //posts widget
		require_once( FASTO_DIR.'/inc/functions/customizer.php' ); //customizer
		require_once( FASTO_DIR.'/inc/functions/optimize.php' ); //optimize
		require_once( FASTO_DIR. '/inc/functions/customizer-pro.php' );//pro link in customizer
		if ( class_exists( 'WooCommerce' ) ){
			require_once( FASTO_DIR.'/inc/functions/woo.php' ); //woo
		}
	}

	public function theme_support(){
		if ( ! isset( $content_width ) ) $content_width = 1200;
		if( function_exists( 'add_theme_support' ) ){
			
			//theme support
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'html5' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'editor-styles' );              
			
			//image sizes
			add_image_size( 'fasto-admin-thumb', 100, 100, false );
			add_image_size( 'fasto-grid', 150, 225, true );
			add_image_size( 'fasto-blog-classic', 200, 300, true );
			add_image_size( 'fasto-full-single', 600, 900, true );
			add_image_size( 'fasto-widget', 80, 120 , true );
			
			//logo support
			$defaults_logo = array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			);
			add_theme_support( 'custom-logo', $defaults_logo );			
			
			//custom background support
			$defaults_bg = array(
				'default-repeat'         => 'no-repeat',
				'default-attachment'     => 'fixed',
			);
			add_theme_support( 'custom-background', $defaults_bg );
			
			//custom header support
			$defaults_header = array(
				'width'         => 1200,
				'height'        => 300,
				'uploads'       => true,
				'wp-head-callback'  => 'fasto_header_text_customizer',
				'default-text-color' => '#001b49'
				
			);
			add_theme_support( 'custom-header', $defaults_header );		
			
			add_theme_support( 'customize-selective-refresh-widgets' );

		}
		
		//Make theme available for translation.
		load_theme_textdomain( 'fasto' );
		
		//Register primary menu
		register_nav_menus( array(
			'primary' => esc_html__('Primary Menu', 'fasto'),
		) );
		
	}
	
	public function add_editor_styles() {
		add_editor_style( 'css/fasto-editor-style.css' );
	}

}

# GO!
new Fasto_Core_Setup;