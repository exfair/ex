<?php
/**
 * The attachment template
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>
<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
<div class="entry-attachment">
	<h1 class="article-title"><?php the_title(); ?></h1>
	<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
		<?php if ( has_excerpt() ) : ?>
           <div class="entry-caption">
                 <?php the_excerpt(); ?>
           </div><!-- .entry-caption -->
       <?php endif; ?>
</div><!-- .entry-attachment -->
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>