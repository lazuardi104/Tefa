<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Influencer
 */

if( ! function_exists( 'influencer_doctype' ) ) :
    /**
     * Doctype Declaration
    */
    function influencer_doctype(){
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'influencer_doctype', 'influencer_doctype' );

if( ! function_exists( 'influencer_head' ) ) :
    /**
     * Before wp_head 
    */
    function influencer_head(){
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php
    }
endif;
add_action( 'influencer_before_wp_head', 'influencer_head' );

if( ! function_exists( 'influencer_page_start' ) ) :
    /**
     * Page Start
    */
    function influencer_page_start(){
        ?>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'influencer' ); ?></a>
            <?php
        }
    endif;
    add_action( 'influencer_before_header', 'influencer_page_start', 20 );

    if( ! function_exists( 'influencer_header' ) ) :
    /**
     * Header Start
    */
    function influencer_header() { ?>
        <header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
            <div class="main-header">
                <div class="cm-wrapper">
                    <?php if( has_custom_logo() || display_header_text() ) : 
                    if( has_custom_logo() && display_header_text() ) {
                        $add_class = 'has-text-img';
                    }else{
                        $add_class = '';
                    } ?>
                    <div class="site-branding <?php echo esc_attr( $add_class ); ?>" itemscope itemtype="https://schema.org/Organization">
                        <?php if( has_custom_logo() ) : ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( display_header_text() ) { ?>
                            <div class="site-title-wrap">
                                <?php if ( is_front_page() ) : ?>
                                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    <?php else : ?>
                                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                    <?php endif;
                                    
                                    $description = get_bloginfo( 'description', 'display' );
                                    if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                        </div><!-- .site-branding -->
                    <?php endif; ?>

                    <div class="mobile-menu-wrapper">
                        <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">        
                            <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                                <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                                <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'influencer' ); ?>">
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'menu_id'        => 'mobile-primary-menu',
                                            'menu_class'     => 'nav-menu main-menu-modal',
                                            'fallback_cb'    => 'influencer_primary_menu_fallback',
                                        ) );
                                    ?>
                                </div>
                            </div>
                        </nav><!-- #mobile-site-navigation -->
                    </div>

                    <div class="nav-wrap">
                        <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                            <button class="toggle-button" type="button" aria-controls="primary-menu" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle"><span class="toggle-bar"></span><span class="toggle-bar"></span><span class="toggle-bar"></span></button>
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'nav-menu',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => 'influencer_primary_menu_fallback',
                            ) );
                            ?>
                        </nav><!-- #site-navigation -->
                    </div><!-- .nav-wrap -->
                </div><!-- .nav-wrap -->
            </div><!-- .cm-wrapper -->
        </header><!-- .site-header -->
        <?php
    }
endif;
add_action( 'influencer_header', 'influencer_header', 20 );

if( ! function_exists( 'influencer_content_start' ) ) :
    /**
     * Content Start
    */
    function influencer_content_start() {
        if ( !( is_front_page() && ! is_home() ) ) {
            echo '<div id="content" class="site-content">';
        }
    }
endif;
add_action( 'influencer_content', 'influencer_content_start' );

if( ! function_exists( 'influencer_content_end' ) ) :
    /**
     * Content End
    */
    function influencer_content_end() {
        if ( !( is_front_page() && ! is_home() ) ) {
            echo '</div><!-- #content -->';
        }
    }
endif;
add_action( 'influencer_content_end', 'influencer_content_end' );

if( ! function_exists( 'influencer_primary_wrapper_start' ) ) :
    /**
     * Primary Wrapper Start
    */
    function influencer_primary_wrapper_start() {
        echo '<div id="acc-content">';
        if ( !( is_front_page() && ! is_home() ) ) {
            echo '<div class="cm-wrapper">';
        }
    }
endif;
add_action( 'influencer_primary_wrapper', 'influencer_primary_wrapper_start' );

if( ! function_exists( 'influencer_primary_wrapper_end' ) ) :
    /**
     * Primary Wrapper End
    */
    function influencer_primary_wrapper_end() {
        if ( !( is_front_page() && ! is_home() ) ) {
            echo '</div>';
        }
        echo "</div>";
    }
endif;
add_action( 'influencer_primary_wrapperend', 'influencer_primary_wrapper_end' );

