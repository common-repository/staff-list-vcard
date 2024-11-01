<?php

function abcfvc_mbox_tplate_map_ORG( $tplateOptns, $slTplateFields ){

    //'organization-name' => $this->prepare( $this->getOrganization( 'display' ) ),
	//'organization-unit' => $this->prepare( $this->getDepartment( 'display' ) ),

    $ORG_Name_st = isset( $tplateOptns['_ORG_Name_st'] ) ? $tplateOptns['_ORG_Name_st'][0] : '';
    $ORG_Name = isset( $tplateOptns['_ORG_Name'] ) ? $tplateOptns['_ORG_Name'][0] : '';
    $ORG_Unit = isset( $tplateOptns['_ORG_Unit'] ) ? $tplateOptns['_ORG_Unit'][0] : '';

    echo  abcfl_html_tag('div','CN4','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'ORG - ' . abcfvc_txta(35), 5 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(37) );

        echo abcfl_input_txt('ORG_Name_st', '', $ORG_Name_st, abcfvc_txta(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('ORG_Name', '', $slTplateFields, $ORG_Name, abcfvc_txta(35), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo('ORG_Unit', '', $slTplateFields, $ORG_Unit, abcfvc_txta(36), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}

function abcfvc_mbox_tplate_map_TITLE( $tplateOptns, $slTplateFields ){

	// Set the job title.
    //$this->vCard->set( 'TITLE', $this->prepare( $this->getTitle() ) )->addParam( 'CHARSET', 'UTF-8' );

    $TITLE_1 = isset( $tplateOptns['_TITLE_1'] ) ? $tplateOptns['_TITLE_1'][0] : '';

    echo  abcfl_html_tag('div','CN5','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'TITLE - ' . abcfvc_txta(38), 6 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(39) );

        echo abcfl_input_cbo('TITLE_1', '', $slTplateFields, $TITLE_1, abcfvc_txta(38), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}

function abcfvc_mbox_tplate_map_ROLE( $tplateOptns, $slTplateFields ){

    //The role, occupation, or business category of the vCard object within an organization.

    $ROLE = isset( $tplateOptns['_ROLE'] ) ? $tplateOptns['_ROLE'][0] : '';

    echo  abcfl_html_tag('div','CN6','inside hidden abcflFadeIn');

        echo abcfvc_mbox_tplate_map_vcard_property_name_hdr( 'ROLE - ' . abcfvc_txta(54), 7 );
        echo abcfvc_mbox_tplate_map_vcard_property_name_desc( abcfvc_txta(55) );

        echo abcfl_input_cbo('ROLE', '', $slTplateFields, $ROLE, abcfvc_txta(54), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}