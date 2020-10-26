<?php
/**
* Recommended Posts Options.
*
* @package Blog Prime
*/

$blog_prime_post_category_list = blog_prime_post_category_list();
$default = blog_prime_get_default_theme_options();

// Recommended Posts Section.
$wp_customize->add_section( 'recommended_post_setting',
	array(
	'title'      => esc_html__( 'Recommended Post Settings', 'blog-prime' ),
	'priority'   => 40,
	'capability' => 'edit_theme_options',
	'panel'      => 'home_page_panel',
	)
);

// Recommended Posts Enable Disable.
$wp_customize->add_setting('ed_recommended_post',
    array(
        'default' => $default['ed_recommended_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_recommended_post',
    array(
        'label' => esc_html__( 'Enable Recommended Post Section', 'blog-prime' ),
        'section' => 'recommended_post_setting',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

// Recommended Posts Section Title.
$wp_customize->add_setting( 'recommended_post_title',
    array(
    'default'           => $default['recommended_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recommended_post_title',
    array(
    'label'    => esc_html__( 'Section Title', 'blog-prime' ),
    'section'  => 'recommended_post_setting',
    'type'     => 'text',
    'priority' => 20,
    )
);

// Recommended Posts category.
$wp_customize->add_setting( 'recommended_post_category',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'blog_prime_sanitize_select',
    )
);
$wp_customize->add_control( 'recommended_post_category',
    array(
    'label'       => esc_html__( 'recommended Post Category', 'blog-prime' ),
    'section'     => 'recommended_post_setting',
    'type'        => 'select',
    'choices'     => $blog_prime_post_category_list,
    'priority'    => 30,
    )
);