<?php 
//check terms
$news_box_feature_cat = get_theme_mod('news_box_feature_cat')? get_theme_mod('news_box_feature_cat'): 'all';

	if($news_box_feature_cat == 'all'){
		$terms ='';
		}
	else{
		$terms = array(
			array(
				'taxonomy'  => 'category',
				'field'  => 'slug',
				'terms'  => $news_box_feature_cat
			)
		);
	}
	$news_box_feature_loop= new WP_Query(array(
		'post_type'  		=>	'post',
		'post_status'  		=>	'publish',
		'ignore_sticky_posts'=>	1,
		'posts_per_page' 	=> '3',
		'tax_query' 	    =>	$terms,
	));
	$newsbox_feature_container = get_theme_mod( 'newsbox_feature_container', 'container' )
?>

<div class="<?php echo esc_attr($newsbox_feature_container); ?>">
	<div class="feature-items">
		<?php 
		$i = 0;
while ($news_box_feature_loop->have_posts()):
    $news_box_feature_loop->the_post();
    $categories = get_the_category();
    $category = $categories[mt_rand(0,count($categories)-1)];
     $i++;
		 ?>
		<div class="feature-width">
			<div class="<?php if($i == 1): ?>feature-big <?php else: ?>feature-small <?php endif; ?>feature-item">
				<?php if(has_post_thumbnail()): ?>
				<div class="feature-img">
					<?php the_post_thumbnail('large') ?>
				</div>
				<?php else: ?>
					<div class="no-img"></div>
				<?php endif; ?>
				<div class="feature-txt">
					<a href="<?php echo get_category_link($category); ?>" class="badge badge-light mb-2 feature-cat"><?php echo $category->name; ?></a>
					<h2><?php the_title(); ?></h2>
					<a href="<?php the_permalink(); ?>" class="btn btn-outline-light"><?php esc_html_e( 'Full story', 'news-box'); ?></a>
				</div>	
			</div>
		</div>
	<?php endwhile; 
		wp_reset_query();
	?>

		</div>
	</div>
</div>