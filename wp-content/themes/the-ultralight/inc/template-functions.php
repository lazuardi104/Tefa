<?php
/**
 * The Ultralight Template Functions which enhance the theme by hooking into WordPress
 *
 * @package The_Ultralight
 */

if( ! function_exists( 'the_ultralight_doctype' ) ) :
/**
 * Doctype Declaration
*/
function the_ultralight_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'the_ultralight_doctype', 'the_ultralight_doctype' );

if( ! function_exists( 'the_ultralight_head' ) ) :
/**
 * Before wp_head 
*/
function the_ultralight_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'the_ultralight_before_wp_head', 'the_ultralight_head' );

if( ! function_exists( 'the_ultralight_page_start' ) ) :
/**
 * Page Start
*/
function the_ultralight_page_start(){ 
    $page_class_array = the_ultralight_page_class(); ?>
    <div id="page" class="site <?php foreach( $page_class_array as $page_class_){echo esc_attr($page_class_.' '); } ?>">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'the-ultralight' ); ?></a>
    <?php
}
endif;
add_action( 'the_ultralight_before_header', 'the_ultralight_page_start', 20 );

if( ! function_exists( 'the_ultralight_header' ) ) :
/**
 * Header Start
*/
function the_ultralight_header(){?>

    <header id="masthead" class="site-header" itemscope itemtype="https://schema.org/WPHeader">
            <div class="tc-wrapper">
                <div class="site-branding logo-text">
                    
                    <?php
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){ ?>
                    <div class="site-logo" itemscope itemtype="https://schema.org/Organization">
                        <?php the_custom_logo(); ?>
                    </div>
                    <?php } ?>
                    <div class="site-title-wrap">
                        <?php
                        if( is_front_page() ){ ?>
                            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php 
                        }else{ ?>
                            <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        }
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ){ ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php

                        } ?>
                    </div>

                </div> <!-- .site-branding -->
                <div class="nav-wrap">
                    <nav class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                        <button type="button" class="toggle-button">
                            <span class="toggle-bar"></span>
                            <span class="toggle-bar"></span>
                            <span class="toggle-bar"></span>
                        </button>
                        <?php
            				wp_nav_menu( array(
            					'theme_location' => 'primary',
            					'menu_id'        => 'primary-menu',
                                'fallback_cb'    => 'the_ultralight_pro_primary_menu_fallback',
            				) );
            			?>
                    </nav><!-- .main-navigation -->
                    <div class="header-search">
                        <button class="search-toggle-btn">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="header-search-form">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div> <!-- .nav-wrap -->
            </div>
        </header><!-- .site-header -->
    <?php 
}
endif;
add_action( 'the_ultralight_header', 'the_ultralight_header', 20 );

