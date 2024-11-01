<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Called on register_activation hook
 */
register_activation_hook( ABCFVC_PLUGIN_FILE, 'abcfvc_activate' );

/**
 * Fired when the plugin is activated. $network_wide =
 * TRUE if WPMU superadmin uses "Network Activate" action,
 * FALSE if WPMU is disabled or plugin is activated on an individual blog.
 */
function abcfvc_activate( $network_wide ) {

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {
                    // Get all blog ids
                    $blog_ids = abcfvc_db_wpmu_blogs();
                    foreach ( $blog_ids as $blog_id ) {
                            switch_to_blog( $blog_id );
                            abcfvc_install_single_activate();
                    }
                    restore_current_blog();
            }
            else{
                abcfvc_install_single_activate();
            }
    }
    else {
        abcfvc_install_single_activate();
    }
}

function abcfvc_install_single_activate() {
    abcfvc_install_create_tbls();
}

function abcfvc_install_create_tbls() {
}
