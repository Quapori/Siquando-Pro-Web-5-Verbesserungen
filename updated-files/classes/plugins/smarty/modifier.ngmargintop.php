<?php

/**
 *
 * Creates topmargin
 * @param string $string in
 */
function smarty_modifier_ngmargintop($string) {
	$parts = explode ( ' ', $string );
	
	switch (count ( $parts )) {
		case 0 :
			return '0px';
		case 1 :
			return sprintf ( '%dpx', $parts [0] );
		default :
			return sprintf ( '%dpx', $parts [0] );
	}
}