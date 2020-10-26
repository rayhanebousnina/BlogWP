<?php
/**
* Recommended Posts Function.
*
* @package Blog Prime
*/

add_action('wp_ajax_blog_prime_recommended_posts', 'blog_prime_recommended_posts_callback');
add_action('wp_ajax_nopriv_blog_prime_recommended_posts', 'blog_prime_recommended_posts_callback');

if (!function_exists('blog_prime_recommended_posts_callback')) :

    // Recommendec Post Ajax Call Function.
    function blog_prime_recommended_posts_callback() {

        if( isset( $_POST['page'] ) && absint( wp_unslash( $_POST['page'] ) ) ){

            $paged = absint( wp_unslash( $_POST['page'] ) );

            $default = blog_prime_get_default_theme_options();
            $ed_recommended_post = absint( get_theme_mod( 'ed_recommended_post',$default['ed_recommended_post'] ) );
            $recommended_post_category = esc_html( get_theme_mod( 'recommended_post_category' ) );
            $recommended_post_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 3, 'category_name' => esc_html( $recommended_post_category ), 'paged'=> absint( $paged ) ) );

            if ( $recommended_post_query->have_posts() ) :
                
                $i = 0;
                while ( $recommended_post_query->have_posts() ) : $recommended_post_query->the_post();

                    if( $i == 1 ){
                        $delay = 500;
                    }elseif( $i == 2 ){
                        $delay = 700;
                    }else{
                        $delay = 300;
                    }

                    $format = get_post_format( get_the_ID() ) ? : 'standard';
                    $icon = blog_prime_post_formate_icon( $format );
                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' ); ?>

                    <div class="column column-three-1 column-five-sm recommended-load after-load-<?php echo esc_attr( $paged ); ?>" data-mh="recommended-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                        <article>

                            <div class="post-thumb">
                                
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="data-bg data-bg-big"
                                   data-background="<?php echo esc_url( $featured_image[0] ); ?>">

                                    <?php if( !empty( $icon ) ){ ?>
                                        <span class="format-icon">
                                            <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
                                        </span>
                                    <?php } ?>

                                </a>

                                <?php
                                $default = blog_prime_get_default_theme_options();
                                $ed_like_dislike = esc_html( get_theme_mod( 'ed_like_dislike',$default['ed_like_dislike'] ) );

                                if( class_exists( 'Booster_Extension_Class') && $ed_like_dislike ){
                                    do_action('booster_extension_like_dislike','allenable');
                                } ?>

                            </div>

                            <div class="entry-meta entry-meta-category">
                                <?php blog_prime_entry_footer( $cats = true,$tags = false, $edits = false ); ?>
                            </div><!-- .entry-footer -->

                            <div class="post-content">
                                <h3 class="entry-title entry-title-medium">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                                </h3>
                            </div>

                        </article>
                    </div>
                <?php
                $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        
        wp_die();
        
    }

endif;