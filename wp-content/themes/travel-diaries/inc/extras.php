<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Travel_Diaries
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $travel_diaries_classes Classes for the body element.
 * @return array
 */
function travel_diaries_body_classes( $classes ) {
	
    global $post;
    
    // Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) ) {
		$classes[] = 'full-width';	
	}
    
    if( is_page() ){
		$sidebar_layout = get_post_meta( $post->ID, 'travel_diaries_sidebar_layout', true );
        if( $sidebar_layout == 'no-sidebar' )
		$classes[] = 'full-width';
	}
    
    return $classes;
}
add_filter( 'body_class', 'travel_diaries_body_classes' );

/**
 * Callback for Social Links 
 */
function travel_diaries_social_cb(){
    $facebook    = get_theme_mod( 'travel_diaries_facebook' );
    $twitter     = get_theme_mod( 'travel_diaries_twitter' );
    $instagram   = get_theme_mod( 'travel_diaries_instagram' );
    $google_plus = get_theme_mod( 'travel_diaries_google_plus' );    
    $linkedin    = get_theme_mod( 'travel_diaries_linkedin' );
    $youtube     = get_theme_mod( 'travel_diaries_youtube' );
    $ok          = get_theme_mod( 'travel_diaries_odnoklassniki' );
    $vk          = get_theme_mod( 'travel_diaries_vk' );
    $xing        = get_theme_mod( 'travel_diaries_xing' ); 
    $tiktok      = get_theme_mod( 'travel_diaries_tiktok' );    
    
    if( $facebook || $twitter || $instagram || $google_plus || $linkedin || $youtube || $ok || $vk || $xing || $tiktok ){
    ?>
    <ul class="social-networks">
		<?php if( $facebook ){?>
            <li><a href="<?php echo esc_url( $facebook );?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'travel-diaries' ); ?>"><span class="fa fa-facebook"></span></a></li>
		<?php } if( $google_plus ){?>
            <li><a href="<?php echo esc_url( $google_plus );?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'travel-diaries' ); ?>"><span class="fa fa-google-plus"></span></a></li>
        <?php } if( $instagram ){?>
            <li><a href="<?php echo esc_url( $instagram );?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'travel-diaries' ); ?>"><span class="fa fa-instagram"></span></a></li>
		<?php } if( $linkedin ){?>
            <li><a href="<?php echo esc_url( $linkedin );?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'travel-diaries' ); ?>"><span class="fa fa-linkedin"></span></a></li>
        <?php } if( $twitter ){?>    
            <li><a href="<?php echo esc_url( $twitter );?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'travel-diaries' ); ?>"><span class="fa fa-twitter"></span></a></li>
		<?php } if( $youtube ){?>
            <li><a href="<?php echo esc_url( $youtube );?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'travel-diaries' ); ?>"><span class="fa fa-youtube"></span></a></li>
        <?php } if( $ok ){?>
            <li><a href="<?php echo esc_url( $ok );?>" target="_blank" title="<?php esc_attr_e( 'OK', 'travel-diaries' ); ?>"><span class="fa fa-odnoklassniki"></span></a></li>
		<?php } if( $vk ){?>
            <li><a href="<?php echo esc_url( $vk );?>" target="_blank" title="<?php esc_attr_e( 'VK', 'travel-diaries' ); ?>"><span class="fa fa-vk"></span></a></li>
		<?php } if( $xing ){?>
            <li><a href="<?php echo esc_url( $xing );?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'travel-diaries' ); ?>"><span class="fa fa-xing"></span></a></li>
		<?php }  if( $tiktok ){?>
            <li><a href="<?php echo esc_url( $tiktok );?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'travel-diaries' ); ?>"><span class="fab fa-tiktok"></span></a></li>
		<?php } ?>
	</ul>
    <?php
    }
}
add_action( 'travel_diaries_social', 'travel_diaries_social_cb' );
 
/**
 * Callback for Header Info Contents 
 */
