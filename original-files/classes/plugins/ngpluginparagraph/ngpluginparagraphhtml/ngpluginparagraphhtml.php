<?php

class NGPluginParagraphHTML extends NGPluginParagraph {
	const ObjectTypePluginParagraphHTML = 'NGPluginParagraphHTML';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphHTML = "paragraphhtml";

	public $html = '';

	public $panorama = NGPluginParagraph::RenderModeAlwaysBoxed;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'html', NGProperty::TypeText, self::DomainParagraphHTML, 'html', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeString, self::DomainParagraphHTML, 'panorama', NGPropertyMapped::MultiplicityScalar, false, NGPluginParagraph::RenderModeAlwaysBoxed, false );
	}

	public function render() {
		$this->output = $this->html;
		
		if (($this->panorama === NGPluginParagraph::RenderModeMobileFullWidth || $this->panorama=== NGPluginParagraph::RenderModeAlwaysFullWidth) && $this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		if ($this->panorama === NGPluginParagraph::RenderModeAlwaysFullWidth && $this->allowAlwaysFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
	}
}