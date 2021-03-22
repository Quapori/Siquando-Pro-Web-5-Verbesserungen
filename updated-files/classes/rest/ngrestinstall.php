<?php
class NGRestInstall extends NGRest {
	
	const NodeSystemPassword = 'systempassword';
	const NodeLevel = 'level';
	const NodeForceInstall = 'forceinstall';
	const NodeInstallPerformed = 'installperformed';
	
	/**
	 * 
	 * Password of system user
	 * @var string
	 */
	private $systempassword = '';
	
	/**
	 * 
	 * Install root objects
	 * @var int
	 */
	private $level = NGInstall::LevelBasicPages;
	
	/**
	 * 
	 * Force installation
	 * @var bool
	 */
	private $forceinstall = false;
	
	/**
	 * 
	 * Install really performed
	 * @var unknown_type
	 */
	private $installPerformed = false;
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		if ($this->systempassword !== NGConfig::SystemPassword )
			throw new NGIllegalCredentialsException ();
		
		$install = new NGInstall ();
		$this->installPerformed = $install->install ( $this->level, $this->forceinstall );
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		foreach ( $this->requestDocument->documentElement->childNodes as $parameterNode ) {
			/* @var $parameterNode DOMElement */
			if ($parameterNode->nodeType == XML_ELEMENT_NODE) {
				if ($parameterNode->nodeName == self::NodeSystemPassword)
					$this->systempassword = $parameterNode->nodeValue;
				if ($parameterNode->nodeName == self::NodeLevel) {
					switch ($parameterNode->nodeValue) {
						case 'none' :
							$this->level = NGInstall::LevelNone;
							break;
						case 'rootonly' :
							$this->level = NGInstall::LevelRootOnly;
							break;
						case 'basicpages' :
							$this->level = NGInstall::LevelBasicPages;
							break;
					
					}
				}
				if ($parameterNode->nodeName == self::NodeForceInstall)
					$this->forceinstall = NGUtil::StringXMLToBool ( $parameterNode->nodeValue );
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->appendElement ( $this->responseDocument->documentElement, self::NodeInstallPerformed, NGUtil::boolToStringXML ( $this->installPerformed ) );
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