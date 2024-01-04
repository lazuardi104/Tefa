<?php
/**
 * Active Callback
 * 
 * @package The Ultralight
*/

function the_ultralight_ed_excerpt_ac( $control ){
    
    $ed_excerpt = $control->manager->get_setting( 'ed_excerpt' )->value();
    $control_id    = $control->id;
    
    if( $control_id == 'excerpt_length' && $ed_excerpt ) return true;
    if( $control_id == 'read_more_text' && $ed_excerpt ) return true;
    
    return false;
}