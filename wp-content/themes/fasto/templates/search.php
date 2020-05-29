<?php
/**
 * Template for article on search page
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<div class="col-desktop-4 col-tablet-6 col-small-tablet-6 col-mobile-12">
		<article <?php post_class(); ?>>
		<?php fasto_post_thumb(); ?>
		<div class="post-details">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
	</article>
</div>