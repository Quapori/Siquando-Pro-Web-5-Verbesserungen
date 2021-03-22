<?php

class NGPluginParagraphPHP extends NGPluginParagraph {
	const ObjectTypePluginParagraphPHP = 'NGPluginParagraphPHP';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphPHP = "paragraphphp";

	public $code = '';

	public $cache = '';

	public $panorama = NGPluginParagraph::RenderModeAlwaysBoxed;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'code', NGProperty::TypeText, self::DomainParagraphPHP, 'code', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cache', NGProperty::TypeString, self::DomainParagraphPHP, 'cache', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeString, self::DomainParagraphPHP, 'panorama', NGPropertyMapped::MultiplicityScalar, false, NGPluginParagraph::RenderModeAlwaysBoxed, false );
	}

	public function render() {
		if (substr ( $this->code, 0, 5 ) === '<?php')
			$this->code = substr ( $this->code, 5 );
		if (substr ( $this->code, 0, 2 ) === '<?')
			$this->code = substr ( $this->code, 2 );
		if (substr ( $this->code, - 2 ) === '?>')
			$this->code = substr ( $this->code, 0, - 2 );
		
		ob_start ();
		
		try {
			
			eval ( $this->code );
			$this->output = ob_get_contents ();
		} catch ( Exception $ex ) {
		}
		ob_end_clean ();
		
		switch ($this->cache) {
			case 'never' :
				break;
			case 'minutely' :
				$this->nextScheduledChange = date ( 'Y-m-d\TH:i:sP', time () + 60 );
				break;
			case 'hourly' :
				$this->nextScheduledChange = date ( 'Y-m-d\TH:i:sP', time () + 60 * 60 );
				break;
			case 'daily' :
				$this->nextScheduledChange = date ( 'Y-m-d\TH:i:sP', time () + 24 * 60 * 60 );
				break;
			default :
				$this->dontCache = true;
				break;
		}
		
		if (($this->panorama === NGPluginParagraph::RenderModeMobileFullWidth || $this->panorama === NGPluginParagraph::RenderModeAlwaysFullWidth) && $this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		if ($this->panorama === NGPluginParagraph::RenderModeAlwaysFullWidth && $this->allowAlwaysFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
	}
}