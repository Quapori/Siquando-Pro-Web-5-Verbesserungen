<?php

class NGPluginParagraphImageMap extends NGPluginParagraph {
	const ObjectTypePluginParagraphImageMap = 'NGPluginParagraphImageMap';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphImageMap = "paragraphimagemap";
	const DomainParagraphPicture = 'paragraphpicture';

	public $pictureUID = '';

	public $data = '';

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphPicture, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'data', NGProperty::TypeText, self::DomainParagraphImageMap, 'data', NGPropertyMapped::MultiplicityScalar, true, '', false );
	}

	/**
	 *
	 * Parse XML data
	 * 
	 * @param string $data        	
	 * @param int $width        	
	 * @param int $height        	
	 */
	private function parseData($data, $width, $height) {
		$items = array ();
		
		if ($data !== '') {
			$doc = new DOMDocument ();
			$doc->loadXML ( $data );
			
			$itemNodes = $doc->getElementsByTagName ( 'item' );
			
			foreach ( $itemNodes as $itemNode ) {
				/* @var $itemNode DomElement */
				
				$item = null;
				/* @var $item NGImageMapStageItem */
				
				switch ($itemNode->getAttribute ( 'type' )) {
					case NGImageMapStageItem::TypePin :
						$item = new NGImageMapStageItemPin ();
						break;
					case NGImageMapStageItem::TypeArea :
						$item = new NGImageMapStageItemArea ();
						break;
				}
				
				if ($item != null) {
					$item->stageWidth = $width;
					$item->stageHeight = $height;
					$item->previewMode = $this->previewMode;
					$item->readFromDOMElement ( $itemNode );
					$items [] = $item;
				}
			}
		}
		
		return $items;
	}

	public function render() {
		$pictureAdapter = new NGDBAdapterObject ();
		
		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($picture != null) {
			
			$size = $picture->getResizedSize ( $this->renderWidth, - 1, NGPicture::RatioNone );
			
			$template = new NGTemplate ();
			$template->assign ( 'source', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height, NGPicture::RatioNone ) );
			
			$template->assign ( 'width', $size->width );
			$template->assign ( 'height', $size->height );
			$template->assign ( 'alt', $picture->displayAlt () );
			$template->assign ( 'title', $picture->title );
			$template->assign ( 'items', $this->parseData ( $this->data, $size->width, $size->height ) );
			$template->assign ( 'uid', $this->objectUID );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphimagemap/tpl/template.tpl' );
			$this->styles ['NGPLuginImageMap'.$this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphimagemap/tpl/style.tpl' );
			$this->javaScripts ['NGPluginParagraphImageMap'] = $this->prependPluginsPath ( 'ngpluginparagraphimagemap/js/imagemap.js' );
			$this->styleSheets ['NGPluginParagraphImageMap'] = $this->prependPluginsPath ( 'ngpluginparagraphimagemap/css/style.css' );
			
			if ($this->allowMobileFullWidth) $this->renderMode=self::RenderModeMobileFullWidth;
		}
	}
}

class NGImageMapStageItem {
	const TypePin = 'pin';
	const TypeArea = 'area';
	const ScaleModeFixed = 'Fixed';
	const ScaleModeScalable = 'Scalable';
	const PopupPositionTop = 'Top';
	const PopupPositionRight = 'Right';
	const PopupPositionBottom = 'Bottom';
	const PopupPositionLeft = 'Left';
	const PopupModeNone = 'None';
	const PopupModeMouseOver = 'MouseOver';
	const PopupModeClick = 'Click';

	public $type = '';

	public $stageWidth = 0;

	public $stageHeight = 0;

	public $left = 0;

	public $top = 0;

	public $width = 0;

	public $height = 0;

	public $popuptext = '';

	public $popupcolor = '4682b4';

	public $bordercolor = '';

	public $textcolor = 'ffffff';

	public $popupborderradius = 4;

	public $popupwidth = 1;

	public $popupanimate = false;

	public $sounduidmp3 = '';

	public $sounduidogg = '';

	public $linkuid = '';

	public $linktitle = '';

	public $pictureuid = '';

	public $popupposition = self::PopupPositionTop;

	public $popupmode = self::PopupModeMouseOver;

	public $arrow = true;

	public $offsetx = 0;

	public $offsety = 0;

	public $previewMode = false;

	/**
	 *
	 * Richtext Parser
	 * 
	 * @var NGRichText
	 */
	private $richText;

	/**
	 *
	 * Link
	 * 
	 * @var NGLink
	 */
	private $link;

