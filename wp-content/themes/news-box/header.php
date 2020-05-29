<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Box
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	if(function_exists('wp_body_open')){
		wp_body_open();
	} 
	$newsbox__container = get_theme_mod( 'newsbox__container', 'container' );
	$news_box_date_show = get_theme_mod( 'news_box_date_show', 1 );

	 ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'news-box' ); ?></a>

	<header id="masthead" class="site-header">
		<?php if ( get_header_image() ) : ?>
		<div class="header-banner">
			<?php the_header_image_tag(); ?>
		</div>
		<?php endif; ?>
		<div class="header-top bg-dark">
			<div class="<?php echo esc_attr($newsbox__container); ?>">
				<div class="row">
					
					<div class="col-md-2 time-column">
						<div class="date-time time-show">
							<?php if($news_box_date_show): ?>
							<ul>
								<li><span class="time"><i class="fa fa-time"></i><?php echo esc_html( date_i18n( get_option( 'time_format' ) )); ?></li>
								<li><span class="time"><?php echo esc_html(date_i18n('l')); ?></span></li>
								<li><span class="date"><i class="fa fa-date"></i><?php echo esc_html(date_i18n( get_option( 'date_format' )) ); ?></span></li>
							</ul>
							<?php endif; ?>
						</div>
					</div>
				
					<div class="col-md-9">
						<nav class="navbar navbar-expand-lg">
						    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'news-box' ); ?>">
						        <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
						    </button>
						    <div class="collapse navbar-collapse" id="navbar-content">
						        <?php
						        wp_nav_menu( array(
						            'theme_location' => 'menu-1', // Defined when registering the menu
						            'menu_id'        => 'primary-menu',
						            'container'      => false,
						            'depth'          => 2,
						            'menu_class'     => 'navbar-nav ml-auto',
						            'fallback_cb'     => '__return_false',
						            'walker'         => new Bootstrap_NavWalker()
						        ) );
						        ?>
						    </div>
						</nav>	
					</div>
					<div class="col-md-1">
						<div class="header-search">
							<div class="search-icon"><i class="fa fa-search"></i></div>
							<div class="header-search-form">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-middle"> 
			<div class="<?php echo esc_attr($newsbox__container); ?>">
				<div class="row">
					<div class="col-md-4">
						<div class="site-branding">
							<?php
							$news_box_logo_off = 'logo-off';
							$news_box_logo_des = '';
							if(function_exists( 'the_custom_logo' ) && has_custom_logo()):
								$news_box_logo_off = '';
								$news_box_logo_des = 'logo-desc';
								the_custom_logo();
							else:
							?>
							<h1 class="site-title <?php echo esc_attr($news_box_logo_off); ?>"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></h1>
							<?php
							endif;
							$news_box_description = get_bloginfo( 'description', 'display' );
								if ( $news_box_description || is_customize_preview() ) :
							?>
								<p class="site-description <?php echo esc_attr($news_box_logo_des); ?>"><?php echo esc_html($news_box_description); /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
					<div class="col-md-8">
						<?php 
						if ( is_active_sidebar( 'header-banner' ) ) {
							dynamic_sidebar( 'header-banner' );
						}
						 ?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom latest-news-bar">
			<div class="<?php echo esc_attr($newsbox__container); ?>">
				<div class="row">
					<div class="col-sm-2">
						<div class="news-latest"> 
							<?php esc_html_e( 'Latest News','news-box' ); ?>
						</div>	
					</div>
					<div class="col-sm-10">
						<div class="news-update holder"> 
							<?php
								$news_update_args = array(
									'post_type'  		=>	'post',
									'post_status'  		=>	'publish',
									'posts_per_page' 	=> 5,
									'tax_query' 	    =>	'',
								);
								$news_update_loop= new WP_Query($news_update_args);
								Global $post;
							while ( $news_update_loop->have_posts()) :  $news_update_loop->the_post();?>
							<div> <?php the_title(); ?>&nbsp; | &nbsp;</div>
							<?php endwhile;
							 wp_reset_postdata(); ?>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php 
$news_box_feature_show = get_theme_mod('news_box_feature_show')? get_theme_mod('news_box_feature_show'): 'block';
if(is_home() && $news_box_feature_show == 'block'): ?>
	<section class="header-feature-section">
			<?php get_template_part('template-parts/common/feature-post'); ?>
	</section>
	<?php endif; ?>
	<div id="content" class="site-content">


