<?php
function abcfvc_v_tabs_optns_cntr_start(){
    echo abcfl_html_tag( 'div', 'abcfslVTCNWrapID', 'abcflVTabsMgr' );
}

function abcfvc_v_tabs_render_optns_tab( $fieldNo, $fieldLbl, $liCls='' ){

    $out = abcfl_html_tag( 'li', $fieldNo, $liCls );
        $out .= abcfl_html_a_tag( '#', $fieldLbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );
    
    return $out;
}