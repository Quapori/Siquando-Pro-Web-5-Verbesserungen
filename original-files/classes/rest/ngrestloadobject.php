<?php
class NGRestLoadObject extends NGRestObjectBase {
	
	/**
	 * 
	 * Loaded object
	 * @var NGObject
	 */
	public $object;
	
	/**
	 * 
	 * UID of object to load
	 * @var string
	 */
	public $objectUID = null;

	/**
	 * 
	 * Revision of object to load
	 * @var string
	 */
	public $revisionUID = '';	
	
	
	/**
	 * 
	 * Load properties
	 * @var bool
	 */
	public $loadProperties = true;
	
	/**
	 * 
	 * Load grants
	 * @var bool
	 */
	public $loadGrants = true;
	
	/**
	 * 
	 * Load permissions
	 * @var bool
	 */
	public $loadPermissions = true;
	
	/**
	 * 
	 * Class of object to load, optional
	 * @var string
	 */
	public $class = null;
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function __destruct() {
		parent::__destruct ();
	}
	
	/**
	 * 
	 * Save a document to an XML element
	 * @param NGObject $object object to save 
	 * @param DOMElement $parentElement element to append to
	 */
	public function saveObject($object, DOMElement $parentElement, $saveGrants=true, $savePermissions=true, $saveProperties=true) {
		/* @var $object NGObject */
		
		$objectElement = $this->appendElement ( 
			$parentElement, 
			self::NodeObject, 
			null, 
			array (
				self::NodeObjectUID => $object->objectUID, 
				self::NodeOwner => $object->owner, 
				self::NodeOwnerGroup => $object->ownerGroup, 
				self::NodeChangeDate => $object->changeDate,
				self::NodeCreationDate => $object->creationDate, 
				self::NodeClass => $object->class, 
				self::NodeRevisionUID => $object->revisionUID, 
				self::NodeParentUID => $object->parentUID 
			)
		);
		
		if ($saveProperties) {
			$this->saveProperties ( $object->properties, $objectElement );
		}
		if ($saveGrants) {
			$this->saveGrants ( $object->grants, $objectElement );
		}
		if ($savePermissions) {
			$this->savePermissions ($object->permissions, $objectElement);
		}
	}
	
	/**
	 * 
	 * Saves properties
	 * @param array $properties Properties to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function saveProperties($properties, DOMElement $parentElement) {
		$propertiesNode = $this->appendElement ( $parentElement, self::NodeProperties );
		
		foreach ( $properties as $property ) {
			$this->saveProperty ( $property, $propertiesNode );
		}
	
	}
	
	/**
	 * 
	 * Saves grants
	 * @param array $grants Grants to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function saveGrants($grants, DOMElement $parentElement) {
		$grantsNode = $this->appendElement($parentElement, self::NodeGrants);
		
		foreach($grants as $action=>$owners) {
			foreach ($owners as $owner => $access) {
				$this->appendElement($grantsNode, self::NodeGrant, parent::$accessToValue[$access], array(
					self::NodeAction => parent::$actionToValue[$action],
					self::NodeOwner => $owner
				));
			}
		}
	}
	
	/**
	 * 
	 * Saves permissions
	 * @param array $permissions
	 * @param DOMElement $parentElement
	 */
	private function savePermissions($permissions, DOMElement $parentElement) {
		$permissionsNode = $this->appendElement($parentElement, self::NodePermissions);
		
		foreach($permissions as $action=>$permission) {
			$this->appendElement($permissionsNode, self::NodePermission, NGUtil::boolToStringXML($permission), array(self::NodeAction=>parent::$actionToValue[$action]));
		}
	}
	
	
	/**
	 * 
	 * Saves a property
	 * @param NGProperty $property Property to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function saveProperty(NGProperty $property, DOMElement $parentElement) {
		
		$attributes = array (self::NodeName => $property->name, self::NodeDomain => $property->domain, self::NodeLang => $property->lang);
		
		if ($property->index!='') $attributes[self::NodeIndex]=$property->index;
		if ($property->unique) $attributes[self::NodeUnique]=NGUtil::boolToStringXML($property->unique);
		
		if ($property->type==NGProperty::TypeFile) {
			$attributes[parent::NodeState]=parent::$fileStateToValue[$property->fileState->state];
			$attributes[parent::NodeSize]=$property->fileState->size;
			$attributes[parent::NodePath]=$property->fileState->path;
		};
		
		$this->appendElement ( $parentElement, parent::$typeToValue [$property->type], self::propertyValue ( $property ), $attributes );
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::loadRequest()
	 */
	function loadRequest() {
		
		parent::loadRequest ();
		
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				if ($requestNode->nodeName == self::NodeObjectUID) {
					$this->objectUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeRevisionUID) {
					$this->revisionUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeClass) {
					$this->class = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeLoadProperties) {
					$this->loadProperties = NGUtil::StringXMLToBool($requestNode->nodeValue);
				}
				if ($requestNode->nodeName == self::NodeLoadGrants) {
					$this->loadGrants = NGUtil::StringXMLToBool($requestNode->nodeValue);
				}
				if ($requestNode->nodeName == self::NodeLoadPermissions) {
					$this->loadPermissions = NGUtil::StringXMLToBool($requestNode->nodeValue);
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::handleRequest()
	 */
	function handleRequest() {
		$this->object = $this->objectAdapter->loadObject ( $this->objectUID, $this->class, NGObject::ObjectTypeObject, $this->revisionUID, $this->loadProperties, $this->loadGrants, $this->loadPermissions );
		
		if ($this->object == null) {
			throw new NGNotFoundException($this->objectUID, $this->revisionUID);
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveObject ( $this->object, $this->responseDocument->documentElement, $this->loadGrants, $this->loadPermissions, $this->loadProperties);
	}

}