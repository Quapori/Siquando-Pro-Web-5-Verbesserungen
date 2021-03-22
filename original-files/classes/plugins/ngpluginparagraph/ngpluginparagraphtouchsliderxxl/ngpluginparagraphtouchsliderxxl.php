<?php

class NGPluginParagraphTouchSliderXXL extends NGPluginParagraph {
	const ObjectTypePluginParagraphTouchSliderXXL = 'NGPluginParagraphTouchSliderXXL';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTouchSliderXXL = "paragraphtouchsliderxxl";

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
	 * Height of stage
	 *
	 * @var integer
	 */
	public $stageheight = 90;

	/**
	 *
	 * @var string
	 */
	public $fadeeffect = 'up';

	/**
	 *
	 * @var bool
	 */
	public $blacknav = false;

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
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphTouchSliderXXL, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphTouchSliderXXL, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTouchSliderXXL, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphTouchSliderXXL, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphTouchSliderXXL, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'stageheight', NGProperty::TypeInt, self::DomainParagraphTouchSliderXXL, 'stageheight', NGPropertyMapped::MultiplicityScalar, false, 90, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fadeeffect', NGProperty::TypeString, self::DomainParagraphTouchSliderXXL, 'fadeeffect', NGPropertyMapped::MultiplicityScalar, false, 'up', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'blacknav', NGProperty::TypeBool, self::DomainParagraphTouchSliderXXL, 'blacknav', NGPropertyMapped::MultiplicityScalar, false, false, false );
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
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphTouchSliderXXLItem ();
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID );
			$picture->caption = $item->displayCaption ();
			if ($picture->caption === '')
				$picture->caption = $i;
			$picture->alt = $item->displayPicture ()->alt;
			$picture->width = $item->displayPicture ()->widthWeb;
			$picture->height = $item->displayPicture ()->heightWeb;
			$this->pictures [] = $picture;
			$i ++;
			if ($i > 6)
				break;
		}
		
		if (count($this->pictures) > 1) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'stageheight', $this->stageheight );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'colorframe', $this->colorframe );
			$template->assign ( 'shownav', NGUtil::boolToStringXML ( $this->shownav ) );
			$template->assign ( 'blacknav', $this->blacknav );
			$template->assign ( 'fadeeffect', $this->fadeeffect );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtouchsliderxxl/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphTouchSliderXXL'] = $this->prependPluginsPath ( 'ngpluginparagraphtouchsliderxxl/css/style.css' );
			$this->javaScripts ['NGPluginParagraphTouchSliderXXL'] = $this->prependPluginsPath ( 'ngpluginparagraphtouchsliderxxl/js/touchsliderxxl.js' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphTouchSliderXXLItem {

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

	/**
	 *
	 * Alt
	 *
	 * @var string
	 */
	public $caption;

	/**
	 *
	 * @var int
	 */
	public $width;

	/**
	 *
	 * @var height
	 */
	public $height;
}