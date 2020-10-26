<?php
/**
* Layouts Settings.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Woocommerce Setting For Theme.
$wp_customize->add_section( 'blog_prime_woocommerce_setting',
	array(
	'title'      => esc_html__( 'Theme Settings', 'blog-prime' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'woocommerce',
	)
);

// Product Single Sidebar Layout.
$wp_customize->add_setting( 'product_sidebar_layout',
	array(
	'default'           => $default['product_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'product_sidebar_layout',
	array(
	'label'       => esc_html__( 'Single Product Sidebar Layout', 'blog-prime' ),
	'section'     => 'blog_prime_woocommerce_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-prime' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'blog-prime' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-prime' ),
	    ),
	)
);
