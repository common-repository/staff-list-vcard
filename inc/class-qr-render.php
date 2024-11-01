<?php
if (!defined('ABSPATH')) {
    exit;
}

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelQuartile;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\Font;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeEnlarge;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeShrink;

use Endroid\QrCode\Writer\PngWriter;

// Not used ?????????
//use Endroid\QrCode\Builder\Builder;

// use Endroid\QrCode\Writer\Result;
// use Endroid\QrCode\Writer\BinaryWriter;
// use Endroid\QrCode\Writer\DebugWriter;
// use Endroid\QrCode\Writer\Result\BinaryResult;
// use Endroid\QrCode\Writer\Result\DebugResult;
// use Endroid\QrCode\Writer\Result\PngResult;
// use Endroid\QrCode\Writer\ValidatingWriterInterface;
// use Endroid\QrCode\Writer\WriterInterface;

if ( ! class_exists( 'ABCFVC_Qr_Render' ) ) {

class ABCFVC_Qr_Render {
		//@var array Of QR code parameters and fields
		private $qrParams;
		private $vCardTxt = '';
		private $imgUri = '';
		private $qrLabelTxt = '';

	public function __construct( $params, $vCardTxt ) {

		//-------------------------------------------
		$defaults['qrCorrectionL'] = '';
		$defaults['qrSize'] = '';
		$defaults['qrMargin'] = '';
		$qrParams['qrLblFontPx'] = '';
		$defaults['qrBlockSizeM'] = '';
		$defaults['qrLblFN'] = '';
		$defaults['qrLblStatic'] = '';
		$defaults['vcardFN'] = '';
		$defaults['fileQPath'] = '';
		$defaults['saveImg'] = false;

		$defaults['printVcardTxt'] = false;
		$defaults['printParams'] = false;
		$defaults['printConfirm'] = false;
		
		$args = wp_parse_args( $params, $defaults );

		if( empty( $args['qrSize'] )  ){ $args['qrSize'] = 200; }
		if( empty( $args['qrMargin'] )  ){ $args['qrMargin'] = 0; }
		if( empty( $args['qrLblFontPx'] )  ){ $args['qrLblFontPx'] = 10; }
		if( empty( $args['qrLblFN'] )  ){ $args['qrLblFN'] = 'N'; }
		//--------------------------------------------
		
		$this->qrParams = $args;
		$this->vCardTxt = $vCardTxt;
		$this->set_lbl();

		if( $this->qrParams['printConfirm'] ){ 
			$this->print_confirm(); 
		}
		
		if( $this->qrParams['printParams'] ){ 
			$this->print_params(); 
		}	

		if( $this->qrParams['printVcardTxt'] ){ 
			$this->print_vcardtxt(); 
		}
	}

	private function set_lbl(){

		$qrLblFN = $this->qrParams['qrLblFN'];

		//No label
		if( $qrLblFN == 'N' && empty( $this->qrParams['qrLblStatic'] ) ) { return; }
		
		//Static label
		if( $qrLblFN == 'N' ) { 
			$this->qrLabelTxt = $this->qrParams['qrLblStatic'];
			return;  
		}

		$this->qrLabelTxt = trim( $this->qrParams['qrLblStatic'] . ' ' . $this->qrParams['vcardFN'] ); 
	}

	private function print_confirm() {
		echo"<pre>", print_r( 'confirm: Confirmed ABCFVC_Qr_Render class.', true ), "</pre>";		
	}

	private function print_params() {
		echo"<pre>", print_r(  $this->qrParams, true ), "</pre>";
	}

	private function print_vcardtxt() {
		echo"<pre>", print_r(  $this->vCardTxt, true ), "</pre>";
	}

	public function renderQRCode() {

		$qrCode = QrCode::create( $this->vCardTxt );

		//ISO-8859-1
		//$qrCode->setEncoding( new Encoding('ISO-8859-1') );
		$qrCode->setEncoding( new Encoding('UTF-8') );
		$qrCode->setSize( $this->qrParams['qrSize'] );
		$qrCode->setMargin( $this->qrParams['qrMargin'] );
	
		$qrCode->setForegroundColor( new Color(0, 0, 0) );
		$qrCode->setBackgroundColor( new Color(255, 255, 255) );

		// Shrink = No borders.
		switch ( $this->qrParams['qrBlockSizeM'] ) {
			case 'MARGIN':
				$qrCode->setRoundBlockSizeMode( new RoundBlockSizeModeMargin() );
				break;
			case 'SHRINK':
				$qrCode->setRoundBlockSizeMode( new RoundBlockSizeModeShrink() );
				break;
			case 'ENLARGE':
				$qrCode->setRoundBlockSizeMode( new RoundBlockSizeModeEnlarge() );
				break;			
			default:
				$qrCode->setRoundBlockSizeMode( new RoundBlockSizeModeMargin() );
		}

		switch ( $this->qrParams['qrCorrectionL'] ) {
			case 'LOW':
				$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
				break;
			case 'MEDIUM':
				$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelMedium());
				break;
			case 'QUARTILE':
				$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelQuartile()); 
				break;
			case 'HIGH':
				$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh());
				break;					
			default:
				$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
		}

		//== LABEL == Render container only when there is some text present. ===================
		$label = null;

		if( !empty( $this->qrLabelTxt ) ){
			// Create generic label 
			$label = Label::create( $this->qrLabelTxt )
				->setTextColor( new Color( 0, 0, 0 ) )
				->setBackgroundColor( new Color( 255, 255, 255 ) );

			if( $this->qrParams['qrBlockSizeM'] == 'MARGIN' ) {
				$label->setMargin( new Margin(0, 2, 5, 2 ) );
			}
			else{				
				switch ( $this->qrParams['qrMargin'] ) {
					case 5:
					case 0:	
						$label->setMargin( new Margin( 5, 2, 5, 2 ) );
						break;		
					default:
						$label->setMargin( new Margin(0, 2, 5, 2 ) );
				}
			}

			$label->setFont( new Font( ABCFVC_PLUGIN_IMG_DIR . '/open_sans.ttf', $this->qrParams['qrLblFontPx'] ) );
		}

		if( $this->qrParams['saveImg'] ) {
			$this->saveQRCodeImg( $qrCode, $label );
		}
		else{
			$this->setQRCodeImg64( $qrCode, $label );
		}
	}

	private function saveQRCodeImg( $qrCode, $label ) {

		$logo = null;
		//Save image to png file
		$writer = new PngWriter();
		$result = $writer->write( $qrCode, $logo, $label );
		$result->saveToFile( $this->qrParams['fileQPath'] );	
	}

	private function setQRCodeImg64(  $qrCode, $label ) {

		$logo = null;
		//Save image to 64
		$writer = new PngWriter();
		$result = $writer->write( $qrCode, $logo, $label );
		$this->imgUri = $result->getDataUri();	
	}

	public function getImgUri() {
		return $this->imgUri;	
	}
}
}