if( ! function_exists( 'influencer_banner_header_start' ) ) :
    /**
     * Page Header
    */
    function influencer_banner_header_start() { 

        if( is_front_page() && ! is_home() ) return false;
        
        $influencer_banner_image_url = influencer_banner_header_image();
        
        if( is_single() ) {
            ?>
            <div class="page-header" style="background: url('<?php echo esc_url( $influencer_banner_image_url ); ?>') no-repeat;">
                <div class="cm-wrapper">
                    <?php influencer_posts_categories();
                    influencer_banner_title(); ?>
                    <div class="entry-meta">                        
                        <?php influencer_meta_details(); ?>
                    </div>
                    <a href="#primary" class="scroll-down"></a>
                </div>
            </div>
        <?php }
        else {
            ?>
            <div class="page-header" style="background: url('<?php echo esc_url( $influencer_banner_image_url ); ?>') no-repeat;">
                <div class="cm-wrapper">
                    <?php influencer_banner_title(); ?>
                    <a href="#primary" class="scroll-down"></a>
                </div>
            </div>    
        <?php }
    }
endif;
add_action( 'influencer_banner_header', 'influencer_banner_header_start', 10 );

if( ! function_exists( 'influencer_single_entry_content_start' ) ) :
    /**
     * content of entry-content in singular
    */
    function influencer_single_entry_content_start() { ?>
        
        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'influencer' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->

        <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">
                <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'influencer' ),
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
                ?>
            </footer><!-- .entry-footer -->
        <?php endif;

        if( is_single() ) {
            influencer_posts_tags();
        }
    }
endif;
add_action( 'influencer_singular_content','influencer_single_entry_content_start' );

if( ! function_exists( 'influencer_single_about_author' ) ) :
    /**
     * Influencer Single About Author
    */
    function influencer_single_about_author() { 
        ?>
        <div class="author-newsletter-wrap">
            <?php                 
            influencer_author_details(); 
            influencer_newsletter( false );
            ?>
        </div>        
        <?php
    }
endif;
add_action( 'influencer_single_content', 'influencer_single_about_author', 10 );

if( ! function_exists( 'influencer_pagination_start' ) ) :
    /**
     * Page Header
    */
    function influencer_pagination_start() { 

        if( is_single() ) {
            the_post_navigation( array(
                'prev_text'          => __( '<span class="prev"><span class="prev-arrow"></span><span class="pagination-txt">Previous Post</span></span><h4>%title</h4>', 'influencer' ),
                'next_text'          => __( '<span class="next"><span class="next-arrow"></span><span class="pagination-txt">Next Post</span></span><h4>%title</h4>', 'influencer' ),
            ) ); 
        } 
        else{
            the_posts_pagination( array(
                'mid_size' => 4,
                'prev_text' => __( '<span class="prev-arrow"></span><span class="pagination-txt">Previous</span', 'influencer' ),
                'next_text' => __( '<span class="pagination-txt">Next</span> <span class="next-arrow"></span>', 'influencer' ),
            ) );
        }
    }
endif;
add_action( 'influencer_single_content', 'influencer_pagination_start', 20 );
add_action( 'influencer_pagination', 'influencer_pagination_start' );

if( ! function_exists( 'influencer_comments_start' ) ) :
    /**
     * Page Header
    */
    function influencer_comments_start() { 

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
    endif;
}
endif;
add_action( 'influencer_comments', 'influencer_comments_start' );

if( ! function_exists( 'influencer_footer_start' ) ) :
/**
 * Footer Start
*/
function influencer_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        <?php
    }
endif;
add_action( 'influencer_footer', 'influencer_footer_start', 10 );


if( ! function_exists( 'influencer_footer_top' ) ) :
    /**
     * Footer Top section
    */
    function influencer_footer_top() { 
        $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
        $active_sidebars = array();
        $sidebar_count   = 0;

        foreach ( $footer_sidebars as $footer_sidebar ) {
            if( is_active_sidebar( $footer_sidebar ) ){
                array_push( $active_sidebars, $footer_sidebar );
                $sidebar_count++ ;
            }
        }

        if( ! empty( $active_sidebars ) ){ ?>

            <div class="top-footer">
                <div class="cm-wrapper">
                    <div class="col-<?php echo esc_attr( $sidebar_count ); ?> footer-col-holder">
                        <?php 
                        foreach( $active_sidebars as $active_footer_sidebar ){
                            if( is_active_sidebar( $active_footer_sidebar ) ){
                                echo '<div class="column">';
                                dynamic_sidebar( $active_footer_sidebar );
                                echo '</div>';
                            }
                        } 
                        ?>
                    </div>
                </div><!-- .container -->
            </div><!-- .footer-t -->
        <?php }
    }
