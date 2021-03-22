<?php

class NGPluginParagraphSlider extends NGPluginParagraph {
	const ObjectTypePluginParagraphSlider = 'NGPluginParagraphSlider';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphSlider = 'paragraphslider';

	/**
	 * Loaded items
	 *
	 * @var string
	 */
	public $items = '';

	/**
	 * Crop ratio
	 *
	 * @var string
	 */
	public $crop = 'Ratio4by3';

	/**
	 * Change delay
	 *
	 * @var int
	 */
	public $delay = 0;

	/**
	 * Captionfont
	 *
	 * @var string
	 */
	public $captionfont = 'Raleway,36,false,false,false,ffffff';

	/**
	 *
	 * Caption background
	 *
	 * @var string
	 */
	public $captionbackground = '';

	/**
	 *
	 * Caption shadow
	 *
	 * @var bool
	 */
	public $captionshadow = true;

	/**
	 * SubCaptionfont
	 *
	 * @var string
	 */
	public $subcaptionfont = 'Raleway,18,false,false,true,ffffff';

	/**
	 *
	 * Caption background
	 *
	 * @var string
	 */
	public $subcaptionbackground = '000000';

	/**
	 *
	 * Caption shadow
	 *
	 * @var bool
	 */
	public $subcaptionshadow = false;

	/**
	 *
	 * Margin
	 *
	 * @var int
	 */
	public $margin = 20;

	/**
	 *
	 * Bullet style
	 *
	 * @var string
	 */
	public $bulletstyle = 'default';

	/**
	 *
	 * Bullet color a
	 *
	 * @var string
	 */
	public $bulletcolora = 'afafaf';

	/**
	 *
	 * Bullet color b
	 *
	 * @var string
	 */
	public $bulletcolorb = 'd7d7d7';

	/**
	 *
	 * Prev Next style
	 *
	 * @var string
	 */
	public $prevnextstyle = 'default';

	/**
	 *
	 * Prev Next color a
	 *
	 * @var string
	 */
	public $prevnextcolora = '000000';

	/**
	 *
	 * Prev Next color b
	 *
	 * @var string
	 */
	public $prevnextcolorb = 'ffffff';

	/**
	 *
	 * Color of letterbox
	 *
	 * @var string
	 */
	public $letterbox = '808080';

