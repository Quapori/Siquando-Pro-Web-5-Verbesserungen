<?php

/**
 * 
 * Creates fontcolor
 * @param string $string in
 */
function smarty_modifier_ngfontsize($string) {
	$parts = explode ( ',', $string );
	
	if (count ( $parts ) == 6) {
		return intval($parts[1]); 
	} else {
		return 0;
	}
}