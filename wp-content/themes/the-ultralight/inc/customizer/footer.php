<?php
/**
 * The Ultralight Footer Setting
 *
 * @package The_Ultralight
 */

function the_ultralight_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'the-ultralight' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'   => __( 'Footer Copyright Text', 'the-ultralight' ),
            'section' => 'footer_settings',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.copyright-menu-wrap .copyright',
        'render_callback' => 'the_ultralight_get_footer_copyright',
    ) );
        
}
add_action( 'customize_register', 'the_ultralight_customize_register_footer' );