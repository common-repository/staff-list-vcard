<?php
//Array of staff template fields and descriptions. 
//Based on selected Staff template. If no template return empty.
function abcfvc_cbo_staff_fields( $slTplateID ){

    $allFields[''] = '- - -';
    if( $slTplateID == 0 ){ return $allFields; }

    $slTplateOptns = get_post_custom( $slTplateID );
    //-----------------------------------------------------

    $allFields['POSTTITLE'] = 'Post Title';
    $allFields['_sortTxt'] = 'Sort Text';

    $fields = abcfvc_cbo_staff_fields_f( $slTplateOptns, $allFields );
    $social = abcfvc_cbo_staff_fields_social( $slTplateID, $slTplateOptns );

    return $fields + $social;
}

//F fields array.
function abcfvc_cbo_staff_fields_f( $slTplateOptns, $allFields ){

    $fieldParts = array();

    for ( $i = 1; $i <= 50; $i++ ) {
        $fieldParts = abcfvc_cbo_staff_fields_field_parts_by_field_type( $slTplateOptns, 'F' . $i   );
        $allFields = abcfvc_cbo_staff_fields_add_field_parts( $allFields, $fieldParts );
    }
    return $allFields;
}
//------------------------------------------------------------------------
//Add current field parts to the fields parts array.
function abcfvc_cbo_staff_fields_add_field_parts( $allFields, $fieldParts ){

    if (empty( $fieldParts ) ) { return $allFields; }
    foreach( $fieldParts as $key => $value ) {
        $allFields[$key] = $value;
    }
    return $allFields;
}

//Field meta key => field description. Single or multiple parts.
function abcfvc_cbo_staff_fields_field_parts_by_field_type( $slTplateOptns, $F  ){

    $fieldType = isset( $slTplateOptns['_fieldType_' . $F] ) ? $slTplateOptns['_fieldType_' . $F][0]  :'N';
    
    $cboItem = array();
    if( $fieldType == 'N' ) { return $cboItem; }

    switch ( $fieldType ){
        case 'T':
        case 'PT': 
        case 'LT':
        case 'LTABOVE':
        case 'PTABOVE':
        case 'CBO':
        case 'STFFCAT': 
        case 'LBLCBO':                                                           
            $cboItem = abcfvc_cbo_staff_fields_field_parts_single( $slTplateOptns, $F, 'txt', $fieldType );
            break;
        case 'STXT':              
            $cboItem = abcfvc_cbo_staff_fields_field_static_text( $slTplateOptns, $F, 'statTxt', $fieldType );
            break;              
        case 'EM':
        case 'H':
        case 'TH':
        case 'STXEM':                                                        
            $cboItem = abcfvc_cbo_staff_fields_field_parts_url( $slTplateOptns, $F, 'url', $fieldType );
            break;  
        case 'SLDTE':              
            $cboItem = abcfvc_cbo_staff_fields_field_parts_single( $slTplateOptns, $F, 'dteYMD', $fieldType );
        case 'CHECKG':              
            $cboItem = abcfvc_cbo_staff_fields_field_parts_single( $slTplateOptns, $F, 'checkg', $fieldType );  
        case 'CBOM':            
            $cboItem = abcfvc_cbo_staff_fields_field_parts_single( $slTplateOptns, $F, 'cbom', $fieldType );
            break;                                               
        case 'ICONLNK':                                           
            $cboItem = abcfvc_cbo_staff_fields_field_parts_icon_lnk( $slTplateOptns, $F );
            break;
        case 'MP': 
            $cboItem = abcfvc_cbo_staff_fields_field_parts_mp( $slTplateOptns, $F );
            break;       
        case 'FONE':
            $cboItem = abcfvc_cbo_staff_fields_field_parts_fone( $slTplateOptns, $F, 'Phone' );
        break;  
        case 'SLFONE':             
            $cboItem = abcfvc_cbo_staff_fields_field_parts_fone( $slTplateOptns, $F, 'Phone + Static Label' );
            break;
        case 'ADDR': 
            $cboItem = abcfvc_cbo_staff_fields_field_parts_addr( $slTplateOptns, $F );
            break;                       
       default:
            break;
    }
    return $cboItem;
}

//Single part field type. 
function abcfvc_cbo_staff_fields_field_parts_url( $slTplateOptns, $F, $metaKeyType, $fieldType  ){

    //_url_F5
    //--------------------------
    //fbookUrl
    //twitUrl
    //likedUrl
    //likedUrl
    //socialC1Url
    //socialC2Url

    $lbl = abcfvc_cbo_staff_fields_url_lbl( $slTplateOptns, $F );
    if( empty( $lbl ) ){$lbl = abcfvc_cbo_staff_fields_name_by_type( $fieldType ); }

    //Array Meta key => field label
    $out['_' . $metaKeyType . '_'  . $F] = $F . '. ' . $lbl;
    return $out;
}

