<?php
if (!defined('ABSPATH')) {
    exit;
}

class ABCFVC_vCard_Render {

    public function __construct() {    	
    }

	public static function download_vCard() {

    //$wp_rewrite->using_permalinks
    //http://localhost:8080/wp56/connections-business-directory/name/jan-sawko/vcard/
    //http://localhost:8080/wp56/connections-business-directory/?cn-entry-slug=jan-sawko&cn-process=vcard

    //http://localhost:8080/blog/6336-grid-a-no-ajax/?smid=869-71&vctid=8747&staff-cp=vcard
    //https://abcfolio.com/wordpress-plugin-staff-list-vcard/live-previews/?smid=29534-13&vctid=29606&staff-cp=vcard

        $custProcess = ( get_query_var('staff-cp') ) ? get_query_var('staff-cp' ) : '';

        if ( $custProcess === 'vcard' ) {

            //$staffID = absint( cnQuery::getVar( 'smid' ) );

            $smid = ( get_query_var('smid') ) ? get_query_var('smid') : 0; 
            //var_dump($staffID);die;
            $vcTplateID = ( get_query_var('vctid') ) ? get_query_var('vctid' ) : 0; 

            if ( empty( $smid ) || empty( $vcTplateID ) ) {
                //wp_die( __( 'vCard not available for download.', 'connections' ) );
                wp_die( 'vCard not available for download 1.' );
            }

            $ids = abcfvc_split_smid( $smid );
            $staffID = $ids['staffID'];
            $slTplateVCardFNo = $ids['fieldNo'];

            // if ( empty( $staffID ) || empty( $slTplateVCardFNo ) ) {
            //     wp_die( 'vCard not available for download 2.' );
            // }

            if ( empty( $staffID ) ) {
                wp_die( 'vCard not available for download 2.' );
            }

            //----------------------------------------------------------------------
            $vcTplateOptns = get_post_custom( $vcTplateID );
            $slTplateID = isset( $vcTplateOptns['_slTplateID'] ) ? $vcTplateOptns['_slTplateID'][0] : 0;

            $vCard = new ABCFVC_vCard_Builder( $staffID, $vcTplateID, $slTplateID ); //var_dump($vCard);die;
            $filename = sanitize_file_name( $vCard->nameFN ); //var_dump($filename);
            //$data = $vCard->get_vCard_data()->fetch();

            $data = $vCard->vcardBuilderGetVCardText();

            //var_dump($data);die;

            header( 'Content-Description: File Transfer' );
            header( 'Content-Type: application/octet-stream' );
            header( 'Content-Disposition: attachment; filename=' . $filename . '.vcf' );
            //header( 'Content-Length: ' . strlen( $data ) );
            header( 'Pragma: public' );
            header( "Pragma: no-cache" );
            header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
            header( 'Cache-Control: private' );

            echo $data;
            exit;
        }
    }

    public static function download_vCard_preview( $vcTplateID, $staffID, $slTplateID ) {

            if ( empty( $staffID ) || empty( $vcTplateID ) ) {
                wp_die( 'vCard not available for download 1.' );
            }

            //----------------------------------------------------------------------
            $vCard = new ABCFVC_vCard_Builder( $staffID, $vcTplateID, $slTplateID ); //var_dump($vCard);die;
            $filename = sanitize_file_name( $vCard->nameFN ); //var_dump($filename);
            //$data = $vCard->get_vCard_data()->fetch();

            $data = $vCard->vcardBuilderGetVCardText();

            //var_dump($data);die;

            header( 'Content-Description: File Transfer' );
            header( 'Content-Type: application/octet-stream' );
            header( 'Content-Disposition: attachment; filename=' . $filename . '.vcf' );
            //header( 'Content-Length: ' . strlen( $data ) );
            header( 'Pragma: public' );
            header( "Pragma: no-cache" );
            header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
            header( 'Cache-Control: private' );

            echo $data;
            exit;
        
    }

}