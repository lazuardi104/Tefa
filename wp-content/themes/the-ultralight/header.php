<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Ultralight
 */
    /**
     * Doctype Hook
     * 
     * @hooked the_ultralight_doctype
    */
    do_action( 'the_ultralight_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked the_ultralight_head
    */
    do_action( 'the_ultralight_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked the_ultralight_page_start - 20 
    */
    do_action( 'the_ultralight_before_header' );
    
    /**
     * Header
     * 
     * @hooked the_ultralight_header - 20     
    */
    do_action( 'the_ultralight_header' );
    
    /**
     * Before Content
     * 
     * @hooked the_ultralight_banner      - 15
     * @hooked the_ultralight_top_section - 20
    */
    do_action( 'the_ultralight_after_header' );
    
    /**
     * Content
     * 
     * @hooked the_ultralight_content_start
    */
    do_action( 'the_ultralight_content' );