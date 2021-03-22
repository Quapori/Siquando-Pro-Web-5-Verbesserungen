<?php
class NGRestLoadObjectChange extends NGRestObjectBase {
			
	/**
	 * 
	 * Loaded object
	 * @var NGObjectChange
	 */
	public $objectChange;
	
	/**
	 * 
	 * UID of change to load
	 * @var string
	 */
	public $changeUID=null;
	
	/**
	 * 
	 * Previous change to load
	 * @var string
	 */
	public $previousChangeUID=null;
	
	/**
	 * 
	 * Load property changes
	 * @var bool
	 */
	public $loadPropertyChanges=true;	
	
	/**
	 * 
	 * Load grant changes
	 * @var bool
	 */
	public $loadGrantChanges=true;
	
	/* (non-PHPdoc)
	 * @see NGRestObject::__construct()
	 */
	public function __construct() {
		parent::__construct();
		
	}

	/* (non-PHPdoc)
	 * @see NGRestObject::__destruct()
	 */
	public function __destruct() {
		parent::__destruct();
	}

	/* (non-PHPdoc)
	 * @see NGRestRest::loadRequest()
	 */
	function loadRequest() {
		parent::loadRequest();
		foreach ($this->requestDocument->documentElement->childNodes as $paramElement) {
			/* @var $paramElement DOMElement */
			if ($paramElement->nodeType==XML_ELEMENT_NODE) {
				if ($paramElement->nodeName==self::NodeChangeUID) {
					$this->changeUID=$paramElement->nodeValue;
				}
				if ($paramElement->nodeName==self::NodePreviousChangeUID) {
					$this->previousChangeUID=$paramElement->nodeValue;
				}
				if ($paramElement->nodeName==self::NodeLoadPropertyChanges) {
					$this->loadPropertyChanges=NGUtil::StringXMLToBool($paramElement->nodeValue);
				}
				if ($paramElement->nodeName==self::NodeLoadGrantChanges) {
					$this->loadGrantChanges=NGUtil::StringXMLToBool($paramElement->nodeValue);
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::handleRequest()
	 */
	function handleRequest() {
		if ($this->previousChangeUID!==null)
			$this->changeUID=$this->objectAdapter->getNextChangeUID($this->previousChangeUID);
		
		$this->objectChange=$this->objectAdapter->loadObjectChange($this->changeUID, $this->loadPropertyChanges, $this->loadGrantChanges);
		
		if ($this->objectChange==null) {
			throw new Exception('objectchange not found', 20000);
		}
		
		unset($this->objectAdapter);
	}

	/* (non-PHPdoc)
	 * @see NGRestRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveObjectChange($this->objectChange, $this->responseDocument->documentElement);		
	}
	
	/**
	 * 
	 * Save a document to an XML element
	 * @param NGObjectChange $object objectChange to save 
	 * @param DOMElement $parentElement element to append to
	 */
	public function saveObjectChange($objectChange, DOMElement $parentElement) {
		/* @var $objectChange NGObjectChange */		
		
		$objectChangeElement=$this->appendElement(
			$parentElement, 
			self::NodeObjectChange,
			null,
			array(
				self::NodeObjectUID=>$objectChange->objectUID,
				self::NodeChangeUID=>$objectChange->changeUID,
				self::NodeRevisionUID=>$objectChange->revisionUID,
				self::NodeChangeType=>parent::$changeTypeToValue[$objectChange->changeType],
				self::NodeOwner=>$objectChange->owner,
				self::NodeOwnerGroup=>$objectChange->ownerGroup,
				self::NodeChangeDate=>$objectChange->changeDate,
				self::NodeChangeOwner=>$objectChange->changeOwner,
				self::NodeClass=>$objectChange->class,
				self::NodeParentUID=>$objectChange->parentUID			
			)
		);

		$this->appendElement($objectChangeElement, self::NodeAnnotation, $objectChange->annotation);
		
		if ($this->loadPropertyChanges) {
			$this->savePropertyChanges($objectChange, $objectChangeElement);
		}
		if ($this->loadGrantChanges) {
			$this->saveGrantChanges($objectChange, $objectChangeElement);
		}
		
		
	} 
	
	/**
	 * 
	 * Saves properties
	 * @param NGObject $object Object to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function savePropertyChanges(NGObjectChange $objectChange, DOMElement $parentElement) {
		/* @var $object NGObject */
		
		$propertyChangesNode=$this->appendElement($parentElement, self::NodePropertyChanges);
		
		foreach ($objectChange->properties as $propertyChange) {
			$this->savePropertyChange($propertyChange, $propertyChangesNode);
		}	
		
	}
	
	/**
	 * 
	 * Saves grants
	 * @param NGObject $object Object to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function saveGrantChanges(NGObjectChange $objectChange, DOMElement $parentElement) {
		/* @var $object NGObject */
		
		$grantChangesNode=$this->appendElement($parentElement, self::NodeGrantChanges);
		
		foreach ($objectChange->grants as $action=>$owners) {
			foreach ($owners as $owner=>$grantChange) {
				$grantChangeNode = $this->appendElement(
					$grantChangesNode, 
					self::NodeGrantChange, 
					parent::$accessToValue[$grantChange->access], 
					array(
						self::NodeChangeType=>parent::$changeTypeToValue[$grantChange->changeType],
						self::NodeAction=>parent::$actionToValue[$action],
						self::NodeOwner=>$owner
					)
				);
			}
		}	
	}
		
	
	/**
	 * 
	 * Saves a property
	 * @param NGPropertyChange $property Property to save
	 * @param DOMElement $parentElement Parent element to append to
	 */
	private function savePropertyChange(NGPropertyChange $propertyChange, DOMElement $parentElement) {
		
		$attributes=array (
			self::NodeName=>$propertyChange->name,
			self::NodeChangeType=>parent::$changeTypeToValue[$propertyChange->changeType],
			self::NodeDomain=>$propertyChange->domain,
			self::NodeLang=>$propertyChange->lang
		);
		
		if ($propertyChange->index!='') $attributes[self::NodeIndex]=$propertyChange->index;
		if ($propertyChange->unique) $attributes[self::NodeUnique]=NGUtil::boolToStringXML($propertyChange->unique);
		
		if ($propertyChange->type==NGProperty::TypeFile) {
			$attributes[parent::NodeState]=parent::$fileStateToValue[$propertyChange->fileState->state];
			$attributes[parent::NodeSize]=$propertyChange->fileState->size;
			$attributes[parent::NodePath]=$propertyChange->fileState->path;
		};
		
		
		
		$this->appendElement($parentElement, 
			parent::$typeToValue[$propertyChange->type],
			self::propertyValue($propertyChange),
			$attributes
		);
	}
	
}