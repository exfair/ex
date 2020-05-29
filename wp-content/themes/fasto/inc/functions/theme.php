<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
=================================================================================================================
fasto_default() - Retrieve default option
=================================================================================================================
*/
function fasto_default( $theme_mod = '' ) {
	$defaults = array(
		
		'fasto_primary_color' => '#ff7c34',
		'fasto_secondary_color' => '#8BC34A',
		'fasto_body_color' => '#5c6279',
		'fasto_headings_color' => '#0e1638',
		'fasto_category_color' => '#ff7c34',
		'fasto_footer_color' => '#000000',
		
		'fasto_blog_layout' => 'grid-3',
		'fasto_blog_single_layout' => 'sidebar',
		'fasto_blog_single_thumb' => 'crop',
		'fasto_enable_social_share' => '0',
		'fasto_enable_social_share_after' => '1',
		
		'fasto_heading_font' => 'roboto',
		'fasto_heading_font_w' => '700',
		'fasto_body_font' => 'roboto',
		'fasto_body_font_w' => '400',
		
		'fasto_facebook' => '',
		'fasto_twitter' => '',
		'fasto_youtube' => '',
		'fasto_linkedin' => '',
		'fasto_pinterest' => '',
		'fasto_dribbble' => '',
		'fasto_instagram' => '',
		'fasto_behance' => '',
		
		'fasto_lazy_load' => '0',
		'fasto_inline_css' => '0',
		
		'fasto_user_copyright' => esc_html__( 'Copyright &copy;','fasto' ) . esc_html( date('Y') ). ' <a href="'.esc_url( get_site_url() ).'"> ' . esc_html( get_bloginfo( 'name' ) ) . ' - ' . esc_html( get_bloginfo( 'description' ) ) . ' </a>',
		'fasto_developer_credit' => '1',
		
		'fasto_shop_layout' => 'grid-3',
		'fasto_shop_per_page' => 9,
	);
	return ( isset ( $defaults[$theme_mod] ) ? $defaults[$theme_mod] : '' );
}

/*
=================================================================================================================
fasto_mod() - Get theme mod, or default if not set
=================================================================================================================
*/
function fasto_mod( $theme_mod = '' ) {
	return get_theme_mod( $theme_mod, fasto_default( $theme_mod ) );
}


/*
=================================================================================================================
fasto_header_text_customizer() - Site title and description for customizer
=================================================================================================================
*/
function fasto_header_text_customizer() {
	$header_text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	} ?>
	<style type="text/css">
	<?php
	if ( ! display_header_text() ) : ?>
		.site-title a,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php else : ?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/*
=================================================================================================================
fasto_get_grid - Get the grid
=================================================================================================================
*/
 
function fasto_get_grid( $real = false ){
	if ( is_single() ){
		return '4';
	}
	if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-4' ){
		if ( $real ){
			return '4';
		}
		return '3';
	}	
	elseif ( fasto_mod( 'fasto_blog_layout' ) == 'grid-3' ){
		if ( $real ){
			return '3';
		}
		return '4';
	}	
	elseif ( fasto_mod( 'fasto_blog_layout' ) == 'grid-2' ){
		if ( $real ){
			return '2';
		}
		return '6';
	}	
	else{
		if ( $real ){
			return '1';
		}
		return '12';
	}
}

/*
=================================================================================================================
fasto_get_thumb_size - Determine thumb size
=================================================================================================================
*/
 
function fasto_get_thumb_size(){
	if ( fasto_mod( 'fasto_blog_layout' ) == 'grid-1' ){
		return 'fasto-blog-classic';
	}		
	else{
		return 'fasto-grid';
	}
}

/*
=================================================================================================================
fasto_get_single_thumb_size - Determine thumb size for single
=================================================================================================================
*/
 
function fasto_get_single_thumb_size(){

	$thumb  = fasto_mod( 'fasto_blog_single_thumb' );
	$layout = fasto_mod( 'fasto_blog_single_layout' );
	
	if ( $thumb == 'original' ){
		return 'full';
	}
	
	if ( $layout == 'sidebar' ){
		return 'fasto-blog-classic';
	}		
	else{
		return 'fasto-full-single';
	}
}

