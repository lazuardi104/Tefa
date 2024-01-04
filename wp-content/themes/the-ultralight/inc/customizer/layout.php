<?php
/**
 * The Ultralight Layout Settings
 *
 * @package The_Ultralight
 */

function the_ultralight_customize_register_layout( $wp_customize ) {
	
    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'layout_settings',
        array(
            'title'       => __( 'Layout Settings', 'the-ultralight' ),
            'description' => __( 'Change Page, Post and General sidebar layout from here.', 'the-ultralight' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 80,
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_ultralight_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'layout_settings',
				'label'		  => __( 'Page Sidebar Layout', 'the-ultralight' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in repective page.', 'the-ultralight' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_ultralight_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'layout_settings',
				'label'		  => __( 'Post Sidebar Layout', 'the-ultralight' ),
				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in repective post.', 'the-ultralight' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Default Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_ultralight_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Ultralight_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'layout_settings',
				'label'		  => __( 'Default Sidebar Layout', 'the-ultralight' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'the-ultralight' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'the_ultralight_customize_register_layout' );