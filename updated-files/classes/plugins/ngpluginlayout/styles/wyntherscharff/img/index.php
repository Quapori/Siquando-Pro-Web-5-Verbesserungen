<?php

class renderSVG {

	public $file = 'default';
	public $colora = '333333';
	public $colorb = '549BD6';
	public $colorc = 'ffffff';

	function render() {
		$file = './svg/' . $this->file . '.svg';
		if (file_exists ( $file )) {
			header ( 'Content-Type: image/svg+xml' );
			$svg = file_get_contents ( $file );
			$svg = str_replace ( '{colora}', $this->colora, $svg );
			$svg = str_replace ( '{colorb}', $this->colorb, $svg );
			$svg = str_replace ( '{colorc}', $this->colorc, $svg );
			echo ($svg);
		} else {
			header ( "HTTP/1.0 404 Not Found" );
			echo ('Imagestyle not found.');
		}

	}
}

$render = new renderSVG ();

if (array_key_exists ( 'ca', $_GET )) {
	if (preg_match ( '/^[a-f0-9]{6}$/i', $_GET ['ca'] )) {
		$render->colora = $_GET ['ca'];
	}
}
if (array_key_exists ( 'cb', $_GET )) {
	if (preg_match ( '/^[a-f0-9]{6}$/i', $_GET ['cb'] )) {
		$render->colorb = $_GET ['cb'];
	}
}
if (array_key_exists ( 'cc', $_GET )) {
	if (preg_match ( '/^[a-f0-9]{6}$/i', $_GET ['cc'] )) {
		$render->colorc = $_GET ['cc'];
	}
}

if (array_key_exists ( 'f', $_GET )) {
	$render->file = basename ( $_GET ['f'] );
}

$render->render ();

?>