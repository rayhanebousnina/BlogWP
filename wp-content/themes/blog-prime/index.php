<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog_Prime
 */

get_header();
$default = blog_prime_get_default_theme_options();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			<?php 
	        if( is_front_page() ):
	            blog_prime_slider();
	        endif;
		    
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif; ?>

				<div class="article-wraper">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile; ?>
				</div>

				<?php blog_prime_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
$home_sidebar_layout = esc_html( get_theme_mod( 'home_sidebar_layout',$default['home_sidebar_layout'] ) );
if( $home_sidebar_layout != 'no-sidebar' ):
	get_sidebar();
endif;
get_footer();
