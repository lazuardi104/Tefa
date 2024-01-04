<?php

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function influencer_is_ienw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is RaraTheme Companion active or not
*/
function influencer_is_irtc_activated(){
    return class_exists( 'Raratheme_Companion_Public' ) ? true : false;        
}

/**
 * Query WooCommerce activation
 */
function influencer_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

if ( ! function_exists( 'influencer_meta_details' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function influencer_meta_details() {

        global $post;
        $disable_posted_on = get_theme_mod( 'disable_posted_on', false );
        $disable_posted_by = get_theme_mod( 'disable_posted_by', false );
        $disable_post_comments = get_theme_mod( 'disable_post_comments', false );
        $blog_layout_option = get_theme_mod( 'blog_layout_option', 'default-layout' );

        $ed_updated_post_date = get_theme_mod( 'ed_post_update_date', false );
        $on = is_single() ? '' : __( 'Posted: ', 'influencer' );
        
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            if( $ed_updated_post_date ){
                $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time></time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
                $on = is_single() ? '' : __( 'Last Updated: ', 'influencer' );       
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
        
        if( ( is_single() && ( $disable_posted_on == false ) ) || is_archive() || is_search() || ( is_home() && ( $blog_layout_option == 'default-layout' ) ) ) {
            $posted_on = sprintf( '%1$s %2$son %3$s', esc_html( $on ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', $time_string . '</a>' );
        
            echo '<span class="posted-on" itemprop="datePublished dateModified">' . $posted_on . '</span>';
        }
        
        if( is_single() && $disable_posted_by == false ) {            
            $byline = sprintf(
                esc_html_x( 'by %s', 'post author', 'influencer' ),
                '<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ) . '" class="url" itemprop="url">' . esc_html( get_the_author_meta( 'display_name', $post->post_author ) ) . '</a></span>'
            );
            echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
        }

        if( is_home() || is_archive() || is_search() ){
            $byline = sprintf(
                esc_html_x( 'by %s', 'post author', 'influencer' ),
                '<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="url" itemprop="url">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>'
            );
            echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
        }

        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            if( ( is_single() && $disable_post_comments == false ) || is_home() || is_archive() || is_search() ) {
                echo '<span class="comment-box">';
                comments_popup_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: post title */
                            __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'influencer' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    )
                );
                echo '</span>';
            }
        }
    }
endif;

if( ! function_exists( 'influencer_entry_header_content' ) ) :
    /**
     * content of entry-header in blog
    */
    function influencer_entry_header_content() { ?>
        <header class="entry-header">
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php influencer_meta_details(); ?>
                </div><!-- .entry-meta -->
            <?php
            endif; ?>
        </header><!-- .entry-header -->
        <?php 
    }
endif; 

if( ! function_exists( 'influencer_entry_content_default' ) ) :
    /**
     * content of entry-content in blog
    */
    function influencer_entry_content_default() { ?>
        <div class="entry-content" itemprop="text">
            <?php 
                influencer_post_thumbnail();
                the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="readmore" itemprop="MainEntityOfPage"><?php esc_html_e( 'Continue Reading','influencer' ); ?></a>
        </div><!-- .entry-content -->
    <?php }
endif;

if( ! function_exists( 'influencer_entry_content_grid' ) ) :
    /**
     * content of entry-content in blog
    */
    function influencer_entry_content_grid() { ?>
        <div class="entry-content" itemprop="text">
            <?php 
                influencer_entry_header_content();
                the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="readmore" itemprop="MainEntityOfPage"><?php esc_html_e( 'Continue Reading','influencer' ); ?></a>
        </div><!-- .entry-content -->
    <?php }
endif;

if ( ! function_exists( 'influencer_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function influencer_post_thumbnail() {
    
    $blog_layout_option = get_theme_mod( 'blog_layout_option', 'default-layout' );
    $sidebar = influencer_sidebar( true );
    if ( post_password_required() || is_attachment() ) {
        return;
    }
    if( $blog_layout_option == 'default-layout' || is_archive() || is_search() ) {
        if( $sidebar == 'full-width' ) {
            $image_size = 'influencer-blog-full';
        }else{
            $image_size = 'influencer-blog';
        }
        if( has_post_thumbnail() ){ ?>
            <a class="entry-image" itemprop="url" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); ?> 
            </a>
        <?php 
        }
    }else{
        $image_size = 'influencer-latest-posts';
        $fallback_image = '370x220'; 
        
        if( has_post_thumbnail() ){ ?>
            <a class="entry-image" itemprop="url" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); ?> 
            </a>
        <?php 
        }else{
            $influencer_blog_image = get_template_directory_uri() . '/images/fallback-' . $fallback_image .'.jpg'; ?>
            <a class="entry-image" itemprop="url" href="<?php the_permalink(); ?>" aria-hidden="true">
                <img itemprop="image" src="<?php echo esc_url( $influencer_blog_image ); ?>" alt="<?php the_title_attribute(); ?>">
            </a><?php 
        }
    }
}
endif;

if ( ! function_exists( 'influencer_posts_categories' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function influencer_posts_categories() {         
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) { 
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'influencer' ) );
            if ( $categories_list && influencer_categorized_blog() ) { 
                printf( '<span class="cat">%1$s</span>', $categories_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function influencer_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'influencer_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'influencer_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so influencer_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so influencer_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in influencer_categorized_blog.
 */
function influencer_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'influencer_categories' );
}
add_action( 'edit_category', 'influencer_category_transient_flusher' );
add_action( 'save_post',     'influencer_category_transient_flusher' );

if ( ! function_exists( 'influencer_posts_tags' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function influencer_posts_tags() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() && has_tag() ) { ?>
            <div class="tag-share-wrap">
                <div class="tag-block">

                    <?php /* translators: used between list items, there is a space after the comma */
                    $tags_list = get_the_tags();
                    if ( $tags_list ) {

                        foreach ( $tags_list as $tag_value ) {
                            echo '<span><a href="' . esc_url( get_tag_link( $tag_value->term_id ) ) .'"># ' . esc_html( $tag_value->name ) . '</a></span>'; // WPCS: XSS OK.
                        }
                    } ?>
                </div>
            </div>
        <?php } 
    }
endif;

if( ! function_exists( 'influencer_author_details' ) ) :
/**
 * Author Details
*/
function influencer_author_details() { 

	$disable_author_bio = get_theme_mod( 'disable_author_bio', false );
	if( $disable_author_bio == true ) {
		return;
	}
	$author_gravatar = get_avatar( get_the_author_meta( 'ID' ), 100, '', 'author image' ); 
	$author_name = get_the_author_meta( 'display_name' );
	$author_description = get_the_author_meta( 'description' );
    $author_title = is_single() ? esc_html__( 'About','influencer' ) : esc_html__( 'All posts by','influencer' );
    
    if( ( ! empty( $author_gravatar ) ) || ( ! empty( $author_name ) ) || ( ! empty( $author_description ) ) ) { ?>
        <div class="about-author">
            <?php if( ! empty( $author_gravatar ) ) {
     	       	echo '<figure class="author-image">'. $author_gravatar .'</figure>';
            }
            if( ! empty( $author_name ) ) {
            	echo '<h3 class="author-name">'. esc_html( $author_title ) .' <span>'. esc_html( $author_name ) .'</span></h3>';
        	}
            if( ! empty( $author_description ) ) {
    			echo '<div class="author-desc">'. wpautop( wp_kses_post( $author_description ) ).'</div>';
            } ?>
        </div>        
    <?php }
}
endif;

if( ! function_exists( 'influencer_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function influencer_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'influencer' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
 
function influencer_comment( $comment, $args, $depth ) {

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
    	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    	<?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b><span class="says"> Says:</span>', 'influencer' ), get_comment_author_link() ); ?>
    	</div>
    
    	<div class="comment-metadata"><a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>"><time itemprop="commentTime" datetime="<?php comment_date(); ?>">
    		<?php
    			/* translators: 1: date, 2: time */
    			echo get_comment_date(); ?></time></a>
    	</div>
    	<?php if ( $comment->comment_approved == '0' ) : ?>
    		<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'influencer' ); ?></p>
    		<br />
    	<?php endif; ?>
		<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], ) ) ); ?>
		</div>
    </footer>
    
    <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}


