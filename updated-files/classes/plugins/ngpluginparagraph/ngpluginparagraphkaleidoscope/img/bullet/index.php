<?php

class renderSVG {
	
	public $file;
	
	public $colora = 'ffffff';
	public $colorb = '888888';
	public $colorc = '0096ff';
	
	function render() {
		header ( 'Content-Type: image/svg+xml' );
		$svg = file_get_contents ( './bullet.svg' );
		$svg = str_replace ( '{colora}', $this->colora, $svg );
		$svg = str_replace ( '{colorb}', $this->colorb, $svg );
		$svg = str_replace ( '{colorc}', $this->colorc, $svg );
		echo ($svg);	
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

$render->render ();