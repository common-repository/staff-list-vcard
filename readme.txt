===Staff List vCard===
Contributors: abcFolio
Author URI: http://www.abcfolio.com
Plugin URI: https://abcfolio.com/wordpress-plugin-staff-list-vcard/
Plugin Name: Staff List vCard and QR Code
Tags:  qr code, qrcode, vcard, vcf, staff, abcfolio
Requires at least: 4.9
Tested up to: 6.3
Requires PHP: 7.0
Stable tag: 0.3.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

QRCode or vCard to share your contact information. Dynamic or static files. Staff List plugin extension.

== Description ==

Create **vCards** as VCF files to share contact information. 
Create **QR Code** PNG images to avoid the hassle of manually typing contact details. 

**Staff List vCard** is a plugin extension. It won’t work in a standalone mode. **[Staff List](https://wordpress.org/plugins/staff-list/)** or **[Staff List Pro](https://abcfolio.com/wordpress-plugin-staff-list/purchase-plugin/)** have to be installed and activated.

Staff records are created and maintained by Staff List plugin. vCard extension is used for mapping staff data to vCard properties.

You can create static VCF or QR Code files. They can be used by any application. 

[**vCards** and **QR Code** Live Preview](https://abcfolio.com/wordpress-plugin-staff-list-vcard/live-previews/).

**Dynamic vCard generator.**   

* Create a file on the fly.
* Use data of the staff list members.
* Download and open with your default contact application.

**Static vCard files.** 

* Download and save as .vcf file.
* Staff mebers data is used to populate vCard or QR Code.

**Supported formats**

* vCard 3.0
* vCard 4.0
* vCard QR Code

**Available properties of vCard and QR Code **

* ADR
* EMAIL
* FN (required)
* N (required)
* NICKNAME
* NOTE
* ORG
* PHOTO
* ROLE
* TEL
* TITLE
* URL

== Step by Step Instructions ==

[Documentation - Step by Step Instructions VCard](https://abcfolio.com/wordpress-plugin-staff-list-vcard/step-by-step-instructions/).
[Documentation - Step by Step Instructions QR Code](https://abcfolio.com/wordpress-plugin-staff-list-vcard/qr-code-step-by-step-instructions/).


== User Guide ==

Full documentation: [https://abcfolio.com/wordpress-plugin-staff-list-vcard/](https://abcfolio.com/wordpress-plugin-staff-list-vcard/).

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

....

== Changelog ==

= 0.3.1 20230608=
* Update: Removed outated code and comments.

= 0.3.0 20230404 =
* Update: Minor modification of autoloader.php
* Tested with WP 6.2.

= 0.2.9 20230127 =
* Update: BaconQrCode to version 2.0.7 

= 0.2.8 20220415 =
* Update: Added vendor prefix to Autoloader class.

= 0.2.7 20220412 =
* Update: Admin section, added links to new section of docs.

= 0.2.6 20220207 =
* Update: BaconQrCode to version 2.0.5 
* Update: DASPRiD AbstractEnum PHP 8.0 warning fixed.

= 0.2.5 20211218 =
* Update: Minor updates to QR Code library.

= 0.2.4 20211025 =
* Update: Added a few help labels.

= 0.2.3 20210829 =
* Update: Removed section code64 data from QR Code preview. Image tag base64 can be used for copy - paste.

= 0.2.2 20210816 =
* New: Added base64 output. Content of the fields can be copied as full image tag or just the image src.
* Update: Removed QR Code preview option. Not compatible with all browsers.

= 0.2.1 20210419 =
* New: Added option to select static image as PHOTO. Global setting. Company logo or other image can be used instead of a person. 

= 0.2.0 20210419 =
* Update: Refactored ABCFVC_vCard_Data code.
* Update: Added Staff Template static field handler to vCard properties.
* Update: vCard preview. Replaced static PNG images with base64.
 
= 0.1.4 20210328 =
* New: Added QR Code section.
* New: BaconQrCode 2.0.0
* New: endroid/qr-code 4.0.0
* New: DASPRiD/Enum 1.0.3
* Update: Version for testing

= 0.1.3 20210329 =
* Fix: Removed testing function qr_test_run.

= 0.1.2 20210328 =
* Fix: set_ADR. Section slTplateVCardFNo removed. Not used anymore.

= 0.1.1 2021 =
* Fix: VCard Preview metabox container - added closing div.

= 0.1.0 20210130 =
* Initial release.

= 0.0.9 20210122 =
* Update: Replaced curl with wp_safe_remote_get.
* Update: Added sanitize_text_field to POST calls.

= 0.0.8 20210122 =
* Update: Changed input order of N property to match specs.
* Update: File type to JPEG.
* Update: Removed option to hide static fields.

= 0.0.1 20201120 =
* Initial version.

== Upgrade Notice ==

= 0.1.0 =
Initial release.