if( ! function_exists( 'the_ultralight_banner' ) ) :
/**
 * Banner Section 
*/
function the_ultralight_banner(){
    $ed_banner      = get_theme_mod( 'ed_banner_area',false);
    if($ed_banner && has_header_image() ){
        if( is_front_page() || is_home() ){ 
            $banner_author_image = get_theme_mod('banner_author_image');
            $newsletter_bottom_note = get_theme_mod('newsletter_bottom_note', __( 'One email per week. Zero spam or ads.', 'the-ultralight' ) );?>
            
            <div id="banner_section" class="site-banner">
            
                <?php the_custom_header_markup(); ?>
                <div class="banner-caption">
                    <div class="tc-wrapper">
                        <?php if($banner_author_image){ ?>
                            <figure class="caption-img">
                                 <img src="<?php echo esc_url($banner_author_image); ?>" alt="<?php echo esc_attr__('Author image','the-ultralight'); ?>" title="<?php echo esc_attr__('Author image','the-ultralight'); ?>" />
                            </figure>
                        <?php } ?>
                        <?php if(the_ultralight_is_btnw_activated()): ?>
                            <div class="banner-form">
                                <?php 
                                    $newsletter_shortcode = get_theme_mod('newsletter_shortcode');
                                    if($newsletter_shortcode){
                                        echo do_shortcode($newsletter_shortcode);
                                    }
                                if($newsletter_bottom_note){ ?>
                                    <div class="header-nl-note"><?php echo wpautop( wp_kses_post( $newsletter_bottom_note ) ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!-- .site-banner -->
            
        <?php }
    }
}
endif;
add_action( 'the_ultralight_after_header', 'the_ultralight_banner', 15 );

if( ! function_exists( 'the_ultralight_content_start' ) ) :
/**
 * Content Start
*/
function the_ultralight_content_start(){ ?> 
    <div id="content" class="site-content">
        <div class="tc-wrapper">
            
    <?php        
    if( ! is_404() ) echo '<div class="row">';
}
endif;
add_action( 'the_ultralight_content', 'the_ultralight_content_start' );

if( ! function_exists('the_ultralight_search_form')):
/**
 * Search Query Form
 */
function the_ultralight_search_form(){
    echo '<div class="search-form-wrap">';
    echo '<h3 class="search-title">'.esc_html__('You are looking for...','the-ultralight').'</h3>';
    get_search_form();
    echo '</div>';
}
endif;
add_action('the_ultralight_search_query','the_ultralight_search_form',20);

if( ! function_exists( 'the_ultralight_entry_header' ) ) :
/**
 * Entry Header
*/
function   the_ultralight_entry_header(){ ?>
    <header class="entry-header">
		<?php 
            $ed_post_date  = get_theme_mod( 'ed_post_date', false );
            
            if ( is_singular() ) {
                if( !is_front_page() ){ the_title( '<h1 class="entry-title"  itemprop="headline">', '</h1>' ); }
    		}else{
    			the_title( '<h2 class="entry-title"  itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }
        
            if( 'post' === get_post_type() ){
                echo '<div class="entry-meta">';
                the_ultralight_posted_by();
                if( is_single() ){
                    if( ! $ed_post_date ) the_ultralight_posted_on();
                }else{
                    the_ultralight_posted_on();
                }
                echo '</div>';
            }		
		?>
	</header>         
    <?php    
}
endif;
add_action( 'the_ultralight_before_post_entry_content', 'the_ultralight_entry_header', 15 );
add_action('the_ultralight_before_page_entry_content','the_ultralight_entry_header',10);


if(! function_exists('the_ultralight_page_header_title')):
/**
 * Header Breadcrumb
 */
 function the_ultralight_page_header_title(){
    if ( is_home() && ! is_front_page() ){
        echo '<div class="page-header">';
        echo '<h1 class="page-title">';
		single_post_title();
        echo '</h1>';
        echo '</div>';
    }
    
    if( is_archive() ){
        if(is_author()){
            /**
             * @hooked the_ultralight_author_ifo -  20
             */
            do_action('the_ultralight_post_author_info');
        }else{
            echo '<div class="page-header">';
    		the_archive_description( '<div class="sub-title">', '</div>' );
            the_archive_title('<h2 class="page-title">','</h2>');
            echo '</div>';
        }
    }
    
    if( is_search() ){ 
        global $wp_query;
        echo '<div class="page-header">';
        echo '<h1 class="page-title">' . esc_html__( 'Search', 'the-ultralight' ) . '</h1>';
        get_search_form();
        echo '<span class="result-count">' . sprintf( esc_html__( 'Showing %1$s Result(s)%2$s', 'the-ultralight' ), '<strong>' . absint(number_format_i18n( $wp_query->found_posts )), '</strong>' ) . '</span>';
        echo '</div>';
    }
    
    if( is_page() ){
         echo '<div class="page-header">';
        the_title( '<h1 class="page-title">', '</h1>' );
        echo '</div>';
    }
 }
endif;

add_action('the_ultralight_after_main','the_ultralight_page_header_title',20);
if ( ! function_exists( 'the_ultralight_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function the_ultralight_post_thumbnail() {
    $image_size  = 'the-ultralight-post-full';
    $ed_featured = get_theme_mod( 'ed_featured_image', true );
    $sidebar     = the_ultralight_sidebar();
    $image_size = ( $sidebar ) ? 'the-ultralight-post-sidebar' : 'the-ultralight-post-full';
    if( is_front_page() && is_home() ){

        echo '<figure class="post-thumbnail">';
        echo '<a href="' . esc_url( get_permalink() ) . '" >';

        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }
        echo '</a>';
        echo '</figure>';
    }elseif( is_home() ){
        echo '<figure class="post-thumbnail">';
        echo '<a href="' . esc_url( get_permalink() ) . '" >';
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( 'the-ultralight-post-full', array( 'itemprop' => 'image' ) );    
        }
        echo '</a>';
        echo '</figure>';
    }elseif( is_archive() || is_search() ){
        echo '<figure class="post-thumbnail">';
        echo '<a href="' . esc_url( get_permalink() ) . '">';
        if( has_post_thumbnail() ){
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }
        echo '</a>';
        echo '</figure>';
    }elseif( is_singular()){
        if($ed_featured){
            echo '<figure class="post-thumbnail">';
                if( has_post_thumbnail() ){
                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
                }
            
            echo '</figure>';
        }
    }
}
endif;
add_action( 'the_ultralight_before_page_entry_content', 'the_ultralight_post_thumbnail',20 );
add_action( 'the_ultralight_before_post_entry_content', 'the_ultralight_post_thumbnail', 20 );

if( ! function_exists( 'the_ultralight_navigation' ) ) :
/**
 * Paginations
*/
function the_ultralight_navigation(){

        if( is_single() ){
        $previous = get_previous_post_link(
            '<div class="nav-previous nav-holder">%link</div>',
            '<i class="fas fa-long-arrow-alt-left"></i>' . esc_html__( 'Previous Article', 'the-ultralight' ) . '',
            false,
            '',
            'category'
        );
    
        $next = get_next_post_link(
            '<div class="nav-next nav-holder">%link</div>',esc_html__( 'Next Article', 'the-ultralight' ) . '<i class="fas fa-long-arrow-alt-right"></i>',
            false,
            '',
            'category'
        ); 
        
        if( $previous || $next ){?>            
            <nav class="navigation posts-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'the-ultralight' ); ?></h2>
                <div class="nav-links">
                    <?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        the_posts_navigation( array(
            'prev_text' => '<i class="fas fa-long-arrow-alt-left"></i>'.__( 'Previous Page','the-ultralight' ),
            'next_text' => __( 'Next Page','the-ultralight' ).'<i class="fas fa-long-arrow-alt-right"></i>',
        ) );
    }
}
endif;
add_action( 'the_ultralight_after_posts_content', 'the_ultralight_navigation', 20 );

if( ! function_exists( 'the_ultralight_entry_content' ) ) :
/**
 * Entry Content
*/
function the_ultralight_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-ultralight' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
            }
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'the_ultralight_page_entry_content', 'the_ultralight_entry_content', 15 );
add_action( 'the_ultralight_post_entry_content', 'the_ultralight_entry_content', 15 );

if( ! function_exists( 'the_ultralight_entry_footer' ) ) :
/**
 * Entry Footer
*/
function the_ultralight_entry_footer(){ 
    $readmore = get_theme_mod( 'read_more_text', __( 'Read More', 'the-ultralight' ) ); 
    $ed_excerpt = get_theme_mod('ed_excerpt',true);?>
	<footer class="entry-footer">
		<?php
			if( is_single() ){
                the_ultralight_category();
                the_ultralight_tag();
            }
            
            if($ed_excerpt && ( is_front_page() || is_home() || is_search() || is_archive())){
                    
                echo '<div class="btn-wrap">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn-transparent">' . esc_html( $readmore ) . '</a>';    
                echo "</div>";

            }

            the_ultralight_comment_count();
            
            if( get_edit_post_link() ){
                edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'the-ultralight' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
            }
		?>
	</footer><!-- .entry-footer -->
	<?php 
}
endif;
add_action( 'the_ultralight_page_entry_content', 'the_ultralight_entry_footer', 20 );
add_action( 'the_ultralight_post_entry_content', 'the_ultralight_entry_footer', 20 );



if(! function_exists('the_ultralight_author_info')):
  /** 
 * authot Info **
 */
 function the_ultralight_author_info(){
    echo '<div class="author-info">';
    echo '<figure class="author-img">';
    echo the_ultralight_gravatar( get_the_author_meta( 'ID' ), 130 );
    echo '</figure>';
    echo '<div class="author-content">';
    echo '<h4 class="author-name">'.esc_html( get_the_author()).'</h4>';
    echo '<div class="author-text">';
    echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) );
    echo '</div>';
    echo '</div>';
    echo '</div>';
 }
