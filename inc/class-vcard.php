<?php
if ( ! defined( 'ABSPATH' ) ) exit;

//vCard ouput builder.
class ABCFVC_vCard {

    private $vCardProperties;
    public $charset = 'UTF-8';
    private $filename;
    public $vCardVersion;

    public function addVersion( $cardVersion ) {
        $this->vCardVersion = $cardVersion;
    }

    public function addADR( $pobox, $addrL1, $addrL2, $addrCity,  $addrState, $addrZip, $addrCountry, $type ) {

        // :@pobox,
        // :@extended,
        // :@street,
        // :@locality,
        // :@region,
        // :@postalcode,
        // :@country,

        $address = trim( $pobox . $addrL1 . $addrL2 . $addrCity . $addrState . $addrZip . $addrCountry );
        if( empty( $address ) ) { return; }

        $address =  $pobox . ';' . $addrL1 . ';' . $addrL2 . ';' . $addrCity . ';' . $addrState . ';' . $addrZip . ';' . $addrCountry;    
        $this->setProperty( 'ADR' . $this->getCharsetString() . $type, $address );
    
        return $this;
    }

    public function addFN( $nameFN ) {

        $this->setProperty( 'FN' . $this->getCharsetString(), $nameFN );
        return $this;
    }

    public function addN( $lastName, $firstName, $middleName, $honorificPrefix, $honorificSuffix ) {
        
        $nameN = $lastName . ';' . $firstName . ';' . $middleName . ';' . $honorificPrefix . ';' . $honorificSuffix;
        $this->setProperty( 'N' . $this->getCharsetString(), $nameN );
        return $this;
    }

    public function addNICKNAME( $value ) {

        if( empty( $value ) ) { return; }

        $this->setProperty( 'NICKNAME' . $this->getCharsetString(),  $value  );
        return $this;
    }

    public function addORG( $orgName, $orgUnit )  {

        if( empty( $orgName ) & empty( $orgUnit ) ) { return; }

        if( empty( $orgName ) & !empty( $orgUnit ) ){            
			$orgName = $orgUnit;
            $this->setProperty( 'ORG' . $this->getCharsetString(), $orgName );
            return $this;
		}

        $this->setProperty( 'ORG' . $this->getCharsetString(), $orgName . ';' . $orgUnit );
        return $this;
    }

    public function addTITLE( $jobTitle ) {

        if( empty( $jobTitle ) ) { return; }

        $this->setProperty( 'TITLE' . $this->getCharsetString(),  $jobTitle  );
        return $this;
    }

    public function addEMAIL( $emailAddress, $emailType )  {

        //$emailType may be  PREF | WORK | HOME or any combination of these: e.g. "PREF;WORK"
        //EMAIL;CHARSET=UTF-8;TYPE=WORK,INTERNET,PREF:myemail@domain.com
        
        if( empty( $emailAddress ) ) { return; }

        $this->setProperty( 'EMAIL' . $this->getCharsetString() . $emailType, $emailAddress );
        return $this;
    }

    public function addNOTE( $value ) {

        if( empty( $value ) ) { return; }
        $this->setProperty( 'NOTE' . $this->getCharsetString(), $value );
        return $this;
    }

    public function addROLE( $value ) {

        if( empty( $value ) ) { return; }
        $this->setProperty( 'ROLE' . $this->getCharsetString(), $value );
        return $this;
    }

    public function addTEL( $telNumber, $telType ) {

        if( empty( $telNumber ) ) { return; }
        $this->setProperty( 'TEL' . $telType, $telNumber  );
        return $this;
    }

    //Type may be WORK | HOME 
    public function addURL( $urlTxt, $type )  {
        
        if( empty( $urlTxt ) ) { return; }

        $this->setProperty( 'URL' . $type,  $urlTxt );
        return $this;
    }

    public function addURLSM( $urlTxt, $type, $grp )  {

        if( empty( $urlTxt ) ) { return; }
        if( empty( $type ) ) { return; }

        //$this->setProperty( 'sm_url', 'item' . $grp . '.URL', $urlTxt );
        //$this->setProperty( 'sm_x_lbl', 'item' . $grp . '.X-ABLABEL', $type );
        $this->setProperty( 'item' . $grp . '.URL', $urlTxt );
        $this->setProperty( 'item' . $grp . '.X-ABLABEL', $type );
        return $this;
    }

     // Add photo property to vCar output. $url image url or filename, bool $include Include the image in our vcard?
    public function addPHOTO( $photoURL, $type ){

        if( empty( $photoURL ) ) { return; }

        $this->setProperty( 'PHOTO' . $type,  $photoURL );
        return $this;

        //return;

        //$this->addImage( 'PHOTO', $photoURL, 'photo', true );

        //var_dump($this->vCardProperties);
        return $this;
    }
    //==============================================================
    
