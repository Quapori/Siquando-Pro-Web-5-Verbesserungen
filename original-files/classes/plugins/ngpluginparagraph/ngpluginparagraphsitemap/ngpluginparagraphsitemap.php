<?php
class NGPluginParagraphSitemap extends NGPluginParagraph {
	const ObjectTypePluginParagraphSitemap = 'NGPluginParagraphSitemap';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphSitemap = "paragraphsitemap";
	public $mapparentuid = NGUtil::ObjectUIDRootHome;
	public $mapstyle = "default";
	public $dynamic = true;
	public $animate = true;
	public $coloricon = '555555';
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mapparentuid', NGProperty::TypeUID, self::DomainParagraphSitemap, 'mapparentuid', NGPropertyMapped::MultiplicityScalar, false, NGUtil::ObjectUIDRootHome );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mapstyle', NGProperty::TypeString, self::DomainParagraphSitemap, 'mapstyle', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'dynamic', NGProperty::TypeBool, self::DomainParagraphSitemap, 'dynamic', NGPropertyMapped::MultiplicityScalar, true, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'animate', NGProperty::TypeBool, self::DomainParagraphSitemap, 'animate', NGPropertyMapped::MultiplicityScalar, true, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'coloricon', NGProperty::TypeString, self::DomainParagraphSitemap, 'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555' );
	}
	public function render() {
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		$htmlNav = $navigation->renderList ( NGSession::getInstance ()->getNavContent ()->findByUID ( $this->mapparentuid ), 999, false );
		
		// Fill template
		$template = new NGTemplate ();
		
		$template->assign ( 'nav', $htmlNav );
		$template->assign ( 'uid', $this->objectUID );
		$template->assign ( 'dynamic', $this->dynamic );
		$template->assign ( 'animate', $this->animate );
		
		$this->styleSheets ['NGPluginParagraphSitemap'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/css/style.css' );
		
		$template->assign ( 'uid', $this->objectUID );
		
		if (substr ( $this->mapstyle, - 4 ) == '.svg') {
			$template->assign ( 'style', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/img/?f=%s&c=%s', substr ( $this->mapstyle, 0, - 4 ), $this->coloricon ) ) );
			$template->assign ( 'styleexpanded', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/img/?f=%s_open&c=%s', substr ( $this->mapstyle, 0, - 4 ), $this->coloricon ) ) );
			$template->assign ( 'styleempty', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/img/?f=%s_empty&c=%s', substr ( $this->mapstyle, 0, - 4 ), $this->coloricon ) ) );
		} else {
			$template->assign ( 'style', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/' . $this->mapstyle . '.png' ) );
			$template->assign ( 'styleexpanded', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/' . $this->mapstyle . '_open.png' ) );
			$template->assign ( 'styleempty', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/styles/' . $this->mapstyle . '_empty.png' ) );
		}
		$this->styles ['NGPluginParagraphSitemap'.$this->objectUID] = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphsitemap/tpl/style.tpl' );
		
		if ($this->dynamic) {
			$this->javaScripts ['NGPluginParagraphSitemap'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphsitemap/js/sitemap.js' );
		}
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphsitemap/tpl/template.tpl' );
	}
}