<?php 
$catID = get_theme_mod('slider_category','');
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'cat' => $catID,
);
$result = new WP_Query( $args );
     
if ( $result->have_posts() ) : ?>

    <div class="row">

        <div class="col-sm-12">

            <div id="home_banner_blog" class="list-slider">

                <div class="swiper-container" <?php echo ( is_rtl() ? ' dir="rtl"' : '' ); ?>>

                    <div class="swiper-wrapper">

                        <?php 
                        while ( $result->have_posts() ) : $result->the_post(); 

                            global $post;

                            $postID = $post->ID; ?>

                            <div class="swiper-slide">

                                <?php 
                                if( has_post_thumbnail() ) {

                                    $imageID = get_post_thumbnail_id($postID);
                                    $image_size = is_active_sidebar( 'sidebar-2' ) ? 'travelers_blog_category_slider' : 'travelers_blog_category_slider_no_sidebar';
                                    $image = wp_get_attachment_image_src( $imageID, $image_size ); 
                                    $img = !empty( $image[0] ) ? $image[0] : '';

                                } else {

                                    $img = esc_url(get_template_directory_uri()).'/assets/images/650x450.jpg';

                                } ?>

                                <div class="slide-inner slide-overlay" style="background-image: url('<?php echo esc_url($img); ?>');" >
                                    
                                    <div class="home_banner_text">
                                        <div class="banner-tag">
                                            <?php travelers_blog_get_all_categories(); ?> 
                                        </div>
                                        <h2><a class="heading-styl" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a></h2>
                                        <div class="author-detail content-styl">
                                            <?php travelers_blog_get_author_detail(); ?>     
                                        </div>
                                    </div>
                                </div> 

                            </div>

                            <?php 

                        endwhile; ?>

                    </div>

                    <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>

                </div>

            </div>

        </div>
        
    </div>

    <?php 

endif; 

wp_reset_postdata();