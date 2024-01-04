<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Influencer
 */

?>
<div class="article-group">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		<?php 
			/**
			* influencer_singular_content Hook
			* 
			* @hooked influencer_single_entry_content_start
			*/
			do_action( 'influencer_singular_content' );
		?>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
