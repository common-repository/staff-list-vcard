<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Called fromABCFVC_vCard_Builder
 * Called from abcfvc_mbox_tplate_preview
 *
* Process vCard template. 
* Get data from staff member 
* Get data from static entries in vCard template.
* Set all variables based on data and staff member options. 
* Contains all data needed to build vCard.
*/
class ABCFVC_vCard_Data {

	private $slTplateOptns;
	private $staffOptns;
	private $vcTplateOptns;	

	public $vcTplateID;
	public $slTplateID;
	public $staffID;
	public $cardVersion = '3.0';	

	public $firstName = '';
	public $middleName = '';
	public $lastName = '';
	public $honorificPrefix = '';
	public $honorificSuffix = '';
	public $nameFN = '';
	public $nickname = '';
	
	public $jobTitle = '';
	public $orgName = '';
	public $orgUnit = '';
	public $role = '';
	public $note = '';

	public $telPref = '';
	public $tel1 = '';
	public $tel1Type = '';
	public $tel2 = '';
	public $tel2Type = '';
	public $tel3 = '';
	public $tel3Type = '';
	public $tel4 = '';
	public $tel4Type = '';

	public $emailPref = '';
	public $email1 = '';
	public $email1Type = '';
	public $email2 = '';
	public $email2Type = '';
	public $email3 = '';
	public $email3Type = '';
	public $email4 = '';
	public $email4Type = '';

	public $urlPref = '';
	public $url1 = '';
	public $url1Type = '';
	public $url2 = '';
	public $url2Type = '';
	public $url3 = '';
	public $url3Type = '';
	public $url4 = '';
	public $url4Type = '';

	//public $urlSMPref = '';
	public $urlSM1 = '';
	public $urlSM1Type = '';
	public $urlSM2 = '';
	public $urlSM2Type = '';
	public $urlSM3 = '';
	public $urlSM3Type = '';
	public $urlSM4 = '';
	public $urlSM4Type = '';
	public $urlSM5 = '';
	public $urlSM5Type = '';

	public $addrPref = '';
	public $addr1Type = '';
	public $addr1stL1 = '';
	public $addr1stL2 = '';
	public $addr1stCity = '';
	public $addr1stState = '';
	public $addr1stZip = '';
	public $addr1stCountry = '';
	public $pobox1 = '';	

	public $addr2Type = '';
	public $addr2stL1 = '';
	public $addr2stL2 = '';
	public $addr2stCity = '';
	public $addr2stState = '';
	public $addr2stZip = '';
	public $addr2stCountry = '';
	public $pobox2 = '';

	public $addr3Type = '';
	public $addr3L1 = '';
	public $addr3L2 = '';
	public $addr3City = '';
	public $addr3State = '';
	public $addr3Zip = '';
	public $addr3Country = '';
	public $pobox3 = '';
	
	public $addr4Type = '';
	public $addr4L1 = '';
	public $addr4L2 = '';
	public $addr4City = '';
	public $addr4State = '';
	public $addr4Zip = '';
	public $addr4Country = '';
	public $pobox4 = '';		

	public $photoURL = '';
	public $photoEncoded = '';
	public $photoEncode64 = '';
	public $photoFileType = '';
	public $photoMimeType = '';

	public $errTxt = '';

