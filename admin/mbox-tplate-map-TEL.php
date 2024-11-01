<?php

function abcfvc_mbox_tplate_map_TEL( $vcTplateOptns, $slTplateFields ){

    //4.0   6.4.1.  TEL
//     text      | Indicates that the telephone number supports text  messages (SMS).                                       |
//    | voice     | Indicates a voice telephone number.                   |
//    | fax       | Indicates a facsimile telephone number.               |
//    | cell      | Indicates a cellular or mobile telephone number.      |
//    | video     | Indicates a video conferencing telephone number.      |
//    | pager     | Indicates a paging device telephone number.           |
//    | textphone | Indicates a telecommunication device for people with  hearing or speech difficulties.    

    //  Map the core Connection phone type to supported vCard types.
    //  Cell Phone 'cellphone' 'cell' => array( 'CELL', 'VOICE', 'TEXT' ),
     // Work Phone: 'workphone' 'work' => array( 'WORK', 'VOICE' ),
    //  Home Phone: 'home' 'homephone' => array( 'HOME', 'VOICE' ),
    //  Text Phone: 'textphone' 'homephone' => array( 'VOICE', 'TEXT' ),
    $vCardVer = isset( $vcTplateOptns['_vCardVer'] ) ? $vcTplateOptns['_vCardVer'][0] : '';

    $TEL_pref = isset( $vcTplateOptns['_TEL_pref'] ) ? $vcTplateOptns['_TEL_pref'][0] : '';

    $TEL_1_type = isset( $vcTplateOptns['_TEL_1_type'] ) ? $vcTplateOptns['_TEL_1_type'][0] : '';
    $TEL_2_type = isset( $vcTplateOptns['_TEL_2_type'] ) ? $vcTplateOptns['_TEL_2_type'][0] : '';
    $TEL_3_type = isset( $vcTplateOptns['_TEL_3_type'] ) ? $vcTplateOptns['_TEL_3_type'][0] : '';
    $TEL_4_type = isset( $vcTplateOptns['_TEL_4_type'] ) ? $vcTplateOptns['_TEL_4_type'][0] : '';
    
    $TEL_1 = isset( $vcTplateOptns['_TEL_1'] ) ? $vcTplateOptns['_TEL_1'][0] : '';    
    $TEL_2 = isset( $vcTplateOptns['_TEL_2'] ) ? $vcTplateOptns['_TEL_2'][0] : '';
    $TEL_3 = isset( $vcTplateOptns['_TEL_3'] ) ? $vcTplateOptns['_TEL_3'][0] : '';
    $TEL_4 = isset( $vcTplateOptns['_TEL_4'] ) ? $vcTplateOptns['_TEL_4'][0] : '';

    $cboTelPref = abcfvc_cbo_preferred_4();
    $cboTelType = abcfvc_cbo_tel_type_30();
    if ( $vCardVer == '4.0' ) { $cboTelType = abcfvc_cbo_tel_type_40(); }

    echo  abcfl_html_tag('div','CN7','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'TEL - ' . abcfvc_txta(42), 9 );
        //echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(37) );

        echo abcfl_input_cbo('TEL_pref', '', $cboTelPref, $TEL_pref, abcfvc_txta(44), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('TEL_1_type', '', $cboTelType, $TEL_1_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('TEL_1', '', $slTplateFields, $TEL_1, abcfvc_txta(42) . ' 1', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('TEL_2_type', '', $cboTelType, $TEL_2_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('TEL_2', '', $slTplateFields, $TEL_2, abcfvc_txta(42) . ' 2', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('TEL_3_type', '', $cboTelType, $TEL_3_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('TEL_3', '', $slTplateFields, $TEL_3, abcfvc_txta(42) . ' 3', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('TEL_4_type', '', $cboTelType, $TEL_4_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('TEL_4', '', $slTplateFields, $TEL_4, abcfvc_txta(42) . ' 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}