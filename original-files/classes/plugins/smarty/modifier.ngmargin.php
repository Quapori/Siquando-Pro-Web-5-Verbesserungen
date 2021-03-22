<?php

/**
 * 
 * Creates margin
 * @param string $string in
 */
function smarty_modifier_ngmargin($string, $indentleft = 0) {
	$parts = explode ( ' ', $string );

	if ($indentleft == 0) {
		$newParts = Array ();
		foreach ( $parts as $part ) {
			$newParts [] = $part . 'px';
		}
		return join ( ' ', $newParts );
	} else {
		switch (count ( $parts )) {
			case 0 :
				return '';
			case 1 :
				return sprintf ( '%dpx %dpx %dpx %dpx', $parts [0], $parts [0], $parts [0], $parts [0] + $indentleft );
			default :
				return sprintf ( '%dpx %dpx %dpx %dpx', $parts [0], $parts [1], $parts [2], $parts [3] + $indentleft );
		}
	}

}