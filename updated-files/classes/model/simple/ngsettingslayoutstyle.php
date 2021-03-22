<?php

class NGSettingsLayoutStyle extends NGSetting {
	const IdLayoutStyle = 'layoutstyle';
	const ObjectTypeSettingsLayoutStyle = 'NGSettingsLayoutStyle';
	const DomainLayoutStyle = 'layoutstyle';
	
	public $layoutstyleid = '';
	public $layoutsubstyleid = '';
	public $layouttype = 'NGPluginLayoutFlexR';
	public $paletteid = '';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'layoutstyleid', NGProperty::TypeString, self::DomainLayoutStyle, 'layoutstyleid', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'layoutsubstyleid', NGProperty::TypeString, self::DomainLayoutStyle, 'layoutsubstyleid', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'layouttype', NGProperty::TypeString, self::DomainLayoutStyle, 'layouttype', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginLayoutFlex', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'paletteid', NGProperty::TypeString, self::DomainLayoutStyle, 'paletteid', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdLayoutStyle );
	}
}