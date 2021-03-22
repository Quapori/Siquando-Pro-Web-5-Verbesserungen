<?php

/**
 * 
 * Creates stretchpicture
 * @param string $string in
 */
function smarty_modifier_ngisstretchpicture($string)
{
	$parts=explode(' ', $string);

	if (count($parts) < 4) return false;
	if ($parts[0] != 'picture') return false;
	if ($parts[2] != 'true') return false;
	return true;
}