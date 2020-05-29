<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php

$body_id = travelers_blog_get_body_id(); ?>

<body id="<?php echo esc_attr($body_id); ?>" <?php body_class(); ?>>

	<?php 
	do_action( 'travelers_blog_after_body' );

	if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
            do_action( 'wp_body_open' );
        }
	}
	?>

	<header id="masthead">

		<a class="screen-reader-text skip-link skip_to_content" href="#content">
			<?php esc_attr_e( 'Skip to content', 'travelers-blog' ); ?>
		</a>

		<?php 
		do_action('travelers_blog_top_bar'); 
		$tagline_status = get_theme_mod( 'hide_tagline_status', false );
		?>

	    <nav class="navbar navbar-default with-slicknav">
	        <div id="navbar" class="collapse navbar-collapse navbar-arrow has-no-menu-description">
	            <div class="container">
	            	<div class="logo pull-left <?php echo ( $tagline_status ? 'no_tagline' : '' ); ?>">
	                	<a href="<?php echo esc_url( home_url('/') ); ?>">

	                		<?php 
	                		if ( has_custom_logo() ) { ?>
	                    		<img src="<?php echo esc_url( travelers_blog_get_custom_logo_link() ); ?>" alt="<?php esc_attr__( 'Logo', 'travelers-blog' ) ?>" class="site_logo">
	                    	
	                    		<?php 
	                    	} else {
	                    		echo '<h3>' . esc_html( get_bloginfo( 'name' ) ) . '</h3>';
	                    		if( !$tagline_status ){
	                    			echo '<p>' . esc_html( get_bloginfo( 'description' ) ) . '</p>';	
	                    		}	                    		
	                    	} ?>

	                	</a>
	            	</div>

	                <?php 	                
	           
                	wp_nav_menu( array(
					    'theme_location' => 'menu-1',
					    'menu_class'=>'nav navbar-nav pull-right',
					    'container' => 'ul',
					    'menu_id' => 'responsive-menu',
					    'link_before' => '<span class="eb_menu_title">',
					    'link_after' => '</span>'
					) );			
	                	                
	                ?>

	            </div>

	        </div><!--/.nav-collapse -->

	        <div id="slicknav-mobile" class="<?php echo ( !has_custom_logo() ? 'text-logo' : '' ); ?>"></div>

	    </nav> 
	</header><!-- header section end -->

	<?php 

	global $template; // For elementor
	if( !is_home() && 
		!is_single() && 
		!is_404() && 
		!is_front_page()
	){
		if( basename($template) != 'header-footer.php' ){
			travelers_blog_breadcrumb();
		}
	}