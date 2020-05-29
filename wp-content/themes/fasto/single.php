<?php
/**
 * Template for single post
 *
 * @package Fasto
 * @author fribba
 *
 */
get_header();

//layout
$fasto_layout = fasto_mod( 'fasto_blog_single_layout' );

$fasto_articles_grid = '';
if ( $fasto_layout == 'sidebar' ){
	$fasto_articles_grid = ' col-desktop-8 col-tablet-12 col-small-tablet-12 col-mobile-12 padding-right-30';
}

?>

<?php if ( $fasto_layout == 'sidebar'  ) {  ?> <div class="fasto-row"><!-- start .fasto-row --> <?php }  ?>

<div class="article-single <?php echo esc_attr( $fasto_articles_grid ); ?>"><!-- start .article-single -->

<?php
if( have_posts() ) {
	while( have_posts() ) {
		the_post(); ?>

<?php fasto_post_thumb( false,  true , false , false , false ); fasto_categories( $post->ID ); ?>
<?php fasto_cat_breadcrumb(); ?>

<div class="separator single"></div>

<div class="post-content">
	<?php if ( fasto_mod( 'fasto_enable_social_share' ) == '1' ){ fasto_output_social_share(); } ?>
	<div class="post-content-inner">
		<?php the_content(); ?>
	</div>
	<?php 
		$fasto_pagination_args = array(
			'before'           => '<div class="pagination"><ul>',
			'after'            => '</ul></div>',
			'link_before'      => '<li>',
			'link_after'       => '</li>',
		);
		wp_link_pages( $fasto_pagination_args ); 	
	?>
	<?php if ( fasto_mod( 'fasto_enable_social_share_after' ) == '1' ){ ?>
	<div class="after-post">
		<?php fasto_output_social_share(); ?>
	</div>
	<?php } ?>
</div>

<?php if ( has_tag() ) { ?>
<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
<?php if ( comments_open() ) { ?><div class="separator single"></div><?php } ?>
<?php }  ?>
<div class="separator single"></div>
<?php get_template_part( 'templates/adjacent-posts' ); ?>
<div class="separator single"></div>

<?php
	}
	// end while have_posts
	
	//comments
	comments_template();
}
//end if have_posts 
?>

</div><!-- end .article-single-->

<?php if ( $fasto_layout == 'sidebar' ) { ?>
<div id="sidebar" class="col-desktop-4 col-tablet-12 col-small-tablet-12 col-mobile-12">
	<?php do_action('fasto_before_sidebar'); ?>
	<?php dynamic_sidebar('sidebar'); ?>
	<?php do_action('fasto_after_sidebar'); ?>
</div>
</div><!-- end .fasto-row -->
<?php } ?>

<div class="separator single big"></div>

<div class="related-articles"><!-- start .related-articles -->
	<h2 class="title"><?php echo esc_html__( 'You might also like','fasto' );  ?></h2>
	<div class="fasto-row">
	<?php
	$fasto_cat = get_the_category( $post->ID );
	$fasto_args = array( 'post_type' => array( 'post' ),'posts_per_page' => 3, 'post__not_in' => array( $post->ID ) , 'cat' => $fasto_cat[0]->term_id );
	$fasto_query = new WP_Query( $fasto_args );
	if( $fasto_query->have_posts() ) {
		while( $fasto_query->have_posts() ) {
			$fasto_query->the_post();
				get_template_part( 'templates/post' );
		}
		wp_reset_postdata();
	} ?>
	</div>
</div><!-- end .related-articles -->
<?php get_footer(); ?>