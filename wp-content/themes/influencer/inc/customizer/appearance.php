<?php
/**
 * Appearance Options
 *
 * @package Influencer
 */

if( ! function_exists( 'influencer_customize_register_appearance' ) ) :
    
    function influencer_customize_register_appearance( $wp_customize ) {

        /** Appearance Settings */
        $wp_customize->add_panel( 
            'appearance_settings',
             array(
                'priority'    => 50,
                'capability'  => 'edit_theme_options',
                'title'       => esc_html__( 'Appearance Settings', 'influencer' ),
            ) 
        );     
        
        /** Typography */
        $wp_customize->add_section(
            'typography_settings',
            array(
                'title'    => __( 'Typography', 'influencer' ),
                'priority' => 80,
                'panel'    => 'appearance_settings',
            )
        );

        $wp_customize->add_setting(
            'ed_localgoogle_fonts',
            array(
                'default'           => false,
                'sanitize_callback' => 'influencer_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            'ed_localgoogle_fonts',
            array(
                'label'   => __( 'Load Google Fonts Locally', 'influencer' ),
                'section' => 'typography_settings',
                'type'    => 'checkbox',
            )
        );
    
        $wp_customize->add_setting(
            'ed_preload_local_fonts',
            array(
                'default'           => false,
                'sanitize_callback' => 'influencer_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
            'ed_preload_local_fonts',
            array(
                'label'           => __( 'Preload Local Fonts', 'influencer' ),
                'section'         => 'typography_settings',
                'type'            => 'checkbox',
                'active_callback' => 'influencer_flush_fonts_callback'
            )
        );
        
        $wp_customize->add_setting(
            'flush_google_fonts',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses',
            )
        );
    
        $wp_customize->add_control(
            'flush_google_fonts',
            array(
                'label'       => __( 'Flush Local Fonts Cache', 'influencer' ),
                'description' => __( 'Click the button to reset the local fonts cache.', 'influencer' ),
                'type'        => 'button',
                'settings'    => array(),
                'section'     => 'typography_settings',
                'input_attrs' => array(
                    'value' => __( 'Flush Local Fonts Cache', 'influencer' ),
                    'class' => 'button button-primary flush-it',
                ),
                'active_callback' => 'influencer_flush_fonts_callback'
            )
        );
        
        $wp_customize->get_section( 'colors' )->panel               = 'appearance_settings';
        $wp_customize->get_section( 'background_image' )->panel     = 'appearance_settings';            
    }
endif;
add_action( 'customize_register', 'influencer_customize_register_appearance' );

function influencer_flush_fonts_callback( $control ){
    $ed_localgoogle_fonts   = $control->manager->get_setting( 'ed_localgoogle_fonts' )->value();
    $control_id   = $control->id;
    
    if ( $control_id == 'flush_google_fonts' && $ed_localgoogle_fonts ) return true;
    if ( $control_id == 'ed_preload_local_fonts' && $ed_localgoogle_fonts ) return true;
    return false;
}