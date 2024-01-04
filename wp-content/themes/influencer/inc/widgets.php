<?php
/**
 * Widgets Area
 *
 * @package Influencer
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function influencer_widgets_init() {

    $sidebars = array(
        'sidebar'           => array(
            'name'          => esc_html__( 'Sidebar', 'influencer' ),
            'id'            => 'sidebar', 
            'description'   => esc_html__( 'Add widgets here.', 'influencer' ),
        ),
        'logo-sidebar'      => array(
            'name'          => esc_html__( 'Logo Section', 'influencer' ),
            'id'            => 'logo-sidebar',
            'description'   => esc_html__( 'Add "Rara: Client Logo" Widget for logo section.', 'influencer' ),
        ),
        'featured-page-sidebar' => array(
            'name'          => esc_html__( 'About Section', 'influencer' ),
            'id'            => 'featured-page-sidebar',
            'description'   => esc_html__( 'Add "Rara: A Featured Page Widget" for about section.', 'influencer' ),
        ),
        'service-sidebar' => array(
            'name'          => esc_html__( 'Service Section', 'influencer' ),
            'id'            => 'service-sidebar',
            'description'   => esc_html__( 'Add "Text" and "Rara: Icon Text" Widget for service section.', 'influencer' ),
        ),
        'testimonial-sidebar' => array(
            'name'          => esc_html__( 'Testimonial Section', 'influencer' ),
            'id'            => 'testimonial-sidebar',
            'description'   => esc_html__( 'Add "Text" and "Rara: Testimonial" Widget for testimonial section.', 'influencer' ),
        ),
        'cta-sidebar' => array(
            'name'          => esc_html__( 'Call To Action Section', 'influencer' ),
            'id'            => 'cta-sidebar',
            'description'   => esc_html__( 'Add "Rara: Call To Action" Widget for call to action section.', 'influencer' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'influencer' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'influencer' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'influencer' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'influencer' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'influencer' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'influencer' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'influencer' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'influencer' ),
        ),
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
            'name'          => esc_html( $sidebar['name'] ),
            'id'            => esc_attr( $sidebar['id'] ),
            'description'   => esc_html( $sidebar['description'] ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}
add_action( 'widgets_init', 'influencer_widgets_init' );