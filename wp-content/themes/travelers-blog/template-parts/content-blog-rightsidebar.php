<div class="list-item">

    <div class="row">
			
		<?php

		$no_image_class = 'tb_no_image';

		if ( has_post_thumbnail() ) {

			$no_image_class = ''; ?>

			<?php 
			$imageID = get_post_thumbnail_id(); 
			$image = wp_get_attachment_image_src($imageID,'travelers_blog_medium'); ?>

			<div class="col-xs-4 list_image_wrapper">
				<div class="list-image">
					<a href="<?php the_permalink(); ?>" style="background-image:url(<?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?>)">
						<div class="image-overlay"></div>
					</a>
				</div>
			</div>

			<div class="col-xs-8">

			<?php 

		} else { ?> 

			<div class="col-sm-12"> 

			<?php 

		} ?>
				
			<div class="list-content <?php echo esc_attr( $no_image_class ); ?>">
				<h3>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>							
					</a>
				</h3>

				<?php travelers_blog_get_all_categories(); ?>
				
	    		<div class="post-content">
	    			<?php the_excerpt(); ?>			
	    		</div>

					<div class="author-detail">
	      			<?php travelers_blog_get_author_detail(); ?>     
	    		</div>

			</div> 
		</div>
	</div>                        
</div>