if( ! function_exists( 'influencer_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function influencer_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    $front_page  = get_option( 'page_on_front' );

    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_influencer_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_influencer_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_active_sidebar( 'sidebar' ) && $front_page != $post->ID ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered-layout' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                if( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered-layout' : false;
                }else{
                    $return = $class ? 'full-width' : false;
                }
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered-layout' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                if( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width single-centered' : false;
                }else{
                    $return = $class ? 'full-width' : false;
                }
            }
        }
    }elseif( influencer_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'shop-sidebar';    
            }           
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }elseif( is_404() ){
        $return = $class ? 'full-width' : false;
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
    return $return; 
}
endif;

if( ! function_exists( 'influencer_banner_newsletter' ) ) :
    /**
     * Influencer Newsletter
    */
    function influencer_banner_newsletter(){        
        if( is_front_page() ) {
            $newsletter_shortcode = get_theme_mod( 'newsletter_shortcode', '' );
            if( !empty( $newsletter_shortcode ) ){
                echo '<div class="cm-wrapper">';
                echo do_shortcode( $newsletter_shortcode );   
                echo '</div>';            
            }
        }
    }
endif;

if( ! function_exists( 'influencer_banner_title' ) ) :
/**
 * Page Header
*/
function influencer_banner_title(){ 
    if ( ( is_front_page() && is_home() ) || is_home() ){ 
        echo '<h1 class="page-title">';
        esc_html_e( 'Blog','influencer' );
        echo '</h1>';
    }

    if( is_singular() ) {
        the_title( '<h1 class="page-title">', '</h1>' );
    }       

    if( is_archive() ){
        if( is_author() ){
            influencer_author_details();
        }
        elseif( is_category() ){
            echo '<p>'. esc_html__( 'Browsing Category','influencer' ) . '</p>';
            echo '<h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
        }
        elseif( is_tag() ){
            echo '<p>'. esc_html__( 'Browsing Tag','influencer' ) . '</p>';
            echo '<h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
        }
        else{
            the_archive_description( '<div class="archive-description">', '</div>' );
            the_archive_title( '<h1 class="page-title">', '</h1>' );
        }
    }

    if( is_search() ){ 
        echo '<h1 class="page-title">' . esc_html__( 'You Are Looking For', 'influencer' ) . '</h1>';
        get_search_form();
    }
    
    if( is_404() ) {
        echo '<h1 class="page-title">' . esc_html__( 'Uh-Oh...', 'influencer' ) . '</h1>'; //For 404
        echo '<p>' . esc_html__( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'influencer' ) . '</p>'; //For 404
    }
}
endif;

