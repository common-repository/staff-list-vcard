<?php
if (!defined('ABSPATH')) { exit; }
/**
* Called from abcfvc_mbox_tplate_preview
* Called from ABCFVC_vCard_Render
*
* All data is added and stored to ABCFVC_vCard_Data variables.
*
* Calls ABCFVC_vCard to render vCard template. 
* Single properties are added in directly in ABCFVC_vCard
* Multiple property items are proccesed here and added to ABCFVC_vCard from local functions.
* 
*/
class ABCFVC_vCard_Builder extends ABCFVC_vCard_Data {

	private $vCard;

	//Whole vCard, formatted. 
	public function  vcardBuilderGetVCardText() {
		//Set values of all properties.
		$this->set_vCard_properties();

		//Calls buildVCard (properties + header + footer). Returns vCard text.
		return $this->vCard->getOutput();
	}

	//Whole vCard, formatted as echo (not used)
	public function  vcard_builder_print_output() {
		$this->get_vCard_all_data_formatted();
		$text = $this->vCard->getOutput();
		echo '<pre>';
		print_r($text);
		echo '</pre>';
	}

	public function  vcardBuilderGetFN() {		
		return $this->nameFN;
	}

	public function vcardBuilderGetErrTxt() {
        return $this->errTxt;
    }

	//=== OUTPUT vCard DATA START ===================================================
	//Set values of all properties for output as vCard. 
    private function set_vCard_properties() {

		$this->vCard = new ABCFVC_vCard();

		$this->vCard->addVersion( $this->cardVersion );
		$this->vCard->addN( $this->lastName, $this->firstName, $this->middleName, $this->honorificPrefix, $this->honorificSuffix ); 
		$this->vCard->addFN( $this->nameFN );
		$this->vCard->addNICKNAME( $this->nickname );

		$this->vCard->addORG( $this->orgName, $this->orgUnit );
		$this->vCard->addTITLE( $this->jobTitle );
		$this->vCard->addROLE( $this->role );
		$this->vCard->addNOTE( $this->note );
		//---------------------------------------------------
		$this->add_emails();
		$this->add_phones();
		$this->add_urls();		
		$this->add_addresses();
		$this->add_social_media();
		$this->add_photo();		
	}
	
	//-- Social media START ----------------------------------------------------
	private function add_social_media() {

		//var_dump($this);

		$urlTxt = $this->urlSM1;
		$urlType = $this->urlSM1Type;
		$grp = 1;
		$this->add_social_media_item( $urlTxt, $urlType, $grp );

		$urlTxt = $this->urlSM2;
		$urlType = $this->urlSM2Type;
		$grp = 2;
		$this->add_social_media_item( $urlTxt, $urlType, $grp );

		$urlTxt = $this->urlSM3;
		$urlType = $this->urlSM3Type;
		$grp = 3;
		$this->add_social_media_item( $urlTxt, $urlType, $grp );

		$urlTxt = $this->urlSM4;
		$urlType = $this->urlSM4Type;
		$grp = 4;
		$this->add_social_media_item( $urlTxt, $urlType, $grp );

		$urlTxt = $this->urlSM5;
		$urlType = $this->urlSM5Type;
		$grp = 5;
		$this->add_social_media_item( $urlTxt, $urlType, $grp );
	}

	private function add_social_media_item( $urlTxt, $type, $grp ) {

		//$urlTxt ='http://myFB.com';
		//$type = 'Facebook';
		//$grp = '1';

		$this->vCard->addURLSM( $urlTxt, $type, $grp );

		// item1.URL:http://myFB.com
		// item2.URL:http://myLisr.com
		// item3.URL:http://myVK.com
		// item1.X-ABLABEL:Facebook
		// item2.X-ABLABEL:Angie's List
		// item3.X-ABLABEL:VK
		
	}	
	//-- Social media end ----------------------------------------------------

   //-- URL START ----------------------------------------------------
	private function add_urls() {

		$urlTxt = $this->url1;
		$urlType = $this->url1Type;
		$prefValue = 1;
		$this->add_url( $urlTxt, $urlType, $prefValue );

		$urlTxt = $this->url2;
		$urlType = $this->url2Type;
		$prefValue = 2;
		$this->add_url( $urlTxt, $urlType, $prefValue );

		$urlTxt = $this->url3;
		$urlType = $this->url3Type;
		$prefValue = 3;
		$this->add_url( $urlTxt, $urlType, $prefValue );

		$urlTxt = $this->url4;
		$urlType = $this->url4Type;
		$prefValue = 4;
		$this->add_url( $urlTxt, $urlType, $prefValue );
	}

	private function add_url( $urlTxt, $urlType, $prefValue ) {

		$outType = ';TYPE=';
		// 		'blog'    => array( 'HOME' ),
		// 		'website' => array( 'WORK' ),

		switch ( $urlType ) {
            case 'personal':     
                $outType = $outType . 'HOME';
				break;				
            case 'work':
				$outType = $outType . 'WORK';
                break;      
			default:
                break;
        }

		if ( $this->urlPref == $prefValue ) {
			$outType = $outType . ',PREF';
		}

		$this->vCard->addURL( $urlTxt, $outType );
	}
	//-- URL END ----------------------------------------------------

