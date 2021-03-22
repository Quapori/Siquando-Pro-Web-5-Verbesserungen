<?php

class NGPluginParagraphStickyButton extends NGPluginParagraph {
	const ObjectTypePluginParagraphStickyButton = 'NGPluginParagraphStickyButton';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphStickyButton = 'paragraphstickybutton';

	public $text = '';

	public $delay = 0;

	public $fontfamily = 'Open Sans';

	public $fontsize = 20;

	public $round = 6;

	public $verticalspacing = 8;

	public $horizontalspacing = 6;

	public $fontbold = false;

	public $fontitalic = false;

	public $fontcolor = 'ffffff';

	public $backcolor = 'b80f0f';

	public $framecolor = '000000';

	public $framewidth = 0;

	public $dropshadow = false;

	public $position = 'bottomright';

	public $link = '';

	public $iconstyle = '';

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
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'text', NGProperty::TypeText, self::DomainParagraphStickyButton, 'text', NGPropertyMapped::MultiplicityScalar, true, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'delay', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontfamily', NGProperty::TypeString, self::DomainParagraphStickyButton, 'fontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontsize', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'fontsize', NGPropertyMapped::MultiplicityScalar, false, 20 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'round', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'round', NGPropertyMapped::MultiplicityScalar, false, 6 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'verticalspacing', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'verticalspacing', NGPropertyMapped::MultiplicityScalar, false, 8 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'horizontalspacing', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'horizontalspacing', NGPropertyMapped::MultiplicityScalar, false, 16 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontbold', NGProperty::TypeBool, self::DomainParagraphStickyButton, 'fontbold', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontitalic', NGProperty::TypeBool, self::DomainParagraphStickyButton, 'fontitalic', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolor', NGProperty::TypeString, self::DomainParagraphStickyButton, 'fontcolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolor', NGProperty::TypeString, self::DomainParagraphStickyButton, 'backcolor', NGPropertyMapped::MultiplicityScalar, false, 'b80f0f' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framecolor', NGProperty::TypeString, self::DomainParagraphStickyButton, 'framecolor', NGPropertyMapped::MultiplicityScalar, false, '000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'framewidth', NGProperty::TypeInt, self::DomainParagraphStickyButton, 'framewidth', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'dropshadow', NGProperty::TypeBool, self::DomainParagraphStickyButton, 'dropshadow', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'position', NGProperty::TypeString, self::DomainParagraphStickyButton, 'position', NGPropertyMapped::MultiplicityScalar, false, 'bottomright' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'link', NGProperty::TypeString, self::DomainParagraphStickyButton, 'link', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'iconstyle', NGProperty::TypeString, self::DomainParagraphStickyButton, 'iconstyle', NGPropertyMapped::MultiplicityScalar, false, '' );
	}

	public function render() {
		if ($this->text !== '') {
			
			$this->template = new NGTemplate ();
			
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
			
			if ($this->fontsize > 16)
				$factor = 16 / $this->fontsize;
			
			if (strpos ( $this->position, 'top' ) === 0 || strpos ( $this->position, 'right' ) === 0) {
				if ($this->round > 0) {
					$this->template->assign ( 'round', sprintf ( '0 0 %spx %spx', $this->round, $this->round ) );
					$this->template->assign ( 'roundscaled', sprintf ( '0 0 %spx %spx', ceil ( $this->round * $factor ), ceil ( $this->round * $factor ) ) );
				}
				if ($this->framewidth > 0) {
					$this->template->assign ( 'framewidth', sprintf ( '0 %spx %spx %spx', $this->framewidth, $this->framewidth, $this->framewidth ) );
					$this->template->assign ( 'framewidthscaled', sprintf ( '0 %spx %spx %spx', ceil ( $this->framewidth * $factor ), ceil ( $this->framewidth * $factor ), ceil ( $this->framewidth * $factor ) ) );
				}
				if ($this->delay > 0)
					$this->template->assign ( 'translate', '0,-200%' );
			}
			
			if (strpos ( $this->position, 'right' ) === 0 || strpos ( $this->position, 'left' ) === 0) {
				$this->template->assign ( 'rotate', '90deg' );
			}
			
			if (strpos ( $this->position, 'bottom' ) === 0 || strpos ( $this->position, 'left' ) === 0) {
				if ($this->round > 0) {
					$this->template->assign ( 'round', sprintf ( '%spx %spx 0 0', $this->round, $this->round ) );
					$this->template->assign ( 'roundscaled', sprintf ( '%spx %spx 0 0', ceil ( $this->round * $factor ), ceil ( $this->round * $factor ) ) );
				}
				if ($this->framewidth > 0) {
					$this->template->assign ( 'framewidth', sprintf ( '%spx %spx 0 %spx', $this->framewidth, $this->framewidth, $this->framewidth ) );
					$this->template->assign ( 'framewidthscaled', sprintf ( '%spx %spx 0 %spx', ceil ( $this->framewidth * $factor ), ceil ( $this->framewidth * $factor ), ceil ( $this->framewidth * $factor ) ) );
				}
				if ($this->delay > 0)
					$this->template->assign ( 'translate', '0,200%' );
			}
			
			$this->template->assign ( 'fontcolor', $this->fontcolor );
			$this->template->assign ( 'backcolor', $this->backcolor );
			$this->template->assign ( 'verticalspacing', $this->verticalspacing );
			$this->template->assign ( 'horizontalspacing', $this->horizontalspacing );
			$this->template->assign ( 'verticalspacingscaled', ceil ( $this->verticalspacing * $factor ) );
			$this->template->assign ( 'horizontalspacingscaled', ceil ( $this->horizontalspacing * $factor ) );
			$this->template->assign ( 'position', $this->position );
			$this->template->assign ( 'fontsize', $this->fontsize );
			$this->template->assign ( 'fontfamily', NGFontUtil::getInstance ()->getFontStack ( $this->fontfamily ) );
			$this->template->assign ( 'fontbold', $this->fontbold );
			$this->template->assign ( 'fontitalic', $this->fontitalic );
			$this->template->assign ( 'shadow', $this->dropshadow );
			$this->template->assign ( 'framecolor', $this->framecolor );
			$this->template->assign ( 'delay', $this->delay );
			$this->template->assign ( 'text', $this->text );
			$this->template->assign ( 'uid', $this->objectUID );
			$this->template->assign ( 'responsive', $this->fontsize > 16 && $this->responsive );
			
			if ($this->iconstyle !== '')
				$this->template->assign ( 'icon', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphstickybutton/img/?f=%s&c=%s', $this->iconstyle, $this->fontcolor ) ) );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphstickybutton/tpl/layout.tpl' );
			$this->styles ['NGPluginParagraphStickyButton' . $this->objectUID] = $this->template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphstickybutton/tpl/style.tpl' );
			$this->javaScripts ['NGPluginParagraphStickyButton'] = $this->prependPluginsPath ( 'ngpluginparagraphstickybutton/js/stickybutton.js' );
		}
	}
}