<?php
/**
 * 404 page
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>

<div id="page-404"><!-- start #404-page-->
	<h1><?php echo esc_html__( 'Oh boy...','fasto' )?></h1>
	<h3><?php echo esc_html__( 'The page you are looking for seems to be missing.','fasto' ); ?></h3>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<button><?php echo esc_html__( 'Go to homepage','fasto' ) ?></button>
	</a>
</div><!-- end #404-page-->

<?php get_footer(); ?>