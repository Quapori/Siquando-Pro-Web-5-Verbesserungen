<?php

/**
 * 
 * Creates line
 * @param string $string in
 */
function smarty_modifier_ngline($string) {
	$parts = explode ( ' ', $string );
	
	if (count ( $parts ) == 2) {
		return sprintf ( '%dpx solid #%s', $parts [0], $parts [1] );
	} else {
		return '';
	}
}