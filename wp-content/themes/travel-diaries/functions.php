<?php
/**
 * Travel Diaries functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Diaries
 */

$travel_diaries_theme_data = wp_get_theme();
if( ! defined( 'TRAVEL_DIARIES_THEME_VERSION' ) ) define( 'TRAVEL_DIARIES_THEME_VERSION', $travel_diaries_theme_data->get( 'Version' ) );
if( ! defined( 'TRAVEL_DIARIES_THEME_NAME' ) ) define( 'TRAVEL_DIARIES_THEME_NAME', $travel_diaries_theme_data->get( 'Name' ) );
if( ! defined( 'TRAVEL_DIARIES_THEME_TEXTDOMAIN' ) ) define( 'TRAVEL_DIARIES_THEME_TEXTDOMAIN', $travel_diaries_theme_data->get( 'TextDomain' ) );

if ( ! function_exists( 'travel_diaries_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function travel_diaries_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Travel Diaries, use a find and replace
	 * to change 'travel-diaries' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'travel-diaries', get_template_directory() . '/languages' );
    
    // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'travel-diaries' ),
        'secondary' => esc_html__( 'Secondary', 'travel-diaries' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'travel_diaries_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
    // Custom Image Sizes
    add_image_size( 'travel-diaries-post-thumb', 68, 53, true );
    add_image_size( 'travel-diaries-feat-thumb', 360, 314, true );
    add_image_size( 'travel-diaries-image-with-sidebar', 750, 437, true );
    add_image_size( 'travel-diaries-image-full-width', 1170, 437, true );
    add_image_size( 'travel-diaries-blog-archive', 264, 231, true );
    add_image_size( 'travel-diaries-blog', 360, 250, true );
    add_image_size( 'travel-diaries-articles', 360, 314, true );
    add_image_size( 'travel-diaries-guide', 360, 420, true );
    add_image_size( 'travel-diaries-banner', 1920, 548, true );
    add_image_size( 'travel-diaries-schema', 600, 60, true );
    
    // woocommerce compatible
    add_theme_support( 'woocommerce' );

	remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'travel_diaries_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travel_diaries_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travel_diaries_content_width', 750 );
}
add_action( 'after_setup_theme', 'travel_diaries_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function travel_diaries_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = travel_diaries_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1170;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}

}
add_action( 'template_redirect', 'travel_diaries_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travel_diaries_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'travel-diaries' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'travel-diaries' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'travel-diaries' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'travel-diaries' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'travel-diaries' ),
		'id'            => 'footer-four',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Banner Widget', 'travel-diaries' ),
		'id'            => 'banner-widget',
		'description'   => esc_html__( 'Custom Use for Newsletter Plugin', 'travel-diaries' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'travel_diaries_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function travel_diaries_scripts() {
	$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			travel_diaries_load_preload_local_fonts( travel_diaries_get_webfont_url( travel_diaries_fonts_url() ) );
        }
        wp_enqueue_style( 'travel-diaries-google-fonts', travel_diaries_get_webfont_url( travel_diaries_fonts_url() ) );
    }else{
    	wp_enqueue_style( 'travel-diaries-google-fonts', travel_diaries_fonts_url() );
	}
    wp_enqueue_style( 'jcf', get_template_directory_uri() . '/css' . $build . '/jcf' . $suffix . '.css', '', '1.2.0' );
    wp_enqueue_style( 'travel-diaries-style', get_stylesheet_uri(), '', TRAVEL_DIARIES_THEME_VERSION );

	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'jcf', get_template_directory_uri() . '/js' . $build . '/jcf' . $suffix . '.js', array('jquery'), '1.2.0', true );
	wp_enqueue_script( 'jcf-checkbox', get_template_directory_uri() . '/js' . $build . '/jcf.checkbox' . $suffix . '.js', array('jquery', 'jcf'), '1.2.0', true );
    wp_enqueue_script( 'jcf-file', get_template_directory_uri() . '/js' . $build . '/jcf.file' . $suffix . '.js', array('jquery', 'jcf'), '1.2.0', true );
    wp_enqueue_script( 'jcf-radio', get_template_directory_uri() . '/js' . $build . '/jcf.radio' . $suffix . '.js', array('jquery', 'jcf'), '1.2.0', true );
    wp_enqueue_script( 'jcf-select', get_template_directory_uri() . '/js' . $build . '/jcf.select' . $suffix . 'js', array('jquery', 'jcf'), '1.2.0', true );
    wp_enqueue_script( 'travel-diaries-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), TRAVEL_DIARIES_THEME_VERSION, true );
    wp_enqueue_script( 'travel-diaries-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), TRAVEL_DIARIES_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'travel_diaries_scripts' );

/** 
 * Registering and enqueuing scripts/stylesheets for Customizer controls.
 */ 
function travel_diaries_customizer_js() {
	$array = array( 
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'flushit'    => __( 'Successfully Flushed!','travel-diaries' ),
        'nonce'      => wp_create_nonce('ajax-nonce')
    );
	wp_enqueue_script( 'travel-diaries-customizer-js', get_template_directory_uri() . '/inc/js/customizer.js', array('jquery'), TRAVEL_DIARIES_THEME_VERSION, true  );
	wp_localize_script( 'travel-diaries-customizer-js', 'travel_diaries_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'travel_diaries_customizer_js' );

function travel_diaries_admin_scripts() {
	wp_enqueue_style( 'travel-diaries-admin-style',get_template_directory_uri().'/inc/css/admin.css', '',TRAVEL_DIARIES_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'travel_diaries_admin_scripts' );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Widget Featured Post
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 * Widget Recent Post
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Custom Meta Box
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Theme Information
 */
require get_template_directory() . '/inc/info.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';