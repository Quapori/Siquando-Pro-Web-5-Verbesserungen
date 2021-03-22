<?php

/**
 * 
 * Creates fontcolor
 * @param string $string in
 */
function smarty_modifier_ngfontstylecolor($string) {
	$parts = explode ( ',', $string );
	
	if (count ( $parts ) == 4) {
		return $parts[3]; 
	} else {
		return '';
	}
}