	public function __construct( $staffID, $vcTplateID, $slTplateID ) {

		if( empty( $staffID ) ) { 
			$this->errTxt = 'Staff member not selected.';
            return;
		 }
		if( empty( $vcTplateID ) ) { 
			$this->errTxt = 'ABCFVC_vCard_Data Empty vcTplateID.';
            return;
		 }
		if( empty( $slTplateID ) ) { 
			$this->errTxt = 'ABCFVC_vCard_Data Empty slTplateID.';
            return;
		 }

		$this->vcTplateOptns = get_post_custom( $vcTplateID );
		$this->slTplateOptns = get_post_custom( $slTplateID );
		$this->staffOptns = get_post_custom( $staffID );
		$this->vcTplateID = $vcTplateID;
		$this->slTplateID = $slTplateID;
		$this->staffID = $staffID;

		$this->cardVersion = isset( $this->vcTplateOptns['_vCardVer'] ) ? $this->vcTplateOptns['_vCardVer'][0] : '3.0';

		$this->set_parts_N();
		$this->set_parts_FN();
		$this->set_TITLE();
		$this->set_NICKNAME();
		$this->set_ORG();
		$this->set_TEL();
		$this->set_EMAIL();
		$this->set_ROLE();
		$this->set_URL();
		$this->set_URLSM();
		$this->set_ADR();
		$this->set_NOTE();	
		$this->set_PHOTO();
	}

	//--------------------------------------------------
	private function getStaffMetaKey_NEW( $vcMetaKey ) {

		//var_dump($vcMetaKey);

		$vcTplateOptns = $this->vcTplateOptns;
		$metaKey = isset( $vcTplateOptns[$vcMetaKey] ) ? $vcTplateOptns[$vcMetaKey][0] : '';
		return $metaKey;
	}

	private function getStaffMetaKeyValue_NEW( $staffMetaKey ) {

		//var_dump($staffMetaKey);

		if ( empty( $staffMetaKey ) ) { return ''; }

		//var_dump($staffMetaKey);
		//'_statTxt_F9'
		//----------------------------------
		$metaKeyValue = '';
		$staffID = $this->staffID;

		if ( $staffMetaKey == 'POSTTITLE' ){
			$metaKeyValue = get_the_title( $staffID );
			return wp_strip_all_tags( $metaKeyValue );
		}

		if ( strpos( $staffMetaKey, '_statTxt_') !== false) {

			$slTplateOptns = $this->slTplateOptns;

			$metaKeyValue = isset( $slTplateOptns[$staffMetaKey] ) ? $slTplateOptns[$staffMetaKey][0] : '';
			return wp_strip_all_tags( $metaKeyValue );
		}

		$staffOptns = $this->staffOptns;

		$metaKeyValue = isset( $staffOptns[$staffMetaKey] ) ? $staffOptns[$staffMetaKey][0] : '';

//var_dump($metaKeyValue);

		return wp_strip_all_tags( $metaKeyValue );
		
	}
	//===================================================================
	private function getStaffMetaKey( $vcTplateOptns, $vcMetaKey ) {

		$metaKey = isset( $vcTplateOptns[$vcMetaKey] ) ? $vcTplateOptns[$vcMetaKey][0] : '';
		return $metaKey;
	}

	private function getStaffMetaKeyValue( $staffOptns, $staffMetaKey, $staffID ) {

		if ( empty( $staffMetaKey ) ) { return ''; }

		//var_dump($staffMetaKey);
		//'_statTxt_F9'
		//----------------------------------
		$metaKeyValue = '';

		if ( $staffMetaKey == 'POSTTITLE' ){
			$metaKeyValue = get_the_title( $staffID );
			return wp_strip_all_tags( $metaKeyValue );
		}

		if ( strpos( $staffMetaKey, '_statTxt_') !== false) {

			$slTplateOptns = $this->slTplateOptns;

			$metaKeyValue = isset( $slTplateOptns[$staffMetaKey] ) ? $slTplateOptns[$staffMetaKey][0] : '';
			return wp_strip_all_tags( $metaKeyValue );
		}

		$metaKeyValue = isset( $staffOptns[$staffMetaKey] ) ? $staffOptns[$staffMetaKey][0] : '';
		return wp_strip_all_tags( $metaKeyValue );
		//=============================================
		// $metaKeyValue = '';
		// if ( $staffMetaKey == 'POSTTITLE' ){
		// 	$metaKeyValue = get_the_title( $staffID );
		// }
		// else{
		// 	$metaKeyValue = isset( $staffOptns[$staffMetaKey] ) ? $staffOptns[$staffMetaKey][0] : '';
		// }

		// return wp_strip_all_tags( $metaKeyValue );
	}
	//===============================================================================================================================