function abcfvc_cbo_staff_fields_field_static_text( $slTplateOptns, $F, $metaKeyType, $fieldType  ){

    //statTxt_F9

    $lbl = abcfvc_cbo_staff_fields_lbl( $slTplateOptns, $F );
    if( empty( $lbl ) ){$lbl = abcfvc_cbo_staff_fields_name_by_type( $fieldType ); }

    //Array Meta key => field label
    $out['_' . $metaKeyType . '_'  . $F] = $F . '. ' . $lbl;
    return $out;
}

//Single part field type. 
function abcfvc_cbo_staff_fields_field_parts_single( $slTplateOptns, $F, $metaKeyType, $fieldType  ){

    //_txt_F3
    //_url_F5
    //_urlTxt__F5
    //_dteYMD_F13
    //_checkg_
    //_cbom_
    //--------------------------
    //fbookUrl
    //twitUrl
    //likedUrl
    //likedUrl
    //socialC1Url
    //socialC2Url

    $lbl = abcfvc_cbo_staff_fields_lbl( $slTplateOptns, $F );
    if( empty( $lbl ) ){$lbl = abcfvc_cbo_staff_fields_name_by_type( $fieldType ); }

    //Array Meta key => field label
    $out['_' . $metaKeyType . '_'  . $F] = $F . '. ' . $lbl;
    return $out;
}

//FONE, SLFONE. Two items: url and urlTxt.
function abcfvc_cbo_staff_fields_field_parts_fone( $slTplateOptns, $F, $fieldType ){
   
    //lnkLblLbl_F25
    //lnkUrlLbl_F25
    $lbl = abcfvc_cbo_staff_fields_fone_lbl( $slTplateOptns, $F, 'lnkLblLbl', $fieldType );
    $out['_urlTxt_'  . $F] =  $lbl;
    $lbl = abcfvc_cbo_staff_fields_fone_lbl( $slTplateOptns, $F, 'lnkUrlLbl', $fieldType );
    $out['_url_'  . $F] =  $lbl;
    
    return $out;
}
//-------------------------------------------------------------
// MP dropdown items (5).
function abcfvc_cbo_staff_fields_field_parts_mp( $slTplateOptns, $F ){

    $lbl = abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, '1' );
    $out['_mp1_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, '2' );
    $out['_mp2_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, '3' );
    $out['_mp3_'  . $F] = $lbl;

    $lbl = abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, '4' );
    $out['_mp4_'  . $F] = $lbl;

    $lbl = abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, '5' );
    $out['_mp5_'  . $F] = $lbl;
 
    return $out;
}

function abcfvc_cbo_staff_fields_mp_lbl( $slTplateOptns, $F, $part ){

    $lbl = isset( $slTplateOptns['_inputLblP' . $part . '_' . $F] ) ? esc_attr( $slTplateOptns['_inputLblP' . $part . '_' . $F][0] ) : '';
    if( !empty( $lbl ) ){ return  $F . '. ' . $part . ' - ' . $lbl; }
    $lbl = abcfvc_cbo_staff_fields_name_by_type( 'MP' );
    return  $F . '. ' . $lbl . ' ' . $part . '.';
}

//--------------------------------------------------
// ADDR dropdown items (6) 
function abcfvc_cbo_staff_fields_field_parts_addr( $slTplateOptns, $F ){

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '1' );
    $out['_adr1_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '2' );
    $out['_adr2_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '3' );
    $out['_adr3_'  . $F] = $lbl;

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '4' );
    $out['_adr4_'  . $F] = $lbl;

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '5' );
    $out['_adr5_'  . $F] = $lbl;

    $lbl = abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, '6' );
    $out['_adr6_'  . $F] = $lbl;

    return $out;
}

function abcfvc_cbo_staff_fields_addr_lbl( $slTplateOptns, $F, $part ){

    $lbl = isset( $slTplateOptns['_lblTxt_' . $F] ) ? esc_attr( $slTplateOptns['_lblTxt_' . $F][0]  ) : '';
    if(empty( $lbl )){ $lbl = isset( $slTplateOptns['_inputLbl_' . $F] ) ? esc_attr( $slTplateOptns['_inputLbl_' . $F][0] ) : ''; }

    $adrLbl = isset( $slTplateOptns['_inputLblAdr' . $part . '_' . $F] ) ? esc_attr( $slTplateOptns['_inputLblAdr' . $part . '_' . $F][0] ) : '';
    if( !empty( $lbl ) ){ return  $F . '. ' . $lbl . ' - ' . $adrLbl; }

    $lbl = abcfvc_cbo_staff_fields_name_by_type( 'ADDR' );
    return  $F . '. ' . $lbl . ' - ' . $adrLbl;
}

