<?php
/**
* Layouts Settings.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Layout Settings', 'blog-prime' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'blog-prime' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-prime' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'blog-prime' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-prime' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'blog_prime_archive_layout',
    array(
        'default' 			=> $default['blog_prime_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_select'
    )
);
$wp_customize->add_control(
    new Blog_Prime_Custom_Radio_Image_Control( 
        $wp_customize,
        'blog_prime_archive_layout',
        array(
            'settings'      => 'blog_prime_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'blog-prime' ),
            'choices'       => array(
                'archive-layout-1'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'archive-layout-2'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
            )
        )
    )
);