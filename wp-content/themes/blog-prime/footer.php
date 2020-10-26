<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Prime
 */

?>

</div><!-- #content -->

<?php get_template_part('template-parts/header/offcanvas', 'menu'); ?>
<?php get_template_part('template-parts/footer/footer', 'component'); ?>

<footer id="colophon" class="site-footer">

    <?php
    $default = blog_prime_get_default_theme_options();
    if ( is_active_sidebar('blog-prime-footer-widget-0') || is_active_sidebar('blog-prime-footer-widget-1') || is_active_sidebar('blog-prime-footer-widget-2') ):

        
        $footer_column_layout = absint( get_theme_mod('footer_column_layout', $default['footer_column_layout'] ) ); ?>

        <div class="footer-top <?php echo 'footer-column-' . absint($footer_column_layout); ?>">
            <div class="wrapper">
                <div class="footer-grid twp-row">
                    <?php if ( is_active_sidebar('blog-prime-footer-widget-0') ): ?>
                        <div class="column column-1">
                            <?php dynamic_sidebar('blog-prime-footer-widget-0'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar('blog-prime-footer-widget-1') ): ?>
                        <div class="column column-2">
                            <?php dynamic_sidebar('blog-prime-footer-widget-1'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar('blog-prime-footer-widget-2') ): ?>
                        <div class="column column-3">
                            <?php dynamic_sidebar('blog-prime-footer-widget-2'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php if ( has_nav_menu('twp-social-menu') ) { ?>
        <div class="footer-middle">
            <div class="wrapper">
                <div class="social-icons">
                <?php wp_nav_menu( array(
                    'theme_location' => 'twp-social-menu',
                    'link_before' => '<span class="screen-reader-text">',
                    'link_after' => '</span>',
                    'menu_id' => 'social-menu',
                    'fallback_cb' => false,
                    'menu_class' => false
                ) ); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="footer-bottom">
        <div class="wrapper">
            <div class="site-copyright">
                <div class="site-info">
                    <?php
                    $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text',$default['footer_copyright_text'] ) );
                    if (!empty( $footer_copyright_text ) ) {
                        echo wp_kses_post( $footer_copyright_text );
                    }
                    ?>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Theme: %1$s by %2$s.', 'blog-prime'), '<strong>Blog Prime</strong>', '<a href="https://www.themeinwp.com/">Themeinwp</a>');
                    ?>
                </div><!-- .site-info -->
            </div>
            <?php if ( has_nav_menu('twp-footer-menu') ) { ?>
                <div class="footer-menu">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'twp-footer-menu',
                        'menu_id' => 'footer-menu',
                        'container' => 'div',
                        'container_class' => 'menu',
                        'depth' => 1,
                    ) ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
