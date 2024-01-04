<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Ultralight
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        /**
         * Post Thumbnail
         * @hooked the_ultralight_entry_header - 10
         * @hooked the_ultralight_post_thumbnail - 20
        */
        do_action( 'the_ultralight_before_page_entry_content' );
    
        /**
         * Entry Content
         * 
         * @hooked the_ultralight_entry_content - 15
         * @hooked the_ultralight_entry_footer  - 20
        */
        do_action( 'the_ultralight_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