function travel_diaries_header_info_cb(){
    
    $info           = '';
    $first_label    = get_theme_mod( 'travel_diaries_first_label' );
    $first_content  = get_theme_mod( 'travel_diaries_first_content' );
    $second_label   = get_theme_mod( 'travel_diaries_second_label' );
    $second_content = get_theme_mod( 'travel_diaries_second_content' );
    $third_label    = get_theme_mod( 'travel_diaries_third_label' );
    $third_content  = get_theme_mod( 'travel_diaries_third_content' );
    
    if( $first_label || $first_content || $second_label || $second_content || $third_label || $third_content ){
        $info = '<ul class="info-lists">';
        if( $first_label && $first_content ){ 
            $info .= '<li>'. esc_html( $first_label ) .'<strong>'. esc_html( $first_content ) .'</strong></li>';
        }         
        if( $second_label && $second_content ){
            $info .= '<li>'. esc_html( $second_label ) .'<strong>'. esc_html( $second_content ) .'</strong></li>';            
        } 
        if( $third_label && $third_content ){
            $info .= '<li>'. esc_html( $third_label ) .'<strong>'. esc_html( $third_content ) .'</strong></li>';            
        } 
        $info .= '</ul>';
    }    
    echo $info;    
}
add_action( 'travel_diaries_header_info', 'travel_diaries_header_info_cb' );


/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function travel_diaries_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b>', 'travel-diaries' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'travel-diaries' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-metadata commentmetadata">
    <?php esc_html_e( 'Posted on', 'travel-diaries' );?>
    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<time><?php echo esc_html( get_comment_date() ); ?></time>
    </a>
	</div>
    
    <div class="comment-content"><?php comment_text(); ?></div>
    
	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Fuction to get Sections 
 */
function travel_diaries_get_sections(){
    
    $sections = array( 
        'banner-section' => array(
            'class' => 'banner',
            'id'    => 'banner'    
        ),
        'featured-section' => array(
            'class' => 'featured-on',
            'id'    => 'featuredon'
        ),
        'recent-section' => array(
            'class' => 'recent-posts',
            'id'    => 'recentpost'
        ),
        'article-section' => array(
            'class' => 'popular-posts',
            'id'    => 'populararticle'
        ),
        'clients-section' => array(
            'class' => 'clients',
            'id'    => 'client'
        ),
        'guide-section' => array(
            'class' => 'guide',
            'id'    => 'guide'
        )                
    );
    
    $enabled_section = array();
    
    foreach ( $sections as $section ) {        
        if ( esc_attr( get_theme_mod( 'travel_diaries_ed_' . $section['id'] . '_section' ) ) == 1 ){
            $enabled_section[] = array(
                'id' => $section['id'],
                'class' => $section['class']
            );
        }
    }
    
    return $enabled_section;
}

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'travel_diaries_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'travel_diaries_custom_css' );
        }
    }
} else {
    function travel_diaries_custom_css(){
        $custom_css = get_theme_mod( 'travel_diaries_custom_css' );
        if( !empty( $custom_css ) ){
    		echo '<style type="text/css">';
    		echo wp_strip_all_tags( $custom_css );
    		echo '</style>';
    	}
    }
    add_action( 'wp_head', 'travel_diaries_custom_css', 100 );
}

