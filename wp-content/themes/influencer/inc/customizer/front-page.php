<?php
/**
 * FrontPage Settings
 *
 * @package Influencer
 */

function influencer_customize_register_frontpage( $wp_customize ) { 

	
    /** FrontPage Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'FrontPage Settings', 'influencer' ),
        ) 
    );

	/** Banner And Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => esc_html__( 'Banner And Newsletter Section', 'influencer' ),
            'priority' => 60,
            'panel'    => 'frontpage_settings',
        )
    );
    
    /** Enable banner Section */
    $wp_customize->add_setting( 
        'enable_banner_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'influencer_sanitize_checkbox',

        ) 
    );
    
    $wp_customize->add_control(
        'enable_banner_section',
        array(
            'section'     => 'newsletter_settings',
            'priority'    => -1,
            'label'       => esc_html__( 'Enable Banner Section', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    $wp_customize->get_control( 'header_image' )->section   = 'newsletter_settings';
    $wp_customize->get_control( 'header_image' )->active_callback   = 'influencer_banner_active_cb';
    
    /** Newsletter Shortcode */
    $wp_customize->add_setting(
        'newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'newsletter_shortcode',
        array(
            'active_callback' => 'influencer_banner_active_cb',
            'type'        => 'text',
            'section'     => 'newsletter_settings',
            'label'       => esc_html__( 'Newsletter Shortcode', 'influencer' ),
            'description' => esc_html__( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'influencer' ),
        )
    );

    /** blog section Settings */
    $wp_customize->add_section(
        'latest_news_settings',
        array(
            'title'    => esc_html__( 'Blog Section', 'influencer' ),
            'panel'    => 'frontpage_settings',
        )
    );

    //enable latest news
    $wp_customize->add_setting(
        'enable_latest_news',
        array(
            'default'           => true,
            'sanitize_callback' => 'influencer_sanitize_checkbox' 
        )
    );
        
    $wp_customize->add_control(
        'enable_latest_news',
        array(
            'section'     => 'latest_news_settings',
            'label'       => esc_html__( 'Enable Blog Section', 'influencer' ),
            'description' => esc_html__( 'Option to enable blog section.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    //title
    $wp_customize->add_setting(
        'latest_news_title',
        array(
            'default'           => esc_html__( 'Latest Articles','influencer' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage', 
        )
    );
        
    $wp_customize->add_control(
        'latest_news_title',
        array(
            'section'     => 'latest_news_settings',
            'label'       => esc_html__( 'Blog Section Title', 'influencer' ),
            'description' => esc_html__( 'Set the title for blog section.', 'influencer' ),
            'active_callback'   => 'influencer_latest_news_active_cb'
        )
    );

    // selective refresh for latest news label
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'latest_news_title', array(
            'selector'            => '.news-section .cm-wrapper .section-title',
            'settings'            => 'latest_news_title',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_latest_news_title',
        ) );
    }

    //subtitle
    $wp_customize->add_setting(
        'latest_news_subtitle',
        array(
            'default'           => esc_html__( 'Tips for getting things done','influencer' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage', 
        )
    );
        
    $wp_customize->add_control(
        'latest_news_subtitle',
        array(
            'section'     => 'latest_news_settings',
            'label'       => esc_html__( 'Blog Section SubTitle', 'influencer' ),
            'description' => esc_html__( 'Set the subtitle for blog section.', 'influencer' ),
            'active_callback'   => 'influencer_latest_news_active_cb'
        )
    );

    // selective refresh for Blog section subtitle
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'latest_news_subtitle', array(
            'selector'            => '.news-section .cm-wrapper .section-subtitle',
            'settings'            => 'latest_news_subtitle',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_latest_news_subtitle',
        ) );
    }

    $wp_customize->add_setting(
        'more_from_blog_title',
        array(
            'default'           => esc_html__( 'More From The Blog','influencer' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage', 
        )
    );
        
    $wp_customize->add_control(
        'more_from_blog_title',
        array(
            'section'     => 'latest_news_settings',
            'label'       => esc_html__( 'More From Blog Title', 'influencer' ),
            'description' => esc_html__( 'Set the title for button.', 'influencer' ),
            'active_callback'   => 'influencer_latest_news_active_cb'
        )
    );

    // selective refresh for Blog label
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'more_from_blog_title', array(
            'selector'            => '#news .cm-wrapper a.bttn .more-from-blog',
            'settings'            => 'more_from_blog_title',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_more_from_blog_title',
        ) );
    }

}
add_action( 'customize_register', 'influencer_customize_register_frontpage' );