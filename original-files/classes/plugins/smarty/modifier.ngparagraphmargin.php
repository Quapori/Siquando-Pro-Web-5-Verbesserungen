<?php

/**
 * 
 * Creates font
 * @param string $string in
 */
function smarty_modifier_ngparagraphmargin($string) {
	$parts = explode ( ' ', $string );
	
	
	if (count ( $parts ) == 2) {
		return sprintf ( '%dpx 0 %dpx 0', $parts [0], $parts [1]);
		;
	} else {
		return '0';
	}
}