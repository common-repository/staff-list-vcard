<?php
function abcfvc_preview_qr_code( $vcTplateID, $vcTplateOptns ){

    //$vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';
    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? $vcTplateOptns['_slTplateID'][0] : 0;
    $staffID = isset( $vcTplateOptns['_staffID'] ) ? $vcTplateOptns['_staffID'][0] : 0;

    //-----------------------------------------------------------------     
    // QR Code Preview header + Staff Member cbo
    abcfvc_preview_qr_code_section_staff_members( $slTplateID, $staffID );

    // QR Code image + download + img src.
    $out = abcfvc_preview_qr_code_section_qr_code( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID );

    // QR Code Data header + vCard data
    abcfvc_preview_qr_code_section_vcard_data( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID, $out );    
}

 // QR Code Preview header + Staff Member cbo
function abcfvc_preview_qr_code_section_staff_members( $slTplateID, $staffID ){

    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta(91), abcfvc_aurl(17), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );
    abcfvc_mbox_tplate_preview_staff_members( $slTplateID, $staffID );
}

// QR Code image + code64 string
function abcfvc_preview_qr_code_section_qr_code( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID ){

    $out['maxLen'] = 0;
    $out['errTxt'] = false;

    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';

    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta(102), abcfvc_aurl(18), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );
    $out = abcfvc_preview_qr_code_render_img( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID, $vCardVer );

    abcfvc_preview_qr_code_base64_for_copy_paste( $out );

    return $out;
}

// QR Code Data
function abcfvc_preview_qr_code_section_vcard_data( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID, $out ){

    $maxLen = $out['maxLen'];

    if( $maxLen == 0) { return; }

    echo abcfl_input_hline('2', '10'); 
    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta(90), abcfvc_aurl(21), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop20' );

    echo abcfl_input_div_txt_cls_style( abcfvc_txta(104), 'abcflBlack abcflFontFVS14' );
    echo abcfl_input_div_txt_cls_style( 'Data length: ' . $maxLen . '. Max QR Code data length: 4296', 'abcflBlack abcflFontFVS14' );    

    if ( !$out['errTxt'] ) {
        abcfvc_mbox_tplate_preview_render_vcard( $staffID, $vcTplateID, $slTplateID );
    }
}

//==========================================================================================
//Render vCard text. Used by vCard and QR Code.
function abcfvc_preview_qr_code_base64_for_copy_paste( $out ){ 
    
    $imgUri = $out['imgUri'];
    $imgTag = '<img class="" alt="" src="' . $imgUri . '">';

    echo abcfl_input_hline('1', '20');
    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta(101), abcfvc_aurl(20), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );

    echo abcfl_input_txtarea('qrImgSrc_', '', $imgTag, '', '', '100%', '6', '', '', '', 'abcflFldCntr', 'abcflFldLbl abcflFontW600');
}


