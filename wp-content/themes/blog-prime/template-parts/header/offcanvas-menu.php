<?php
/**
 * Template for Off canvas Menu
 * @since blog-prime 1.0.0
 */
?>
<div id="offcanvas-menu">

    <a class="skip-link-offcanvas-menu-first" href="javascript:void(0)"></a>

    <div class="close-offcanvas-menu offcanvas-item">
        <a href="javascript:void(0)" class="offcanvas-close">
            <span>
               <?php echo esc_html__('Close', 'blog-prime'); ?>
            </span>
            <span class="ion-ios-close-empty meta-icon meta-icon-large"></span>
        </a>
    </div>

    <div id="primary-nav-offcanvas" class="offcanvas-navigation offcanvas-item">
        <div class="offcanvas-title">
            <?php esc_html_e('Menu', 'blog-prime'); ?>
        </div>
        <?php wp_nav_menu(array(
            'theme_location' => 'twp-primary-menu',
            'menu_id' => 'primary-menu',
            'container' => 'div',
            'container_class' => 'menu'
        )); ?>
    </div>
        
    <?php if (has_nav_menu('twp-social-menu')) { ?>
        <div class="offcanvas-social offcanvas-item">
            <div class="offcanvas-title">
                <?php esc_html_e('Social profiles', 'blog-prime'); ?>
            </div>
            <div class="social-icons">
                <?php
                wp_nav_menu(
                    array('theme_location' => 'twp-social-menu',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                        'menu_id' => 'social-menu',
                        'fallback_cb' => false,
                        'menu_class' => false
                    )); ?>
            </div>
        </div>
    <?php } ?>

    <a class="skip-link-offcanvas-menu-last" href="javascript:void(0)"></a>
    
</div>