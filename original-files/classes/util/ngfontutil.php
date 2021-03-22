<?php

class NGFontUtil {
	public $fonts = array ();
	
	public $styleSheets = array ();
	
	private static $instance = NULL;
	
	/**
	 * 
	 * Creates an instance
	 * @return NGFontUtil
	 */
	public static function getInstance() {
		
		if (self::$instance === NULL) {
			self::$instance = new self ();
		}
		return self::$instance;
	}
	
	private function __construct() {
		$this->fonts ['Arial'] = array ('stack' => 'Arial,\'Helvetica\',sans-serif' );
		$this->fonts ['Calibri'] = array ('stack' => 'Calibri,Candara,\'Segoe\',\'Segoe UI\',Optima,Arial,sans-serif' );
		$this->fonts ['Cambria'] = array ('stack' => 'Cambria,Georgia,serif' );
		$this->fonts ['Corbel'] = array ('stack' => 'Corbel,\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Verdana,sans-serif' );
		$this->fonts ['Courier New'] = array ('stack' => '\'Courier New\',Courier,monospace' );
		$this->fonts ['Georgia'] = array ('stack' => 'Georgia,Times,\'Times New Roman\',serif' );
		$this->fonts ['Lato'] = array ('stack' => 'Lato,Verdana,Helvetica,sans-serif', 'style' => 'lato' );
		$this->fonts ['Open Sans'] = array ('stack' => '\'Open Sans\',Verdana,Helvetica,sans-serif', 'style' => 'opensans' );
		$this->fonts ['Tahoma'] = array ('stack' => 'Tahoma,Verdana,Segoe,sans-serif' );
		$this->fonts ['Times New Roman'] = array ('stack' => '\'Times New Roman\',Times,Georgia,serif' );
		$this->fonts ['Trebuchet MS'] = array ('stack' => '\'Trebuchet MS\',\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Tahoma,sans-serif' );
		$this->fonts ['Verdana'] = array ('stack' => 'Verdana,Geneva,sans-serif' );
		$this->fonts ['Dosis'] = array ('stack' => 'Dosis,Verdana,Helvetica,sans-serif', 'style' => 'dosis' );
		$this->fonts ['Raleway'] = array ('stack' => 'Raleway,Verdana,Helvetica,sans-serif', 'style' => 'raleway' );
		$this->fonts ['Roboto Slab'] = array ('stack' => '\'Roboto Slab\',Verdana,Helvetica,sans-serif', 'style' => 'robotoslab' );
		$this->fonts ['Arvo'] = array ('stack' => 'Arvo,Verdana,Helvetica,sans-serif', 'style' => 'arvo' );
		$this->fonts ['Fjalla One'] = array ('stack' => '\'Fjalla One\',Verdana,Helvetica,sans-serif', 'style' => 'fjallaone' );
		$this->fonts ['Archivo Black'] = array ('stack' => '\'Archivo Black\',Verdana,Helvetica,sans-serif', 'style' => 'archivoblack' );
		$this->fonts ['Lobster'] = array ('stack' => 'Lobster,Verdana,Helvetica,sans-serif', 'style' => 'lobster' );
		$this->fonts ['Source Sans Pro'] = array ('stack' => '\'Source Sans Pro\',Verdana,Helvetica,sans-serif', 'style' => 'sourcesanspro' );
		$this->fonts ['PT Sans'] = array ('stack' => '\'PT Sans\',Tahoma,Helvetica,sans-serif', 'style' => 'ptsans' );
		$this->fonts ['Roboto'] = array ('stack' => 'Roboto,Tahoma,Helvetica,sans-serif', 'style' => 'roboto' );
		$this->fonts ['Signika'] = array ('stack' => 'Signika,Tahoma,Helvetica,sans-serif', 'style' => 'signika' );
		$this->fonts ['Noto Sans'] = array ('stack' => '\'Noto Sans\',Tahoma,Helvetica,sans-serif', 'style' => 'notosans' );
		$this->fonts ['Noto Serif'] = array ('stack' => '\'Noto Serif\',Times,\'Times New Roman\',serif', 'style' => 'notoserif' );
		$this->fonts ['Fira Sans'] = array ('stack' => '\'Fira Sans\',Helvetica,sans-serif', 'style' => 'firasans' );
		$this->fonts ['Playfair Display'] = array ('stack' => '\'Playfair Display\',Times,\'Times New Roman\',serif', 'style' => 'playfairdisplay' );
        $this->fonts ['Proza Libre'] = array ('stack' => 'ProzaLibre,Times,\'Times New Roman\',serif', 'style' => 'prozalibre' );
        $this->fonts ['Cormorant'] = array ('stack' => 'Cormorant,Times,\'Times New Roman\',serif', 'style' => 'cormorant' );
        $this->fonts ['Merriweather'] = array ('stack' => 'Merriweather,Times,\'Times New Roman\',serif', 'style' => 'merriweather' );
        $this->fonts ['Montserrat'] = array ('stack' => 'Montserrat,Verdana,Helvetica,sans-serif', 'style' => 'montserrat' );
        $this->fonts ['Libre Franklin'] = array ('stack' => '\'Libre Franklin\',Verdana,Helvetica,sans-serif', 'style' => 'librefranklin' );
        $this->fonts ['Barlow'] = array ('stack' => 'Barlow,Verdana,Helvetica,sans-serif', 'style' => 'barlow' );
        $this->fonts ['Quicksand'] = array ('stack' => 'Quicksand,Verdana,Helvetica,sans-serif', 'style' => 'quicksand' );
        $this->fonts ['Vollkorn'] = array ('stack' => 'Vollkorn,Times,\'Times New Roman\',serif', 'style' => 'vollkorn' );
		
	}
	
	/**
	 * 
	 * Get the font stack for a font
	 * @param string $font
	 */
	public function getFontStack($font) {
		if (array_key_exists ( $font, $this->fonts )) {
			if (array_key_exists ( 'style', $this->fonts [$font] )) {
				if (! in_array ( $this->fonts [$font] ['style'], $this->styleSheets ))
					$this->styleSheets [] = $this->fonts [$font] ['style'];
			}
			if (array_key_exists ( 'stack', $this->fonts [$font] )) {
				return $this->fonts [$font] ['stack'];
			}
		}
		return '\'' . $font . '\'';
	}
}