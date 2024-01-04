<?php
/**
 * The Ultralight General Settings
 *
 * @package The_Ultralight
 */

function the_ultralight_customize_register_general( $wp_customize ) {
	
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 85,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'the-ultralight' ),
            'description' => __( 'Customize Banner, Featured, Social, SEO, Post/Page, Newsletter, Instagram & Shop settings.', 'the-ultralight' ),
        ) 
    );
    
    $wp_customize->get_section( 'header_image' )->panel    = 'general_settings';
    $wp_customize->get_section( 'header_image' )->title    = __( 'Banner Section', 'the-ultralight' );
    $wp_customize->get_section( 'header_image' )->priority = 10;
    $wp_customize->get_section( 'header_image' )->description = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport = 'refresh';
    
    /** Enable Banner Section */
    $wp_customize->add_setting( 
        'ed_banner_area', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_ultralight_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new The_Ultralight_Toggle_Control( 
            $wp_customize,
            'ed_banner_area',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Enable Banner Area', 'the-ultralight' ),
                'description' => __( 'Enable to show Banner Area in home page.', 'the-ultralight' ),
                'priority' => 1,
            )
        )
    );
    
    /** Banner Author Image */
    $wp_customize->add_setting( 
        'banner_author_image', 
        array(
            'default'           => false,
            'sanitize_callback' => 'esc_url_raw'
        ) 
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'banner_author_image',
           array(
               'label'      => __( 'Banner Author Image', 'the-ultralight' ),
               'description' => __( 'Recommended Image dimension 100px x 100px.', 'the-ultralight' ),
               'section'    => 'header_image',
               'settings'   => 'banner_author_image',
           )
       )
   );
   
    if( the_ultralight_is_btnw_activated() ){
        
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
                'type'        => 'text',
                'section'     => 'header_image',
                'label'       => __( 'Newsletter Shortcode', 'the-ultralight' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'the-ultralight' ),
            )
        );
        
        $wp_customize->add_setting(
            'newsletter_bottom_note',
            array(
                'default'           =>  __( 'One email per week. Zero spam or ads.', 'the-ultralight' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage' 
            )
        );
        
        $wp_customize->add_control(
            'newsletter_bottom_note',
            array(
                'type'        => 'text',
                'section'     => 'header_image',
                'label'       => __( 'Newsletter Short Note', 'the-ultralight' ),
            )
        );
        $wp_customize->selective_refresh->add_partial( 'newsletter_bottom_note', array(
            'selector' => '.header-nl-note p',
            'render_callback' => 'the_ultralight_get_header_nl_note',
        ) );
                
    }else{
        /** Note */
        $wp_customize->add_setting(
            'newsletter_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new The_Ultralight_Note_Control( 
                $wp_customize,
                'newsletter_text',
                array(
                    'section'     => 'header_image',
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'the-ultralight' ), '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );
    }
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'the-ultralight' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_ultralight_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'the-ultralight' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'the-ultralight' ),
			)
		)
	);
        
    /** SEO Settings Ends */
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'the-ultralight' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_ultralight_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'the-ultralight' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'the-ultralight' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 55,
            'sanitize_callback' => 'the_ultralight_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'the-ultralight' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'the-ultralight' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				),
                'active_callback' => 'the_ultralight_ed_excerpt_ac'
			)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Read More', 'the-ultralight' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'the-ultralight' ),
            'active_callback' => 'the_ultralight_ed_excerpt_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-wrap a',
        'render_callback' => 'the_ultralight_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new The_Ultralight_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
				'description' => __( '<hr/>These options affect your individual posts.', 'the-ultralight' ),
			)
		)
    );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_ultralight_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'the-ultralight' ),
                'description' => __( 'Enable to show related posts in single page.', 'the-ultralight' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'Recommended for you...', 'the-ultralight' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Related Posts Section Title', 'the-ultralight' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.entry-header .recommended',
        'render_callback' => 'the_ultralight_get_related_title',
    ) );
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_ultralight_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Featured Image', 'the-ultralight' ),
                'description' => __( 'Enable to show featured image in post detail (single post).', 'the-ultralight' ),
			)
		)
	);
    /** Posts(Blog) & Pages Settings Ends */
    
    /** Shop Settings */
    $wp_customize->add_section(
        'shop_settings',
        array(
            'title'    => __( 'Shop Settings', 'the-ultralight' ),
            'priority' => 80,
            'panel'    => 'general_settings',
        )
    );
    
}
add_action( 'customize_register', 'the_ultralight_customize_register_general' );