<?php
get_header(); 
?>
 
<section id="blog" class="blog-lists blog-home"> 

    <div class="container">

	    <div class="row">

	    	<div class="<?php echo ( is_active_sidebar( 'sidebar-2' ) ? 'col-md-8' : 'col-md-10 col-sm-offset-0 col-md-offset-1 content-wrapper-no-sidebar' ); ?>">    		

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					$showHide = get_theme_mod('show_hide_slider' , '1');

					if( $showHide == '1' && class_exists( 'Kirki' ) ) :

						get_template_part('template-parts/posts/category-posts/listing-page','swiper');

					endif;
					
					echo '<div id="content" class="travelers_blog_home_listing_wrapper">';

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'blog-rightsidebar' );

						endwhile;

					echo '</div>';

					travelers_blog_numbered_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>					

			</div>

			<div class="col-md-4">
				<?php get_sidebar(); ?>
	    	</div>
		
		</div>

	</div>

</section>

<?php
get_footer();
