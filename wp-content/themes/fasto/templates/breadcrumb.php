<?php
/**
 * Template for breadcrumb navigation
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<?php if ( !fasto_is_home_or_front() ) { ?> 
<div class="breadcrumb-navigation">
<?php if ( is_category() ) { ?>
<h1 class="page-title"><?php single_cat_title(); ?></h1>
<?php fasto_cat_breadcrumb(); ?>
<?php } ?>

<?php if ( is_author() ) { ?>
<div class="author-box"><!-- start .author-box -->
	<div class="author">
	<?php 
		echo fasto_author_avatar(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									// fasto_author_avatar() - uses get_avatar() - which is escaped in WordPress core
	?>
	</div>
<?php } ?>

<?php if ( is_tag() ) { ?>
<h1 class="page-title"><?php single_tag_title(); ?></h1>
<?php fasto_breadcrumb(); ?>
<?php } ?>

<?php } ?> 