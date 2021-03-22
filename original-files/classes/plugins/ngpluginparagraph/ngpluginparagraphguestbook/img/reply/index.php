<?php

class renderSVG {
	
	public $file = 'default';
	public $color = 'b0c4de';
	public $size = 32;
	
	function render() {
		$file = './svg/' . $this->file . '.xml';
		if (file_exists ( $file )) {
			header ( 'Content-Type: image/svg+xml' );
			$svg = file_get_contents ( $file );
			$svg = str_replace ( '{color}', $this->color, $svg );
			$svg = str_replace ( '{size}', $this->size, $svg );
			echo ($svg);
		} else {
			header ( "HTTP/1.0 404 Not Found" );
			echo ('Imagestyle not found.');
		}
	}
}

$render = new renderSVG ();

if (array_key_exists ( 'c', $_GET )) {
	if (preg_match ( '/^[a-f0-9]{6}$/i', $_GET ['c'] )) {
		$render->color = $_GET ['c'];
	}
}

if (array_key_exists ( 'f', $_GET )) {
	$render->file = basename ( $_GET ['f'] );
}

if (array_key_exists ( 's', $_GET )) {
	$render->size = intval( $_GET ['s'] );
}


$render->render ();