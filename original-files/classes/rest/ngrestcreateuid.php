<?php
class NGRestCreateUID extends NGRest {
	const NodeServertime='uid';
		
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
	}

	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {	
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveUID();
	}
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 
	 * Save the exception to the response node
	 * @param Exception $exception Exception to save
	 */
	private function saveUID() {
		$this->appendElement($this->responseDocument->documentElement, self::NodeServertime, NGUtil::createUID());	
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