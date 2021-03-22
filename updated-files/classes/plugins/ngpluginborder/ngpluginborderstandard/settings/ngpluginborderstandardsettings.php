<?php

class NGPluginBorderStandardSettings extends NGSetting {
	
	const IdBorder = 'Border';
	const ObjectTypeBorderSettings = 'NGPluginBorderStandardSettings';
	const DomainBorder = 'border';
	
	/**
	 * 
	 * Background
	 * @var string
	 */
	public $background = 'solid ffffff';
	
	/**
	 * 
	 * Width of border
	 * @var string
	 */
	public $borderwidth = '1';
	
	/**
	 * 
	 * Color of border
	 * @var string
	 */
	public $bordercolor = 'e3e3e3';
	
	/**
	 * 
	 * Margin of border
	 * @var string
	 */
	public $margin = '0';
	
	/**
	 * 
	 * Padding of border
	 * @var string
	 */
	public $padding = '10';
	
	/**
	 * 
	 * Shadow of border
	 * @var unknown_type
	 */
	public $shadow = '3 3 0 SE';
	
	/**
	 * 
	 * roundness of border
	 * @var string
	 */
	public $roundedcorners = '0';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'background', NGProperty::TypeString, self::DomainBorder, 'background', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'borderwidth', NGProperty::TypeString, self::DomainBorder, 'borderwidth', NGPropertyMapped::MultiplicityScalar, false, '1', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bordercolor', NGProperty::TypeString, self::DomainBorder, 'bordercolor', NGPropertyMapped::MultiplicityScalar, false, 'e3e3e3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'margin', NGProperty::TypeString, self::DomainBorder, 'margin', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'padding', NGProperty::TypeString, self::DomainBorder, 'padding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'shadow', NGProperty::TypeString, self::DomainBorder, 'shadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'roundedcorners', NGProperty::TypeString, self::DomainBorder, 'roundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdBorder );
	}

}