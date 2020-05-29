<?php

get_header(); 

if( have_posts() ) :

    while( have_posts() ) : the_post();

        do_action( 'travelers_blog_before_body', $post->ID ); ?>

        <section class="page-cover">

            <div class="container">

                <div class="row">

                    <?php 
                    $class = '';
                    if( has_post_thumbnail() ) { ?>
                        <div class="col-xs-5">
                        <?php 
                    } else { 
                        $class = 'cover-content-full'; ?> 
                        <div class="col-sm-10 col-sm-offset-1 text-center single-page-no-image"> 
                        <?php 
                    } ?>

                        <div class="cover-content <?php echo esc_attr($class); ?>">

                            <div class="single-category">

                                <?php 

                                travelers_blog_get_first_category(); 

                                do_action( 'travelers_blog_before_title_detail_page', $post->ID );
                                 
                                ?>
                                
                            </div>

                            <h1><?php the_title(); ?></h1>

                            <div class="author-detail">
                                <?php travelers_blog_get_author_detail(); ?>
                            </div>

                        </div>

                    </div>
                    
                    <?php 
                    if(has_post_thumbnail()) {
                        $imageID = get_post_thumbnail_id(); 
                        $image = wp_get_attachment_image_src($imageID,'medium_large'); ?> 

                        <div class="col-xs-7 single_page_image_wrapper">
                            <div 
                            class="single_page_image" 
                            style="background-image: url(<?php echo esc_url( !empty($image[0]) ? $image[0] : '' ); ?>);"></div>                   	 
                        </div>
                        <?php 
                    } ?>
                </div>
            </div>
        </section>

        <section class="item-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">

                        <div class="item-wrapper" id="content">
                            <div class="item-detail">
                                <?php the_content(); ?>
                            </div>
                            <div class="author-profile">
                                <?php travelers_blog_author_profile(); ?>
                            </div>
                            <div class="item-tags">
                                <?php travelers_blog_get_tags(); ?> 
                            </div> 
                            <?php 
                            if ( comments_open() || get_comments_number() ) : 
                                comments_template(); 
                            endif; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-page-post">
            <div class="container">
                <div class="col-sm-12">
                    <div class="post-wide">
                        <div class="row">
                            <?php $ignore_post_id = travelers_blog_detail_category_post(); ?>
                        </div>
                    </div>
                    <div class="post-small">
                        <div class="row">
                            <?php travelers_blog_detail_category_posts( $ignore_post_id ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php

    endwhile;

endif;

get_footer();