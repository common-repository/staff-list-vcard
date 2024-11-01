<?php
function abcfvc_admin_tab_help( ) {

    echo abcfl_html_tag_cls('div', 'abcflMTop30 abcflPLeft20');
        echo abcfl_input_hlp_url( abcfvc_txta(10), abcfvc_aurl(1), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );

        echo abcfl_input_hlp_url( abcfvc_txta(106), abcfvc_aurl(22), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );
        echo abcfl_input_hlp_url( abcfvc_txta(107), abcfvc_aurl(23), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' ); 
        //echo abcfl_input_hlp_url( abcfvc_txta(24), abcfvc_aurl(2), 'abcflFontS20 abcflFontW600 abcflMTop30 abcflPLeft20' );
    echo abcfl_html_tag_end('div');

}

