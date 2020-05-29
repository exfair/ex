<?php

/**
 * Enqueue style for custom customize control.
 */

add_action( 'customize_controls_enqueue_scripts', 'travelers_blog_custom_customize_enqueue' );
function travelers_blog_custom_customize_enqueue() {
	wp_enqueue_style( 'travelers_blog-customize-controls-css', get_template_directory_uri() . '/inc/sections/customizer.css' );
	wp_enqueue_script( 'travelers_blog-customize-controls-js', get_template_directory_uri() . '/inc/sections/customizer-control.js' , array( 'customize-controls' ) );
}

add_action( 'customize_register', 'travelers_blog_upgrade_to_pro_msg' );
function travelers_blog_upgrade_to_pro_msg( $wp_customize ){

	wp_enqueue_style( 'travelers_blog-customize-controls-init', get_template_directory_uri() . '/inc/sections/customizer-init.css' );

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/sections/controls.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Travelers_Blog_Customize_Section' );

	// Register sections.
	$wp_customize->add_section(
		new Travelers_Blog_Customize_section(
			$wp_customize,
			'theme_upsell',
			array(
				'priority' => 1,
			)
		)
	);

}


add_action( 'init' , 'travelers_blog_kirki_fields' );
function travelers_blog_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config('theme_config_id', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'checkbox',
		'settings'    => 'hide_tagline_status',
		'label'       => esc_html__( 'Hide Tagline ?', 'travelers-blog' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'output'    => array(
			array(
				'element'  => '.logo a p',
				'property' => 'display',
				'sanitize_callback' => function( $status ){
					return ( $status ? 'none' : 'block' );
				}
			),
		),
	] );

	Kirki::add_panel( 'theme_options', array(
	    'title'       => esc_html__( 'Theme Options', 'travelers-blog' ),
	) );

	/**
	* Start Header Section
	*/

	Kirki::add_section( 'header', array(
	    'title'          => esc_html__( 'Header', 'travelers-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 2,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'header_search_options',
		'section'     => 'header',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Header Search Options', 'travelers-blog' ) . '</div>'
	] );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'checkbox',
		'settings'    => 'header_search',
		'label'       => esc_html__( 'Disable Search', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => false
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'main_menu_search_placeholder_text',
		'label'    => esc_html__( 'Placeholder Text', 'travelers-blog' ),
		'section'  => 'header',
		'default'  => esc_html__( 'Enter Your search keyword ...', 'travelers-blog' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_search',
				'operator' => '==',
				'value'    => false,
			)
		)
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'header_search_break',
		'section'     => 'header',
		'default'     => '<hr>'
	] );

	/** 
	* Button on main menu
	*/

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'header_button_options',
		'section'     => 'header',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Header Button Options', 'travelers-blog' ) . '</div>'
	] );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'checkbox',
		'settings'    => 'header_button',
		'label'       => esc_html__( 'Disable Button', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => true,
		'partial_refresh' => array(
			'header_btn_wrapper1' => array(
				'selector'        => '.header_btn_wrapper',
				'render_callback' => 'travelers_blog_get_menu_btn',
			)
		),
	) );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'header_button_label',
		'label'       => esc_html__( 'Button Label', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => esc_html__( 'Buy Now', 'travelers-blog' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => false,
			)
		),
		'partial_refresh' => array(
			'header_btn_wrapper' => array(
				'selector'        => '.header_btn_wrapper',
				'render_callback' => 'travelers_blog_get_menu_btn',
			)
		),
	) );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'header_button_link',
		'label'       => esc_html__( 'Button Link', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => '#',
		'active_callback' => array(
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => false,
			)
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'header_button_option_break',
		'section'     => 'header',
		'default'     => '<hr>'
	] );

	/*
	* Main Menu Options
	*/

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sticky_menu_options',
		'section'     => 'header',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Main Menu Options', 'travelers-blog' ) . '</div>'
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'checkbox',
		'settings'    => 'enable_desktop_sticky_menu_status',
		'label'       => esc_html__( 'Enable Sticky Menu ( Desktop )', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => true,
		'output'    => array(
			array(
				'element'  => '.navbar.sticky',
				'property' => 'position',
				'value_pattern' => 'relative$',
				'media_query' => '@media (min-width: 1025px) and (max-width: 2000px)'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'checkbox',
		'settings'    => 'enable_mobile_sticky_menu_status',
		'label'       => esc_html__( 'Enable Sticky Menu ( Mobile/Tablet )', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => true,
		'output'    => array(
			array(
				'element'  => '.navbar.sticky',
				'property' => 'position',
				'value_pattern' => 'relative$',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'slider',
		'settings'    => 'main_menu_dropdown_height',
		'label'       => esc_html__( 'Menu Dropdown Height ( Mobile/Tablet )', 'travelers-blog' ),
		'section'     => 'header',
		'default'     => 200,
		'choices'     => array(
			'min'  => 200,
			'max'  => 300,
			'step' => 10,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_mobile_sticky_menu_status',
				'operator' => '==',
				'value'    => true,
			)
		),
		'output'    => array(
			array(
				'element'  => '.navbar .slicknav_nav',
				'property' => 'max-height',
				'value_pattern' => '$px',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
			array(
				'element'  => '.navbar .slicknav_nav',
				'property' => 'overflow-y',
				'value_pattern' => 'scroll',
				'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
			),
		),
	) );

	/*
	*
	* Homepage
	*/

	Kirki::add_section( 'homepage', array(
	    'title'          => esc_html__( 'Homepage', 'travelers-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 1,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'homepage_slider_options',
		'section'     => 'homepage',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Slider Options', 'travelers-blog' ) . '</div>'
	] );

	Kirki::add_field( 'homepage', array(
	'type'        => 'toggle',
	'settings'    => 'show_hide_slider',
	'label'       => esc_html__( 'Show/Hide Slider', 'travelers-blog' ),
	'section'     => 'homepage',
	'default'     => '1',
	'priority'    => 10,
	) );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'slider_category',
		'label'       => esc_html__( 'Select Slider Category', 'travelers-blog' ),
		'section'     => 'homepage',
		'multiple'    => 1,
		'choices'     => travelers_blog_get_post_categories(),
		'active_callback'  => array(
			array(
			'setting'  => 'show_hide_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'slider_height',
		'section'     => 'homepage',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Slider Height', 'travelers-blog' ) . '</div>',
		'active_callback'  => array(
			array(
			'setting'  => 'show_hide_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'slider',
		'settings' => 'slider_desktop',
		'label'    => esc_html__( 'Desktop (px)', 'travelers-blog' ),
		'section'  => 'homepage',
		'default'  => 400,
		'choices'  => array(
			'min'  => 200,
			'max'  => 1000,
			'step' => 50,
		),
		'output'    => array(
			array(
				'element'  => '#home_banner_blog.list-slider',
				'property' => 'height',
				'suffix'   => 'px'
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'show_hide_slider',
				'operator' => '==',
				'value'    => true,
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'slider',
		'settings' => 'slider_tablet',
		'label'    => esc_html__( 'Tablet (px)', 'travelers-blog' ),
		'section'  => 'homepage',
		'default'  => 400,
		'choices'  => array(
			'min'  => 200,
			'max'  => 1000,
			'step' => 50,
		),
		'output'    => array(
			array(
				'element'  => '#home_banner_blog.list-slider',
				'property' => 'height',
				'media_query' => '@media (min-width: 481px) and (max-width: 1024px)',
				'units'       =>'px'
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'show_hide_slider',
				'operator' => '==',
				'value'    => true,
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'slider',
		'settings' => 'slider_mobile',
		'label'    => esc_html__( 'Mobile (px)', 'travelers-blog' ),
		'section'  => 'homepage',
		'default'  => 400,
		'choices'  => array(
			'min'  => 200,
			'max'  => 1000,
			'step' => 50,
		),
		'output'    => array(
			array(
				'element'  => '#home_banner_blog.list-slider',
				'property' => 'height',
				'media_query' => '@media (min-width: 320px) and (max-width: 480px)',
				'units'       =>'px'
			),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'show_hide_slider',
				'operator' => '==',
				'value'    => true,
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'customizer_break',
		'section'     => 'homepage',
		'default'     => '<hr>',
		'active_callback'  => array(
			array(
			'setting'  => 'show_hide_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'homepage_listings_options',
		'section'     => 'homepage',
		'default'     => '<div class="tb_customizer_custom_heading">' . esc_html__( 'Listings Options', 'travelers-blog' ) . '</div>'
	] );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'slider',
		'settings'    => 'excerpt_length',
		'label'       => esc_html__( 'Excerpt Length', 'travelers-blog' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'travelers-blog' ),
		'section'     => 'homepage',
		'default'     => '30',
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'radio-buttonset',
		'settings'    => 'hide_author_listing_page',
		'label'       => esc_html__( 'Author', 'travelers-blog' ),
		'section'     => 'homepage',
		'default'     => 'inline-block',
		'choices'     => [
			'inline-block'   => esc_html__( 'Show', 'travelers-blog' ),
			'none' => esc_html__( 'Hide', 'travelers-blog' )
		],
		'transport' => 'postMessage',
		'js_vars'   => [
			[
				'element'  => '.list-content .author-detail p:first-child',
				'function' => 'css',
				'property' => 'display',
				'value_pattern' => '$'
			]
		],
		'output' => array(
		    array(
		        'element'  => '.list-content .author-detail p:first-child',
		        'property' => 'display',
		        'value_pattern' => '$'
		    )
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'radio-buttonset',
		'settings'    => 'hide_date_listing_page',
		'label'       => esc_html__( 'Date', 'travelers-blog' ),
		'section'     => 'homepage',
		'default'     => 'inline-block',
		'choices'     => [
			'inline-block'   => esc_html__( 'Show', 'travelers-blog' ),
			'none' => esc_html__( 'Hide', 'travelers-blog' )
		],
		'transport' => 'postMessage',
		'js_vars'   => [
			[
				'element'  => '.list-content .author-detail p:nth-child(2)',
				'function' => 'css',
				'property' => 'display',
				'value_pattern' => '$'
			]
		],
		'output' => array(
		    array(
		        'element'  => '.list-content .author-detail p:nth-child(2)',
		        'property' => 'display',
		        'value_pattern' => '$'
		    )
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'radio-buttonset',
		'settings'    => 'hide_comment_listing_page',
		'label'       => esc_html__( 'Comment', 'travelers-blog' ),
		'section'     => 'homepage',
		'default'     => 'inline-block',
		'choices'     => [
			'inline-block'   => esc_html__( 'Show', 'travelers-blog' ),
			'none' => esc_html__( 'Hide', 'travelers-blog' )
		],
		'transport' => 'postMessage',
		'js_vars'   => [
			[
				'element'  => '.list-content .author-detail p:nth-child(3)',
				'function' => 'css',
				'property' => 'display',
				'value_pattern' => '$'
			]
		],
		'output' => array(
		    array(
		        'element'  => '.list-content .author-detail p:nth-child(3)',
		        'property' => 'display',
		        'value_pattern' => '$'
		    )
		),
	] );

	Kirki::add_section( 'breadcrumb', array(
	    'title'          => esc_html__( 'Breadcrumb', 'travelers-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	) );


	Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'breadcrumb_height',
	'label'       => esc_html__( 'Height', 'travelers-blog' ),
	'section'     => 'breadcrumb',
	'default'     => 50,
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	) );
	Kirki::add_field('theme_config_id', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'slider_banner',
		'label'       => esc_html__( 'Image / Color', 'travelers-blog' ),
		'section'     => 'breadcrumb',
		'default'     => 'banner',
		'choices'     => array(
			'banner'   => esc_html__( 'Image', 'travelers-blog' ),
			'color' => esc_html__( 'Color', 'travelers-blog' ),
		),
		'description' => esc_html__( 'Breadcrumb will not be displayed in Homepage & Detail pages.', 'travelers-blog' )
	) );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'image',
		'settings'    => 'banner_image',
		'label'       => esc_html__( 'Select Banner Image', 'travelers-blog' ),
		'section'     => 'breadcrumb',
		'active_callback'    => array(
			array(
				'setting'  => 'slider_banner',
				'operator' => '==',
				'value'    => 'banner',
			),
		)
	) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'breadcrumb_primary_color',
	'label'       => esc_html__( 'Primary Color', 'travelers-blog' ),
	'section'     => 'breadcrumb',
	'default'     => '#326ddc',
	'active_callback'  => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'color',
		),
	   ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'breadcrumb_secondary_color',
	'label'       => esc_html__( 'Secondary Color', 'travelers-blog' ),
	'section'     => 'breadcrumb',
	'default'     => '#b31818',
	'active_callback'  => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'color',
		),
	   ),
) );

	/*
	*
	* 404 page
	*/
	Kirki::add_section( '404_settings', array(
	    'title'          => esc_html__( '404 Page', 'travelers-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field('theme_config_id', array(
		'type'        => 'image',
		'settings'    => '404_background_image',
		'label'       => esc_html__( 'Background Image', 'travelers-blog' ),
		'section'     => '404_settings',
		'default'     => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'transport' => 'postMessage',
	    'js_vars'   => array(
			array(
				'element'  => '.error-section',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'output' => array(
			array(
				'element'  => '.error-section',
				'property' => 'background-image'
			)
		),
	) );

	/*
	*
	* Footer
	*/

	Kirki::add_section( 'footer_free', array(
	    'title'          => esc_html__( 'Footer', 'travelers-blog' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'radio-buttonset',
		'settings'    => 'copyright_position',
		'label'       => esc_html__( 'Copyright Position', 'travelers-blog' ),
		'section'     => 'footer_free',
		'default'     => 'center',
		'choices'     => [
			'left'   => esc_html__( 'Left', 'travelers-blog' ),
			'center' => esc_html__( 'Center', 'travelers-blog' ),
			'right'  => esc_html__( 'Right', 'travelers-blog' ),
		],
		'output'    => array(
			array(
				'element'  => 'p.copyright',
				'property' => 'text-align'
			),
		),
	] );

}