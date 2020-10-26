<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blog_Prime
 */

if ( ! function_exists( 'blog_prime_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blog_prime_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$year = get_the_date('Y');
		$month = get_the_date('m');
		$day = get_the_date('d');
		$link = get_day_link( $year, $month, $day );
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'blog-prime' ),
			'<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'blog_prime_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function blog_prime_posted_by() {

		$author_img = get_avatar( get_the_author_meta( 'ID' ) , 100, '', '', array( 'class' => 'avatar-img' ) );
		echo '<span class="author-img"> ' .wp_kses_post( $author_img ). '</span>';

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'blog-prime' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'blog_prime_comment_count' ) ) :
	/**
	 * Post Comment Count.
	 */
	function blog_prime_comment_count() {

		echo '<span class="date-icon"><i class="ion ion-ios-chatbubbles"></i></span>';

		?><span class="post-comment-link"><a href="<?php comments_link(); ?>"><?php echo absint( get_comments_number() ); ?></a></span><?php

	}
endif;

if ( ! function_exists( 'blog_prime_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blog_prime_entry_footer( $cats = true, $tags = true, $edits = true ) {
			
			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {

				if( $cats ){

					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( esc_html__( ' ', 'blog-prime' ) );
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links">' . esc_html__( '%1$s', 'blog-prime' ) . '</span>', $categories_list ); // WPCS: XSS OK.
					}

				}

				if( $tags ){

					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'blog-prime' ) );
					if ( $tags_list ) {
						/* translators: 1: list of tags. */
						printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'blog-prime' ) . '</span>', $tags_list ); // WPCS: XSS OK.
					}
				}

			}

			if( is_single() ){

				if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments-link">';
					comments_popup_link(
						sprintf(
							wp_kses(
								/* translators: %s: post title */
								__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'blog-prime' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);
					echo '</span>';
				}
			}

		if( $tags && ( is_single() || is_page() ) ){
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'blog-prime' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		}

	}
endif;

if ( ! function_exists( 'blog_prime_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function blog_prime_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$default = blog_prime_get_default_theme_options();
		$blog_prime_index_layout = esc_html( get_theme_mod( 'blog_prime_index_layout',$default['blog_prime_index_layout'] ) );
		$home_sidebar_layout = esc_html( get_theme_mod( 'home_sidebar_layout',$default['home_sidebar_layout'] ) );
		$global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$default['global_sidebar_layout'] ) );
		$default = blog_prime_get_default_theme_options();
		$blog_prime_archive_layout = esc_html( get_theme_mod( 'blog_prime_archive_layout',$default['blog_prime_archive_layout'] ) );
		$ed_like_dislike = absint( get_theme_mod( 'ed_like_dislike',$default['ed_like_dislike'] ) );

		if( is_home() ){

			if( $blog_prime_index_layout == 'index-layout-2' ){

				if( $home_sidebar_layout == 'no-sidebar' ){
					$image_size = 'full';
				}else{
					$image_size = 'large';
				}

			}else{
				$image_size = 'medium_large';
			}

		}else{

			if( $blog_prime_archive_layout == 'archive-layout-2' ){

				if( $global_sidebar_layout == 'no-sidebar' ){
					$image_size = 'full';
				}else{
					$image_size = 'large';
				}

			}else{
				$image_size = 'medium_large';
			}

		}

		if ( is_singular() ) : ?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
                <div class="post-thumbnail-corner"></div>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<div class="post-thumbnail" >
			
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">

				<?php
				the_post_thumbnail( $image_size, array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );

				if( !is_single() && !is_page() ){

					$format = get_post_format( get_the_ID() ) ? : 'standard';
		            $icon = blog_prime_post_formate_icon( $format );

					if( !empty( $icon ) ){ ?>

		                <span class="format-icon">
		                    <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
		                </span>

		            <?php }

	            } ?>

			</a>

			<?php
			if( is_home() && class_exists( 'Booster_Extension_Class') && $ed_like_dislike  && $blog_prime_index_layout != 'index-layout-2' ){

				do_action('booster_extension_like_dislike','allenable');

	        }

	        if( is_archive() && class_exists( 'Booster_Extension_Class') && $blog_prime_archive_layout != 'archive-layout-2' ){

				do_action('booster_extension_like_dislike');

	        } ?>

        </div>
		<?php
		endif; // End is_singular().
	}
endif;
