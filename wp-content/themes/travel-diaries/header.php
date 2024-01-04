<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Diaries
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open();  ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'travel-diaries' ); ?></a>
    <div class="mobile-header" itemscope itemtype="https://schema.org/WPHeader">
        <div class="container">
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                    
                <?php 
                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                    the_custom_logo();
                }
                ?>
                <div class="text-logo">
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; 
                    ?>
                </div>
                
            </div><!-- .mobile-site-branding -->

            <?php if( get_theme_mod( 'travel_diaries_ed_header_info' ) ) do_action( 'travel_diaries_header_info' ); ?>

            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div> <!-- container -->
        <div class="mobile-menu">
            <nav id="mobile-site-navigation" class="primary-menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                    <button class="btn-close-menu close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                    <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'travel-diaries' ); ?>">
                        <?php 
                        wp_nav_menu( array( 
                            'theme_location' => 'primary', 
                            'menu_id'        => 'mobile-primary-menu',
                            'menu_class'     => 'nav-menu main-menu-modal',
                        ) );
                        ?>
                    </div>
                    <?php
                        if( has_nav_menu( 'secondary' ) ) {  
                            wp_nav_menu( array( 
                                'theme_location' => 'secondary', 
                                'container'      => false,
                                'menu_id'        => 'secondary-menu', 
                                'fallback_cb'    => false 
                            ) );  
                        } 

                        if( get_theme_mod( 'travel_diaries_ed_social' ) ) do_action( 'travel_diaries_social' );  
                    ?>
                    </div>            
                </div>
            </nav><!-- #mobile-site-navigation -->
        </div>
    </div>
    
	<header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
		
        <div class="header-t">
			<div class="container">
				<?php if( has_nav_menu( 'secondary' ) ){ ?>
                <nav class="top-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => false ) ); ?>
				</nav>
				<?php } 
                if( get_theme_mod( 'travel_diaries_ed_social' ) ) do_action( 'travel_diaries_social' ); 
                ?>
                
			</div><!-- .container -->
		</div><!-- .header-t -->
        
        <div class="header-b">
			<div class="container">
            
                <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
        			
                    <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        the_custom_logo();
                    }
                    ?>
                    <div class="text-logo">
                        <?php if ( is_front_page() ) : ?>
                            <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif;
            			$description = get_bloginfo( 'description', 'display' );
            			if ( $description || is_customize_preview() ) : ?>
            				<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            			<?php
                        endif; 
                        ?>
                    </div>
                    
        		</div><!-- .site-branding -->
            
				<?php if( get_theme_mod( 'travel_diaries_ed_header_info' ) ) do_action( 'travel_diaries_header_info' ); ?>
                
			</div><!-- .container -->
		</div><!-- -->
        
	</header><!-- #masthead -->
    
    <div class="navigation menu-navigation">
		<div class="container">
    		<nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
    			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    		</nav><!-- #site-navigation -->	
		</div><!-- .container -->
	</div><!-- .navigation -->

    <?php 
    echo '<div id="acc-content">';
    $ed_section = travel_diaries_get_sections();
    if( is_home() || ! $ed_section || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){  ?>       
	
        <div id="content" class="site-content">
            <div class="container">
                <div class="row">
<?php } ?>
