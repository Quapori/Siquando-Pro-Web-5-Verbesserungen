<?php
class NGRestEcho extends NGRest {
	
	const NodePing='ping';
	const NodePong='pong';
	
	/**
	 * 
	 * Message to echo
	 * @var string
	 */
	private $message;
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		
		
	}

	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		$this->message=$this->loadMessage($this->requestDocument->documentElement);
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveMessage($this->message, $this->responseDocument->documentElement);
		
	}
	
	/**
	 * 
	 * Saves the message to a pong node
	 * @param string $message
	 * @param DOMElement $parentElement
	 */
	function saveMessage($message, DOMElement $parentElement) {
		$this->appendElement($parentElement, self::NodePong, $message);
	}
	
	/**
	 * 
	 * Loads a message from a ping node
	 * @param DOMElement $parentElement
	 */
	function loadMessage(DOMElement $parentElement) {
		foreach ($parentElement->childNodes as $pingNode) {
			/* @var $pingNode DOMElement */
			if ($pingNode->nodeType==XML_ELEMENT_NODE) {
				if ($pingNode->nodeName==self::NodePing) {
					return $pingNode->nodeValue;
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function loginRequired() {
		return false;
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function connectionRequired() {
		return false;
	}
	
	
}