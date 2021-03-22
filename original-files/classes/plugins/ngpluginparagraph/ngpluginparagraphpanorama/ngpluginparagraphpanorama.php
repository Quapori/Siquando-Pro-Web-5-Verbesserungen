<?php

class NGPluginParagraphPanorama extends NGPluginParagraph {
	const ObjectTypePluginParagraphPanorama = 'NGPluginParagraphPanorama';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphPanorama = "paragraphpanorama";

	public $pictureuid = '';

	public $uselocalcaption = false;

	public $localCaption = '';

	public $localSummary = '';

	public $captioncolor = 'ffffff';

	public $framecolor = '';

	public $fademode = 'None';

	public $captionposition = 'BottomLeft';

	public $crop = NGPicture::Ratio3by1;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureuid', NGProperty::TypeUID, self::DomainParagraphPanorama, 'pictureuid', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'uselocalcaption', NGProperty::TypeBool, self::DomainParagraphPanorama, 'uselocalcaption', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'localcaption', NGProperty::TypeString, self::DomainParagraphPanorama, 'localCaption', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'localsummary', NGProperty::TypeText, self::DomainParagraphPanorama, 'localSummary', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captioncolor', NGProperty::TypeString, self::DomainParagraphPanorama, 'captioncolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framecolor', NGProperty::TypeString, self::DomainParagraphPanorama, 'framecolor', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fademode', NGProperty::TypeString, self::DomainParagraphPanorama, 'fademode', NGPropertyMapped::MultiplicityScalar, false, 'None', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionposition', NGProperty::TypeString, self::DomainParagraphPanorama, 'captionposition', NGPropertyMapped::MultiplicityScalar, false, 'BottomLeft', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphPanorama, 'crop', NGPropertyMapped::MultiplicityScalar, false, NGPicture::Ratio3by1, false );
	}

	public function render() {
		$pictureAdapter = new NGDBAdapterObject ();
		
		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $this->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		$ratio = NGPicture::stringToRatio ( $this->crop );
		
		if ($picture != null) {
			$richText = new NGRichText ();
			$richText->previewMode = $this->previewMode;
			$size = $picture->getResizedSize ( 1920, - 1, NGPicture::stringToRatio ( $this->crop ) );
			
			$template = new NGTemplate ();
			
			$template->assign ( 'source', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height, $ratio ) );
			$template->assign ( 'width', $size->width );
			$template->assign ( 'height', $size->height );
			$template->assign ( 'alt', $picture->alt );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'captioncolor', $this->captioncolor );
			$template->assign ( 'framecolor', $this->framecolor );
			$template->assign ( 'position', strtolower ( $this->captionposition ) );
			
			$template->assign ( 'caption', $this->uselocalcaption ? $this->localCaption : $picture->caption );
			$template->assign ( 'summary', $richText->parse ( $this->uselocalcaption ? $this->localSummary : $picture->summary ) );
			
			if ($this->fademode === 'Dark') {
				if ($this->captionposition === 'TopLeft' || $this->captionposition === 'TopRight') {
					$template->assign ( 'fade', $this->prependPluginsPath ( 'ngpluginparagraphpanorama/svg/darkfadetop.svg' ) );
				} else {
					$template->assign ( 'fade', $this->prependPluginsPath ( 'ngpluginparagraphpanorama/svg/darkfadebottom.svg' ) );
				}
				$template->assign ( 'bgcolor', '#000000' );
			}
			
			if ($this->fademode === 'Bright') {
				if ($this->captionposition === 'TopLeft' || $this->captionposition === 'TopRight') {
					$template->assign ( 'fade', $this->prependPluginsPath ( 'ngpluginparagraphpanorama/svg/brightfadetop.svg' ) );
				} else {
					$template->assign ( 'fade', $this->prependPluginsPath ( 'ngpluginparagraphpanorama/svg/brightfadebottom.svg' ) );
				}
				$template->assign ( 'bgcolor', '#ffffff' );
			}
			
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpanorama/tpl/layout.tpl' );
			
			$this->styleSheets ['NGPluginParagraphPanorama'] = $this->prependPluginsPath ( 'ngpluginparagraphpanorama/css/style.css' );
			$this->styles ['NGPluginParagraphPanorama' . $this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphpanorama/tpl/style.tpl' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			if ($this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
}