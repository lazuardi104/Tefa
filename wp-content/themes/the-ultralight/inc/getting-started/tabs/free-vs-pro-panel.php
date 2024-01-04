<?php
/**
 * Free Vs Pro Panel.
 *
 * @package The_Ultralight
 */
?>
<!-- Free Vs Pro panel -->
<div id="free-pro-panel" class="panel-left">
	<div class="panel-aside">               		
		<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/getting-started/images/free-vs-pro.jpg' ); //@todo change respective images.?>" alt="<?php esc_attr_e( 'Free vs Pro', 'the-ultralight' ); ?>"/>
		<a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/the-ultralight-pro/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'the-ultralight' ); ?>" target="_blank">
            <?php esc_html_e( 'View Pro', 'the-ultralight' ); ?>
        </a>
	</div><!-- .panel-aside -->
</div>