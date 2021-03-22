<?php

class NGSettingsLanguage extends NGSetting {
	const IdLanguage = 'Language';
	const ObjectTypeSettingsLanguage = 'NGSettingsLanguage';
	const DomainLanguage='language';
	
	public $languageResources = Array();
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'resources', NGProperty::TypeText, self::DomainLanguage, 'languageResources', NGPropertyMapped::MultiplicityDictornary, true);
	}	
}