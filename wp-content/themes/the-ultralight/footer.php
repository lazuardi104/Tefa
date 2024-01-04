<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Ultralight
 */
    /**
     * After Footer
     * the_ultralight_single_related_post - 30
     * @hooked the_ultralight_content_end - 20
     * @hooked the_ultralight_page_end - 50
    */
    do_action( 'the_ultralight_after_footer' );
    
    /**
     * After Content
     * 
     * @hooked the_ultralight_content_end - 20
    */
    do_action( 'the_ultralight_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked the_ultralight_footer_start  - 20
     * @hooked the_ultralight_footer_top    - 30
     * @hooked the_ultralight_footer_bottom - 40
     * @hooked the_ultralight_footer_end    - 50
    */
    do_action( 'the_ultralight_footer' );
    
    

    wp_footer(); ?>

</body>
</html>
