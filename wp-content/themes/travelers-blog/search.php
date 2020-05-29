<?php
get_header(); ?>

	<section id="blog" class="blog-lists">

	    <div class="container">

		    <div class="row">

		    	<div class="<?php echo ( is_active_sidebar( 'sidebar-2' ) ? 'col-md-8' : 'col-md-10 col-sm-offset-0 col-md-offset-1 content-wrapper-no-sidebar content-wrapper-no-sidebar-search-page' ); ?>">		    		

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						echo '<div class="row" id="content">';
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'blog-rightsidebar' );

						endwhile;
						echo '</div>';

						travelers_blog_numbered_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>					

				</div>

				<div class="col-sm-4">
					<?php get_sidebar(); ?>
		    	</div>
								
			</div>

		</div>

	</section>

<?php
get_footer();
