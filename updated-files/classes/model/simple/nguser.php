<?php

class NGUser extends NGSecurityPrincipal {

	const ObjectTypeUser = 'NGUser';
	const DomainUser='user';
	const DomainSecurity='security';
	/**
	 * 
	 * Login-ID
	 * @var string
	 */
	public $login;
	
	/**
	 * 
	 * Password to login
	 * @var string
	 */
	public $password;
	
	/**
	 * 
	 * The user is active and may login 
	 * @var boolean
	 */
	public $enabled=true;
	
	/**
	 * 
	 * Groups the user in member of
	 * @var array
	 */
	public $groups = array();
	
	/**
	 * 
	 * Main Group of user
	 * @var string
	 */
	public $maingroup;
	
	/**
	 * 
	 * User System
	 * @var NGUser
	 */
	private static $userSystem=null;
		
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('login', NGProperty::TypeString,self::DomainUser,'login',NGPropertyMapped::MultiplicityScalar,false,'',true);
		$this->propertiesMapped[]=new NGPropertyMapped('password', NGProperty::TypeString,self::DomainSecurity,'password',NGPropertyMapped::MultiplicityScalar,false,'');
		$this->propertiesMapped[]=new NGPropertyMapped('groups', NGProperty::TypeUID,self::DomainUser,'groups',NGPropertyMapped::MultiplicityList,false,'');
		$this->propertiesMapped[]=new NGPropertyMapped('maingroup', NGProperty::TypeUID,self::DomainUser,'maingroup',NGPropertyMapped::MultiplicityScalar,false,'');
		$this->propertiesMapped[]=new NGPropertyMapped('enabled', NGProperty::TypeBool,self::DomainUser,'enabled',NGPropertyMapped::MultiplicityScalar,false, true);
	}
			
	/**
	 * 
	 * Returns the only instance of UserSystem
	 * @return NGUser User system
	 */
	public static function getUserSystem() {
        if (self::$userSystem === NULL) {
            self::$userSystem = new self;
            self::$userSystem->objectUID=NGUtil::ObjectUIDSystem;
            self::$userSystem->maingroup=NGUtil::ObjectUIDSystemGroup;
            self::$userSystem->groups=array(NGUtil::ObjectUIDSystemGroup);
        }
        return self::$userSystem;
	} 
	
	/**
	 * 
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->parentUID=NGUtil::ObjectUIDRootUsersAndGroups;
	}
}