	//-- PHONE START ----------------------------------------------------
	private function add_phones() {

		$telNumber = $this->tel1;
		$telType = $this->tel1Type;
		$prefValue = 1;
		$this->add_phone( $telNumber, $telType, $prefValue );

		$telNumber = $this->tel2;
		$telType = $this->tel2Type;
		$prefValue = 2;
		$this->add_phone( $telNumber, $telType, $prefValue );

		$telNumber = $this->tel3;
		$telType = $this->tel3Type;
		$prefValue = 3;
		$this->add_phone( $telNumber, $telType, $prefValue );

		$telNumber = $this->tel4;
		$telType = $this->tel4Type;
		$prefValue = 4;
		$this->add_phone( $telNumber, $telType, $prefValue );
	}

	private function add_phone( $telNumber, $telType, $prefValue ) {

		$cardVersion = $this->cardVersion;
		switch ( $cardVersion ) {
            case '3.0':     
                $this->add_phone_30( $telNumber, $telType, $prefValue );
                break;
            case '4.0':
				$this->add_phone_40( $telNumber, $telType, $prefValue );
				break;			     
			default:
				$this->add_phone_30( $telNumber, $telType, $prefValue );
                break;
		}
	}

	private function add_phone_30( $telNumber, $telType, $prefValue ) {

		//TEL;TYPE=CELL,VOICE,TEXT,PREF:123-5555-2323
		//TEL;TYPE=WORK,VOICE:(111) 555-1212
		//TEL;TYPE=WORK,VOICE,PREF:123-5555-2323

		$outType = ';TYPE=';
		//"cellphone">"homephone">"homefax""workphone">"workfax">

		switch ( $telType ) {
            case 'cellphone':     
                $outType = $outType . 'CELL,VOICE,TEXT';
                break;
            case 'homephone':
				$outType = $outType . 'HOME,VOICE';
				break; 
			case 'workphone':
				$outType = $outType . 'WORK,VOICE';
				break;
			case 'homefax':
				$outType = $outType . 'HOME,FAX';
				break;
			case 'workfax':
				$outType = $outType . 'WORK,FAX';
				break;								     
			default:
				$outType = $outType . 'VOICE';
                break;
		}
		
		if ( $this->telPref == $prefValue ) {
			$outType = $outType . ',PREF';
		}

		$this->vCard->addTEL( $telNumber, $outType );
	}


	private function add_phone_40( $telNumber, $telType, $prefValue ) {

		//TEL;TYPE=work,voice;VALUE=uri:tel:+1-111-555-1212
		//TEL;TYPE=home,voice;VALUE=uri:tel:+1-404-555-1212
		//TEL;VALUE=uri;PREF=1;TYPE="voice,home":tel:+1-555-555-5555;ext=5555
		//TEL;VALUE=uri;TYPE=home:tel:+33-01-23-45-67
		//TEL;TYPE=WORK,VOICE,PREF;VALUE=uri:123-5555-2323

		$outType = ';TYPE=';
		switch ( $telType ) {
            case 'cellphone':     
                $outType = $outType . 'cell,voice,text';
                break;
            case 'homephone':
				$outType = $outType . 'home,voice';
				break; 
			case 'workphone':
				$outType = $outType . 'work,voice';
				break;
			case 'homefax':
				$outType = $outType . 'home,fax';
				break;
			case 'workfax':
				$outType = $outType . 'work,fax';
				break;
			case 'textphone':
				$outType = $outType . 'voice,text';
				break;				
			default:
				$outType = $outType . 'voice';
                break;
		}
		
		if ( $this->telPref == $prefValue ) {
			$outType = $outType . ';PREF=1';
		}

		$this->vCard->addTEL( $telNumber, $outType . ';VALUE=uri' );
	}
	//-- PHONE END ----------------------------------------------------

	//-- EMAIL START ----------------------------------------------------
	private function add_emails() {

		$thisEmail = $this->email1;
		$thisEmailType = $this->email1Type;
		$prefValue = 1;
		$this->add_email( $thisEmail, $thisEmailType, $prefValue );

		$thisEmail = $this->email2;
		$thisEmailType = $this->email2Type;
		$prefValue = 2;
		$this->add_email( $thisEmail, $thisEmailType, $prefValue );

		$thisEmail = $this->email3;
		$thisEmailType = $this->email3Type;
		$prefValue = 3;
		$this->add_email( $thisEmail, $thisEmailType, $prefValue );

		$thisEmail = $this->email4;
		$thisEmailType = $this->email4Type;
		$prefValue = 4;
		$this->add_email( $thisEmail, $thisEmailType, $prefValue );

	}

