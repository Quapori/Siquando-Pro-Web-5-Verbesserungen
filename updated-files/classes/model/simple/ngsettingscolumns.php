<?php

class NGSettingsColumns extends NGSetting {
	const IdColumns = 'Columns';
	const ObjectTypeSettingsColumns = 'NGSettingsColumns';
	const DomainColumns='columns';
	
	public $colorSeparator='d3d3d3';
	public $widthSeparator=0;
	public $gutter=40;
	
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorvalueseparator', NGProperty::TypeString, self::DomainColumns, 'colorSeparator', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'widthseparator', NGProperty::TypeInt, self::DomainColumns, 'widthSeparator', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'gutter', NGProperty::TypeInt, self::DomainColumns, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 40, false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdColumns );
	}
}