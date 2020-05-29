<?php

if ( ! function_exists( 'travelers_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function travelers_blog_setup() {
		
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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'travelers-blog' )
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 172,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_image_size( 'travelers_blog_category_slider', 650, 450,true );
		add_image_size( 'travelers_blog_category_slider_no_sidebar', 950, 450,true );
		add_image_size( 'travelers_blog_detail_cat_one', 470, 350, true );
		add_image_size( 'travelers_blog_medium', 440, 420, true );
		add_image_size( 'travelers_blog_page', 730, 450, true );
		add_image_size( 'travelers_blog_detail', 670, 460, true );
		add_image_size( 'travelers_blog_blog_list', 440, 300, true );
		add_image_size( 'travelers_blog_blog_list_no_sidebar_1', 220, 190, true );

	}

endif;

add_action( 'after_setup_theme', 'travelers_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travelers_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'content_width', 640 );
}
add_action( 'after_setup_theme', 'travelers_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travelers_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'travelers-blog' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'travelers-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'travelers_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */


function travelers_blog_scripts() {

	$theme_data = wp_get_theme();
	$theme_version = $theme_data->get( 'Version' );

    wp_enqueue_style( 'travelers_blog_google_fonts', travelers_blog_theme_google_fonts(), array() , $theme_version );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array() , $theme_version );
	wp_enqueue_style( 'font-awesome-4.7', get_template_directory_uri() . '/font-awesome-4.7.0/css/font-awesome.min.css', array(), $theme_version, false );

	wp_enqueue_style( 'travelers_blog-main', get_template_directory_uri() . '/assets/css/main.css', array(), $theme_version );
	wp_enqueue_style( 'travelers_blog-component', get_template_directory_uri() . '/assets/css/component.css', array(), $theme_version );

	wp_enqueue_style( 'travelers_blog-style2', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version, false );
	wp_enqueue_style( 'travelers_blog-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $theme_version );
	wp_enqueue_style( 'travelers_blog-style', get_stylesheet_uri(), array(), $theme_version );


	$scripts = array(
		array(
			'id' => 'bootstrap',
			'url' => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => false
		),
		array(
			'id' => 'slicknav',
			'url' => get_template_directory_uri() . '/assets/js/jquery.slicknav.js',
			'footer' => true
		),
		array(
			'id' => 'swiper',
			'url' => get_template_directory_uri() . '/assets/js/swiper.js',
			'footer' => true
		),
		array(
			'id' => 'prognroll',
			'url' => get_template_directory_uri() . '/assets/js/prognroll.js',
			'footer' => true
		),
		array(
			'id' => 'custom',
			'url' => get_template_directory_uri() . '/assets/js/custom.js',
			'footer' => true
		),
	);

	travelers_blog_add_scripts( $scripts, $theme_version );

    wp_add_inline_style( 'travelers_blog-style', travelers_blog_inline_style() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'travelers_blog_scripts' );

function travelers_blog_theme_google_fonts() {

    $fonts = array(
    	"Merriweather:300,400,700",
    	"PT Serif",
    	"Poppins:400,500,600,700"
    );

    $fonts_collection = add_query_arg(
        array(
            "family"=>urlencode( implode("|",$fonts) ),
        ),
        '//fonts.googleapis.com/css'
    );

    return $fonts_collection;

}

function travelers_blog_inline_style(){

	$inline_css = '';
	$travelers_blog_breadcrumb_styl = travelers_blog_breadcrumb_style();
	$travelers_blog_footer = '';
	$travelers_blog_top_bar = '';
	$travelers_blog_cat_color = '';

	$breadcrumb_bg = get_theme_mod( 'banner_image' );
	if( empty( $breadcrumb_bg ) ){
	  $breadcrumb_bg = get_template_directory_uri().'/assets/images/breadcrum.jpg';
	}
	$breadcrumb_bg_image = 'background-image:url('.esc_url( $breadcrumb_bg ).')';

	if(function_exists( 'travelers_blog_footer_image' )) {
		$travelers_blog_footer = travelers_blog_footer_image();
	}

	if(function_exists( 'travelers_blog_set_top_bar_color' )) {
		$travelers_blog_top_bar = travelers_blog_set_top_bar_color();
	}

	$travelers_blog_cat_color = travelers_blog_post_category_color();

	$inline_css .= "
		.breadcrumb_wrapper
		{"
			. esc_attr( $travelers_blog_breadcrumb_styl ) .
		"}
		footer.style-footer {"
			. esc_attr( $travelers_blog_footer ) .
		"}
		.upper-head {"
			. esc_attr( $travelers_blog_top_bar ) .
		"}
		.theme-info-wrapper {
			padding: 20px 20px 20px 5px;
		}
		.search-box-wrap {
			display: none;
		}
		a.content-tag {"
			. esc_attr( $travelers_blog_cat_color ) .
		"}";

	return apply_filters( 'travelers_blog_inline_style', $inline_css );

}


function travelers_blog_breadcrumb_style(){

	$travelers_blog_mode = get_theme_mod('slider_banner');
	$travelers_blog_breadcrumb_height = get_theme_mod('breadcrumb_height'); 

	if($travelers_blog_mode == 'banner') {
		$travelers_blog_breadcrumb_bg = get_theme_mod( 'banner_image' );
	}

	$travelers_blog_primary_color = get_theme_mod('breadcrumb_primary_color'); 
	$travelers_blog_secondary_color = get_theme_mod('breadcrumb_secondary_color');
	
	if(!$travelers_blog_breadcrumb_height) {
		$travelers_blog_breadcrumb_height = 50;
	}

	$travelers_blog_breadcrumb_primary_color = !empty($travelers_blog_primary_color) 
		? $travelers_blog_primary_color : '#326ddc'; 
	
	$travelers_blog_breadcrumb_secondary_color = !empty($travelers_blog_secondary_color) 
		? $travelers_blog_secondary_color : '#b31818';

	if($travelers_blog_mode == 'banner') {

		if(!empty($travelers_blog_breadcrumb_bg)) {
			$travelers_blog_breadcrumb_styl = 'background-image: url('
			.esc_url($travelers_blog_breadcrumb_bg).') !important; padding:'
			.esc_attr($travelers_blog_breadcrumb_height).'px 0 0 !important;';
		} else {
   			$travelers_blog_breadcrumb_styl = 'background: radial-gradient(circle farthest-side at center bottom, '.
   			esc_attr($travelers_blog_breadcrumb_primary_color).",".
   			esc_attr($travelers_blog_breadcrumb_secondary_color).
   			' 110%) !important; padding:'.esc_attr($travelers_blog_breadcrumb_height).
    		'px 0 0 !important;';
    	}

    } else {

   		$travelers_blog_breadcrumb_styl = 'background: radial-gradient(circle farthest-side at center bottom, '
			.esc_attr($travelers_blog_breadcrumb_primary_color).","
   			.esc_attr($travelers_blog_breadcrumb_secondary_color)
   			.' 110%) !important; padding:'.esc_attr($travelers_blog_breadcrumb_height)
   			.'px 0 0 !important;';
    }
    
    return $travelers_blog_breadcrumb_styl;

}

function travelers_blog_add_scripts( $scripts, $theme_version ){

	foreach ( $scripts as $key => $value ) {

		wp_register_script( $value['id'] ,$value['url'], array('jquery'), $theme_version, $value['footer'] );

		if( $value['id'] == 'custom' ){

			// Localize the script with new data
			$translation_array = array(
			    'enable_desktop_sticky_menu_status' => travelers_blog_get_theme_mod( 'enable_desktop_sticky_menu_status' ),
			    'enable_mobile_sticky_menu_status' => travelers_blog_get_theme_mod( 'enable_mobile_sticky_menu_status' ),
			    'is_rtl' => is_rtl() ? true : false
			);
			wp_localize_script( $value['id'], 'travelers_blog_object', $translation_array );

		}

		wp_enqueue_script( $value['id'] );

	}

}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WP Comment Walker
 */
require get_template_directory() . '/wp-comment-walker.php';

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/kirki/kirki.php';

function travelers_blog_numbered_pagination(){

	echo '<div class="result-paging-wrapper">';
	the_posts_pagination( 
		array(
			'mid_size' 	=> 2,
			'prev_text' => esc_html__( '&laquo;', 'travelers-blog' ),
			'next_text' => esc_html__( '&raquo;', 'travelers-blog' ),
		) 
	);
	echo '</div>';

}

if( !function_exists( 'travelers_blog_get_custom_logo_link' ) ){

	function travelers_blog_get_custom_logo_link(){

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

		if ( has_custom_logo() ) {
	        return $logo[0];
		} 

		return;       

	}

}

function travelers_blog_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

function travelers_blog_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'travelers_blog_excerpt_length', 999 );

add_filter( 'get_search_form','travelers_blog_search_form');
function travelers_blog_search_form( $form ) {
	$search_placeholder_text =  travelers_blog_get_theme_mod( 'main_menu_search_placeholder_text' );
	$search_btn_text =  travelers_blog_get_theme_mod( 'main_menu_search_btn_text' , esc_attr__( 'Search','travelers-blog' ) );
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    	<label for="s">
    		<input placeholder="' . esc_attr( $search_placeholder_text ) . '" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" class="search-field" />
    		<input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr( $search_btn_text ) .'" />
    	</label>    	
    </form>';

    return $form;
}


function travelers_blog_breadcrumb() { ?>

    <div class="breadcrumb_wrapper">
      <div class="container">
       	<div class="breadcrumb-content">
            <nav aria-label="breadcrumb">
               	<ul class="breadcrumb">
                    <?php echo esc_html(travelers_blog_custom_breadcrumbs()); ?>
               	</ul>
           	</nav>
        </div>
      </div>
    </div>

<?php }

function travelers_blog_truncated_title_len($post_id,$length) {
    $the_title = get_the_title($post_id);
    $title_length = strlen($the_title);
    echo wp_kses_post(substr($the_title, 0, $length));
    if ($title_length > $length) {
    	echo " ..."; 
    }
}


function travelers_blog_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = esc_html__('breadcrumbs','travelers-blog');
    $breadcrums_class   = esc_html__('breadcrumbs','travelers-blog');
    $home_title         = esc_html__( 'Home' , 'travelers-blog' );
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = esc_html__('destinations','travelers-blog');
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page()) {
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = array_slice($category, -1);
                $last_category = array_pop( $last_category );
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                	$cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                	'li' => array(
                		'class' => array()
                	),
                	'a' => array(
                		'href' => array()
                	)
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active1">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

                echo '<li class="item-current"><span class="active1 bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active1 bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active1 bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                	$parents, 
                	array(
                		'li' => array(
                			'class' => array()
                		),
                		'a' => array(
                			'class' => array(),
                			'href' => array(),
                			'title' => array()
                		),
                	)
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active1"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active1 bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active1">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
               
            // Day display
            echo '<li class="item-current"><span class="active1 bread-current"> ' . esc_html( get_the_time('jS') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month display
            echo '<li class="item-month"><span class="active1 bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active1 bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active1 bread-current">' . sprintf( esc_html__( 'Author: %s', 'travelers-blog' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active1 bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'travelers-blog' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'travelers-blog' ) . '</li>';
        } elseif( is_tax() ){

        	$term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

	        $tmpTerm = $term;
	        $tmpCrumbs = array();
	        while ($tmpTerm->parent > 0){
	            $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
	            $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
	            array_push($tmpCrumbs, $crumb);
	        }
	        echo implode( '', array_reverse($tmpCrumbs) );
	        echo '<li class="item-current item-cat"><span class="active1 bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

add_action( 'tgmpa_register', 'travelers_blog_register_required_plugins' );
function travelers_blog_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_html__( 'Cyclone Widgets', 'travelers-blog' ),
			'slug' => 'cyclone-widget',
			'required'=> false,
		)

	);

	$plugins = apply_filters( 'travelers_blog_recommended_plugins', $plugins );

	$config = array(
		'id'           => 'travelers_blog_tgmpa',  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => ''                   // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

add_filter('wp_nav_menu_items', 'travelers_blog_add_items_on_menus', 10, 2);
function travelers_blog_add_items_on_menus( $items, $args ) {

    if( $args->theme_location == 'menu-1' ){ 

    	$search_status = get_theme_mod( 'header_search', false );
    	$header_button = get_theme_mod( 'header_button', true );

    	ob_start(); 

    	/**
		* @param boolean $search_status
		* If true show the search icon
    	*/

    	if( empty( $search_status ) ){ ?>

	    	<li class="menu-item search_wrapper">
	    		<div class="header-search">
					<a href="javascript:void(0)" class="search-icon"><i class="fa fa-search"></i></a>
				</div>
	    	</li>

	    	<?php 
	    } 

	    if( empty( $header_button ) ){ ?>

		    <li class="menu-item header_search_wrapper header_btn_wrapper">
		    	<?php travelers_blog_get_menu_btn(); ?>
		    </li>

	    	<?php
	    }

    	$content = ob_get_clean();
      	$items .= $content;
    }

    return $items;

}

/**
* @param boolean $header_button
* If true show the button
*/

function travelers_blog_get_menu_btn(){

	$header_button = get_theme_mod( 'header_button', false );
	if( !empty( $header_button ) ){
		return;
	}
	
    $header_button_label = get_theme_mod( 'header_button_label', esc_html__( 'Buy Now', 'travelers-blog' ) );
    $header_button_link = get_theme_mod( 'header_button_link', '#' ); ?>
    	
	<a href="<?php echo esc_url( $header_button_link ); ?>" class="btn btn-primary menu_custom_btn">
		<?php 
		echo esc_html( $header_button_label );
		?>
	</a>
        
    <?php

}

if( !function_exists( 'travelers_blog_get_footer' ) ){
	function travelers_blog_get_footer(){ 
		travelers_blog_get_footer_5();
	}
}


if( !function_exists( 'travelers_blog_get_footer_social_links' ) ){

function travelers_blog_get_footer_social_links(){

	$social_icons = get_theme_mod( 'footer_social_links' );

    if( !empty( $social_icons ) && is_array( $social_icons ) ){

        echo '<ul class="social-net">';
        $count = 0.2;
        foreach( $social_icons as $value ){
            echo '<li class="wow fadeInUp animated" data-wow-delay="' . esc_attr( $count ) . 's" data-wow-offset="50"><a href="' . esc_url( $value['link'] ) . '"><i class="' . esc_attr( $value['icon'] ) . '"></i></a></li>';
            $count = $count + 0.2;
        }
        echo '</ul>';

    }
}

}


if( !function_exists( 'travelers_blog_get_footer_5' ) ){
	function travelers_blog_get_footer_5(){ ?>

		<footer id="footer" class="footer-style footer_free">

		    <div class="container">

		        <p class="copyright">
		        	<?php travelers_get_copyright_section(); ?>
		        </p>
		    </div>
		</footer>

		<?php
	}
}

if( !function_exists( 'travelers_get_copyright_section' ) ){

	function travelers_get_copyright_section(){

		esc_html_e( 'Copyright &copy;', 'travelers-blog' ); 
		echo esc_html( date_i18n( 'Y' ) , 'travelers-blog' ); ?> 
				
		<?php bloginfo( 'name' ); ?>

		<?php 

		esc_html_e( '. All rights reserved. ', 'travelers-blog' ); 

		echo '<span class="travelers_blog_copyright_inner">';

		printf( 
			esc_html__( 'Powered by %1$s', 'travelers-blog' ),  
			'<a href="https://wordpress.org/" target="_blank">WordPress</a>' 
		); 

		?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'travelers-blog' ); ?> 

	    <a href="<?php echo esc_url( 'https://holidaysthemes.com/'); ?>" target="_blank">
	    	<?php esc_html_e( 'Holidays Themes', 'travelers-blog' ); ?>
	    </a>

	    <?php

	    echo '</span>';

	}

}

add_filter( 'kirki_telemetry', '__return_false' );

function travelers_blog_get_category_link($category_name) {
  	$category_id = get_cat_ID($category_name);
  	$category_link = get_category_link( $category_id ); 
  	echo esc_url($category_link);
}

if( !function_exists('travelers_blog_get_all_categories') ){

	function travelers_blog_get_all_categories() {
            
  		foreach((get_the_category()) as $travelers_blog_category) :

  			$rand_color = array();
    		$travelers_blog_cat_id = $travelers_blog_category->term_id; 
    		$travelers_blog_cat_name = $travelers_blog_category->cat_name; 
    		$rand_color[] = $travelers_blog_default = travelers_blog_post_category_color( $rand_color ); ?>

    		<a href="<?php echo esc_url(travelers_blog_get_category_link($travelers_blog_cat_name)); ?>" class="tag post-tag tag-black" style="background:<?php echo esc_attr($travelers_blog_default); ?>">
      			<?php echo esc_html(get_cat_name($travelers_blog_cat_id)); ?>
    		</a> <?php
  
  		endforeach;
	}

}

if( !function_exists('travelers_blog_get_first_category') ){

	function travelers_blog_get_first_category() {

		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
      		$travelers_blog_cat_id = $categories[0]->term_id ;
    		$travelers_blog_cat_name =  $categories[0]->cat_name ; ?>
      	
      		<span>
        		<a href="<?php echo esc_url(travelers_blog_get_category_link($travelers_blog_cat_name)); ?>" class="tag content-tag content-styl tag-black">
          			<?php echo esc_html($travelers_blog_cat_name); ?>
        		</a>
      		</span>

		<?php }
	}

}

if( !function_exists('travelers_blog_post_category_color') ){
	function travelers_blog_post_category_color( $used_color = array() ) {
		$travelers_blog_color_array = array('#f75691','#f44336','#dd9933','#3d9ddf','#5cb85c','#e91e63','#3f51b5','#009688','#8bc34a','#ff5722','#795548','#9e9e9e','#607d8b');
		$travelers_blog_color_array = array_diff( $travelers_blog_color_array, $used_color );

		$color = array_rand($travelers_blog_color_array);
		$travelers_blog_color = $travelers_blog_color_array[$color];
		return $travelers_blog_color;
	}
}


if( !function_exists('travelers_blog_get_author_detail') ){
	function travelers_blog_get_author_detail() { 

		$authorID = get_post_field( 'post_author',get_the_ID()); ?>
  
  		<p><a href="<?php echo esc_url(get_author_posts_url($authorID)); ?>" title="<?php echo esc_attr(get_the_author() ); ?>">
    		<i class="fa fa-user-o"></i>
    		<?php echo esc_html(get_the_author_meta('display_name',$authorID));  ?>
 	 	</a></p>
                                
  		<p><a href="<?php echo esc_url(travelers_blog_archive_date()); ?>">
    		<i class="fa fa-clock-o"></i>
    		<?php echo esc_html(get_the_date()); ?>
  		</a></p>

  		<p><a href="<?php the_permalink(); ?>/#respond">
    		<i class="fa fa-comments-o"></i>
    		<?php echo esc_html(get_comments_number()); ?>
  		</a></p>

	<?php }
} 

if( !function_exists('travelers_blog_get_author_detail_sidebar') ){
	function travelers_blog_get_author_detail_sidebar($post_author,$post_date,$post_comment) { 
  		if($post_author == 'Show') : ?>
    		<p><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(get_the_author() ); ?>">
      		<i class="fa fa-user-o"></i>
      		<?php the_author(); ?>
    		</a></p>
  		<?php endif;

  		if($post_date == 'Show') : ?>                     
    		<p><a href="<?php echo esc_url(travelers_blog_archive_date()); ?>">
      		<i class="fa fa-clock-o"></i>
      		<?php echo esc_html(get_the_date()); ?>
   		 	</a></p>
  		<?php endif;

  		if($post_comment == 'Show') : ?>
   			<p><a href="<?php the_permalink(); ?>/#respond"><i class=" fa fa-comments-o"></i>
      		<?php echo esc_html(get_comments_number()); ?>
    		</a></p>
  		<?php endif; 
	}
}


if( !function_exists('travelers_blog_archive_date') ){
	function travelers_blog_archive_date() {
		$archive_year  = get_the_time('Y'); 
    	$archive_month = get_the_time('m'); 
    	$archive_day   = get_the_time('d');
    
    	return get_day_link( $archive_year, $archive_month, $archive_day);
	}
}


function travelers_blog_author_profile() { ?>
  	<div class="profile-image">
    	<?php echo wp_kses_post(travelers_blog_get_author_profile('thumbnail')); ?>
  	</div>
  	<div class="profile-content heading-styl">
    	<p class="highlight"><?php esc_html_e('Written By','travelers-blog'); ?></p>
    	<?php $authorID = get_post_field( 'post_author',get_the_ID()); ?>
    	<h3>
    		<a class="heading-styl" href="<?php echo esc_url(get_author_posts_url($authorID)); ?>" title="<?php echo esc_attr(get_the_author() ); ?>"><?php echo esc_html(get_the_author_meta('display_name',$authorID));  ?>
    		</a>
    	</h3>
  	</div>
	<?php 
} 

function travelers_blog_get_author_profile($size) {
	return get_avatar( get_the_author_meta('ID'), $size );
}

function travelers_blog_get_tags() {
  	$post_tag = get_the_tags();
  	if ($post_tag) {
    	echo '<p class="post-tags">'.esc_html__('Tags:','travelers-blog');
    	foreach($post_tag as $tag) {
      		$tag_link = get_tag_link($tag->term_id);
      		echo ' <a href="'.esc_url($tag_link).'" class="tag-blue tag content-styl">'.esc_html($tag->name) . '</a>'; 
    	} 
    	echo '</p>';
  	}
}

function travelers_blog_get_the_category() {
  	$categories = get_the_category();
  	if ( ! empty( $categories ) ) {
      	$travelers_blog_cat_name =  $categories[0]->cat_name ;
     	return $travelers_blog_cat_name; 
    }
    return false;
}

function travelers_blog_detail_category_post() {

	$travelers_blog_first_category = travelers_blog_get_the_category();
	$postID = '';

  	$args = array(
      	'post_type' => 'post',	    
      	'post__not_in' => array(get_the_ID()),
      	'post_status' => 'publish',
      	'order' => 'DESC',
      	'category_name' => $travelers_blog_first_category,
      	'posts_per_page' => 1,
    );

    $result = new WP_Query( $args );
     
    if ( $result->have_posts() ) :

      	while ( $result->have_posts() ) : $result->the_post();

       		global $post;
        	$postID = $post->ID;
        	$imageID = get_post_thumbnail_id(); 
			$image = wp_get_attachment_image_src($imageID,'medium_large');

			if( has_post_thumbnail() ): ?>

	        	<div class="col-md-6 col-md-push-6">
	    			<div class="list-item">
	    				<div class="post-image list-image">
	    					<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?>);">
	      						<div class="image-overlay"></div>
	       					</a>
	    				</div>
	  				</div>
	  			</div>

	  			<?php 

	  		endif; ?>

    		<div class="<?php echo ( has_post_thumbnail() ? 'col-md-6 col-md-pull-6' : 'col-md-12' ); ?>">
      			<div class="post-content">
        
          			<h2>
          				<a class="heading-styl" href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>">
            				<?php the_title(); ?>
          				</a>
          			</h2>
          			
          			<p class="content-styl">
          				<?php $content = $post->post_content;
          				echo esc_html( substr( wp_strip_all_tags( $content ), 0, 400) ) . esc_html__('...','travelers-blog'); ?>
          		
          			</p>

      				<div class="author-detail">
          				<?php travelers_blog_get_author_detail(); ?>
          			</div>
    
    			</div>
  			</div>  			
  
  			<?php 

  		endwhile;  

  	endif; 

  	wp_reset_postdata();

  	return $postID;

}



function travelers_blog_detail_category_posts( $ignore_post_id = '' ) {

 	$travelers_blog_first_category = travelers_blog_get_the_category();

 	$args = array(
   		'post_type' => 'post',
   		'post_status' => 'publish',
   		'post__not_in' => array( get_the_ID() , $ignore_post_id ),
   		'order' => 'DESC',
   		'category_name' => $travelers_blog_first_category,
   		'posts_per_page' => 3,
    );
    
    $result = new WP_Query( $args );
     
    if ( $result->have_posts() ) :
    	while ( $result->have_posts() ) :
       		$result->the_post(); 

       		global $post;
          	$post_id = $post->ID; 
          	$imageID = get_post_thumbnail_id(); 
			$image = wp_get_attachment_image_src($imageID,'medium_large'); ?>
           
    		<div class="col-sm-4">
      			
      			<div class="post-small-box list-item">

      				<?php 

      				if( has_post_thumbnail() ): ?>

	       				<div class="post-small-image list-image related_posts_3">
	              		
	              			<a href="<?php the_permalink(); ?>" style="background-image:url(<?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?>)">
	            				<div class="image-overlay"></div>
	              			</a> 

	       				</div>

	       				<?php

	       			endif;?>
       	
       				<div class="post-small-content">
        				<h3>
        					<a class="heading-styl" href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>">
            					<?php the_title(); ?>
          					</a>
          				</h3>
          	
          				<p class="content-styl">
          					<?php 
          					$content = $post->post_content;
          	 				echo wp_kses_post( substr( wp_strip_all_tags( $content ) , 0, 265) ) . esc_html__('...','travelers-blog'); ?>
          	 					
          	 			</p>
          	
  						<div class="author-detail">
          					<?php travelers_blog_get_author_detail(); ?>
          				</div>

       				</div>

      			</div>

     		</div>

     		<?php 

     	endwhile; 

    endif; 

    wp_reset_postdata(); 

}

if( !function_exists( 'travelers_blog_get_social_icon' ) ){
	function travelers_blog_get_social_icon() { 
		$icons = get_theme_mod('icon_setting');
 		if( ! empty($icons) ) { ?>
        	<ul class="header-social-links pull-right">

			<?php foreach($icons as $ico):
				
				$social_icon = !empty( $ico['icon_class'] ) ? $ico['icon_class'] : '';
    			$social_url = !empty( $ico['icon_url'] ) ? $ico['icon_url'] : ''; 
    			
    			if( ! empty($social_icon) && ! empty($social_url) ) { ?>
					<li><a href="<?php echo esc_url($social_url); ?>">
      					<i class="<?php echo esc_attr($social_icon); ?>" aria-hidden="true"></i>
    				</a></li> 
				<?php } 
			
			endforeach; ?>
   		</ul>
   		<?php }
	}
}

if( !function_exists( 'travelers_blog_get_body_id' ) ){
	function travelers_blog_get_body_id() {
		return 'light';
	}
}

add_action( 'admin_notices', 'travelers_blog_installation_notice' );
function travelers_blog_installation_notice() {

	if( !empty( $_GET['status'] ) && $_GET['status'] == 'tb_hide_msg' ):
		update_option( 'travelers_blog_hide_notice', true ); // Hide the admin notice
	endif;

	$notice_status = get_option( 'travelers_blog_hide_notice', false );

	// IF 'true' don't show the admin notice.
	if( $notice_status ){
		return;
	}

	// Get the current url
	$current_url = admin_url();

	if( !empty( $_SERVER['HTTP_HOST'] ) && !empty( $_SERVER['REQUEST_URI'] ) ){		
		$current_url =  "//{" . sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) . "}{" . sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . "}";
	}

	$current_url = add_query_arg( array(
    	'status' => 'tb_hide_msg'
	), $current_url );

    ?>
		
    <div class="theme-info-start notice notice-info">

    	<div class="theme-info-wrapper" style="padding: 20px 20px 20px 5px;">

    		<img 
    		src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/travel-logo.png' ); ?>" 
    		style="margin-bottom: 20px;width: 175px;height: auto;">

	        <strong 
	        style="font-size: 20px; padding-bottom: 10px; display: block;">
	        	<?php esc_html_e( 'Thank you for installing Travelers Blog Lite', 'travelers-blog' ); ?>
	        </strong>

	        <p>
	        	<?php esc_html_e( "It comes with prebuild demo data so that you don't have to build it from the start. Install all recommended plugins to get started.", 'travelers-blog' ); ?>		
	        </p>

	        <div class="button_wrapper_theme" style="margin-top: 20px;">

	        	<a 
	        	href="<?php echo esc_url( admin_url() . 'themes.php?page=tgmpa-install-plugins&status=tb_hide_msg' ); ?>" 
	        	class="button button-primary button-hero">
	        		<?php esc_html_e( 'Get Started', 'travelers-blog' ); ?>
	        	</a>

	        	<a href="<?php echo esc_url( $current_url ); ?>" class="button button-default button-hero">
	        		<?php esc_html_e( 'Close', 'travelers-blog' ); ?>
	        	</a>

	        </div>

        </div>
        
    </div>

    <?php	

}

if ( ! function_exists( 'travelers_blog_get_theme_mod' ) ) {
  	function travelers_blog_get_theme_mod( $field_id, $default_value = '' ) {
    	if ( $field_id ) {
      		if ( !$default_value ) {
        		if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
          			$default_value = Kirki::$fields[ $field_id ]['default'];
        		}
      		}
      		$value = get_theme_mod( $field_id, $default_value );
      		return $value;
    	}
    	return false;
  	}
}