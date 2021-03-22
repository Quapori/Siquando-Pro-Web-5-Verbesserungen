<?php

/**
 * 
 * Is it a line?
 * @param string $string in
 */
function smarty_modifier_ngisline($string)
{
	$parts=explode(' ', $string);
	
	switch (count($parts))
	{
		case 2:
			return $parts[0]!=0;
		default:
			return false;
	}
}