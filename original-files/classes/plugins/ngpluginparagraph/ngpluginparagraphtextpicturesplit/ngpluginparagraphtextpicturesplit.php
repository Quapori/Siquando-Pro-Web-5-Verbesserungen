<?php

class NGPluginParagraphTextPictureSplit extends NGPluginParagraph {
	const ObjectTypePluginParagraphTextPictureSplit = 'NGPluginParagraphTextPictureSplit';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTextPictureSplit = 'paragraphtextpicturesplit';

	public $pictureUID = '';

	public $click = '';

	public $link = '';

	private $richText;

	public $colorforeground = '444444';

	public $colorbackground = 'f0f0f0';

	public $pictureposition = 'Right';

	public $textpadding = '10%';

	public $heightmode = 'Content';

	public $panorama = true;

	public $crop = 'RatioUnknown';

	public $watermark = 'none';

	public $parallax = 0;

	public $fadeeffect = '';

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphTextPictureSplit, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'click', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'click', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'link', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'link', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'text', NGProperty::TypeText, self::DomainParagraphTextPictureSplit, 'text', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorforeground', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, '444444', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, 'f0f0f0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureposition', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'pictureposition', NGPropertyMapped::MultiplicityScalar, false, 'Right', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'textpadding', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'textpadding', NGPropertyMapped::MultiplicityScalar, false, '10%', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'heightmode', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'heightmode', NGPropertyMapped::MultiplicityScalar, false, 'Content', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeBool, self::DomainParagraphTextPictureSplit, 'panorama', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'RatioUnknown' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'watermark', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'watermark', NGPropertyMapped::MultiplicityScalar, false, 'none' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'parallax', NGProperty::TypeInt, self::DomainParagraphTextPictureSplit, 'parallax', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fadeeffect', NGProperty::TypeString, self::DomainParagraphTextPictureSplit, 'fadeeffect', NGPropertyMapped::MultiplicityScalar, false, '' );
	}

	public function render() {
		$pictureAdapter = new NGDBAdapterObject ();
		$this->richText->previewMode = $this->previewMode;
		
		$renderWidth = ceil ( $this->renderWidth * (1 + $this->parallax / 100) / 2 );
		$renderHeight = -1;
		
		if ($this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		if ($this->allowAlwaysFullWidth && $this->panorama) {
			$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
			$renderHeight = ceil ( 1080 * (1 + $this->parallax / 100) );
			$renderWidth=-1;
		}
		
		$ratio = NGPicture::stringToRatio ( $this->crop );
		
		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($picture != null) {
			
			$size = $picture->getResizedSize ( $renderWidth, $renderHeight, $ratio );
						
			$template = new NGTemplate ();
			$template->assign ( 'source', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height, $ratio ) );
			$template->assign ( 'width', $size->width );
			$template->assign ( 'height', $size->height );
			if ($this->watermark !== 'none')
				$template->assign ( 'watermark', NGUtil::joinPaths ( $this->prependPluginsPath ( 'ngpluginparagraphtextpicturesplit/styles' ), $this->watermark . '.svg' ) );
			
			if (NGSettingsSite::getInstance ()->lazyload) {
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
				if (NGSettingsSite::getInstance ()->hdpictures) {
					$template->assign ( 'sourcehd', NGLink::getPictureURL ( $picture->objectUID, $size->width * 2, $size->height * 2, $ratio ) );
				}
			}
			
			switch ($this->click) {
				case 'Enlarge' :
					$template->assign ( 'link', NGLink::getPictureURL ( $picture->objectUID ) );
					$template->assign ( 'linkclass', 'gallery' );
					break;
				case 'Link' :
					$link = new NGLink ( $this->previewMode );
					$link->parseURL ( $this->link );
					$template->assign ( 'link', $link->getURL () );
					switch ($link->linkType) {
						case NGLink::LinkPicture :
							$template->assign ( 'linkclass', 'gallery' );
							break;
						case NGLink::LinkPagePopup :
						case NGLink::LinkTopicPopup :
							$template->assign ( 'linkclass', 'galleryiframe' );
							break;
						case NGLink::LinkWWW :
							$template->assign ( 'linktarget', '_blank' );
							break;
					}
					break;
				default :
					$template->assign ( 'link', '' );
					break;
			}
			
			$template->assign ( 'alt', $picture->displayAlt () );
			$template->assign ( 'title', $picture->title );
			$template->assign ( 'colorforeground', $this->colorforeground );
			$template->assign ( 'colorbackground', $this->colorbackground );
			$template->assign ( 'textpadding', $this->textpadding );
			$template->assign ( 'text', $this->richText->parse ( $this->text ) );
			$template->assign ( 'pictureposition', strtolower ( $this->pictureposition ) );
			$template->assign ( 'heightmode', strtolower ( $this->heightmode ) );
			$template->assign ( 'parallax', $this->parallax );
			$template->assign ( 'fadeeffect', $this->fadeeffect );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtextpicturesplit/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphTextPictureSplit'] = $this->prependPluginsPath ( 'ngpluginparagraphtextpicturesplit/css/style.css' );
			$this->javaScripts ['NGPluginParagraphTextPictureSplit'] = $this->prependPluginsPath ( 'ngpluginparagraphtextpicturesplit/js/textpicturesplit.js' );
		}
	}

	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}