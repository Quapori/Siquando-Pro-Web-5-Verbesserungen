<?php

/**
 * 
 * Creates fontcolor
 * @param string $string in
 */
function smarty_modifier_ngfontisuppercase($string) {
	$parts = explode ( ',', $string );
	
	if (count ( $parts ) == 6) {
		return ($parts[4]=='true'); 
	} else {
		return false;
	}
}