/*
=================================================================================================================
fasto_post_thumb - output post thumb / video / audio html
=================================================================================================================
*/
function fasto_post_thumb( $is_loop = true,  $is_single = false , $is_widget = false , $show_details = true , $echo_link = true ){
	
	$post_format = get_post_format();
	$post_type = get_post_type();
	
	//get size
	if ( $is_widget == true ){
		$size = 'fasto-widget';
	}
	if ( $is_single == true ){
		$size = fasto_get_single_thumb_size();
	}
	if ( $is_loop == true ){
		$size = fasto_get_thumb_size();
	}
	
	//get grid
	if ( $is_widget == true ){
		$grid = 'widget';
	}
	if ( $is_single == true ){
		$layout = fasto_mod( 'fasto_blog_single_layout' );
		$grid = $layout == 'sidebar' ? '1' : 'full-single';
	}
	if ( $is_loop == true ){
		$grid = fasto_get_grid(1);
	}
	/**
	 * Standard post format
	 *
	 */
	if ( $post_format  ==  false ) { 
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( get_the_ID() , $size );
			$alt_title = get_post( get_post_thumbnail_id() )->post_excerpt ? get_post( get_post_thumbnail_id() )->post_excerpt : get_post( get_post_thumbnail_id() )->post_title;
	?>
	
		<div class="post-thumb">
			<?php if ( $show_details ) { ?>
			<div class="post-category secondary-font">
				<?php fasto_first_cat_link(); ?>
			</div>
			<?php } ?>
			<?php if ( $post_type == 'page' ) { ?>
			<div class="post-category secondary-font">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="category-link page-link"><?php echo esc_html( $post_type ); ?></a>
			</div>
			<?php } ?>			
			<?php if ( $echo_link ) { ?><a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php } ?>
			<?php if ( fasto_mod( 'fasto_lazy_load' )  == '1' ) { ?>
				<img class="cover-image lazyload" src="<?php echo esc_url( FASTO_URI.'/images/placeholder-'.esc_attr( $grid ).'.png' ); ?>" alt="<?php echo esc_attr( $alt_title ); ?>" data-src="<?php echo esc_url( $image ); ?>">
			<?php } else { ?>
				<img class="cover-image visible" src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( $alt_title ); ?>">
			<?php } ?>
			<?php if ( $echo_link ) { ?></a><?php } ?>
		</div>
	
<?php 
		}
		
		//default thumb
		else{ ?>
		<?php if ( $echo_link ) { ?>
		<div class="post-thumb">
			<?php if ( $show_details ) { ?>
			<div class="post-category secondary-font">
				<?php fasto_first_cat_link(); ?>
			</div>
			<?php } ?>			
			<?php if ( $post_type == 'page' ) { ?>
			<div class="post-category secondary-font">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="category-link page-link"><?php echo esc_html( $post_type ); ?></a>
			</div>
			<?php } ?>
			<a href="<?php echo esc_url( get_the_permalink() ) ?>" class="">
				<img src="<?php echo esc_url( FASTO_URI.'/images/placeholder-'.esc_attr( $grid ).'.png' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
			</a>
		</div>
		<?php } ?>
<?php		}
		
	} // END Standard post format
	
	/**
	 * Any other post format
	 *
	 */		
		else{  ?>
		<?php if ( $echo_link ) { ?>
		<div class="post-thumb">
			<?php if ( $show_details ) { ?>
			<div class="post-category secondary-font">
				<?php fasto_first_cat_link(); ?>
			</div>
			<?php } ?>
			<a href="<?php echo esc_url( get_the_permalink() ) ?>" class="">
				<img src="<?php echo esc_url( FASTO_URI.'/images/placeholder-'.esc_attr( $grid ).'.png' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
			</a>
		</div>
		<?php } ?>
<?php		}

	
} // END fasto_post_thumb()


/*
=================================================================================================================
fasto_first_cat_link - Get url of first category of a post
=================================================================================================================
*/
function fasto_first_cat_link(){
	$category = get_the_category();
	
	if ( empty ( $category ) ){
		return false;
	}

	$count_cat = count( $category );
	
	if ( $count_cat > 1 ){
		echo '<a class="category-link bg-cat-'.esc_attr( $category[0]->slug ).'" href="'. esc_url( get_category_link( $category[0]->term_id ) ) .'"> <span>'. esc_html( $category[0]->name ) .'</span></a>'; 				
		echo '<a class="category-link bg-cat-'.esc_attr( $category[1]->slug ).'" href="'. esc_url( get_category_link( $category[1]->term_id ) ) .'"> <span>'. esc_html( $category[1]->name ) .'</span></a>'; 				
	}
	else{
		echo '<a class="category-link bg-cat-'.esc_attr( $category[0]->slug ).'" href="'. esc_url( get_category_link( $category[0]->term_id ) ) .'"> <span>'. esc_html( $category[0]->name ) .'</span></a>'; 
	}
}

