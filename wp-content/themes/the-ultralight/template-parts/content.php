<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Ultralight
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); if( ! is_single() ) echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php 
        /**
         * @hooked the_ultralight_entry_header   - 15 
         * @hooked the_ultralight_post_thumbnail - 20
        */
        do_action( 'the_ultralight_before_post_entry_content' );
    
        /**
         * @hooked the_ultralight_entry_content - 15
         * @hooked the_ultralight_entry_footer  - 20
        */
        do_action( 'the_ultralight_post_entry_content' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
