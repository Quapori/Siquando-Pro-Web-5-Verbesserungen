<?php
class NGRestServertime extends NGRest {
	const NodeServertime='servertime';
		
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
		$this->saveServertime();
	}
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * 
	 * Save the exception to the response node
	 * @param Exception $exception Exception to save
	 */
	private function saveServertime() {
		$this->appendElement($this->responseDocument->documentElement, self::NodeServertime, date(DATE_ATOM));	
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