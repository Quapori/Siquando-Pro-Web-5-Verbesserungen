<?php

class NGPluginLightboxSettings extends NGSetting {
	const IdLightbox = 'Lightbox';
	const ObjectTypeNGPluginLightboxSettings = 'NGPluginLightboxSettings';
	const DomainLightbox = 'Lightbox';
	
	public $style = 'default';
	public $navstyle = 'default';
	public $border = 'e5e5e5';
	public $background = 'ffffff';
	public $foreground = '333333';
	public $fader = '000000';
	public $colorcloser = '990033';
	public $colornav = 'b5b5b5';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'style', NGPropertyMapped::TypeString, self::DomainLightbox, 'style', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navstyle', NGPropertyMapped::TypeString, self::DomainLightbox, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'light', NGPropertyMapped::TypeBool, self::DomainLightbox, 'light', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'border', NGPropertyMapped::TypeString, self::DomainLightbox, 'border', NGPropertyMapped::MultiplicityScalar, false, 'e5e5e5' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'background', NGPropertyMapped::TypeString, self::DomainLightbox, 'background', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'foreground', NGPropertyMapped::TypeString, self::DomainLightbox, 'foreground', NGPropertyMapped::MultiplicityScalar, false, '333333' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fader', NGPropertyMapped::TypeString, self::DomainLightbox, 'fader', NGPropertyMapped::MultiplicityScalar, false, '000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorcloser', NGPropertyMapped::TypeString, self::DomainLightbox, 'colorcloser', NGPropertyMapped::MultiplicityScalar, false, '990033' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colornav', NGPropertyMapped::TypeString, self::DomainLightbox, 'colornav', NGPropertyMapped::MultiplicityScalar, false, 'b5b5b5' );
		
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdLightbox );
	}
}