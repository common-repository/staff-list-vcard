<?php
function abcfvc_mbox_tplate_map_PHOTO( $vcTplateOptns, $mapType ){

    //3.0
    //PHOTO;VALUE=URI;TYPE=GIF:http://www.example.com/dir_photos/my_photo.gif
    //PHOTO;TYPE=JPEG;VALUE=URL:http://localhost:8080/blog/wp-content/plugins/abcfolio-staff-list-pro/images/staff-member-1.jpg
    //4.0
    //PHOTO;MEDIATYPE=image/gif:http://www.example.com/dir_photos/my_photo.gif

    $photoEncode64 = isset( $vcTplateOptns['_photoEncode64'] ) ? $vcTplateOptns['_photoEncode64'][0] : 'N';
    $PHOTO = isset( $vcTplateOptns['_PHOTO'] ) ? $vcTplateOptns['_PHOTO'][0] : '';
    $photoUrlSt = isset( $vcTplateOptns['_PHOTO_url_st'] ) ? esc_attr( $vcTplateOptns['_PHOTO_url_st'][0] ) : '';
     
    $cboImgSource = abcfvc_cbo_photo_source();
    $cboYN = abcfvc_cbo_yn();
    // QRCode error when photoEncode64  selected
    if( $mapType == 'QR' ) { $cboYN = abcfvc_cbo_n(); }

    echo  abcfl_html_tag('div','CN11','inside hidden abcflFadeIn');
        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'PHOTO - ' . abcfvc_txta(59), 8 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(58) );

        echo abcfl_input_cbo('photoEncode64', '', $cboYN, $photoEncode64, abcfvc_txta(62), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('PHOTO', '', $cboImgSource, $PHOTO, abcfvc_txta(27), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

        echo abcfl_input_txt('PHOTO_url_st', '', $photoUrlSt, abcfvc_txta(99), abcfvc_txta(100), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_html_tag_end('div'); 
}