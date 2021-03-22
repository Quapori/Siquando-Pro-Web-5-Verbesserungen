<?php

class NGPluginParagraphBanner extends NGPluginParagraph {
	const ObjectTypePluginParagraphBanner = 'NGPluginParagraphBanner';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphBanner = "paragraphbanner";

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
	 * Gutter between cols
	 * 
	 * @var int
	 */
	public $gutter = 3;

	/**
	 *
	 * How to crop the banners
	 * 
	 * @var string
	 */
	public $cropratio = 'Ratio4by3';

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
	public $itemcount = 3;

	/**
	 *
	 * Fade mode
	 * 
	 * @var string
	 */
	public $fademode = 'CrossFade';

	/**
	 *
	 * Orentation
	 * 
	 * @var string
	 */
	public $orientation = 'Horizontal';

	private $widthone;

	private $widthall;

	private $heightone;

	private $heightall;

	private $cropratiovalue;

	private $pictures;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphBanner, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphBanner, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphBanner, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphBanner, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'gutter', NGProperty::TypeInt, self::DomainParagraphBanner, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphBanner, 'delay', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemcount', NGProperty::TypeInt, self::DomainParagraphBanner, 'itemcount', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'orientation', NGProperty::TypeString, self::DomainParagraphBanner, 'orientation', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cropratio', NGProperty::TypeString, self::DomainParagraphBanner, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fademode', NGProperty::TypeString, self::DomainParagraphBanner, 'fademode', NGPropertyMapped::MultiplicityScalar, false, 'CrossFade', false );
	}

	private function totalGutter() {
		return ($this->itemcount - 1) * $this->gutter;
	}

	public function render() {
		$width = $this->renderWidth;
				
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$this->cropratiovalue = NGPicture::ratioByRatioType ( NGPicture::stringToRatio ( $this->cropratio ) );
		
		if ($this->orientation === 'Horizontal') {
			$this->widthone = floor ( ($width - $this->totalGutter ()) / $this->itemcount );
			$this->widthall = $this->widthone * $this->itemcount + $this->totalGutter ();
			$this->heightone = floor ( $this->widthone / $this->cropratiovalue );
			$this->heightall = $this->heightone;
		} else {
			$this->widthone = $width;
			$this->widthall = $width;
			$this->heightone = floor ( $this->widthone / $this->cropratiovalue );
			$this->heightall = $this->heightone * $this->itemcount + $this->totalGutter ();
		}
		
		$this->pictures = Array ();
		
		$i = 0;
		$offset = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphBannerItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->widthone, $this->heightone, NGPicture::stringToRatio ( $this->cropratio ) );
			$picture->link = $item->displayLink ();
			$picture->caption = $item->displayCaption ();
			$picture->alt = $item->displayPicture ()->alt;
			
			if ($i < $this->itemcount) {
				$picture->visible = true;
				if ($this->orientation === 'Horizontal') {
					$picture->left = $offset;
					$picture->top = 0;
					$offset += $this->widthone + $this->gutter;
				} else {
					$picture->left = 0;
					$picture->top = $offset;
					$offset += $this->heightone + $this->gutter;
				}
			}
			
			$this->pictures [] = $picture;
			$i ++;
		}
		
		if (count ( $this->pictures ) >= $this->itemcount) {
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'widthall', $this->widthall );
			$template->assign ( 'heightall', $this->heightall );
			$template->assign ( 'widthone', $this->widthone );
			$template->assign ( 'heightone', $this->heightone );
			$template->assign ( 'delay', strtolower ( $this->delay ) );
			$template->assign ( 'fade', strtolower ( $this->fademode ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphbanner/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphBanner'] = $this->prependPluginsPath ( 'ngpluginparagraphbanner/css/style.css' );
			
			$this->javaScripts ['NGPluginParagraphBanner'] = $this->prependPluginsPath ( 'ngpluginparagraphbanner/js/banner.js' );
		}
	}
}

class NGPluginParagraphBannerItem {

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

	public $left = 0;

	public $top = 0;

	public $visible = false;
}