	//-- N START ----------------------------------------------------
	private function set_parts_N() {
		
		$this->set_part_N( '_N_1', 'firstName' );
		$this->set_part_N( '_N_2', 'middleName' );
		$this->set_part_N( '_N_3', 'lastName' );
		$this->set_part_N( '_N_4', 'honorificPrefix' );
		$this->set_part_N( '_N_5', 'honorificSuffix' );
	}

	private function set_part_N( $vcMetaKey, $varToSet ) {

		$staffMetaKey = $this->getStaffMetaKey_NEW( $vcMetaKey );
		$varValue =  $this->getStaffMetaKeyValue_NEW( $staffMetaKey );

		//var_dump($staffMetaKey);
		
		switch ( $varToSet ) {
			case 'firstName':
				$this->firstName = $varValue;
				break;
			case 'middleName':
				$this->middleName = $varValue;
				break;
			case 'lastName':
				$this->lastName = $varValue;
				break;
			case 'honorificPrefix':
				$this->honorificPrefix = $varValue;
				break;
			case 'honorificSuffix':
				$this->honorificSuffix = $varValue;
				break;
			default:
				break;
		}
	}
	//-- N END ----------------------------------
	//-- FN START -------------------------------
	private function set_parts_FN( ) {

		$part1 = $this->get_part_name_FN( '_FN_1' );
		$part2 = $this->get_part_name_FN( '_FN_2' );
		$part3 = $this->get_part_name_FN( '_FN_3' );
		$part4 = $this->get_part_name_FN( '_FN_4' );
		$part5 = $this->get_part_name_FN( '_FN_5' );

		$this->nameFN = trim( $part1 . $part2 . $part3 . $part4 . $part5);	
		
	}

	private function get_part_name_FN( $vcMetaKey ) {

		$staffMetaKey = $this->getStaffMetaKey_NEW( $vcMetaKey );
		if ( empty( $staffMetaKey ) ) { return ''; }

		$part = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
		if ( !empty( $part ) ) { $part = $part . ' '; }

		return $part;		
	}
	//-- FN END --------------------------

	//-- NOTE -----------------------------------
	private function set_NOTE() {

		$staffMetaKey = $this->getStaffMetaKey_NEW( '_NOTE' );
		$this->note = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
	}

	//-- ROLE -----------------------------------
	private function set_ROLE() {

		$staffMetaKey = $this->getStaffMetaKey_NEW( '_ROLE' );
		$this->role = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
	}

	//-- NICKNAME -----------------------------------
	private function set_NICKNAME() {

		$staffMetaKey = $this->getStaffMetaKey_NEW( '_NICKNAME' );
		$this->nickname = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
	}

	//-- TITLE -----------------------------------
	private function set_TITLE() {

		$staffMetaKey = $this->getStaffMetaKey_NEW( '_TITLE_1' );
		$this->jobTitle = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
	}

	//-- ORG -----------------------------------
	private function set_ORG() {

		$vcTplateOptns = $this->vcTplateOptns;
		$orgNameSt = isset( $vcTplateOptns['_ORG_Name_st'] ) ? esc_attr( $vcTplateOptns['_ORG_Name_st'][0] ) : '';

		if ( empty( $orgNameSt ) ) {
			$staffMetaKey = $this->getStaffMetaKey_NEW( '_ORG_Name' );
			$this->orgName = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
		}
		else{
			$this->orgName = $orgNameSt;
		}

		$staffMetaKey = $this->getStaffMetaKey_NEW( '_ORG_Unit' );
		$this->orgUnit = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
	}
	//--------------------------------------------------

