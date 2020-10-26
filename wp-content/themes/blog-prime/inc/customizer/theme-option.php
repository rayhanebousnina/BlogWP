<?php
/**
* Theme Options.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'blog-prime' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

// Homepage Options Panel.
$wp_customize->add_panel( 'home_page_panel',
	array(
		'title'      => esc_html__( 'Homepage Options', 'blog-prime' ),
		'priority'   => 150,
		'capability' => 'edit_theme_options',
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'breadcrumb_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Settings', 'blog-prime' ),
	'priority'   => 50,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Breadcrumb Layout.
$wp_customize->add_setting( 'breadcrumb_layout',
	array(
	'default'           => $default['breadcrumb_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_layout',
	array(
	'label'       => esc_html__( 'Breadcrumb Layout', 'blog-prime' ),
	'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin.', 'blog-prime' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'breadcrumb_section',
	'type'        => 'select',
	'choices'               => array(
		'disable' => esc_html__( 'Disabled', 'blog-prime' ),
		'simple' => esc_html__( 'Simple', 'blog-prime' ),
		'advanced' => esc_html__( 'Advanced', 'blog-prime' ),
	    ),
	'priority'    => 10,
	)
);

// Pagination Section.
$wp_customize->add_section( 'pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'blog-prime' ),
	'priority'   => 80,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Pagination Layout.
$wp_customize->add_setting( 'pagination_layout',
	array(
	'default'           => $default['pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Layout', 'blog-prime' ),
	'section'     => 'pagination_section',
	'type'        => 'select',
	'choices'               => array(
		'classic' => esc_html__( 'Classic(Previous/Next)', 'blog-prime' ),
		'numeric' => esc_html__( 'Numeric', 'blog-prime' ),
	    ),
	'priority'    => 10,
	)
);

// Preloader Section.
$wp_customize->add_section( 'preloader_section',
	array(
	'title'      => esc_html__( 'Preloader Settings', 'blog-prime' ),
	'priority'   => 5,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Preloader.
$wp_customize->add_setting('ed_preloader',
    array(
        'default' => $default['ed_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'blog-prime'),
        'description' => esc_html__('Enable/Disable Loading Animation.', 'blog-prime'),
        'section' => 'preloader_section',
        'type' => 'checkbox',
        'priority' => 10,
    )
);