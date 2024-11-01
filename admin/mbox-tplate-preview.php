<?php
function abcfvc_mbox_tplate_preview( $tplateType ){

    $obj = ABCFVC_Main();
    $slug = $obj->pluginSlug;

    global $post;
    $vcTplateID = $post->ID;
    $vcTplateOptns = get_post_custom( $vcTplateID );
    $vcTplateOptns['vcTplateID'] = $vcTplateID;


    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';
    //-- ADD NEW Record Screen. Display blank mbox --------------------
    if( $vCardVer == ''){
        abcfvc_mbox_tplate_preview_empty();
        wp_nonce_field( $slug, $slug . '_nonce' );
        return;
    }
    //---------------------------------------------------------------
    if( $tplateType == 'VC') { 
        echo abcfl_html_tag('div','', '' );
        abcfvc_preview_vcard( $vcTplateID, $vcTplateOptns );
        echo abcfl_html_tag_end('div');
        return;
    }

    if( $tplateType == 'QR') { 
        echo abcfl_html_tag('div','', '' );
        abcfvc_preview_qr_code( $vcTplateID, $vcTplateOptns );
        echo abcfl_html_tag_end('div');
        return;
    }
    
}
//========================================================================
function abcfvc_mbox_tplate_preview_empty(){}

function abcfvc_mbox_tplate_preview_staff_members( $slTplateID, $staffID ){

    $cboStaffMembers = abcfvc_dba_cbo_sl_staff_members( $slTplateID );
    echo abcfl_input_cbo('staffID', '', $cboStaffMembers, $staffID, abcfvc_txta(53), abcfvc_txta(105), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}


//Render vCard text. Used by vCard and QR Code.
function abcfvc_mbox_tplate_preview_render_vcard( $staffID, $vcTplateID, $slTplateID ){

    $vcardBuilder = new ABCFVC_vCard_Builder( $staffID, $vcTplateID, $slTplateID ); 
    $vCardTxt = $vcardBuilder->vcardBuilderGetVCardText();
    $errTxt = $vcardBuilder->vcardBuilderGetErrTxt();

    if ( !empty( $errTxt ) ) {
        echo '<div class="abcflRed abcflFontS16"><p>' . $errTxt . '</p></div>';
        return false;
    }

    //=== For testing inputs =====================================
    //abcfvc_mbox_tplate_preview_info( $vcardBuilder );
    //$vcardBuilder->vcard_builder_print_output();
    //=============================================================

    echo abcfl_html_tag('div','', '' );
    echo abcfl_html_tag( 'pre','','' );
    print_r($vCardTxt);
    echo abcfl_html_tag_ends('pre,div');

    return true;
}

function abcfvc_mbox_tplate_preview_info( $vcardBuilder ){

    if( !empty( $vcardBuilder->photoURL ) ){
        echo abcfl_html_tag('div','', '' );
        echo"<pre>", print_r('vcTplateID: ' . $vcardBuilder->vcTplateID, true ), "</pre>";
        echo"<pre>", print_r('slTplateID: ' . $vcardBuilder->slTplateID, true ), "</pre>";
        echo"<pre>", print_r('staffID: ' . $vcardBuilder->staffID, true ), "</pre>";

        echo"<pre>", print_r('Photo file mime: ' . $vcardBuilder->photoMimeType, true ), "</pre>";
        echo"<pre>", print_r('Photo file type: ' . $vcardBuilder->photoFileType, true ), "</pre>";
        echo abcfl_html_tag_end('div');   
    } 
}
