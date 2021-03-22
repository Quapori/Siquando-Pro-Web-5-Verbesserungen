<?php
class NGRestSaveObjectChange extends NGRestObjectBase {
		
	/**
	 * 
	 * ObjectChange to save
	 * @var NGObjectChange
	 */
	public $objectChange;
	
		
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$this->objectAdapter->saveObjectChange($this->objectChange);
		$this->objectAdapter->applyObjectChange($this->objectChange);
	}
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function __destruct() {
		parent::__destruct ();
	}
	
	function loadRequest() {
		foreach ( $this->requestDocument->documentElement->childNodes as $objectChangeNode ) {
			/* @var $objectNode DOMElement */
			if ($objectChangeNode->nodeType == XML_ELEMENT_NODE) {
				switch ($objectChangeNode->nodeName) {
					case self::NodeObjectChange :
						$this->objectChange = $this->loadObjectChange ( $objectChangeNode );
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
	private function loadObjectChange(DOMElement $objectChangeNode) {
		$objectChange = new NGObjectChange(
			$objectChangeNode->getAttribute ( self::NodeChangeUID ), 
			self::$valueToChangeType [$objectChangeNode->getAttribute ( self::NodeChangeType )], 
			$objectChangeNode->getAttribute ( self::NodeObjectUID ), 
			$objectChangeNode->getAttribute ( self::NodeClass ), 
			$objectChangeNode->getAttribute ( self::NodeOwner ), 
			$objectChangeNode->getAttribute ( self::NodeChangeDate ), 
			$objectChangeNode->getAttribute ( self::NodeAnnotation ), 
			$objectChangeNode->getAttribute ( self::NodeRevisionUID ), 
			$objectChangeNode->getAttribute ( self::NodeOwnerGroup ), 
			$objectChangeNode->getAttribute ( self::NodeChangeOwner ), 
			$objectChangeNode->getAttribute ( self::NodeParentUID )
		);
					
		foreach ( $objectChangeNode->childNodes as $propertiesOrGrantsNode ) {
			/* @var $propertiesOrGrantsNode DOMElement */
			if ($propertiesOrGrantsNode->nodeType == XML_ELEMENT_NODE) {
				if ($propertiesOrGrantsNode->nodeName == self::NodePropertyChanges) {
					$objectChange->properties = $this->loadPropertyChanges ( $propertiesOrGrantsNode );
				}
				if ($propertiesOrGrantsNode->nodeName == self::NodeGrantChanges) {
					$objectChange->grants = $this->loadGrantChanges ( $propertiesOrGrantsNode );
				}
			}
		}
		return $objectChange;
	}
	
	/**
	 * 
	 * Load properties from node
	 * @param DOMElement $propertiesNode Node to load from
	 * @return array Array of properties
	 */
	private function loadPropertyChanges(DOMElement $propertyChangesNode) {
		$propertyChanges = array ();
		
		foreach ( $propertyChangesNode->childNodes as $propertyChangeNode ) {
			/* @var $propertyChangeNode DOMElement */
			if ($propertyChangeNode->nodeType == XML_ELEMENT_NODE) {
				if (array_key_exists ( $propertyChangeNode->nodeName, parent::$valueToType ))
				{
					$propertyChanges [] = $this->loadPropertyChange ( $propertyChangeNode );
				}
			}
		}
		
		return $propertyChanges;
	}
	
	/**
	 * 
	 * Load property changes
	 * @param DOMElement $propertyChangeNode
	 */
	private function loadPropertyChange(DOMElement $propertyChangeNode) {
		
		$propertyChange = new NGPropertyChange(
			parent::$valueToChangeType[$propertyChangeNode->getAttribute(self::NodeChangeType)], 
			$propertyChangeNode->getAttribute(self::NodeName), 
			parent::$valueToType [$propertyChangeNode->nodeName], 
			$propertyChangeNode->nodeValue, 
			$propertyChangeNode->getAttribute(self::NodeLang), 
			$propertyChangeNode->getAttribute(self::NodeDomain), 
			$propertyChangeNode->getAttribute(self::NodeIndex), 
			$propertyChangeNode->getAttribute(self::NodeUnique)
		) ;
		
		if ($propertyChange->type==NGProperty::TypeBool)
			$propertyChange->value=NGUtil::StringXMLToBool($propertyChange->value);
			
		return $propertyChange;
	}
	
	
	/**
	 * 
	 * Load grant changes
	 * @param DOMElement $grantChangesNode
	 */
	private function loadGrantChanges(DOMElement $grantChangesNode) {
		$grantChanges = array(
    		NGObject::ActionView=>array(),
    		NGObject::ActionModify=>array(),
    		NGObject::ActionAdd=>array(),
    		NGObject::ActionDelete=>array(),
    		NGObject::ActionAdmin=>array()
    	);
		
		
		foreach ( $grantChangesNode->childNodes as $grantChangeNode ) {
			/* @var $grantChangeNode DOMElement */
			if ($grantChangeNode->nodeType == XML_ELEMENT_NODE) {
				if ($grantChangeNode->nodeName == self::NodeGrantChange) {
					$action=parent::$valueToAction[$grantChangeNode->getAttribute(self::NodeAction)];
					$access=parent::$valueToAccess[$grantChangeNode->nodeValue];
					$changeType=parent::$valueToChangeType[$grantChangeNode->getAttribute(self::NodeChangeType)];
					$owner=$grantChangeNode->getAttribute(self::NodeOwner);
					$grantChanges[$action][$owner]=new NGGrantChange($changeType, $access);				
				}
			}
		}
    	
		return $grantChanges;
	}		
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
	}
}