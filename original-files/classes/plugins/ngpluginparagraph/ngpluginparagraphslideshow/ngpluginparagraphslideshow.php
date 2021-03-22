<?php

class NGPluginParagraphSlideShow extends NGPluginParagraph {
	const ObjectTypePluginParagraphSlideshow = 'NGPluginParagraphSlideShow';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphSlideShow = "paragraphslideshow";
	const NavigationStyleNone = 'None';
	const NavigationStyleBullet = 'Bullet';
	const NavigationStyleThumbnail = 'Thumbnail';
	const NavigationStyleCaption = 'Caption';
	const NavigationStylePrevNext = 'PrevNext';
	const NavigationAlignmentLeft = 'Left';
	const NavigationAlignmentRight = 'Right';
	const ChangeEffectsNone = 'None';
	const ChangeEffectsSlide = 'Slide';
	const ChangeEffectsFade = 'Fade';
	const ColorSchemeLight = 'Light';
	const ColorSchemeDark = 'Dark';

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
	 * Style of navigation
	 *
	 * @var string
	 */
	public $navigationStyle = self::NavigationStyleBullet;

	/**
	 *
	 * Alignment of navigation
	 *
	 * @var string
	 */
	public $navigationAlignment = self::NavigationAlignmentRight;

	/**
	 *
	 * Effect to use on picture change
	 *
	 * @var string
	 */
	public $changeEffect = self::ChangeEffectsFade;

	/**
	 *
	 * Show captions on picture
	 *
	 * @var bool
	 */
	public $showCaptions = false;

	/**
	 *
	 * Delay on changing pictures
	 *
	 * @var int
	 */
	public $autoChangeDelay = 4;

	/**
	 *
	 * Crop ratio for pictures
	 *
	 * @var string
	 */
	public $cropRatioMain = NGPicture::Ratio4by3;

	/**
	 *
	 * Crop ratio for thumbnails
	 *
	 * @var string
	 */
	public $cropRatioThumbnails = NGPicture::Ratio1by1;

	/**
	 * Color of frame
	 *
	 * @var string
	 */
	public $colorFrame = 'd7d7d7';

	/**
	 *
	 * Color of frame, hover
	 *
	 * @var string
	 */
	public $colorFrameHover = 'd7d7d7';

	/**
	 *
	 * Color of frame, selected
	 *
	 * @var string
	 */
	public $colorFrameSelected = 'd7d7d7';

	/**
	 *
	 * Color of background
	 *
	 * @var string
	 */
	public $colorBackground = 'fafafa';

	/**
	 *
	 * Color of background, hover
	 *
	 * @var string
	 */
	public $colorBackgroundHover = 'ebebeb';

	/**
	 *
	 * Color of background, selected
	 *
	 * @var string
	 */
	public $colorBackgroundSelected = '9b9b9b';

	/**
	 *
	 * Color of text
	 *
	 * @var string
	 */
	public $colorText = '464646';

	/**
	 *
	 * Color of text, hover
	 *
	 * @var string
	 */
	public $colorTextHover = '464646';

	/**
	 *
	 * Color of text
	 *
	 * @var string
	 */
	public $colorTextSelected = 'ffffff';

	/**
	 *
	 * Colorscheme for caption
	 *
	 * @var string
	 */
	public $colorSchemeCaption = self::ColorSchemeDark;

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

	private $pictureCount;

	/**
	 *
	 * Real crop ratio main ...
	 *
	 * @var double
	 */
	private $cropRatioMainValue;

	/**
	 *
	 * Real crop ratio thumbnails ...
	 *
	 * @var double
	 */
	private $cropRatioThumbnailsValue;

	private $widthThumbNails;

	private $heightThumbNails;

	private $widthPicture;

	private $heightPicture;

	private $widthAll;

