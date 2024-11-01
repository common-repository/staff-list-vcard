<?php

function abcfvc_admin_tabs() {

    $getParams = abcfvc_admin_tabs_defaults();
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabHelp' => abcfvc_txta(1)
        );
    $links = array();

   //Tab links
   foreach( $tabs as $tab => $name ) {

        $href =  $basePg . '&amp;tab=' . $tab;
        if ( $tab == $currentTab ) {
            $links[] = abcfl_html_a_tag( $href, $name, '', 'nav-tab abcfkapNavTab nav-tab-active abcfkapNavTabActive' );
        }
        else {
            $links[] = abcfl_html_a_tag( $href, $name, '', 'nav-tab abcfkapNavTab');
        }
    }

    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_html_tag( 'h2', '', 'nav-tab-wrapper' );

    foreach ( $links as $link ){ echo $link; }
    echo abcfl_html_tag_ends('h2,div');

    switch ( $currentTab ) {
        case 'tabHelp' :
            abcfvc_admin_tab_help();
            break;
        default:
            abcfvc_admin_tab_help();
            break;
   }
}
//--------------------------------------------------
function abcfvc_admin_tabs_defaults() {

  return array(
        'page' => 'abcfvc-admin-tabs',
        'tab' => 'tabHelp'
     );
}