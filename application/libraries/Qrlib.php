<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Qrlib {

	public function setQrCode($code, $codeContents ) {
		include "phpqrcode/qrlib.php";
		// QRcode::png('PHP QR Coded :)');
		// how to save PNG codes to server

$tempDir = 'qr-code/';

// $codeContents = 'This Goes From File';

// we need to generate filename somehow,
// with md5 or with database ID used to obtains $codeContents...
$fileName = 'qrcode_'.$code.'.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
// $urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

// generating
if (!file_exists($pngAbsoluteFilePath)) {
		QRcode::png($codeContents, $pngAbsoluteFilePath);
		return $fileName;
} else {
		return 0;
}

}

}
