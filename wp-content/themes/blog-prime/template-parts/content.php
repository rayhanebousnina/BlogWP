<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog_Prime
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php if( is_archive() || is_home() ){ ?> data-mh="article-panel"  data-aos="fade-up" data-aos-delay="300" <?php } ?>
>

	<?php if( is_archive() || is_home() ){ ?>
		<div class="article-wrapper">
	<?php } ?>
		
		<?php if( is_archive() || is_home() ){ blog_prime_post_thumbnail(); } ?>

		<div class="article-details">
			
			<?php if( is_archive() ||  is_home() ) : ?>

				<header class="entry-header">

					<?php

					if ( 'post' === get_post_type() ){
	                    echo '<div class="entry-meta entry-meta-category">';
	                    blog_prime_entry_footer( $cats = true,$tags = false );
	                    echo '</div>';
	                }

					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

					<div class="entry-meta">
                        <?php
                        blog_prime_posted_by();
                        echo "<span class='sep-date-author'><i class='ion ion-ios-remove'></i></span>";
                        blog_prime_posted_on();
                        ?>
                    </div><!-- .entry-meta -->

				</header><!-- .entry-header -->

			<?php endif; ?>

			<div class="entry-content">
				<?php
				if( is_single() ):

					the_content();

				else:

					if( has_excerpt() ){
						
						the_excerpt();

					}else{

						echo esc_html( wp_trim_words( get_the_content(),30,'...' ) );

					}

					$default = blog_prime_get_default_theme_options();
				    $ed_social_icon = absint( get_theme_mod( 'ed_social_icon',$default['ed_social_icon'] ) );
				    $ed_like_dislike = absint( get_theme_mod( 'ed_like_dislike',$default['ed_like_dislike'] ) );
				    $blog_prime_archive_layout = esc_html( get_theme_mod( 'blog_prime_archive_layout',$default['blog_prime_archive_layout'] ) );
				    $blog_prime_index_layout = esc_html( get_theme_mod( 'blog_prime_index_layout',$default['blog_prime_index_layout'] ) );

					if( $blog_prime_archive_layout == 'archive-layout-2' && is_archive() ){
                           
                        if( class_exists( 'Booster_Extension_Class') ){

                            echo "<div class='like-share-wrapper'>";
                            $args = array('layout'=>'layout-2');
                            do_action('booster_extension_social_icons',$args);
                            do_action('booster_extension_like_dislike');
                            echo "</div>";
                        }

					}else{

						if( class_exists( 'Booster_Extension_Class') && ( is_archive() || is_home() ) ){

							echo "<div class='like-share-wrapper'>";

							if( ( is_archive() || is_home() ) && $ed_social_icon ){
								$args = array('layout'=>'layout-2','status' => 'enable');
								do_action('booster_extension_social_icons',$args);
							}else{
								if( $ed_social_icon ){
									$args = array('layout'=>'layout-2','status' => 'enable');
									do_action('booster_extension_social_icons',$args);
								}
							}
					        
					        

					        if( is_home() ){

						        if( $blog_prime_index_layout == 'index-layout-2' && is_home() && $ed_like_dislike ){
                           
			                        if( class_exists( 'Booster_Extension_Class') ){

			                            do_action('booster_extension_like_dislike','allenable');
			                        }

								}
						    }

					        echo "</div>";
						}
					}

				endif;

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-prime' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

			<?php
				if( is_single() ){
					$tags = true;
				}else{
					$tags = false;
				}
			?>
			<footer class="entry-footer">
				<?php blog_prime_entry_footer( $cats = false,$tags ); ?>
			</footer><!-- .entry-footer -->

		</div>

	<?php if( is_archive() || is_home() ){ ?>
		</div>
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->