<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package News_Box
 */

get_header();
$newsbox__container = get_theme_mod( 'newsbox__container', 'container' );
?>
<div class="<?php echo esc_attr($newsbox__container); ?>">
	<div class="row">
		<div class="col-md-12">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'news-box' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-icon">
					<i class="fa fa-times-rectangle"></i>
				</div>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'news-box' ); ?></p>

					<?php
					get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

				</main><!-- #main -->
			</div><!-- #primary -->	
		</div>
	</div>
</div>

<?php
get_footer();

