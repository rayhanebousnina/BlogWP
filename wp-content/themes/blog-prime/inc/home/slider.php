<?php
/**
* Slider Function.
*
* @package Blog Prime
*/

if ( !function_exists( 'blog_prime_slider' ) ):

    // Header Slider
    function blog_prime_slider(){

        $default = blog_prime_get_default_theme_options();
        $ed_slider = absint( get_theme_mod( 'ed_slider', $default['ed_slider'] ) );

        if ( $ed_slider ) {
            
            $slider_category = esc_html( get_theme_mod( 'slider_category' ) );
            $slider_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4, 'category_name' => esc_html( $slider_category ) ) );

            if ( $slider_query->have_posts() ):

                $ed_slider_autoplay = esc_attr( get_theme_mod( 'ed_slider_autoplay',$default['ed_slider_autoplay'] ) );
                $ed_slider_dots = esc_attr( get_theme_mod( 'ed_slider_dots',$default['ed_slider_dots'] ) );
                $ed_slider_arrows = esc_attr( get_theme_mod( 'ed_slider_arrows',$default['ed_slider_arrows'] ) );

                if ( $ed_slider_autoplay ) {
                    $autoplay = 'true';
                }else{
                    $autoplay = 'false';
                }
                if( $ed_slider_dots ) {
                    $dots = 'true';
                }else {
                    $dots = 'false';
                }
                if( $ed_slider_arrows ) {
                    $arrows = 'true';
                }else {
                    $arrows = 'false';
                }
                if( is_rtl() ) {
                    $rtl = 'true';
                }else{
                    $rtl = 'false';
                }

                ?>
                <div class="main-slider" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "arrows": <?php echo esc_attr( $arrows ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

                    <?php while ($slider_query->have_posts()):

                        $slider_query->the_post();
                        $slider_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'large' ); ?>

                        <div class="slide-item">
                            <a href="<?php the_permalink(); ?>" class="slide-bg data-bg" data-background="<?php echo esc_url( $slider_image[0] ); ?>"></a>
                            <div class="slide-details">

                                <div class="entry-meta entry-meta-category">
                                    <?php blog_prime_entry_footer( $cats = true,$tags = false ); ?>
                                </div>
                                
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <?php
                                $default = blog_prime_get_default_theme_options();
                                $ed_social_icon = absint( get_theme_mod( 'ed_social_icon',$default['ed_social_icon'] ) );
                                $ed_like_dislike = absint( get_theme_mod( 'ed_like_dislike',$default['ed_like_dislike'] ) );
                                if( class_exists( 'Booster_Extension_Class') && ( $ed_social_icon || $ed_like_dislike ) ){

                                    echo "<div class='like-share-wrapper'>";
                                    $args = array('layout'=>'layout-2','status'=>'enable');
                                    if( $ed_social_icon ){
                                        do_action('booster_extension_social_icons',$args);
                                    }
                                    if( $ed_like_dislike ){
                                        do_action('booster_extension_like_dislike','allenable');
                                    }
                                    echo "</div>";
                                } ?>

                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>
                <?php
                wp_reset_postdata();
            endif;
        }
    }

endif;