<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
*
*
* Theme options
*
*
*
*/

class Fasto_Customize {

   public static function register ( $wp_customize ) {
	
	# set transport postMessage for some options
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport = 'postMessage';
  
	# move some default options to theme options panel
	$wp_customize->get_section ('colors')->panel = 'fasto_theme_options';
	$wp_customize->get_section ('background_image')->panel = 'fasto_theme_options';
	$wp_customize->get_section ('title_tagline')->panel = 'fasto_theme_options';
	$wp_customize->get_section ('header_image')->panel = 'fasto_theme_options';


	  #
	  # Panel - Theme options
      #
	  $wp_customize->add_panel( 'fasto_theme_options', 
         array(
            'title'       => esc_html__( 'Theme Options', 'fasto' ), 
            'priority'    => 10, 
            'capability'  => 'edit_theme_options',
         ) 
      );
  
	  #
	  # Section - Colors
      #
 
	  # Main color 1
      $wp_customize->add_setting( 'fasto_primary_color', 
         array(
            'default'    => fasto_default( 'fasto_primary_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_color1', 
         array(
            'label'      => esc_html__( 'Main color 1', 'fasto' ), 
			'description' => esc_html__( 'Main theme color', 'fasto' ),
            'settings'   => 'fasto_primary_color', 
            'section'    => 'colors', 
         ) 
      ) );	 
	  
	  # Main color 2
      $wp_customize->add_setting( 'fasto_secondary_color', 
         array(
            'default'    => fasto_default( 'fasto_secondary_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_color2', 
         array(
            'label'      => esc_html__( 'Main color 2', 'fasto' ), 
			'description' => esc_html__( 'Main theme second color', 'fasto' ),
            'settings'   => 'fasto_secondary_color', 
            'section'    => 'colors', 
         ) 
      ) );
	  	  
		  
	  # Body text color
      $wp_customize->add_setting( 'fasto_body_color', 
         array(
            'default'    => fasto_default( 'fasto_body_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_body', 
         array(
            'label'      => esc_html__( 'Body text color', 'fasto' ), 
			'description' => esc_html__( 'The color of body text', 'fasto' ),
            'settings'   => 'fasto_body_color', 
            'section'    => 'colors', 
         ) 
      ) );	  
	  
	  # Headings colors
      $wp_customize->add_setting( 'fasto_headings_color', 
         array(
            'default'    => fasto_default( 'fasto_headings_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_headings', 
         array(
            'label'      => esc_html__( 'Other body colors', 'fasto' ), 
			'description' => esc_html__( 'Colors of headings, article title links etc', 'fasto' ),
            'settings'   => 'fasto_headings_color', 
            'section'    => 'colors', 
         ) 
      ) );	  
	    
	  # Category background
      $wp_customize->add_setting( 'fasto_category_color', 
         array(
            'default'    => fasto_default( 'fasto_category_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_category', 
         array(
            'label'      => esc_html__( 'Category background', 'fasto' ), 
			'description' => esc_html__( 'Background of post category', 'fasto' ),
            'settings'   => 'fasto_category_color', 
            'section'    => 'colors', 
         ) 
      ) );	  
	  
	  # Footer background
      $wp_customize->add_setting( 'fasto_footer_color', 
         array(
            'default'    => fasto_default( 'fasto_footer_color' ), 
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options', 
            'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );      
            
    
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'fasto_footer', 
         array(
            'label'      => esc_html__( 'Footer background', 'fasto' ), 
			'description' => esc_html__( 'Background for footer', 'fasto' ),
            'settings'   => 'fasto_footer_color', 
            'section'    => 'colors', 
         ) 
      ) );		  

	  #
	  # Section - Blog
      #
      $wp_customize->add_section(
            'fasto_blog', 
            array(
                'title' => esc_html__( 'Blog', 'fasto' ),
				'panel' => 'fasto_theme_options'
            )
        );      

		# Blog layout
        $wp_customize->add_setting( 
            'fasto_blog_layout', 
            array(
				'default'    => fasto_default( 'fasto_blog_layout' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_blog_layout', 
            array(
                'label' => esc_html__( 'Choose blog layout', 'fasto' ),
				'description' => esc_html__( 'Select your blog layout', 'fasto' ),
                'section' => 'fasto_blog',
                'type' => 'radio',
                'choices' => array(
                    'grid-4' => esc_html__('Grid 4 per row','fasto'),
                    'grid-3' => esc_html__('Grid 3 per row','fasto'),
                    'grid-2' => esc_html__('Grid 2 with sidebar','fasto'),
                    'grid-1' => esc_html__('Blog classic with sidebar','fasto')               
                )
            )
        );   		
		
		# Blog single layout
        $wp_customize->add_setting( 
            'fasto_blog_single_layout', 
            array(
				'default'    => fasto_default( 'fasto_blog_single_layout' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_blog_single_layout', 
            array(
                'label' => esc_html__( 'Single blog layout', 'fasto' ),
				'description' => esc_html__( 'Select your single article blog layout', 'fasto' ),
                'section' => 'fasto_blog',
                'type' => 'radio',
                'choices' => array(
                    'sidebar' => esc_html__('With sidebar','fasto'),
                    'full' => esc_html__('Full','fasto'),            
                )
            )
        );   		
		
		# Blog single image size
        $wp_customize->add_setting( 
            'fasto_blog_single_thumb', 
            array(
				'default'    => fasto_default( 'fasto_blog_single_thumb' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_blog_single_thumb', 
            array(
                'label' => esc_html__( 'Single blog image', 'fasto' ),
				'description' => esc_html__( 'Choose if you want to display the cropped version of image, or the original one on single articles.', 'fasto' ),
                'section' => 'fasto_blog',
                'type' => 'radio',
                'choices' => array(
                    'crop' => esc_html__('Cropped','fasto'),
                    'original' => esc_html__('Original','fasto'),            
                )
            )
        ); 
		
		
		#Floating social article share
        $wp_customize->add_setting( 
            'fasto_enable_social_share', 
            array(
				'default'    => fasto_default( 'fasto_enable_social_share' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_enable_social_share', 
            array(
                'label' => esc_html__( 'Floating social share', 'fasto' ),
                'description' => esc_html__( 'Enables floating social share on single article.', 'fasto' ),
                'section' => 'fasto_blog',
                'type' => 'radio',
                'choices' => array(
                    '1' => esc_html__('Enable','fasto'),
                    '0' => esc_html__('Disable','fasto'),            
                )
            )
        );		
		
		#Social article share after post
        $wp_customize->add_setting( 
            'fasto_enable_social_share_after', 
            array(
				'default'    => fasto_default( 'fasto_enable_social_share_after' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_enable_social_share_after', 
            array(
                'label' => esc_html__( 'Regular social share', 'fasto' ),
                'description' => esc_html__( 'Enables social share at the end of article.', 'fasto' ),
                'section' => 'fasto_blog',
                'type' => 'radio',
                'choices' => array(
                    '1' => esc_html__('Enable','fasto'),
                    '0' => esc_html__('Disable','fasto'),            
                )
            )
        );


	  #
	  # Section - Typography
      #
      $wp_customize->add_section(
            'fasto_typography', 
            array(
                'title' => esc_html__( 'Typography', 'fasto' ),
				'panel' => 'fasto_theme_options'
            )
        );      

		# Headings font
        $wp_customize->add_setting( 
            'fasto_heading_font', 
            array(
				'default'    => fasto_default( 'fasto_heading_font' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control(
            'fasto_heading_font', 
            array(
                'label' => esc_html__( 'Headings font', 'fasto' ),
				'description' => esc_html__( 'Select headings font', 'fasto' ),
                'section' => 'fasto_typography',
                'type' => 'select',
                'choices' => array(
                    'roboto' => esc_html__('Roboto','fasto'),            
                    'poppins' => esc_html__('Poppins','fasto'),          
                    'open-sans' => esc_html__('Open Sans','fasto'),           
                    'lato' => esc_html__('Lato','fasto'),           
                    'oswald' => esc_html__('Oswald','fasto'),           
                    'source-sans-pro' => esc_html__('Source Sans Pro','fasto'),     
                    'montserrat' => esc_html__('Montserrat','fasto'),
                    'raleway' => esc_html__('Raleway','fasto'),
                    'nunito-sans' => esc_html__('Nunito Sans','fasto'),
                    'work-sans' => esc_html__('Work Sans','fasto'),
                )
            )
        ); 		
		
		# Headings font weight
        $wp_customize->add_setting( 
            'fasto_heading_font_w', 
            array(
				'default'    => fasto_default( 'fasto_heading_font_w' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control(
            'fasto_heading_font_w', 
            array(
                'label' => esc_html__( 'Headings font weight', 'fasto' ),
				'description' => esc_html__( 'Select weight of headings font ', 'fasto' ),
                'section' => 'fasto_typography',
                'type' => 'select',
                'choices' => array(
                    '100' => esc_html__('100','fasto'),
                    '300' => esc_html__('300','fasto'),
                    '400' => esc_html__('400','fasto'),
                    '500' => esc_html__('500','fasto'),
                    '700' => esc_html__('700','fasto'),
                    '900' => esc_html__('900','fasto'),
                )
            )
        );   		
		
		
		# Body font
        $wp_customize->add_setting( 
            'fasto_body_font', 
            array(
				'default'    => fasto_default( 'fasto_body_font' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control(
            'fasto_body_font', 
            array(
                'label' => esc_html__( 'Body font', 'fasto' ),
				'description' => esc_html__( 'Select body font', 'fasto' ),
                'section' => 'fasto_typography',
                'type' => 'select',
                'choices' => array(
                    'roboto' => esc_html__('Roboto','fasto'),            
                    'poppins' => esc_html__('Poppins','fasto'),          
                    'open-sans' => esc_html__('Open Sans','fasto'),           
                    'lato' => esc_html__('Lato','fasto'),           
                    'oswald' => esc_html__('Oswald','fasto'),           
                    'source-sans-pro' => esc_html__('Source Sans Pro','fasto'),     
                    'montserrat' => esc_html__('Montserrat','fasto'),
                    'raleway' => esc_html__('Raleway','fasto'),
                    'nunito-sans' => esc_html__('Nunito Sans','fasto'),
                    'work-sans' => esc_html__('Work Sans','fasto'),
                )
            )
        ); 		
		
		# Headings font weight
        $wp_customize->add_setting( 
            'fasto_body_font_w', 
            array(
				'default'    => fasto_default( 'fasto_body_font_w' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
            )
        );
          
        $wp_customize->add_control(
            'fasto_body_font_w', 
            array(
                'label' => esc_html__( 'Body font weight', 'fasto' ),
				'description' => esc_html__( 'Select weight of body font ', 'fasto' ),
                'section' => 'fasto_typography',
                'type' => 'select',
                'choices' => array(
                    '100' => esc_html__('100','fasto'),
                    '300' => esc_html__('300','fasto'),
                    '400' => esc_html__('400','fasto'),
                    '500' => esc_html__('500','fasto'),
                    '700' => esc_html__('700','fasto'),
                    '900' => esc_html__('900','fasto'),
                )
            )
        );   		
		
	  #
	  # Section - Social profiles
      #
      $wp_customize->add_section(
            'fasto_social', 
            array(
                'title' => esc_html__( 'Social profiles', 'fasto' ),
				'panel' => 'fasto_theme_options'
            )
        );      

		# Facebook
        $wp_customize->add_setting( 
            'fasto_facebook', 
            array(
				'default'    => fasto_default( 'fasto_facebook' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_facebook', 
            array(
                'label' => esc_html__( 'Facebook URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  		
		
		# Twitter
        $wp_customize->add_setting( 
            'fasto_twitter', 
            array(
				'default'    => fasto_default( 'fasto_twitter' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_twitter', 
            array(
                'label' => esc_html__( 'Twitter URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  			
		
		# Youtube
        $wp_customize->add_setting( 
            'fasto_youtube', 
            array(
				'default'    => fasto_default( 'fasto_youtube' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_youtube', 
            array(
                'label' => esc_html__( 'Youtube URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  		
		
		# Linkedin
        $wp_customize->add_setting( 
            'fasto_linkedin', 
            array(
				'default'    => fasto_default( 'fasto_linkedin' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_linkedin', 
            array(
                'label' => esc_html__( 'Linkedin URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  		
		
		# Pinterest
        $wp_customize->add_setting( 
            'fasto_pinterest', 
            array(
				'default'    => fasto_default( 'fasto_pinterest' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_pinterest', 
            array(
                'label' => esc_html__( 'Pinterest URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        ); 		
		
		# Dribbble
        $wp_customize->add_setting( 
            'fasto_dribbble', 
            array(
				'default'    => fasto_default( 'fasto_dribbble' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_dribbble', 
            array(
                'label' => esc_html__( 'Dribbble URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  			
		
		# Instagram
        $wp_customize->add_setting( 
            'fasto_instagram', 
            array(
				'default'    => fasto_default( 'fasto_instagram' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_instagram', 
            array(
                'label' => esc_html__( 'Instagram URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  			
		
		# Behance
        $wp_customize->add_setting( 
            'fasto_behance', 
            array(
				'default'    => fasto_default( 'fasto_behance' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'esc_url_raw',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_behance', 
            array(
                'label' => esc_html__( 'Behance URL', 'fasto' ),
				'description' => esc_html__( 'Do not forget http://', 'fasto' ),
                'section' => 'fasto_social',
                'type' => 'text',
            )
        );  		
	

	  #
	  # Section - Optimize
      #
      $wp_customize->add_section(
            'fasto_optimize', 
            array(
                'title' => esc_html__( 'Optimize', 'fasto' ),
				'panel' => 'fasto_theme_options'
            )
        );       		
		
		# Lazy load
        $wp_customize->add_setting( 
            'fasto_lazy_load', 
            array(
				'default'    => fasto_default( 'fasto_lazy_load' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
				'transport'  => 'postMessage',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_lazy_load', 
            array(
                'label' => esc_html__( 'Lazy load', 'fasto' ),
				'description' => esc_html__( 'If enabled, images and ads will be displayed using lazy load. This increase your website loading speed.', 'fasto' ),
                'section' => 'fasto_optimize',
                'type' => 'radio',
                'choices' => array(
                    '1' => esc_html__('Enable','fasto'),
                    '0' => esc_html__('Disable','fasto'),            
                )
            )
        );			
		
		# Lazy load
        $wp_customize->add_setting( 
            'fasto_inline_css', 
            array(
				'default'    => fasto_default( 'fasto_inline_css' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
				'transport'  => 'postMessage',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_inline_css', 
            array(
                'label' => esc_html__( 'Inline critical CSS', 'fasto' ),
				'description' => esc_html__( 'If enabled, the main CSS file will be inlined into the head. This will speed up loading time.', 'fasto' ),
                'section' => 'fasto_optimize',
                'type' => 'radio',
                'choices' => array(
                    '1' => esc_html__('Enable','fasto'),
                    '0' => esc_html__('Disable','fasto'),            
                )
            )
        );		  
		
		
	  #
	  # Section - Copyright
      #
      $wp_customize->add_section(
            'fasto_copyright', 
            array(
                'title' => esc_html__( 'Copyright', 'fasto' ),
				'panel' => 'fasto_theme_options'
            )
        );       		
		
		# User Copyright
        $wp_customize->add_setting( 
            'fasto_user_copyright', 
            array(
				'default'    => fasto_default( 'fasto_user_copyright' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'wp_kses_data',
				'transport'  => 'postMessage',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_user_copyright', 
            array(
                'label' => esc_html__( 'Copyright', 'fasto' ),
				'description' => esc_html__( 'Add your copyright text', 'fasto' ),
                'section' => 'fasto_copyright',
                'type' => 'textarea',
            )
        );		
		
		# Developer link
        $wp_customize->add_setting( 
            'fasto_developer_credit', 
            array(
				'default'    => fasto_default( 'fasto_developer_credit' ), 
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options', 
                'sanitize_callback' => 'fasto_sanitize_select_or_radio',
				'transport'  => 'postMessage',
            )
        );
          
        $wp_customize->add_control( 
            'fasto_developer_credit', 
            array(
                'label' => esc_html__( 'Developer Credit', 'fasto' ),
				'description' => esc_html__( 'Developer credit link from footer. If you want to support us, please leave this to enable. Thanks, you rock!', 'fasto' ),
                'section' => 'fasto_copyright',
                'type' => 'radio',
                'choices' => array(
                    '1' => esc_html__('Enable','fasto'),
                    '0' => esc_html__('Disable','fasto'),            
                )
            )
        );
				

		
		//WooCommerce
		if ( class_exists( 'WooCommerce' ) ){
				
		  #
		  # Section - WooCommerce
		  #
		  $wp_customize->add_section(
				'fasto_woo', 
				array(
					'title' => esc_html__( 'Fasto WooCommerce', 'fasto' ),
					'panel'    => 'woocommerce',
					'priority' => 1
				)
			);      

			# Shop layout
			$wp_customize->add_setting( 
				'fasto_shop_layout', 
				array(
					'default'    => fasto_default( 'fasto_shop_layout' ), 
					'type'       => 'theme_mod',
					'capability' => 'edit_theme_options', 
					'sanitize_callback' => 'fasto_sanitize_select_or_radio',
				)
			);
			  
			$wp_customize->add_control( 
				'fasto_shop_layout', 
				array(
					'label' => esc_html__( 'Choose shop layout', 'fasto' ),
					'description' => esc_html__( 'Select your shop layout', 'fasto' ),
					'section' => 'fasto_woo',
					'type' => 'radio',
					'choices' => array(
						'grid-4' => esc_html__('Grid 4 per row','fasto'),
						'grid-3' => esc_html__('Grid 3 per row','fasto'),
						'grid-2-sidebar' => esc_html__('Grid 2 With Sidebar','fasto'),
						'grid-3-sidebar' => esc_html__('Grid 3 With Sidebar','fasto')               
					)
				)
			);

			# Shop per row
			$wp_customize->add_setting( 
				'fasto_shop_per_page', 
				array(
					'default'    => fasto_default( 'fasto_shop_per_page' ), 
					'type'       => 'theme_mod',
					'capability' => 'edit_theme_options', 
					'sanitize_callback' => 'absint',
				)
			);
			  
			$wp_customize->add_control( 
				'fasto_shop_per_page', 
				array(
					'label' => esc_html__( 'Products per page', 'fasto' ),
					'description' => esc_html__( 'How many products per page should be displayed', 'fasto' ),
					'section' => 'fasto_woo',
					'type' => 'text',
				)
			); 			
				
			
		}
		
		
      
   }

   #output_css() - customzier CSS - hooked @ wp_enqueue_scripts
   public static function output_css() {
			
		  $css = '';
		 
		  #body color
		  $css .= self::generate_css('body,.body-color,.pagination a,.tagcloud a,ul.tags a', 'color', 'fasto_body_color', '');
		  
		  #headings color
		  $css .= self::generate_css('h1, h1 a,h2, h2 a,h3, h3 a,h4, h4 a,h5, h5 a,h6, h6 a,.widget a,.menu > .menu-item > a, .menu .page_item > a, .sub-menu a,.widget h2,header .logo h1,.comment-reply a,.subscribe p', 'color', 'fasto_headings_color', '');
		  $css .= self::generate_css('td, th,input[type="search"],input[type="text"],input[type="email"],input[type="password"],input[type="url"],input[type="number"],input[type=tel],textarea,select,.author-box,body .wp-block-table.is-style-stripes td,.comment-container,.breadcrumb-navigation,#sidebar .widget', 'border-color', 'fasto_headings_color', .2, '');
		  $css .= self::generate_css('.tagcloud a,ul.tags a', 'border-color', 'fasto_headings_color', .3, '');
		  
		  #primary color
		  $css .= self::generate_css('a, .color-1, .widget .color-1, .widget a:hover, .sub-menu .current-menu-item > a, .sub-menu a:hover, .menu > .menu-item > a:hover, .menu .page_item:hover > a, .menu > .menu-item:hover > a, .menu > .current-menu-item > a, .menu > .current-menu-ancestor > a, ul.tags a:hover, .comment-date, .fasto-fallback-menu .current_page_item a,.widget th a,.widget td a', 'color', 'fasto_primary_color', '');
		  $css .= self::generate_css('.bg-color-1, .pagination a:hover, .pagination li.active a, .single .pagination span.current, .category-count span, input[type="submit"], button, #after-footer .social-and-search, .author-box .social-and-search, .wp-block-quote::before, .wp-block-pullquote::before, blockquote::before, .widget .line', 'background-color', 'fasto_primary_color', '');
		  $css .= self::generate_css('.social-and-search,.articles .sticky .post-thumb,.tagcloud a:hover,.tags a:hover', 'border-color', 'fasto_primary_color', .4, '');
		  $css .= self::generate_css('.social-and-search svg,.author-date svg', 'fill', 'fasto_primary_color', .4, '');
		  $css .= self::generate_css('header .social-and-search a:hover svg,header .author-date a:hover svg,li.author:hover > a.author-dropdown > svg', 'fill', 'fasto_primary_color', '');
		  
		  #main color 2 
		  $css .= self::generate_css('a:hover, .color-2, .widget .color-2', 'color', 'fasto_secondary_color', '');
		  $css .= self::generate_css('button:hover,.bg-color-2,input[type="submit"]:hover', 'background-color', 'fasto_secondary_color', '');
		  
		  #category background 
		  $css .= self::generate_css('.category-link', 'background-color', 'fasto_category_color', '');
		  
		  #footer background
		  $css .= self::generate_css('footer#footer', 'background-color', 'fasto_footer_color', '');
		  
		  #body background
		  $css .= self::generate_css('body', 'background-color', 'body_bg', '');

		  if ( class_exists( 'WooCommerce' ) ) {
			  
			  #main color 1
			  $css .= self::generate_css('.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt', 'background-color', 'fasto_primary_color', '');
			  
			  #main color 2
			  $css .= self::generate_css('.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce input.button:hover,.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woo-cart-menu', 'background-color', 'fasto_secondary_color', '');
			  
			  #headings color
			  $css .= self::generate_css('.price', 'color', 'fasto_headings_color', '');
			  $css .= self::generate_css('.woocommerce-message,.woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals,.product_meta', 'border-color', 'fasto_headings_color', .2, '');
			  
			  #on sale tag
			  $css .= self::generate_css('.woocommerce span.onsale,.woocommerce ul.products li.product .onsale,.woocommerce span.onsale, .woocommerce ul.products li.product .onsale', 'background-color', 'fasto_category_color', '');

		   
		   }
		   
		   wp_add_inline_style( 'fasto-custom-css', $css );

   }
   
   
   #live preview for customizer
   public static function live_preview() {
      wp_enqueue_script( 
           'fasto-theme-customizer',
           FASTO_URI . '/js/fasto-theme-customizer.js', 
           array(  'jquery', 'customize-preview' ), 
           '',
           true
      );
   }   
   
   #generate custom css code
   public static function generate_css( $selector, $style, $mod_name, $rgba=false, $prefix='', $postfix='' ) {
    
      $mod = get_theme_mod( $mod_name );
	  if ( $rgba ){
		 $mod = esc_attr( fasto_hex( $mod, $rgba ) );
	  }
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix . esc_attr( $mod ) . $postfix
         );
         
        return $return;
      }
     
    }
}

add_action( 'customize_register' , 		array( 'Fasto_Customize' , 'register' ) );
add_action( 'wp_enqueue_scripts' , 		array( 'Fasto_Customize' , 'output_css' ) );
add_action( 'customize_preview_init' ,  array( 'Fasto_Customize' , 'live_preview' ) );

#sanitize radio or select
function fasto_sanitize_select_or_radio( $input, $setting ){
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                             
}