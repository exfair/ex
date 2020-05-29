<?php
/**
 * Page template
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<div class="breadcrumb-navigation">
	<h1 class="page-title" id="content"><?php the_title(); ?></h1>
	<?php fasto_breadcrumb(); ?>
</div>
<div class="page-content" id="content" role="main">
<?php the_post_thumbnail(); the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="pagination"><ul>' . esc_html__( 'Pages:', 'fasto' ),'after'  => '</ul></div>',));?>
<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif;?>
<?php endwhile; ?>
<?php else: ?>
<article>
<h2><?php esc_html_e( 'Sorry, nothing to display.', 'fasto' ); ?></h2>
</article>
<?php endif; ?>
</div>
<?php get_footer(); ?>