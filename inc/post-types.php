<?php
/**
 * Custom post types setup
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_action( 'init', 'abcfvc_post_types_register', 100 );
//---------------------------------------- cptSLVCardTpltd
function abcfvc_post_types_register() {

    $slug = 'edit.php?post_type=cpt_staff_lst_vcard';
    register_post_type( 'cpt_staff_lst_vcard', abcfvc_post_types_vcard( $slug ) );
    register_post_type( 'cpt_staff_lst_qrcode', abcfvc_post_types_qrcode( $slug ) );
}

function abcfvc_post_types_vcard() {

    $lbls = array(
        'menu_name' => 'Staff List vCards', //Admin menu Main tab
        'name'               => 'Staff List vCards',  //Items list title
        //'add_new'            => __( 'Add New', ''),
        'add_new_item'       => 'Staff List vCard',
        'edit_item'          => 'Staff List vCard',
        'new_item'           => __( 'New', '' ),
        'all_items'          => 'vCards', //Admin menu
        'search_items'       => __( 'Search', 'sl-vcard' ),
        'not_found'          => __( 'No records found', 'sl-vcard' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'sl-vcard' )
    );

    $args = array(
        'labels'        => $lbls,
        'description'   => '',
        'public'        => true,
        'exclude_from_search'   => true,
        'publicly_queryable'   => false,
        'show_in_nav_menus'   => false,
        'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'   => 'dashicons-id',
        'menu_position' => 89
    );
    return $args;
}

function abcfvc_post_types_qrcode( $slug ) {

    $lbls = array(
        //'menu_name' => 'Staff List vCards', //Admin menu Main tab
        'name'               => 'vCards QR Code',  //Items list title
        //'add_new'            => __( 'Add New 3' ),
        'add_new_item'       => 'vCard QR Code',
        'edit_item'          => 'vCard QR Code',
        'new_item'           => __( 'New', 'sl-vcard' ),
        'all_items'          => 'QR Code', //Admin menu
        'search_items'       => __( 'Search', 'sl-vcard' ),
        'not_found'          => __( 'No records found', 'sl-vcard' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'sl-vcard' )
    );

    $args = array(
        'labels'        => $lbls,
        'description'   => '',
        'public'        => true,
        'exclude_from_search'   => true,
        'publicly_queryable'   => false,
        'show_in_nav_menus'   => false,
        'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => $slug 
    );
    return $args;
}