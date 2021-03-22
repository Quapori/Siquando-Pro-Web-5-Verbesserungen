<?php

class NGPluginParagraphFlowSlider extends NGPluginParagraph {
	const ObjectTypePluginParagraphFlowSlider = 'NGPluginParagraphFlowSlider';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphFlowSlider = "paragraphflowslider";

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
	 * Show the nav
	 *
	 * @var bool
	 */
	public $showbullets = true;

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
	 * Color of frame
	 *
	 * @var string
	 */
	public $colorframe = '';

	/**
	 *
	 * @var bool
	 */
	public $darkmode = false;

	/**
	 *
	 * @var bool
	 */
	public $sizetoscreen = true;

	/**
	 *
	 * @var integer
	 */
	public $delay = 5;

	/**
	 *
	 * @var integer
	 */
	public $heightpercent = 90;

	/**
	 *
	 * @var bool
	 */
	public $showcaptions = true;

	/**
	 *
	 * @var array
	 */
	private $pictures = array ();

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphFlowSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio4by3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'shownav', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'shownav', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showbullets', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'showbullets', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaptions', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'showcaptions', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'darkmode', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'darkmode', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sizetoscreen', NGProperty::TypeBool, self::DomainParagraphFlowSlider, 'sizetoscreen', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphFlowSlider, 'delay', NGPropertyMapped::MultiplicityScalar, false, 5, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'heightpercent', NGProperty::TypeInt, self::DomainParagraphFlowSlider, 'heightpercent', NGPropertyMapped::MultiplicityScalar, false, 90, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navstyle', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphFlowSlider, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}

	public function render() {
		$width = $this->renderWidth;
		
		if ($this->panorama && $this->responsive)
			$width = 1920;
		
		$ratioType = NGPicture::stringToRatio ( $this->crop );
		$ratio = NGPicture::ratioByRatioType ( $ratioType );
		$height = floor ( $width / $ratio );
		
		if ($this->sizetoscreen) {
			$ratioType = NGPicture::RatioNone;
			$width = - 1;
			$height = - 1;
		}
		
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
			$picture = new NGPluginParagraphFlowSliderItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $width, $height, $ratioType );
			$picture->size = $item->displayPicture ()->getResizedSize ( $width, $height, $ratioType );
			$picture->alt = $item->displayPicture ()->alt;
			if ($this->showcaptions)
				$picture->caption = $item->displayCaption ();
			
			$this->pictures [] = $picture;
		}
		
		if (count ( $this->pictures ) > 1) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'width', $width );
			$template->assign ( 'height', $height );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'colorframe', $this->colorframe );
			$template->assign ( 'shownav', $this->shownav );
			$template->assign ( 'showbullets', $this->showbullets );
			$template->assign ( 'heightpercent', $this->heightpercent );
			$template->assign ( 'sizetoscreen', $this->sizetoscreen ? 'fill' : 'fixed' );
			$template->assign ( 'darkmode', $this->darkmode ? 'd' : 'b' );
			$template->assign ( 'delay', $this->delay );
			$template->assign ( 'next', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphflowslider/styles/img/?f=%s_next&ca=%s&cb=%s', $this->navstyle, $this->darkmode ? 'ffffff' : '000000', $this->darkmode ? '000000' : 'ffffff' ) ) );
			$template->assign ( 'prev', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphflowslider/styles/img/?f=%s_prev&ca=%s&cb=%s', $this->navstyle, $this->darkmode ? 'ffffff' : '000000', $this->darkmode ? '000000' : 'ffffff' ) ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphflowslider/tpl/template.tpl' );
			
			$this->styles ['NGPluginParagraphFlowSlider' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphflowslider/tpl/style.tpl' );
			
			$this->styleSheets ['NGPluginParagraphFlowSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphflowslider/css/style.css' );
			$this->javaScripts ['NGPluginParagraphFlowSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphflowslider/js/flowslider.js' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth && $this->panorama)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphFlowSliderItem {

	/**
	 *
	 * Source of picture
	 *
	 * @var string
	 */
	public $source;

	/**
	 *
	 * @var string
	 */
	public $caption;

	/**
	 *
	 * Alt
	 *
	 * @var string
	 */
	public $alt;

	/**
	 * *
	 *
	 * @var NGSize
	 */
	public $size;
}