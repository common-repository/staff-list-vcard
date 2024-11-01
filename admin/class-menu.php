<?php
/**
 * Admin menu
*/
    class ABCFVC_Admin_Menu {

    function __construct() {
        add_action( 'admin_menu', array (&$this, 'add_menu') );
    }

    function add_menu() {

        $slug = 'edit.php?post_type=cpt_staff_lst_vcard';
        $capEditor = 'edit_pages';

        add_submenu_page( $slug, 
        abcfvc_txta(11),
        abcfvc_txta(11), 
        $capEditor, 
        'abcfvc-admin-tabs',
        array (&$this, 'load_page'));
    }

    function load_page() {

        switch ($_GET['page']){
            case 'abcfvc-admin-tabs' :
                abcfvc_admin_tabs();
                break;
            default:
                break;
        }
    }
}