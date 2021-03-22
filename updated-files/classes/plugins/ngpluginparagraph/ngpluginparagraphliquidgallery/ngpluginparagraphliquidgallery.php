<?php

class NGPluginParagraphLiquidGallery extends NGPluginParagraph {
	const ObjectTypePluginParagraphLiquidGallery = 'NGPluginParagraphLiquidGallery';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphLiquidGallery = "paragraphliquidgallery";

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

	public $captions = true;

	public $panorama = true;

	public $gutter = 10;

	public $size = '200';

	/**
	 *
	 * Bouquet
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
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphLiquidGallery, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphLiquidGallery, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphLiquidGallery, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphLiquidGallery, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captions', NGProperty::TypeBool, self::DomainParagraphLiquidGallery, 'captions', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeBool, self::DomainParagraphLiquidGallery, 'panorama', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'gutter', NGProperty::TypeInt, self::DomainParagraphLiquidGallery, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'size', NGProperty::TypeString, self::DomainParagraphLiquidGallery, 'size', NGPropertyMapped::MultiplicityScalar, false, '200', false );
	}

	public function render() {
		$width = $this->renderWidth;
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		// $this->bouquet->maxItemCount = $this->maxitems;
		
		$this->bouquet->prepare ();
		
		if (count ( $this->bouquet->items ) > 2) {
			
			$this->pictures = Array ();
			
			foreach ( $this->bouquet->items as $item ) {
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphLiquidGalleryItem ();
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, 768, - 1 );
				$picture->link = $item->displayLink ();
				$picture->caption = $item->displayCaption ();
				$picture->size = $item->displayPicture ()->getResizedSize ( - 1, 768 );
				
				$this->pictures [] = $picture;
			}
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'panorama', $this->panorama );
			$template->assign ( 'gutter', $this->gutter );
			$template->assign ( 'size', $this->size );
			$template->assign ( 'captions', $this->captions );
			$template->assign ( 'uid', $this->objectUID );
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphliquidgallery/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphLiquidGallery'] = $this->prependPluginsPath ( 'ngpluginparagraphliquidgallery/css/style.css' );
			$this->javaScripts ['NGPluginParagraphLiquidGallery'] = $this->prependPluginsPath ( 'ngpluginparagraphliquidgallery/js/liquidgallery.js' );
			$this->styles ['NGLiquidGallery'.$this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphliquidgallery/tpl/style.tpl' );
				
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth && $this->panorama)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphLiquidGalleryItem {

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