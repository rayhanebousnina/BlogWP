<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Blog_Prime
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */

if (!function_exists('blog_prime_jetpack_setup')) :

	function blog_prime_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'blog_prime_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Content Options.
		add_theme_support( 'jetpack-content-options', array(
			'post-details'    => array(
				'stylesheet' => 'blog-prime-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive'    => true,
				'post'       => true,
				'page'       => true,
			),
		) );
	}

endif;
add_action( 'after_setup_theme', 'blog_prime_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */

if (!function_exists('blog_prime_infinite_scroll_render')) :

	function blog_prime_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_type() );
			endif;
		}
	}

endif;