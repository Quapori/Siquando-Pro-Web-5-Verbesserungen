<?php

class NGPluginParagraphTwoInOneGallery extends NGPluginParagraph {
	const ObjectTypePluginParagraphtwoInOneGallery = 'NGPluginParagraphTwoInOneGallery';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTwoInOneGallery = "paragraphtwoinonegallery";

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

	public $columns = 6;

	public $colorcontrols = '808080';

	public $colorborder = 'd3d3d3';

	public $colorbackground = 'ffffff';

	/**
	 *
	 * Bouquet
	 *
	 * @var NGBouquet
	 */
	private $bouquet;

	/**
	 *
	 * Language resources
	 * 
	 * @var NGLanguageAdapter
	 */
	private $lang;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTwoInOneGallery, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'columns', NGProperty::TypeInt, self::DomainParagraphTwoInOneGallery, 'columns', NGPropertyMapped::MultiplicityScalar, false, 6, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorcontrols', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'colorcontrols', NGPropertyMapped::MultiplicityScalar, false, '808080', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorborder', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'colorborder', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphTwoInOneGallery, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
	}

	public function render() {
		$width = ceil ( $this->renderWidth / $this->columns );
		
		if ($this->responsive) {
			if ($width<192) $width=192;
		}
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		if (count ( $this->bouquet->items ) > 0) {
			
			$this->pictures = Array ();
			
			foreach ( $this->bouquet->items as $item ) {
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphTwoInOneGalleryItem ();
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $width, $width, NGPicture::Ratio1by1 );
				
				if (NGSettingsSite::getInstance ()->lazyload && NGSettingsSite::getInstance ()->hdpictures) {
					$picture->sourcehd = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $width * 2, $width * 2, NGPicture::Ratio1by1 );
				}
				
				$picture->link = $item->displayLink ();
				$picture->caption = $item->displayCaption ();
				
				$this->pictures [] = $picture;
			}
			
			$this->lang = new NGLanguageAdapter ();
			$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphtwoinonegallery/language/langtwoinonegallery.xml';
			$this->lang->load ();
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'width', $width );
			$template->assign ( 'columns', $this->columns );
			$template->assign ( 'columnsmobile', $this->responsive ? min ( 4, $this->columns ) : $this->columns );
			
			$template->assign ( 'color', $this->colorcontrols );
			$template->assign ( 'border', $this->colorborder );
			$template->assign ( 'background', $this->colorbackground );
			$template->assign ( 'svg', $this->prependPluginsPath ( 'ngpluginparagraphtwoinonegallery/img/' ) );
			$template->assign ( 'lang', $this->lang->languageResources );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtwoinonegallery/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphTwoInOneGallery'] = $this->prependPluginsPath ( 'ngpluginparagraphtwoinonegallery/css/style.css' );
			$this->javaScripts ['NGPluginParagraphTwoInOneGallery'] = $this->prependPluginsPath ( 'ngpluginparagraphtwoinonegallery/js/twoinonegallery.js' );
			$this->styles ['NGPluginParagraphTwoInOneGallery' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtwoinonegallery/tpl/style.tpl' );
		}
	}
}

class NGPluginParagraphTwoInOneGalleryItem {

	/**
	 *
	 * Source of picture
	 *
	 * @var string
	 */
	public $source;

	/**
	 *
	 * Source of picture
	 *
	 * @var string
	 */
	public $sourcehd;

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
}