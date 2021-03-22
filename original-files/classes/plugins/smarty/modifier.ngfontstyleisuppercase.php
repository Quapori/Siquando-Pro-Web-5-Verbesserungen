<?php

/**
 * 
 * Creates font style
 * @param string $string in
 */
function smarty_modifier_ngfontstyleisuppercase($string) {
	$parts = explode ( ',', $string );
	return (count ( $parts ) == 4 && $parts[2] == 'true'); 
}