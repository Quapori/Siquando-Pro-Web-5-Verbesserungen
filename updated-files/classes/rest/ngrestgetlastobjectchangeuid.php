<?php
class NGRestGetLastObjectChangeUID extends NGRestObjectBase {
			
	
	/**
	 * 
	 * Last object change UID
	 * @var string
	 */
	public $changeUID='';
	
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
	}

	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$this->changeUID=$this->objectAdapter->getLastObjectChangeUID();		
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->appendElement($this->responseDocument->documentElement, self::NodeChangeUID, $this->changeUID);
	}
	
}