<?php

function abcfvc_mbox_tplate_optns( $tplateType ){

    //$tplateType = 'VC'

    if( !abcfvc_autil_sl_plugin_installed() ) {
        wp_die( '<h1>Staff List plugin is required.</h1>' );
    }

    $obj = ABCFVC_Main();
    $slug = $obj->pluginSlug;

    global $post;
    $vcTplateID = $post->ID;
    $vcTplateOptns = get_post_custom( $vcTplateID );

    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';    

    //-- ADD NEW Record Screen. Display only Add New cbos --------------------
    if( $vCardVer == ''){
        abcfvc_mbox_tplate_optns_add_template( $tplateType );
        wp_nonce_field( $slug, $slug . '_nonce' );
        return;
    }
    //--------------------------------------------------------------------------

    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ?  $vcTplateOptns['_slTplateID'][0] : 0;
    $staffID = isset( $vcTplateOptns['_staffID'] ) ? $vcTplateOptns['_staffID'][0] : 0;
    $cboSLTplates = abcfvc_dba_cbo_sl_tplates();

    $slTplateName = 'Missing template.';
    if ( array_key_exists( $slTplateID, $cboSLTplates) ){ 
        $slTplateName = $cboSLTplates[$slTplateID]; 
    }
    else{
        wp_die( '<h1>Staff List template ' . $slTplateID . ' does not exists.</h1>' );
    }

    //------------------------------------------------
    abcfvc_mbox_tplate_optns_hdr( $vCardVer, $tplateType );    
    abcfvc_mbox_tplate_optns_vcard( $vCardVer, $slTplateName );
    abcfvc_mbox_tplate_optns_qr_code( $tplateType, $vcTplateOptns, $vCardVer, $slTplateName );
    //---------------------------------------------------------   
    wp_nonce_field( $slug, $slug . '_nonce' );
}
//======================================================================================
function abcfvc_mbox_tplate_optns_qr_code( $tplateType, $vcTplateOptns, $vCardVer, $slTplateName ){

    //Margin , Correction level

    if( $tplateType != 'QR') { return; }

    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $flex3ColS = abcfl_html_tag( 'div', '', 'abcflFG3Col' );
    $divE = abcfl_html_tag_end( 'div'); 

    //------------------------------------------------
    $qrCorrectionL = isset( $vcTplateOptns['_qrCorrectionL'] ) ?  $vcTplateOptns['_qrCorrectionL'][0] : '';
    $qrBlockSizeM = isset( $vcTplateOptns['_qrBlockSizeM'] ) ?  $vcTplateOptns['_qrBlockSizeM'][0] : '';
    $qrSize = isset( $vcTplateOptns['_qrSize'] ) ?  $vcTplateOptns['_qrSize'][0] : '300';
    $qrMargin = isset( $vcTplateOptns['_qrMargin'] ) ?  $vcTplateOptns['_qrMargin'][0] : '0';
    $qrLblFN = isset( $vcTplateOptns['_qrLblFN'] ) ?  $vcTplateOptns['_qrLblFN'][0] : 'N';
    $qrLblFontPx = isset( $vcTplateOptns['_qrLblFontPx'] ) ?  $vcTplateOptns['_qrLblFontPx'][0] : '';
    $qrLblStatic = isset( $vcTplateOptns['_qrLblStatic'] ) ?  $vcTplateOptns['_qrLblStatic'][0] : '';

    $cboSize = abcfvc_cbo_qr_size();
    $cboMargin = abcfvc_cbo_qr_margin();
    $cboCorrectionL = abcfvc_cbo_qr_correction_level();
    $cboBlockSizeMode = abcfvc_cbo_qr_block_size_mode();
    $cboLblFontPx = abcfvc_cbo_qr_lbl_font_px();
    $cboYN = abcfvc_cbo_yn();
    //-----------------------------------------------------
    echo abcfl_input_hline('2', '20');
    $dataL3 =  abcfl_input_cbo('qrCorrectionL', '', $cboCorrectionL, $qrCorrectionL, abcfvc_txta_r(84), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR3 =  abcfl_input_cbo('qrBlockSizeM', '', $cboBlockSizeMode, $qrBlockSizeM, abcfvc_txta_r(93), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    $dataL1 = abcfl_input_cbo('qrSize', '', $cboSize, $qrSize, abcfvc_txta_r(88), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR1 = abcfl_input_cbo('qrMargin', '', $cboMargin, $qrMargin, abcfvc_txta_r(85), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
   
    $data31 = abcfl_input_txt('qrLblStatic', '', $qrLblStatic, abcfvc_txta(87), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $data32 = abcfl_input_cbo('qrLblFN', '', $cboYN, $qrLblFN, abcfvc_txta(86), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl'); 
    $data33 =  abcfl_input_cbo('qrLblFontPx', '', $cboLblFontPx, $qrLblFontPx, abcfvc_txta(98), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    
    echo $flexCntr . $flex2ColS . $dataL3 . $divE . $flex2ColS . $dataR3 . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntr . $flex2ColS . $dataL1 . $divE . $flex2ColS . $dataR1 . abcfl_html_tag_ends( 'div,div' );
    //echo $flexCntr . $flex2ColS . $dataL2 . $divE . $flex2ColS . $dataR2 . abcfl_html_tag_ends( 'div,div' );
    echo $flexCntr . $flex3ColS . $data31 . $divE . $flex3ColS . $data32 . $divE . $flex3ColS . $data33 . abcfl_html_tag_ends( 'div,div' );

    //echo abcfl_input_cbo('qrLblFontPx', '', $cboLblFontPx, $qrLblFontPx, abcfvc_txta(98), abcfvc_txta(0), '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfvc_mbox_tplate_optns_hdr( $vCardVer, $tplateType ){

    $txta = 50;
    $aurl = 15;
    if( $tplateType == 'QR') {
        $txta = 79;
        $aurl = 16;
        $vCardVer = '';
    }
    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta( $txta ) . ' ' . $vCardVer, abcfvc_aurl( $aurl ), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );
}

function abcfvc_mbox_tplate_optns_vcard( $vCardVer, $slTplateName ){

    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------
   
    $dataL = abcfl_input_txt_readonly('vCardVer', '', $vCardVer, abcfvc_txta_r(49), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR = abcfl_input_txt_readonly('ro_slTplateName', '', $slTplateName, abcfvc_txta_r(12), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo $flexCntr . $flex2ColS . $dataL . $divE . $flex2ColS . $dataR . abcfl_html_tag_ends( 'div,div' );
}

function abcfvc_mbox_tplate_optns_add_template( $tplateType ){

    $cboVersion = abcfvc_cbo_vcard_version();
    $cboSLTplates = abcfvc_dba_cbo_sl_tplates();

    $slTplateID = '';
    $txta = 51;
    $aurl = 15;

    if( $tplateType == 'QR') {
        $txta = 79;
        $aurl = 15;
    }

    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta( $txta ), abcfvc_aurl( $aurl ), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10 abcflMBottom10' );
    
    echo abcfl_input_cbo('vCardVerNew', '', $cboVersion, '', abcfvc_txta_r(49), abcfvc_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('slTplateID', '', $cboSLTplates, $slTplateID, abcfvc_txta_r(12), abcfvc_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//#############################################################################
function abcfvc_mbox_tplate_optns_OLD( $tplateType = 'VC'){

    if( !abcfvc_autil_sl_plugin_installed() ) {
        wp_die( '<h1>Staff List plugin is required.</h1>' );
    }

    $obj = ABCFVC_Main();
    $slug = $obj->pluginSlug;

    global $post;
    $vcTplateID = $post->ID;
    $vcTplateOptns = get_post_custom( $vcTplateID );

    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';    

    //-- ADD NEW Record Screen. Display only Add New cbos --------------------
    if( $vCardVer == ''){
        abcfvc_mbox_tplate_optns_add_template( $tplateType );
        wp_nonce_field( $slug, $slug . '_nonce' );
        return;
    }
    //--------------------------------------------------------------------------

    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ?  $vcTplateOptns['_slTplateID'][0] : 0;
    $staffID = isset( $vcTplateOptns['_staffID'] ) ? $vcTplateOptns['_staffID'][0] : 0;
    $cboSLTplates = abcfvc_dba_cbo_sl_tplates();

    $slTplateName = 'Missing template.';
    if ( array_key_exists( $slTplateID, $cboSLTplates) ){ 
        $slTplateName = $cboSLTplates[$slTplateID]; 
    }
    else{
        wp_die( '<h1>Staff List template ' . $slTplateID . ' does not exists.</h1>' );
    }

    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------
    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta(50) . ' ' . $vCardVer, abcfvc_aurl(15), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );

    $dataL = abcfl_input_txt_readonly('vCardVer', '', $vCardVer, abcfvc_txta_r(49), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $dataR = abcfl_input_txt_readonly('ro_slTplateName', '', $slTplateName, abcfvc_txta_r(12), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo $flexCntr . $flex2ColS . $dataL . $divE . $flex2ColS . $dataR . abcfl_html_tag_ends( 'div,div' );
    //---------------------------------------------------------   
    wp_nonce_field( $slug, $slug . '_nonce' );
}