<?php
function abcfvc_mbox_tplate_map_FN( $tplateOptns, $slTplateFields ){

    // Part 1.';
    //formatted name (The way that the name is to be displayed. It can contain desired honorific prefixes, suffixes, titles.)(*required)

    $FN_1 = isset( $tplateOptns['_FN_1'] ) ? $tplateOptns['_FN_1'][0] : '';
    $FN_2 = isset( $tplateOptns['_FN_2'] ) ? $tplateOptns['_FN_2'][0] : '';
    $FN_3 = isset( $tplateOptns['_FN_3'] ) ? $tplateOptns['_FN_3'][0] : '';
    $FN_4 = isset( $tplateOptns['_FN_4'] ) ? $tplateOptns['_FN_4'][0] : '';
    $FN_5 = isset( $tplateOptns['_FN_5'] ) ? $tplateOptns['_FN_5'][0] : '';

    echo  abcfl_html_tag('div','CN2','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'FN - ' . abcfvc_txta(15), 3 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta_r(31) );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(29) );

        echo abcfl_input_cbo('FN_1', '', $slTplateFields, $FN_1, abcfvc_txta(16) . ' 1', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('FN_2', '', $slTplateFields, $FN_2, abcfvc_txta(16) . ' 2', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('FN_3', '', $slTplateFields, $FN_3, abcfvc_txta(16) . ' 3', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('FN_4', '', $slTplateFields, $FN_4, abcfvc_txta(16) . ' 4', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('FN_5', '', $slTplateFields, $FN_5, abcfvc_txta(16) . ' 5', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}