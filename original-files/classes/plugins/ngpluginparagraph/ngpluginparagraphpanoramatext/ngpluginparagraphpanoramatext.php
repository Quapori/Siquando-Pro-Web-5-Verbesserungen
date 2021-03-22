<?php

class NGPluginParagraphPanoramaText extends NGPluginParagraph {
	const ObjectTypePluginParagraphPanoramaText = 'NGPluginParagraphPanoramaText';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphPanoramaText = "paragraphpanoramatext";

	public $text = '';

	public $colorbackground = '555555';

	public $colorforeground = 'ffffff';

	public $colorframe = '';
	
	public $textpaddingtopbottom = 5;

	public $textpaddingleftright = 0;
	
	public $fadeeffect='';

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'text', NGProperty::TypeText, self::DomainParagraphPanoramaText, 'text', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphPanoramaText, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '555555', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorforeground', NGProperty::TypeString, self::DomainParagraphPanoramaText, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphPanoramaText, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'textpaddingtopbottom', NGProperty::TypeInt, self::DomainParagraphPanoramaText, 'textpaddingtopbottom', NGPropertyMapped::MultiplicityScalar, false, 5, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'textpaddingleftright', NGProperty::TypeInt, self::DomainParagraphPanoramaText, 'textpaddingleftright', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fadeeffect', NGProperty::TypeString, self::DomainParagraphPanoramaText, 'fadeeffect', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}

	public function render() {
		$richText = new NGRichText ();
		$template = new NGTemplate ();
		$template->assign ( 'text', $richText->parse ( $this->text ) );
		$template->assign ( 'uid', $this->objectUID );
		$template->assign ( 'colorbackground', $this->colorbackground );
		$template->assign ( 'colorforeground', $this->colorforeground );
		$template->assign ( 'colorframe', $this->colorframe );
		$template->assign ( 'fadeeffect', $this->fadeeffect );
		$template->assign ( 'textpaddingtopbottom', $this->textpaddingtopbottom );
		$template->assign ( 'textpaddingleftright', $this->textpaddingleftright );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpanoramatext/tpl/template.tpl' );
		
		$this->styleSheets ['NGPluginParagraphPanoramaText'] = $this->prependPluginsPath ( 'ngpluginparagraphpanoramatext/css/style.css' );
		$this->javaScripts ['NGPluginParagraphPanoramaText'] = $this->prependPluginsPath ( 'ngpluginparagraphpanoramatext/js/panoramatext.js' );
		$this->styles ['NGPluginParagraphPanoramaText' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpanoramatext/tpl/style.tpl' );
		
		if ($this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		if ($this->allowAlwaysFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
	}

	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}