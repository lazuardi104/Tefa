<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package The_Ultralight
 */

get_header(); ?>

	<section id="primary" class="content-area">
		
        <?php 
        /**
         * Before Posts hook
        */
        do_action( 'the_ultralight_before_posts_content' );
        ?>
        
        <main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
        
        
            /**
             * After Posts hook
             * @hooked the_ultralight_search_form - 20
            */
            do_action( 'the_ultralight_search_query' );
            
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
        
        <?php
        /**
         * After Posts hook
         * @hooked the_ultralight_navigation - 15
        */
        do_action( 'the_ultralight_after_posts_content' );
        ?>
        
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
