	
	<div class="content-img">
		<?php news_box_post_thumbnail('news-box-post-thumb'); ?>
	</div>
	<div class="img-content">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h2 class="entry-title">', '</h2>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					news_box_posted_on();
					news_box_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php
		if (is_single()) {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'news-box' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
		}else{
			the_excerpt();
		}

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'news-box' ),
			'after'  => '</div>',
		) );
		?>
		<footer class="entry-footer">
		<?php news_box_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content -->