if( ! function_exists( 'influencer_banner_header_image' ) ) :
/**
 * Banner Header Image
*/
function influencer_banner_header_image(){

    $blog_header_image    = get_theme_mod( 'blog_header_image', get_template_directory_uri() . '/images/default-header-bg.jpg' );
    $archive_header_image = get_theme_mod( 'archive_header_image', get_template_directory_uri() . '/images/default-header-bg.jpg' );
    $search_header_image  = get_theme_mod( 'search_header_image', get_template_directory_uri() . '/images/default-header-bg.jpg' );
    $header_image_404     = get_theme_mod( '404_header_image', get_template_directory_uri() . '/images/default-header-bg.jpg' );

    if ( is_home() ){ 
        $banner_image_url = ( ! empty( $blog_header_image ) ) ? $blog_header_image : get_template_directory_uri() . '/images/default-header-bg.jpg';
    }
    elseif( is_singular() ){
        $banner_image_url = get_the_post_thumbnail_url( '', 'full' );
        $banner_image_url = ( ! empty( $banner_image_url) ) ? $banner_image_url : '';
    }
    elseif( is_archive() ){
        $banner_image_url = ( ! empty( $archive_header_image) ) ? $archive_header_image : get_template_directory_uri() . '/images/default-header-bg.jpg';
    }
    elseif( is_search() ){ 
        $banner_image_url = ( ! empty( $search_header_image) ) ? $search_header_image : get_template_directory_uri() . '/images/default-header-bg.jpg';
    }
    elseif( is_404() ) {
        $banner_image_url = ( ! empty( $header_image_404) ) ? $header_image_404 : get_template_directory_uri() . '/images/default-header-bg.jpg';
    }
    return $banner_image_url;
}
endif;