	/**
	 *
	 * Picture
	 * 
	 * @var NGPicture
	 */
	private $picture;

	/**
	 *
	 * OGG Sound
	 * 
	 * @var NGDownload
	 */
	private $soundOgg;

	/**
	 *
	 * MP3 Sound
	 * 
	 * @var NGDownload
	 */
	private $soundMP3;

	/**
	 *
	 * Picture site
	 * 
	 * @var NGSize
	 */
	private $pictureSize;

	/**
	 * Is the popup visible?
	 */
	public function getPopupVisible() {
		if ($this->popupmode === self::PopupModeNone)
			return false;
		if ($this->popuptext !== '')
			return true;
		if ($this->pictureuid !== '')
			return true;
		return false;
	}

	/**
	 * Get parsed popup text
	 */
	public function getPopupText() {
		if ($this->popuptext === '')
			return '';
		
		if (! isset ( $this->richText ))
			$this->richText = new NGRichText ();
		
		$this->richText->previewMode = $this->previewMode;
		
		return $this->richText->parse ( $this->popuptext );
	}

	/**
	 * Analyse link
	 */
	private function parseLink() {
		if (! isset ( $this->link ))
			$this->link = new NGLink ( $this->previewMode );
		
		if ($this->linkuid !== '') {
			$this->link->parseURL ( $this->linkuid );
		}
	}

