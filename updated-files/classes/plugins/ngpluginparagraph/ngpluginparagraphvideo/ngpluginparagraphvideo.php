<?php
class NGPluginParagraphVideo extends NGPluginParagraph {
	const ObjectTypePluginParagraphVideo = 'NGPluginParagraphVideo';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphVideo = 'paragraphvideo';
	public $mp4 = '';
	public $ogg = '';
	public $webm = '';
	public $autoplay = false;
	public $loop = false;
	public $controls = false;
	public $widescreen = true;
	public $boilerplate = '';
	public $poster = '';
	public $popup = false;
	public $muted = false;
	public $requestallwaysfullwidth = false;
	public $playsinline=false;
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mp4', NGProperty::TypeUID, self::DomainParagraphVideo, 'mp4', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'ogg', NGProperty::TypeUID, self::DomainParagraphVideo, 'ogg', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'webm', NGProperty::TypeUID, self::DomainParagraphVideo, 'webm', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'autoplay', NGProperty::TypeBool, self::DomainParagraphVideo, 'autoplay', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'loop', NGProperty::TypeBool, self::DomainParagraphVideo, 'loop', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'controls', NGProperty::TypeBool, self::DomainParagraphVideo, 'controls', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'widescreen', NGProperty::TypeBool, self::DomainParagraphVideo, 'widescreen', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'boilerplate', NGProperty::TypeText, self::DomainParagraphVideo, 'boilerplate', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'poster', NGProperty::TypeUID, self::DomainParagraphVideo, 'poster', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'popup', NGProperty::TypeBool, self::DomainParagraphVideo, 'popup', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'muted', NGProperty::TypeBool, self::DomainParagraphVideo, 'muted', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'playsinline', NGProperty::TypeBool, self::DomainParagraphVideo, 'playsinline', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'requestallwaysfullwidth', NGProperty::TypeBool, self::DomainParagraphVideo, 'requestallwaysfullwidth', NGPropertyMapped::MultiplicityScalar, false, false, false );
	}
	public function render() {
		$popup = ($this->popup && $this->poster !== '');
		
		$template = new NGTemplate ();
		
		$controller = new NGDBAdapterObject ();
		
		if ($this->responsive) {
			if ($this->widescreen) {
				$width = 1920;
				$height = 1080;
			} else {
				$width = 1024;
				$height = 768;
			}
		} else {
			$width = $this->renderWidth;
			
			if ($this->widescreen) {
				$height = floor ( $width / 16 * 9 );
			} else {
				$height = floor ( $width / 4 * 3 );
			}
		}
		
		if ($this->mp4 !== "") {
			$mp4download = $controller->loadObject ( $this->mp4, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
			if ($mp4download !== null) {
				$template->assign ( 'mp4', NGUtil::prependStorePath ( $mp4download->pathToFile () ) );
			}
		}
		
		if ($this->ogg !== "") {
			$oggdownload = $controller->loadObject ( $this->ogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
			if ($oggdownload !== null) {
				$template->assign ( 'ogg', NGUtil::prependStorePath ( $oggdownload->pathToFile () ) );
			}
		}
		
		if ($this->webm !== "") {
			$webmdownload = $controller->loadObject ( $this->webm, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
			if ($webmdownload !== null) {
				$template->assign ( 'webm', NGUtil::prependStorePath ( $webmdownload->pathToFile () ) );
			}
		}
		
		if ($this->poster !== '') {
			$pictureAdapter = new NGDBAdapterObject ();
			/* @var $picture NGPicture */
			$picture = $pictureAdapter->loadObject ( $this->poster, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
			if ($picture != null) {
				$size = $picture->getResizedSize ( $this->renderWidth, $this->popup ? - 1 : $height );
				$template->assign ( 'poster', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height ) );
				$template->assign ( 'sourceplay', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphvideo/img/play.svg' ) );
				$template->assign ( 'posterwidth', $size->width );
				$template->assign ( 'posterheight', $size->height );
			}
		}
		
		$template->assign ( 'height', $height );
		$template->assign ( 'width', $width );
		$template->assign ( 'controls', $this->controls );
		$template->assign ( 'loop', $this->loop );
		$template->assign ( 'muted', $this->muted );
		$template->assign ( 'autoplay', $this->autoplay );
		$template->assign ( 'boilerplate', $this->boilerplate );
		$template->assign ( 'popup', $popup );
		$template->assign ( 'responsive', $this->responsive );
		$template->assign ( 'playsinline', $this->playsinline );
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphvideo/tpl/layout.tpl' );
		
		if ($this->allowMobileFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
		
		if ($this->requestallwaysfullwidth && $this->allowAlwaysFullWidth)
			$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
	}
}