	//-- TEL START -----------------------------------
	private function set_TEL() {

		$vcTplateOptns = $this->vcTplateOptns;
		$this->telPref = isset( $vcTplateOptns['_TEL_pref'] ) ? $vcTplateOptns['_TEL_pref'][0] : '';
		
		$this->set_part_TEL( '_TEL_1', 'tel1', $vcTplateOptns );
		$this->set_part_TEL( '_TEL_2', 'tel2', $vcTplateOptns );
		$this->set_part_TEL( '_TEL_3', 'tel3', $vcTplateOptns );
		$this->set_part_TEL( '_TEL_4', 'tel4', $vcTplateOptns );
	}

	private function set_part_TEL( $vcMetaKey, $varToSet, $vcTplateOptns ) {

		$metaKey_tel = $this->getStaffMetaKey_NEW( $vcMetaKey );
		$valueTel =  $this->getStaffMetaKeyValue_NEW( $metaKey_tel );

		//$metaKey = $vcMetaKey . '_type';
		$valueTelType = isset( $vcTplateOptns[$vcMetaKey . '_type'] ) ? $vcTplateOptns[$vcMetaKey . '_type'][0] : '';
		
		switch ( $varToSet ) {
			case 'tel1':
				$this->tel1 = $valueTel;
				$this->tel1Type = $valueTelType;
				break;
			case 'tel2':
				$this->tel2 = $valueTel;
				$this->tel2Type = $valueTelType;
				break;
			case 'tel3':
				$this->tel3 = $valueTel;
				$this->tel3Type = $valueTelType;
				break;
			case 'tel4':
				$this->tel4 = $valueTel;
				$this->tel4Type = $valueTelType;
				break;
			default:
				break;
		}
	}
	//-- TEL END -----------------------------------

	//-- EMAIL START -----------------------------------
	private function set_EMAIL() {

		$vcTplateOptns = $this->vcTplateOptns;
		$this->emailPref = isset( $vcTplateOptns['_EMAIL_pref'] ) ? $vcTplateOptns['_EMAIL_pref'][0] : '';
		
		$this->set_part_EMAIL( '_EMAIL_1', 'email1', $vcTplateOptns );
		$this->set_part_EMAIL( '_EMAIL_2', 'email2', $vcTplateOptns );
		$this->set_part_EMAIL( '_EMAIL_3', 'email3', $vcTplateOptns );
		$this->set_part_EMAIL( '_EMAIL_4', 'email4', $vcTplateOptns );
	}

	private function set_part_EMAIL( $vcMetaKey, $varToSet, $vcTplateOptns ) {

		$metaKey_email = $this->getStaffMetaKey_NEW( $vcMetaKey );
		$valueEmail =  $this->getStaffMetaKeyValue_NEW( $metaKey_email );

		//$metaKey = $vcMetaKey . '_type';
		$valueEmailType = isset( $vcTplateOptns[$vcMetaKey . '_type'] ) ? $vcTplateOptns[$vcMetaKey . '_type'][0] : '';
	
		switch ( $varToSet ) {
			case 'email1':
				$this->email1 = $valueEmail;
				$this->email1Type = $valueEmailType;
				break;
			case 'email2':
				$this->email2 = $valueEmail;
				$this->email2Type = $valueEmailType;
				break;
			case 'email3':
				$this->email3 = $valueEmail;
				$this->email3Type = $valueEmailType;
				break;
			case 'email4':
				$this->email4 = $valueEmail;
				$this->email4Type = $valueEmailType;
				break;
			default:
				break;
		}
	}
	//-- EMAIL END -----------------------------------

	//-- URL START -----------------------------------
	private function set_URL() {

		$vcTplateOptns = $this->vcTplateOptns;
		$this->urlPref = isset( $vcTplateOptns['_URL_pref'] ) ? $vcTplateOptns['_URL_pref'][0] : '';
		$this->url1 = isset( $vcTplateOptns['_URL_1'] ) ? esc_attr( $vcTplateOptns['_URL_1'][0] ) : '';
		$this->url1Type = isset( $vcTplateOptns['_URL_1_type'] ) ? $vcTplateOptns['_URL_1_type'][0] : '';
		
		//----------------------------------
		$this->set_part_URL( '_URL_2', 'url2', $vcTplateOptns );
		$this->set_part_URL( '_URL_3', 'url3', $vcTplateOptns );
		$this->set_part_URL( '_URL_4', 'url4', $vcTplateOptns );
	}
	
