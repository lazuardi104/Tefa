<?php
/**
 * Influencer WooCommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Influencer
 */

/**
 * WooCommerce related hooks
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );

/**
 * Declare WooCommerce Support
*/
function influencer_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce' );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'influencer_woocommerce_support');

/**
 * WooCommerce Sidebar
*/
function influencer_woocommerce_widgets_init(){
    register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'influencer' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Sidebar displaying only in WooCommerce pages.', 'influencer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );    
}
add_action( 'widgets_init', 'influencer_woocommerce_widgets_init' );

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function influencer_woocommerce_wrapper(){    
    ?>
    <div class="cm-wrapper">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
    <?php
}
add_action( 'woocommerce_before_main_content', 'influencer_woocommerce_wrapper', 10 );

/**
 * After Content
 * Closes the wrapping divs
*/
function influencer_woocommerce_wrapper_end(){
    ?>
            </main>
        </div>
        <?php 
        /**
         * influencer_woocommerce_sidebar hook
         * 
         * @hooked influencer_woocommerce_sidebar_cb
        */
        do_action( 'influencer_woocommerce_sidebar' ); ?>
    </div>
<?php }
add_action( 'woocommerce_after_main_content', 'influencer_woocommerce_wrapper_end', 10 );

/**
 * Callback function for Shop sidebar
*/
function influencer_woocommerce_sidebar_cb(){
    $sidebar = influencer_sidebar( false );
   
    if( $sidebar ){
        echo '<aside id="secondary" class="widget-area" role="complementary">';
        dynamic_sidebar( 'shop-sidebar' );
        echo '</aside>'; 
    }
}
add_action( 'influencer_woocommerce_sidebar',  'influencer_woocommerce_sidebar_cb' );

/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title' , '__return_false' );