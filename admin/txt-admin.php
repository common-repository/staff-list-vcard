<?php
function abcfvc_txta($id, $suffix='') {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = __('Help', 'sl-vcard');
            break;
        case 2:
            $out = __('Images', 'sl-vcard');
            break;
        case 3:
            $out = __('Shortcode', 'sl-vcard');
            break;
        case 4:
            $out = __('vCard Properties', 'sl-vcard');
            break;
        case 5:
            $out = __('Yes', 'sl-vcard');
            break;
        case 6:
            $out = __('No', 'sl-vcard');
            break;
        case 7:
            $out = __('Default', 'sl-vcard');
            break;
        case 8:
            $out = __('License', 'sl-vcard');
            break;
        case 9:
            $out = __('Options', 'sl-vcard');
            break;
        case 10:
            $out = __('Documentation', 'sl-vcard');
            break;
//------------------------
       case 11:
            $out = __('Admin', 'sl-vcard');
            break;
       case 12:
            $out = __('Staff Template', 'sl-vcard');
            break;
       case 13:
            $out = __('vcType', 'sl-vcard');
            break;
        case 14:
            $out = __('Name', 'sl-vcard');
            break;
        case 15:
            $out = __('Formatted Name', 'sl-vcard');
            break;
        case 16:
            $out = __('Part', 'sl-vcard');
            break;
        case 17:
            $out = __('Last Name', 'sl-vcard');
            break;
        case 18:
            $out = __('First Name', 'sl-vcard');
            break;
        case 19:
            $out = __('Template Options', 'sl-vcard');
            break;
//------------------------
        case 20:
            $out = __('Middle Name', 'sl-vcard');
            break;
        case 21:
             $out = __('Activate Key', 'sl-vcard');
             break;
        case 22:
             $out = __('License Key', 'sl-vcard');
             break;
        case 23:
            $out = __('Honorific Prefix (Mr., Mrs., Dr.)', 'sl-vcard');
            break;
        case 24:
            $out = __('Support', 'sl-vcard');
            break;
        case 25:
            $out = __('Honorific Suffix', 'sl-vcard');
            break;
        case 26:
            $out = __('License & Help', 'sl-vcard');
            break;
        case 27:
            $out = __('Image', 'sl-vcard');
            break;
        case 28:
            $out = __('Description', 'sl-vcard');
            break;
        case 29:
            $out = __('The way that the name is to be displayed.', 'sl-vcard');
            break;
//------------------------'
        case 30:
            $out = __('A structured representation of the name of the person: last name; first name; additional name; prefix; suffix.', 'sl-vcard');
            break;
        case 31:
            $out = __('Required', 'sl-vcard');
            break;
        case 32:
            $out = __('Error', 'sl-vcard');
            break;
        case 33:
            $out = __('Nickname', 'sl-vcard');
            break;
        case 34:
            $out = __('One or more descriptive/familiar names');
            break;
        case 35:
            $out = __('Organization', 'sl-vcard');
            break;
        case 36:
            $out = __('Department', 'sl-vcard');
            break;
        case 37:
            $out = __('Name and optionally the unit(s) of the organization.', 'sl-vcard');
            break;
        case 38:
            $out = __('Job Title', 'sl-vcard');
            break;
        case 39:
            $out = __('Job title, functional position or function.', 'sl-vcard');
             break;
//------------------------
        case 40:
            $out = __('Address', 'sl-vcard');
             break;
        case 41:
            $out = __('Physical delivery address', 'sl-vcard');
            break;
        case 42:
            $out = __('Phone Number', 'sl-vcard');
            break;
       case 43:
            $out = __('Type', 'sl-vcard');
            break;
       case 44:
            $out = __('Preferred', 'sl-vcard');
            break;
        case 45:
            $out = __('Social Media', 'sl-vcard');
            break;
        case 46:
            $out = __('Email Adress', 'sl-vcard');
            break;
        case 47:
            $out = __('Home', 'sl-vcard');
            break;
        case 48:
            $out = __('Work', 'sl-vcard');
            break;
        case 49:
            $out = __('vCard Version', 'sl-vcard');
            break;
//------------------------
        case 50:
            $out = __('vCard', 'sl-vcard');
            break;
        case 51:
            $out = 'Staff List vCard';
            break;
        case 52:
            $out = __('vCard Preview', 'sl-vcard');
            break;
        case 53:
            $out = __('Staff Member', 'sl-vcard');
            break;
        case 54:
            $out = __('Role', 'sl-vcard');
            break;
        case 55:
            $out = __('The role, occupation, or business category', 'sl-vcard');
            break;
        case 56:
            $out = __('A URL pointing to a website that represents the person.', 'sl-vcard');
            break;
        case 57:
            $out = __('Website', 'sl-vcard');
            break;
        case 58:
            $out = __('An image or photograph of the individual associated with the vCard.', 'sl-vcard');
            break;
        case 59:
            $out = __('Foto', 'sl-vcard');
            break;
//------------------------
        case 60:
            $out = __('Staff Page Image', 'sl-vcard');
            break;
        case 61:
            $out = __('Single Page Image', 'sl-vcard');
            break;
        case 62:
            $out = __('Base64 Encode', 'sl-vcard');
            break;
        case 63:
            $out = __('Street Address', 'sl-vcard');
            break;
        case 64:
            $out = __('Extended Address (apartment or suite number)', 'sl-vcard');
            break;
        case 65:
            $out = __('City (locality)', 'sl-vcard');
            break;
        case 66:
             $out = __('State (region, province)', 'sl-vcard');
            break;
        case 67:
            $out = __('Zipcode (postal code)', 'sl-vcard');
            break;
        case 68:
            $out = __('Country Name', 'sl-vcard');
            break;
        case 69:
            $out = __('Static Address', 'sl-vcard');
            break;
//------------------------
        case 70:
            $out = __('Comment', 'sl-vcard');
            break;
        case 71:
            $out = __('Information or a comment associated with the vCard.', 'sl-vcard');
            break;
        case 72:
            $out = __('Note', 'sl-vcard');
            break;
        case 73:
            $out = __('Static', 'sl-vcard');
            break;
        case 74:
            $out = __('Other', 'sl-vcard');
            break;
        case 75:
            $out = __('Organization Name - Static', 'sl-vcard');
            break;
        case 76:
            $out = __('Personal', 'sl-vcard');
            break;
        case 77:
            $out = __('Download vCard', 'sl-vcard');
            break;
        case 78:
            $out = __('Static Image', 'sl-vcard');
            break;
        case 79:
            $out = __('Staff List QR Code', 'sl-vcard');
            break;
//------------------------
        case 80:
            $out = __('Low – up to 7% damage', 'sl-vcard');
            break;
        case 81:
            $out = __('Medium – up to 15% damage', 'sl-vcard');
            break;
        case 82:
            $out = __('Quartile – up to 25% damage', 'sl-vcard');
            break;
        case 83:
            $out = __('Hhigh – up to 30% damage', 'sl-vcard');
            break;
        case 84:
            $out = __('Correction Level', 'sl-vcard');
            break;
        case 85:
            $out = __('Margin', 'sl-vcard');
            break;
        case 86:
            $out = __('Label FN', 'sl-vcard');
            break;
        case 87:
            $out = __('Label Static Prefix', 'sl-vcard');
            break;
        case 88:
            $out = __('Size', 'sl-vcard');
            break;
        case 89:
            $out = __('QR Code Image Download', 'sl-vcard');
            break;
//------------------------
        case 90:
            $out = __('QR Code Data', 'sl-vcard');
            break;
        case 91:
            $out = __('QR Code Preview', 'sl-vcard');
            break;
        case 92:
            $out = __('QR Code Properties', 'sl-vcard');
            break;
        case 93:
            $out = __('Block Size Mode', 'sl-vcard');
            break;
        case 95:
            $out = __('Margin', 'sl-vcard');
            break;
        case 96:
            $out = __('Shrink', 'sl-vcard');
            break;
            case 97:
            $out = __('Enlarge', 'sl-vcard');
            break;
        case 98:
            $out = __('Label Font Size', 'sl-vcard');
            break;
        case 99:
            $out = __('Static Image URL', 'sl-vcard');
            break;
//------------------------        
        case 100:
            $out = __('Optional. Company logo or other static image.', 'sl-vcard');
            break;
        case 101:
            $out = __('Image Tag (base64)', 'sl-vcard');
            break;
        case 102:
            $out = __('QR Code Image', 'sl-vcard');
            break;
        case 103:
            $out = __('QR Code PNG file.', 'sl-vcard');
            break;
        case 104:
            $out = __('Text representation of QR Code image.', 'sl-vcard');
            break;  
        case 105:
            $out = __('After changing staff member, click Update to refresh the vCard data.', 'sl-vcard');
            break; 
        case 106:
            $out = __('How it Works - vCard', 'sl-vcard');
            break; 
        case 107:
            $out = __('How it Works - vCard QR Code', 'sl-vcard');
            break;                  
//------------------------ 
        default:
            $out = '';
            break;
    }
    return $out . $suffix;
}

function abcfvc_txta_r( $id, $suffix='' ) {
    $txt = abcfvc_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}