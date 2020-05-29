

<div class="card flex-md-row mb-4 box-shadow h-md-250">
	
		<?php 
		if (has_post_thumbnail()) {
		the_post_thumbnail('medium', array('class' => 'card-img-left flex-auto post-card-img'));
		}
		 ?>

            <div class="card-body d-flex flex-column align-items-start">
              <?php
			if ( is_singular() ) :
				the_title( '<h3 class="text-dark">', '</h3>' );
			else :
				the_title( '<h3><a class="text-dark" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
			?>
              
              <div class="mb-1 text-muted">
					<?php
					news_box_posted_on();
					news_box_posted_by();
					?>
              </div>
              <div class="card-text mb-auto">
              	<p><?php echo wp_kses_post(wp_trim_words(get_the_content(),35,' ....')); ?></p>
				
              </div>
              <a class="badge badge-dark mb-4 card-btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue reading','news-box' ) ?></a>
              <footer class="entry-footer">
		<?php news_box_entry_footer(); ?>
		</footer><!-- .entry-footer -->
            </div>
	</div>