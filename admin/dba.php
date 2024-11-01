<?php
function abcfvc_dba_cbo_sl_tplates() {
    global $wpdb;
    $slTplates = array();

    $dbRows = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst' AND post_status = 'publish'
        ORDER BY post_title" );
    if ($dbRows) { foreach ($dbRows as $row) {$slTplates[$row->ID] = $row->post_title;} }
    return $slTplates;
}

function abcfvc_dba_cbo_sl_staff_members( $slTplateID ) {
    global $wpdb;
    $slMembers = array();
    $slMembers[0] = ' - - - ';
    
    $dbRows = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst_item' AND post_parent = %d AND post_status = 'publish'
        ORDER BY post_title;" , $slTplateID ));
    if ($dbRows) { foreach ($dbRows as $row) {$slMembers[$row->ID] = $row->post_title;} }
    return $slMembers;
}

function abcfvc_dba_sl_tplate_title_by_id( $slTplateID ) {

    global $wpdb;
    $postTitle = $wpdb->get_var( $wpdb->prepare(
        "SELECT post_title
        FROM $wpdb->posts
        WHERE ID = %d;", $slTplateID ) );

    if( is_null($postTitle) ) { return ''; }
    return $postTitle;
}





