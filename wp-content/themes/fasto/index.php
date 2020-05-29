<?php
/**
 * The main template file. It is required in all themes.
 * Learn more: https://developer.wordpress.org/themes/basics/template-files/
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>

<?php get_template_part( 'templates/breadcrumb' ); ?>

<?php $fasto_articles_grid = $fasto_row_articles = '';
if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-3' || fasto_mod( 'fasto_blog_layout' ) == 'grid-4' ){
	$fasto_row_articles = ' fasto-row ';
}
if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' || fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ){
	$fasto_articles_grid = ' col-desktop-8 col-tablet-12 col-small-tablet-12 col-mobile-12 padding-left-0  padding-right-15 padding-right-tablet-0 padding-left-tablet-0 padding-right-mobile-0 padding-left-mobile-0';
}
?>
<?php if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' || fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ) {  ?> <div class="fasto-row"><!-- start .fasto-row --> <?php }  ?>

<div class="articles <?php echo esc_attr( $fasto_row_articles ); echo esc_attr( fasto_mod( 'fasto_blog_layout' ) ); echo esc_attr( $fasto_articles_grid ); ?>" id="content"><!-- start .articles -->

<?php if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' || fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ) {  ?> <div class="fasto-inner-row"><!-- start .fasto-inner-row --> <?php }  ?>

<?php fasto_the_loop(); ?>

<?php if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' || fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ) {  ?> </div><!-- end .fasto-inner-row --> <?php }  ?>

</div><!-- end .articles-->

<?php if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' || fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ) { ?>
<?php get_template_part( 'sidebar' ); ?>
</div><!-- end .fasto-row -->
<?php } ?>

<?php get_footer(); ?>