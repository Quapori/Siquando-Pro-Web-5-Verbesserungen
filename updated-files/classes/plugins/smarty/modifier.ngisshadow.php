<?php

/**
 * 
 * Creates shadow
 * @param string $string in
 */
function smarty_modifier_ngisshadow($string)
{
	$parts=explode(' ', $string);
	
	switch (count($parts))
	{
		case 4:
			return $parts[2]!=0;
		default:
			return false;
	}
}