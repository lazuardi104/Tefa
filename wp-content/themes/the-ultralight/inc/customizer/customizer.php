<?php
/**
 * The Ultralight Theme Customizer
 *
 * @package The_Ultralight
 */

/**
 * Requiring customizer panels & sections
*/
$the_ultralight_panels = array( 'info','site', 'layout', 'general', 'footer','performance' );

foreach( $the_ultralight_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_ultralight_customize_preview_js() {
	wp_enqueue_script( 'the-ultralight-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), THE_ULTRALIGHT_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'the_ultralight_customize_preview_js' );

function the_ultralight_customize_script(){
    wp_enqueue_style( 'the-ultralight-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), THE_ULTRALIGHT_THEME_VERSION );
    wp_enqueue_script( 'the-ultralight-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'customize-preview' ), THE_ULTRALIGHT_THEME_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'the_ultralight_customize_script' );
