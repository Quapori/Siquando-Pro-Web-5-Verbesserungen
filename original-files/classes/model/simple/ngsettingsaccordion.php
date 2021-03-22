<?php

class NGSettingsAccordion extends NGSetting {
	const IdAccordion = 'Accordion';
	const ObjectTypeSettingsAccordion = 'NGSettingsAccordion';
	const DomainAccordion='accordion';
	
	public $colorLine='d3d3d3';
	public $colorIcon='333333';
	public $widthLine=0;
	public $styleUID='default';
	public $animate=false;
	
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'styleuid', NGProperty::TypeString, self::DomainAccordion, 'styleUID', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'animate', NGProperty::TypeBool, self::DomainAccordion, 'animate', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueline', NGProperty::TypeString, self::DomainAccordion, 'colorLine', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueicon', NGProperty::TypeString, self::DomainAccordion, 'colorIcon', NGPropertyMapped::MultiplicityScalar, false, '333333', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'widthline', NGProperty::TypeInt, self::DomainAccordion, 'widthLine', NGPropertyMapped::MultiplicityScalar, false, 0, false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdAccordion );
	}
}