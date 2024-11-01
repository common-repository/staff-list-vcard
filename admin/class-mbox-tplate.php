<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFVC_MBox_Tplate {

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_lst_vcard', array( $this, 'add_meta_box_vc' ) );
        add_action( 'save_post_cpt_staff_lst_vcard', array( $this, 'save_post' ) );

        add_action( 'add_meta_boxes_cpt_staff_lst_qrcode', array( $this, 'add_meta_box_qr' ) );
        add_action( 'save_post_cpt_staff_lst_qrcode', array( $this, 'save_post' ) );

        //wp_trash_post trash_mycpt trash_{$post->post_type}
        //add_action( 'trash_cpt_staff_lst_qrcode', array( $this, 'trash_post' ) );
        //add_action( 'wp_trash_post', array( $this, 'trash_post' ) );        
    }

    public function add_meta_box_vc() {
        add_meta_box(
            'abcfvc_mbox_tplate_optns_vc',
            abcfvc_txta(19),
            array( $this, 'render_mbox_tplate_optns_vc' ),
            'cpt_staff_lst_vcard',
            'normal',
            'high'
        );

        add_meta_box(
            'abcfvc_mbox_tplate_map_vc',
            abcfvc_txta(4),
            array( $this, 'render_mbox_tplate_map_vc' ),
            'cpt_staff_lst_vcard',
            'normal',
            'high'
        ); 
        
        add_meta_box(
            'abcfvc_mbox_tplate_preview_vc',
            abcfvc_txta(52),
            array( $this, 'render_mbox_tplate_preview_vc' ),
            'cpt_staff_lst_vcard',
            'normal',
            'high'
        );      
    }

    public function add_meta_box_qr() {
        add_meta_box(
            'abcfvc_mbox_tplate_optns_qr',
            abcfvc_txta(19),
            array( $this, 'render_mbox_tplate_optns_qr' ),
            'cpt_staff_lst_qrcode',
            'normal',
            'high'
        );

        add_meta_box(
            'abcfvc_mbox_tplate_map_qr',
            abcfvc_txta(92),
            array( $this, 'render_mbox_tplate_map_qr' ),
            'cpt_staff_lst_qrcode',
            'normal',
            'high'
        ); 
        
        add_meta_box(
            'abcfvc_mbox_tplate_preview_qr',
            abcfvc_txta(91),
            array( $this, 'render_mbox_tplate_preview_qr' ),
            'cpt_staff_lst_qrcode',
            'normal',
            'high'
        );     
    }

    //------------------------------------------------------
    public function render_mbox_tplate_optns_vc() {
        abcfvc_mbox_tplate_optns( 'VC' );
    }

    public function render_mbox_tplate_map_vc() {
        abcfvc_mbox_tplate_map( 'VC' );
    }

    public function render_mbox_tplate_preview_vc() {
        abcfvc_mbox_tplate_preview( 'VC' );
    }
    //------------------------------------------------------
    public function render_mbox_tplate_optns_qr() {
        abcfvc_mbox_tplate_optns( 'QR' );
    }

    public function render_mbox_tplate_map_qr() {
        abcfvc_mbox_tplate_map( 'QR' );
    }

    public function render_mbox_tplate_preview_qr() {
        abcfvc_mbox_tplate_preview( 'QR' );
    }
   
    // public function trash_post( $postID ) {

    //     $qrFileName = 'qrcode_' . $postID . '.png';
    //     $imgUtil = new ABCFVC_Img_Util();
    //     $fileQPath = $imgUtil->getFileQPath( $qrFileName );
    //     if( empty( $fileQPath) ) { return; }

    //     $post_type = get_post_type( $postID );
    //     if ( $post_type == 'cpt_staff_lst_qrcode' ) {
    //         wp_delete_file( $fileQPath );
    //         //error_log( print_r( 'mbox_wp_trash_post - ' . $postID, true) );
    //     }

    //     //error_log( print_r( $fileQPath, true) );
    //     //error_log( print_r( 'trash_post - ' . $postID, true) );
    // }
   //===========================================================================
    public function save_post( $postID ) {

        $obj = ABCFVC_Main();
        $slug = $obj->pluginSlug;  
        

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {
            return;
        }

        //echo"<pre>", print_r( $_POST, true ), "</pre>"; die; 
        //error_log( print_r( $sortTypeOld . ' --- ' . $sortTypeNew, true) ); 

        //--NEW RECORD START -----
        $vCardVerNew = sanitize_text_field( isset( $_POST['vCardVerNew' ]) ? $_POST['vCardVerNew' ] : '' );
        $vCardVer = sanitize_text_field( isset( $_POST['vCardVer' ]) ? $_POST['vCardVer' ] : $vCardVerNew ); 
        
        if ( $vCardVer == '' ){ return; }
        if ( !empty( $vCardVerNew ) ){ 
            abcfl_mbsave_save_cbo( $postID, 'vCardVerNew', '_vCardVer', '');
            abcfl_mbsave_save_cbo( $postID, 'slTplateID', '_slTplateID', '');
            return;
        }
        //--NEW RECORD END  -----

        //Save data.---------------------------------------------
        abcfl_mbsave_save_cbo( $postID, 'staffID', '_staffID', '');

        //First Name
        abcfl_mbsave_save_cbo( $postID, 'N_1', '_N_1', '');
        // Middle Name
        abcfl_mbsave_save_cbo( $postID, 'N_2', '_N_2', '');
        //Last Name
        abcfl_mbsave_save_cbo( $postID, 'N_3', '_N_3', '');
        //Honorific Prefix
        abcfl_mbsave_save_cbo( $postID, 'N_4', '_N_4', '');
        //Honorific Suffix
        abcfl_mbsave_save_cbo( $postID, 'N_5', '_N_5', '');

        abcfl_mbsave_save_cbo( $postID, 'FN_1', '_FN_1', '');
        abcfl_mbsave_save_cbo( $postID, 'FN_2', '_FN_2', '');
        abcfl_mbsave_save_cbo( $postID, 'FN_3', '_FN_3', '');
        abcfl_mbsave_save_cbo( $postID, 'FN_4', '_FN_4', '');
        abcfl_mbsave_save_cbo( $postID, 'FN_5', '_FN_5', '');

        abcfl_mbsave_save_cbo( $postID, 'NICKNAME', '_NICKNAME', '');
        abcfl_mbsave_save_cbo( $postID, 'ORG_Name_st', '_ORG_Name_st', '');
        abcfl_mbsave_save_cbo( $postID, 'ORG_Name', '_ORG_Name', '');
        abcfl_mbsave_save_cbo( $postID, 'ORG_Unit', '_ORG_Unit', '');
        abcfl_mbsave_save_cbo( $postID, 'TITLE_1', '_TITLE_1', '');
        abcfl_mbsave_save_cbo( $postID, 'ROLE', '_ROLE', '');
        abcfl_mbsave_save_cbo( $postID, 'NOTE', '_NOTE', '');

        abcfl_mbsave_save_cbo( $postID, 'TEL_pref', '_TEL_pref', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_1_type', '_TEL_1_type', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_2_type', '_TEL_2_type', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_3_type', '_TEL_3_type', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_4_type', '_TEL_4_type', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_1', '_TEL_1', '');        
        abcfl_mbsave_save_cbo( $postID, 'TEL_2', '_TEL_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'TEL_3', '_TEL_3', '');
        abcfl_mbsave_save_cbo( $postID, 'TEL_4', '_TEL_4', ''); 
        
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_pref', '_EMAIL_pref', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_1_type', '_EMAIL_1_type', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_2_type', '_EMAIL_2_type', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_3_type', '_EMAIL_3_type', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_4_type', '_EMAIL_4_type', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_1', '_EMAIL_1', '');        
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_2', '_EMAIL_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_3', '_EMAIL_3', '');
        abcfl_mbsave_save_cbo( $postID, 'EMAIL_4', '_EMAIL_4', '');  

        abcfl_mbsave_save_cbo( $postID, 'URL_pref', '_URL_pref', '');
        abcfl_mbsave_save_cbo( $postID, 'URL_1_type', '_URL_1_type', '');
        abcfl_mbsave_save_cbo( $postID, 'URL_2_type', '_URL_2_type', '');
        abcfl_mbsave_save_cbo( $postID, 'URL_3_type', '_URL_3_type', '');
        abcfl_mbsave_save_cbo( $postID, 'URL_4_type', '_URL_4_type', '');
        abcfl_mbsave_save_txt( $postID, 'URL_1', '_URL_1');        
        abcfl_mbsave_save_cbo( $postID, 'URL_2', '_URL_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'URL_3', '_URL_3', '');
        abcfl_mbsave_save_cbo( $postID, 'URL_4', '_URL_4', ''); 

        //abcfl_mbsave_save_cbo( $postID, 'URLSM_pref', '_URLSM_pref', '');
        abcfl_mbsave_save_txt( $postID, 'URLSM_1_type', '_URLSM_1_type');
        abcfl_mbsave_save_txt( $postID, 'URLSM_2_type', '_URLSM_2_type');
        abcfl_mbsave_save_txt( $postID, 'URLSM_3_type', '_URLSM_3_type');
        abcfl_mbsave_save_txt( $postID, 'URLSM_4_type', '_URLSM_4_type');
        abcfl_mbsave_save_txt( $postID, 'URLSM_5_type', '_URLSM_5_type');
        abcfl_mbsave_save_cbo( $postID, 'URLSM_1', '_URLSM_1', '');        
        abcfl_mbsave_save_cbo( $postID, 'URLSM_2', '_URLSM_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'URLSM_3', '_URLSM_3', '');
        abcfl_mbsave_save_cbo( $postID, 'URLSM_4', '_URLSM_4', '');
        abcfl_mbsave_save_cbo( $postID, 'URLSM_5', '_URLSM_5', '');  

        abcfl_mbsave_save_cbo( $postID, 'photoEncode64', '_photoEncode64', 'N'); 
        abcfl_mbsave_save_cbo( $postID, 'PHOTO', '_PHOTO', '');
        abcfl_mbsave_save_txt( $postID, 'PHOTO_url_st', '_PHOTO_url_st'); 
        //------------------------------------------
        abcfl_mbsave_save_cbo( $postID, 'ADR_pref', '_ADR_pref', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR1_type', '_ADR1_type', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR2_type', '_ADR2_type', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR3_type', '_ADR3_type', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR4_type', '_ADR4_type', '');

        abcfl_mbsave_save_txt( $postID, 'ADR1_st_1', '_ADR1_st_1');        
        abcfl_mbsave_save_txt( $postID, 'ADR1_st_2', '_ADR1_st_2');        
        abcfl_mbsave_save_txt( $postID, 'ADR1_st_3', '_ADR1_st_3');
        abcfl_mbsave_save_txt( $postID, 'ADR1_st_4', '_ADR1_st_4');
        abcfl_mbsave_save_txt( $postID, 'ADR1_st_5', '_ADR1_st_5'); 
        abcfl_mbsave_save_txt( $postID, 'ADR1_st_6', '_ADR1_st_6');

        abcfl_mbsave_save_txt( $postID, 'ADR2_st_1', '_ADR2_st_1');        
        abcfl_mbsave_save_txt( $postID, 'ADR2_st_2', '_ADR2_st_2');        
        abcfl_mbsave_save_txt( $postID, 'ADR2_st_3', '_ADR2_st_3');
        abcfl_mbsave_save_txt( $postID, 'ADR2_st_4', '_ADR2_st_4');
        abcfl_mbsave_save_txt( $postID, 'ADR2_st_5', '_ADR2_st_5'); 
        abcfl_mbsave_save_txt( $postID, 'ADR2_st_6', '_ADR2_st_6');

        abcfl_mbsave_save_cbo( $postID, 'ADR3_1', '_ADR3_1', '');        
        abcfl_mbsave_save_cbo( $postID, 'ADR3_2', '_ADR3_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'ADR3_3', '_ADR3_3', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR3_4', '_ADR3_4', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR3_5', '_ADR3_5', ''); 
        abcfl_mbsave_save_cbo( $postID, 'ADR3_6', '_ADR3_6', '');

        abcfl_mbsave_save_cbo( $postID, 'ADR4_1', '_ADR4_1', '');        
        abcfl_mbsave_save_cbo( $postID, 'ADR4_2', '_ADR4_2', '');        
        abcfl_mbsave_save_cbo( $postID, 'ADR4_3', '_ADR4_3', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR4_4', '_ADR4_4', '');
        abcfl_mbsave_save_cbo( $postID, 'ADR4_5', '_ADR4_5', ''); 
        abcfl_mbsave_save_cbo( $postID, 'ADR4_6', '_ADR4_6', '');
        //------------------------------------------

        abcfl_mbsave_save_cbo( $postID, 'qrCorrectionL', '_qrCorrectionL', '');
        abcfl_mbsave_save_cbo( $postID, 'qrBlockSizeM', '_qrBlockSizeM', '');
        abcfl_mbsave_save_cbo( $postID, 'qrSize', '_qrSize', '');
        abcfl_mbsave_save_cbo( $postID, 'qrMargin', '_qrMargin', '');
        abcfl_mbsave_save_cbo( $postID, 'qrLblFN', '_qrLblFN', '');
        abcfl_mbsave_save_txt( $postID, 'qrLblStatic', '_qrLblStatic');
        abcfl_mbsave_save_txt( $postID, 'qrLblFontPx', '_qrLblFontPx');        
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }
}