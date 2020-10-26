<?php
/**
* Booster Extension Settings.
*
* @package Infinity News
*/

$default = blog_prime_get_default_theme_options();
$blog_prime_post_category_list = blog_prime_post_category_list();

// Footer Section.
$wp_customize->add_section( 'twp_booster_settings',
	array(
	'title'      => esc_html__( 'Booster Options', 'blog-prime' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Social Share.
$wp_customize->add_setting('ed_social_icon',
    array(
        'default' => $default['ed_social_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_social_icon',
    array(
        'label' => esc_html__('Enable Social Share On Home Sections.', 'blog-prime'),
        'section' => 'twp_booster_settings',
        'type' => 'checkbox',
    )
);

// Enable Disable Like Dislike button.
$wp_customize->add_setting('ed_like_dislike',
    array(
        'default' => $default['ed_like_dislike'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'blog_prime_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_like_dislike',
    array(
        'label' => esc_html__('Enable Like/Dislike On Home Sections.', 'blog-prime'),
        'section' => 'twp_booster_settings',
        'type' => 'checkbox',
    )
);
