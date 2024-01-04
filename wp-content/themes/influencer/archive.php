<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Influencer
 */
global $wp_query;
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>
			<?php echo '<span class="result-count">' . sprintf( esc_html__( 'Showing %1$s Result(s)%2$s', 'influencer' ), '<strong>' . esc_html( number_format_i18n( $wp_query->found_posts ) ), '</strong>' ) . '</span>'; ?>
			<div class="article-group">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
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
	</div><!-- #primary -->
<?php get_sidebar(); 
get_footer();
