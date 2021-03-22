<?php

class NGPluginParagraphIFrame extends NGPluginParagraph {
	const ObjectTypePluginParagraphIFrame = 'NGPluginParagraphIFrame';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphIFrame = 'paragraphiframe';

	public $url = '';

	public $height = 200;

	public $frameborderwidth = 1;

	public $framebordercolor = 'd3d3d3';

	public $scrolling = 'auto';

	public $panorama = NGPluginParagraph::RenderModeAlwaysBoxed;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'url', NGProperty::TypeText, self::DomainParagraphIFrame, 'url', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'height', NGProperty::TypeInt, self::DomainParagraphIFrame, 'height', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'frameborderwidth', NGProperty::TypeInt, self::DomainParagraphIFrame, 'frameborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framebordercolor', NGProperty::TypeString, self::DomainParagraphIFrame, 'framebordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'scrolling', NGProperty::TypeString, self::DomainParagraphIFrame, 'scrolling', NGPropertyMapped::MultiplicityScalar, false, 'auto', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeString, self::DomainParagraphIFrame, 'panorama', NGPropertyMapped::MultiplicityScalar, false, NGPluginParagraph::RenderModeAlwaysBoxed, false );
	}

	public function render() {
		if ($this->url !== '') {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'width', $this->responsive ? '100%' : $this->renderWidth . 'px' );
			$template->assign ( 'height', $this->height );
			$template->assign ( 'url', $this->url );
			$template->assign ( 'frameborderwidth', $this->frameborderwidth );
			$template->assign ( 'framebordercolor', $this->framebordercolor );
			$template->assign ( 'scrolling', $this->scrolling );
			$template->assign ( 'responsive', $this->responsive );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphiframe/tpl/layout.tpl' );
			
			if (($this->panorama === NGPluginParagraph::RenderModeMobileFullWidth || $this->panorama === NGPluginParagraph::RenderModeAlwaysFullWidth) && $this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->panorama === NGPluginParagraph::RenderModeAlwaysFullWidth && $this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}