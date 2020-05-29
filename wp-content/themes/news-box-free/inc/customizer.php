<?php
/**
 * News Box free Theme Customizer
 *
 * @package News Box
 */

/*
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_box_free_content_view_sanitize($value){ 
    if(!in_array($value, array('grid','card-view','default-view'))){
        $value = 'grid';
    }
    return $value;
}


function news_box_free_customize_register( $wp_customize ) {

	$wp_customize->remove_control( 'news_box_view_set' );
    $wp_customize->remove_control( 'news_box_features' );

    $wp_customize->add_setting( 'news_box_free_fsection' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_free_fsection_control', array(
        'label'      => esc_html__('Home feature section', 'news-box-free'),
        'description'=> esc_html__('Home feature section show or hide.', 'news-box-free'),
        'section'    => 'news_box_options',
        'priority' => 6,
        'settings'   => 'news_box_free_fsection',
        'type'       => 'checkbox',
        
    ) );
    /*
    * content view
    */
    $wp_customize->add_setting('view_set', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_free_content_view_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('view_set_control', array(
        'label'      => esc_html__('Select news content view style', 'news-box-free'),
        'section'    => 'news_box_options',
        'settings'   => 'view_set',
        'priority' => 5,
        'type'       => 'select',
        'choices'    => array(
            'default-view' => esc_html__('Default view', 'news-box-free'),
            'card-view' => esc_html__('List view', 'news-box-free'),
            'grid' => esc_html__('Grid view', 'news-box-free'),
        ),
    ));


}
add_action( 'customize_register', 'news_box_free_customize_register',99 );
