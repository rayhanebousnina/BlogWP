<?php
/**
* Featured Posts Options.
*
* @package Blog Prime
*/

$blog_prime_post_category_list = blog_prime_post_category_list();
$default = blog_prime_get_default_theme_options();

// Featured Posts Settings.
$wp_customize->add_section( 'featured_post_setting',
	array(
	'title'      => esc_html__( 'Featured Post Settings', 'blog-prime' ),
	'priority'   => 25,
	'capability' => 'edit_theme_options',
	'panel'      => 'home_page_panel',
	)
);

// Featured Posts Enable Disable.
$wp_customize->add_setting('ed_featured_post',
    array(
        'default' => $default['ed_featured_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_featured_post',
    array(
        'label' => esc_html__('Enable Featured Posts', 'blog-prime'),
        'section' => 'featured_post_setting',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

$wp_customize->add_setting( 'featured_post_category',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'blog_prime_sanitize_select',
    )
);
$wp_customize->add_control( 'featured_post_category',
    array(
    'label'       => esc_html__( 'Featured Post Category', 'blog-prime' ),
    'section'     => 'featured_post_setting',
    'type'        => 'select',
    'choices'     => $blog_prime_post_category_list,
    'priority'    => 20,
    )
);