<?php
/**
* Header Options.
*
* @package Blog Prime
*/

$default = blog_prime_get_default_theme_options();

// Logo Position Layout.
$wp_customize->add_setting( 'header_logo_position',
	array(
	'default'           => $default['header_logo_position'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'header_logo_position',
	array(
	'label'       => esc_html__( 'Logo Position', 'blog-prime' ),
	'section'     => 'title_tagline',
	'type'        => 'select',
	'choices'               => array(
		'left' => esc_html__( 'Left', 'blog-prime' ),
		'center' => esc_html__( 'Center', 'blog-prime' ),
	    ),
	'priority'    => 10,
	)
);

// Header Advertise Area Section.
$wp_customize->add_section( 'header_mid_header_bar',
	array(
	'title'      => esc_html__( 'Header Settings', 'blog-prime' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Header Advertise Image
$wp_customize->add_setting('header_advertise_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_advertise_image',
    	array(
        	'label'      => esc_html__( 'Header Advertise Image', 'blog-prime' ),
           	'section'    => 'header_mid_header_bar',
           	'priority' => 10,
       	)
   	)
);

// Header Image Ad Link.
$wp_customize->add_setting( 'header_advertise_link',
	array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'header_advertise_link',
	array(
	'label'    => esc_html__( 'Header Advertise Image Link', 'blog-prime' ),
	'section'  => 'header_mid_header_bar',
	'type'     => 'text',
	'priority' => 20,
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_mid_header_search',
    array(
        'default' => $default['ed_mid_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mid_header_search',
    array(
        'label' => esc_html__('Enable Search', 'blog-prime'),
        'section' => 'header_mid_header_bar',
        'type' => 'checkbox',
        'priority' => 30,
    )
);