// QR Code image and 64
function abcfvc_preview_qr_code_render_img( $vcTplateID, $vcTplateOptns, $staffID, $slTplateID, $vCardVer ){

    $out['maxLen'] = 0;
    $out['errTxt'] = false;
    $out['imgUri'] = '';

    //-------------------------------------------------------
    $vcardBuilder = new ABCFVC_vCard_Builder( $staffID, $vcTplateID, $slTplateID ); 
    $vCardTxt = $vcardBuilder->vcardBuilderGetVCardText();
    $vcardFN = $vcardBuilder->vcardBuilderGetFN();
    $errTxt = $vcardBuilder->vcardBuilderGetErrTxt();

    //var_dump($errTxt);

    if ( !empty($errTxt) ) {
        echo '<div class="abcflRed abcflFontS16"><p>' . $errTxt . '</p></div>';
        $out['errTxt'] = true;
        return $out;
    }

    //Max output can be 4296 characters.
    $maxLen = strlen( $vCardTxt );
    $out['maxLen'] = $maxLen; 
    if ( $maxLen > 4296 ) {
        echo '<div class="abcflRed abcflFontS16"><p>' . 'Error: Data too big. Max string length 4296. Current string: ' . $maxLen . '</p></div>';
        $out['errTxt'] = true;
        return $out;
    }
    
    //2464 272250001
    //var_dump($maxLen);
    //return;

    //----------------------------------------------------------------------
    $tagS = abcfl_html_tag( 'div', '', 'abcflMTop5', '' );
    $tagE = abcfl_html_tag_end( 'div' );

    //---QR IMAGE PARTS  --------------------------------------------------------
    $outImg = abcfvc_preview_qr_code_image( $vcTplateOptns, $vcardFN, $vCardTxt );
    //$uploadDir = $outImg['uploadDir'];
    //$qrImgSavedURL = $outImg['qrImgSavedURL'];
    $qrImgFileName = $outImg['qrImgFileName'];    
    $qrImgUri = $outImg['qrImgUri']; 

    $out['imgUri'] = $qrImgUri;

    //-- QR IMAGE 64 -------------------------------------------------------
    //Image 64 tag
    $imgTag64 = abcfvc_preview_qr_code_img_64_tag( $qrImgUri );
    //---------------------------------------------------------------------- 

    // Display image <img src="data:image/png;base64,iVBO....
    echo $tagS . $imgTag64 . $tagE;    
    echo abcfvc_preview_qr_code_img_64_size( $qrImgUri );
    //-----------------------------
    // Download image as png (hyperlink)
    $downloadFileName = abcfvc_preview_qr_code_download_file_name( $vcardFN, $qrImgFileName);
    $lnk64Download = abcfvc_preview_qr_code_img_64_download_link( $qrImgUri, $downloadFileName, abcfvc_txta(89) );

    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, $lnk64Download, abcfvc_aurl(19), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop10' );

    return $out;
}

//===============================================================================================================================
function abcfvc_preview_qr_code_image( $vcTplateOptns, $vcardFN, $vCardTxt ) {

    $vcTplateID = isset( $vcTplateOptns['vcTplateID'] ) ?  $vcTplateOptns['vcTplateID']: 0;

    //----------------------------------------------------------------------
    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';
    $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? $vcTplateOptns['_slTplateID'][0] : 0;
    $staffID = isset( $vcTplateOptns['_staffID'] ) ? $vcTplateOptns['_staffID'][0] : 0;

    //--IMAGE PATHS =========================================
    $qrImgFileName = 'qrcode_' . $vcTplateID . '.png';
    $imgUtil = new ABCFVC_Img_Util();
    $uploadDir = $imgUtil->getUploadDir();

    //=== RENDER QR FILE ======================================
    $qrParams['qrCorrectionL'] = isset( $vcTplateOptns['_qrCorrectionL'] ) ?  $vcTplateOptns['_qrCorrectionL'][0] : '';
    $qrParams['qrBlockSizeM'] = isset( $vcTplateOptns['_qrBlockSizeM'] ) ?  $vcTplateOptns['_qrBlockSizeM'][0] : '';
    $qrParams['qrSize'] = isset( $vcTplateOptns['_qrSize'] ) ?  $vcTplateOptns['_qrSize'][0] : '';
    $qrParams['qrMargin'] = isset( $vcTplateOptns['_qrMargin'] ) ?  $vcTplateOptns['_qrMargin'][0] : 0;
    $qrParams['qrLblFN'] = isset( $vcTplateOptns['_qrLblFN'] ) ?  $vcTplateOptns['_qrLblFN'][0] : '';
    $qrParams['qrLblStatic'] = isset( $vcTplateOptns['_qrLblStatic'] ) ?  $vcTplateOptns['_qrLblStatic'][0] : '';
    $qrParams['vcardFN'] = $vcardFN;
    $qrParams['qrLblFontPx'] = isset( $vcTplateOptns['_qrLblFontPx'] ) ?  $vcTplateOptns['_qrLblFontPx'][0] : '';
    $qrParams['fileQPath'] = $imgUtil->getFileQPath( $qrImgFileName );
    $qrParams['saveImg'] = false;
    //----------------------------------------------------

    //Photo encoding 64 error.
    //$out['qrImgFileName'] = $qrImgFileName;    
    //$out['qrImgUri'] = '';
    //return $out;

    $qrRender = new ABCFVC_Qr_Render( $qrParams, $vCardTxt );
    $qrRender->renderQRCode();    
    
    $out['qrImgFileName'] = $qrImgFileName;    
    $out['qrImgUri'] = $qrRender->getImgUri();
    //$out['uploadDir'] = $uploadDir;
    //$out['qrImgSavedURL'] = $imgUtil->getFileUrl( $qrImgFileName );

    return $out;
}