	private function set_part_URL( $vcMetaKey, $varToSet, $vcTplateOptns ) {
	
		$metaKey_url = $this->getStaffMetaKey_NEW( $vcMetaKey );
		$urlTxt =  $this->getStaffMetaKeyValue_NEW( $metaKey_url );
	
		//$metaKey = $vcMetaKey . '_type';
		$valueURLType = isset( $vcTplateOptns[$vcMetaKey . '_type'] ) ? $vcTplateOptns[$vcMetaKey . '_type'][0] : '';
		
		switch ( $varToSet ) {
			case 'url2':
				$this->url2 = $urlTxt;
				$this->url2Type = $valueURLType;
				break;
			case 'url3':
				$this->url3 = $urlTxt;
				$this->url3Type = $valueURLType;
				break;
			case 'url4':
				$this->url4 = $urlTxt;
				$this->url4Type = $valueURLType;
				break;
			default:
				break;
		}
	}
	//-- URL END -----------------------------------

	//-- URLSM START -----------------------------------
	private function set_URLSM() {

		//$this->urlPref = isset( $vcTplateOptns['_URLSM_pref'] ) ? $vcTplateOptns['_URL_pref'][0] : '';
		
		$this->set_part_URLSM( '_URLSM_1', 'urlSM1' );
		$this->set_part_URLSM( '_URLSM_2', 'urlSM2' );
		$this->set_part_URLSM( '_URLSM_3', 'urlSM3' );
		$this->set_part_URLSM( '_URLSM_4', 'urlSM4' );
		$this->set_part_URLSM( '_URLSM_5', 'urlSM5' );
	}
	
	private function set_part_URLSM( $vcMetaKey, $varToSet ) {	
		
		$metaKey_url = $this->getStaffMetaKey_NEW( $vcMetaKey );
		if( $metaKey_url == '_emailUrl' ) { return; }

		$staffOptns = $this->staffOptns;
		$urlTxt =  $this->getStaffMetaKeyValue_NEW( $metaKey_url );

		$vcTplateOptns = $this->vcTplateOptns;
		$valueURLType = isset( $vcTplateOptns[$vcMetaKey . '_type'] ) ? $vcTplateOptns[$vcMetaKey . '_type'][0] : '';
	
		//echo"<pre>", print_r( $metaKey_url, true ), "</pre>";
		//echo"<pre>", print_r( $staffOptns, true ), "</pre>";
		//echo"<pre>", print_r( $urlTxt, true ), "</pre>";
		//echo"<pre>", print_r( $valueURLType, true ), "</pre>";
		
		switch ( $varToSet ) {
			case 'urlSM1':
				$this->urlSM1 = $urlTxt;
				$this->urlSM1Type = $valueURLType;
				break;
			case 'urlSM2':
				$this->urlSM2 = $urlTxt;
				$this->urlSM2Type = $valueURLType;
				break;
			case 'urlSM3':
				$this->urlSM3 = $urlTxt;
				$this->urlSM3Type = $valueURLType;
				break;
			case 'urlSM4':
				$this->urlSM4 = $urlTxt;
				$this->urlSM4Type = $valueURLType;
				break;
			case 'urlSM5':
				$this->urlSM5 = $urlTxt;
				$this->urlSM5Type = $valueURLType;
				break;				
			default:
				break;
		}
	}
	//-- URLSM END -----------------------------------

