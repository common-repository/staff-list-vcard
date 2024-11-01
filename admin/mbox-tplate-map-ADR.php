<?php
function abcfvc_mbox_tplate_map_static_ADR( $vcTplateOptns, $slTplateFields ){

    //ADR;TYPE=WORK;CHARSET=UTF-8:;12952 S WAMBLEE VALLEY RD;;CONIFER;CO;80433; USA
    //ADR;TYPE=HOME;CHARSET=UTF-8:;Королева Ул., дом 15,;кв. 36; Новосибирск;Новосибирская область;;
    
    //The structured type value corresponds, in sequence, to https://www.ietf.org/rfc/rfc6350.txt
    // the post office box;
    // the extended address (e.g., apartment or suite number);
    // the street address;
    // the locality (e.g., city);
    // the region (e.g., state or province);
    // the postal code;
    // the country name (full name in the language specified in Section 5.1
    //===========================================================================
    $ADR_pref = isset( $vcTplateOptns['_ADR_pref'] ) ? $vcTplateOptns['_ADR_pref'][0] : '';
    $ADR1_type = isset( $vcTplateOptns['_ADR1_type'] ) ? $vcTplateOptns['_ADR1_type'][0] : '';
    $ADR2_type = isset( $vcTplateOptns['_ADR2_type'] ) ? $vcTplateOptns['_ADR2_type'][0] : ''; 
    $ADR3_type = isset( $vcTplateOptns['_ADR3_type'] ) ? $vcTplateOptns['_ADR3_type'][0] : '';
    $ADR4_type = isset( $vcTplateOptns['_ADR4_type'] ) ? $vcTplateOptns['_ADR4_type'][0] : ''; 
    
    $ADR1_st_1 = isset( $vcTplateOptns['_ADR1_st_1'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_1'][0] ) : '';
    $ADR1_st_2 = isset( $vcTplateOptns['_ADR1_st_2'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_2'][0] ) : '';
    $ADR1_st_3 = isset( $vcTplateOptns['_ADR1_st_3'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_3'][0] ) : '';
    $ADR1_st_4 = isset( $vcTplateOptns['_ADR1_st_4'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_4'][0] ) : '';
    $ADR1_st_5 = isset( $vcTplateOptns['_ADR1_st_5'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_5'][0] ) : '';
    $ADR1_st_6 = isset( $vcTplateOptns['_ADR1_st_6'] ) ? esc_attr( $vcTplateOptns['_ADR1_st_6'][0] ) : '';
    
    $ADR2_st_1 = isset( $vcTplateOptns['_ADR2_st_1'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_1'][0] ) : '';
    $ADR2_st_2 = isset( $vcTplateOptns['_ADR2_st_2'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_2'][0] ) : '';
    $ADR2_st_3 = isset( $vcTplateOptns['_ADR2_st_3'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_3'][0] ) : '';
    $ADR2_st_4 = isset( $vcTplateOptns['_ADR2_st_4'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_4'][0] ) : '';
    $ADR2_st_5 = isset( $vcTplateOptns['_ADR2_st_5'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_5'][0] ) : '';
    $ADR2_st_6 = isset( $vcTplateOptns['_ADR2_st_6'] ) ? esc_attr( $vcTplateOptns['_ADR2_st_6'][0] ) : '';

    $ADR3_1 = isset( $vcTplateOptns['_ADR3_1'] ) ? $vcTplateOptns['_ADR3_1'][0] : '';
    $ADR3_2 = isset( $vcTplateOptns['_ADR3_2'] ) ? $vcTplateOptns['_ADR3_2'][0] : '';
    $ADR3_3 = isset( $vcTplateOptns['_ADR3_3'] ) ? $vcTplateOptns['_ADR3_3'][0] : '';
    $ADR3_4 = isset( $vcTplateOptns['_ADR3_4'] ) ? $vcTplateOptns['_ADR3_4'][0] : '';
    $ADR3_5 = isset( $vcTplateOptns['_ADR3_5'] ) ? $vcTplateOptns['_ADR3_5'][0] : '';
    $ADR3_6 = isset( $vcTplateOptns['_ADR3_6'] ) ? $vcTplateOptns['_ADR3_6'][0] : '';

    $ADR4_1 = isset( $vcTplateOptns['_ADR4_1'] ) ? $vcTplateOptns['_ADR4_1'][0] : '';
    $ADR4_2 = isset( $vcTplateOptns['_ADR4_2'] ) ? $vcTplateOptns['_ADR4_2'][0] : '';
    $ADR4_3 = isset( $vcTplateOptns['_ADR4_3'] ) ? $vcTplateOptns['_ADR4_3'][0] : '';
    $ADR4_4 = isset( $vcTplateOptns['_ADR4_4'] ) ? $vcTplateOptns['_ADR4_4'][0] : '';
    $ADR4_5 = isset( $vcTplateOptns['_ADR4_5'] ) ? $vcTplateOptns['_ADR4_5'][0] : '';
    $ADR4_6 = isset( $vcTplateOptns['_ADR4_6'] ) ? $vcTplateOptns['_ADR4_6'][0] : '';
    //------------------------------------------------
    $flexCntr = abcfl_html_tag( 'div', '', 'abcflFGCntr abcflFGCntr50' );
    $flex2ColS = abcfl_html_tag( 'div', '', 'abcflFG2Col' );   
    $divE = abcfl_html_tag_end( 'div'); 
    //------------------------------------------------

    $adr1L_st = abcfl_input_txt('ADR1_st_1', '', $ADR1_st_1, abcfvc_txta(63), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr1R_st = abcfl_input_txt('ADR1_st_2', '', $ADR1_st_2, abcfvc_txta(64), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr1City_st = abcfl_input_txt('ADR1_st_3', '', $ADR1_st_3, abcfvc_txta(65), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr1State_st = abcfl_input_txt('ADR1_st_4', '', $ADR1_st_4, abcfvc_txta(66), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr1Zip_st = abcfl_input_txt('ADR1_st_5', '', $ADR1_st_5, abcfvc_txta(67), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr1Country_st = abcfl_input_txt('ADR1_st_6', '', $ADR1_st_6, abcfvc_txta(68), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    $adr2L_st = abcfl_input_txt('ADR2_st_1', '', $ADR2_st_1, abcfvc_txta(63), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2R_st = abcfl_input_txt('ADR2_st_2', '', $ADR2_st_2, abcfvc_txta(64), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2City_st = abcfl_input_txt('ADR2_st_3', '', $ADR2_st_3, abcfvc_txta(65), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2State_st = abcfl_input_txt('ADR2_st_4', '', $ADR2_st_4, abcfvc_txta(66), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2Zip_st = abcfl_input_txt('ADR2_st_5', '', $ADR2_st_5, abcfvc_txta(67), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr2Country_st = abcfl_input_txt('ADR2_st_6', '', $ADR2_st_6, abcfvc_txta(68), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //------------------------------------------
    $adr3L = abcfl_input_cbo('ADR3_1', '', $slTplateFields, $ADR3_1, abcfvc_txta(63), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');    
    $adr3R = abcfl_input_cbo('ADR3_2', '', $slTplateFields, $ADR3_2, abcfvc_txta(64), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr3City = abcfl_input_cbo('ADR3_3', '', $slTplateFields, $ADR3_3, abcfvc_txta(65), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr3State = abcfl_input_cbo('ADR3_4', '', $slTplateFields, $ADR3_4, abcfvc_txta(66), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr3Zip = abcfl_input_cbo('ADR3_5', '', $slTplateFields, $ADR3_5, abcfvc_txta(67), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr3Country = abcfl_input_cbo('ADR3_6', '', $slTplateFields, $ADR3_6, abcfvc_txta(68), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    $adr4L = abcfl_input_cbo('ADR4_1', '', $slTplateFields, $ADR4_1, abcfvc_txta(63), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');    
    $adr4R = abcfl_input_cbo('ADR4_2', '', $slTplateFields, $ADR4_2, abcfvc_txta(64), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr4City = abcfl_input_cbo('ADR4_3', '', $slTplateFields, $ADR4_3, abcfvc_txta(65), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr4State = abcfl_input_cbo('ADR4_4', '', $slTplateFields, $ADR4_4, abcfvc_txta(66), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr4Zip = abcfl_input_cbo('ADR4_5', '', $slTplateFields, $ADR4_5, abcfvc_txta(67), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    $adr4Country = abcfl_input_cbo('ADR4_6', '', $slTplateFields, $ADR4_6, abcfvc_txta(68), '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    $cboPref = abcfvc_cbo_preferred_4();
    $cboType = abcfvc_cbo_type_HWO();

     //-------------------------------------------------------------------------------- 
    echo  abcfl_html_tag('div','CN12','inside hidden abcflFadeIn');
        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'ADR - ' . abcfvc_txta(40), 14 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(41) );

        echo abcfl_input_cbo('ADR_pref', '', $cboPref, $ADR_pref, abcfvc_txta(44), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title( abcfvc_txta(69) . ' 1' );
        echo abcfl_input_cbo('ADR1_type', '', $cboType, $ADR1_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntr . $flex2ColS . $adr1L_st . $divE . $flex2ColS . $adr1R_st . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr1City_st . $divE . $flex2ColS . $adr1State_st . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr1Zip_st . $divE . $flex2ColS . $adr1Country_st . abcfl_html_tag_ends( 'div,div' );
        
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title( abcfvc_txta(69) . ' 2' );
        echo abcfl_input_cbo('ADR2_type', '', $cboType, $ADR2_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntr . $flex2ColS . $adr2L_st . $divE . $flex2ColS . $adr2R_st . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr2City_st . $divE . $flex2ColS . $adr2State_st . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr2Zip_st . $divE . $flex2ColS . $adr2Country_st . abcfl_html_tag_ends( 'div,div' );
        //------------------------------------------------------------------
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title( abcfvc_txta(40) . ' 3' );
        echo abcfl_input_cbo('ADR3_type', '', $cboType, $ADR3_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntr . $flex2ColS . $adr3L . $divE . $flex2ColS . $adr3R . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr3City . $divE . $flex2ColS . $adr3State . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr3Zip . $divE . $flex2ColS . $adr3Country . abcfl_html_tag_ends( 'div,div' );

        echo abcfl_input_hline('2', '20');
        echo abcfl_input_sec_title( abcfvc_txta(40) . ' 4' );
        echo abcfl_input_cbo('ADR4_type', '', $cboType, $ADR3_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo $flexCntr . $flex2ColS . $adr4L . $divE . $flex2ColS . $adr4R . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr4City . $divE . $flex2ColS . $adr4State . abcfl_html_tag_ends( 'div,div' );
        echo $flexCntr . $flex2ColS . $adr4Zip . $divE . $flex2ColS . $adr4Country . abcfl_html_tag_ends( 'div,div' );

    echo abcfl_html_tag_end('div'); 
}


