<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Influencer
 */

/**
     * Doctype Hook
     * 
     * @hooked influencer_doctype
    */
    do_action( 'influencer_doctype' );   
?>
<head itemscope itemtype="https://schema.org/WebSite">

<?php 
    
    /**
     * Before wp_head
     * 
     * @hooked influencer_head
    */
    do_action( 'influencer_before_wp_head' );
    
    wp_head(); 
?>

</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked influencer_page_start
    */
    do_action( 'influencer_before_header' );

    /**
     * Header
     * 
     * @hooked influencer_header      
    */
    do_action( 'influencer_header' );
    
    /**
     * Content start
     * 
     * @hooked influencer_content_start
    */
    do_action( 'influencer_content' );

    /**
     * Banner start
     * 
     * @hooked influencer_banner_header_start
    */
    do_action( 'influencer_banner_header' );

    /**
     * Primary Wrapper
     * 
     * @hooked influencer_primary_wrapper_start
    */
    do_action( 'influencer_primary_wrapper' );