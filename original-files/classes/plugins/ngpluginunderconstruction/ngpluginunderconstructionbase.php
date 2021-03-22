<?php

class NGPluginUnderConstructionBase extends NGSetting {
	const IdUnderConstruction = 'underconst';
	const ObjectTypePluginUnderConstructionSettings = 'NGPluginUnderConstSettings';
	const ObjectClassPluginUnderConstructionBase = 'NGPluginUnderConstructionBase';
	const DomainUnderConstructionBase = 'underconstructionbase';
	
	public $isenabled=false;
		
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'isenabled', NGProperty::TypeBool, self::DomainUnderConstructionBase, 'isenabled', NGPropertyMapped::MultiplicityScalar, false, false, false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdUnderConstruction );
	}	
	
	public static function getIsEnabled()
	{
		$adapter = new NGDBAdapterObject ();
			
		/* @var $settings NGPluginUnderConstructionSettingsBase */
		$settings = $adapter->loadSetting ( NGPluginUnderConstructionBase::IdUnderConstruction, NGPluginUnderConstructionBase::ObjectTypePluginUnderConstructionSettings, NGPluginUnderConstructionBase::ObjectClassPluginUnderConstructionBase );
		
		return $settings->isenabled;
	}
}