<?php
/**
 * Influencer Theme Customizer
 *
 * @package Influencer
 */

/**
 * Requiring customizer panels & sections
*/
$influencer_panels = array( 'info', 'site', 'appearance', 'layout', 'front-page', 'general', 'footer' );

foreach( $influencer_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function influencer_customize_preview_js() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $unminify  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/unminify' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
	wp_enqueue_script( 'influencer-customizer', get_template_directory_uri() . '/js' . $unminify . '/customizer' . $suffix . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'influencer_customize_preview_js' );

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/customizer/partials.php';
/**
 * Add customizer active callback functions
 */
require get_template_directory() . '/inc/customizer/active-callback.php';
/**
 * Sanitization Functions.
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Enqueue scripts and styles for customizer.
 */
function influencer_customizer_scripts() {

	wp_enqueue_style( 'influencer-customize', get_template_directory_uri() . '/inc/css/customize-controls.css', array(), false, 'screen' );

    $home_template_url = get_permalink( get_option( 'page_on_front' ) );
    $array = array(
        'url1'          => $home_template_url,
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
    	'flushit'    => __( 'Successfully Flushed!','influencer' ),
    	'nonce'      => wp_create_nonce('ajax-nonce')
    );

    wp_enqueue_script( 'influencer-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), INFLUENCER_THEME_VERSION, true );
    wp_localize_script( 'influencer-customize', 'influencer_customizer_data', $array ); 

}
add_action( 'customize_controls_enqueue_scripts', 'influencer_customizer_scripts' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

$config_customizer = array(
    'recommended_plugins' => array( 
        'raratheme-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'influencer' ), '<strong>RaraTheme Companion</strong>' 
            ),
        ),
    ),
    'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'influencer' ),
    'install_button_label'      => esc_html__( 'Install and Activate', 'influencer' ),
    'activate_button_label'     => esc_html__( 'Activate', 'influencer' ),
    'deactivate_button_label'   => esc_html__( 'Deactivate', 'influencer' ),
);
Influencer_Customizer_Notice::init( apply_filters( 'influencer_customizer_notice_array', $config_customizer ) );