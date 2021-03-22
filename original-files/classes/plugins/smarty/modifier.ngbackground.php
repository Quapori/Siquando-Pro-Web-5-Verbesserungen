<?php

/**
 * 
 * Creates background
 * @param string $string in
 */
function smarty_modifier_ngbackground($string) {
	$parts = explode ( ' ', $string );
	
	switch ($parts [0]) {
		case 'picture' :
			if ($parts [2] == 'true') {
				return sprintf ( 'url(%s) no-repeat #%s', NGLink::getPictureURL ( $parts [1] ), $parts [3] );
			} else {
				return sprintf ( 'url(%s)', NGLink::getPictureURL ( $parts [1] ) );
			}
		
		case 'solid' :
			return '#' . $parts [1];
		case 'gradient' :
			return sprintf ( 'url(%1$simages/gradient/?s=%2$s&e=%3$s&h=%4$s) repeat-x #%3$s', NGSession::getInstance ()->pathToRoot (), $parts [1], $parts [2], $parts [3] );
	}

}