<?php

//Section header + optional help link (?) Default text 'Field Labels'
function abcfvc_autil_tplate_field_section_hdr( $txt, $aurl, $hline ){
    
    if( $hline ) { echo abcfl_input_hline('2', '20'); }
    echo abcfl_input_sec_title_hlp( ABCFVC_ICONS_URL, abcfvc_txta( $txt ), abcfvc_aurl( $aurl ) );
}

function abcfvc_autil_input_two_fields( $dataL, $dataR, $cntrW, $colL ){

$clsCntr = 'abcflFGCntr';
$clsColS1 = 'abcflFG2Col';
$clsColS2 = 'abcflFG2Col';

switch ( $cntrW ) {
    case 50:
        $flexCntr = 'abcflFGCntr abcflFGCntr50';
        break;
    case 30:
        $flexCntr = 'abcflFGCntr abcflFGCntr30';
        break;
    default:
        break;
}

switch ( $colL ) {
    case 65:
        $clsColS1 = 'abcflFG65P';
        $clsColS2 = 'abcflFG33P';
        break;
    case 70:
        $clsColS1 = 'abcflFG70P';
        $clsColS2 = 'abcflFG28P';
        break;
    case 80:
        $clsColS1 = 'abcflFG80P';
        $clsColS2 = 'abcflFG18P';
        break; 
    case 18:
        $clsColS1 = 'abcflFG18P';
        $clsColS2 = 'abcflFG80P';
        break;                       
    default:
        break;
}

$flexCntrS = abcfl_html_tag( 'div', '', $clsCntr );
$clsColS1 = abcfl_html_tag( 'div', '', $clsColS1 ); 
$clsColS2 = abcfl_html_tag( 'div', '', $clsColS2 );    
$divE1 = abcfl_html_tag_end( 'div');
$divE2 = abcfl_html_tag_ends( 'div,div' );

return $flexCntrS . $clsColS1 . $dataL . $divE1 . $clsColS2 . $dataR . $divE2;
}

function abcfvc_autil_sl_plugin_installed(){
    //if( function_exists( '' ) ) { return true; }
    if(  class_exists( 'ABCF_Staff_List' ) ) { return true; }
    return false;
}
//=== Added to 226 library ===========================================
// Simple div with text. Class and optional style.
if ( !function_exists( 'abcfl_input_div_txt_cls_style' ) ){
    function abcfl_input_div_txt_cls_style( $txt, $cls='', $style='' ) {
        if(abcfl_html_isblank( $txt ) ) { return ''; }
        return abcfl_html_tag( 'div', '', $cls, $style) . $txt . abcfl_html_tag_end('div');
    }
}