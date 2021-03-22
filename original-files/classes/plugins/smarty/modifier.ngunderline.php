<?php

/**
 * 
 * Convert underline
 * @param string $string in
 */
function smarty_modifier_ngunderline($value) {
	
	
	
		return $value?'underline':'none';
}