<?php
/**
 * General Settings
 *
 * @package Influencer
 */

function influencer_customize_register_general_settings( $wp_customize ) {

    $wp_customize->add_panel( 
        'general_settings',
        array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'General Settings', 'influencer' ),
        ) 
    );

    /** Archive Header Image Settings */
    $wp_customize->add_section( 
        'custom_header_image_settings',
         array(
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Header Images', 'influencer' ),
            'panel'       => 'general_settings',
        ) 
    );

    /** Archive Header Image */
    $wp_customize->add_setting( 'blog_header_image',
        array(
            'default'           => get_template_directory_uri() . '/images/default-header-bg.jpg',
            'sanitize_callback' => 'influencer_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'blog_header_image',
            array(
                'label'         => esc_html__( 'Header Image For Blog Page', 'influencer' ),
                'description'   => esc_html__( 'Choose Header Image of your choice for Blog Pages. Recommended size for this image is 1920px by 570px.', 'influencer' ),
                'section'       => 'custom_header_image_settings',
                'type'          => 'image',
            )
        )
    );

    /** Archive Header Image */
    $wp_customize->add_setting( 'archive_header_image',
        array(
            'default'           => get_template_directory_uri() . '/images/default-header-bg.jpg',
            'sanitize_callback' => 'influencer_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'archive_header_image',
            array(
                'label'         => esc_html__( 'Header Image For Archive Page', 'influencer' ),
                'description'   => esc_html__( 'Choose Header Image of your choice for Archive Pages. Recommended size for this image is 1920px by 570px.', 'influencer' ),
                'section'       => 'custom_header_image_settings',
                'type'          => 'image',
            )
        )
    );

    /** Search Header Image */
    $wp_customize->add_setting( 'search_header_image',
        array(
            'default'           => get_template_directory_uri() . '/images/default-header-bg.jpg',
            'sanitize_callback' => 'influencer_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'search_header_image',
            array(
                'label'         => esc_html__( 'Header Image For Search Page', 'influencer' ),
                'description'   => esc_html__( 'Choose Header Image of your choice for Search Page. Recommended size for this image is 1920px by 570px', 'influencer' ),
                'section'       => 'custom_header_image_settings',
                'type'          => 'image',
            )
        )
    );

    /** 404 Header Image */
    $wp_customize->add_setting( '404_header_image',
        array(
            'default'           => get_template_directory_uri() . '/images/default-header-bg.jpg',
            'sanitize_callback' => 'influencer_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, '404_header_image',
            array(
                'label'         => esc_html__( 'Header Image For 404 Page', 'influencer' ),
                'description'   => esc_html__( 'Choose Header Image of your choice for 404 Page. Recommended size for this image is 1920px by 570px', 'influencer' ),
                'section'       => 'custom_header_image_settings',
                'type'          => 'image',
            )
        )
    );
    
    /** Menu Settings */
    $wp_customize->add_section( 
        'menu_settings',
         array(
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Header Button Settings', 'influencer' ),
            'panel'       => 'general_settings',
        ) 
    );

    /** Menu button label */
    $wp_customize->add_setting( 'menu_button_label',
        array(
            'default'           => esc_html__( 'Start Here','influencer' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control( 'menu_button_label',
        array(
            'label'         => esc_html__( 'Menu Button Label', 'influencer' ),
            'description'   => esc_html__( 'Option to change label for button on menu.', 'influencer' ),
            'section'       => 'menu_settings',
            'type'          => 'text',
        )
    );

    // selective refresh for menu button label
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'menu_button_label', array(
            'selector'            => '.nav-wrap .main-navigation .menu-start-button',
            'settings'            => 'menu_button_label',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_menu_button_label',
        ) );
    }
    /** Menu button label */
    $wp_customize->add_setting( 'menu_button_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control( 'menu_button_url',
        array(
            'label'         => esc_html__( 'Menu Button URL', 'influencer' ),
            'description'   => esc_html__( 'Option to set URL for button on menu.', 'influencer' ),
            'section'       => 'menu_settings',
            'type'          => 'url',
        )
    );

    /** Sidebar Layout Settings */
    $wp_customize->add_section( 
        'post_page_settings',
         array(
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Posts & Pages Settings', 'influencer' ),
            'panel'       => 'general_settings',
        ) 
    );

    /** Disable posted On  */
    $wp_customize->add_setting( 
        'disable_posted_on', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox',

        ) 
    );
    
    $wp_customize->add_control(
        'disable_posted_on',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Hide Posted On', 'influencer' ),
            'description' => esc_html__( 'Option to hide posted on detail of post.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    /** Disable posted by  */
    $wp_customize->add_setting( 
        'disable_posted_by', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox',

        ) 
    );
    
    $wp_customize->add_control(
        'disable_posted_by',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Hide Author Name', 'influencer' ),
            'description' => esc_html__( 'Option to hide author name of post.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    /** Disable comments  */
    $wp_customize->add_setting( 
        'disable_post_comments', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox',

        ) 
    );
    
    $wp_customize->add_control(
        'disable_post_comments',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Hide comments Number', 'influencer' ),
            'description' => esc_html__( 'Option to hide comments count of post.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    /** Enable Author Bio-data */
    $wp_customize->add_setting( 
        'disable_author_bio', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox',

        ) 
    );
    
    $wp_customize->add_control(
        'disable_author_bio',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Hide Author Bio', 'influencer' ),
            'description' => esc_html__( 'Option to hide author bio-data on posts.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    /** Enable Related Posts Section */
    $wp_customize->add_setting( 
        'disable_related_posts', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox',
        ) 
    );
    
    $wp_customize->add_control(
        'disable_related_posts',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Disable Related Posts', 'influencer' ),
            'description' => esc_html__( 'Options to hide related posts.', 'influencer' ),
            'type'        => 'checkbox',
        )
    );

    /** Menu button label */
    $wp_customize->add_setting( 'related_posts_label',
        array(
            'default'           => esc_html__( 'You Might Also Like...', 'influencer' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control( 'related_posts_label',
        array(
            'label'         => esc_html__( 'Related Posts Label', 'influencer' ),
            'description'   => esc_html__( 'Option to change label for related posts on single.', 'influencer' ),
            'section'       => 'post_page_settings',
            'type'          => 'text',
            'active_callback' => 'influencer_related_post_active_cb',
        )
    );

    // selective refresh for related posts label
    // Abort if selective refresh is not available.
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'related_posts_label', array(
            'selector'            => '.related-post .related-post-title',
            'settings'            => 'related_posts_label',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'influencer_customize_partial_related_posts_label',
        ) );
    }

    /** Excerpt Length */
    $wp_customize->add_setting( 
        'custom_excerpt_length', 
        array(
            'default'           => 25,
            'sanitize_callback' => 'influencer_sanitize_number_absint',
        ) 
    );
    
    $wp_customize->add_control( new Influencer_Slider_Control( 
        $wp_customize,
        'custom_excerpt_length',
            array(
                'section'     => 'post_page_settings',
                'label'       => esc_html__( 'Excerpt Length', 'influencer' ),
                'description' => esc_html__( 'Automatically generated excerpt length (in words).', 'influencer' ),
                'choices'     => array(
                    'min'           => 15,
                    'max'           => 100,
                    'step'          => 1,
                ),                 
            )
        )
    );

    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'influencer' ),
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'influencer_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control( 'ed_post_update_date',
        array(
            'section'     => 'seo_settings',
            'label'       => __( 'Enable Last Update Post Date', 'influencer' ),
            'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'influencer' ),
            'type'        => 'checkbox'
        )
    );
    
    /** SEO Settings Ends */
    $wp_customize->add_section(
        'newsletter_section',
        array(
            'title'    => __( 'Newsletter Section', 'influencer' ),
            'panel'       => 'general_settings',
        )
    );

    /** Blog Newsletter Shortcode */
    $wp_customize->add_setting(
        'blog_newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'blog_newsletter_shortcode',
        array(
            'type'        => 'text',
            'section'     => 'newsletter_section',
            'priority'    => 20,
            'label'       => esc_html__( 'Newsletter Shortcode', 'influencer' ),
            'description' => esc_html__( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'influencer' ),
        )
    );

}
add_action( 'customize_register', 'influencer_customize_register_general_settings' );