	private function add_email( $emailAddress, $emailType, $prefValue ) {

		$cardVersion = $this->cardVersion;
		$outType = ';TYPE=';
		//EMAIL;CHARSET=UTF-8;type=HOME,INTERNET:my@xxx.com
		//4.0
		//EMAIL;PREF;INTERNET:jan-ake.akesson@awa.com
		//EMAIL;PREF=1;TYPE=HOME,INTERNET:myemail@mydomain.com
		//EMAIL;TYPE=WORK,INTERNET:myemail@mydomain.com

		switch ( $emailType ) {
            case 'personal':     
                $outType = $outType . 'HOME,INTERNET';
                break;
            case 'work':
				$outType = $outType . 'WORK,INTERNET';
                break;      
			default:
				$outType = '';
                break;
		}

		if ( $this->emailPref == $prefValue ) {

			switch ( $cardVersion ) {
				case '3.0':     
					$outType = $outType . ',PREF';
					break;
				case '4.0':
					$outType = ';PREF=1' . $outType;
					break;			     
				default:
					$outType = $outType . ',PREF';
					break;
			}			
		}

		$this->vCard->addEMAIL( $emailAddress, $outType );
	}
	//-- EMAIL END ----------------------------------------------------

	//-- ADR START ----------------------------------------------------
	public function add_addresses() {

		$this->add_address(  $this->pobox1, $this->addr1stL1, $this->addr1stL2,  $this->addr1stCity, $this->addr1stState, $this->addr1stZip, $this->addr1stCountry, $this->addr1Type, 1 );		
		$this->add_address(  $this->pobox2, $this->addr2stL1, $this->addr2stL2,  $this->addr2stCity, $this->addr2stState, $this->addr2stZip, $this->addr2stCountry, $this->addr2Type, 2 );
		$this->add_address(  $this->pobox3, $this->addr3L1, $this->addr3L2,  $this->addr3City, $this->addr3State, $this->addr3Zip, $this->addr3Country, $this->addr3Type, 3 );
		$this->add_address(  $this->pobox4, $this->addr4L1, $this->addr4L2,  $this->addr4City, $this->addr4State, $this->addr4Zip, $this->addr4Country, $this->addr4Type, 4 );
	}

	public function add_address( $pobox, $addrL1, $addrL2, $addrCity,  $addrState, $addrZip, $addrCountry, $addrType, $prefValue ) {

		$cardVersion = $this->cardVersion;
		$outType = ';TYPE=';

		switch ( $addrType ) {
            case 'home':     
                $outType = $outType . 'HOME';
                break;
            case 'work':
				$outType = $outType . 'WORK';
				break;
			case 'other':
				$outType = $outType . 'OTHER';
				break;				      
			default:
				$outType = '';
                break;
		}

		if ( $this->addrPref == $prefValue ) {

			switch ( $cardVersion ) {
				case '3.0':     
					$outType = $outType . ',PREF';
					break;
				case '4.0':
					$outType = $outType . ';PREF=1';
					break;			     
				default:
					$outType = $outType . ',PREF';
					break;
			}			
		}

		$this->vCard->addADR( $pobox, $addrL1, $addrL2, $addrCity, $addrState, $addrZip, $addrCountry, $outType );
	}
	//-- ADR END ----------------------------------------------------

	//==== IMAGE START ======================================================

	// Add photo to vCard output. URL or 64.
	private function add_photo() {

		$photoURL = $this->photoURL;
		
		//TYPE string. Diferent for card versions (and url or encode64).
		$typeValue = $this->imgTypeURL();

		if( !empty( $this->photoEncoded ) ) {
			
			$photoURL = $this->photoEncoded;
			$typeValue = $this->imgTypeEncoded();
		}

		$this->vCard->addPHOTO( $photoURL, $typeValue );
	}

	private function imgTypeURL() {

		//3.0 PHOTO; TYPE=JPEG;VALUE=URI:
		//4.0 PHOTO; MEDIATYPE=image/jpeg:

		$fileType = $this->photoFileType;
		$mimeType =  $this->photoMimeType;
		//$typeValue = ';TYPE=' . strtoupper( $fileType ) . ';VALUE=URI';
		$typeValue = ';TYPE=' . $fileType . ';VALUE=URI';

		switch ( $this->cardVersion ) {
			case '3.0':           
				break;
			case '4.0':
				$typeValue = ';MEDIATYPE=' . $mimeType;
				break;
			default:
				break;
		}
		return $typeValue;       
	}	

	private function imgTypeEncoded() {

		//3.0: PHOTO;TYPE=JPEG;ENCODING=b:[base64-data]
		//4.0: PHOTO:data:image/jpeg;base64,[base64-data]

		$fileType = $this->photoFileType;
		$mimeType =  $this->photoMimeType;

		//$typeValue = ';TYPE=' . strtoupper( $fileType ) . ';ENCODING=b';
		$typeValue = ';TYPE=' . $fileType . ';ENCODING=b';

		switch ( $this->cardVersion ) {
			case '3.0':           
				break;
			case '4.0':
				//$typeValue = ':data:image/' . $fileType . ' base64,';
				$typeValue = ':data:' . $mimeType . ' base64,';
				break;
			default:				
				break;
		}
		return $typeValue;       
	}	
    //=== IMAGE END ===============================================
	//=== INPUT DATA END ===================================================
}
	
	