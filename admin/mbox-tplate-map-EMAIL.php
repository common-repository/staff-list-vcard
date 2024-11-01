<?php
function abcfvc_mbox_tplate_map_EMAIL( $tplateOptns, $slTplateFields ){

    //4.0
    //EMAIL;PREF;INTERNET:jan-ake.akesson@awa.com
    //EMAIL;TYPE=HOME,INTERNET;PREF=1:myemail@mydomain.com
    //EMAIL;TYPE=WORK,INTERNET:myemail@mydomain.com
    
    //EMAIL;TYPE=HOME,INTERNET:myemail@mydomain.com
    //EMAIL;TYPE=HOME,INTERNET,PREF:myemail@mydomain.com
    //EMAIL;CHARSET=UTF-8;TYPE=HOME,INTERNET,PREF:majk@connections-personal-pref. com
    //EMAIL;CHARSET=UTF-8;TYPE=WORK,INTERNET:majk@connections-work.com

    $EMAIL_pref = isset( $tplateOptns['_EMAIL_pref'] ) ? $tplateOptns['_EMAIL_pref'][0] : '';

    $EMAIL_1_type = isset( $tplateOptns['_EMAIL_1_type'] ) ? $tplateOptns['_EMAIL_1_type'][0] : '';
    $EMAIL_2_type = isset( $tplateOptns['_EMAIL_2_type'] ) ? $tplateOptns['_EMAIL_2_type'][0] : '';
    $EMAIL_3_type = isset( $tplateOptns['_EMAIL_3_type'] ) ? $tplateOptns['_EMAIL_3_type'][0] : '';
    $EMAIL_4_type = isset( $tplateOptns['_EMAIL_4_type'] ) ? $tplateOptns['_EMAIL_4_type'][0] : '';
    
    $EMAIL_1 = isset( $tplateOptns['_EMAIL_1'] ) ? $tplateOptns['_EMAIL_1'][0] : '';    
    $EMAIL_2 = isset( $tplateOptns['_EMAIL_2'] ) ? $tplateOptns['_EMAIL_2'][0] : '';
    $EMAIL_3 = isset( $tplateOptns['_EMAIL_3'] ) ? $tplateOptns['_EMAIL_3'][0] : '';
    $EMAIL_4 = isset( $tplateOptns['_EMAIL_4'] ) ? $tplateOptns['_EMAIL_4'][0] : '';

    $cboPref = abcfvc_cbo_preferred_4();
    $cboEmailType = abcfvc_cbo_type_PW();

    echo  abcfl_html_tag('div','CN8','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'EMAIL', 10 );
        //echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(37) );

        
        echo abcfl_input_cbo('EMAIL_pref', '', $cboPref, $EMAIL_pref, abcfvc_txta(44), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('EMAIL_1_type', '', $cboEmailType, $EMAIL_1_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('EMAIL_1', '', $slTplateFields, $EMAIL_1, abcfvc_txta(46) . ' 1', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('EMAIL_2_type', '', $cboEmailType, $EMAIL_2_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('EMAIL_2', '', $slTplateFields, $EMAIL_2, abcfvc_txta(46) . ' 2', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('EMAIL_3_type', '', $cboEmailType, $EMAIL_3_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('EMAIL_3', '', $slTplateFields, $EMAIL_3, abcfvc_txta(46) . ' 3', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_hline('2', '20');
        echo abcfl_input_cbo('EMAIL_4_type', '', $cboEmailType, $EMAIL_4_type, abcfvc_txta(43), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('EMAIL_4', '', $slTplateFields, $EMAIL_4, abcfvc_txta(46) . ' 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}