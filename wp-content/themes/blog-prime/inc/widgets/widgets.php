<?php
/**
* Widget FUnctions.
*
* @package Blog Prime
*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function blog_prime_widgets_init()
{   
    $default = blog_prime_get_default_theme_options();
    
    register_sidebar( array(
        'name' => esc_html__('Sidebar', 'blog-prime'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'blog-prime'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Offcanvas Widget', 'blog-prime'),
        'id' => 'blog-prime-offcanvas-widget',
        'description' => esc_html__('Add widgets here.', 'blog-prime'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    $footer_column_layout = absint( get_theme_mod( 'footer_column_layout',$default['footer_column_layout'] ) );

    for( $i = 0; $i < $footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','blog-prime'); }
    	if( $i == 1 ){ $count = esc_html__('Two','blog-prime'); }
    	if( $i == 2 ){ $count = esc_html__('Three','blog-prime'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'blog-prime').$count,
	        'id' => 'blog-prime-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'blog-prime'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'blog_prime_widgets_init');

/**
 * Widget Base Class.
 */
require get_template_directory() . '/inc/widgets/widget-base-class.php';

/**
 * Recent Post Widget.
 */
require get_template_directory() . '/inc/widgets/recent-post.php';

/**
 * Social Link Widget.
 */
require get_template_directory() . '/inc/widgets/social-link.php';

/**
 * Author Widget.
 */
require get_template_directory() . '/inc/widgets/author.php';

/**
 * Author Widget.
 */
require get_template_directory() . '/inc/widgets/tab-posts.php';

/**
 * Category Widget.
 */
require get_template_directory() . '/inc/widgets/category.php';