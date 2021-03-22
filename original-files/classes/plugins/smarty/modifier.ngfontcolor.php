<?php

/**
 * 
 * Creates fontcolor
 * @param string $string in
 */
function smarty_modifier_ngfontcolor($string) {
	$parts = explode ( ',', $string );
	
	if (count ( $parts ) == 6) {
		return $parts[5]; 
	} else {
		return '';
	}
}