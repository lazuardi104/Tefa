<?php
/**
 * Partials for Selective Refresh
 * 
 * @package Influencer
 */

 /**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function influencer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function influencer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Prints footer copyright
*/
function influencer_customize_partial_footer_copyright() {
	
    $default_value = sprintf( __( '&copy; Copyright %1$s %2$s. All Rights Reserved.', 'influencer'), date_i18n( __( 'Y', 'influencer' ) ), '<a href="'. esc_url( home_url( '/' ) ).'">'. get_bloginfo( 'name' ) .'</a>'  );
    $copyright = get_theme_mod( 'copyright_text', $default_value );

    if( $copyright ){
        echo '<span class="copyright-text">' . wp_kses_post( $copyright ) . '</span>';
    }else{        
        esc_html_e( '&copy; Copyright ', 'influencer' ); 
        echo date_i18n( esc_html__( 'Y', 'influencer' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';    
    }   
}

/**
 * Render the menu button label for the selective refresh partial.
 */
function influencer_customize_partial_menu_button_label() {
    return esc_html( get_theme_mod( 'menu_button_label', __( 'Start Here','influencer' ) ) );
}

/**
 * Render the latest news title for the selective refresh partial.
 */
function influencer_customize_partial_latest_news_title() {
    return esc_html( get_theme_mod( 'latest_news_title', __( 'Latest Articles','influencer' ) ) );
}

/**
 * Render the latest news subtitle for the selective refresh partial.
 */
function influencer_customize_partial_latest_news_subtitle() {
    return esc_html( get_theme_mod( 'latest_news_subtitle', __( 'Tips for getting things done','influencer' ) ) );
}

/**
 * Render the related posts label for the selective refresh partial.
 */
function influencer_customize_partial_related_posts_label() {
    return esc_html( get_theme_mod( 'related_posts_label', __( 'You Might Also Like...','influencer' ) ) );
}