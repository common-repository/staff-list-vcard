<?php
function abcfvc_aurl( $id ) {

    $d = 'https://abcfolio.com/wordpress-plugin-staff-list-vcard/';

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1: 
            $out = $d;
            break;
        case 2: 
            $out = $d . 'property-n/';
            break;
        case 3: 
            $out = $d . 'property-fn/';
            break;
        case 4: 
            $out = $d . 'property-nickname/';
            break;
        case 5: 
            $out = $d . 'property-org/';
            break;
        case 6: 
            $out = $d . 'property-title/';
            break;
        case 7:
            $out = $d . 'property-role/';
            break;
        case 8:
            $out = $d . 'property-photo/';
            break;
        case 9:
            $out = $d . 'property-tel/';
            break;
        case 10:
            $out = $d . 'property-email/';
            break;
        case 11:
            $out = $d . 'property-social-media/';
            break;
        case 12:
            $out = $d . 'property-url-website/';
            break;
        case 13:
            $out = $d . 'property-note/';
            break;
        case 14:
            $out = $d . 'property-adr/';
            break;
        case 15:
            $out = $d . 'template-options/';
            break;
        case 16:
            $out = $d . 'staff-list-vcard-qr-code-template-options/';
            break;
        case 17:
            $out = $d . 'staff-list-vcard-qr-code-preview/';
            break;
        case 18:
            $out = $d . 'staff-list-vcard-qr-code-preview/#qr-code-image';
            break;
        case 19:
            $out = $d . 'staff-list-vcard-qr-code-preview/#qr-code-png-file-download';
            break;
        case 20:
            $out = $d . 'staff-list-vcard-qr-code-preview/#qr-code-image-source-base64';
            break;
        case 21:
            $out = $d . 'staff-list-vcard-qr-code-preview/#qr-code-data';
            break;
        case 22:
            $out = $d . 'how-it-works/';
            break;
        case 23:
            $out = $d . 'qr-code-how-it-works/';
            break;
        case 24:
            $out = $d . '';
            break;
        case 25:
            $out = $d . '';
            break;
        case 26:
            $out = $d . '';
            break;
        case 27:
            $out = $d . '';
            break;
        case 28:
            $out = $d . '';
            break;
        case 29:
            $out = $d . '';
            break;
//------------------------------            
        case 30:
            $out = $d . '';
            break;
//------------------------------
        default:
            $out = '';
            break;
    }
    return $out;
}