	/**
	 * Full source of OGG
	 */
	public function getOggSrc() {
		if ($this->sounduidogg === "")
			return '';
		
		if (! isset ( $this->soundOgg )) {
			$soundAdapter = new NGDBAdapterObject ();
			$this->soundOgg = $soundAdapter->loadObject ( $this->sounduidogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
		}
		
		return NGUtil::prependStorePath ( $this->soundOgg->pathToFile () );
	}

	/**
	 * Full source of MP3
	 */
	public function getMP3Src() {
		if ($this->sounduidmp3 === "")
			return '';
		
		if (! isset ( $this->soundMP3 )) {
			$soundAdapter = new NGDBAdapterObject ();
			$this->soundMP3 = $soundAdapter->loadObject ( $this->sounduidmp3, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
		}
		
		return NGUtil::prependStorePath ( $this->soundMP3->pathToFile () );
	}

	/**
	 * Load and parse
	 */
	private function parsePicture() {
		$pictureAdapter = new NGDBAdapterObject ();
		
		$this->picture = $pictureAdapter->loadObject ( $this->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($this->picture != null)
			$this->pictureSize = $this->picture->getResizedSize ( $this->getPopupWidth () - 16, - 1, NGPicture::RatioNone );
	}

	/**
	 * Source
	 */
	public function getPictureSource() {
		if ($this->pictureuid === '')
			return '';
		$this->parsePicture ();
		if ($this->picture === null)
			return '';
		return NGLink::getPictureURL ( $this->picture->objectUID, $this->pictureSize->width, $this->pictureSize->height, NGPicture::RatioNone );
	}

	/**
	 * Width of picture
	 */
	public function getPictureWidth() {
		if ($this->pictureuid === '')
			return 0;
		$this->parsePicture ();
		if ($this->picture === null)
			return 0;
		return $this->pictureSize->width;
	}

	/**
	 * Height of picture
	 */
	public function getPictureHeight() {
		if ($this->pictureuid === '')
			return 0;
		$this->parsePicture ();
		if ($this->picture === null)
			return 0;
		return $this->pictureSize->height;
	}

	/**
	 * Picture alt
	 */
	public function getPictureAlt() {
		if ($this->pictureuid === '')
			return '';
		$this->parsePicture ();
		if ($this->picture === null)
			return '';
		return $this->picture->alt;
	}

	/**
	 * Picture title
	 */
	public function getPictureTitle() {
		if ($this->pictureuid === '')
			return '';
		$this->parsePicture ();
		if ($this->picture === null)
			return '';
		return $this->picture->title;
	}

	/**
	 * URL for link
	 */
	public function getLinkUrl() {
		if ($this->linkuid === '')
			return '';
		
		$this->parseLink ();
		return $this->link->getURL ();
	}

	/**
	 * Class of link
	 */
	public function getLinkClass() {
		if ($this->linkuid === '')
			return '';
		
		switch ($this->link->linkType) {
			case NGLink::LinkPicture :
				return 'gallery';
			case NGLink::LinkPagePopup :
			case NGLink::LinkTopicPopup :
				return 'galleryiframe';
			default :
				return '';
		}
	}

	/**
	 * Target for link
	 */
	public function getLinkTarget() {
		if ($this->linkuid === '')
			return '';
		
		return ($this->link->linkType === NGLink::LinkWWW) ? '_blank' : '';
	}

	/**
	 * Width of popup
	 */
	public function getPopupWidth() {
		return 150 + $this->popupwidth * 75;
	}

	/**
	 * Get filename for arrow
	 */
	public function getArrowFilename() {
		if ($this->arrow) {
			return NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphimagemap/img/?ca=%s&cb=%s&f=%s', $this->popupcolor, $this->bordercolor, strtolower ( $this->popupposition ) ) );
		} else {
			return '';
		}
	}

	/**
	 *
	 * Read from DOM
	 * 
	 * @param DOMElement $element        	
	 */
	public function readFromDOMElement(DOMElement $element) {
		foreach ( $element->childNodes as $node ) {
			/* @var $node DOMElement */
			
			if ($node->nodeType == XML_ELEMENT_NODE) {
				switch ($node->nodeName) {
					case 'left' :
						$this->left = floatval ( $node->nodeValue );
						break;
					case 'top' :
						$this->top = floatval ( $node->nodeValue );
						break;
					case 'width' :
						$this->width = floatval ( $node->nodeValue );
						break;
					case 'height' :
						$this->height = floatval ( $node->nodeValue );
						break;
					case 'popuptext' :
						$this->popuptext = $node->nodeValue;
						break;
					case 'popupcolor' :
						$this->popupcolor = $node->nodeValue;
						break;
					case 'bordercolor' :
						$this->bordercolor = $node->nodeValue;
						break;
					case 'textcolor' :
						$this->textcolor = $node->nodeValue;
						break;
					case 'popupborderradius' :
						$this->popupborderradius = intval ( $node->nodeValue );
						break;
					case 'popupwidth' :
						$this->popupwidth = intval ( $node->nodeValue );
						break;
					case 'popupanimate' :
						$this->popupanimate = NGUtil::StringXMLToBool ( $node->nodeValue );
						break;
					case 'sounduidmp3' :
						$this->sounduidmp3 = $node->nodeValue;
						break;
					case 'sounduidogg' :
						$this->sounduidogg = $node->nodeValue;
						break;
					case 'linkuid' :
						$this->linkuid = $node->nodeValue;
						break;
					case 'linktitle' :
						$this->linktitle = $node->nodeValue;
						break;
					case 'pictureuid' :
						$this->pictureuid = $node->nodeValue;
						break;
					case 'popupposition' :
						$this->popupposition = $node->nodeValue;
						break;
					case 'popupmode' :
						$this->popupmode = $node->nodeValue;
						break;
					case 'arrow' :
						$this->arrow = NGUtil::StringXMLToBool ( $node->nodeValue );
						break;
				}
			}
		}
	}
}

/**
 * stage item pin
 */
class NGImageMapStageItemPin extends NGImageMapStageItem {

	public $filename = '';

	public $hidepin = false;

	public $color;

	public function __construct() {
		$this->type = NGImageMapStageItem::TypePin;
	}

	/**
	 * Get full filename
	 */
	public function getFilename() {
		if (substr ( $this->filename, - 8 ) === '.svg.png') {
			return NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphimagemap/styles/img/?f=%s&c=%s', substr ( $this->filename, 0, - 8 ), $this->color ) );
		} else {
			return NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphimagemap/styles/' . $this->filename );
		}
	}

	/**
	 * (non-PHPdoc)
	 * 
	 * @see NGImageMapStageItem::readFromDOMElement()
	 */
	public function readFromDOMElement(DOMElement $element) {
		parent::readFromDOMElement ( $element );
		
		foreach ( $element->childNodes as $node ) {
			/* @var $node DOMElement */
			
			if ($node->nodeType == XML_ELEMENT_NODE) {
				switch ($node->nodeName) {
					case 'filename' :
						$this->filename = $node->nodeValue;
						break;
					case 'offsetx' :
						$this->offsetx = intval ( $node->nodeValue );
						break;
					case 'offsety' :
						$this->offsety = intval ( $node->nodeValue );
						break;
					case 'hidepin' :
						$this->hidepin = NGUtil::boolToStringXML ( $node->nodeValue );
						break;
					case 'color' :
						$this->color = $node->nodeValue;
						break;
				}
			}
		}
	}
}

/**
 * Class for stage item area
 */
class NGImageMapStageItemArea extends NGImageMapStageItem {

	public function __construct() {
		$this->type = NGImageMapStageItem::TypeArea;
	}

	/**
	 * Get full filename
	 */
	public function getFilename() {
		return NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphimagemap/img/clearpixel.png' );
	}
}