endif;
add_action('the_ultralight_post_author_info','the_ultralight_author_info',20);

if( ! function_exists( 'the_ultralight_single_related_post' ) ) :
/**
 * Related Posts 
*/
function the_ultralight_single_related_post(){
    if(is_singular('post')){
        $ed_related_post = get_theme_mod( 'ed_related', true );
        echo '<div class="related-article-section">';
        echo '<div class="tc-wrapper">';
              
            if( $ed_related_post )the_ultralight_get_posts_list( 'related' );
            do_action('the_ultralight_single_post_comment');
              
        echo '</div>';
        echo '</div>';
    }
}
endif;
add_action('the_ultralight_after_footer','the_ultralight_single_related_post',30);

if( ! function_exists( 'the_ultralight_latest_posts' ) ) :
/**
 * Latest Posts
*/
function the_ultralight_latest_posts(){ 
    the_ultralight_get_posts_list( 'latest' );
}
endif;
add_action( 'the_ultralight_latest_posts', 'the_ultralight_latest_posts' );

if( ! function_exists( 'the_ultralight_comment' ) ) :
/**
 * Comments Template 
*/
function the_ultralight_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'the_ultralight_single_post_comment', 'the_ultralight_comment');
add_action( 'the_ultralight_after_page_content', 'the_ultralight_comment' );

