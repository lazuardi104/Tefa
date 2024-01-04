<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Influencer
 */
$blog_layout_option = get_theme_mod( 'blog_layout_option', 'default-layout' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	
	<?php 
	if( ( $blog_layout_option == 'default-layout' ) || is_archive() || is_search() ) {
		influencer_entry_header_content();
		influencer_entry_content_default();
	}else{
		influencer_post_thumbnail();
		influencer_entry_content_grid();
	}
	?>  

</article><!-- #post-<?php the_ID(); ?> -->
