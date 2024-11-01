<?php
if ( !class_exists('ABCFVC_Autoloader', false) ){

class ABCFVC_Autoloader {

    public function loader( $className ) {

        // https://tommcfarlin.com/php-autoloader-wordpress/
        // If the specified $class_name does not include our namespace, duck out.
        // className = Endroid\QrCode\Encoding\Encoding
        $loadFile = $this->isOurClass( $className );
        if ( !$loadFile ) { return;  }
        $this->loadClassFile( $className );
    }
    
    private function loadClassFile( $className ) {

        $folderClassName = $this->vendorFolder( $className );
        $classFilePath = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', $folderClassName ) ) . '.php';
    
        // create the actual filepath
        $fileQPath = ABCFVC_PLUGIN_DIR . $classFilePath;

        // className = Endroid\QrCode\Encoding\Encoding;
        // folderClassName = vendor\Endroid\QrCode\QrCode;
        // classFilePath = vendor\Endroid\QrCode\QrCode.php;
        // fileQPath =  X:\xampp\htdocs\blog\wp-content\plugins\abcfolio-staff-list-vcard/vendor\Endroid\QrCode\QrCode.php;
        
        // error_log( print_r( 'Autoloader class name: ' . $className, true) );
        // error_log( print_r( 'Autoloader folder + class name: ' . $folderClassName, true) );
        // error_log( print_r( 'Autoloader class file path: ' . $classFilePath, true) );
        // error_log( print_r( 'Autoloader class file qpath: ' . $fileQPath, true) );

        if ( !file_exists( $fileQPath ) ) {
            $errClass = ('<h3>Class: ' . $classFilePath . ' not exists.</h3>');
            $errFile = ('<p>File: ' . $fileQPath . ' not exists.</p>');            
            wp_die( $errClass . $errFile );
        }

        if ( file_exists( $fileQPath ) ) {
            require_once $fileQPath;
            return;
        }            
    }

    public function vendorFolder( $className ) {

        if ( strpos( $className, 'Endroid' ) === 0) { return 'vendor\\' .  $className; }
        if ( strpos( $className, 'BaconQrCode' ) === 0) { return 'vendor\\' .  $className; }
        if ( strpos( $className, 'DASPRiD' ) === 0) { return 'vendor\\' .  $className; }
        return $className;    
    }
    
    public function isOurClass( $className ) {

        if ( strpos( $className, 'BaconQrCode' ) === 0) { return true; }
        if ( strpos( $className, 'Endroid' ) === 0) { return true; }         
        if ( strpos( $className, 'DASPRiD' ) === 0) { return true; } 
        return false;    
    }
}
}

//$loadmefiles = new Autoloader();
$loadmefiles = new ABCFVC_Autoloader();
spl_autoload_register(array( $loadmefiles, 'loader'));