if( ! function_exists( 'influencer_single_related_posts' ) ) :
    /**
     * Influencer Single Related Posts
    */
    function influencer_single_related_posts( $posts_per_page ) {

        global $post;
        $disable_related_posts = get_theme_mod( 'disable_related_posts', false );
        $related_posts_label = get_theme_mod( 'related_posts_label', __( 'You Might Also Like...', 'influencer' ) );
        if( $disable_related_posts == true ) {
            return;
        }

        $category_ids    = get_the_category( $post->ID );
        foreach( $category_ids as $category_id ){
            $cat_id[] = absint( $category_id->term_id ); 
        }
        $related_posts_args = array(
            'post_status'           => 'publish',   
            'posts_per_page'        => absint( $posts_per_page ),
            'ignore_sticky_posts'   => true,
            'category__in'          => $cat_id,
            'post__not_in'          => array( absint( $post->ID ) ),
            'orderby'               => 'rand'
        );

        $related_posts_qry = new WP_Query( $related_posts_args );
        if( $related_posts_qry->have_posts() ) { ?>
            <div class="related-post">
                <h3 class="related-post-title"><?php echo esc_html( $related_posts_label ); ?></h3>
                <div class="related-post-wrap clearfix">
                    <?php while( $related_posts_qry->have_posts() ) { 
                        $related_posts_qry->the_post(); ?>
                        <div class="related-post-block">
                            <?php
                            if ( has_post_thumbnail() ) {
                                echo '<figure>';
                                the_post_thumbnail( 'influencer-latest-posts', array( 'itemprop' => 'image' ) );
                                echo '</figure>';
                            } else {
                                $related_posts_image = get_template_directory_uri() .'/images/fallback-370x220.jpg'; ?>  
                                <figure><img src="<?php echo esc_url( $related_posts_image ); ?>" alt="<?php the_title_attribute(); ?>" itemprop="image"></figure>
                            <?php } ?>
                            <div class="related-content-wrap">
                                <h2 class="related-block-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <a href="<?php the_permalink(); ?>" class="readmore"><?php esc_html_e( 'Continue Reading','influencer' ); ?></a>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            </div>        
    <?php }
    }
endif;

if( ! function_exists( 'influencer_scroll_down_options' ) ) :
    /**
     * Influencer Scroll Down Option
    */
    function influencer_scroll_down_options() {

        if ( is_active_sidebar( 'logo-sidebar' ) ) {
            $scroll_down = '#clients';
        }
        elseif ( is_active_sidebar( 'featured-page-sidebar' ) ) {
            $scroll_down = '#about';
        }
        elseif ( is_active_sidebar( 'service-sidebar' ) ) {
            $scroll_down = '#service';
        }
        elseif ( is_active_sidebar( 'testimonial-sidebar' ) ) {
            $scroll_down = '#testimonial';
        }
        elseif ( is_active_sidebar( 'cta-sidebar' ) ) {
            $scroll_down = '#cta';
        }
        else{
            $scroll_down = '#news';
        }
        return $scroll_down;
    }
endif;

if ( ! function_exists( 'influencer_header_style' ) ) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see influencer_custom_header_setup().
     */
    function influencer_header_style() {
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
         */
        if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
            return;
        }
        echo "<style type='text/css' media='all'>";
        // If we get this far, we have custom styles. Let's do this.
        // Has the text been hidden?
        if ( ! display_header_text() ) : ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
        <?php
        // If the user has set a custom color for the text use that.
        else : ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>};
        <?php endif;
        echo "</style>";
    }
endif;
add_action( 'wp_head', 'influencer_header_style', 999 );

if( ! function_exists( 'influencer_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function influencer_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'influencer_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function influencer_get_home_sections(){
    $ed_banner = get_theme_mod( 'enable_banner_section', true );
    $sections = array( 
        'logo-sidebar'          => array( 'sidebar' => 'logo' ),
        'featured-page-sidebar' => array( 'sidebar' => 'featured-page' ),
        'service-sidebar'       => array( 'sidebar' => 'service' ),
        'testimonial-sidebar'   => array( 'sidebar' => 'testimonial' ),
        'cta-sidebar'           => array( 'sidebar' => 'call-to-action' ),
        'latest-posts'          => array( 'section' => 'latest-posts' ) 
    );
    
    $enabled_section = array();
    if( $ed_banner ) array_push( $enabled_section, 'banner' );
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $k ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
            if( get_theme_mod( 'enable_latest_news', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }  
    
    return apply_filters( 'influencer_home_sections', $enabled_section );
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

if( ! function_exists( 'influencer_load_preload_local_fonts') ) :
/**
 * Get the file preloads.
 *
 * @param string $url    The URL of the remote webfont.
 * @param string $format The font-format. If you need to support IE, change this to "woff".
 */
function influencer_load_preload_local_fonts( $url, $format = 'woff2' ) {

    // Check if cached font files data preset present or not. Basically avoiding 'influencer_WebFont_Loader' class rendering.
    $local_font_files = get_site_option( 'influencer_local_font_files', false );

    if ( is_array( $local_font_files ) && ! empty( $local_font_files ) ) {
        $font_format = apply_filters( 'influencer_local_google_fonts_format', $format );
        foreach ( $local_font_files as $key => $local_font ) {
            if ( $local_font ) {
                echo '<link rel="preload" href="' . esc_url( $local_font ) . '" as="font" type="font/' . esc_attr( $font_format ) . '" crossorigin>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }	
        }
        return;
    }

    // Now preload font data after processing it, as we didn't get stored data.
    $font = influencer_webfont_loader_instance( $url );
    $font->set_font_format( $format );
    $font->preload_local_fonts();
}
endif;

if( ! function_exists( 'influencer_flush_local_google_fonts' ) ){
    /**
     * Ajax Callback for flushing the local font
     */
        function influencer_flush_local_google_fonts() {
        $WebFontLoader = new Influencer_WebFont_Loader();
        //deleting the fonts folder using ajax
        $WebFontLoader->delete_fonts_folder();
        die();
        }
}
add_action( 'wp_ajax_flush_local_google_fonts', 'influencer_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'influencer_flush_local_google_fonts' );