	//-- ADR START -----------------------------------
	private function set_ADR() {
		
		$vcTplateOptns = $this->vcTplateOptns;
		$this->addrPref = isset( $vcTplateOptns['_ADR_pref'] ) ? $vcTplateOptns['_ADR_pref'][0] : '';
		$this->addr1Type = isset( $vcTplateOptns['_ADR1_type'] ) ? $vcTplateOptns['_ADR1_type'][0] : '';
		$this->addr2Type = isset( $vcTplateOptns['_ADR2_type'] ) ? $vcTplateOptns['_ADR2_type'][0] : '';
		$this->addr3Type = isset( $vcTplateOptns['_ADR3_type'] ) ? $vcTplateOptns['_ADR3_type'][0] : '';
		$this->addr4Type = isset( $vcTplateOptns['_ADR4_type'] ) ? $vcTplateOptns['_ADR4_type'][0] : '';
		//---------------------------------------------
		$this->set_addr_static_1( $vcTplateOptns );
		$this->set_addr_static_2( $vcTplateOptns );
		$this->set_addr_dynamic();
	}

	private function set_addr_dynamic() {

		$this->set_part_ADR( '_ADR3_1', 'addr3L1' );
		$this->set_part_ADR( '_ADR3_2', 'addr3L2' );
		$this->set_part_ADR( '_ADR3_3', 'addr3City' );
		$this->set_part_ADR( '_ADR3_4', 'addr3State' );
		$this->set_part_ADR( '_ADR3_5', 'addr3Zip' );
		$this->set_part_ADR( '_ADR3_6', 'addr3Country' );

		$this->set_part_ADR( '_ADR4_1', 'addr4L1' );
		$this->set_part_ADR( '_ADR4_2', 'addr4L2' );
		$this->set_part_ADR( '_ADR4_3', 'addr4City' );
		$this->set_part_ADR( '_ADR4_4', 'addr4State' );
		$this->set_part_ADR( '_ADR4_5', 'addr4Zip' );
		$this->set_part_ADR( '_ADR4_6', 'addr4Country' );
	}

	private function set_part_ADR( $vcMetaKey, $varToSet ) {

		$metaKey_adr = $this->getStaffMetaKey_NEW( $vcMetaKey );
		$valueAdr =  $this->getStaffMetaKeyValue_NEW( $metaKey_adr);
		
		switch ( $varToSet ) {
			case 'addr3L1':
				$this->addr3L1 = $valueAdr;
				break;
			case 'addr3L2':
				$this->addr3L2 = $valueAdr;
				break;
			case 'addr3City':
				$this->addr3City = $valueAdr;
				break;
			case 'addr3State':
				$this->addr3State = $valueAdr;
				break;
			case 'addr3Zip':
				$this->addr3Zip = $valueAdr;
				break;
			case 'addr3Country':
				$this->addr3Country = $valueAdr;
				break;
			case 'addr4L1':
				$this->addr4L1 = $valueAdr;
				break;
			case 'addr4L2':
				$this->addr4L2 = $valueAdr;
				break;
			case 'addr4City':
				$this->addr4City = $valueAdr;
				break;
			case 'addr4State':
				$this->addr4State = $valueAdr;
				break;
			case 'addr4Zip':
				$this->addr4Zip = $valueAdr;
				break;
			case 'addr4Country':
				$this->addr4Country = $valueAdr;
				break;
			default:
				break;
		}
	}

	private function set_addr_static_1( $vcTplateOptns ) {
		$this->addr1stL1 = isset( $vcTplateOptns['_ADR1_st_1'] ) ? $vcTplateOptns['_ADR1_st_1'][0] : '';
		$this->addr1stL2 = isset( $vcTplateOptns['_ADR1_st_2'] ) ? $vcTplateOptns['_ADR1_st_2'][0] : '';
		$this->addr1stCity = isset( $vcTplateOptns['_ADR1_st_3'] ) ? $vcTplateOptns['_ADR1_st_3'][0] : '';
		$this->addr1stState = isset( $vcTplateOptns['_ADR1_st_4'] ) ? $vcTplateOptns['_ADR1_st_4'][0] : '';
		$this->addr1stZip = isset( $vcTplateOptns['_ADR1_st_5'] ) ? $vcTplateOptns['_ADR1_st_5'][0] : '';
		$this->addr1stCountry = isset( $vcTplateOptns['_ADR1_st_6'] ) ? $vcTplateOptns['_ADR1_st_6'][0] : '';
	}

