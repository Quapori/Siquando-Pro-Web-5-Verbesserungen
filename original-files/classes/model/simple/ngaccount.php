<?php

class NGAccount extends NGSecurityPrincipal {

	const ObjectTypeAccount = 'NGAccount';
	const DomainAccount='account';
	const DomainSecurity='security';
	
	const LoginStateInactive = 'Inactive';
	const LoginStatePending = 'Pending';
	const LoginStateActive = 'Active'; 

	/**
	 * 
	 * Login-ID
	 * @var string
	 */
	public $loginstate;
	
	/**
	 * 
	 * Password to login
	 * @var string
	 */
	public $password;
	
	
	/**
	 * 
	 * Groups the user in member of
	 * @var array
	 */
	public $realmmemberships = array();
	
			
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('password', NGProperty::TypeString,self::DomainSecurity,'password',NGPropertyMapped::MultiplicityScalar,false,'');
		$this->propertiesMapped[]=new NGPropertyMapped('realmmemberships', NGProperty::TypeDateTime,self::DomainAccount,'realmmemberships',NGPropertyMapped::MultiplicityDictornary);
		$this->propertiesMapped[]=new NGPropertyMapped('loginstate', NGProperty::TypeString,self::DomainAccount,'loginstate',NGPropertyMapped::MultiplicityScalar,false, '');
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