	/**
	 *
	 * Video controls
	 *
	 * @var bool
	 */
	public $controls = false;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphSlider, 'items', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'crop', NGProperty::TypeString, self::DomainParagraphSlider, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio4by3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphSlider, 'delay', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionfont', NGProperty::TypeString, self::DomainParagraphSlider, 'captionfont', NGPropertyMapped::MultiplicityScalar, false, 'Raleway,36,false,false,false,ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionbackground', NGProperty::TypeString, self::DomainParagraphSlider, 'captionbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionshadow', NGProperty::TypeBool, self::DomainParagraphSlider, 'captionshadow', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'subcaptionfont', NGProperty::TypeString, self::DomainParagraphSlider, 'subcaptionfont', NGPropertyMapped::MultiplicityScalar, false, 'Raleway,18,false,false,true,ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'subcaptionbackground', NGProperty::TypeString, self::DomainParagraphSlider, 'subcaptionbackground', NGPropertyMapped::MultiplicityScalar, false, '000000', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'subcaptionshadow', NGProperty::TypeBool, self::DomainParagraphSlider, 'subcaptionshadow', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'margin', NGProperty::TypeInt, self::DomainParagraphSlider, 'margin', NGPropertyMapped::MultiplicityScalar, false, 20, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bulletstyle', NGProperty::TypeString, self::DomainParagraphSlider, 'bulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bulletcolora', NGProperty::TypeString, self::DomainParagraphSlider, 'bulletcolora', NGPropertyMapped::MultiplicityScalar, false, 'afafaf', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bulletcolorb', NGProperty::TypeString, self::DomainParagraphSlider, 'bulletcolorb', NGPropertyMapped::MultiplicityScalar, false, 'd7d7d7', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'prevnextstyle', NGProperty::TypeString, self::DomainParagraphSlider, 'prevnextstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'prevnextcolora', NGProperty::TypeString, self::DomainParagraphSlider, 'prevnextcolora', NGPropertyMapped::MultiplicityScalar, false, '000000', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'prevnextcolorb', NGProperty::TypeString, self::DomainParagraphSlider, 'prevnextcolorb', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'letterbox', NGProperty::TypeString, self::DomainParagraphSlider, 'letterbox', NGPropertyMapped::MultiplicityScalar, false, '808080', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'controls', NGProperty::TypeBool, self::DomainParagraphSlider, 'controls', NGPropertyMapped::MultiplicityScalar, false, false, false );
	}

	public function hexToRgba($hex, $alpha) {
		if (strlen ( $hex ) == 6) {
			$r = hexdec ( substr ( $hex, 0, 2 ) );
			$g = hexdec ( substr ( $hex, 2, 2 ) );
			$b = hexdec ( substr ( $hex, 4, 2 ) );
			return sprintf ( 'rgba(%u,%u,%u,%s)', $r, $g, $b, $alpha );
		} else {
			return '';
		}
	}

	public function render() {
		$slides = Array ();
		
		$ratio = NGPicture::stringToRatio ( $this->crop );
		
		$width = $this->renderWidth;
		
		if ($this->responsive && $width<768) $width=768;
		
		$height = floor ( $width / NGPicture::ratioByRatioType ( $ratio ) );
		
		$controller = new NGDBAdapterObject ();
		
		if ($this->items !== '') {
			
			$xml = new DOMDocument ( '1.0', 'UTF-8' );
			$xml->loadXML ( $this->items );
			
			foreach ( $xml->documentElement->childNodes as $itemElement ) {
				/* @var $itemElement DOMElement */
				if ($itemElement->nodeType == XML_ELEMENT_NODE) {
					if ($itemElement->nodeName == 'item') {
						$slide = new NGPluginParagraphSliderSlide ();
						
						foreach ( $itemElement->childNodes as $node ) {
							/* @var $node DOMElement */
							if ($node->nodeType == XML_ELEMENT_NODE) {
								switch ($node->nodeName) {
									case 'picture':
										/* @var $picture NGPicture */
										$picture = $controller->loadObject ( $node->nodeValue, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
										if ($picture != null) {
											$slide->source = NGLink::getPictureURL ( $picture->objectUID, $width, $height, $ratio );
											
											if (NGSettingsSite::getInstance ()->hdpictures) {
												$slide->sourcehd = NGLink::getPictureURL ( $picture->objectUID, $width * 2, $height * 2, $ratio );
											}
											
											$slide->alt = $picture->alt;
											$slide->title = $picture->title;
										}
										break;
									case 'audiomp3' :
										
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$slide->audiomp3 = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'audioogg' :
										
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$slide->audioogg = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'videomp4' :
										
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$slide->videomp4 = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'videoogg' :
										
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$slide->videoogg = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'videowebm' :
										
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$slide->videowebm = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'caption' :
										
										$slide->caption = $node->nodeValue;
										break;
									case 'subcaption' :
										
										$slide->subcaption = $node->nodeValue;
										break;
									case 'cappos' :
										
										$slide->cappos = strtolower ( $node->nodeValue );
										break;
									case 'link' :
										
										if ($node->nodeValue !== '') {
											$link = new NGLink ( $this->previewMode );
											$link->parseURL ( $node->nodeValue );
											$slide->link = $link;
										}
								}
							}
						}
						
						if ($slide->source !== '')
							$slides [] = $slide;
					}
				}
			}
			
			if (count ( $slides ) > 0) {
				
				$template = new NGTemplate ();
				
				$template->assign ( 'slides', $slides );
				$template->assign ( 'width', $width );
				$template->assign ( 'height', $height );
				$template->assign ( 'id', $this->objectUID );
				$template->assign ( 'prevnext', $this->prevnextstyle );
				$template->assign ( 'bullet', $this->bulletstyle );
				$template->assign ( 'delay', $this->delay );
				$template->assign ( 'letterbox', $this->letterbox );
				$template->assign ( 'controls', $this->controls );
				$template->assign ( 'trans', $this->prependPluginsPath ( 'ngpluginparagraphslider/img/trans.gif' ) );
				
				$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphslider/tpl/layout.tpl' );
				
				$this->styleSheets ['NGPluginParagraphSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphslider/css/style.css' );
				$this->javaScripts ['NGPluginParagraphSlider'] = $this->prependPluginsPath ( 'ngpluginparagraphslider/js/slider.js' );
				
				$captionfont = new NGFont ( $this->captionfont );
				$subcaptionfont = new NGFont ( $this->subcaptionfont );
				
				$captionbackground = $this->hexToRgba ( $this->captionbackground, 0.5 );
				$subcaptionbackground = $this->hexToRgba ( $this->subcaptionbackground, 0.5 );
				$captionpad = floor ( $captionfont->fontsize / 4 );
				$subcaptionpad = floor ( $subcaptionfont->fontsize / 4 );
				
				$styleTemplate = new NGTemplate ();
				$styleTemplate->assign ( 'id', $this->objectUID );
				$styleTemplate->assign ( 'captionfont', $this->captionfont );
				$styleTemplate->assign ( 'captionshadow', $this->captionshadow );
				$styleTemplate->assign ( 'captionbackground', $captionbackground );
				$styleTemplate->assign ( 'captionpad', $captionpad );
				
				$styleTemplate->assign ( 'subcaptionbackground', $subcaptionbackground );
				$styleTemplate->assign ( 'subcaptionfont', $this->subcaptionfont );
				$styleTemplate->assign ( 'subcaptionshadow', $this->subcaptionshadow );
				$styleTemplate->assign ( 'subcaptionpad', $subcaptionpad );
				$styleTemplate->assign ( 'margin', $this->margin );
				
				$styleTemplate->assign ( 'bullet', $this->prependPluginsPath ( 'ngpluginparagraphslider/img/?f=round' ) );
				
				if ($this->prevnextstyle !== '') {
					$styleTemplate->assign ( 'next', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphslider/img/?f=next%s&ca=%s&cb=%s', $this->prevnextstyle, $this->prevnextcolora, $this->prevnextcolorb ) ) );
					$styleTemplate->assign ( 'prev', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphslider/img/?f=prev%s&ca=%s&cb=%s', $this->prevnextstyle, $this->prevnextcolora, $this->prevnextcolorb ) ) );
				}
				
				if ($this->bulletstyle !== '') {
					$styleTemplate->assign ( 'bullet', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphslider/img/?f=bullet%s&ca=%s&cb=%s', $this->bulletstyle, $this->bulletcolora, $this->bulletcolorb ) ) );
				}
				
				$this->styles ['NGPluginParagraphSlider' . $this->objectUID] = $styleTemplate->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphslider/tpl/localstyle.tpl' );
				
				if ($this->allowMobileFullWidth)
					$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			}
		}
	}
}

class NGPluginParagraphSliderSlide {

	public $source = '';

	public $sourcehd = '';

	public $alt = '';

	public $title = '';

	public $link = null;

	public $caption = '';

	public $subcaption = '';

	public $audiomp3 = '';

	public $audioogg = '';

	public $videomp4 = '';

	public $videoogg = '';

	public $videowebm = '';

	public $cappos = 'bottomleft';
}