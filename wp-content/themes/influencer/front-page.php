<?php
/**
 * The Site Front Page template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package Influencer
 */

    
$home_page_sections =  influencer_get_home_sections();

if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page    
    include( get_home_template() );
} elseif ( $home_page_sections ){     
    get_header();     
    //If all section are enabled then show custom home page.
    foreach( $home_page_sections as $section ){
        get_template_part( 'sections/' . esc_attr( $section ) );  
    }    
    get_footer();    
} else {
    //If all section are disabled then this respective page template. 
    include( get_page_template() );
}