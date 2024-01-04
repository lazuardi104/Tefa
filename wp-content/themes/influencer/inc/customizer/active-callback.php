<?php
/**
 * Influencer Customizer Active Callback Functions.
 *
 * @package Influencer
 */

/**
 * Active Callback for banner section
*/
function influencer_banner_active_cb( $control ){
    
    $enable_banner      = $control->manager->get_setting( 'enable_banner_section' )->value();
    $control_id         = $control->id;
    
    if ( $control_id == 'newsletter_shortcode' && $enable_banner ) return true;
    if ( $control_id == 'newsletter_text' && $enable_banner ) return true;
    if ( $control_id == 'header_image' && $enable_banner ) return true;

    return false;
}

/**
 * Active Callback for latest news section
*/
function influencer_latest_news_active_cb( $control ){
    
    $enable_banner      = $control->manager->get_setting( 'enable_latest_news' )->value();
    $control_id         = $control->id;

    if ( $control_id == 'latest_news_title' && $enable_banner ) return true;
    if ( $control_id == 'latest_news_subtitle' && $enable_banner ) return true;
    if ( $control_id == 'more_from_blog_title' && $enable_banner ) return true;

    return false;
}

/**
 * Active Callback for related posts
*/
function influencer_related_post_active_cb( $control ){
    $control_id             = $control->id;
    $disable_related_posts  = $control->manager->get_setting( 'disable_related_posts' )->value();
    if ( $control_id == 'related_posts_label' && ( $disable_related_posts == false ) ) return true;
    
    return false;
}