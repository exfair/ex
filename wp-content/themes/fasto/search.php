<?php
/**
 * Search template
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>

<div class="breadcrumb-navigation">
	<h1 class="page-title">
		<?php the_search_query(); ?>
	</h1>
<?php fasto_breadcrumb(); ?>
</div>

<div class="articles fasto-row"><!-- start .articles -->

<?php
if( have_posts() ) {
	while( have_posts() ) {
	the_post();
		get_template_part('templates/search'); 	
	}
	$fasto_pagination_args = array( 'prev_text' => __( '&laquo;','fasto' ), 'next_text' => __( '&raquo;','fasto' ) );
	the_posts_pagination( $fasto_pagination_args );
}//end if have_posts
else { ?>

<div id="search-no-result" class="top-info col-desktop-12 col-tablet-12 col-small-tablet-12 col-mobile-12"><!-- start .top-info-->
	<h2><?php echo esc_html__( 'Whoopsieee!','fasto' )?></h2>
	<h3><?php echo esc_html__( 'We didn\'t find any result for ','fasto' ).  get_search_query() ; ?></h3>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<button><?php echo esc_html__( 'Go to homepage','fasto' ) ?></button>
	</a>
</div><!-- end .top-info-->

<?php } ?>

</div><!-- end .articles-->

<?php get_footer(); ?>