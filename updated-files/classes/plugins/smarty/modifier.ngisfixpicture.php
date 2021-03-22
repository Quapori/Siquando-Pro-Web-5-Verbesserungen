<?php

/**
 * 
 * Creates stretchpicture
 * @param string $string in
 */
function smarty_modifier_ngisfixpicture($string)
{
	$parts=explode(' ', $string);

	if (count($parts) < 5) return false;
	if ($parts[4] != 'true') return false;
	return true;
}