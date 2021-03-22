<?php

/**
 * 
 * Creates font style
 * @param string $string in
 */
function smarty_modifier_ngfontstyleisbold($string) {
	$parts = explode ( ',', $string );
	return (count ( $parts ) == 4 && $parts[0] == 'true'); 
}