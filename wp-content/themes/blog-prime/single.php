<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blog_Prime
 */

get_header();
$default = blog_prime_get_default_theme_options();
global $post;
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', get_post_type());

                if( !class_exists( 'Booster_Extension_Class') ){
                    blog_prim_single_author_section();
                } ?>

                <div class="twp-navigation-wrapper"><?php

                // Previous/next post navigation.
                the_post_navigation(array(
                    'next_text' => '<h2 class="entry-title entry-title-medium" aria-hidden="true">' . esc_html__('Next', 'blog-prime') . '</h2> ' .
                        '<span class="screen-reader-text">' . esc_html__('Next post:', 'blog-prime') . '</span> ' .
                        '<h3 class="entry-title entry-title-small">%title</h3>',
                    'prev_text' => '<h2 class="entry-title entry-title-medium" aria-hidden="true">' . esc_html__('Previous', 'blog-prime') . '</h2> ' .
                        '<span class="screen-reader-text">' . esc_html__('Previous post:', 'blog-prime') . '</span> ' .
                        '<h3 class="entry-title entry-title-small">%title</h3>',
                )); ?>

                </div><?php

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
$global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout', $default['global_sidebar_layout'] ) );
$blog_prime_post_sidebar_option = esc_html( get_post_meta( $post->ID, 'blog_prime_post_sidebar_option', true ) );

if ( $blog_prime_post_sidebar_option == 'global-sidebar' || empty( $blog_prime_post_sidebar_option ) ) {
    $blog_prime_post_sidebar_option = $global_sidebar_layout;
}

if ( $blog_prime_post_sidebar_option != 'no-sidebar' ):

    get_sidebar();

endif;

get_footer();
