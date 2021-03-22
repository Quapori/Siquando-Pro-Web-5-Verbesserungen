<?php
class NGRestLogout extends NGRest {
	
	const NodeLogin='login';
	const NodePassword='password';
	const NodeSessionUID='sessionuid';
	
	public $login='';
	
	public $password='';
	
	public $sessionUID='';
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		NGSession::getInstance()->terminate();		
	}
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function __destruct() {
		parent::__destruct ();
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