function abcfvc_preview_qr_code_download_file_name( $vcardFN, $qrImgFileName ){

    $downloadFileName = sanitize_file_name( $vcardFN );
    if ( empty( $downloadFileName ) ){
        $downloadFileName = $qrImgFileName;
    }
    return $downloadFileName . '-qr-code';
}

function abcfvc_preview_qr_code_img_64_tag( $qrImgUri ){

    $imgAlt = '';
    $imgCls = 'abcfvcMT5 abcfvcImgBorder2';
    //$imgCls = 'abcfvcMT5';
    $imgTag64 = abcfl_html_img_tag_resp( '', $qrImgUri, $imgAlt, '', $imgCls, '');

    return $imgTag64;
}

function abcfvc_preview_qr_code_img_64_size( $qrImgUri ){

    if( empty( $qrImgUri ) ) { return ''; }

    //$qrImgUri = 'data:image/png;base64,/9j/4AAQdihdiwd......';
    $binary = \base64_decode(\explode(',', $qrImgUri)[1]);
    $data = \getimagesizefromstring($binary);

    if( !is_array( $data ) ) { return '';}
    
    $w = 0;
    $h = 0;
    if ( array_key_exists( 0, $data ) ) { $w = $data[0]; }
    if ( array_key_exists( 1, $data ) ) { $h = $data[1]; }

    if( empty( $w ) || empty( $h ) ) { return '';}

    $out = 'WxH ' . $w . 'x' . $h;
    $cls = 'abcfvcMT5';
    //abcfl_html_tag_with_content( $cnt, $tag, $id, $cls='', $style='', $microdata='', $empty=false )
    return abcfl_html_tag_with_content( $out, 'div', '', $cls );

    // 0 => int 100
    // 1 => int 126
    // 2 => int 3
    // 3 => string 'width="100" height="126"' (length=24)
    // 'bits' => int 8
    // 'mime' => string 'image/png' (length=9)
}

function abcfvc_preview_qr_code_img_64_download_link( $qrImgUri, $downloadFileName, $lnkTxt ){

    $onclickJS = '';
    $cls = '';
    $args = 'download="' . $downloadFileName . '"';

    return abcfvc_preview_qr_code_a_tag_data( $qrImgUri, $lnkTxt, '', $cls, $onclickJS, $args );
    // <div>
    // <a href="" download="Fernandez-Galvan-qr-code">Download QR Code.</a>
    // </div> 
}

// Takes data 64 as href. href="data:image/png;base64,iVBO.... Modified: abcfl_html_a_tag_simple
function abcfvc_preview_qr_code_a_tag_data( $href, $lnkTxt, $target='', $cls='', $onclickJS='', $args='' ) {

    //abcfl_html_a_tag_data added to library (170)
    
    if( abcfl_html_isblank( $href ) && abcfl_html_isblank( $lnkTxt ) ){ return ''; }

    if(!empty($onclickJS)){ $onclickJS = ' onclick="' . $onclickJS . '"'; }
    $target = abcfl_html_target( $target );
    if (!abcfl_html_isblank($cls)) { $cls = ' class="' . $cls . '"'; }

    if (!abcfl_html_isblank($args)) { 
        $lnkArgs = html_entity_decode( $args, ENT_COMPAT ); 
        $args = ' ' . $lnkArgs . ' ';             
    }

   return '<a' . $cls . ' href="' . $href . '"' . $target . $onclickJS . $args . '>' . $lnkTxt . '</a>';
}