	private function set_addr_static_2( $vcTplateOptns ) {
		$this->addr2stL1 = isset( $vcTplateOptns['_ADR2_st_1'] ) ? $vcTplateOptns['_ADR2_st_1'][0] : '';
		$this->addr2stL2 = isset( $vcTplateOptns['_ADR2_st_2'] ) ? $vcTplateOptns['_ADR2_st_2'][0] : '';
		$this->addr2stCity = isset( $vcTplateOptns['_ADR2_st_3'] ) ? $vcTplateOptns['_ADR2_st_3'][0] : '';
		$this->addr2stState = isset( $vcTplateOptns['_ADR2_st_4'] ) ? $vcTplateOptns['_ADR2_st_4'][0] : '';
		$this->addr2stZip = isset( $vcTplateOptns['_ADR2_st_5'] ) ? $vcTplateOptns['_ADR2_st_5'][0] : '';
		$this->addr2stCountry = isset( $vcTplateOptns['_ADR2_st_6'] ) ? $vcTplateOptns['_ADR2_st_6'][0] : '';
	}
	//-- ADR END -----------------------------------

	//-- PHOTO START --------------------------------
	private function set_PHOTO() {

		//--Get photo URL ----------------------------------------------
		$staffMetaKey = $this->getStaffMetaKey_NEW( '_PHOTO' );
		
		// $staffMetaKey = cbo value _staticImgUrl _imgUrlL
		// error_log( print_r( $staffMetaKey, true) );

		if( $staffMetaKey == '_staticImgUrl' ){
			$this->photoURL = isset( $this->vcTplateOptns['_PHOTO_url_st'] ) ? esc_attr( $this->vcTplateOptns['_PHOTO_url_st'][0] ) : '';
		}
		else{
			//error_log( print_r( 'getStaffMetaKeyValue_NEW', true) );
			//error_log( print_r( $this->photoURL, true) );
			$this->photoURL = $this->getStaffMetaKeyValue_NEW( $staffMetaKey );
		}

		if( empty( $this->photoURL ) ){ return; }

		// Not reliable way to check if file exist or mime type. Doesn't have to. Not used for 64 encoding. Outputs URL only. $url = $this->photoURL;
		$this->set_file_type_by_file_extension();
		$this->set_mime_type_by_file_type();
		//------------------------------------------------
		$vcTplateOptns = $this->vcTplateOptns;
		$photoEncode64 = isset( $vcTplateOptns['_photoEncode64'] ) ? $vcTplateOptns['_photoEncode64'][0] : 'N';
		$this->photoEncode64 = $photoEncode64;

		if( $this->photoEncode64 == 'N') { return; }
		if( empty( $this->photoFileType ) ){ return; }
		if( $this->photoFileType == 'not_image'  ) { return; }

		//Encode image. Check if file exists. File has to be an image.
		$this->imageEncode64();
	}

	///-------------------------------------------------------------------------
	//Check if the variable $url is a valid URL
    private function isValidURL( $url ) {
        return filter_var( $url, FILTER_VALIDATE_URL ) !== false;
	}
	
