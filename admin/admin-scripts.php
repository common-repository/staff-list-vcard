<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_enqueue_scripts', 'abcfvc_enq_admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'abcfvc_enq_admin_js' );

//==ADMIN======================================================
//Admin CSS
function abcfvc_enq_admin_css() {

    $obj = ABCFVC_Main();
    $ver = $obj->pluginVersion;

    wp_register_style('abcfvc-admin', ABCFVC_PLUGIN_URL . 'css/admin.css', $ver, 'all');
    wp_enqueue_style('abcfvc-admin');
}

//Admin JS
function abcfvc_enq_admin_js() {

    global $typenow;
    $obj = ABCFVC_Main();
    $ver = $obj->pluginVersion;
    $slug = $obj->pluginSlug;

    wp_register_script( 'abcfvc_vtabs_session', ABCFVC_PLUGIN_URL . 'js/vtabs-session.js', array( 'jquery' ), $ver, true );
    wp_enqueue_script('abcfvc_vtabs_session');

}