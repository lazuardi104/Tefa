<?php
/**
 * The Ultralight Customizer Partials
 *
 * @package The_Ultralight
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function the_ultralight_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function the_ultralight_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'the_ultralight_get_banner_title_render' ) ) :
/**
 * Display blog readmore button
*/
function the_ultralight_get_banner_title_render(){
    return esc_html(get_theme_mod( 'banner_title', __( 'Perfectionist at Every Level', 'the-ultralight' ) ));
}
endif;

if( ! function_exists( 'the_ultralight_get_header_nl_note' ) ) :
/**
 * Newsletter Bottom Note
*/
function the_ultralight_get_header_nl_note(){
    return esc_html(get_theme_mod( 'newsletter_bottom_note', __( 'One email per week. Zero spam or ads.', 'the-ultralight' ) ));
}
endif;

if( ! function_exists( 'the_ultralight_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function the_ultralight_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'Read More', 'the-ultralight' ) ) );    
}
endif;


if( ! function_exists( 'the_ultralight_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function the_ultralight_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'Recommended for you...', 'the-ultralight' ) ) );
}
endif;

if( ! function_exists( 'the_ultralight_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function the_ultralight_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'the-ultralight' );
        echo date_i18n( esc_html__( 'Y', 'the-ultralight' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'the-ultralight' );
    }
    echo '</span>'; 
}
endif;