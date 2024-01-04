<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Influencer
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<div class="page-content">
					<div class="error-num"><?php esc_html_e( '404','influencer' ); ?></div>
					<a class="bttn" href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e( 'Take me to the home page','influencer' );?></a>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
				<?php 
				/**
			     * Latest Posts On 404
			     * 
			     * @hooked influencer_404_latest_posts
			    */
			    do_action( 'influencer_404_posts' ); ?>

			</section><!-- .error-404 --> 		
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
get_footer();
