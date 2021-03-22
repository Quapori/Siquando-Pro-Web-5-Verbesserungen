<?php

class NGPluginParagraphCarousel extends NGPluginParagraph {
	const ObjectTypePluginParagraphCarousel = 'NGPluginParagraphCarousel';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphCarousel = "paragraphcarousel";

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
	 * PArent UID
	 * 
	 * @var string
	 */
	public $itemsParentUID = '';

	/**
	 *
	 * Delay between frames
	 * 
	 * @var int
	 */
	public $delay = 5;

	/**
	 *
	 * Number of items
	 * 
	 * @var string
	 */
	public $maxitems = 10;

	/**
	 *
	 * Draw a relfection
	 * 
	 * @var bool
	 */
	public $reflection = true;

	private $size;

	private $sizezoom;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphCarousel, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphCarousel, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphCarousel, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphCarousel, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphCarousel, 'delay', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maxitems', NGProperty::TypeInt, self::DomainParagraphCarousel, 'maxitems', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'reflection', NGProperty::TypeBool, self::DomainParagraphCarousel, 'reflection', NGPropertyMapped::MultiplicityScalar, false, true, false );
	}

	public function render() {
		$this->size = 320;
		$this->sizezoom = 480;
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		$this->bouquet->maxItemCount = $this->maxitems;
		
		$this->bouquet->prepare ();
		
		$this->pictures = Array ();
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphCarouselItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->sizezoom, $this->sizezoom );
			$picture->link = $item->displayLink ();
			$picture->caption = $item->displayCaption ();
			$picture->alt = $item->displayPicture ()->alt;
			$picture->size = $item->displayPicture ()->getResizedSize ( $this->size, $this->size );
			
			$this->pictures [] = $picture;
		}
		
		$template = new NGTemplate ();
		
		$template->assign ( 'pictures', $this->pictures );
		$template->assign ( 'delay', strtolower ( $this->delay ) );
		$template->assign ( 'reflection', $this->reflection );
		$template->assign ( 'id', $this->objectUID );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphcarousel/tpl/template.tpl' );
		
		$this->styleSheets ['NGPluginParagraphCarousel'] = $this->prependPluginsPath ( 'ngpluginparagraphcarousel/css/style.css' );
		$this->javaScripts ['NGPluginParagraphCarousel'] = $this->prependPluginsPath ( 'ngpluginparagraphcarousel/js/carousel.js' );
		
		if ($this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		
	}
}

class NGPluginParagraphCarouselItem {

	/**
	 *
	 * Source of picture
	 * 
	 * @var string
	 */
	public $source;

	/**
	 *
	 * Link
	 * 
	 * @var NGLink
	 */
	public $link;

	/**
	 *
	 * Caption
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
	 *
	 * Size of Picture
	 * 
	 * @var NGSize
	 */
	public $size;
}