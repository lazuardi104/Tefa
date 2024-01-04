<?php
/**
 * Influencer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Influencer
 */

if ( ! function_exists( 'influencer_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function influencer_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Influencer, use a find and replace
		 * to change 'influencer' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'influencer', get_template_directory() . '/languages' );

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

		// Add excerpt support for page.
    	add_post_type_support( 'page', 'excerpt' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'influencer' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'influencer_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		add_theme_support( 'custom-header', apply_filters( 'influencer_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => 'ffffff',
			'width'                  => 1920,
			'height'                 => 1080,
		) ) );

		// Register default headers.
		register_default_headers( array(
			'default-banner' => array(
				'url'           => '%s/images/banner-img.jpg',
				'thumbnail_url' => '%s/images/banner-img.jpg',
				'description'   => esc_html_x( 'Default Banner', 'header image description', 'influencer' ),
			),
		) );

		//custom image size
		add_image_size( 'influencer-blog', 810, 325, true );
		add_image_size( 'influencer-blog-full', 1170, 469, true );
		add_image_size( 'influencer-latest-posts', 370, 220, true );
		add_image_size( 'influencer-featured-page', 570, 605, true );

		/** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 'home', 'blog' ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'influencer' ),
				'items' => array(
					'page_home',
					'page_blog'
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'influencer_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
	}

endif;
add_action( 'after_setup_theme', 'influencer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function influencer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'influencer_content_width', 865 );
}
add_action( 'after_setup_theme', 'influencer_content_width', 0 );


if( ! function_exists( 'influencer_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function influencer_template_redirect_content_width(){
	// Full Width in the absence of sidebar.
	$sidebar = influencer_sidebar( true );
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 865;        
	}else{
        if( is_singular() ){
            if( $sidebar === 'full-width centered-layout' ){
                $GLOBALS['content_width'] = 819;
            }else{
                $GLOBALS['content_width'] = 1170;                
            } 
        }else{
            $GLOBALS['content_width'] = 1170;
        }
    }
}
endif;
add_action( 'template_redirect', 'influencer_template_redirect_content_width' );

if ( ! function_exists( 'influencer_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function influencer_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'influencer' ) ) {
		$fonts[] = 'Poppins:400,400i,500,500i,600,600i,700';
	}

	/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Source Sans Pro: on or off', 'influencer' ) ) {
		$fonts[] = 'Source Sans Pro:400,400i,600,600i';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url( $fonts_url );
}
endif;

/**
 * Enqueue scripts and styles.
 */
function influencer_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $unminify  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/unminify' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			influencer_load_preload_local_fonts( influencer_get_webfont_url( influencer_fonts_url() ) );
        }
        wp_enqueue_style( 'influencer-google-fonts', influencer_get_webfont_url( influencer_fonts_url() ) );
    }else{
 	wp_enqueue_style( 'influencer-google-fonts', influencer_fonts_url(), array(), null );
	}

	wp_enqueue_style( 'influencer-style', get_stylesheet_uri(), array(), INFLUENCER_THEME_VERSION );

	if( influencer_is_woocommerce_activated() ) {
        wp_enqueue_style( 'influencer-woocommerce-style', get_template_directory_uri(). '/css' . $unminify . '/woocommerce-style' . $suffix . '.css', array( 'influencer-style' ), INFLUENCER_THEME_VERSION );
    }

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $unminify . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $unminify . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/js' . $unminify . '/jquery.counterup' . $suffix . '.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js' . $unminify . '/waypoints' . $suffix . '.js', array( 'jquery' ), '2.0.3', true );
	wp_enqueue_script( 'influencer-modal-accessibility', get_template_directory_uri() . '/js' . $unminify . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), INFLUENCER_THEME_VERSION, true );
	wp_enqueue_script( 'influencer-custom', get_template_directory_uri() . '/js' . $unminify . '/custom' . $suffix . '.js', array(), INFLUENCER_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'influencer_scripts' );

if( ! function_exists( 'influencer_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function influencer_admin_scripts(){
    wp_enqueue_style( 'influencer-admin', get_template_directory_uri() . '/inc/css/admin.css', '', INFLUENCER_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'influencer_admin_scripts' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function influencer_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    $classes[] = influencer_sidebar( true );

    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}

	$enable_banner_section = get_theme_mod( 'enable_banner_section', true );
    if ( $enable_banner_section == false && is_front_page() ) {
        $classes[] = 'no-banner';
    }

	return $classes;
}
add_filter( 'body_class', 'influencer_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function influencer_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'influencer_pingback_header' );

if ( ! function_exists( 'influencer_add_button_to_menu' ) ) :
    /**
     * Add button on menu
     * @param  $items,$args
     * @return html,$items
     */
    function influencer_add_button_to_menu( $items, $args ) {   
        $menu_button_label = get_theme_mod( 'menu_button_label', __( 'Start Here','influencer' ) );
        $menu_button_url = get_theme_mod( 'menu_button_url', '#' );
        if( $args->theme_location == 'primary' && !empty( $menu_button_label ) && !empty( $menu_button_url ) ) {        
            $add_button = '<a class="menu-start-button" href="' . esc_url( $menu_button_url ) . '" target="_blank">' . esc_html( $menu_button_label ) . '</a>';
            $html = $items . $add_button;
      
            return $html;
        }
        return $items;
    }
endif;
add_filter( 'wp_nav_menu_items','influencer_add_button_to_menu', 10, 2);

if ( ! function_exists( 'influencer_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function influencer_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'influencer_excerpt_more' );

if( ! function_exists( 'influencer_custom_excerpt_length' ) ) :
/**
 * Excerpt Length
*/
function influencer_custom_excerpt_length( $length ) {
    $excerpt_length = get_theme_mod( 'custom_excerpt_length', 25 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;    
add_filter( 'excerpt_length', 'influencer_custom_excerpt_length', 999 );

if( ! function_exists( 'influencer_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function influencer_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'influencer' ) : __( 'Name', 'influencer' ) );
    $email    = ( $req ? __( 'Email*', 'influencer' ) : __( 'Email', 'influencer' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'influencer' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'influencer' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'influencer' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'influencer' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'influencer_change_comment_form_default_fields' );

if( ! function_exists( 'influencer_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function influencer_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'influencer' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'influencer' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'influencer_change_comment_form_defaults' );


if( ! function_exists( 'influencer_search_form' ) ) :
/**
 * Search Form
*/
function influencer_search_form(){ 
    $placeholder = is_404() ?  _x( 'Search...', 'placeholder', 'influencer' ) : _x( 'Search', 'placeholder', 'influencer' );
    $form = '<form class="search-form" role="search" method="get" action="' . esc_url( home_url('/') ) . '">
				<label>
					<input type="search" name="s" class="search-field" placeholder="' . esc_attr( $placeholder ) .'" value="' .  get_search_query() .'"/>
				</label>
				<label for="search-button">
					<input type="submit" id="search-button" name="submit" value="" class="search-submit">
				</label>
			</form>';
 
    return $form;
}
endif;
add_filter( 'get_search_form', 'influencer_search_form' );

if( ! function_exists( 'influencer_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function influencer_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'influencer_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'influencer' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'influencer' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=influencer-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'influencer' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?influencer_admin_notice=1"><?php esc_html_e( 'Dismiss', 'influencer' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'influencer_admin_notice' );

if( ! function_exists( 'influencer_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function influencer_update_admin_notice(){
    if ( isset( $_GET['influencer_admin_notice'] ) && $_GET['influencer_admin_notice'] = '1' ) {
        update_option( 'influencer_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'influencer_update_admin_notice' );