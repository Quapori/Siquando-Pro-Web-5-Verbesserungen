<?php

class NGSettingsStandardTopics extends NGSetting {
	const IdTopics = 'topics';
	const ObjectTypeSettingsStandardTopics = 'NGSettingsStandardTopics';
	const DomainStandardTopics = 'standardtopics';
	
	public $topicuids = array ();
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'topicuids', NGProperty::TypeUID, self::DomainStandardTopics, 'topicuids', NGPropertyMapped::MultiplicityDictornary );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdTopics );
	}
}