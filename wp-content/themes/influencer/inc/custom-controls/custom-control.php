<?php
if( ! function_exists( 'influencer_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function influencer_register_custom_controls( $wp_customize ){
    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/custom-controls/slider/class-slider-control.php';

    // Register the control type.
    $wp_customize->register_control_type( 'Influencer_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Influencer_Slider_Control' );
    
}
endif;
add_action( 'customize_register', 'influencer_register_custom_controls' );