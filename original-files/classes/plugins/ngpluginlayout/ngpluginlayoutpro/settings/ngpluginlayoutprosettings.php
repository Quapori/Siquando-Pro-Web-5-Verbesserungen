<?php

class NGPluginLayoutProSettings extends NGSetting {
	const IdLayoutPro = 'LayoutPro';
	const ObjectTypePluginLayoutProSettings = 'NGPluginLayoutProSettings';
	const DomainLayoutPro = 'LayoutPro';
	
	public $config = array ();
	public $template = '';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'config', NGProperty::TypeText, self::DomainLayoutPro, 'config', NGPropertyMapped::MultiplicityDictornary );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'template', NGProperty::TypeString, self::DomainLayoutPro, 'template', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdLayoutPro );
	}

}