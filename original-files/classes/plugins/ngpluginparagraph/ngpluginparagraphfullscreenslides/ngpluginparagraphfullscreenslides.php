<?php

class NGPluginParagraphFullscreenSlides extends NGPluginParagraph {
	const ObjectTypePluginParagraphFullscreenSlides = 'NGPluginParagraphFullscreenSlides';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphFullscreenSlides = "paragraphfullscreenslides";
	
	/**
	 * 
	 * Sortmode for bouquet
	 * @var string
	 */
	public $sortMode = '';
	
	/**
	 * 
	 * Source for bouquet
	 * @var string
	 */
	public $itemsSource = '';
	
	/**
	 * 
	 * Found items
	 * @var string
	 */
	public $items;
	
	/**
	 * 
	 * Parent UID
	 * @var string
	 */
	public $itemsParentUID = '';
	
	/**
	 * 
	 * Automatically advance
	 * @var int
	 */
	public $autoplay = 7;
	
	/**
	 * 
	 * Sound to play
	 * @var string
	 */
	public $mp3 = '';
	
	/**
	 * 
	 * Sound to play
	 * @var string
	 */
	public $ogg = '';
	
	/**
	 * 
	 * Text of start button
	 * @var string
	 */
	public $textstart = '';
	
	/**
	 * 
	 * Background color of pictures
	 * @var string
	 */
	public $picturebackgroundcolor = '222222';
	
	/**
	 * 
	 * Backround color of navigation
	 * @var string
	 */
	public $navigationbackgroundcolor = '000000';
	
	/**
	 *
	 * Backround color of navigation
	 * @var string
	 */
	public $navigationforegroundcolor = 'ffffff';
	
	/**
	 * 
	 * Seconds to hide navigation
	 * @var int
	 */
	public $hidenavigation = 3;
	
	/**
	 * 
	 * Display captions
	 * @var string
	 */
	public $captions = 'none';
	
	/**
	 * 
	 * Size of captions
	 * @var int
	 */
	public $captionsize = -1;
	
	/**
	 * 
	 * Poster
	 * @var string
	 */
	public $poster = "";
	
	/**
	 * 
	 * Fullscreen
	 * @var bool
	 */
	public $fullscreen=true;
	
	/**
	 * 
	 * Orientation of start button
	 * @var string
	 */
	public $buttonorientation='Center';
	
	/**
	 * 
	 * Bouquet to use
	 * @var NGBouquet
	 */
	private $bouquet;
	
