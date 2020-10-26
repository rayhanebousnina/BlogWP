<?php
/**
 * Default theme options.
 *
 * @package Blog Prime
 */

if ( ! function_exists( 'blog_prime_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function blog_prime_get_default_theme_options() {

		$defaults = array();
		
		
		// Home options.
		$defaults['ed_featured_post']				= 1;
		$defaults['blog_prime_index_layout']		= 'index-layout-1';
		$defaults['ed_recommended_post']			= 1;
		$defaults['recommended_post_title']			= esc_html__('Our Recommendation','blog-prime');
		$defaults['ed_slider']				        = 1;
		$defaults['ed_slider_autoplay']				= 1;
		$defaults['ed_slider_dots']				    = 1;
		$defaults['ed_slider_arrows']				= 1;
		$defaults['home_sidebar_layout'] 			= 'right-sidebar';

		// Theme Options
		$defaults['ed_mid_header_search']			= 1;
		$defaults['breadcrumb_layout']				= 'simple';
		$defaults['pagination_layout']				= 'numeric';
		$defaults['ed_preloader']					= 1;
		$defaults['header_logo_position']			= 'left';

		// Single Posts Option.
		$defaults['ed_related_post']				= 1;
		$defaults['related_post_title']				= esc_html__('Related Post','blog-prime');
		$defaults['ed_author_section']				= 1;


		// Layout Options.
		$defaults['global_sidebar_layout'] 			= 'right-sidebar';
		$defaults['blog_prime_archive_layout'] 		= 'archive-layout-1';

		// Footer Options.
		$defaults['footer_column_layout'] 			= 3;
		$defaults['footer_copyright_text'] 			= esc_html__( 'Copyright All rights reserved', 'blog-prime' );
		$defaults['ed_footer_scroll_top'] 			= 1;

		// Booster Extensions Opotions
		$defaults['ed_social_icon']					= 1;
		$defaults['ed_like_dislike']				= 1;
		
		// Woocommerce.
		$defaults['product_sidebar_layout']			= 'no-sidebar';

		// Pass through filter.
		$defaults = apply_filters( 'blog_prime_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
