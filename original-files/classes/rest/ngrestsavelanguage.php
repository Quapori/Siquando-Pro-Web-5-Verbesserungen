<?php

class NGRestSaveLanguage extends NGRest {
	const NodeLanguageURL = 'languageurl';
	
	/**
	 * 
	 * Language Adapter to use
	 * @var NGLanguageAdapter 
	 */
	private $languageAdapter;
	
	/**
	 * 
	 * URL of lang
	 * @var Array
	 */
	private $langURL;
	
	/**
	 * 
	 * Changes
	 * @var Array
	 */
	private $languageResources = Array ();
	
	/**
	 * 
	 * Object changes
	 * @var NGObjectChange
	 */
	private $objectChange;
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$this->languageAdapter = new NGLanguageAdapter ();
		$this->languageAdapter->langURL = $this->langURL;
		$this->languageAdapter->load ( true, false );
		
		foreach ($this->languageResources as $uid => $value) {
			if (array_key_exists($uid, $this->languageAdapter->languageResources)) $this->languageAdapter->languageResources[$uid]->value=$value;
		}
				
		$this->objectChange=$this->languageAdapter->save();

        $pageCache=new NGPageCache();
        $pageCache->clear();
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				switch ($requestNode->nodeName) {
					case self::NodeLanguageURL :
						$this->langURL = $requestNode->nodeValue;
						break;
					case NGLanguageAdapter::NodeLanguageResource:
						$this->languageResources[$requestNode->getAttribute(NGLanguageAdapter::NodeUID)]=$requestNode->nodeValue;
						break;
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$objectChangeSaver = new NGRestLoadObjectChange ();
		$objectChangeSaver->saveObjectChange ( $this->objectChange, $this->responseDocument->documentElement );
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