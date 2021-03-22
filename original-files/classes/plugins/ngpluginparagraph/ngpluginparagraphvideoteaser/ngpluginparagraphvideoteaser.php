<?php

class NGPluginParagraphVideoTeaser extends NGPluginParagraph {
	const ObjectTypePluginParagraphVideo = 'NGPluginParagraphVideoTeaser';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphVideoTeaser = 'paragraphvideoteaser';

	public $mp4 = '';

	public $ogg = '';

	public $webm = '';

	public $loop = false;

	public $poster = '';

	public $closer = false;

	public $panorama = false;

	public $restart = true;

	public $controls = true;

	public $link = '';

	public $colorforeground = 'ffffff';

	public $colorbackground = '000000';

	/**
	 *
	 * @var NGTemplate
	 */
	private $template;

	/**
	 *
	 * @var NGDBAdapterObject
	 */
	private $controller;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mp4', NGProperty::TypeUID, self::DomainParagraphVideoTeaser, 'mp4', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'ogg', NGProperty::TypeUID, self::DomainParagraphVideoTeaser, 'ogg', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'webm', NGProperty::TypeUID, self::DomainParagraphVideoTeaser, 'webm', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'loop', NGProperty::TypeBool, self::DomainParagraphVideoTeaser, 'loop', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'poster', NGProperty::TypeUID, self::DomainParagraphVideoTeaser, 'poster', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'closer', NGProperty::TypeBool, self::DomainParagraphVideoTeaser, 'closer', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'panorama', NGProperty::TypeBool, self::DomainParagraphVideoTeaser, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'restart', NGProperty::TypeBool, self::DomainParagraphVideoTeaser, 'restart', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'controls', NGProperty::TypeBool, self::DomainParagraphVideoTeaser, 'controls', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'link', NGProperty::TypeUID, self::DomainParagraphVideoTeaser, 'link', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorforeground', NGProperty::TypeString, self::DomainParagraphVideoTeaser, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbackground', NGProperty::TypeString, self::DomainParagraphVideoTeaser, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '000000', false );
	}

	public function render() {
		if ($this->mp4 !== '' || $this->ogg !== '' || $this->webm !== '') {
			
			$this->template = new NGTemplate ();
			$this->controller = new NGDBAdapterObject ();
			
			if ($this->mp4 !== "") {
				$mp4download = $this->controller->loadObject ( $this->mp4, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($mp4download !== null) {
					$this->template->assign ( 'mp4', NGUtil::prependStorePath ( $mp4download->pathToFile () ) );
				}
			}
			
			if ($this->ogg !== "") {
				$oggdownload = $this->controller->loadObject ( $this->ogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($oggdownload !== null) {
					$this->template->assign ( 'ogg', NGUtil::prependStorePath ( $oggdownload->pathToFile () ) );
				}
			}
			
			if ($this->webm !== "") {
				$webmdownload = $this->controller->loadObject ( $this->webm, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
				if ($webmdownload !== null) {
					$this->template->assign ( 'webm', NGUtil::prependStorePath ( $webmdownload->pathToFile () ) );
				}
			}
			
			if ($this->poster !== '') {
				$this->template->assign ( 'poster', NGLink::getPictureURL ( $this->poster, 1920, 1080, NGPicture::Ratio16by9 ) );
			}
			
			if ($this->link !== '') {
				$link = new NGLink ( $this->previewMode );
				$link->parseURL ( $this->link );
				$this->template->assign ( 'link', $link->getURL () );
				switch ($link->linkType) {
					case NGLink::LinkPicture :
						$this->template->assign ( 'linkclass', 'gallery' );
						break;
					case NGLink::LinkPagePopup :
					case NGLink::LinkTopicPopup :
						$this->template->assign ( 'linkclass', 'galleryiframe' );
						break;
					case NGLink::LinkWWW :
						$this->template->assign ( 'linktarget', '_blank' );
						break;
				}
			}
			
			$this->template->assign ( 'controls', $this->controls );
			$this->template->assign ( 'loop', $this->loop );
			$this->template->assign ( 'closer', $this->closer );
			$this->template->assign ( 'panorama', $this->panorama );
			$this->template->assign ( 'restart', $this->restart );
			$this->template->assign ( 'colorforeground', $this->colorforeground );
			$this->template->assign ( 'colorbackground', $this->colorbackground );
			$this->template->assign ( 'sprite', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphvideoteaser/img/?f=sprite&ca=%s&cb=%s', $this->colorbackground, $this->colorforeground ) ) );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphvideoteaser/tpl/layout.tpl' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			
			if ($this->panorama && $this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
			
			$this->styleSheets ['NGPluginParagraphVideoTeaser'] = $this->prependPluginsPath ( 'ngpluginparagraphvideoteaser/css/style.css' );
			$this->javaScripts ['NGPluginParagraphVideoTeaser'] = $this->prependPluginsPath ( 'ngpluginparagraphvideoteaser/js/videoteaser.js' );
		}
	}
}