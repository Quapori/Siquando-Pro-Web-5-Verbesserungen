<?php

class NGFolder extends NGObjectNamed {
	const ObjectTypeFolder = 'NGFolder';
	const DomainFolder = 'folder';
	
	/**
	 * 
	 * Valid subfolder class
	 * @var string
	 */
	public $subFolderClass = self::ObjectTypeFolder;
	
	/**
	 * 
	 * Date and time the paragraph is visible from
	 * @var string
	 */
	public $visibleFrom = '';
	
	/**
	 * 
	 * Date and time the paragraph is visible to
	 * @var string
	 */
	public $visibleTo = '';
	
	/**
	 * 
	 * Should the page be hidden
	 * @var bool
	 */
	public $hide = false;

    /**
     * @var string Icon Style
     */
	public $icon = '';
	
	/**
	 * 
	 * Realms for restricted access
	 * @var string
	 */
	public $realms='';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'subfolderclass', NGProperty::TypeString, self::DomainFolder, 'subFolderClass', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visiblefrom', NGProperty::TypeDateTime, self::DomainFolder, 'visibleFrom', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visibleto', NGProperty::TypeDateTime, self::DomainFolder, 'visibleTo', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hide', NGProperty::TypeBool, self::DomainFolder, 'hide', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'realms', NGProperty::TypeText, self::DomainFolder, 'realms', NGPropertyMapped::MultiplicityScalar, false, '', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'icon', NGProperty::TypeString, self::DomainFolder, 'icon', NGPropertyMapped::MultiplicityScalar, false, '' );

    }
	
	/**
	 * 
	 * Should the folder be visible
	 */
	public function isVisible() {
		return ($this->hide) ? false : NGUtil::isCurrentDateBetween ( $this->visibleFrom, $this->visibleTo );
	}
	
	/**
	 * 
	 * When will the visibility change for the next time
	 */
	public function nextVisibilityChange() {
		return NGUtil::nextDate ( $this->visibleFrom, $this->visibleTo );
	}

}