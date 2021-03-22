<?php

class NGPluginParagraphKaleidoscope extends NGPluginParagraph {
	const ObjectTypePluginParagraphKaleidoscope = 'NGPluginParagraphKaleidoscope';
	const Product='SIQUANDO Pro 5';
	const DomainParagraphKaleidoscope = "paragraphkaleidoscope";
	
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
	 * PArent UID
	 * @var string
	 */
	public $itemsParentUID = '';
	
	/**
	 * 
	 * Delay between frames
	 * @var int
	 */
	public $delay = 5;
	
	/**
	 * 
	 * Number of items
	 * @var string
	 */
	public $maxitems = 10;
	
	/**
	 * 
	 * Display nav
	 * @var bool
	 */
	public $shownav = true;
	
	/**
	 * 
	 * Display nav
	 * @var bool
	 */
	public $showcaptions = false;
	
	/**
	 * 
	 * Display 3d
	 * @var bool
	 */
	public $show3d = false;
	
	/**
	 * 
	 * Color a
	 * @var string
	 */
	public $colora = 'ffffff';
	
	/**
	 * 
	 * Color b
	 * @var string
	 */
	public $colorb = '888888';
	
	/**
	 * 
	 * Color c
	 * @var string
	 */
	public $colorc = '0096ff';
	
	/**
	 * 
	 * Draw a relfection
	 * @var bool
	 */
	public $reflection = true;
	
	private $stageHeight;
	
	private $pictureHeight;
	
	/**
	 * 
	 * Bouquet
	 * @var NGBouquet
	 */
	private $bouquet;
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphKaleidoscope, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphKaleidoscope, 'delay', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maxitems', NGProperty::TypeInt, self::DomainParagraphKaleidoscope, 'maxitems', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'reflection', NGProperty::TypeBool, self::DomainParagraphKaleidoscope, 'reflection', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'shownav', NGProperty::TypeBool, self::DomainParagraphKaleidoscope, 'shownav', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaptions', NGProperty::TypeBool, self::DomainParagraphKaleidoscope, 'showcaptions', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'show3d', NGProperty::TypeBool, self::DomainParagraphKaleidoscope, 'show3d', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colora', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'colora', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorb', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'colorb', NGPropertyMapped::MultiplicityScalar, false, '888888', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorc', NGProperty::TypeString, self::DomainParagraphKaleidoscope, 'colorc', NGPropertyMapped::MultiplicityScalar, false, '0096ff', false );
	
	}
	
	public function render() {
		
		$width = $this->renderWidth;
				
		$this->stageHeight = floor ( $width / 3 );
		$this->pictureHeight = floor ( $this->stageHeight * 0.8 );
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		$this->bouquet->maxItemCount = $this->maxitems;
		
		$this->bouquet->prepare ();
		
		if (count ( $this->bouquet->items ) > 2) {
			
			$this->pictures = Array ();
			
			foreach ( $this->bouquet->items as $item ) {
				/* @var $item NGBouquetItem */
				$picture = new NGPluginParagraphKaleidoscopeItem ();
				$picture->source = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, - 1, $this->pictureHeight );
				
				if (NGSettingsSite::getInstance ()->hdpictures) {
					$picture->sourcehd = NGLink::getPictureURL ( $item->displayPicture ()->objectUID, - 1, $this->pictureHeight * 2 );
				}
				
				$picture->link = $item->displayLink ();
				$picture->caption = $item->displayCaption ();
				$picture->alt = $item->displayPicture ()->alt;
				$picture->size = $item->displayPicture ()->getResizedSize ( - 1, $this->pictureHeight );
				
				$this->pictures [] = $picture;
			}
			
			$template = new NGTemplate ();
			
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'delay', strtolower ( $this->delay ) );
			$template->assign ( 'width', $width );
			$template->assign ( 'height', floor ( $this->stageHeight ) );
			$template->assign ( 'reflection', $this->reflection );
			$template->assign ( 'nav', $this->shownav );
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'showcaptions', $this->showcaptions );
			$template->assign ( 'show3d', $this->show3d );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphkaleidoscope/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphKaleidoscope'] = $this->prependPluginsPath ( 'ngpluginparagraphkaleidoscope/css/style.css' );
			$this->javaScripts ['NGPluginParagraphKaleidoscope'] = $this->prependPluginsPath ( 'ngpluginparagraphkaleidoscope/js/kaleidoscope.js' );
			
			$localStyle = new NGTemplate ();
			$localStyle->assign ( 'id', $this->objectUID );
			$localStyle->assign ( 'path', $this->prependPluginsPath ( 'ngpluginparagraphkaleidoscope/img/bullet/' ) );
			$localStyle->assign ( 'colora', $this->colora );
			$localStyle->assign ( 'colorb', $this->colorb );
			$localStyle->assign ( 'colorc', $this->colorc );
			
			$this->styles ['NGPluginKaleidoskope'.$this->objectUID] = $localStyle->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphkaleidoscope/tpl/style.tpl' );
		}
	}
}

class NGPluginParagraphKaleidoscopeItem {
	/**
	 * 
	 * Source of picture
	 * @var string
	 */
	public $source;
	
	/**
	 * 
	 * HD Source
	 * @var string
	 */
	public $sourcehd;
	
	/**
	 * 
	 * Link
	 * @var NGLink
	 */
	public $link;
	
	/**
	 * 
	 * Caption
	 * @var string
	 */
	public $caption;
	
	/**
	 * 
	 * Alt
	 * @var string
	 */
	public $alt;
	
	/**
	 * 
	 * Size of Picture
	 * @var NGSize
	 */
	public $size;

}