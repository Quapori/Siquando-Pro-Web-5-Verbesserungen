<?php
class NGPluginParagraphGoogleMaps extends NGPluginParagraph {
	const ObjectTypePluginParagraphGoogleMaps = 'NGPluginParagraphGoogleMaps';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphGoogleMaps = "paragraphgmaps";
	private $richText;
	public $latitude = '';
	public $longitude = '';
	public $zoom = 0;
	public $maptype = '';
	public $showcontrols = false;
	public $nopopup = true;
	public $popup = '';
	public $mratio = 0.75;
	public $dynmap = true;
	public $apikey = '';
	public $requestallwaysfullwidth = false;
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		$this->propertiesMapped [] = new NGPropertyMapped ( 'popup', NGProperty::TypeBool, self::DomainParagraphGoogleMaps, 'popup', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maptype', NGProperty::TypeString, self::DomainParagraphGoogleMaps, 'maptype', NGPropertyMapped::MultiplicityScalar, false, 'ROADMAP' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'nopopup', NGProperty::TypeBool, self::DomainParagraphGoogleMaps, 'nopopup', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'dynmap', NGProperty::TypeBool, self::DomainParagraphGoogleMaps, 'dynmap', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcontrols', NGProperty::TypeBool, self::DomainParagraphGoogleMaps, 'showcontrols', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'latitude', NGProperty::TypeString, self::DomainParagraphGoogleMaps, 'latitude', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'longitude', NGProperty::TypeString, self::DomainParagraphGoogleMaps, 'longitude', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'zoom', NGProperty::TypeInt, self::DomainParagraphGoogleMaps, 'zoom', NGPropertyMapped::MultiplicityScalar, false, 15 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mratio', NGProperty::TypeFloat, self::DomainParagraphGoogleMaps, 'mratio', NGPropertyMapped::MultiplicityScalar, false, 0.75 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'apikey', NGProperty::TypeString, self::DomainParagraphGoogleMaps, 'apikey', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'requestallwaysfullwidth', NGProperty::TypeBool, self::DomainParagraphGoogleMaps, 'requestallwaysfullwidth', NGPropertyMapped::MultiplicityScalar, false, false, false );
	}
	public function render() {
		if ($this->latitude != '') {
			
			$this->richText->previewMode = $this->previewMode;
			$template = new NGTemplate ();
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'latitude', $this->latitude );
			$template->assign ( 'longitude', $this->longitude );
			$template->assign ( 'zoom', $this->zoom );
			$template->assign ( 'maptype', $this->maptype );
			$template->assign ( 'maptypestatic', strtolower ( $this->maptype ) );
			$template->assign ( 'showcontrols', $this->showcontrols );
			$template->assign ( 'nopopup', $this->nopopup );
			$template->assign ( 'popup', str_replace ( '<p', '<p style="margin:0;color:#000"', $this->richText->parse ( $this->popup ) ) );
			
			$width = $this->renderWidth;
			
			if ($this->requestallwaysfullwidth && $this->allowAlwaysFullWidth) {
				$width=1920;
			}
						
			if (! $this->dynmap && $width > 640) {
				$mw = ( int ) ($width / 2);
				$template->assign ( 'scale', '&amp;scale=2' );
			} else {
				$mw = $width;
			}
			
			$template->assign ( 'width', $mw );
			$template->assign ( 'height', ( int ) ($mw * $this->mratio) );
			$template->assign ( 'heightpercent', ($this->mratio * 100) );
			$template->assign ( 'responsive', $this->responsive );
			$template->assign ( 'apikey', $this->apikey );
			
			if ($this->dynmap) {
				$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphgooglemaps/tpl/dynamic.tpl' );
				$this->javaScripts ['googlemaps'] = 'https://maps.googleapis.com/maps/api/js?v=3.25&sensor=false&key=' . $this->apikey;
			} else {
				$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphgooglemaps/tpl/static.tpl' );
			}
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
			
			if ($this->requestallwaysfullwidth && $this->allowAlwaysFullWidth)
				$this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
		}
	}
	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}