<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Influencer
 */
global $wp_query;
get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>
			<?php echo '<span class="result-count">' . sprintf( esc_html__( 'Showing %1$s Result(s)%2$s', 'influencer' ), '<strong>' . esc_html( number_format_i18n( $wp_query->found_posts ) ), '</strong>' ) . '</span>'; ?>
			<div class="article-group">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile; ?> 
			</div>
			<?php 
			/**
			* @hooked - influencer_pagination_start
			*/
			do_action( 'influencer_pagination' ); 

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_sidebar(); 
get_footer();
