<?php
/**
 * The Ultralight Standalone Functions.
 *
 * @package The_Ultralight
 */

if ( ! function_exists( 'the_ultralight_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function the_ultralight_posted_on() {
	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    $on = __( 'on ', 'the-ultralight' );
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time></time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
            $on = __( 'updated on ', 'the-ultralight' );
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    $posted_on = sprintf( '%1$s %2$s', esc_html( $on ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
    
    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'the_ultralight_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function the_ultralight_posted_by() {
        echo '<span class="byline" itemprop="author">';
        echo '<span class="author">';
        echo '<span>'.esc_html__('by ','the-ultralight').'</span>';
        echo '<a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" itemprop="url">'. esc_html( get_the_author() ).'</a>';
        echo '</span>';
        echo '</span>';
}

endif;

if( ! function_exists( 'the_ultralight_comment_count' ) ) :
/**
 * Comment Count
*/
function the_ultralight_comment_count(){
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<div class="like-comment-wrap">';
		echo '<span class="comments"><i class="far fa-comment"></i>';
        echo absint(get_comments_number());
		echo '</span>';
        echo '</div>';
	}    
}
endif;

if ( ! function_exists( 'the_ultralight_category' ) ) :
/**
 * Prints categories
 */
function the_ultralight_category(){
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( ' ' );
        if ( $categories_list ) {
            echo '<span class="cat-links" itemprop="about"><i class="fas fa-folder-open"></i>' . $categories_list . '</span>';
        }
    }
}
endif;

if ( ! function_exists( 'the_ultralight_tag' ) ) :
/**
 * Prints tags
 */
function the_ultralight_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			echo '<div class="tags" itemprop="about"><i class="fas fa-tags"></i>' . $tags_list . '</div>';
		}
	}
}
endif;

if( ! function_exists( 'the_ultralight_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function the_ultralight_get_posts_list( $status ){
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 3;
        $title                  = __( 'Latest Posts', 'the-ultralight' );
        $class                  = 'recent-posts';
        $image_size             = 'the-ultralight-post-related';
        break;
        
        case 'related':
        $args['posts_per_page'] = 3;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'Recommended for you...', 'the-ultralight' ) );
        $class                  = 'related-posts';
        $image_size             = 'the-ultralight-post-related';        
        $cats                   = get_the_category( $post->ID );        
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }        
        break;        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>
        
        <div class="related-articles">
            <div class="<?php echo esc_attr( $class ); ?>">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <div class="related-article-block">
                        <figure class="post-thumbnail">
            				<a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                }else{
                                    echo '<img src="' . esc_url( get_template_directory_uri() . '/images/' . $image_size . '.jpg'  ) . '" alt="' . esc_attr( get_the_title() ) . '" itemprop="image" />';    
                                }
                                ?>
                            </a>
                        </figure>
                        <div class="related-content-wrap">
                            <header class="entry-header">
                                <span class="recommended"><?php echo esc_html( $title ); ?></span>
                                <h4 class="entry-title" itemprop="headline">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </header>
                            <footer class="entry-footer">
                                <div class="entry-left">
                                    <?php the_ultralight_posted_by(); ?>
                                </div>
                            </footer>
                        </div>
                    </div>
    			<?php } ?>
        	</div>
        </div>
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'the_ultralight_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function the_ultralight_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'the-ultralight' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'the_ultralight_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function the_ultralight_theme_comment( $comment, $args, $depth ){
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
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) echo the_ultralight_gravatar( $comment, $args['avatar_size'] ); ?>
               <?php echo '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">'.get_comment_author_link().'</b>'; ?>
        	</div><!-- .comment-author vcard -->
            
            <div class="comment-metadata commentmetadata">
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'the-ultralight' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'the-ultralight' ); ?></p>
                <br />
            <?php endif; ?>
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </footer>
        
        <div class="comment-content">           
            <p class="comment-content" itemprop="commentText"><?php comment_text(); ?></p>        
        </div><!-- .text-holder -->
        
	   <?php if ( 'div' != $args['style'] ) : ?>
    </div><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'the_ultralight_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function the_ultralight_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_the_ultralight_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_the_ultralight_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
    }elseif( !is_search() && the_ultralight_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){

        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }else{
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';    
            }
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }

    if( is_404() ){

        $return = $class ? 'full-width' : false; //Fullwidth     
    }
    return $return; 
}
endif;

if(!function_exists('the_ultralight_page_class')):
/** Page Class **/
function the_ultralight_page_class(){
    $ed_banner_area = get_theme_mod('ed_banner_area',false);
    if($ed_banner_area && has_header_image() && (is_home() || is_front_page())){
        $page_class[] = 'has-banner';
    }else{
        $page_class[] = 'no-banner';
    }
    
    $page_class[] = the_ultralight_sidebar(true);

    return $page_class;
}
endif;

if( ! function_exists( 'the_ultralight_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function the_ultralight_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'the_ultralight_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function the_ultralight_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Roboto, translate this to 'off'. Do not translate into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'the-ultralight' );
    
    $font_families = array();

    if( 'off' !== $roboto ){
        $font_families[] = 'Roboto:300,300i,400,400i,500,500i,700,700i';
    }

    $query_args = array(
        'family'  => urlencode( implode( '|', $font_families ) ),
        'display' => urlencode( 'fallback' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url( $fonts_url );
}
endif;

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

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function the_ultralight_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Query WooCommerce activation
 */
function the_ultralight_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}