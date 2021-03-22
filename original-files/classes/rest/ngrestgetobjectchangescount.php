<?php
class NGRestGetObjectChangesCount extends NGRestObjectBase {
	
	/**
	 * 
	 * UID of previous change uid
	 * @var string
	 */
	public $previousChangeUID;
		
	
	/**
	 * 
	 * Number of changes
	 * @var unknown_type
	 */
	public $objectChangesCount=0;
	
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
		
		foreach ($this->requestDocument->documentElement->childNodes as $paramElement) {
			/* @var $paramElement DOMElement */
			if ($paramElement->nodeType==XML_ELEMENT_NODE) {
				if ($paramElement->nodeName==self::NodePreviousChangeUID) {
					$this->previousChangeUID=$paramElement->nodeValue;
				}
			}
		}
	}

	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$this->objectChangesCount=$this->objectAdapter->getObjectChangesCount($this->previousChangeUID);		
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->appendElement($this->responseDocument->documentElement, self::NodeObjectChangesCount, $this->objectChangesCount);
	}
	
}