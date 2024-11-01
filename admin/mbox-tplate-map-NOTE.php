<?php
 
function abcfvc_mbox_tplate_map_NOTE( $tplateOptns, $slTplateFields ){

    // Specifies supplemental information or a comment that is associated with the vCard.
    //NOTE:I am proficient in ...

    $NOTE = isset( $tplateOptns['_NOTE'] ) ? esc_attr( $tplateOptns['_NOTE'][0] ) : '';

    echo  abcfl_html_tag('div','CN13','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'NOTE - ' . abcfvc_txta(70), 13 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(71) );

        echo abcfl_input_cbo('NOTE', '', $slTplateFields, $NOTE, abcfvc_txta(72), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}