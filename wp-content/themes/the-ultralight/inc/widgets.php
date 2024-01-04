<?php
/**
 * The Ultralight Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package The_Ultralight
 */

function the_ultralight_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'the-ultralight' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'the-ultralight' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'the-ultralight' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'the-ultralight' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'the-ultralight' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'the-ultralight' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'the-ultralight' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'the-ultralight' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
}
add_action( 'widgets_init', 'the_ultralight_widgets_init' );