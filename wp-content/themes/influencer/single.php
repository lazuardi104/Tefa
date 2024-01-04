<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Influencer
 */

get_header();
$sidebar_layout = influencer_sidebar( true );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				/**
				* @hooked - influencer_single_about_author - 10
				* @hooked - influencer_pagination_start - 20
				*/
				do_action( 'influencer_single_content' );
				
				if( $sidebar_layout == 'rightsidebar' || $sidebar_layout == 'leftsidebar' ) {
					influencer_single_related_posts( 4 );
				}

				/**
				* @hooked - influencer_comments_start
				*/
				do_action( 'influencer_comments' );
			
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php 
		if( $sidebar_layout == 'full-width' || $sidebar_layout == ' full-width centered-layout' ) {
			influencer_single_related_posts( 6 );
		}
get_sidebar(); 
get_footer();