    protected function setProperty( $key, $value ) {

        //$key N;CHARSET=UTF-8 | TITLE;CHARSET=UTF-8 | item1.URL | item1.X-ABLABEL
        // $value
        $this->vCardProperties[] = [
            'key' => $key,
            'value' => $value
        ];
    }

     // Get output as string.  iOS devices (and safari < iOS 8 in particular) can not read .vcf (= vcard) files. So I build a workaround to build a .ics (= vcalender) file.
    public function getOutput() {

        //$output = ($this->isIOS7()) ? $this->buildVCalendar() : $this->buildVCard();
        $output = $this->buildVCard();
        return $output;
    }

    //Build VCard (.vcf)
    public function buildVCard() {

        $string = "BEGIN:VCARD\r\n";
        $string .= "VERSION:". $this->vCardVersion . "\r\n";

        //$string .= "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";

        //$vCardProperties = $this->getProperties();

        $vCardProperties = $this->vCardProperties;

        //var_dump($vCardProperties);

        switch ( $this->vCardVersion ) {
			case '3.0':
				$string = $this->buildVCard3( $string, $vCardProperties );
				break;
			case '4.0':
				$string = $this->buildVCard4( $string, $vCardProperties );
				break;
            default:
                $string = $this->buildVCard3( $string, $vCardProperties );
				break;
		}

        $string .= "END:VCARD\r\n";
        return $string;
    }

    public function buildVCard3( $string, $vCardProperties ) {

        //3.0 PHOTO;TYPE=JPEG;VALUE=URI:
        //3.0 PHOTO;TYPE=JPEG;ENCODING=b:[base64-data]

        foreach ($vCardProperties as $property) {
            $string .= $this->fold75( $property['key'] . ':' . $this->escape($property['value'] ) . "\r\n" );
        }

        return $string;        
    }

    public function buildVCard4( $string, $vCardProperties ) {

        //4.0 PHOTO;MEDIATYPE=image/jpeg:
		//4.0 PHOTO:data:image/JPEG;base64,[base64-data]
        //4.0: PHOTO:data:image/jpeg;base64,[base64-data]	

        foreach ( $vCardProperties as $property ) {

            $colonEnd = ':';
            if( $this->stringEndsWith( $property['key'], 'base64,' ) ){ $colonEnd = ''; }
            $string .= $this->fold75( $property['key'] . $colonEnd . $this->escape($property['value']) . "\r\n" );
        }
        
        return $string;
    }

    private function stringEndsWith( $whole, $end ) {
        //$whole = 'xx';
        ///$whole = 'PHOTO:data:JPEG;base64,' (length=23)
        return substr_compare( $whole, $end, -strlen( $end ) ) === 0;  
    }

    public function getCharsetString() {

        if( $this->vCardVersion == '3.0' ) {
            return ';CHARSET=' . $this->charset;
        }
        return '';        
    }

    protected function escape( $text ) {

        //Escape newline characters according to RFC2425 section 5.8.4. http://tools.ietf.org/html/rfc2425#section-5.8.4
        $text = str_replace("\r\n", "\\n", $text);
        $text = str_replace("\n", "\\n", $text);
        return $text;
    }

    protected function fold75( $text ){

        //Fold a line according to RFC2425 section 5.8.1. http://tools.ietf.org/html/rfc2425#section-5.8.1

        if ( strlen($text) <= 75 ) {
            return $text;
        }

        // split, wrap and trim trailing separator 
        return substr( $this->chunk_split_unicode( $text, 75, "\r\n "), 0, -3);
        //return substr(chunk_split( $text, 75, "\r\n "), 0, -3);
    }

    /**
     * multibyte word chunk split
     * @link http://php.net/manual/en/function.chunk-split.php#107711
     * 
     * @param  string  $body     The string to be chunked.
     * @param  integer $chunklen The chunk length.
     * @param  string  $end      The line ending sequence.
     * @return string            Chunked string
     */
    //hunk_split_unicode($body, $chunklen = 76, $end = "\r\n")
    protected function chunk_split_unicode( $body, $chunklen, $end )
    {
        $array = array_chunk(
            preg_split("//u", $body, -1, PREG_SPLIT_NO_EMPTY), $chunklen);
        $body = "";
        foreach ($array as $item) {
            $body .= join("", $item) . $end;
        }
        return $body;
    }

    // public function getProperties() {
    //     return $this->vCardProperties;
    // }    
}