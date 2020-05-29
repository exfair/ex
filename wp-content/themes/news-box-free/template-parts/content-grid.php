<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News_Box
 */
$news_box_free_view_set = get_theme_mod('view_set')? get_theme_mod('view_set'): 'card-view';
$news_box_free_categories_list = get_the_category_list( esc_html__( ' / ', 'news-box-free' ) );
?>
<div class="card-item col-lg-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card grid">
		<div class="ncard-img">
			<a href="<?php the_permalink(); ?>">
	   			 <?php the_post_thumbnail(); ?>
			</a>
		</div>
	    <div class="card-body">
	      <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	      <div class="text-muted card-pmeta">
	    	<?php
					news_box_posted_on();
					news_box_posted_by();
					?>
	    </div>
	      <p class="card-text"><?php the_excerpt(); ?></p>
	      <a href="<?php the_permalink(); ?>" class="btn btn-link rdbtn"><?php esc_html_e( 'Read More', 'news-box-free' ); ?></a>
	    </div>
	    <div class="card-footer">
	      <small class="text-muted card-meta">
					<i class="fa fa-folder"></i>
					<?php echo wp_kses_post( $news_box_free_categories_list ); ?>
			</small>
	    </div>

	  </div>
		
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
