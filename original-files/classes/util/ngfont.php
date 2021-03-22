<?php

class NGFont {
	public $fontfamily = 'Tahoma';
	public $fontsize = 12;
	public $bold = false;
	public $italic = false;
	public $uppercase = false;
	public $color = '000000';
	
	public function __construct($data) {
		$parts = explode ( ',', $data );
		
		if (count ( $parts ) == 6) {
			$this->fontfamily = $parts [0];
			$this->fontsize = intval ( $parts [1] );
			$this->bold = NGUtil::StringXMLToBool ( $parts [2] );
			$this->italic = NGUtil::StringXMLToBool ( $parts [3] );
			$this->uppercase = NGUtil::StringXMLToBool ( $parts [4] );
			$this->color = $parts [5];
		}
	}
}