/*
=================================================================================================================
fasto_categories - Add custom link class to post categories and output them
=================================================================================================================
*/
function fasto_categories( $id ){
	$categories = get_the_category( $id );
	echo '<div class="post-category single secondary-font" id="content">';
	foreach ( $categories as $category ){
		$url = get_category_link( $category->term_id );
		echo '<a class="category-link" href="'. esc_url( $url ) .'"> '. esc_html( $category->name ) .'</span></a>';
	}
	echo '</div>';
}


/*
=================================================================================================================
fasto_output_social - Output social
=================================================================================================================
*/
 
function fasto_output_social(){
	$socials = array( 
		'fasto_facebook' => 'facebook',
		'fasto_twitter' => 'twitter',
		'fasto_youtube' => 'youtube',
		'fasto_linkedin' => 'linkedin',
		'fasto_pinterest' => 'pinterest',
		'fasto_dribbble' => 'dribbble',
		'fasto_instagram' => 'instagram',
		'fasto_behance' => 'behance',
	);
	
	foreach ( $socials as $key => $value ){
		$get_social = fasto_mod( $key );
		if ( !empty( $get_social ) ){
				echo '<li><a href="'.esc_url( $get_social ).'" aria-label="'.esc_attr( $key ).'" target="_blank">'. fasto_brands_svg(  $value  , false ).'</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				// fasto_brands_svg() - safely escaped in functions/svg-brands.php 
		}
	}		
}


/*
=================================================================================================================
fasto_author_avatar - Get author avatar
=================================================================================================================
*/
function fasto_author_avatar(){
	$author_id = get_the_author_meta('ID'); 
	$avatar = get_avatar( $author_id );  
	return get_avatar( $author_id, 80 , '', get_the_author_meta('nickname')  );
}

/*
=================================================================================================================
fasto_author_info - Get author info
=================================================================================================================
*/
function fasto_author_info( $value ){
	$user_id = get_the_author_meta('ID');
	$get_user_meta = get_user_meta( $user_id );
	return $get_user_meta[$value][0];
}

/*
=================================================================================================================
fasto_body_class - Add custom body class
=================================================================================================================
*/
add_filter( 'body_class', 'fasto_body_class' );
function fasto_body_class( $classes ) {
    
	$layout = fasto_mod( 'fasto_blog_layout' );		
	$single_layout = fasto_mod( 'fasto_blog_single_layout' );	
	$woo_layout = fasto_mod( 'fasto_shop_layout' );	
	
	if ( ( $layout == 'grid-1' || $layout == 'grid-2' ) && ( is_home() || is_category() || is_archive() || is_day() || is_month() || is_year() || is_tag() || is_author() ) ) {
        $classes[] = 'has-sidebar';
    }
	if ( $single_layout == 'sidebar' && is_singular('post') ){
		$classes[] = 'has-sidebar';
	}	
	if ( $single_layout == 'full' && is_singular('post') ){
		$classes[] = 'full';
	}
	if ( class_exists ( 'WooCommerce' ) && is_shop() && ( $woo_layout == 'grid-2-sidebar'  || $woo_layout == 'grid-3-sidebar' ) ){
		 $classes[] = 'has-sidebar';
	}
    return $classes;
}

