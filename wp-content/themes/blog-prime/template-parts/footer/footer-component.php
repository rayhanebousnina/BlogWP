<?php
/**
 * Template for Footer Components
 * @since blog-prime 1.0.0
 */
?>

<?php
$default = blog_prime_get_default_theme_options();
$ed_mid_header_search = absint( get_theme_mod( 'ed_mid_header_search',$default['ed_mid_header_search'] ) );
$ed_footer_scroll_top = absint( get_theme_mod( 'ed_footer_scroll_top',$default['ed_footer_scroll_top'] ) );

if( $ed_mid_header_search ){ ?>

    <div class="popup-search">
        
        <a class="skip-link-search" href="javascript:void(0)"></a>
        <a href="javascript:void(0)" class="close-popup"></a>

        <div class="popup-search-wrapper">
            <div class="popup-search-form">
                <?php get_search_form(); ?>
            </div>
        </div>
        
    </div>
    
<?php } ?>

<?php if ( is_active_sidebar('blog-prime-offcanvas-widget') ): ?>
    <div id="sidr-nav">
        <a class="skip-link-offcanvas-first" href="javascript:void(0)"></a>
        <a class="sidr-offcanvas-close" href="#sidr-nav">
           <span>
               <?php echo esc_html__('Close','blog-prime'); ?>
            </span>
        </a>
        <div class="sidr-area">
            <?php dynamic_sidebar('blog-prime-offcanvas-widget'); ?>
        </div>
        <a class="skip-link-offcanvas-last" href="javascript:void(0)"></a>
    </div>
<?php endif; ?>

<?php if( is_front_page() ):
    // Home Recommended Post.
    blog_prime_recommended_posts();
endif; ?>

<?php if( is_singular('post') ):
    // Single Posts Related Posts.
    blog_prime_related_posts();
endif;

if( $ed_footer_scroll_top ){ ?>

    <div class="scroll-up">
        <i class="ion ion-md-arrow-dropup"></i>
    </div>

<?php } ?>
