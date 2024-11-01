<?php
function abcfvc_preview_vcard( $vcTplateID, $vcTplateOptns ){

    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';
    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? $vcTplateOptns['_slTplateID'][0] : 0;
    $staffID = isset( $vcTplateOptns['_staffID'] ) ? $vcTplateOptns['_staffID'][0] : 0;

    //--------------------------------------------------------------------------
    abcfvc_mbox_tplate_preview_staff_members( $slTplateID, $staffID );
    $isCardValid = abcfvc_mbox_tplate_preview_render_vcard( $staffID, $vcTplateID, $slTplateID );
    if( $isCardValid ){
        abcfvc_preview_vcard_download_form();
    }
    
}

function abcfvc_preview_vcard_download_form(){
    echo abcfl_html_tag('div','', 'submitB abcflMTop10' );
    echo abcfl_input_btn( 'btnDloadvCard', 'btnDloadvCard', 'submit', abcfvc_txta(77), 'button-primary abcficBtnWide' );
    echo abcfl_html_tag_end('div');
}


//Executed from admin init action
function abcfvc_preview_vcard_action_download(){

    if ( !isset($_POST['btnDloadvCard']) ){ return; }

    $vcTplateID = sanitize_text_field( isset( $_POST['post_ID' ]) ? $_POST['post_ID' ] : 0 );
    $vcTplateID = sanitize_key( $vcTplateID );
    $staffID = sanitize_text_field( isset( $_POST['staffID' ]) ? $_POST['staffID' ] : 0 ); 
    $staffID = sanitize_key( $staffID );

    $vcTplateOptns = get_post_custom( $vcTplateID );
    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? $vcTplateOptns['_slTplateID'][0] : 0;
       
    $render = new ABCFVC_vCard_Render();
    $render->download_vCard_preview( $vcTplateID, $staffID, $slTplateID );
}