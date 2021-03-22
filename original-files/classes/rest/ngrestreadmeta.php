<?php
class NGRestReadMeta extends NGRest {
	
	const NodeId = 'id';
	const NodeMeta = 'meta';
	const NodeDefault = 'default';
	
	/**
	 * 
	 * Ids to retrieve
	 * @var Array
	 */
	public $ids = Array ();
	
	/**
	 * 
	 * Reult
	 * @var Array
	 */
	public $result = Array ();
	
	/**
	 * 
	 * Adapter
	 * @var NGDBAdapterObject
	 */
	public $objectAdapter;
	
	/* (non-PHPdoc)
	 * @see NGRestObject::__construct()
	 */
	public function __construct() {
		parent::__construct ();
		$this->objectAdapter = new NGDBAdapterObject ();
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
		foreach ( $this->requestDocument->documentElement->childNodes as $idElement ) {
			/* @var $idElement DOMElement */
			if ($idElement->nodeType == XML_ELEMENT_NODE) {
				if ($idElement->nodeName == self::NodeId) {
					$this->ids [$idElement->nodeValue] = $idElement->getAttribute(self::NodeDefault);
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		foreach ( $this->ids as $id => $default ) {
			$this->result [$id] = $this->objectAdapter->readMeta ( $id, $default );
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		foreach ( $this->result as $id => $value ) {
			$nodeResult = $this->appendElement ( $this->responseDocument->documentElement, self::NodeMeta, $value );
			$this->appendAttribute ( $nodeResult, self::NodeId, $id );
		}
	
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