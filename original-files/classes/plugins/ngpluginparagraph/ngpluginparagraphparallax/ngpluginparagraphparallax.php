<?php

class NGPluginParagraphParallax extends NGPluginParagraph {
	const ObjectTypePluginParagraphParallax = 'NGPluginParagraphParallax';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphParallax = "paragraphparallax";

	public $pictureuid = '';

	public $offset = 50;

	public $inverse = false;

	public $framecolor = 'd3d3d3';

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphParallax, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'offset', NGProperty::TypeInt, self::DomainParagraphParallax, 'offset', NGPropertyMapped::MultiplicityScalar, false, 50, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'inverse', NGProperty::TypeBool, self::DomainParagraphParallax, 'inverse', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framecolor', NGProperty::TypeString, self::DomainParagraphParallax, 'framecolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
	}

	public function render() {
		$pictureAdapter = new NGDBAdapterObject ();
		
		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($picture != null) {
			
			$div = NGRenderTag::create ( 'div' );
			$div->class = 'ngparagraphpictureparallax';
			$div->attributes ['data-offset'] = $this->offset;
			$div->attributes ['data-inverse'] = NGUtil::boolToStringXML ( $this->inverse );
			
			if ($this->framecolor !== '') {
				$div->style->selectors ['border-color'] = '#'.$this->framecolor;
				$div->class .= ' ngparagraphpictureparallaxframed sqrsuppressborders';
			}
			
			$img = NGRenderTag::create ( 'img', true );
			
			if (NGSettingsSite::getInstance ()->lazyload) {
				$img->attributes ['src'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' );
				$img->attributes ['data-src'] = NGLink::getPictureURL ( $picture->objectUID );
				$img->class = 'nglazyload';
			} else {
				$img->attributes ['src'] = NGLink::getPictureURL ( $picture->objectUID );
			}
			$img->attributes ['width'] = $picture->widthWeb;
			$img->attributes ['height'] = $picture->heightWeb;
			$img->attributes ['alt'] = $picture->displayAlt();
			
			$div->content = $img->render ();
			
			$this->output = $div->render ();
			
			$this->javaScripts ['NGPluginParagraphParallax'] = $this->prependPluginsPath ( 'ngpluginparagraphparallax/js/parallax.js' );
			$this->styleSheets ['NGPluginParagraphParallax'] = $this->prependPluginsPath ( 'ngpluginparagraphparallax/css/style.css' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}