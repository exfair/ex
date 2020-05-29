<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h2 class="search-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s ', 'news-box' ),  get_search_query());
					?>
				</h2>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content' );

			endwhile;

			the_posts_navigation();

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
