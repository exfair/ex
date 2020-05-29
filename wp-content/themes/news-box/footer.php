<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News_Box
 */
$footer_text = get_theme_mod('footer_text');
$footer_style = get_theme_mod('footer_style','center-view');
$newsbox__container = get_theme_mod( 'newsbox__container', 'container' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
		<div class="footer-top bg-dark">
			<div class="<?php echo esc_attr($newsbox__container); ?>">
				<div class="row">
					<?php dynamic_sidebar( 'footer-widget' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="footer-bottom">
			<div class="<?php echo esc_attr($newsbox__container); ?>">
				<div class="row">
					<?php if( $footer_style == 'center-view'): ?>
					<div class="col-sm-12">
						<div class="site-info">
			 			 <?php if($footer_text): ?>
						<p><?php echo wp_kses_post($footer_text); ?></p>
					<?php	endif;
							?>
							<div class="info-news-box">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'news-box' ) ); ?>">
								<?php
								/* translators: %s: CMS name, i.e. WordPress. */
								printf( esc_html__( 'Proudly powered by %s', 'news-box' ), 'WordPress' );
								?>
							</a>
							<span class="sep"> | </span>
								<?php
								/* translators: 1: Theme name, 2: Theme author. */
								printf( esc_html__( 'Theme: %1$s by %2$s.', 'news-box' ), 'news-box', '<a href="'.esc_url('https://wpthemespace.com/product/news-box/').'">'.esc_html__('wpthemespace.com', 'news-box').'</a>' );
								?>
							</div>
						</div><!-- .site-info -->
						<div class="footer-menu text-center">
								<?php
						        wp_nav_menu( array(
						            'theme_location' => 'footer-menu', // Defined when registering the menu
						            'menu_id'        => 'footer-menu',
						            'container'      => false,
						            'menu_class'     => 'menu-footer',
						            'fallback_cb'     => '__return_false',
						        ) );
						        ?>
							</div>
					</div>
					<?php else: ?>
						<div class="col-lg-6">
							<div class="site-info text-left">
			 			 <?php if($footer_text): ?>
						<p><?php echo wp_kses_post($footer_text); ?></p>
					<?php	endif;
							?>
							<div class="info-news-box">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'news-box' ) ); ?>">
								<?php
								/* translators: %s: CMS name, i.e. WordPress. */
								printf( esc_html__( 'Proudly powered by %s', 'news-box' ), 'WordPress' );
								?>
							</a>
							<span class="sep"> | </span>
								<?php
								/* translators: 1: Theme name, 2: Theme author. */
								printf( esc_html__( 'Theme: %1$s by %2$s', 'news-box' ), 'news-box', '<a href="'.esc_url('https://wpthemespace.com/product/news-box/').'">'.esc_html__('wpthemespace.com', 'news-box').'</a>' );
								?>
							</div>
						</div><!-- .site-info -->
						</div>
						<div class="col-lg-6">
							<div class="footer-menu text-right">
								<?php
						        wp_nav_menu( array(
						            'theme_location' => 'footer-menu', // Defined when registering the menu
						            'menu_id'        => 'footer-menu',
						            'container'      => false,
						            'menu_class'     => 'menu-footer',
						            'fallback_cb'     => '__return_false',
						        ) );
						        ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
