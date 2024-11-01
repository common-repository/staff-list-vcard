<?php


//=== Staff Page Layout  ===========================
//LIST 
function abcfvc_mbox_tplate_map_N( $tplateOptns, $slTplateFieldsArray ){

    // $vcp['N_1'] = ' Last Name.';
    // $vcp['N_2'] = 'First Name.';
    // $vcp['N_3'] = 'Middle Name.';
    // $vcp['N_4'] = 'Honorific Prefix.';
    // $vcp['N_5'] = 'Honorific Suffix.';

    //LASTNAME; FIRSTNAME; ADDITIONAL NAME; NAME PREFIX(Mr.,Mrs.); NAME SUFFIX

    //First Name
    $N_1 = isset( $tplateOptns['_N_1'] ) ? $tplateOptns['_N_1'][0] : '';
    // Middle Name
    $N_2 = isset( $tplateOptns['_N_2'] ) ? $tplateOptns['_N_2'][0] : '';
    //Last Name
    $N_3 = isset( $tplateOptns['_N_3'] ) ? $tplateOptns['_N_3'][0] : '';
    //Honorific Prefix
    $N_4 = isset( $tplateOptns['_N_4'] ) ? $tplateOptns['_N_4'][0] : '';
    //Honorific Suffix
    $N_5 = isset( $tplateOptns['_N_5'] ) ? $tplateOptns['_N_5'][0] : '';

    //abcfvc_txta(16)

    echo  abcfl_html_tag('div','CN1','inside abcflFadeIn');
        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'N - ' . abcfvc_txta(14), 2 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta_r(31) );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(30) );

        echo abcfl_input_cbo('N_3', '', $slTplateFieldsArray, $N_3, abcfvc_txta(17), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('N_1', '', $slTplateFieldsArray, $N_1, abcfvc_txta(18), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('N_2', '', $slTplateFieldsArray, $N_2, abcfvc_txta(20), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('N_4', '', $slTplateFieldsArray, $N_4, abcfvc_txta(23), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('N_5', '', $slTplateFieldsArray, $N_5, abcfvc_txta(25), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_html_tag_end('div'); 
}

