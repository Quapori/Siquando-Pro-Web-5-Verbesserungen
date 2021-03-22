<?php

class NGSettingsStandardPages extends NGSetting {
	const IdPages = 'pages';
	const ObjectTypeSettingsStandardPages = 'NGSettingsStandardPages';
	const DomainStandardPages = 'standardpages';
	
	public $pageuids = array ();
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pageuids', NGProperty::TypeUID, self::DomainStandardPages, 'pageuids', NGPropertyMapped::MultiplicityDictornary );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdPages );
	}
}