<?php
/**
* Footer Settings.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Footer Section.
$wp_customize->add_section( 'footer_setting',
	array(
	'title'      => esc_html__( 'Footer Settings', 'blog-prime' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Footer Layout.
$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Top Footer Column Layout', 'blog-prime' ),
	'section'     => 'footer_setting',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'blog-prime' ),
		'2' => esc_html__( 'Two Column', 'blog-prime' ),
		'3' => esc_html__( 'Three Column', 'blog-prime' ),
	    ),
	)
);

// Header Image Ad Link.
$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'blog-prime' ),
	'section'  => 'footer_setting',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('ed_footer_scroll_top',
    array(
        'default' => $default['ed_footer_scroll_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_footer_scroll_top',
    array(
        'label' => esc_html__('Enable Scroll To Top Button', 'blog-prime'),
        'section' => 'footer_setting',
        'type' => 'checkbox',
    )
);