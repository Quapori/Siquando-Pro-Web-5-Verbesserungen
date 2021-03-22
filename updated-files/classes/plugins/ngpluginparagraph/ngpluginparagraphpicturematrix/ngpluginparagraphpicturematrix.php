<?php

class NGPluginParagraphPictureMatrix extends NGPluginParagraph {
	const ObjectTypePluginParagraphPictureMatrix = 'NGPluginParagraphPictureMatrix';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphPictureMatrix = "paragraphpicturematrix";

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
	 *
	 * Number of cols
	 * 
	 * @var int
	 */
	public $colCount = 3;

	/**
	 *
	 * Width of border
	 * 
	 * @var int
	 */
	public $borderWidth = 0;

	/**
	 *
	 * Color of border
	 * 
	 * @var string
	 */
	public $borderColor = 'd3d3d3';

	/**
	 *
	 * Maximum row count
	 * 
	 * @var int
	 */
	public $maxRowCount = 0;

	/**
	 *
	 * Bouquet to use
	 * 
	 * @var NGBouquet
	 */
	private $bouquet;

	/**
	 *
	 * Loaded pictures
	 * 
	 * @var Array
	 */
	private $pictures = Array ();

	/**
	 *
	 * Multipages
	 * 
	 * @var bool
	 */
	public $multipage = true;

	/**
	 *
	 * First multipage color
	 * 
	 * @var string
	 */
	public $multipagecolora = 'ffffff';

	/**
	 *
	 * Second multiplage color
	 * 
	 * @var string
	 */
	public $multipagecolorb = '666666';

	/**
	 *
	 * Calculated with
	 * 
	 * @var int
	 */
	private $pictureWidth;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphPictureMatrix, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colcount', NGProperty::TypeInt, self::DomainParagraphPictureMatrix, 'colCount', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'borderwidth', NGProperty::TypeInt, self::DomainParagraphPictureMatrix, 'borderWidth', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bordercolor', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'borderColor', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maxrowcount', NGProperty::TypeInt, self::DomainParagraphPictureMatrix, 'maxRowCount', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'multipage', NGProperty::TypeBool, self::DomainParagraphPictureMatrix, 'multipage', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'multipagecolora', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'multipagecolora', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'multipagecolorb', NGProperty::TypeString, self::DomainParagraphPictureMatrix, 'multipagecolorb', NGPropertyMapped::MultiplicityScalar, false, '666666', false );
	}

	public function render() {
		$maxItems = $this->maxRowCount * $this->colCount;
		$this->pictureWidth = floor ( $this->renderWidth / $this->colCount ) - 2 * $this->borderWidth;
		
		if ($this->responsive && $this->pictureWidth<768) $this->pictureWidth=768;
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		if (! $this->multipage)
			$this->bouquet->maxItemCount = $maxItems;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$this->pictures = Array ();
		
		$i = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphPictureMatrixItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
			
			if (NGSettingsSite::getInstance ()->lazyload && NGSettingsSite::getInstance ()->hdpictures) {
				$picture->sourcehd = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->pictureWidth * 2, $this->pictureWidth * 2, NGPicture::Ratio1by1 );
			}
			
			$picture->link = $item->displayLink ();
			$picture->caption = $item->displayCaption ();
			$picture->alt = $item->displayPicture ()->alt;
			if ($maxItems > 0) {
				$picture->visible = $i < $maxItems;
			} else {
				$picture->visible = true;
			}
			$this->pictures [] = $picture;
			
			$i ++;
		}
		
		$template = new NGTemplate ();
		if (NGSettingsSite::getInstance ()->lazyload)
			$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
		
		$template->assign ( 'id', $this->objectUID );
		$template->assign ( 'pictures', $this->pictures );
		$template->assign ( 'width', $this->pictureWidth );
		$template->assign ( 'cols', $this->colCount );
		$template->assign ( 'borderwidth', $this->borderWidth );
		$template->assign ( 'bordercolor', $this->borderColor );
		$template->assign ( 'responsive', $this->responsive );
		
		if ($maxItems > 0) {
			$template->assign ( 'pagecount', ceil ( count ( $this->pictures ) / $maxItems ) );
		} else {
			$template->assign ( 'pagecount', 0 );
		}
		$template->assign ( 'maxitems', $maxItems );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpicturematrix/tpl/template.tpl' );
		
		$this->styleSheets ['NGPluginParagraphPictureMatrix'] = $this->prependPluginsPath ( 'ngpluginparagraphpicturematrix/css/style.css' );
		
		if ($this->multipage) {
			$this->javaScripts ['NGPluginParagraphPictureMatrix'] = $this->prependPluginsPath ( 'ngpluginparagraphpicturematrix/js/picturematrix.js' );
			
			$templateStyle = new NGTemplate ();
			
			$templateStyle->assign ( 'colora', $this->multipagecolora );
			$templateStyle->assign ( 'colorb', $this->multipagecolorb );
			
			$this->styles ['NGPluginParagraphPictureMatrix'.$this->objectUID] = $templateStyle->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpicturematrix/tpl/style.tpl' );
		}
	}
}

class NGPluginParagraphPictureMatrixItem {

	/**
	 *
	 * Source of picture
	 * 
	 * @var string
	 */
	public $source;

	/**
	 *
	 * Source of hd picture
	 * 
	 * @var unknown_type
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

	/**
	 *
	 * Item is visible ...
	 * 
	 * @var bool
	 */
	public $visible;
}