<?php
/**
 * News Box Theme Customizer
 *
 * @package News_Box
 */

/**
 * Add refresh support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.

/*
*
*Get Category list in select field
*
*/
if ( ! function_exists( 'news_box_get_term_options' ) ) : 
function news_box_get_term_options( $taxonomy ) {
 global $wp_version;
	if ( $wp_version >= 4.5 ) {
  	$args=array(
			'taxonomy' => $taxonomy,
			'orderby'    => 'count',
			'hide_empty' => 0,
		); 
		 $terms = get_terms($args ); 
	}else{ 
	$args=array(
		'orderby'    => 'count',
		'hide_empty' => 0,
		); 
	 $terms = get_terms( $taxonomy,$args ); 
		
		}
			
		$cat= array();
		$cat['all']= __('All','news-box');
		 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ):
        foreach ($terms as $term) :
			$cat[$term->slug ] = esc_html($term->name);
        endforeach;
		endif;
		 
    return $cat; 
}
endif; 




function news_box_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'news_box_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'news_box_customize_partial_blogdescription',
		) );
	}

	// Add news box options section
	$wp_customize->add_section('news_box_options', array(
		'title' => __('News Box Options', 'news-box'),
		'capability'     => 'edit_theme_options',
		'description'     => __('The News Box theme options ', 'news-box'),

	));
	/*
	* Create header background color
	*/
	// Add setting
	$wp_customize->add_setting('header_bgcolor', array(
		'default' => '#fff',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'header_bgcolor', array(
				'label' => __('Header Background Color','news-box'),
				'section' => 'colors'
			)
		)
	);

	// Add setting
	$wp_customize->add_setting('content_bg_color', array(
		'default' => '#fff',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'content_bg_color', array(
				'label' => __('Content Background Color','news-box'),
				'section' => 'colors'
			)
		)
	);
	/*
	* text color
	*/
	// Add setting
	$wp_customize->add_setting('content_text_color', array(
		'default' => '#212529',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'content_text_color', array(
				'label' => __('Content text Color','news-box'),
				'section' => 'colors'
			)
		)
	);
	/*
	* Link color
	*/
	// Add setting
	$wp_customize->add_setting('link_color', array(
		'default' => '#007bff',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'link_color', array(
				'label' => __('Link Color','news-box'),
				'section' => 'colors'
			)
		)
	);
	/*
	* Link Hover color
	*/

	// Add setting
	$wp_customize->add_setting('link_hover_color', array(
		'default' => '#0056b3',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'link_hover_color', array(
				'label' => __('Link Hover Color','news-box'),
				'section' => 'colors'
			)
		)
	);
	//Site container
	    $wp_customize->add_setting('newsbox__container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_container_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox__container_control', array(
        'label'      => __('Site container', 'news-box'),
        'description'     => __('Select default page container for your site. News Box support both container and container-fluid.', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'newsbox__container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard container', 'news-box'),
            'container-fluid' => __('Full width container', 'news-box'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_date_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_date_show_control', array(
        'label'      => __('Date time show', 'news-box'),
        'description'=> __('You can show or hide header top bar.', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'news_box_date_show',
        'type'       => 'checkbox',
        
    ) );

      /*
	  * Feature image show hide
	   */
    $wp_customize->add_setting('news_box_feature_show', array(
        'default'        => 'block',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_feature_show_hide',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_features', array(
        'label'      => __('Feature section', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'news_box_feature_show',
        'type'       => 'radio',
        'choices'    => array(
            'block' => __('Show feature section', 'news-box'),
            'hide' => __('Hide feature section', 'news-box'),
        ),
    ));
	 /*
	  * Feature image category select
	   */
      
    $wp_customize->add_setting('news_box_feature_cat', array(
        'default'        => 'all',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_cat_feature',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('theme_color_control', array(
        'label'      => __('Select Feature post category', 'news-box'),
        'description'     => __('You may create an unique category for feature items then select the category form this list. If you category item empty then show latest post', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'news_box_feature_cat',
        'type'       => 'select',
        'choices'    => news_box_get_term_options('category')
    ));
    $wp_customize->add_setting('newsbox_feature_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_container_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_feature_container_control', array(
        'label'      => __('Feature section container', 'news-box'),
        'description'     => __('Select default page container for your site. News Box support both container and container-fluid.', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'newsbox_feature_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard feature container', 'news-box'),
            'container-fluid' => __('Full width feature container', 'news-box'),
        ),
    ));


/*
*Feature section background color
*/

    	// Add setting
	$wp_customize->add_setting('feature_background_color', array(
		'default' => '#dddddd',
		'type' =>'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'refresh',
	));
	// Add color control 
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'feature_background_color', array(
				'label' => __('Feature section background color','news-box'),
				'section' => 'news_box_options'
			)
		)
	);
     /*
	  * content view
	   */
    $wp_customize->add_setting('view_set', array(
        'default'        => 'card-view',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_content_view',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_view_set', array(
        'label'      => __('Select news item view style', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'view_set',
        'type'       => 'radio',
        'choices'    => array(
            'default-view' => __('Default view', 'news-box'),
            'card-view' => __('Card view', 'news-box'),
        ),
    ));

    $wp_customize->add_setting('footer_style', array(
        'default'        => 'center-view',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_footer_view',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('footer_style_set', array(
        'label'      => __('Footer style', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'footer_style',
        'type'       => 'select',
        'choices'    => array(
            'default-view' => __('Default view', 'news-box'),
            'center-view' => __('Center view', 'news-box'),
        ),
    ));


	  // Footer text change
     $wp_customize->add_setting('footer_text', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('footer_text_control', array(
        'label'      => __('Footer text', 'news-box'),
        'description'     => __('Html tag support the field. You can see full HTML result after save text. <a target="_blank" href="https://wpthemespace.com/product/news-box/">Upgrade pro for remove footer credit link</a>', 'news-box'),
        'section'    => 'news_box_options',
        'settings'   => 'footer_text',
        'type'       => 'textarea',
    ));


}
add_action( 'customize_register', 'news_box_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function news_box_customize_partial_blogname() {
	esc_html(bloginfo( 'name' ));
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function news_box_customize_partial_blogdescription() {
	esc_html(bloginfo( 'description' ));
}
// container set sanitize
if ( ! function_exists( 'newsbox_container_sanitize' ) ) :
function newsbox_container_sanitize($value){ 
    if(!in_array($value, array('container-fluid','container'))){
        $value = 'container';
    }
    return $value;
}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
//Sanitize layout
function news_box_cat_feature($value){ 
		global $wp_version;
	if ( $wp_version >= 4.5 ) {
  	$args=array(
			'taxonomy' => 'category',
			'orderby'    => 'count', 
			'hide_empty' => 0,
		); 
		 $terms = get_terms($args ); 
	}else{ 
	$args=array(
		'orderby'    => 'count',
		'hide_empty' => 0,
		); 
	 $terms = get_terms( 'category',$args ); 
		
		}
			
		$catlist= array();
      foreach ($terms as $term) :
			$catlist[] = $term->slug; 
       endforeach;

	if(!in_array($value,$catlist)){
		$value = 'all';
	}
	return $value;
}
//Sanitize layout
function news_box_content_view($value){ 
	if(!in_array($value, array('default-view','card-view','grid'))){
		$value = 'card-view';
	}
	return $value;
}
//Footer style 
function news_box_footer_view($value){ 
	if(!in_array($value, array('default-view','center-view'))){
		$value = 'center-view';
	}
	return $value;
}
//Sanitize layout
function news_box_feature_show_hide($value){ 
	if(!in_array($value, array('block','hide'))){
		$value = 'block';
	}
	return $value;
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_box_customize_preview_js() {
	wp_enqueue_script( 'news-box-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'news_box_customize_preview_js' );
