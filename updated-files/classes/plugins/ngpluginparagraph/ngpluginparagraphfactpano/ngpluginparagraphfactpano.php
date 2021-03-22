<?php

class NGPluginParagraphFactPano extends NGPluginParagraph {
	const ObjectTypePluginParagraphFactPano = 'NGPluginParagraphFactPano';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphFactPano = 'paragraphfactpano';

	public $text = '';

	public $subcaption = '';

	public $pictureuid = '';

	public $parallax = 30;

	public $brightness = 0;

	public $items = array ();

	public $colorforeground = 'ffffff';

	public $colorbackground = '000000';

	public $colorimagebackground = '808080';

	public $colorframe = 'ffffff';

	public $framethickness = 1;

	public $paddingvertical = 12;

	public $paddinghorizontal = 18;

	public $round = 0;

	public $animation = '';

	public $textsize = 18;

	public $captionsize = 36;

	public $mp4 = '';

	public $ogg = '';

	public $webm = '';

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'text', NGProperty::TypeFulltext, self::DomainParagraphFactPano, 'text', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'subcaption', NGProperty::TypeText, self::DomainParagraphFactPano, 'subcaption', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphFactPano, 'pictureuid', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'parallax', NGProperty::TypeInt, self::DomainParagraphFactPano, 'parallax', NGPropertyMapped::MultiplicityScalar, false, 30, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'brightness', NGProperty::TypeInt, self::DomainParagraphFactPano, 'brightness', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphFactPano, 'items', NGPropertyMapped::MultiplicityList, true, null, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorforeground', NGProperty::TypeString, self::DomainParagraphFactPano, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphFactPano, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '000000', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorimagebackground', NGProperty::TypeString, self::DomainParagraphFactPano, 'colorimagebackground', NGPropertyMapped::MultiplicityScalar, false, '808080', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorframe', NGProperty::TypeString, self::DomainParagraphFactPano, 'colorframe', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framethickness', NGProperty::TypeInt, self::DomainParagraphFactPano, 'framethickness', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddingvertical', NGProperty::TypeInt, self::DomainParagraphFactPano, 'paddingvertical', NGPropertyMapped::MultiplicityScalar, false, 12, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paddinghorizontal', NGProperty::TypeInt, self::DomainParagraphFactPano, 'paddinghorizontal', NGPropertyMapped::MultiplicityScalar, false, 18, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'round', NGProperty::TypeInt, self::DomainParagraphFactPano, 'round', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'animation', NGProperty::TypeString, self::DomainParagraphFactPano, 'animation', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'textsize', NGProperty::TypeInt, self::DomainParagraphFactPano, 'textsize', NGPropertyMapped::MultiplicityScalar, false, 18, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionsize', NGProperty::TypeInt, self::DomainParagraphFactPano, 'captionsize', NGPropertyMapped::MultiplicityScalar, false, 36, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mp4', NGProperty::TypeUID, self::DomainParagraphFactPano, 'mp4', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'ogg', NGProperty::TypeUID, self::DomainParagraphFactPano, 'ogg', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'webm', NGProperty::TypeUID, self::DomainParagraphFactPano, 'webm', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}

	public function render() {
		if ($this->text !== '') {
			$adapter = new NGDBAdapterObject ();
			$template = new NGTemplate ();
			$richtext = new NGRichText ();
			$richtext->previewMode = $this->previewMode;
			$pictureheight=-1;
			$pictureratio = NGPicture::RatioNone;
			
			if ($this->mp4 !== "") {
				$mp4download = $adapter->loadObject ( $this->mp4, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($mp4download !== null) {
					$template->assign ( 'mp4', NGUtil::prependStorePath ( $mp4download->pathToFile () ) );
					$pictureheight=1080;
					$pictureratio = NGPicture::Ratio16by9;
				}
			}
			
			if ($this->ogg !== "") {
				$oggdownload = $adapter->loadObject ( $this->ogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($oggdownload !== null) {
					$template->assign ( 'ogg', NGUtil::prependStorePath ( $oggdownload->pathToFile () ) );
					$pictureheight=1080;
					$pictureratio = NGPicture::Ratio16by9;
				}
			}
			
			if ($this->webm !== "") {
				$webmdownload = $adapter->loadObject ( $this->webm, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($webmdownload !== null) {
					$template->assign ( 'webm', NGUtil::prependStorePath ( $webmdownload->pathToFile () ) );
					$pictureheight=1080;
					$pictureratio = NGPicture::Ratio16by9;
				}
			}
			
			if ($this->pictureuid !== '') {
			
				/* @var $picture NGPicture */
				$picture = $adapter->loadObject ( $this->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
				if ($picture != null) {
					$template->assign ( 'picturesize', $picture->getResizedSize ( 1920, $pictureheight, $pictureratio ) );
					$template->assign ( 'picturesrc', NGLink::getPictureURL ( $this->pictureuid, 1920, $pictureheight, $pictureratio ) );
				}
			}
			
			$template->assign ( 'subcaption', $this->subcaption );
			$template->assign ( 'text', $richtext->parse ( $this->text ) );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'colorforeground', $this->colorforeground );
			$template->assign ( 'colorbackground', $this->colorbackground );
			$template->assign ( 'colorimagebackground', $this->colorimagebackground );
			$template->assign ( 'colorframe', $this->colorframe );
			$template->assign ( 'framethickness', $this->framethickness );
			$template->assign ( 'paddingvertical', $this->paddingvertical );
			$template->assign ( 'paddinghorizontal', $this->paddinghorizontal );
			$template->assign ( 'parallax', $this->parallax );
			$template->assign ( 'textsize', $this->textsize );
			$template->assign ( 'captionsize', $this->captionsize );
			$template->assign ( 'round', $this->round );
			$template->assign ( 'animation', $this->animation );
			
			if ($this->brightness > 0)
				$template->assign ( 'overlay', sprintf ( 'rgba(255,255,255,%s)', abs ( $this->brightness ) / 100 ) );
			if ($this->brightness < 0)
				$template->assign ( 'overlay', sprintf ( 'rgba(0,0,0,%s)', abs ( $this->brightness ) / 100 ) );
			
			$webitems = array ();
			
			foreach ( $this->items as $item ) {
				
				$webitem = new NGPluginParagraphFactPanoItem ();
				
				$xml = new DOMDocument ( '1.0', 'UTF-8' );
				$xml->loadXML ( $item );
				
				/* @var $childElement DOMElement */
				foreach ( $xml->documentElement->childNodes as $childElement ) {
					if ($childElement->nodeType == XML_ELEMENT_NODE) {
						switch ($childElement->nodeName) {
							case 'caption' :
								$webitem->caption = $childElement->nodeValue;
								break;
							case 'icon' :
								$webitem->icon = $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphfactpano/img/?f=%s&c=%s', $childElement->nodeValue, $this->colorforeground ) );
								break;
							case 'link' :
								
								$link = new NGLink ( $this->previewMode );
								$link->parseURL ( $childElement->nodeValue );
								$webitem->linkurl = $link->getURL ();
								switch ($link->linkType) {
									case NGLink::LinkPicture :
										$webitem->linkclass = 'gallery';
										break;
									case NGLink::LinkPagePopup :
									case NGLink::LinkTopicPopup :
										$webitem->linkclass = 'galleryiframe';
										break;
									case NGLink::LinkWWW :
										$webitem->linktarget = '_blank';
										break;
								}
								break;
						}
					}
				}
				
				$webitems [] = $webitem;
			}
			
			$template->assign ( 'items', $webitems );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphfactpano/tpl/layout.tpl' );
			
			$this->styleSheets ['NGPluginParagraphFactPano'] = $this->prependPluginsPath ( 'ngpluginparagraphfactpano/css/style.css' );
			$this->javaScripts ['NGPluginParagraphFactPano'] = $this->prependPluginsPath ( 'ngpluginparagraphfactpano/js/factpano.js' );
			$this->styles ['NGPluginParagraphFactPano' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphfactpano/tpl/style.tpl' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = self::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = self::RenderModeAlwaysFullWidth;
		}
	}
}

class NGPluginParagraphFactPanoItem {

	public $caption = '';

	public $icon;

	public $linkurl;

	public $linkclass;

	public $linktarget;
}