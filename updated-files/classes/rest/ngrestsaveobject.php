<?php
class NGRestSaveObject extends NGRestObjectBase {
	
	/**
	 * 
	 * The NGObject to save
	 * @var NGObject
	 */
	public $object;
	
	/**
	 * 
	 * ObjectChange associated with save
	 * @var NGObjectChange
	 */
	public $objectChange;
	
	/**
	 * 
	 * Annotation to save
	 * @var string
	 */
	public $annotation;
	
	/**
	 * 
	 * Acquire the object ownership
	 * @var boolean
	 */
	public $changeOwner = false;
	
	/**
	 * 
	 * Save the grants
	 * @var boolean
	 */
	public $changeGrants = false;
	
	
	/**
	 * 
	 * Save properties
	 * @var boolean
	 */
	public $changeProperties = false;
	
	/**
	 * 
	 * Automatically resolve collisions
	 * @var bool
	 */
	public $resolveCollisions=false;
	
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		
		$this->objectChange = $this->objectAdapter->saveObject( $this->object, $this->annotation, $this->changeOwner, $this->changeGrants, $this->changeProperties, false, $this->resolveCollisions );
		$pageCache=new NGPageCache();
		$pageCache->clear();
		$urlCache=new NGURLCache();
		$urlCache->clear();
	}
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function __destruct() {
		parent::__destruct ();
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		parent::loadRequest ();
		foreach ( $this->requestDocument->documentElement->childNodes as $objectNode ) {
			/* @var $objectNode DOMElement */
			if ($objectNode->nodeType == XML_ELEMENT_NODE) {
				switch ($objectNode->nodeName) {
					case self::NodeObject :
						$this->object = $this->loadObject ( $objectNode );
						if ($objectNode->hasAttribute ( self::NodeChangeOwner )) {
							$this->changeOwner = NGUtil::StringXMLToBool($objectNode->getAttribute ( self::NodeChangeOwner ));
						}
						break;
					case self::NodeAnnotation :
						$this->annotation = $objectNode->nodeValue;
						break;
					case self::NodeResolveCollisions:
						$this->resolveCollisions=NGUtil::StringXMLToBool($objectNode->nodeValue);
						break;
				}
			}
		}
	}
	
	/**
	 * 
	 * Loads an object from a node
	 * @param DOMElement $objectNode
	 */
	private function loadObject(DOMElement $objectNode) {
		$object = new NGObject();
		
		$object->class = $objectNode->getAttribute ( self::NodeClass );
		if ($objectNode->hasAttribute ( self::NodeChangeDate ))
			$object->changeDate = $objectNode->getAttribute ( self::NodeChangeDate );
		if ($objectNode->hasAttribute ( self::NodeObjectUID ))
			$object->objectUID = $objectNode->getAttribute ( self::NodeObjectUID );
		if ($objectNode->hasAttribute ( self::NodeOwner ))
			$object->owner = $objectNode->getAttribute ( self::NodeOwner );
		if ($objectNode->hasAttribute ( self::NodeOwnerGroup ))
			$object->ownerGroup = $objectNode->getAttribute ( self::NodeOwnerGroup );
		if ($objectNode->hasAttribute ( self::NodeRevisionUID ))
			$object->revisionUID = $objectNode->getAttribute ( self::NodeRevisionUID );
		if ($objectNode->hasAttribute ( self::NodeParentUID ))
			$object->parentUID = $objectNode->getAttribute ( self::NodeParentUID );
			
		foreach ( $objectNode->childNodes as $propertiesOrGrantsNode ) {
			/* @var $propertiesOrGrantsNode DOMElement */
			if ($propertiesOrGrantsNode->nodeType == XML_ELEMENT_NODE) {
				if ($propertiesOrGrantsNode->nodeName == self::NodeProperties) {
					$object->properties = $this->loadProperties ( $propertiesOrGrantsNode );
				}
				if ($propertiesOrGrantsNode->nodeName == self::NodeGrants) {
					$object->grants = $this->loadGrants ( $propertiesOrGrantsNode );
				}
			}
		}
		return $object;
	}
	
	/**
	 * 
	 * Load properties from node
	 * @param DOMElement $propertiesNode Node to load from
	 * @return array Array of properties
	 */
	private function loadProperties(DOMElement $propertiesNode) {
		$properties = array ();
		
		$this->changeProperties=true;
		
		foreach ( $propertiesNode->childNodes as $propertyNode ) {
			/* @var $propertyNode DOMElement */
			if ($propertyNode->nodeType == XML_ELEMENT_NODE) {
				if (array_key_exists($propertyNode->nodeName, parent::$valueToType)) {
					$property = $this->loadProperty ( $propertyNode );
					$properties [] = $property;
				}
			}
		}		
		return $properties;
	}
	
	private function loadGrants(DOMElement $grantsNode) {
		$grants = array(
    		NGObject::ActionView=>array(),
    		NGObject::ActionModify=>array(),
    		NGObject::ActionAdd=>array(),
    		NGObject::ActionDelete=>array(),
    		NGObject::ActionAdmin=>array()
    	);
    	
    	$this->changeGrants=true;

		foreach ( $grantsNode->childNodes as $grantNode ) {
			/* @var $grantNode DOMElement */
			if ($grantNode->nodeType == XML_ELEMENT_NODE) {
				if ($grantNode->nodeName===self::NodeGrant) {
					$action=parent::$valueToAction[$grantNode->getAttribute(self::NodeAction)];
					$access=parent::$valueToAccess[$grantNode->nodeValue];
					$owner=$grantNode->getAttribute(self::NodeOwner);
					$grants[$action][$owner]=$access;
				}
			}
		}		
		return $grants;
	}
		
	/**
	 * 
	 * Load property from node
	 * @param DOMElement $propertyNode Node to load from
	 * @return NGProperty Loaded property
	 */
	private function loadProperty(DOMElement $propertyNode) {
		$property = new NGProperty ( $propertyNode->getAttribute ( self::NodeName ), parent::$valueToType [$propertyNode->nodeName], $propertyNode->nodeValue );
		
		if ($property->type==NGProperty::TypeBool)
			$property->value=NGUtil::StringXMLToBool($property->value);
			
		if ($propertyNode->getAttribute ( self::NodeLang ) != '')
			$property->lang = $propertyNode->getAttribute ( self::NodeLang );
		if ($propertyNode->getAttribute ( self::NodeDomain ) != '')
			$property->domain = $propertyNode->getAttribute ( self::NodeDomain );
		if ($propertyNode->getAttribute ( self::NodeIndex ) != '')
			$property->index = $propertyNode->getAttribute ( self::NodeIndex );
		if ($propertyNode->getAttribute ( self::NodeUnique ) != '')
			$property->unique = NGUtil::StringXMLToBool($propertyNode->getAttribute ( self::NodeUnique ));
		if ($propertyNode->getAttribute ( self::NodeUpdate ) != '')
			$property->update = NGUtil::StringXMLToBool($propertyNode->getAttribute ( self::NodeUpdate ));
		if ($propertyNode->getAttribute ( self::NodeReadOnly ) != '') {
			$property->readOnly = NGUtil::StringXMLToBool($propertyNode->getAttribute ( self::NodeReadOnly ));
		}
			
		return $property;
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$objectChangeSaver = new NGRestLoadObjectChange ();
		$objectChangeSaver->saveObjectChange ( $this->objectChange, $this->responseDocument->documentElement );
	}
}