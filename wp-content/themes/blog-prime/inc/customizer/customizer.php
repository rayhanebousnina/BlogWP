<?php
/**
 * Blog Prime Theme Customizer
 *
 * @package Blog_Prime
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('blog_prime_customize_register')) :

function blog_prime_customize_register( $wp_customize ) {

	/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/custom-control.php';

	/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/sanitize.php';

	/** Header Options. **/
	require get_template_directory() . '/inc/customizer/header.php';

	/** Featured Post Options. **/
	require get_template_directory() . '/inc/customizer/home/layout.php';

	/** Featured Post Options. **/
	require get_template_directory() . '/inc/customizer/home/featured-posts.php';

	/** Slider Options. **/
	require get_template_directory() . '/inc/customizer/home/slider.php';

	/** Recommended Post Options. **/
	require get_template_directory() . '/inc/customizer/home/recommended-posts.php';

	if( class_exists( 'Booster_Extension_Class') ){
		/** Booster Extension Options. **/
		require get_template_directory() . '/inc/customizer/booster-options.php';
	}
	
	/** Layout Options. **/
	require get_template_directory() . '/inc/customizer/layout.php';

	/** Single Post Options. **/
	require get_template_directory() . '/inc/customizer/single.php';

	/** Footer Options. **/
	require get_template_directory() . '/inc/customizer/footer.php';

	if ( class_exists( 'WooCommerce' ) ) {
		/** Woocommerce. **/
		require get_template_directory() . '/inc/customizer/woocommerce.php';
	}

	/** Theme Options. **/
	require get_template_directory() . '/inc/customizer/theme-option.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blog_prime_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blog_prime_customize_partial_blogdescription',
		) );
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'Blog_Prime_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Blog_Prime_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Blog Prime Pro', 'blog-prime' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'blog-prime' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/blog-prime-pro/'),
				'priority'  => 1,
			)
		)
	);

	// Register sections.
	$wp_customize->add_section(
		new Blog_Prime_Customize_Section_Upsell(
			$wp_customize,
			'theme_more_option',
			array(
				'title'    => esc_html__( 'More features available on Pro version', 'blog-prime' ),
				'priority'  => 100,
				'notice'  => 'show',
				'panel'      => 'home_page_panel',
			)
		)
	);

}

endif;
add_action( 'customize_register', 'blog_prime_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('blog_prime_customize_partial_blogname')) :

	function blog_prime_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('blog_prime_customize_partial_blogdescription')) :

	function blog_prime_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

if ( !function_exists('blog_prime_customize_preview_js') ) :

	function blog_prime_customize_preview_js() {
		wp_enqueue_script( 'blog-prime-customizer', get_template_directory_uri() . '/assets/lib/default/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	}

endif;

add_action( 'customize_preview_init', 'blog_prime_customize_preview_js' );
