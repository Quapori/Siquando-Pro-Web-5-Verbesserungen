<?php

class NGPluginParagraphCascade extends NGPluginParagraph {
	const ObjectTypePluginParagraphCascade = 'NGPluginParagraphCascade';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphCascade = "paragraphcascade";

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
	public $colcount = 5;

	/**
	 *
	 * Gutter between cols
	 * 
	 * @var int
	 */
	public $gutter = 20;

	/**
	 *
	 * Show caption
	 * 
	 * @var bool
	 */
	public $showcaption = true;

	/**
	 *
	 * Show summary
	 * 
	 * @var bool
	 */
	public $showsummary = true;

	/**
	 *
	 * Color of border
	 * 
	 * @var string
	 */
	public $picturebordercolor = '';

	/**
	 *
	 * Bouquet to use
	 * 
	 * @var NGBouquet
	 */
	private $bouquet;

	/**
	 *
	 * Enter description here ...
	 * 
	 * @var Array
	 */
	private $cascades = Array ();

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphCascade, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphCascade, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphCascade, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphCascade, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colcount', NGProperty::TypeInt, self::DomainParagraphCascade, 'colcount', NGPropertyMapped::MultiplicityScalar, false, 5, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'gutter', NGProperty::TypeInt, self::DomainParagraphCascade, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 20, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaption', NGProperty::TypeBool, self::DomainParagraphCascade, 'showcaption', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showsummary', NGProperty::TypeBool, self::DomainParagraphCascade, 'showsummary', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'picturebordercolor', NGProperty::TypeString, self::DomainParagraphCascade, 'picturebordercolor', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}

	/**
	 * Get smallest cascade
	 * 
	 * @return NGPluginParagraphCasaceCascade
	 */
	private function getSmallestCascade() {
		/* @var $result NGPluginParagraphCasaceCascade */
		$result = null;
		
		foreach ( $this->cascades as $cascade ) {
			/* @var $cascade NGPluginParagraphCasaceCascade */
			if ($result === null) {
				$result = $cascade;
			} else {
				if ($cascade->getTotalHeight ( $this->gutter ) < $result->getTotalHeight ( $this->gutter ))
					$result = $cascade;
			}
		}
		
		return $result;
	}

	private function getTotalWidth() {
		$result = 0;
		
		foreach ( $this->cascades as $cascade ) {
			/* @var $cascade NGPluginParagraphCasaceCascade */
			$result += $cascade->width;
		}
		
		$result += $this->gutter * ($this->colcount - 1);
		
		return $result;
	}

	public function render() {
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$richtext = new NGRichText ();
		$richtext->previewMode = $this->previewMode;
		
		$renderWidth = $this->renderWidth;
				
		$width = intval ( (($renderWidth - ($this->gutter * ($this->colcount - 1))) / $this->colcount), 0 );
		
		if ($width > 10) {
			
			for($i = 0; $i < $this->colcount; $i ++) {
				$cascade = new NGPluginParagraphCasaceCascade ();
				$cascade->width = $width;
				$this->cascades [] = $cascade;
			}
			
			foreach ( $this->cascades as $cascade ) {
				if ($this->getTotalWidth () > $renderWidth) {
					$cascade->width --;
				}
				if ($this->getTotalWidth () < $renderWidth) {
					$cascade->width ++;
				}
			}
			
			foreach ( $this->bouquet->items as $item ) {
				
				$cascade = $this->getSmallestCascade ();
				
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphCascadePicture ();
				
				$size = $item->displayPicture ()->getResizedSize ( $cascade->width - ($this->picturebordercolor == '' ? 0 : 2) );
				
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $size->width, $size->height );
				
				if (NGSettingsSite::getInstance ()->lazyload && NGSettingsSite::getInstance ()->hdpictures) {
					$picture->sourcehd = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $size->width * 2, $size->height * 2 );
				}
				
				$picture->link = $item->displayLink ();
				$picture->margintop = $this->gutter;
				if ($this->showcaption)
					$picture->caption = $item->displayCaption ();
				if ($this->showsummary)
					$picture->summary = $richtext->parse ( $item->displaySummary () );
				$picture->alt = $item->displayPicture ()->alt;
				$picture->title = $item->displayPicture ()->title;
				
				$picture->width = $size->width;
				$picture->height = $size->height;
				
				$cascade->pictures [] = $picture;
			}
			
			$template = new NGTemplate ();
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'cascades', $this->cascades );
			$template->assign ( 'gutter', $this->gutter );
			$template->assign ( 'width', $renderWidth );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphcascade/tpl/template.tpl' );
			
			$styleTemplate = new NGTemplate ();
			$styleTemplate->assign ( 'id', $this->objectUID );
			$styleTemplate->assign ( 'gutter', $this->gutter / $renderWidth * 100 * $this->colcount );
			$styleTemplate->assign ( 'bordercolor', $this->picturebordercolor );
			
			$this->styles ['NGPluginParagraphCascade' . $this->objectUID] = $styleTemplate->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphcascade/tpl/style.tpl' );
			$this->styleSheets ['NGPluginParagraphCascade'] = $this->prependPluginsPath ( 'ngpluginparagraphcascade/css/style.css' );
		}
	}
}

class NGPluginParagraphCasaceCascade {

	public $width;

	public $pictures = Array ();

	public function getTotalHeight($gutter) {
		$totalheight = 0;
		
		foreach ( $this->pictures as $picture ) {
			/* @var $picture NGPluginParagraphCascadePicture */
			
			$totalheight += $picture->height + $gutter;
		}
		
		return $totalheight;
	}
}

class NGPluginParagraphCascadePicture {

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
	public $caption = '';

	/**
	 *
	 * Summary
	 * 
	 * @var string
	 */
	public $summary = '';

	/**
	 *
	 * Alt
	 * 
	 * @var string
	 */
	public $alt = '';

	/**
	 *
	 * Title
	 * 
	 * @var string
	 */
	public $title = '';

	/**
	 *
	 * width
	 * 
	 * @var int
	 */
	public $width;

	/**
	 *
	 * height
	 * 
	 * @var int
	 */
	public $height;
}