<?php
class NGRestCountObjects extends NGRestObjectBase {
	
	/**
	 * 
	 * Class of objects to count
	 */
	public $objectClass='';
	
	public $count=0;
	
				
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {		
		$this->count=$this->objectAdapter->countObjects($this->objectClass);
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
					case self::NodeClass:
						$this->objectClass=$objectNode->nodeValue;
						break;
				} 					
			}
		}		
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		
		$this->appendElement($this->responseDocument->documentElement, self::NodeCount, $this->count);
	}
}