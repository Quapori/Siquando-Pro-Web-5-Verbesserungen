<?php

class NGPluginParagraphTouchSlider extends NGPluginParagraph {
	const ObjectTypePluginParagraphTouchSlider = 'NGPluginParagraphTouchSlider';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTouchSlider = "paragraphtouchslider";

	/**
	 *
	 * Sortmode for bouquet
	 *
	 * @var string
	 */
	public $sortMode = '';

	/**
	 *
	 * Source for bouquet
	 *
	 * @var string
	 */
	public $itemsSource = '';

	/**
	 *
	 * Found items
	 *
	 * @var string
	 */
	public $items;

	/**
	 *
	 * Parent UID
	 *
	 * @var string
	 */
	public $itemsParentUID = '';

	/**
	 * Crop ratio
	 *
	 * @var string
	 */
	public $crop = 'Ratio4by3';

	/**
	 *
	 * Panoramic display
	 *
	 * @var bool
	 */
	public $panorama = false;

	/**
	 *
	 * Show the nav
	 *
	 * @var bool
	 */
	public $shownav = true;

	/**
	 *
	 * nav style
	 *
	 * @var string
	 *
	 */
	public $navstyle = 'default';

	/**
	 *
	 * Color A
	 *
	 * @var string
	 */
	public $colora = '555555';

	/**
	 *
	 * Color B
	 *
	 * @var string
	 */
	public $colorb = '555555';

	/**
	 *
	 * Color of frame
	 *
	 * @var string
	 */
	public $colorframe = '';

	/**
	 *
	 * @var array
	 */
	private $pictures = array ();
	
	/**
	 * 
	 * @var NGBouquet
	 */
	private $bouquet;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTouchSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio4by3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeBool, self::DomainParagraphTouchSlider, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'shownav', NGProperty::TypeBool, self::DomainParagraphTouchSlider, 'shownav', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navstyle', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colora', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'colora', NGPropertyMapped::MultiplicityScalar, false, '555555', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorb', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'colorb', NGPropertyMapped::MultiplicityScalar, false, '555555', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}

	public function render() {
		$width = $this->renderWidth;
		
		if ($this->panorama && $this->responsive)
			$width = 1920;
		
		$ratioType = NGPicture::stringToRatio ( $this->crop );
		$ratio = NGPicture::ratioByRatioType ( $ratioType );
		
		$height = floor ( $width / $ratio );
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->maxItemCount = 10;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$this->pictures = Array ();
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphTouchSliderItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $width, $height, $ratioType );
			
			$picture->alt = $item->displayPicture ()->alt;
			
			$this->pictures [] = $picture;
		}
		
		if (count ( $this->pictures ) > 1) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'width', $width );
			$template->assign ( 'height', $height );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'colorframe', $this->colorframe );
			$template->assign ( 'shownav', NGUtil::boolToStringXML ( $this->shownav ) );
			$template->assign ( 'bullet', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphtouchslider/styles/img/?f=%s&ca=%s&cb=%s', $this->navstyle, $this->colora, $this->colorb ) ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtouchslider/tpl/template.tpl' );
			
			$this->styles ['NGPluginParagraphTouchSlider' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtouchslider/tpl/style.tpl' );
			
			$this->styleSheets ['NGPluginParagraphTouchSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphtouchslider/css/style.css' );
			$this->javaScripts ['NGPluginParagraphTouchSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphtouchslider/js/touchslider.js' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth && $this->panorama)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphTouchSliderItem {

	/**
	 *
	 * Source of picture
	 *
	 * @var string
	 */
	public $source;

	/**
	 *
	 * Alt
	 *
	 * @var string
	 */
	public $alt;
}