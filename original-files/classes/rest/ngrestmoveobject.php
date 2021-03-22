<?php
class NGRestMoveObject extends NGRestObjectBase {
	
	/**
	 * 
	 * UID of object to move
	 */
	public $objectUID;
	

	/**
	 * 
	 * New parent UID
	 */
	public $parentUID;
	
	
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
		$this->objectChanges=$this->objectAdapter->moveObject($this->objectUID, $this->parentUID, $this->annotation, $this->resolveCollisions);
		
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
					case self::NodeParentUID:
						$this->parentUID=$objectNode->nodeValue;
						break;
					case self::NodeResolveCollisions:
						$this->resolveCollisions=NGUtil::StringXMLToBool($objectNode->nodeValue);
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