<?php
class NGRestWriteMeta extends NGRest {
	
	const NodeId = 'id';
	const NodeMeta = 'meta';
	
	/**
	 * 
	 * Meta to write to retrieve
	 * @var Array
	 */
	public $meta = Array ();
		
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
		foreach ( $this->requestDocument->documentElement->childNodes as $metaElement ) {
			/* @var $metaElement DOMElement */
			if ($metaElement->nodeType == XML_ELEMENT_NODE) {
				if ($metaElement->nodeName == self::NodeMeta) {
					$this->meta [$metaElement->getAttribute(self::NodeId)] = $metaElement->nodeValue;
				}
			}
		}
	}
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		foreach ( $this->meta as $id => $value) {
			$this->objectAdapter->writeMeta($id, $value);
		}
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