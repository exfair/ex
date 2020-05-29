<?php
/**
 * Add inline css 
 *
 * 
 */
if ( ! function_exists( 'news_box_header_inline_css' ) ) :
function news_box_header_inline_css() {
$header_text_color = get_header_textcolor();
 $header_bgcolor = get_theme_mod('header_bgcolor');
 $content_bg_color = get_theme_mod('content_bg_color');
 $content_text_color = get_theme_mod('content_text_color');
 $link_color = get_theme_mod('link_color');
 $link_hover_color = get_theme_mod('link_hover_color');
 $feature_background_color = get_theme_mod('feature_background_color');
 $news_box_feature_show = get_theme_mod('news_box_feature_show');


	wp_enqueue_style(
		'news-box-custom-style',
		get_template_directory_uri() . '/assets/css/custom-style.css'
	);
    
        $style = '';
   
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		$style .= '.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}';
			
		
			// If the user has set a custom color for the text use that.
			else :
		$style .= '.site-title a,
			.site-description {
				color: #'.esc_attr( $header_text_color ).' ;
			}';
			
		 endif;

         
         if($header_bgcolor){ 
         	$style .= 'header.site-header{
                    background: '.esc_attr($header_bgcolor).';
                }';
         }
         if($content_bg_color){ 
         	$style .= '.site-header, .hentry, .comments-area, .site-main section, .site-main .post-navigation, .site-main .posts-navigation, .paging-navigation, .widget, .page-header, .content-area, .news-box-sidebar{
                    background: '.esc_attr($content_bg_color).';
                }';
         }
         if ($content_text_color) {
         	$style .= 'html body{
                    color: '.esc_attr($content_text_color).';
                }';
         }
         if ($link_color) {
         	$style .= 'body a{
                    color: '.esc_attr($link_color).';
                }';
         }
         if ($link_hover_color) {
            $style .= 'body a:hover{
                    color: '.esc_attr($link_hover_color).';
                }';
         }
         if ($feature_background_color) {
            $style .= 'body .header-feature-section{
                    background: '.esc_attr($feature_background_color).';
                }';
         }

         if ($news_box_feature_show) {
         	$style .= 'body .header-feature-section{
                    display: '.esc_attr($news_box_feature_show).';
                }';
         }


   
        wp_add_inline_style( 'news-box-custom-style', $style );
}
add_action( 'wp_enqueue_scripts', 'news_box_header_inline_css' );
endif;