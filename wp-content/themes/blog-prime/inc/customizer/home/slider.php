<?php
/**
* Slider Options.
*
* @package Blog Prime
*/

$blog_prime_post_category_list = blog_prime_post_category_list();
$default = blog_prime_get_default_theme_options();

// Slider Section.
$wp_customize->add_section( 'slider_setting',
	array(
	'title'      => esc_html__( 'Slider Settings', 'blog-prime' ),
	'priority'   => 30,
	'capability' => 'edit_theme_options',
	'panel'      => 'home_page_panel',
	)
);

// Slider Enable Disable.
$wp_customize->add_setting('ed_slider',
    array(
        'default' => $default['ed_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_slider',
    array(
        'label' => esc_html__('Enable Slider', 'blog-prime'),
        'section' => 'slider_setting',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

// Slider Enable Disable..
$wp_customize->add_setting( 'slider_category',
	array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_category',
	array(
	'label'       => esc_html__( 'Slider Category', 'blog-prime' ),
	'section'     => 'slider_setting',
	'type'        => 'select',
	'choices'     => $blog_prime_post_category_list,
	'priority'    => 20,
	)
);

// Slider Autoplay Enable Disable.
$wp_customize->add_setting('ed_slider_autoplay',
    array(
        'default' => $default['ed_slider_autoplay']    ,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_slider_autoplay',
    array(
        'label' => esc_html__('Enable Slider Autoplay', 'blog-prime'),
        'section' => 'slider_setting',
        'type' => 'checkbox',
        'priority' => 30,
    )
);

// Slider Dots Enable Disable.
$wp_customize->add_setting('ed_slider_dots',
    array(
        'default' => $default['ed_slider_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_slider_dots',
    array(
        'label' => esc_html__('Enable Slider Dots', 'blog-prime'),
        'section' => 'slider_setting',
        'type' => 'checkbox',
        'priority' => 40,
    )
);

// Slider Arrows Enable Disable.
$wp_customize->add_setting('ed_slider_arrows',
    array(
        'default' => $default['ed_slider_arrows'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_slider_arrows',
    array(
        'label' => esc_html__('Enable Slider Arrows', 'blog-prime'),
        'section' => 'slider_setting',
        'type' => 'checkbox',
        'priority' => 50,
    )
);