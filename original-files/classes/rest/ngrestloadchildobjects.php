<?php
class NGRestLoadChildObjects extends NGRestObjectBase {
	
	/**
	 * 
	 * Loaded objects
	 * @var array
	 */
	public $objects=array();
	
	/**
	 * 
	 * Parent UID of objects to load
	 * @var string
	 */
	public $parentUID = null;

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
	 * Perform, even if in trash
	 * @var bool
	 */
	public $allowTrashedObjects = false;
	
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
		
	
	/* (non-PHPdoc)
	 * @see NGRestRest::loadRequest()
	 */
	function loadRequest() {
		
		parent::loadRequest ();
		
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				if ($requestNode->nodeName == self::NodeParentUID) {
					$this->parentUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeRevisionUID) {
					$this->revisionUID = $requestNode->nodeValue;
					if ($requestNode->hasAttribute(self::NodeNull)) {
						if ($requestNode->getAttribute(self::NodeNull)) {
							$this->revisionUID=null;
						}
					}
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

				if ($requestNode->nodeName == self::NodeAllowTrashedObjects) {
					$this->allowTrashedObjects = NGUtil::StringXMLToBool($requestNode->nodeValue);
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::handleRequest()
	 */
	function handleRequest() {
		$this->object = $this->objectAdapter->loadChildObjects($this->parentUID, $this->class, NGObject::ObjectTypeObject, $this->revisionUID, $this->loadProperties, $this->loadGrants, $this->loadPermissions, $this->allowTrashedObjects);
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveObjects ( $this->object, $this->responseDocument->documentElement );
	}
	
	function saveObjects($objects, DOMElement $parentElement) {
		$objectsNode=$this->appendElement($parentElement, self::NodeObjects);

		$objectSaver=new NGRestLoadObject();
		
		foreach ($objects as $object) {
			/* @var $objectChange NGObject */
			$objectSaver->saveObject($object, $objectsNode,$this->loadGrants, $this->loadPermissions, $this->loadProperties);
		}
	}
	
}