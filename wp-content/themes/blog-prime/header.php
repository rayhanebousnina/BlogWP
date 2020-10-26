<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog Prime
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}

$default = blog_prime_get_default_theme_options();
$ed_preloader = absint( get_theme_mod( 'ed_preloader',$default['ed_preloader'] ) );
if( $ed_preloader && !is_customize_preview() ){ ?>
    
    <div class="preloader">
        <div class="blobs">
            <div class="blob-center"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>

    </div>

<?php } ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'blog-prime'); ?></a>

    <?php $header_image = esc_url( get_header_image() ); ?>

    <header id="masthead" class="site-header <?php if( $header_image ){ ?>data-bg<?php } ?>" <?php if( $header_image ){ echo 'data-background="'.esc_url( $header_image ).'"'; } ?>>
        <?php
        $header_logo_position = esc_attr( get_theme_mod( 'header_logo_position',$default['header_logo_position'] ) ); ?>

        <div class="site-middlebar <?php echo 'twp-align-'.esc_attr( $header_logo_position ); ?>">
            <div class="wrapper">
                <div class="middlebar-items">

                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </h1>
                        <?php
                        else :
                            ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </p>
                        <?php
                        endif;
                        $blog_prime_description = get_bloginfo('description', 'display');
                        if ($blog_prime_description || is_customize_preview()) :
                            ?>
                            <p class="site-description">
                               <span><?php echo esc_html( $blog_prime_description ); /* WPCS: xss ok. */ ?></span>
                            </p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->

                    <?php
                    $header_advertise_image = esc_url( get_theme_mod( 'header_advertise_image' ) );
                    $header_advertise_link = esc_url( get_theme_mod( 'header_advertise_link' ) );

                    if( $header_advertise_image ){ ?>
                        <div class="site-header-banner">
                            <?php if( $header_advertise_link) { ?><a target="_blank" href="<?php echo esc_url( $header_advertise_link ) ?>"><?php } ?>
                                <img src="<?php echo esc_url( $header_advertise_image ) ?>" title="<?php esc_attr_e('Header Advertise','blog-prime'); ?>" alt="<?php esc_attr_e('Header Advertise','blog-prime'); ?>">
                            <?php if( $header_advertise_link) { ?></a><?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <nav id="site-navigation" class="main-navigation">
            <div class="wrapper">
                <div class="navigation-area">

                    <?php if (is_active_sidebar('blog-prime-offcanvas-widget')): ?>
                        <div id="widgets-nav" class="icon-sidr">
                            <a href="javascript:void(0)" id="hamburger-one">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="nav-right">
                        <?php
                        $ed_mid_header_search = absint(get_theme_mod('ed_mid_header_search', $default['ed_mid_header_search']));

                        if ($ed_mid_header_search) { ?>

                        <a href="javascript:void(0)" class="icon-search">
                            <i class="ion-ios-search"></i>
                        </a>

                        <?php } ?>

                        <?php if( class_exists( 'WooCommerce' ) ){ ?>
                            <span class="twp-minicart">
                                 <?php blog_prime_woocommerce_header_cart(); ?>
                            </span>
                        <?php } ?>
                        
                    </div>

                    <div class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                        <a class="offcanvas-toggle" href="#">
                            <div class="trigger-icon">
                               <span class="menu-label">
                                    <?php esc_html_e('Menu', 'blog-prime'); ?>
                                </span>
                            </div>
                        </a>
                    </div>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'twp-primary-menu',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu'
                    )); ?>
                </div>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <?php if( empty( blog_prime_check_woocommerce_page() ) && !is_front_page() ){ do_action('blog_prime_header_banner_x'); } ?>

    <?php if( is_front_page() ):
        blog_prime_featured_posts();
    endif; ?>

    <div id="content" class="site-content">