	/**
	 * 
	 * Loaded pictures
	 * @var Array
	 */
	private $pictures = Array ();
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphFullscreenSlides, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'autoplay', NGProperty::TypeInt, self::DomainParagraphFullscreenSlides, 'autoplay', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mp3', NGProperty::TypeUID, self::DomainParagraphFullscreenSlides, 'mp3', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'ogg', NGProperty::TypeUID, self::DomainParagraphFullscreenSlides, 'ogg', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'textstart', NGProperty::TypeFulltext, self::DomainParagraphFullscreenSlides, 'textstart', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'picturebackgroundcolor', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'picturebackgroundcolor', NGPropertyMapped::MultiplicityScalar, false, '222222', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navigationbackgroundcolor', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'navigationbackgroundcolor', NGPropertyMapped::MultiplicityScalar, false, '000000', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navigationforegroundcolor', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'navigationforegroundcolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hidenavigation', NGProperty::TypeInt, self::DomainParagraphFullscreenSlides, 'hidenavigation', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captions', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'captions', NGPropertyMapped::MultiplicityScalar, false, 'none', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionsize', NGProperty::TypeInt, self::DomainParagraphFullscreenSlides, 'captionsize', NGPropertyMapped::MultiplicityScalar, false, -1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'poster', NGProperty::TypeUID, self::DomainParagraphFullscreenSlides, 'poster', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fullscreen', NGProperty::TypeBool, self::DomainParagraphFullscreenSlides, 'fullscreen', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonorientation', NGProperty::TypeString, self::DomainParagraphFullscreenSlides, 'buttonorientation', NGPropertyMapped::MultiplicityScalar, false, 'Center', false );
		
	}
	
	public function render() {
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		$this->bouquet->prepare ();
		$this->pictures = Array ();
		
		if (count ( $this->bouquet->items ) > 0) {
			
			foreach ( $this->bouquet->items as $item ) {
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphFullscreenSlidesItem ();
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID );
				$picture->thumb = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, 128, 128 );
				$picture->caption = $item->displayCaption ();
				$picture->width = $item->displayPicture ()->widthWeb;
				$picture->height = $item->displayPicture ()->heightWeb;
				
				$size = $item->displayPicture ()->getResizedSize ( 128, 128 );
				$picture->thumbWidth = $size->width;
				$picture->thumbHeight = $size->height;
				
				$this->pictures [] = $picture;
			}
			
			$controller = new NGDBAdapterObject ();
			
			$this->output = '';
			$template = new NGTemplate ();
			
			if ($this->mp3 !== "") {
				$mp3download = $controller->loadObject ( $this->mp3, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
			}
			
			if ($this->ogg !== "") {
				$oggdownload = $controller->loadObject ( $this->ogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
			}
			
			if ($this->poster !== "") {
				/* @var $poster NGPicture */
				
				$poster = $controller->loadObject ( $this->poster, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
				
				$size = $poster->getResizedSize ( $this->renderWidth );
				
				$template->assign ( 'poster', NGLink::getPictureURL ( $this->poster, $this->renderWidth ) );
				$template->assign ( 'posterwidth', $size->width );
				$template->assign ( 'posterheight', $size->height );
			}
			
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'trans', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphfullscreenslides/img/trans.gif' ) );
			$template->assign ( 'sprites', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphfullscreenslides/img/?f=sprites&c='.$this->navigationforegroundcolor ) );
			$template->assign ( 'play', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphfullscreenslides/img/?f=play&c='.$this->navigationforegroundcolor ) );
			$template->assign ( 'textstart', $this->textstart );
			$template->assign ( 'autoplay', $this->autoplay );
			$template->assign ( 'captions', $this->captions );
			$template->assign ( 'captionsize', $this->captionsize );
			$template->assign ( 'hidenavigation', $this->hidenavigation );
			$template->assign ( 'picturebackgroundcolor', $this->picturebackgroundcolor );
			$template->assign ( 'fullscreen', NGUtil::boolToStringXML($this->fullscreen) );
			$template->assign ( 'buttonorientation', $this->buttonorientation );
			
			$rgb = str_pad ( $this->navigationbackgroundcolor, 6, '0', STR_PAD_LEFT );
			
			$template->assign ( 'navigationbackgroundcolorr', hexdec ( substr ( $rgb, 0, 2 ) ) );
			$template->assign ( 'navigationbackgroundcolorg', hexdec ( substr ( $rgb, 2, 2 ) ) );
			$template->assign ( 'navigationbackgroundcolorb', hexdec ( substr ( $rgb, 4, 2 ) ) );
			
			if (isset ( $mp3download )) {
				$template->assign ( 'mp3', NGUtil::prependStorePath ( $mp3download->pathToFile () ) );
			}
			
			if (isset ( $oggdownload )) {
				$template->assign ( 'ogg', NGUtil::prependStorePath ( $oggdownload->pathToFile () ) );
			}
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphfullscreenslides/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphFullscreenSlides'] = $this->prependPluginsPath ( 'ngpluginparagraphfullscreenslides/css/style.css' );
			
			if ($this->poster === '') {
				$this->styleSheets ['NGPluginParagraphFullscreenSlidesStyle'] = $this->prependPluginsPath ( 'ngpluginparagraphfullscreenslides/css/' );
			}
			
			$this->javaScripts ['NGPluginParagraphFullscreenSlides'] = $this->prependPluginsPath ( 'ngpluginparagraphfullscreenslides/js/fullscreenslides.js' );
		}
	}
}

class NGPluginParagraphFullscreenSlidesItem {
	/**
	 * 
	 * Source of picture
	 * @var string
	 */
	public $source;
	
	/**
	 * 
	 * Thumbnail
	 * @var string
	 */
	public $thumb;
	
	/**
	 * 
	 * Caption
	 * @var string
	 */
	public $caption;
	
	/**
	 * 
	 * Caption
	 * @int width
	 */
	public $width;
	
	/**
	 * 
	 * Caption
	 * @int height
	 */
	public $height;
	
	/**
	 * 
	 * Caption
	 * @int width
	 */
	public $thumbWidth;
	
	/**
	 * 
	 * Caption
	 * @int height
	 */
	public $thumbHeight;

}