/*
=================================================================================================================
fasto_enable_threaded_comments() - Threaded Comments
=================================================================================================================
*/
function fasto_enable_threaded_comments(){
	if ( !is_admin() ) {
		if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action( 'get_header', 'fasto_enable_threaded_comments');

/*
=================================================================================================================
fasto_get_the_post_id() - Return the post/page id inside or outside the loop
=================================================================================================================
*/
function fasto_get_the_post_id() {
  if ( in_the_loop() ) {
       $post_id = get_the_ID();
  } else {
       global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
         }
  return $post_id;
}


/*
=================================================================================================================
fasto_build_cat_itemprop() - Build category breacrumbs
=================================================================================================================
*/
function fasto_build_cat_itemprop() {
    $breadcrumbs = array();
    $category_count = 0;
    $parent_arrive = 0;
	
	//return early if attachemnt
	if ( is_attachment() ){ return false; }
	
	if (is_single()) {
        $post_data = get_queried_object();
        $breadcrumbs[$category_count]['id'] = $post_data->ID;
        $breadcrumbs[$category_count]['name'] = $post_data->post_title;
        $category_count++;
        $current_category = get_the_category();
        $current_category_id = $current_category[0]->term_id;
        $category = get_category($current_category_id);
    } else {
        $category = get_category(get_query_var('cat'));
    }
    $breadcrumbs[$category_count]['id'] = $category->term_id;
    $breadcrumbs[$category_count]['name'] = $category->name;
    $category_count++;
    while( $parent_arrive == 0 ) {
        if ($category->category_parent == 0) {
          $parent_arrive = 1;
        } else {
          $breadcrumbs[$category_count]['id'] = $category->category_parent;
          $category = get_category($category->category_parent);
          $breadcrumbs[$category_count]['name'] = $category->name;
        }
      $category_count++;
    }
    $breadcrumbs = array_reverse($breadcrumbs);
    return $breadcrumbs;
}

/*
=================================================================================================================
fasto_cat_breadcrumb() - Output category breacrumbs itemprop
=================================================================================================================
*/
function fasto_cat_breadcrumb(){
	//return early if attachemnt
	if ( is_attachment() ){ return false; }
	
	$breadcrumbs = fasto_build_cat_itemprop(); ?>
<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb theme">
	  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
      <a itemprop="item" href="<?php echo esc_url( site_url() ); ?>">
        <span itemprop="name"><?php echo esc_html__( 'Home','fasto' ); ?></span>
      </a>
		  <meta itemprop="position" content="1" />
		</li>
		<li>&nbsp;&nbsp;&#187;&nbsp;&nbsp;</li>
	
	<?php 
	if ( is_single() ) { array_pop( $breadcrumbs ); } 
	$page_nr = get_query_var('paged') > 0 ?  get_query_var('paged') : '';
	$page_nr_title = get_query_var('paged') > 0 ?  __( ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; Page ','fasto' ) : '';  
	?>
	
    <?php
	$counter = 1;
	foreach ( $breadcrumbs as $breadcrumb_index => $breadcrumb ) { ?>
	 <?php if ( $counter > 1 ) { ?>
		<li>&nbsp;&nbsp;&#187;&nbsp;&nbsp;</li>
	 <?php } $counter++; ?>	       
	  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url( get_category_link($breadcrumb['id'] ) ); ?>">
          <span itemprop="name"><?php echo esc_html( $breadcrumb['name'] ); ?></span>
        </a>
        <meta itemprop="position" content="<?php echo esc_attr( $breadcrumb_index ) + 2; ?>" />
		<?php echo esc_html( $page_nr_title ) ; echo esc_html( $page_nr ); ?>
      </li>
<?php   } ?>
		<?php if ( is_single() ){ ?>
		  <li>
			&nbsp;&nbsp;&#187;&nbsp;&nbsp;<?php the_title(); ?>
		  </li>		
	<?php	} ?>
</ul>

<?php }



/*
=================================================================================================================
fasto_output_social_share() - Output social share
=================================================================================================================
*/
function fasto_output_social_share(){
global $post;
//post thumbnail
$post_thumbnail_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-single' );
$post_thumbnail = $post_thumbnail_arr[0];
$args = array( 'echo' => false );
?>
<div class="social-share-holder">
<ul class="social-share"><!-- social-share -->			
	<li>
		<a target="_blank" data-post-id="<?php echo esc_attr( $post->ID );?>" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u='.urlencode( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Share article to Facebook','fasto' ); ?>" class="facebook">
			<?php fasto_brands_svg( 'facebook',true ) ; # fasto_brands_svg() - safely escaped in functions/theme.php ?>
		</a>
	</li>
			
	<li>
		<a target="_blank" data-post-id="<?php echo esc_attr( $post->ID );?>" href="<?php echo esc_url( 'https://twitter.com/intent/tweet?text='.urlencode( the_title_attribute( $args ) ).'&amp;url='.urlencode( get_permalink() ) ); ?>" aria-label="<?php esc_attr_e( 'Share article to Twitter','fasto' ); ?>" class="twitter">
			<?php fasto_brands_svg( 'twitter',true ) ; # fasto_brands_svg() - safely escaped in functions/theme.php ?>
		</a>
	</li>
			
	<li>
		<a target="_blank" data-post-id="<?php echo esc_attr( $post->ID );?>" href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( the_title_attribute( $args ) ) . ( esc_attr($post_thumbnail ) ? '&amp;media=' . urlencode( esc_attr( $post_thumbnail ) ) : '' ) ); ?>" aria-label="<?php esc_attr_e( 'Share article to Pinterest','fasto' ); ?>" class="pinterest">
			<?php fasto_brands_svg( 'pinterest',true ) ; # fasto_brands_svg() - safely escaped in functions/theme.php ?>
		</a>
	</li>
			
	<li>
		<a target="_blank" data-post-id="<?php echo esc_attr( $post->ID );?>" href="<?php echo esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url='.urlencode( get_permalink() ).'&amp;title='.urlencode( the_title_attribute( $args ) ) ); ?>&amp;summary=<?php echo esc_attr( urlencode( get_the_excerpt() ) ); ?>" aria-label="<?php esc_attr_e( 'Share article to LinkedIn','fasto' ); ?>" class="linkedin">
				<?php fasto_brands_svg( 'linkedin',true ) ; # fasto_brands_svg() - safely escaped in functions/theme.php ?>			
			</a>
	</li>	
	
	<li>
		<a target="_blank" data-post-id="<?php echo esc_attr( $post->ID );?>" href="mailto:?subject=<?php echo esc_attr( urlencode( the_title_attribute( $args ) ) ); ?>&body=<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php esc_attr_e( 'Share article to mail','fasto' ); ?>" class="mail">
				<?php fasto_brands_svg( 'mail',true ) ; # fasto_brands_svg() - safely escaped in functions/theme.php ?>			
			</a>
	</li>
</ul><!--/ social-share -->
</div>

<?php 
}

/*
=================================================================================================================
fasto_is_home_or_front() - Check if home or front page
=================================================================================================================
*/ 
function fasto_is_home_or_front(){
	if ( is_front_page() ){
		return true;
	}
	if ( is_home() ){
		return true;
	}
}

/*
=================================================================================================================
Function fasto_hex() - convert hex 2 rgba
=================================================================================================================
*/
function fasto_hex( $hex, $alpha = 1 ){
	$hex = str_replace('#', '', $hex);
	$r = $g = $b = 0;

	switch(strlen($hex)){
		case 3:
			list($r, $g, $b) = str_split($hex);
			$r = hexdec($r.$r);
			$g = hexdec($g.$g);
			$b = hexdec($b.$b);
			break;
		case 6:
			list($r1, $r2, $g1, $g2, $b1, $b2) = str_split($hex);
			$r = hexdec($r1.$r2);
			$g = hexdec($g1.$g2);
			$b = hexdec($b1.$b2);
			break;
		default:
			break;
	}

	return 'rgba('.$r.', '.$g.', '.$b.', '.$alpha.')';
}

/*
=================================================================================================================
fasto_page_menu_args() - Show home link in page menu
=================================================================================================================
*/
function fasto_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'fasto_page_menu_args' );

