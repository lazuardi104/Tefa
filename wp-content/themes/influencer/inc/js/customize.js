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

    wp.customize.section( 'sidebar-widgets-logo-sidebar' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-logo-sidebar' ).priority( '100' );

    wp.customize.section( 'sidebar-widgets-featured-page-sidebar' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-featured-page-sidebar' ).priority( '110' );

    wp.customize.section( 'sidebar-widgets-service-sidebar' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-service-sidebar' ).priority( '120' );

    wp.customize.section( 'sidebar-widgets-testimonial-sidebar' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-testimonial-sidebar' ).priority( '130' );

    wp.customize.section( 'sidebar-widgets-cta-sidebar' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-cta-sidebar' ).priority( '140' );

    wp.customize.panel( 'frontpage_settings', function( section ) {
        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                wp.customize.previewer.previewUrl.set( influencer_customizer_data.url1  );
            }
        } );
    } );

    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

    $('body').on('click', '.flush-it', function(event) {
        $.ajax ({
            url     : influencer_customizer_data.ajax_url,  
            type    : 'post',
            data    : 'action=flush_local_google_fonts',    
            nonce   : influencer_customizer_data.nonce,
            success : function(results){
                //results can be appended in needed
                $( '.flush-it' ).val(influencer_customizer_data.flushit);
            },
        });
    });
});

function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-logo-sidebar':
        preview_section_id = "clients";
        break;
        
        case 'accordion-section-sidebar-widgets-featured-page-sidebar':
        preview_section_id = "about";
        break;

        case 'accordion-section-sidebar-widgets-service-sidebar':
        preview_section_id = "service";
        break;

        case 'accordion-section-sidebar-widgets-testimonial-sidebar':
        preview_section_id = "testimonial";
        break;

        case 'accordion-section-sidebar-widgets-cta-sidebar':
        preview_section_id = "cta";
        break;
                
        
        case 'accordion-section-latest_news_settings':
        preview_section_id = "news";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}