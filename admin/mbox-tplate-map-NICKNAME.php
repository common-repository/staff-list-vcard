<?php

function abcfvc_mbox_tplate_map_NICKNAME( $tplateOptns, $slTplateFields ){

    $NICKNAME = isset( $tplateOptns['_NICKNAME'] ) ? $tplateOptns['_NICKNAME'][0] : '';

    echo  abcfl_html_tag('div','CN3','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'NICKNAME - ' . abcfvc_txta(33), 4 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(34) );

        echo abcfl_input_cbo('NICKNAME', '', $slTplateFields, $NICKNAME, abcfvc_txta(33), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}