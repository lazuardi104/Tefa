( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function($) {
	/* Move widgets to their respective sections */
	wp.customize.section( 'sidebar-widgets-banner-widget' ).panel( 'travel_diaries_home_page_settings' );
	wp.customize.section( 'sidebar-widgets-banner-widget' ).priority( '21' );

	$('body').on('click', '.flush-it', function(event) {
		$.ajax ({
			url     : travel_diaries_cdata.ajax_url,  
			type    : 'post',
			data    : 'action=flush_local_google_fonts',    
			nonce   : travel_diaries_cdata.nonce,
			success : function(results){
				//results can be appended in needed
				$( '.flush-it' ).val(travel_diaries_cdata.flushit);
			},
		});
	});
});