<?php
function abcfvc_mbox_tplate_map_tplate_optns(){

    global $post;
    $tplateID = $post->ID;
    $vcTplateOptns = get_post_custom( $tplateID );
    $obj = ABCFVC_Main();

    return array(
        'tplateID' => $post->ID,
        'vcTplateOptns' => $vcTplateOptns,
        'pluginSlug' => $obj->pluginSlug
    );
}

function abcfvc_mbox_tplate_map( $mapType){

    $optns = abcfvc_mbox_tplate_map_tplate_optns();
    $vcTplateOptns = $optns['vcTplateOptns']; 

    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';

    if( $vCardVer == ''){
        abcfvc_v_tabs_optns_cntr_start();
        echo abcfl_html_tag_end('div');
        return;
    }
    //-------------------------------------------------
    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? esc_attr( $vcTplateOptns['_slTplateID'][0] ) : 0;
    //$slTplateOptns = get_post_custom( $slTplateID ); 

    $slTplateFields = abcfvc_cbo_staff_fields( $slTplateID );

    if($vCardVer = '4.0') {
        abcfvc_v_tabs_optns_cntr_start(); //---Manager START
            abcfvc_mbox_tplate_map_render_tabs( $vcTplateOptns );
            abcfvc_mbox_tplate_map_render_cnt( $vcTplateOptns, $slTplateFields, $mapType );
        echo abcfl_html_tag_end( 'div' ); //---Manager END
        return;
    } 
       
    abcfvc_v_tabs_optns_cntr_start(); //---Manager START
        abcfvc_mbox_tplate_map_render_tabs( $vcTplateOptns );
        abcfvc_mbox_tplate_map_render_cnt( $vcTplateOptns, $slTplateFields, $mapType );
    echo abcfl_html_tag_end( 'div' ); //---Manager END
}

function abcfvc_mbox_tplate_map_render_tabs(){
    
    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );        
        echo abcfvc_v_tabs_render_optns_tab( 'CN1' , 'N' . '<b class="abcflRed abcflFontS18"> *</b>', 'abcflVTabsTabActive' );        
        echo abcfvc_v_tabs_render_optns_tab( 'CN2', 'FN' . '<b class="abcflRed abcflFontS18"> *</b>' );  
        echo abcfvc_v_tabs_render_optns_tab( 'CN3','NICKNAME' );       
        echo abcfvc_v_tabs_render_optns_tab( 'CN4', 'ORG' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN5', 'TITLE' );

        echo abcfvc_v_tabs_render_optns_tab( 'CN6', 'ROLE' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN7', 'TEL' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN8', 'EMAIL' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN9', 'URL Website' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN10', 'Social Media' );

        echo abcfvc_v_tabs_render_optns_tab( 'CN11', 'PHOTO' );
        echo abcfvc_v_tabs_render_optns_tab( 'CN12', 'ADR' ); 
        echo abcfvc_v_tabs_render_optns_tab( 'CN13', 'NOTE' );
        //echo abcfvc_v_tabs_render_optns_tab( 'CN15', 'BDAY' );
        //echo abcfvc_v_tabs_render_optns_tab( 'CN16', 'GEO' );
        
        
    echo abcfl_html_tag_end( 'ul' );
}

//=== TABS CONTENT =============================================================
function abcfvc_mbox_tplate_map_render_cnt(  $vcTplateOptns, $slTplateFields, $mapType ){

    echo abcfl_html_tag( 'div', 'abcfslVTCNCntCntrID', 'abcflVTabsCntCntr' );//---Content START
    
    abcfvc_mbox_tplate_map_N( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_FN( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_NICKNAME( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_ORG( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_TITLE( $vcTplateOptns, $slTplateFields );

    abcfvc_mbox_tplate_map_ROLE( $vcTplateOptns, $slTplateFields );    
    abcfvc_mbox_tplate_map_TEL( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_EMAIL( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_URL( $vcTplateOptns, $slTplateFields );
    abcfvc_mbox_tplate_map_URLSM( $vcTplateOptns, $slTplateFields );

    //abcfvc_mbox_tplate_map_PHOTO( $vcTplateOptns, $slTplateFields, $mapType ); 
    abcfvc_mbox_tplate_map_PHOTO( $vcTplateOptns, $mapType ); 
    abcfvc_mbox_tplate_map_static_ADR( $vcTplateOptns, $slTplateFields );  
    abcfvc_mbox_tplate_map_NOTE( $vcTplateOptns, $slTplateFields ); 

    echo abcfl_html_tag_end( 'div' ); //---Content END
}

function abcfvc_mbox_tplate_map_vcard_property_name_hdr( $txt, $hlpURL_ID, $clsCust='') {

    $cls = 'abcflFontWP abcflFontS20 abcflFontW600 abcflMTop5';
    if( !empty( $clsCust ) ){ $cls = trim( $clsCust ); }

    //No link. Show label only.
    if( empty( $hlpURL_ID ) ) { return abcfl_input_sec_title( $txt, $clsCust ); }

    $hlpIcon = abcfl_html_img_tag( '', ABCFVC_ICONS_URL . 'help.png', 'Help', 'Help', 40, 24, 'abcflVABottom' );
    $hlpURL = abcfl_html_a_tag( abcfvc_aurl( $hlpURL_ID ), $hlpIcon, '_blank' );

    return '<div class="' . $cls . '"><span>' . $txt . '</span><span>' . $hlpURL . '</span></div>';
}

function abcfvc_mbox_tplate_map_vcard_property_name_desc( $txt, $clsCust='' ) {

    $cls = 'abcflFontWP abcflFontS15 abcflMTop5';
    if( !empty( $clsCust ) ){ $cls = trim( $clsCust ); }

    return '<div class="' . $cls . '">' . $txt . '</div>';
}