if( ! function_exists( 'the_ultralight_content_end' ) ) :
/**
 * Content End
*/
function the_ultralight_content_end(){ 
        if( ! is_404() ) echo '</div><!-- .row -->'; ?>            
        </div><!-- .container -->        
    </div><!-- .site-content -->
    <?php
}
endif;
add_action( 'the_ultralight_after_footer', 'the_ultralight_content_end', 20 );

if( ! function_exists( 'the_ultralight_footer_start' ) ) :
/**
 * Footer Start
*/
function the_ultralight_footer_start(){
    ?>
    <footer  id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'the_ultralight_footer', 'the_ultralight_footer_start', 20 );

if( ! function_exists( 'the_ultralight_footer_top' ) ) :
/**
 * Footer Top
*/
function the_ultralight_footer_top(){

    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three');
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="top-footer">
            <div class="tc-wrapper">
                <div class="footer-holder grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
                    <div class="col">
                       <?php dynamic_sidebar( $active ); ?> 
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <?php 
    }
}
endif;
add_action( 'the_ultralight_footer', 'the_ultralight_footer_top', 30 );

if( ! function_exists( 'the_ultralight_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function the_ultralight_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="tc-wrapper">
            <div class="copyright-menu-wrap">            
                <?php
                    the_ultralight_get_footer_copyright();
                    esc_html_e( 'The Ultralight | Developed By ', 'the-ultralight' );
                    echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'the-ultralight' ) . '</a>.';
                    
                    printf( esc_html__( ' Powered by %s', 'the-ultralight' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'the-ultralight' ) ) .'" target="_blank">WordPress</a>.' );
                ?>               
            </div>
		</div>
	</div>
    <?php
}
endif;
add_action( 'the_ultralight_footer', 'the_ultralight_footer_bottom', 40 );

if(! function_exists('the_ultralight_footer_back_to_top')):
/**
 * Back To Top
 */
function the_ultralight_footer_back_to_top(){
    echo '<button class="back-to-top">';
    echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve"><polygon points="2.7,16.4 15.9,0 29.3,16.4 25.8,19.1 18.3,9.7 18.3,32 13.7,32 13.7,9.7 6.2,19.1     "/></svg>';
    echo '</button>';
}
endif;
add_action('the_ultralight_footer','the_ultralight_footer_back_to_top',45);

if( ! function_exists( 'the_ultralight_footer_end' ) ) :
/**
 * Footer End 
*/
function the_ultralight_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'the_ultralight_footer', 'the_ultralight_footer_end', 50 );

if( ! function_exists( 'the_ultralight_page_end' ) ) :
/**
 * Page End
*/
function the_ultralight_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'the_ultralight_after_footer', 'the_ultralight_page_end', 50 );
