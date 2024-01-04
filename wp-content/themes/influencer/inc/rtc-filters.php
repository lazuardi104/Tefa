<?php
/**
 * Filter to modify functionality of RTC plugin.
 *
 * @package Influencer
 */

if( ! function_exists( 'influencer_featured_page_section_image_size' ) ){
	/**
	 * Filter to add bg color of cta section widget
	 */    
	function influencer_featured_page_section_image_size(){
		return 'influencer-featured-page';
	}
}
add_filter( 'rrtc_featured_img_size', 'influencer_featured_page_section_image_size' );

if( ! function_exists( 'influencer_cta_section_bgcolor_filter' ) ){
	/**
	 * Filter to add bg color of cta section widget
	 */    
	function influencer_cta_section_bgcolor_filter(){
		return '#083ea7';
	}
}
add_filter( 'rrtc_cta_bg_color', 'influencer_cta_section_bgcolor_filter' );

if( ! function_exists( 'influencer_ad_image' ) ) :
    function influencer_ad_image(){
        return 'full';
    }
endif;
add_filter( 'bttk_ad_img_size', 'influencer_ad_image' );

if( ! function_exists( 'influencer_newsletter_bg_color' ) ) :
    function influencer_newsletter_bg_color(){
        return '#083ea7';
    }
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'influencer_newsletter_bg_color' );