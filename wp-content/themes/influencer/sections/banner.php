<?php  
/**
 * Banner Section
 * 
 *  @package Influencer
*/

$banner_section_image = get_header_image();
$banner_image = ( ! empty( $banner_section_image ) ) ? $banner_section_image : get_template_directory_uri().'/images/banner-img.jpg'; ?>

<div class="banner-section">
    <div class="banner-img">
        <div class="ban-img-holder" style="background: url('<?php echo esc_url( $banner_image ); ?>') no-repeat;"></div>        
        <?php influencer_banner_newsletter(); ?>        
        <?php $scroll_down = influencer_scroll_down_options(); ?>        
        <a href="<?php echo esc_url( $scroll_down ); ?>" class="scroll-down"></a>
    </div>
</div><!-- .banner-section -->