endif;
add_action( 'influencer_footer', 'influencer_footer_top', 20 );

if( ! function_exists( 'influencer_footer_bottom' ) ) :
    /**
     * Footer Top section
    */
    function influencer_footer_bottom() { ?>
        <div class="bottom-footer">
            <div class="cm-wrapper">
                <div class="copyright">
                    <?php 
                    /**
                     * Prints footer copyright
                    */
                    influencer_customize_partial_footer_copyright();

                    echo esc_html__( ' Influencer | Developed By', 'influencer' );
                    echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( ' Rara Theme', 'influencer' ) . '</a>';
                    
                    printf( esc_html__( ' Powered by %s', 'influencer' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'influencer' ) ) .'" target="_blank">WordPress</a> .' ); 
                    
                    if ( function_exists( 'the_privacy_policy_link' ) ) {
                        the_privacy_policy_link();
                    } ?>
                </div>
                
                <?php  
                echo '<div class="scroll-to-top"><button>' . esc_html__( 'Back to top','influencer' ) . '<img src="'. esc_url(get_template_directory_uri(). '/images/scroll-top-arrow.png' ) .'"></button></div>';
                ?>
            </div>
        </div>
    <?php }
endif;
add_action( 'influencer_footer', 'influencer_footer_bottom', 30 );

if( ! function_exists( 'influencer_footer_end' ) ) :
/**
 * Footer End 
*/
function influencer_footer_end(){ ?>
</footer><!-- #colophon -->
<?php
}
endif;
add_action( 'influencer_footer', 'influencer_footer_end', 40 );

if( ! function_exists( 'influencer_newsletter' ) ) :
    /**
     * Influencer Blog Newsletter
    */
    function influencer_newsletter( $show ){
        $newsletter_shortcode = get_theme_mod( 'blog_newsletter_shortcode', '' );
        if( is_single() && !$show && !empty( $newsletter_shortcode ) ){
            echo '<div class="post-newsletter">';
            echo do_shortcode( $newsletter_shortcode );   
            echo '</div>';            
        }elseif( is_home() && $show && !empty( $newsletter_shortcode ) ){
            echo '<div class="post-newsletter">';
            echo do_shortcode( $newsletter_shortcode );   
            echo '</div>';  
        }
    }
endif;
add_action( 'influencer_newsletter', 'influencer_newsletter' );

if( ! function_exists( 'influencer_404_latest_posts' ) ) :
    /**
     * Influencer 404 posts
    */
    function influencer_404_latest_posts(){
        $latest_posts_args = array(
            'post_status'           => 'publish', 
            'ignore_sticky_posts'   => true,  
            'posts_per_page'        => 3,
        );
        
        $latest_posts_qry = new WP_Query( $latest_posts_args );

        if( $latest_posts_qry->have_posts() ) { ?>
            <div class="related-post">
                <h3 class="news-post-title"><?php esc_html_e( 'Latest Articles','influencer' ); ?></h3>
                <div class="news-block-wrap clearfix">
                    <?php while( $latest_posts_qry->have_posts() ) {
                        $latest_posts_qry->the_post(); ?>
                        <div class="news-block">
                            <figure class="news-block-img">
                                <?php 
                                if ( has_post_thumbnail() ) { ?>
                                    <a href="<?php the_permalink(); ?>" itemprop="url"><?php the_post_thumbnail( 'influencer-latest-posts', array( 'itemprop' => 'image' ) ); ?></a>
                                <?php } else {
                                    $latest_posts_image = get_template_directory_uri() .'/images/fallback-370x220.jpg'; ?>
                                    <a href="<?php the_permalink(); ?>" itemprop="url"><img itemprop="image" src="<?php echo esc_url( $latest_posts_image ); ?>" alt="<?php the_title_attribute(); ?>"></a>
                                <?php } ?>
                            </figure>
                            <div class="news-content-wrap">
                                <h3 class="news-block-title" itemprop="headline">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <a href="<?php the_permalink(); ?>" class="readmore" itemprop="mainEntityOfPage"><?php esc_html_e( 'Continue Reading','influencer' ); ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php wp_reset_postdata(); 
        }
    }
endif;
add_action( 'influencer_404_posts', 'influencer_404_latest_posts' );