<?php

class NGRestQueryObjects extends NGRestObjectBase {
	
	public $class = null;
	public $sortbyDate = NGPropertyCriteria::SortNone;
	public $revisionUID = '';
	public $objectUID='';
	public $parentUID='';
	public $propertyCriterias = array();
	
	/**
	 * 
	 * Enter description here ...
	 * @var array
	 */
	public $objects;
	
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
	 * @see NGRestObject::loadRequest()
	 */
	public function loadRequest() {
		parent::loadRequest();
		foreach($this->requestDocument->documentElement->childNodes as $requestNode) {
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType==XML_ELEMENT_NODE) {
				switch ($requestNode->nodeName) {
					case self::NodePropertyCriterias:
						$this->propertyCriterias=$this->loadPropertyCriterias($requestNode);
						break;
					case self::NodeClass:
						$this->class=$requestNode->nodeValue;
						break;
					case self::NodeSortByDate:
						$this->sortbyDate=parent::$valueToSort[$requestNode->nodeValue];
						break;
					case self::NodeRevisionUID:
						$this->revisionUID=$requestNode->nodeValue;
						if ($requestNode->hasAttribute(self::NodeNull)) {
							if ($requestNode->getAttribute(self::NodeNull)) {
								$this->revisionUID=null;
							}
						}
						break;
					case self::NodeObjectUID:
						$this->objectUID=$requestNode->nodeValue;
						break;
					case self::NodeParentUID:
						$this->parentUID=$requestNode->nodeValue;
						break;
				} 					
			}
		}			
	}
	
	/**
	 * 
	 * Loads propertycriterias from node
	 * @param DOMElement $propertyCriteriasNode Node to load from
	 * @return array Array of NGPropertyCriteria
	 */
	private function loadPropertyCriterias(DOMElement $propertyCriteriasNode) {
		$propertyCriterias=array();
		
		foreach($propertyCriteriasNode->childNodes as $propertyCriteriaNode) {
			/* @var $propertyCriteriaNode DOMElement */

			if ($propertyCriteriaNode->nodeType==XML_ELEMENT_NODE) {
				if (array_key_exists($propertyCriteriaNode->nodeName, parent::$valueToType)) {
					$propertyCriterias[]=$this->loadPropertyCriteria($propertyCriteriaNode);	
				}
			}
		};
		
		return $propertyCriterias;
	}
	
	/**
	 * 
	 * Loads propertycriteria from node
	 * @param DOMElement $propertyCriteriaNode Node to load from
	 * @return NGPropertyCriteria loaded criteria
	 */
	private function loadPropertyCriteria(DOMElement $propertyCriteriaNode) {
		$propertyCriteria=new NGPropertyCriteria(
			$propertyCriteriaNode->getAttribute(self::NodeName), 
			parent::$valueToType[$propertyCriteriaNode->nodeName], 
			$propertyCriteriaNode->nodeValue, 
			($propertyCriteriaNode->hasAttribute(self::NodeOutput))?NGUtil::StringXMLToBool($propertyCriteriaNode->getAttribute(self::NodeOutput)):true, 
			($propertyCriteriaNode->hasAttribute(self::NodeCompare))?parent::$valueToCompare[$propertyCriteriaNode->getAttribute(self::NodeCompare)]:NGPropertyCriteria::CompareNone, 
			($propertyCriteriaNode->hasAttribute(self::NodeSort))?parent::$valueToSort[$propertyCriteriaNode->getAttribute(self::NodeSort)]:NGPropertyCriteria::SortNone 
		);
		
		if ($propertyCriteriaNode->hasAttribute(self::NodeLang)) $propertyCriteria->lang=$propertyCriteriaNode->getAttribute(self::NodeLang);
		if ($propertyCriteriaNode->hasAttribute(self::NodeDomain)) $propertyCriteria->domain=$propertyCriteriaNode->getAttribute(self::NodeDomain);
		
		return $propertyCriteria;
	}

	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {		
		$this->objects=$this->objectAdapter->queryObjects(
			$this->class, 
			$this->propertyCriterias, 
			$this->sortbyDate,
			NGObject::ObjectTypeObject,
			$this->revisionUID,
			$this->objectUID,
			$this->parentUID
		);
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveObjects($this->objects, $this->responseDocument->documentElement);		
	}
	
	/**
	 * 
	 * Save found objects
	 * @param array $objects Array of NGObject
	 * @param DOMElement $parentElement Node to append to
	 */
	function saveObjects($objects, DOMElement $parentElement) {
		$objectsNode=$this->appendElement($parentElement, self::NodeObjects);

		$objectSaver=new NGRestLoadObject();
		
		foreach ($objects as $object) {
			/* @var $objectChange NGObject */
			$objectSaver->saveObject($object, $objectsNode, false, false);
		}
	}
}