/*
=================================================================================================================
fasto_display_header() - Display theme header
=================================================================================================================
*/
function fasto_display_header(){ ?>

		<div class="logo">
			<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
		
		<nav class="primary" id="primary" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"  aria-label="<?php esc_attr_e( 'Primary Menu', 'fasto' ); ?>">
			
			<button class="mobile-menu-icon mobile-trigger mobile-trigger--slider" aria-label="<?php esc_attr_e( 'Open mobile menu','fasto' ) ?> aria-controls="primary" aria-expanded="false">		  
				<span class="mobile-trigger-box">
					<span class="mobile-trigger-inner"></span>
					<span class="screen-reader-text"><?php esc_html_e('Menu','fasto') ?></span>
				</span>
			</button>
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary', 'menu_class' => 'menu', 'container' => '', ) ); ?>
		
		</nav>
	
		<div class="author-social-search">
			<div class="social-and-search">
				<ul>
					<?php fasto_output_social(); ?>
					<li><a href="#" class="search-trigger" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></a></li>
				</ul>
			</div>
		</div>
		
		<div class="search-mobile">
			<button class="search-trigger mobile" aria-label="<?php esc_attr_e( 'Search website','fasto' ) ?>"><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg></button>
		</div>
		
	<?php get_search_form();  ?>	
	
<?php }


/*
=================================================================================================================
wp_body_open() - for backward compatibility - this function was only introduced in WordPress 5.2
=================================================================================================================
*/
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
		do_action( 'wp_body_open' );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }
}

/*
=================================================================================================================
fasto_user_copyright() - user copyright text
=================================================================================================================
*/
function fasto_user_copyright() {
	$html = '<div class="copyright-user">'. fasto_mod( 'fasto_user_copyright' ) .'</div>';
	echo wp_kses_post( $html );
}
add_action( 'wp_footer', 'fasto_user_copyright' );


/*
=================================================================================================================
fasto_developer_credit_disable() - Hide developer credit if enabled
=================================================================================================================
*/
function fasto_developer_credit_disable(){
	if ( fasto_mod( 'fasto_developer_credit') == '0'  ){
		$css = '.copyright-fasto{ display:none }';
		wp_add_inline_style( 'fasto-custom-css', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'fasto_developer_credit_disable' );