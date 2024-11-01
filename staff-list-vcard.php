<?php
/*
Plugin Name: Staff List vCard
Plugin URI: https://abcfolio.com/wordpress-plugin-staff-list-vcard/
Description:  Extension for Staff List plugin to create and download vCards.
Author: abcFolio
Author URI: https://www.abcfolio.com
Text Domain: staff-list
Domain Path: /languages
Version: 0.3.1
------------------------------------------------------------------------
Copyright 2009-2015 abcFolio.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'ABCF_Staff_VCard' ) ) {

final class ABCF_Staff_VCard {

    private static $instance;
    public $pluginSlug = 'abcfolio-staff-list-vcard';
    public $prefix = 'abcfvc';
    public $pluginVersion = '0.3.0';

    public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ABCF_Staff_VCard ) ) {
                    self::$instance = new ABCF_Staff_VCard;
                    self::$instance->setup_constants();
                    self::$instance->includes();
                    self::$instance->setup_actions();

                    //add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
                    //self::$instance->load_textdomain();
            }
            return self::$instance;
    }

    private function __construct (){}

    public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'sl-vcard' ), '1.5' );
    }

    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'sl-vcard' ), '1.5' );
    }

    private function setup_constants() {

        // Plugin Folder QPath
        if( ! defined( 'ABCFVC_PLUGIN_DIR' ) ){ define( 'ABCFVC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
        if( ! defined( 'ABCFVC_PLUGIN_IMG_DIR' ) ){ define( 'ABCFVC_PLUGIN_IMG_DIR', trailingslashit(trailingslashit(ABCFVC_PLUGIN_DIR) . 'images')); }
        // Plugin Folder URL
        if ( ! defined( 'ABCFVC_PLUGIN_URL' ) ) { define( 'ABCFVC_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); }
        // Plugin Root File QPath staff-list-vcard.php
        if ( ! defined( 'ABCFVC_PLUGIN_FILE' ) ){ define( 'ABCFVC_PLUGIN_FILE', __FILE__ ); }
        if ( ! defined( 'ABCFVC_ICONS_URL' ) ){ define( 'ABCFVC_ICONS_URL', trailingslashit(trailingslashit(ABCFVC_PLUGIN_URL) . 'images')); }
     }

    private function includes() {
        
        require_once ABCFVC_PLUGIN_DIR . 'inc/post-types.php';  
        require_once ABCFVC_PLUGIN_DIR . 'inc/db.php';
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-vcard.php';        
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-vcard-data.php';
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-vcard-builder.php';        
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-vcard-render.php';        
        require_once ABCFVC_PLUGIN_DIR . 'vendor/Autoloader.php';
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-img-util.php';
        require_once ABCFVC_PLUGIN_DIR . 'inc/class-qr-render.php';

        if( is_admin() ) {
            require_once ABCFVC_PLUGIN_DIR . 'admin/class-menu.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/admin-tabs.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/admin-scripts.php';            
            require_once ABCFVC_PLUGIN_DIR . 'admin/autil.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/txt-admin.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/txt-aurl.php';            
            require_once ABCFVC_PLUGIN_DIR . 'admin/class-mbox-tplate.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/preview-vcard.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/preview-qr-code.php';            
            require_once ABCFVC_PLUGIN_DIR . 'admin/v-tabs.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-optns.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-N.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-FN.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-NICKNAME.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-NOTE.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-ORG.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-TEL.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-EMAIL.php';            
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-URL.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-PHOTO.php';            
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-map-ADR.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/mbox-tplate-preview.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/dba.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/cbo-staff-fields.php';
            require_once ABCFVC_PLUGIN_DIR . 'admin/cbos.php';           
            require_once ABCFVC_PLUGIN_DIR . 'admin/admin-help.php';

            $abcfMenu = new ABCFVC_Admin_Menu();
            $mboxTplate = new ABCFVC_MBox_Tplate();
        }
    }
    //===================================================================
    private function setup_actions() {
        //add_action('admin_init', 'abcfvc_mbox_tplate_preview_vcard_action_download');
        add_action('admin_init', 'abcfvc_preview_vcard_action_download');
        // Register the callback to support downloading of vCards
        add_action( 'template_redirect' , array( 'ABCFVC_vCard_Render', 'download_vCard' ) );
    }


    // TODO
    function load_textdomain() {

        $pslug = $this->pluginSlug;
        $langDir = plugin_basename( dirname( __FILE__ ) ) . '/languages';

        // Set filter for plugin's languages directory
        $langDir = apply_filters( 'abcfvc_languages_directory', $langDir );

        // Traditional WordPress plugin locale filter
        $locale  = apply_filters( 'plugin_locale',  get_locale(), $pslug );
        $mofile  = sprintf( '%1$s-%2$s.mo', $pslug, $locale );

        // Setup paths to current locale file
        $mofileLocal  = $langDir . $mofile;
        $mofileGlobal = WP_LANG_DIR . '/' . $pslug . '/' . $mofile;

        if ( file_exists( $mofileGlobal ) ) {
            load_textdomain( $pslug, $mofileGlobal );
        } elseif ( file_exists( $mofileLocal ) ) {
            load_textdomain( $pslug, $mofileLocal );
        } else {
            load_plugin_textdomain( $pslug, false, $langDir );
        }
    }

}
} 

function ABCFVC_Main() {
    return ABCF_Staff_VCard::instance();
}

ABCFVC_Main();

