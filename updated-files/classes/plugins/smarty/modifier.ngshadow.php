<?php

/**
 * 
 * Creates shadow
 * @param string $string in
 */
function smarty_modifier_ngshadow($string)
{
	$parts=explode(' ', $string);
	
	switch (count($parts))
	{
		case 4:
			
			$x=0;
			$y=0;
			
			switch ($parts[3])
			{
				case 'N':
					$y=-$parts[0];
					break;
				case 'NE':
					$x=$parts[0];
					$y=-$parts[0];
					break;
				case 'E':
					$x=$parts[0];
					break;
				case 'SE':
					$x=$parts[0];
					$y=$parts[0];
					break;
				case 'S':
					$y=$parts[0];
					break;
				case 'SW':
					$x=-$parts[0];
					$y=$parts[0];
					break;
				case 'W':
					$x=-$parts[0];
					break;
				case 'NW':
					$x=-$parts[0];
					$y=-$parts[0];
					break;
			}
			
			return sprintf('%dpx %dpx %dpx rgba(0,0,0,%1.1f)', $x, $y, $parts[1], $parts[2]/100);
		default:
			return '';
	}
}