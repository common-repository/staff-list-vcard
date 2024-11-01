<?php

function abcfvc_cbo_yn() {
    return array('N'  => abcfvc_txta(6), 'Y' => abcfvc_txta(5) );
}
function abcfvc_cbo_n() {
    return array('N'  => abcfvc_txta(6));
}

function abcfvc_cbo_qr_size() {
    return array('100' => '100 px',
        '150' => '150 px',
        '200' => '200 px',
        '250' => '250 px',
        '300' => '300 px',
        '350' => '350 px',
        '400' => '400 px'                
);
}

function abcfvc_cbo_qr_margin() {
    return array('' => '0',
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px'
);
}

function abcfvc_cbo_qr_lbl_font_px() {
    return array('8' => '8',
        '10' => '10 px',
        '12' => '12 px',
        '14' => '14 px',
        '16' => '16 px'
);
}

function abcfvc_cbo_qr_block_size_mode() {
    return array('MARGIN' => abcfvc_txta(95),
        'SHRINK' => abcfvc_txta(96),
        'ENLARGE' => abcfvc_txta(97)
    );
}

function abcfvc_cbo_qr_correction_level() {
    return array('LOW' => abcfvc_txta(80),
        'MEDIUM' => abcfvc_txta(81),
        'QUARTILE' => abcfvc_txta(82),
        'HIGH' => abcfvc_txta(83)
    );
}

function abcfvc_cbo_photo_source() {
    return array('' => '- - -',
        '_imgUrlL' => abcfvc_txta(60),
        '_imgUrlS' => abcfvc_txta(61),
        '_staticImgUrl' => abcfvc_txta(78)        
    );
}

function abcfvc_cbo_property() {
    return array('' => '- - -',
    'N' => 'N - Multipart name (required)*',
    'FN' => 'FN - Formatted name (required)*',
        'ADR' => 'ADR - Address',
        'ANNIVERSARY' => 'ANNIVERSARY',
        'BDAY' => 'BDAY - Birth Date',
        'EMAIL' => 'EMAIL',        
        'GENDER' => 'GENDER',
        'LOGO' => 'LOGO',        
        'NICKNAME' => 'NICKNAME - Nickname',
        'NOTE' => 'NOTE',
        'PHOTO' => 'PHOTO - Image',
        'ROLE' => 'ROLE',
        'TEL' => 'TEL - Telephone Number',
        'TITLE' => 'TITLE - Position or Job'
    );
}
//----------------------------------------------
function abcfvc_cbo_type_PW() {
    return array('' => '- - -',
        'personal' => abcfvc_txta(76),
        'work' => abcfvc_txta(48)
    );
}

function abcfvc_cbo_type_HWO() {
    return array('' => '- - -',
        'home' => abcfvc_txta(47),
        'work' => abcfvc_txta(48),
        'other' => abcfvc_txta(74)
    );
}
//---------------------------------------------

function abcfvc_cbo_tel_type_30() {
    return array('' => '- - -',
        'cellphone' => 'Cell Phone',
        'homephone' => 'Home Phone',
        'homefax' => 'Home Fax',
        'workphone' => 'Work Phone',
        'workfax' => 'Work Fax',
);
}

function abcfvc_cbo_tel_type_40() {

    $addItem['textphone'] = 'Text Phone'; 
    $out = array_merge( abcfvc_cbo_tel_type_30(), $addItem );
    return $out;
}

function abcfvc_cbo_preferred_2() {
    return array('' => '- - -',
        '1' => '1',
        '2' => '2'
);
}

function abcfvc_cbo_preferred_website() {
    return array('' => '- - -',
        '1' => 'URL 1',
        '2' => 'URL 2',
        '3' => 'URL 3',
        '4' => 'URL 4'
);
}

function abcfvc_cbo_preferred_4() {
    return array('' => '- - -',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4'
);
}

function abcfvc_cbo_vcard_version() {
    return array('3.0' => '3.0',
        '4.0' => '4.0'        
    );
}

function abcfvc_cbo_kind() {
    return array('' => '',
        'Group' => 'Group',
        'Individual' => 'Individual',
        'Location' => 'Location',
        'Organization' => 'Organization'
    );
}




