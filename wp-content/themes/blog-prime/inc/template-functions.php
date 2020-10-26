<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blog_Prime
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if (!function_exists('blog_prime_body_classes')) :

    function blog_prime_body_classes($classes)
    {   
        $default = blog_prime_get_default_theme_options();
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$default['global_sidebar_layout'] ) );
        
        if ( ! is_active_sidebar( 'sidebar-1' ) ) { $global_sidebar_layout = 'no-sidebar'; }
        if( blog_prime_check_woocommerce_page() ){ if ( ! is_active_sidebar( 'blog-prime-woocommerce-widget' ) ) { $global_sidebar_layout = 'no-sidebar'; } }
        
        if( is_home() || is_front_page() || is_single() || is_page() ){

            if( ( is_front_page() && !is_home() && is_page() ) || ( is_single() || is_page() ) ){

                if( blog_prime_check_woocommerce_page() && is_product() ){

                    $blog_prime_post_sidebar = esc_html( get_theme_mod( 'product_sidebar_layout',$default['product_sidebar_layout'] ) );
                    
                }else{

                    $blog_prime_post_sidebar = esc_html( get_post_meta( $post->ID, 'blog_prime_post_sidebar_option', true ) );
                    if( $blog_prime_post_sidebar == 'global-sidebar' || empty( $blog_prime_post_sidebar ) ){ $blog_prime_post_sidebar = $global_sidebar_layout; }
                }
                
                $classes[] = $blog_prime_post_sidebar;

            }else{
                $home_sidebar_layout = esc_html( get_theme_mod( 'home_sidebar_layout',$default['home_sidebar_layout'] ) );
                $classes[] = $home_sidebar_layout;

            }
            
        }else{

            if( is_404() ){

                $classes[] = 'no-sidebar';

            }else{

                $classes[] = $global_sidebar_layout;

            }
        }

        if( is_search() || is_archive() ){
            $blog_prime_archive_layout = esc_html( get_theme_mod( 'blog_prime_archive_layout',$default['blog_prime_archive_layout'] ) );
            $classes[] = $blog_prime_archive_layout;
        }

        if( is_home() ){
            $blog_prime_index_layout = esc_html( get_theme_mod( 'blog_prime_index_layout',$default['blog_prime_index_layout'] ) );
            $classes[] = $blog_prime_index_layout;
        }

        if( !is_active_sidebar( 'blog-prime-offcanvas-widget' ) ){
            $classes[] = 'no-offcanvas';
        }

        return $classes;
    }

endif;

add_filter('body_class', 'blog_prime_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if (!function_exists('blog_prime_pingback_header')) :

    function blog_prime_pingback_header()
    {
        if ( is_singular() && pings_open() ) {
            printf('<link rel="pingback" href="%s">', esc_url( get_bloginfo('pingback_url') ) );
        }
    }

endif;

add_action('wp_head', 'blog_prime_pingback_header');
