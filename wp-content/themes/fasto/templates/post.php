<?php
/**
 * Template for post
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<div class="col-desktop-<?php echo esc_attr( fasto_get_grid() ); ?> col-tablet-6 col-small-tablet-6 col-mobile-12">
	<article <?php post_class(); ?>>
		<?php fasto_post_thumb(); ?>
		<div class="post-details">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" class="article-title"><?php the_title(); ?></a></h2>
			<p><?php fasto_excerpt( 130 ); ?></p>
		</div>
		<div class="date-published">
			<span class="big"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
			<span class="small"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
		</div> 
	</article>
</div>