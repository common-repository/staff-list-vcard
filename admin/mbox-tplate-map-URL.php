<?php
//Website
function abcfvc_mbox_tplate_map_URL( $vcTplateOptns, $slTplateFields ){

    //A URL pointing to a website that represents the person in some way.
	// 		'blog'    => array( 'HOME' ),
	// 		'website' => array( 'WORK' ),

    $URL_pref = isset( $vcTplateOptns['_URL_pref'] ) ? $vcTplateOptns['_URL_pref'][0] : '';

    $URL_1_type = isset( $vcTplateOptns['_URL_1_type'] ) ? $vcTplateOptns['_URL_1_type'][0] : '';
    $URL_2_type = isset( $vcTplateOptns['_URL_2_type'] ) ? $vcTplateOptns['_URL_2_type'][0] : '';
    $URL_3_type = isset( $vcTplateOptns['_URL_3_type'] ) ? $vcTplateOptns['_URL_3_type'][0] : '';
    $URL_4_type = isset( $vcTplateOptns['_URL_4_type'] ) ? $vcTplateOptns['_URL_4_type'][0] : '';
    
    $URL_1 = isset( $vcTplateOptns['_URL_1'] ) ? $vcTplateOptns['_URL_1'][0] : '';    
    $URL_2 = isset( $vcTplateOptns['_URL_2'] ) ? $vcTplateOptns['_URL_2'][0] : '';
    $URL_3 = isset( $vcTplateOptns['_URL_3'] ) ? $vcTplateOptns['_URL_3'][0] : '';
    $URL_4 = isset( $vcTplateOptns['_URL_4'] ) ? $vcTplateOptns['_URL_4'][0] : '';

    $cboPref = abcfvc_cbo_preferred_website();
    $cboType = abcfvc_cbo_type_PW();

    echo  abcfl_html_tag('div','CN9','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'URL - ' . abcfvc_txta(57), 12 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(56) );

        echo abcfl_input_cbo('URL_pref', '', $cboPref, $URL_pref, abcfvc_txta(44), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('URL_1_type', '', $cboType, $URL_1_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('URL_1', '', $URL_1, 'URL 1 - ' . abcfvc_txta(73), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('URL_2_type', '', $cboType, $URL_2_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URL_2', '', $slTplateFields, $URL_2, 'URL 2', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('URL_3_type', '', $cboType, $URL_3_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URL_3', '', $slTplateFields, $URL_3, 'URL 3', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('URL_4_type', '', $cboType, $URL_4_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URL_4', '', $slTplateFields, $URL_4, 'URL 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}

//Social media
function abcfvc_mbox_tplate_map_URLSM( $vcTplateOptns, $slTplateFields ){

    // item1.URL:http://myFB.com
	// item2.URL:http://myLisr.com
	// item3.URL:http://myVK.com
	// item1.X-ABLABEL:Facebook
	// item2.X-ABLABEL:Angie's List
	// item3.X-ABLABEL:VK

    $URLSM_pref = isset( $vcTplateOptns['_URLSM_pref'] ) ? $vcTplateOptns['_URLSM_pref'][0] : '';

    $URLSM_1_type = isset( $vcTplateOptns['_URLSM_1_type'] ) ? $vcTplateOptns['_URLSM_1_type'][0] : '';
    $URLSM_2_type = isset( $vcTplateOptns['_URLSM_2_type'] ) ? $vcTplateOptns['_URLSM_2_type'][0] : '';
    $URLSM_3_type = isset( $vcTplateOptns['_URLSM_3_type'] ) ? $vcTplateOptns['_URLSM_3_type'][0] : '';
    $URLSM_4_type = isset( $vcTplateOptns['_URLSM_4_type'] ) ? $vcTplateOptns['_URLSM_4_type'][0] : '';
    $URLSM_5_type = isset( $vcTplateOptns['_URLSM_5_type'] ) ? $vcTplateOptns['_URLSM_5_type'][0] : '';
    
    $URLSM_1 = isset( $vcTplateOptns['_URLSM_1'] ) ? $vcTplateOptns['_URLSM_1'][0] : '';    
    $URLSM_2 = isset( $vcTplateOptns['_URLSM_2'] ) ? $vcTplateOptns['_URLSM_2'][0] : '';
    $URLSM_3 = isset( $vcTplateOptns['_URLSM_3'] ) ? $vcTplateOptns['_URLSM_3'][0] : '';
    $URLSM_4 = isset( $vcTplateOptns['_URLSM_4'] ) ? $vcTplateOptns['_URLSM_4'][0] : '';
    $URLSM_5 = isset( $vcTplateOptns['_URLSM_5'] ) ? $vcTplateOptns['_URLSM_5'][0] : '';

    echo  abcfl_html_tag('div','CN10','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( abcfvc_txta(45), 11 );
        //echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(56) );

        echo abcfl_input_txt('URLSM_1_type', '', $URLSM_1_type, abcfvc_txta(43), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URLSM_1', '', $slTplateFields, $URLSM_1, abcfvc_txta(45) . ' 1', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');       
        echo abcfl_input_txt('URLSM_2_type', '', $URLSM_2_type, abcfvc_txta(43), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URLSM_2', '', $slTplateFields, $URLSM_2, abcfvc_txta(45) . ' 2', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');        
        echo abcfl_input_txt('URLSM_3_type', '', $URLSM_3_type, abcfvc_txta(43), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URLSM_3', '', $slTplateFields, $URLSM_3, abcfvc_txta(45) . ' 3', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');        
        echo abcfl_input_txt('URLSM_4_type', '', $URLSM_4_type, abcfvc_txta(43), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URLSM_4', '', $slTplateFields, $URLSM_4, abcfvc_txta(45) . ' 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');        
        echo abcfl_input_txt('URLSM_5_type', '', $URLSM_5_type, abcfvc_txta(43), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('URLSM_5', '', $slTplateFields, $URLSM_5, abcfvc_txta(45) . ' 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}





