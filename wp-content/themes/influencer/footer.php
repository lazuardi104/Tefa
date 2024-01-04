<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Influencer
 */
	/**
     * Primary Wrapper End
     * 
     * @hooked influencer_primary_wrapper_end
    */
    do_action( 'influencer_primary_wrapperend' );

	/**
     * Content End
     * 
     * @hooked influencer_content_end
    */
    do_action( 'influencer_content_end' );

    /**
     * Newsletter On Blog
     * 
     * @hooked influencer_newsletter
    */
    do_action( 'influencer_newsletter', true ); 
	
    /**
     * Footer
     * 
     * @hooked influencer_footer_start    - 10
     * @hooked influencer_footer_top      - 20
     * @hooked influencer_footer_bottom   - 30       
     * @hooked influencer_footer_end      - 40	     
    */
    do_action( 'influencer_footer' );
	    
    ?>
</div><!-- #page -->
</div><!-- #acc-content -->

<?php wp_footer(); ?>

</body>
</html>