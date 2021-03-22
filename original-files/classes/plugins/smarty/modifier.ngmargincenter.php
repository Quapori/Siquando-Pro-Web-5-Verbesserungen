<?php

/**
 * 
 * Creates centered margin
 * @param string $string in
 */
function smarty_modifier_ngmargincenter($string)
{
	$parts=explode(' ', $string);
	
	switch (count($parts))
	{
		case 0:
			return '';
		case 1:
			return sprintf('%dpx auto %dpx auto', $parts[0], $parts[0]);
		default:
			return sprintf('%dpx auto %dpx auto', $parts[0], $parts[2]);
	}
}