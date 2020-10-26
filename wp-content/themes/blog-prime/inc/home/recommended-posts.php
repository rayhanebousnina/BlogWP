<?php
/**
* Recommended Posts Function.
*
* @package Blog Prime
*/

if( !function_exists('blog_prime_recommended_posts') ):

	// Recommended Posts Functions.
	function blog_prime_recommended_posts(){

		$default = blog_prime_get_default_theme_options();
		$ed_recommended_post = absint( get_theme_mod( 'ed_recommended_post',$default['ed_recommended_post'] ) );
        $recommended_post_category = esc_html( get_theme_mod( 'recommended_post_category' ) );
        $default = blog_prime_get_default_theme_options();

        global $paged;
		$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $recommended_post_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 3, 'category_name' => esc_html( $recommended_post_category ), 'paged'=>$paged ) );

        if ( $ed_recommended_post &&  $recommended_post_query->have_posts() ): ?>

        	<div class="site-recommended twp-blocks">
			    <div class="wrapper">
			        
			        <?php $recommended_post_title = esc_html( get_theme_mod( 'recommended_post_title',$default['recommended_post_title'] ) );
			        if( $recommended_post_title ){ ?>
				        <div class="twp-row">
				            <div class="column">
				                <header class="block-title-wrapper">
				                    <h2 class="block-title">
				                        <?php echo esc_html( $recommended_post_title ); ?>
				                    </h2>
				                </header>
				            </div>
				        </div>
				    <?php } ?>

			        <div class="twp-row recommended-post-wraper">

			        	<?php while( $recommended_post_query->have_posts() ):
			        		$recommended_post_query->the_post();

			        		$format = get_post_format( get_the_ID() ) ? : 'standard';
                            $icon = blog_prime_post_formate_icon( $format );
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' ); ?>

				            <div class="column column-three-1 column-five-sm recommended-load" data-mh="recommended-item"  data-aos="fade-up" data-aos-delay="300">
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

				                    <div class="entry-content">
				                        <h3 class="entry-title entry-title-medium">
				                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
				                        </h3>
				                    </div>

				                </article>
				            </div>

			        	<?php endwhile; ?>

			        </div>

			        <a href="javascript:void(0)" class="infinity-btn">
                        <span class="loadmore"><?php echo esc_html('Load More Posts','blog-prime'); ?></span>
                    </a>

			    </div>
			</div>

		<?php
		wp_reset_postdata();
        endif;

	}

endif;