<?php
class NGRestPluginCallback extends NGRest {
	
	const NodeClass = 'class';
	const NodeSuperclass = 'superclass';
	const NodeParam = 'param';
	const NodeResult = 'result';
	const NodeMethod = 'method';
	
	/**
	 * 
	 * Class to call
	 * @var string
	 */
	private $class = '';
	
	/**
	 * 
	 * Superclass to call
	 * @var string
	 */
	private $superClasss = '';
	
	/**
	 * 
	 * method to perform
	 * @var string
	 */
	private $method = '';
	
	/**
	 * 
	 * Parameter to pass
	 * @var string
	 */
	private $param = '';
	
	/**
	 * 
	 * Inner response node
	 * @var string
	 */
	private $result = '';
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		
		if ($this->class === '')
			throw new NGException ( 'Missing class' );
		if ($this->superClasss === '')
			throw new NGException ( 'Missing superclass' );
		
		$includeFilename = NGClassFolder () . 'plugins/' . strtolower ( NGUtil::safeFilename ( $this->superClasss ) ) . '/' . strtolower ( NGUtil::safeFilename ( $this->class ) ) . '/' . strtolower ( NGUtil::safeFilename ( $this->class ) ) . '.php';
		require_once $includeFilename;
		
		$plugin = new $this->class ();
		
		$this->result = $plugin->callback($this->method, $this->param);
	
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		$this->loadCallback ( $this->requestDocument->documentElement );
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveCallback ( $this->responseDocument->documentElement );
	
	}
	
	/**
	 * 
	 * Saves callback
	 * @param DOMElement $parentElement
	 */
	function saveCallback(DOMElement $parentElement) {
		$this->appendElement ( $parentElement, self::NodeResult, $this->result );
	}
	
	/**
	 * 
	 * Loads callback
	 * @param DOMElement $parentElement
	 */
	function loadCallback(DOMElement $parentElement) {
		foreach ( $parentElement->childNodes as $childNode ) {
			/* @var $childNode DOMElement */
			if ($childNode->nodeType == XML_ELEMENT_NODE) {
				switch ($childNode->nodeName) {
					case self::NodeClass :
						$this->class = $childNode->nodeValue;
						break;
					case self::NodeSuperclass :
						$this->superClasss = $childNode->nodeValue;
						break;
					case self::NodeMethod :
						$this->method = $childNode->nodeValue;
						break;
					case self::NodeParam :
						$this->param = $childNode->nodeValue;
						break;
				}
			
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function loginRequired() {
		return true;
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loginRequired()
	 */
	function connectionRequired() {
		return true;
	}

}