	//Add photo encode. Check if file exists. File has to be an image.
	private function imageEncode64(){

		$url = $this->photoURL;
		if( empty( $url ) ){ return; }

		//----------------------------------------
		$response = wp_safe_remote_get( $url );
		if ( is_wp_error( $response ) ) {
			return;
		}
		//var_dump reqires connection to WP.
		//------------------------------------
		$responseCode = wp_remote_retrieve_response_code( $response );
		//File not found
		if ( $responseCode == 404 ) {
			$this->photoFileType == 'not_image'; 
			return ; 
		}

		//------------------------------------
		//File not found. Mime = 'text/html; charset=UTF-8' response response['body'] = Page not found
		$mimeType = wp_remote_retrieve_header( $response, 'content-type' );

		if ( empty( $mimeType ) ) {
			$this->photoFileType == 'not_image'; 
			return ; 
		}

		$isImage = $this->is_image_by_mime_type( $mimeType );
		if ( !$isImage ) { 
			$this->photoFileType == 'not_image';
			return ; 
		}

		//-----------------------------------------------------
		$fileContents = wp_remote_retrieve_body( $response );
		if ( empty( $fileContents ) ) { return ; }		

		$fileContents64 = base64_encode( $fileContents );		
		$this->photoEncoded = $fileContents64;
		
		//echo"<pre>", print_r( 'mimeType', true ), "</pre>";
		//echo"<pre>", print_r( $fileContents64, true ), "</pre>";

		//echo"<pre>", print_r( 'mimeType', true ), "</pre>";
		//echo"<pre>", print_r(  $mimeType, true ), "</pre>";
		//$fileContents = $response['body'];
		// $header = $response['headers'];

		// [headers] => Requests_Utility_CaseInsensitiveDictionary Object
        // (
        //     [data:protected] => Array
        //         (
        //             [date] => Sat, 23 Jan 2021 15:48:22 GMT
        //             [server] => Apache/2.4.41 (Win64) OpenSSL/1.1.1c PHP/7.4.4
        //             [last-modified] => Fri, 14 Aug 2015 15:20:11 GMT
        //             [etag] => "4126-51d46fce461ca"
        //             [accept-ranges] => bytes
        //             [content-length] => 16678
        //             [content-type] => image/jpeg
        //         )
		// )
		
		// $response['response'];
		// [response] => Array
        // (
        //     [code] => 404
        //     [message] => Not Found
        // )

	}

	private function set_file_type_by_file_extension () {

		$url = $this->photoURL;
		if( empty( $url ) ){ return; }

		if( !$this->isValidURL( $url ) ) {
			$this->photoMimeType = 'invalid_URL';
			return;
		}

		$image_info = explode( '.', $url ); 
		$extension = end( $image_info );
		$fileType = $this->get_file_type_by_extension ( $extension );
		//---------------------------------------
		if( empty( $fileType ) ) { $extension = pathinfo($url, PATHINFO_EXTENSION); }

		$fileType = $this->get_file_type_by_extension ( $extension );

		if( empty( $fileType ) ) { $fileType = 'not_image';	}

		$this->photoFileType = $fileType;
	}

	private function set_mime_type_by_file_type () {

		if( !empty( $this->photoMimeType ) ) { return; }
		if( $this->photoFileType == 'not_image' ) { return; }

		$this->photoMimeType = $this->get_mime_type_by_file_type();

	}

	private function get_file_type_by_extension ( $extension ) {

		$fileType = '';
		switch ( strtoupper( $extension ) ) {
			case 'GIF':
				$fileType = 'GIF';
				break;
			case 'JPEG':
			case 'JPG':
				$fileType = 'JPEG';
				break;
			case 'PNG':
				$fileType = 'PNG';
			default:
				break;
		}
		return $fileType;
	}

	private function get_mime_type_by_file_type () {

		$mimeType = '';

		switch ( strtoupper( $this->photoFileType ) ) {
			case 'GIF':
				$mimeType = 'image/gif';
				break;
			case 'JPEG':
			case 'JPG':
				$mimeType = 'image/jpeg';
				break;
			case 'PNG':
				$mimeType = 'image/png';
			default:
				break;
		}

		return $mimeType;
	}

	private function is_image_by_mime_type( $mimeType ) {
	
		$isImage = false;

		switch ( strtolower( $mimeType ) ) {
			case 'image/gif':
				$isImage = true;
				break;
			case 'image/jpeg':
				$isImage = true;
				break;
			case 'image/jpg':
				$isImage = true;
				break;						
			case 'image/png':
				$isImage = true;
				break;
			default:
				break;
		}

		return $isImage;
	}
}