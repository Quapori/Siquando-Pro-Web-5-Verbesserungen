<?php

/**
 * 
 * Creates background
 * @param string $string in
 */
function smarty_modifier_ngbackgroundcolor($string, $defaultcolor='000000') {
	$parts = explode ( ' ', $string );
	
	switch ($parts [0]) {
		case 'picture' :
		    return $defaultcolor;
		case 'solid' :
			return  $parts [1];
		case 'gradient' :
			return $parts [1];
	}

}