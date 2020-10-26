<?php
/**
* Featured Posts Function.
*
* @package Blog Prime
*/

if ( !function_exists( 'blog_prime_featured_posts' ) ):

    // Header Featured Post.
    function blog_prime_featured_posts(){
        
        $default = blog_prime_get_default_theme_options();
        $ed_featured_post = absint( get_theme_mod( 'ed_featured_post',$default['ed_featured_post'] ) );
        $featured_post_category = esc_html( get_theme_mod( 'featured_post_category' ) );
        $featured_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4, 'category_name' => esc_html( $featured_post_category ) ) );

        if ( $ed_featured_post &&  $featured_post_query->have_posts() ): ?>

            <div class="site-banner twp-blocks">
                <div class="wrapper">
                    <div class="twp-row">

                        <?php while( $featured_post_query->have_posts() ):
                            $featured_post_query->the_post();

                            $format = get_post_format( get_the_ID() ) ? : 'standard';
                            $icon = blog_prime_post_formate_icon( $format );
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' ); ?>

                            <div class="column column-quarter column-five-sm">
                                <article>
                                    <div class="post-thumb">
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-medium" data-background="<?php echo esc_url( $featured_image[0] ); ?>">

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
                                    <div class="post-content">
                                        <h2 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </div>
                                </article>
                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>

        <?php
        wp_reset_postdata();
        endif;

    }

endif;