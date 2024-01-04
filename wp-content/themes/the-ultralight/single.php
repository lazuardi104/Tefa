<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The_Ultralight
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.

        /**
         * @hooked the_ultralight_author_ifo -  20
         */
        do_action('the_ultralight_post_author_info');

        /**
         * After Posts hook
         * @hooked the_ultralight_navigation - 15
        */
        do_action( 'the_ultralight_after_posts_content' );
		?>
        
		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
