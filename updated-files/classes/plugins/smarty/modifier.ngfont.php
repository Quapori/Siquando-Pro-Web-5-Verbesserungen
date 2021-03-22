<?php

/**
 * 
 * Creates font
 * @param string $string in
 */
function smarty_modifier_ngfont($string) {
	$parts = explode ( ',', $string );
	
	if (count ( $parts ) == 6) {
		$font = '';
		if ($parts [3] == 'true')
			$font .= 'italic ';
		if ($parts [2] == 'true')
			$font .= 'bold ';
		$font .= $parts [1] . 'px ';
		$font .= NGFontUtil::getInstance()->getFontStack($parts [0]) ;
		return $font;
	} else {
		return '';
	}
}