//---------------------------------------------------------------------------
//Font icons dropdown items (6).
function abcfvc_cbo_staff_fields_field_parts_icon_lnk( $slTplateOptns, $F ){
   
    //icon1Url_F28 x 6 icon1Name_F28

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '1' );
    $out['_icon1Url_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '2' );
    $out['_icon2Url_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '3' );
    $out['_icon3Url_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '4' );
    $out['_icon4Url_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '5' );
    $out['_icon5Url_'  . $F] =  $lbl;

    $lbl = abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F , '6' );
    $out['_icon6Url_'  . $F] =  $lbl;

    return $out;
}

function abcfvc_cbo_staff_fields_icon_lnk_lbl( $slTplateOptns, $F, $part ){

    //icon1Name_F28 x 6
    $lbl = isset( $slTplateOptns['_icon' . $part . 'Name_' . $F] ) ? esc_attr( $slTplateOptns['_icon' . $part . 'Name_' . $F][0] ) : '';
    return  $F . '. Icon Font with Links. ' . $part . '. ' . $lbl;
}



//=== Dropdown select item descriptions START =================================================
function abcfvc_cbo_staff_fields_lbl( $slTplateOptns, $F ){

    $lbl = isset( $slTplateOptns['_lblTxt_' . $F] ) ? esc_attr( $slTplateOptns['_lblTxt_' . $F][0]  ) : '';
    if(empty( $lbl )){ $lbl = isset( $slTplateOptns['_inputLbl_' . $F] ) ? esc_attr( $slTplateOptns['_inputLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $slTplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkLblLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $slTplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $slTplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }

    return  $lbl;
}

function abcfvc_cbo_staff_fields_url_lbl( $slTplateOptns, $F ){

    $lbl = isset( $slTplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkUrlLbl_' . $F][0]  ) : '';

    return  $lbl;
}

function abcfvc_cbo_staff_fields_fone_lbl( $slTplateOptns, $F, $part, $fieldType ){

    $staticLbl = isset( $slTplateOptns['_lblTxt_' . $F] ) ? esc_attr( $slTplateOptns['_lblTxt_' . $F][0]  ) : '';
    if(!empty( $staticLbl )){ $staticLbl = $staticLbl . '. '; }

    $lbl = '';
    if($part == 'lnkLblLbl'){
        $lbl = isset( $slTplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkLblLbl_' . $F][0] ) : ''; 
        if(empty( $lbl )){ $lbl = 'Field Label - Visible Text'; }        
    }

    if($part == 'lnkUrlLbl'){
        $lbl = isset( $slTplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $slTplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; 
        if(empty( $lbl )){ $lbl = 'Field Label - Number to Dial (href)'; }
    }

    return  $F . '. ' . $fieldType. '. ' . $staticLbl . $lbl;    
}
//=== Dropdown select item descriptions END =================================================

//Social icons
function abcfvc_cbo_staff_fields_social( $slTplateID, $slTplateOptns ){

    $social1 = isset( $slTplateOptns['_social1'] ) ? esc_attr( $slTplateOptns['_social1'][0] ) : '';
    $social2 = isset( $slTplateOptns['_social2'] ) ? esc_attr( $slTplateOptns['_social2'][0] ) : '';
    $social3 = isset( $slTplateOptns['_social3'] ) ? esc_attr( $slTplateOptns['_social3'][0] ) : '';
    
    $social4 = isset( $slTplateOptns['_social4'] ) ? esc_attr( $slTplateOptns['_social4'][0] ) : '';
    $social5 = isset( $slTplateOptns['_social5'] ) ? esc_attr( $slTplateOptns['_social5'][0] ) : '';
    $social6 = isset( $slTplateOptns['_social6'] ) ? esc_attr( $slTplateOptns['_social6'][0] ) : '';

    $sIcons['_fbookUrl'] = 'Facebook';
    $sIcons['_twitUrl'] = 'Twitter';
    $sIcons['_likedUrl'] = 'LinkedIn';
    $sIcons['_emailUrl'] = 'Email'; 

    if( !empty( $social1 ) ){ $sIcons['_socialC1Url'] = '1. ' . $social1; }
    if( !empty( $social2 ) ){ $sIcons['_socialC2Url'] = '2. ' . $social2; }
    if( !empty( $social3 ) ){ $sIcons['_socialC3Url'] = '3. ' . $social3; }
    if( !empty( $social4 ) ){ $sIcons['_socialC4Url'] = '4. ' . $social4; }
    if( !empty( $social5 ) ){ $sIcons['_socialC5Url'] = '5. ' . $social5; }
    if( !empty( $social6 ) ){ $sIcons['_socialC6Url'] = '6. ' . $social6; }

    return $sIcons;
}

function abcfvc_cbo_staff_fields_name_by_type( $fieldType ){
    if( !function_exists( 'abcfsl_tplate_field_order_field_type' ) ) { return ''; }
    return abcfsl_tplate_field_order_field_type( $fieldType );
}



