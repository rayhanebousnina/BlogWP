<?php
/**
 * Blog Prime functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog_Prime
 */

if (!function_exists('blog_prime_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function blog_prime_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Blog Prime, use a find and replace
         * to change 'blog-prime' to the name of your theme in all the template files.
         */
        load_theme_textdomain('blog-prime', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'twp-primary-menu' => esc_html__('Primary Menu', 'blog-prime'),
            'twp-footer-menu' => esc_html__('Footer Menu', 'blog-prime'),
            'twp-social-menu' => esc_html__('Social Menu', 'blog-prime'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('blog_prime_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
         * Posts Formate.
         *
         * https://wordpress.org/support/article/post-formats/
         */
        add_theme_support( 'post-formats', array(
            'video',
            'audio',
            'gallery',
            'quote',
            'image'
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        /**
         * Add theme support for gutenberg block
         *
         */
        add_theme_support( 'align-wide' );
        
    }
endif;
add_action('after_setup_theme', 'blog_prime_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if (!function_exists('blog_prime_content_width')) :

    function blog_prime_content_width()
    {
        // This variable is intended to be overruled from themes.
        // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        $GLOBALS['content_width'] = apply_filters('blog_prime_content_width', 750);
    }

endif;
add_action('after_setup_theme', 'blog_prime_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('blog_prime_scripts')) :

    function blog_prime_scripts()
    {
        $fonts_url = blog_prime_fonts_url();
        if (!empty($fonts_url)) {
            wp_enqueue_style('blog-prime-google-fonts', $fonts_url, array(), null);
        }
        wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/lib/ionicons/css/ionicons.min.css');
        wp_enqueue_style('slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
        wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css');
        wp_enqueue_style('sidr-nav', get_template_directory_uri() . '/assets/lib/sidr/css/jquery.sidr.dark.css');
        wp_enqueue_style('aos', get_template_directory_uri() . '/assets/lib/aos/css/aos.css');
        wp_enqueue_style('blog-prime-style', get_stylesheet_uri());

        wp_enqueue_script('blog-prime-skip-link-focus-fix', get_template_directory_uri() . '/assets/lib/default/js/skip-link-focus-fix.js', array(), '20151215', true);
        wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', true);
        wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true);
        wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/assets/lib/sidr/js/jquery.sidr.min.js', array('jquery'), '', true);
        wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/lib/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
        wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/lib/jquery-match-height/js/jquery.matchHeight.min.js', array('jquery'), '', true);
        wp_enqueue_script('aos', get_template_directory_uri() . '/assets/lib/aos/js/aos.js', array('jquery'), '', true);
        wp_enqueue_script('blog-prime-custom-script', get_template_directory_uri() . '/assets/lib/twp/js/script.js', array('jquery'), '', 1);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script( 'blog-prime-ajax', get_template_directory_uri() . '/assets/lib/twp/js/ajax.js', array('jquery'), '', true );

        wp_localize_script(
            'blog-prime-ajax', 
            'blog_prime_ajax',
            array(
                'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
                'loadmore'   => esc_html__( 'Load More', 'blog-prime' ),
                'nomore'     => esc_html__( 'No More Posts', 'blog-prime' ),
                'loading'    => esc_html__( 'Loading...', 'blog-prime' ),
             )
        );

    }

endif;

add_action('wp_enqueue_scripts', 'blog_prime_scripts');

/**
 * Admin enqueue scripts and styles.
 */
if (!function_exists('blog_prime_admin_scripts')) :

    function blog_prime_admin_scripts()
    {

        wp_enqueue_style('blog-prime-admin', get_template_directory_uri() . '/assets/lib/twp/css/admin.css');

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
        wp_enqueue_script('blog-prime-custom-widgets', get_template_directory_uri() . '/assets/lib/twp/js/widget.js', array('jquery'), '1.0.0', true);

    }

endif;

add_action('admin_enqueue_scripts', 'blog_prime_admin_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('blog_prime_customizer_scripts')) :

    function blog_prime_customizer_scripts()
    {   
        wp_enqueue_script('jquery-ui-button');
        wp_enqueue_script('blog-prime-customizer', get_template_directory_uri() . '/assets/lib/twp/js/customizer.js', array('jquery','customize-controls'), '', 1);
        wp_enqueue_style('blog-prime-customizer', get_template_directory_uri() . '/assets/lib/twp/css/customizer.css');
    }

endif;

add_action('customize_controls_enqueue_scripts', 'blog_prime_customizer_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Features Posts Functions.
 */
require get_template_directory() . '/inc/home/featured-posts.php';

/**
 * Slider Functions.
 */
require get_template_directory() . '/inc/home/slider.php';

/**
 * Recommended Posts Functions.
 */
require get_template_directory() . '/inc/home/recommended-posts.php';

/**
 * Recommended Posts Functions.
 */
require get_template_directory() . '/inc/ajax.php';

/**
 * Related Posts Functions.
 */
require get_template_directory() . '/inc/single/related-posts.php';

/**
 * Sidebar Metabox.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Breadcrumb Trail
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Widget Register
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * TGM Plugin Recommendation.
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined('JETPACK__VERSION') ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Woocommerce Plugin SUpport.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}