	private $heightAll;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphSlideShow, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphSlideShow, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphSlideShow, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphSlideShow, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navigationstyle', NGProperty::TypeString, self::DomainParagraphSlideShow, 'navigationStyle', NGPropertyMapped::MultiplicityScalar, false, 'Bullet', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navigationalignment', NGProperty::TypeString, self::DomainParagraphSlideShow, 'navigationAlignment', NGPropertyMapped::MultiplicityScalar, false, 'Right', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'changeeffect', NGProperty::TypeString, self::DomainParagraphSlideShow, 'changeEffect', NGPropertyMapped::MultiplicityScalar, false, 'Fade', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaptions', NGProperty::TypeBool, self::DomainParagraphSlideShow, 'showCaptions', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'autochangedelay', NGProperty::TypeInt, self::DomainParagraphSlideShow, 'autoChangeDelay', NGPropertyMapped::MultiplicityScalar, false, 4, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cropratiomain', NGProperty::TypeString, self::DomainParagraphSlideShow, 'cropRatioMain', NGPropertyMapped::MultiplicityScalar, false, NGPicture::NameRatio4by3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cropratiothumbnails', NGProperty::TypeString, self::DomainParagraphSlideShow, 'cropRatioThumbnails', NGPropertyMapped::MultiplicityScalar, false, NGPicture::NameRatio1by1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorFrame', NGPropertyMapped::MultiplicityScalar, false, 'd7d7d7', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframehover', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorFrameHover', NGPropertyMapped::MultiplicityScalar, false, 'd7d7d7', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframeselected', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorFrameSelected', NGPropertyMapped::MultiplicityScalar, false, 'd7d7d7', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorBackground', NGPropertyMapped::MultiplicityScalar, false, 'fafafa', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackgroundhover', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorBackgroundHover', NGPropertyMapped::MultiplicityScalar, false, 'ebebeb', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackgroundselected', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorBackgroundSelected', NGPropertyMapped::MultiplicityScalar, false, '9b9b9b', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colortext', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorText', NGPropertyMapped::MultiplicityScalar, false, '464646', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colortexthover', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorTextHover', NGPropertyMapped::MultiplicityScalar, false, '464646', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colortextselected', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorTextSelected', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorschemecaption', NGProperty::TypeString, self::DomainParagraphSlideShow, 'colorSchemeCaption', NGPropertyMapped::MultiplicityScalar, false, 'Dark', false );
	}

	public function render() {
		$this->cropRatioMainValue = NGPicture::ratioByRatioType ( NGPicture::stringToRatio ( $this->cropRatioMain ) );
		$this->cropRatioThumbnailsValue = NGPicture::ratioByRatioType ( NGPicture::stringToRatio ( $this->cropRatioThumbnails ) );
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->maxItemCount = 10;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		$this->pictureCount = count ( $this->bouquet->items );
		
		switch ($this->navigationStyle) {
			
			case self::NavigationStyleCaption :
			case self::NavigationStyleThumbnail :
				$this->heightThumbNails = floor ( (- $this->pictureCount * $this->cropRatioMainValue + $this->renderWidth - 3) / ($this->pictureCount * $this->cropRatioMainValue + $this->cropRatioThumbnailsValue) );
				$this->widthThumbNails = floor ( $this->heightThumbNails * $this->cropRatioThumbnailsValue );
				$this->heightPicture = floor ( $this->pictureCount * $this->heightThumbNails + $this->pictureCount - 1 );
				$this->widthPicture = $this->renderWidth - $this->widthThumbNails - 3;
				break;
			case self::NavigationStyleBullet :
			case self::NavigationStyleNone :
			case self::NavigationStylePrevNext :
				$this->heightThumbNails = 0;
				$this->widthThumbNails = 0;
				$this->widthPicture = $this->renderWidth - 2;
				$this->heightPicture = floor ( $this->widthPicture / $this->cropRatioMainValue );
				break;
		}
		
		$this->widthAll = $this->renderWidth;
		$this->heightAll = $this->heightPicture + 2;
		
		$leftStage = 0;
		$leftBullet = 0;
		
		$i = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$picture = new NGPluginParagraphSlideShowItem ();
			$picture->sourceThumbnail = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->widthThumbNails, $this->heightThumbNails, NGPicture::stringToRatio ( $this->cropRatioThumbnails ) );
			$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->widthPicture, $this->heightPicture, NGPicture::stringToRatio ( $this->cropRatioMain ) );
			
			if (NGSettingsSite::getInstance ()->hdpictures) {
				$picture->sourcehd = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->widthPicture * 2, $this->heightPicture * 2, NGPicture::stringToRatio ( $this->cropRatioMain ) );
			}
			$picture->anchor = $this->objectUID . $i;
			$picture->caption = $item->displayCaption ();
			$picture->alt = $item->displayPicture ()->alt;
			$picture->link = $item->displayLink ();
			$picture->leftStage = $leftStage;
			$leftStage += $this->widthPicture;
			$picture->leftBullet = $leftBullet;
			$leftBullet += 20;
			$this->pictures [] = $picture;
			$i ++;
		}
		
		if (count ( $this->pictures ) == 0)
			return;
		
		$template = new NGTemplate ();
		$template->assign ( 'pictures', $this->pictures );
		$template->assign ( 'id', $this->objectUID );
		$template->assign ( 'navigationalignment', $this->navigationAlignment );
		$template->assign ( 'colorschemecaption', $this->colorSchemeCaption );
		$template->assign ( 'navigationstyle', $this->navigationStyle );
		$template->assign ( 'changeeffect', $this->changeEffect );
		$template->assign ( 'autochangedelay', $this->autoChangeDelay );
		$template->assign ( 'showcaptions', $this->showCaptions );
		$template->assign ( 'cropratiomain', $this->cropRatioMainValue );
		$template->assign ( 'cropratiothumbs', $this->cropRatioThumbnailsValue );
		$template->assign ( 'trans', $this->prependPluginsPath ( 'ngpluginparagraphslideshow/img/trans.gif' ) );
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphslideshow/tpl/template.tpl' );
		
		$styleTemplate = new NGTemplate ();
		$styleTemplate->assign ( 'id', $this->objectUID );
		$styleTemplate->assign ( 'widthall', $this->widthAll );
		$styleTemplate->assign ( 'heightall', $this->heightAll );
		$styleTemplate->assign ( 'widthpicture', $this->widthPicture );
		$styleTemplate->assign ( 'heightpicture', $this->heightPicture );
		$styleTemplate->assign ( 'widththumbnails', $this->widthThumbNails );
		$styleTemplate->assign ( 'heightthumbnails', $this->heightThumbNails );
		$styleTemplate->assign ( 'colorframe', $this->colorFrame );
		$styleTemplate->assign ( 'colorframehover', $this->colorFrameHover );
		$styleTemplate->assign ( 'colorframeselected', $this->colorFrameSelected );
		$styleTemplate->assign ( 'colorbackground', $this->colorBackground );
		$styleTemplate->assign ( 'colorbackgroundhover', $this->colorBackgroundHover );
		$styleTemplate->assign ( 'colorbackgroundselected', $this->colorBackgroundSelected );
		$styleTemplate->assign ( 'colortext', $this->colorText );
		$styleTemplate->assign ( 'colortexthover', $this->colorTextHover );
		$styleTemplate->assign ( 'colortextselected', $this->colorTextSelected );
		$styleTemplate->assign ( 'picturecount', $this->pictureCount );
		$styleTemplate->assign ( 'navigationstyle', $this->navigationStyle );
		$styleTemplate->assign ( 'changeeffect', $this->changeEffect );
		$styleTemplate->assign ( 'showcaptions', $this->showCaptions );
		
		$this->styles = Array (
				'NGPluginParagraphSlideShow' . $this->objectUID => $styleTemplate->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphslideshow/tpl/style.tpl' ) 
		);
		$this->styleSheets = Array (
				'NGPluginParagraphSlideShow' => $this->prependPluginsPath ( 'ngpluginparagraphslideshow/css/style.css' ) 
		);
		$this->javaScripts = Array (
				'NGPluginParagraphSlideShow' => $this->prependPluginsPath ( 'ngpluginparagraphslideshow/js/slideshow.js' ) 
		);
		if ($this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
	}
}

class NGPluginParagraphSlideShowItem {

	public $sourceThumbnail;

	public $source;

	public $sourcehd;

	public $width;

	public $height;

	public $caption;

	public $leftStage;

	public $anchor;

	public $leftBullet;

	public $link;

	public $alt;
}