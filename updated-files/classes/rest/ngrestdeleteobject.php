<?php
class NGRestDeleteObject extends NGRestObjectBase {
	
	/**
	 * 
	 * UID of object to delete
	 */
	public $objectUID;
	
	/**
	 * 
	 * Revision UID of object to delete
	 * @var string
	 */
	public $revisionUID=null;
	
	/**
	 * 
	 * ObjectChanges associated with save
	 * @var array
	 */
	public $objectChanges = array();
		
	/**
	 * 
	 * Describes the change
	 * @var string
	 */
	public $annotation;
			
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {		
		$this->objectChanges=$this->objectAdapter->deleteObject($this->objectUID, $this->annotation, $this->revisionUID);
		$pageCache=new NGPageCache();
		$pageCache->clear();
	}
	
	public function __construct() {
		parent::__construct();
	}
	
	public function __destruct() {
		parent::__destruct();
	}

	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		parent::loadRequest();
		foreach($this->requestDocument->documentElement->childNodes as $objectNode) {
			/* @var $objectNode DOMElement */
			if ($objectNode->nodeType==XML_ELEMENT_NODE) {
				switch ($objectNode->nodeName) {
					case self::NodeObjectUID:
						$this->objectUID=$objectNode->nodeValue;
						break;
					case self::NodeAnnotation:
						$this->annotation=$objectNode->nodeValue;
						break;
					case self::NodeRevisionUID:
						$this->revisionUID=$objectNode->nodeValue;
						break;
				} 					
			}
		}		
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$objectChangesSaver=new NGRestLoadObjectChanges();
		$objectChangesSaver->saveObjectChanges($this->objectChanges, $this->responseDocument->documentElement);
	}
}