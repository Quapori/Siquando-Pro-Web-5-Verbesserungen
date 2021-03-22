<?php

class NGPluginParagraphPicture extends NGPluginParagraph {
	const ObjectTypePluginParagraphPicture = 'NGPluginParagraphPicture';
	const Product = 'SIQUANDO Pro 5';

	const DomainParagraphPicture = 'paragraphpicture';

	public $pictureUID = '';

	public $uselocalcaption = false;

	public $localCaption = '';

	public $localSummary = '';

	public $click = '';

	public $link = '';

	private $richText;

	public $buttonimage = '';
	public $buttonwidth = 0;
	public $buttonheight = 0;
	public $position = 'None';
	public $crop = 'RatioUnknown';

	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();

		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphPicture, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'uselocalcaption', NGProperty::TypeBool, self::DomainParagraphPicture, 'uselocalcaption', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'localcaption', NGProperty::TypeString, self::DomainParagraphPicture, 'localCaption', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'localsummary', NGProperty::TypeText, self::DomainParagraphPicture, 'localSummary', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'click', NGProperty::TypeString, self::DomainParagraphPicture, 'click', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'link', NGProperty::TypeString, self::DomainParagraphPicture, 'link', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonimage', NGProperty::TypeFile, self::DomainParagraphPicture, 'buttonimage', NGPropertyMapped::MultiplicityScalar, false, '', false, 'buttonimageState' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonwidth', NGProperty::TypeFile, self::DomainParagraphPicture, 'buttonwidth', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonheight', NGProperty::TypeFile, self::DomainParagraphPicture, 'buttonheight', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'position', NGProperty::TypeString, self::DomainParagraphPicture, 'position', NGPropertyMapped::MultiplicityScalar, false, 'None' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphPicture, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'RatioUnknown' );
	}

	public function render() {
		$pictureAdapter = new NGDBAdapterObject ();
		$this->richText->previewMode = $this->previewMode;

		$ratio = NGPicture::stringToRatio ( $this->crop );

		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );

		if ($picture != null) {

			$size = $picture->getResizedSize ( $this->renderWidth, - 1, $ratio );

			$template = new NGTemplate ();
			$template->assign ( 'source', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height, $ratio ) );
			$template->assign ( 'width', $size->width );
			$template->assign ( 'height', $size->height );

			if (NGSettingsSite::getInstance ()->lazyload) {
				$template->assign ( 'lazyload', NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/img/trans.gif') );
				if (NGSettingsSite::getInstance ()->hdpictures) {
					$template->assign ( 'sourcehd', NGLink::getPictureURL ( $picture->objectUID, $size->width * 2, $size->height * 2, $ratio ) );
				}
			}

			if ($this->buttonimage !== '' && $this->position !== 'None') {
				$template->assign ( 'buttonsource', NGUtil::prependStorePath ( $this->buttonimageState->path . $this->buttonimage ) );

				switch ($this->position) {
					case 'TopLeftOuter' :
						$horizontal = 'left';
						$vertical = 'top';
						$outer = true;
						break;
					case 'TopLeftInner' :
						$horizontal = 'left';
						$vertical = 'top';
						$outer = false;
						break;
					case 'TopRightOuter' :
						$horizontal = 'right';
						$vertical = 'top';
						$outer = true;
						break;
					case 'TopRightInner' :
						$horizontal = 'right';
						$vertical = 'top';
						$outer = false;
						break;
					case 'BottomLeftOuter' :
						$horizontal = 'left';
						$vertical = 'bottom';
						$outer = true;
						break;
					case 'BottomLeftInner' :
						$horizontal = 'left';
						$vertical = 'bottom';
						$outer = false;
						break;
					case 'BottomRightOuter' :
						$horizontal = 'right';
						$vertical = 'bottom';
						$outer = true;
						break;
					case 'BottomRightInner' :
						$horizontal = 'right';
						$vertical = 'bottom';
						$outer = false;
						break;
				}

				if (NGUtil::isMobile ()) {
					$offset = '10px';
				} else {
					$offset = $outer ? '-30px' : '10px';
				}

				$template->assign ( 'offset', $horizontal . ':' . $offset . ';' . $vertical . ':' . $offset );

				$maxwidth = floor ( $size->width * 0.6 );

				if ($this->buttonwidth > $maxwidth) {
					$template->assign ( 'buttonwidth', $maxwidth );
					$template->assign ( 'buttonheight', floor ( $maxwidth / $this->buttonwidth * $this->buttonheight ) );
				} else {
					$template->assign ( 'buttonwidth', $this->buttonwidth );
					$template->assign ( 'buttonheight', $this->buttonheight );
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

			$template->assign ( 'caption', $this->uselocalcaption ? $this->localCaption : $picture->caption );
			$template->assign ( 'alt', $picture->displayAlt () );
			$template->assign ( 'title', $picture->title );
			$template->assign ( 'responsive', $this->responsive );
			$template->assign ( 'summary', $this->richText->parse ( $this->uselocalcaption ? $this->localSummary : $picture->summary ) );

			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpicture/tpl/template.tpl' );

			if ($this->allowMobileFullWidth) $this->renderMode=self::RenderModeMobileFullWidth;
		}
	}

	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}

}