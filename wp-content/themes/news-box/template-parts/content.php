<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News_Box
 */
$news_box_view_set = get_theme_mod('view_set')? get_theme_mod('view_set'): 'card-view';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $news_box_view_set ); ?>>
<?php 
	if ($news_box_view_set == 'card-view' && !is_single()):
		get_template_part( 'template-parts/post-card');
	else:
 ?>

	<?php if(has_post_thumbnail()): 

		get_template_part( 'template-parts/post-img');

	 else:
	 	get_template_part( 'template-parts/post-content');

	  endif;
 endif;

	   ?>

	
</article><!-- #post-<?php the_ID(); ?> -->
