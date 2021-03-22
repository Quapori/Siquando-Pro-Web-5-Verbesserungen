<?php

class NGObjectNamed extends NGObjectMapped {
	const DomainName = 'name';
	
	const ObjectTypeObjectNamed = 'NGObjectNamed';
	
	public $name = '';
	public $caption = '';
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		$this->propertiesMapped [] = new NGPropertyMapped ( 'name', NGProperty::TypeString, self::DomainName, 'name', NGPropertyMapped::MultiplicityScalar, false, '', true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'caption', NGProperty::TypeString, self::DomainName, 'caption', NGPropertyMapped::MultiplicityScalar, true, '' );
	}
	
	public static function compareName(NGObjectNamed $a, NGObjectNamed $b) {
		return strcasecmp ( $a->name, $b->name );
	}
	
	public static function compareDate(NGObjectNamed $a, NGObjectNamed $b) {
		return strcasecmp ( $a->creationDate, $b->creationDate );
	}
	
	/**
	 * 
	 * Name to display
	 */
	public function displayName() {
		return ($this->caption == '') ? $this->name : $this->caption;
	}
	
	public function nameForURL() {
		switch ($this->objectUID) {
			case NGUtil::ObjectUIDRootHome :
				return NGConfig::FolderContent;
			case NGUtil::ObjectUIDRootPictures :
				return NGConfig::FolderPictures;
			case NGUtil::ObjectUIDRootAssets :
				return NGConfig::FolderDownloads;
				case NGUtil::ObjectUIDRootContent :
			case NGUtil::ObjectUIDRoot :
				return '';
			default :
				return rawurlencode($this->name);
		}
	}

}