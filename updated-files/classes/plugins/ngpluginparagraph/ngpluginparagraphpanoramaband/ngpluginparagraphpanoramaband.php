<?php

class NGPluginParagraphPanoramaBand extends NGPluginParagraph {
	const ObjectTypePluginParagraphPanoramaBand = 'NGPluginParagraphPanoramaBand';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphPanoramaBand = "paragraphpanoramaband";

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
	public $crop = 'Ratio16by9';

	/**
	 *
	 * @var bool
	 */
	public $showcaptions = false;

	/**
	 *
	 * @var bool
	 */
	public $showlinks = false;

	/**
	 *
	 * @var array
	 */
	private $pictures;

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
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphPanoramaBand, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphPanoramaBand, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphPanoramaBand, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphPanoramaBand, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphPanoramaBand, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio16by9', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaptions', NGProperty::TypeBool, self::DomainParagraphPanoramaBand, 'showcaptions', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showlinks', NGProperty::TypeBool, self::DomainParagraphPanoramaBand, 'showlinks', NGPropertyMapped::MultiplicityScalar, false, false, false );
	}

	public function render() {
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->maxItemCount = 6;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$this->pictures = Array ();
		
		$i = 1;
		
		$crop = NGPicture::stringToRatio ( $this->crop );
		
		$count = count ( $this->bouquet->items );
		if ($count > 6)
			$count = 6;
		
		if ($count > 0) {
			
			$renderWidth = $this->renderWidth;
			
			if ($this->responsive && $this->allowAlwaysFullWidth)
				$renderWidth = 1920;
			
			if ($crop === NGPicture::RatioNone) {
				$height = floor ( $renderWidth / $count * 1.5 );
				$width = - 1;
			} else {
				$width = floor ( $renderWidth / $count );
				$height = floor ( $width / NGPicture::ratioByRatioType ( $crop ) );
			}
			
			$totalWidth = 0;
			
			foreach ( $this->bouquet->items as $item ) {
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphPanoramaBandItem ();
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $width, $height, $crop );
				$picture->size = $item->displayPicture ()->getResizedSize ( $width, $height, $crop );
				$totalWidth += $picture->size->width;
				$picture->caption = $item->displayCaption ();
				$picture->alt = $item->displayPicture ()->alt;
				$picture->link = $item->displayLink ();
				
				$this->pictures [] = $picture;
				$i ++;
				if ($i > 6)
					break;
			}
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'showcaptions', $this->showcaptions );
			$template->assign ( 'showlinks', $this->showlinks );
			$template->assign ( 'totalwidth', $totalWidth );
			$template->assign ( 'id', $this->objectUID );
			
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpanoramaband/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphPanoramaband'] = $this->prependPluginsPath ( 'ngpluginparagraphpanoramaband/css/style.css' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphPanoramaBandItem {

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
	 * Alt
	 *
	 * @var string
	 */
	public $alt;

	/**
	 *
	 * Alt
	 *
	 * @var string
	 */
	public $caption;

	/**
	 *
	 * @var NGSize
	 */
	public $size;
}