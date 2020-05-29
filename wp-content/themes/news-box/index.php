<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News_Box
 */
if ( is_active_sidebar( 'sidebar-1' ) ) {
	$news_box_grid_number = 9 ;
}else{
	$news_box_grid_number = 12 ;
}
get_header();
$newsbox__container = get_theme_mod( 'newsbox__container', 'container' );
?>
<div class="<?php echo esc_attr($newsbox__container); ?>">
	<div class="row">
		<div class="col-lg-<?php echo esc_attr( $news_box_grid_number ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'news-box' ),
				'next_text'          => __( 'Next page', 'news-box' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'news-box' ) . ' </span>',
			) );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
				</main><!-- #main -->
			</div><!-- #primary -->	
		</div>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ): ?>
		<div class="col-lg-3">
			<div class="news-box-sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
</div>

<?php
get_footer();
