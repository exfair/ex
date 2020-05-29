<?php
/**
 * News Box functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News_Box
 */

if ( ! function_exists( 'news_box_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function news_box_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on News Box, use a find and replace
		 * to change 'news-box' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'news-box', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		* Editor style add for this theme
		*/
		add_editor_style('/assets/css/bootstrap.css' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'news-box-post-thumb', 400, 364, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'news-box' ),
			'footer-menu' => esc_html__( 'Footer menu', 'news-box' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'news_box_custom_background_args', array(
			'default-color' => 'E9EBEE',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 90,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => false,
		) );
	}
endif;
add_action( 'after_setup_theme', 'news_box_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_box_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'news_box_content_width', 1170 );
}
add_action( 'after_setup_theme', 'news_box_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_box_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'news-box' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'news-box' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget', 'news-box' ),
		'id'            => 'footer-widget',
		'description'   => esc_html__( 'Add footer widgets here.', 'news-box' ),
		'before_widget' => '<div class="col-md-3"><section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section></div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header banner', 'news-box' ),
		'id'            => 'header-banner',
		'description'   => esc_html__( 'Add your image banner or google adsens code here. Image size should be width 760px and height 90px. Use text widget for the add banner ', 'news-box' ),
		'before_widget' => '<div id="%1$s" class="header-banner %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title d-none">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'news_box_widgets_init' );
/**
 * Register custom fonts.
 */
function news_box_fonts_url() {
	$fonts_url = '';

		$font_families = array();

		$font_families[] = 'PT Serif:400,400i,700,700i';
		$font_families[] = 'Crete Round:400,400i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );


	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function news_box_scripts() {
	wp_enqueue_style( 'news-box-google-font', news_box_fonts_url(), array(), null );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(),'4.7.0','all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(),'4.1.0','all' );
	wp_enqueue_style( 'news-box-default', get_template_directory_uri() . '/assets/css/default.css', array(),'1.1.3','all' );

	wp_enqueue_style( 'news-box-style', get_stylesheet_uri(), array(),'1.1.3','all' );


	wp_enqueue_script( 'news-box-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js');
	wp_enqueue_script( 'jquery.ticker', get_template_directory_uri() . '/assets/js/ticker.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'vticker', get_template_directory_uri() . '/assets/js/jquery.vticker.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'news-box-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '4.1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'news_box_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Bootstrap navwalker
 */
require get_template_directory() . '/inc/bootstrap-navwalker.php';

/**
 * tgm plugin active
 */
require get_template_directory() . '/inc/recomended-plugin.php';
/**
 * Customizer pro info .
 */
require get_template_directory() . '/inc/info/class-customize.php';

/**
 * Inline css file
 */
require get_template_directory() . '/inc/inline-css.php';

/**
 * Load theme about section.
 */
if ( is_admin() ) {
    require get_template_directory(). '/inc/about/class.about.php';
    require get_template_directory(). '/inc/about/about.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

