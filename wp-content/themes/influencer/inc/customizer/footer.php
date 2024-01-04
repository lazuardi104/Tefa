<?php
/**
 * Footer Setting
 *
 * @package Influencer
 */

function influencer_customize_register_footer( $wp_customize ) {
    
    $default_value = sprintf( __( '&copy; Copyright %1$s %2$s. All Rights Reserved.', 'influencer'), date_i18n( __( 'Y', 'influencer' ) ), '<a href="'. esc_url( home_url( '/' ) ).'">'. get_bloginfo( 'name' ) .'</a>'  );

    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => esc_html__( 'Footer Settings', 'influencer' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting( 'copyright_text',
        array(
            'default'           => $default_value,
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control( 'copyright_text',
        array(
            'label'         => esc_html__( 'Footer Copyright Text', 'influencer' ),
            'description'   => esc_html__( 'Add Copyright Text Here.', 'influencer' ),
            'section'       => 'footer_settings',
            'type'          => 'textarea',
        )
    );

    // selective refresh for footer copyright text
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'copyright_text', array(
            'selector'            => '.cm-wrapper .copyright span.copyright-text',
            'settings'            => 'copyright_text',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_footer_copyright',
        ) );
    }
}
add_action( 'customize_register', 'influencer_customize_register_footer' );