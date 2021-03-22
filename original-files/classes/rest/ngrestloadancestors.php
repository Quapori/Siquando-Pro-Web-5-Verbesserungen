<?php
class NGRestLoadAncestors extends NGRestObjectBase {
	
	/**
	 * 
	 * Loaded ancestors
	 * @var NGObject
	 */
	public $ancestors;
	
	/**
	 * 
	 * UID of object to load ancestors
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
	public $loadGrants = false;
	
	/**
	 * 
	 * Load permissions
	 * @var bool
	 */
	public $loadPermissions = false;
	
		
	public function __construct() {
		parent::__construct ();
	}
	
	public function __destruct() {
		parent::__destruct ();
	}
	
	/**
	 * 
	 * Save all ancestors
	 * @param array $ancestors
	 * @param DOMElement $parentElement
	 */
	public function saveAncestors($ancestors, DOMElement $parentElement) {

		$objectSaver = new NGRestLoadObject();
		
		$objectsNode = $this->appendElement($parentElement, self::NodeObjects);
		
		foreach ($ancestors as $ancestor) {
			$objectSaver->saveObject($ancestor, $objectsNode, $this->loadGrants, $this->loadPermissions, $this->loadProperties);
		}
	}
		 
		
	/* (non-PHPdoc)
	 * @see NGRestRest::loadRequest()
	 */
	function loadRequest() {
		
		parent::loadRequest();
		
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				if ($requestNode->nodeName == self::NodeObjectUID) {
					$this->objectUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeRevisionUID) {
					$this->revisionUID = $requestNode->nodeValue;
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
		$this->ancestors = $this->objectAdapter->loadAncestors($this->objectUID, $this->revisionUID, $this->loadProperties, $this->loadGrants, $this->loadPermissions);		
	}
	
	/* (non-PHPdoc)
	 * @see NGRestRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveAncestors ( $this->ancestors, $this->responseDocument->documentElement);
	}

}