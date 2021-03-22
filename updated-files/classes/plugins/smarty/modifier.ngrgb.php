<?php

/**
 * 
 * Creates font
 * @param string $string in
 */
function smarty_modifier_ngrgb($string) {
	$r = hexdec( substr($string, 0,2));
	$g = hexdec( substr($string, 2,2));
	$b = hexdec(substr($string, 4,2));
	
	return $r.','.$g.','.$b;
	
}