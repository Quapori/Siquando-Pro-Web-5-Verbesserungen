<?php

class NGPluginParagraphTextSlider extends NGPluginParagraph {
	const ObjectTypePluginParagraphTextSlider = 'NGPluginParagraphTextSlider';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTextSlider = "paragraphtextslider";

	public $items = array ();

	public $navstyle = 'default';

	public $colorbackground = '333333';

	public $colorforeground = 'ffffff';

	public $colorframe = '';

	public $paddingtopbottom = 2;

	public $paddingleftright = 10;

	public $dynamicheight = true;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTextSlider, 'items', NGPropertyMapped::MultiplicityList, true, null, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navstyle', NGProperty::TypeString, self::DomainParagraphTextSlider, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphTextSlider, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '333333', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorforeground', NGProperty::TypeString, self::DomainParagraphTextSlider, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphTextSlider, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'dynamicheight', NGProperty::TypeBool, self::DomainParagraphTextSlider, 'dynamicheight', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddingtopbottom', NGProperty::TypeInt, self::DomainParagraphTextSlider, 'paddingtopbottom', NGPropertyMapped::MultiplicityScalar, false, 2, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddingleftright', NGProperty::TypeInt, self::DomainParagraphTextSlider, 'paddingleftright', NGPropertyMapped::MultiplicityScalar, false, 10, false );
	}

	public function render() {
		$richText = new NGRichText ();
		$richText->previewMode = $this->previewMode;
		
		if (count ( $this->items ) > 1) {
			
			$template = new NGTemplate ();
			
			$items = [ ];
			
			foreach ( $this->items as $item ) {
				$items [] = $richText->parse ( $item );
			}
			
			$template->assign ( 'items', $items );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'paddingtopbottom', $this->paddingtopbottom );
			$template->assign ( 'paddingleftright', $this->paddingleftright );
			$template->assign ( 'colorbackground', $this->colorbackground );
			$template->assign ( 'colorforeground', $this->colorforeground );
			$template->assign ( 'colorframe', $this->colorframe );
			$template->assign ( 'dynamicheight', NGUtil::boolToStringXML ( $this->dynamicheight ) );
			$template->assign ( 'bullet', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphtextslider/styles/img/?f=%s&c=%s', $this->navstyle, $this->colorforeground ) ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtextslider/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphTextSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphtextslider/css/style.css' );
			$this->javaScripts ['NGPluginParagraphTextSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphtextslider/js/textslider.js' );
			$this->styles ['NGPluginParagraphTextSlider' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtextslider/tpl/style.tpl' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}

	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}