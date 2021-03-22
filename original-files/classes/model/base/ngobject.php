<?php
class NGObject {
	
	const ObjectTypeObject='NGObject';
	
	const ActionView=0;
	const ActionModify=1;
	const ActionAdd=2;
	const ActionDelete=3;
	const ActionAdmin=4;
	
	const AccessUndefined=0;
	const AccessDeny=1;
	const AccessOwner=2;
	const AccessOwnerGroup=3;
	const AccessAny=4;
	
    /**
     *
     * @var string
     */
    public $objectUID='';
    
    /**
     * 
     * ID of revision
     * @var string
     */
    public $revisionUID='';
    
    /**
     *
     * @var string
     */
    public $class=self::ObjectTypeObject;

    /**
     *
     * @var array NGProperty
     */
    public $properties=array();

    /**
     * 
     * Creator and Owner of this object
     * @var string
     */
    public $owner;

     /**
     * 
     * Group of Creator and Owner of this object
     * @var string
     */
    public $ownerGroup;
    
    
    /**
     * 
     * Date of last change of this object
     * @var string
     */
    public $changeDate;   

    /**
     * 
     * Date of creation of object
     * @var string
     */
    public $creationDate;

    /**
     * 
     * UID of parent object
     */
    public $parentUID='';
        
    /**
     * 
     * Grants to access
     * @var array
     */
    public $grants = array(
    	self::ActionView=>array(),
    	self::ActionModify=>array(),
    	self::ActionAdd=>array(),
    	self::ActionDelete=>array(),
    	self::ActionAdmin=>array()
    );
    
    /**
     * 
     * Permission to access
     * @var array
     */
    public $permissions = array(
       	self::ActionView=>true,
    	self::ActionModify=>true,
    	self::ActionAdd=>true,
    	self::ActionDelete=>true,
    	self::ActionAdmin=>true
    );
}