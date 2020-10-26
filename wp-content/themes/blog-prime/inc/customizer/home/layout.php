<?php
/**
* Home Layouts Settings.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Home Layout Section.
$wp_customize->add_section( 'home_layout_setting',
	array(
	'title'      => esc_html__( 'Layout Settings', 'blog-prime' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'home_page_panel',
	)
);

// Home Sidebar Layout.
$wp_customize->add_setting( 'home_sidebar_layout',
    array(
    'default'           => $default['home_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'blog_prime_sanitize_select',
    )
);
$wp_customize->add_control( 'home_sidebar_layout',
    array(
    'label'       => esc_html__( 'Latest Post Home Sidebar Layout', 'blog-prime' ),
    'section'     => 'home_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-prime' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'blog-prime' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-prime' ),
        ),
    )
);

// Home Layout.
$wp_customize->add_setting(
    'blog_prime_index_layout',
    array(
        'default' 			=> $default['blog_prime_index_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_select'
    )
);
$wp_customize->add_control(
    new Blog_Prime_Custom_Radio_Image_Control( 
        $wp_customize,
        'blog_prime_index_layout',
        array(
            'settings'      => 'blog_prime_index_layout',
            'section'       => 'home_layout_setting',
            'label'         => esc_html__( 'Home Posts Layout', 'blog-prime' ),
            'choices'       => array(
                'index-layout-1'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'index-layout-2'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
            )
        )
    )
);