if ( ! function_exists( 'travel_diaries_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function travel_diaries_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
add_filter( 'excerpt_more', 'travel_diaries_excerpt_more' );
endif;

if ( ! function_exists( 'travel_diaries_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function travel_diaries_excerpt_length( $length ) {
	return is_admin() ? $length : 35;
}
add_filter( 'excerpt_length', 'travel_diaries_excerpt_length', 999 );
endif;

/**
 * Footer Credits 
*/
function travel_diaries_footer_credit(){
	$copyright_text = get_theme_mod( 'travel_diaries_footer_copyright_text' );
	$text = '<span class="copyright">';
    if( $copyright_text ){
	    $text .=  wp_kses_post( $copyright_text ); 
	}else{
	    $text .=  esc_html__( 'Copyright &copy; ', 'travel-diaries' ) . esc_html( date_i18n( __( 'Y', 'travel-diaries' ) ) ); 
	    $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
	}
    $text .= '</span><span class="site-info">';
    $text .= esc_html__( 'Travel Diaries | Developed By ', 'travel-diaries' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'travel-diaries' ) .'</a>. ';
    $text .= sprintf( esc_html__( 'Powered by %s', 'travel-diaries' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'travel-diaries' ) ) .'" target="_blank">WordPress</a>.' );
    $text .= '</span>';
    
    echo apply_filters( 'travel_diaries_footer_text', $text );    
}
add_action( 'travel_diaries_footer', 'travel_diaries_footer_credit' );

/**
 * Function for logo listing 
*/
function travel_diaries_logo_listing( $logo, $link = false, $client = false ){
    $return = '';
    if( $logo ){
	$return  = ( $client == true ) ? '<div class="columns-2">' : '<li>';
    if( $link ) $return .= '<a href="'. esc_url( $link ) .'" target="_blank">'; 
    $return .= '<img src="' . esc_url( $logo ) . '" alt="" />';
    if( $link ) $return .= '</a>';
    $return .= ( $client == true ) ? '</div>' : '</li>';
    echo $return;
    }
}

/**
 * Query Newsletter activation
*/
function is_newsletter_activated(){
    return class_exists( 'newsletter' ) ? true : false;
}

/**
 * Return sidebar layouts for pages
*/
function travel_diaries_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'travel_diaries_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'travel_diaries_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

if( ! function_exists( 'travel_diaries_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function travel_diaries_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'travel-diaries-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = travel_diaries_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( travel_diaries_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"      => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => travel_diaries_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'travel_diaries_single_post_schema' );

if( ! function_exists( 'travel_diaries_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function travel_diaries_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'travel_diaries_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_diaries_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'travel-diaries' ) : __( 'Name', 'travel-diaries' ) );
    $email    = ( $req ? __( 'Email*', 'travel-diaries' ) : __( 'Email', 'travel-diaries' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'travel-diaries' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'travel-diaries' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'travel-diaries' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'travel-diaries' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'travel_diaries_change_comment_form_default_fields' );

if( ! function_exists( 'travel_diaries_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_diaries_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'travel-diaries' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'travel-diaries' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'travel_diaries_change_comment_form_defaults' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'travel_diaries_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function travel_diaries_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'travel_diaries_admin_notice' );
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
                    <h3><?php esc_html_e( 'Congratulations!', 'travel-diaries' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'travel-diaries' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=travel-diaries-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'travel-diaries' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?travel_diaries_admin_notice=1"><?php esc_html_e( 'Dismiss', 'travel-diaries' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'travel_diaries_admin_notice' );

if( ! function_exists( 'travel_diaries_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function travel_diaries_update_admin_notice(){
    if ( isset( $_GET['travel_diaries_admin_notice'] ) && $_GET['travel_diaries_admin_notice'] = '1' ) {
        update_option( 'travel_diaries_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'travel_diaries_update_admin_notice' );

if( ! function_exists( 'travel_diaries_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function travel_diaries_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'travel_diaries_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function travel_diaries_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = travel_diaries_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedbdb;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'travel_diaries_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function travel_diaries_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Open Sans, translate this to 'off'. Do not translate into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'travel-diaries' );
    
    $font_families = array();

    if( 'off' !== $open_sans ){
        $font_families[] = 'Open Sans:400,400italic,600,600italic,700';
    }

    $query_args = array(
        'family'  => urlencode( implode( '|', $font_families ) ),
        'display' => urlencode( 'fallback' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url( $fonts_url );
}
endif;

if( ! function_exists( 'travel_diaries_load_preload_local_fonts') ) :
/**
 * Get the file preloads.
 *
 * @param string $url    The URL of the remote webfont.
 * @param string $format The font-format. If you need to support IE, change this to "woff".
 */
function travel_diaries_load_preload_local_fonts( $url, $format = 'woff2' ) {

    // Check if cached font files data preset present or not. Basically avoiding 'travel_diaries_WebFont_Loader' class rendering.
    $local_font_files = get_site_option( 'travel_diaries_local_font_files', false );

    if ( is_array( $local_font_files ) && ! empty( $local_font_files ) ) {
        $font_format = apply_filters( 'travel_diaries_local_google_fonts_format', $format );
        foreach ( $local_font_files as $key => $local_font ) {
            if ( $local_font ) {
                echo '<link rel="preload" href="' . esc_url( $local_font ) . '" as="font" type="font/' . esc_attr( $font_format ) . '" crossorigin>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }	
        }
        return;
    }

    // Now preload font data after processing it, as we didn't get stored data.
    $font = travel_diaries_webfont_loader_instance( $url );
    $font->set_font_format( $format );
    $font->preload_local_fonts();
}
endif;

if( ! function_exists( 'travel_diaries_flush_local_google_fonts' ) ){
    /**
     * Ajax Callback for flushing the local font
     */
    function travel_diaries_flush_local_google_fonts() {
        $WebFontLoader = new Travel_Diaries_WebFont_Loader();
        //deleting the fonts folder using ajax
        $WebFontLoader->delete_fonts_folder();
    die();
    }
}
add_action( 'wp_ajax_flush_local_google_fonts', 'travel_diaries_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'travel_diaries_flush_local_google_fonts' );