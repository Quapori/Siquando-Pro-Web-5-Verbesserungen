<?php
class NGRestClearCache extends NGRest {
	
	/* (non-PHPdoc)
	 * @see NGRestObject::__construct()
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	/* (non-PHPdoc)
	 * @see NGRestObject::__destruct()
	 */
	public function __destruct() {
		parent::__destruct ();
	
	}
	
	/* (non-PHPdoc)
	 * @see NGRestObject::loadRequest()
	 */
	public function loadRequest() {
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$pageCache = new NGPageCache ();
		$pageCache->clear ();
		$urlCache = new NGURLCache();
		$urlCache->clear ();
		$fts = new NGFTS ();
		$fts->clear ();
		
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
	 * @see NGRest::connectionRequired()
	 */
	function connectionRequired() {
		return true;
	}

}