<?php
/**
 * The Ultralight Custom Control
 * 
 * @package The_Ultralight
*/

if( ! function_exists( 'the_ultralight_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function the_ultralight_register_custom_controls( $wp_customize ){    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/custom-controls/slider/class-slider-control.php';
    require_once get_template_directory() . '/inc/custom-controls/toggle/class-toggle-control.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'The_Ultralight_Radio_Image_Control' );
    $wp_customize->register_control_type( 'The_Ultralight_Slider_Control' );
    $wp_customize->register_control_type( 'The_Ultralight_Toggle_Control' );
}
endif;
add_action( 'customize_register', 'the_ultralight_register_custom_controls' );