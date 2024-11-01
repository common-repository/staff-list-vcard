<?php
function abcfvc_db_cbo_vcard_tplates() {
    
    global $wpdb;
    $vcTplates[0] = ' - - - ';
    $dbRows = $wpdb->get_results( "SELECT ID, post_title 
        FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst_vcard' AND post_status = 'publish'
        ORDER BY post_title" );
    if ( $dbRows ) { 
        foreach ( $dbRows as $row ) { 
            $vcTplates[$row->ID] = $row->post_title;
        } 
    }
    return $vcTplates;
}

function abcfvc_split_smid( $smid ) {

    $out['staffID'] = 0;
    $out['fieldNo'] = 0;

    if ( ( $pos = strpos( $smid, "-" ) ) !== FALSE) { 

        $fieldNo = substr( $smid, $pos+1 );
        $staffID = strtok($smid, '-');

        $out['staffID'] = absint( $staffID );
        $out['fieldNo'] = absint( $fieldNo );
    }

    return $out;
}