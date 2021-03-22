<?php
class NGRestLoadObjectChanges extends NGRestObjectBase {
	
	/**
	 * 
	 * UID of object to load changes for
	 * @var string
	 */
	public $objectUID;
	
	/**
	 * 
	 * The revision uid to load changes for
	 * @var string
	 */
	public $revisionUID='';
	
	/**
	 * 
	 * Also load property changes
	 * @var bool
	 */
	public $loadPropertyChanges=true;

	/**
	 * 
	 * Also load grant changes
	 * @var bool
	 */
	public $loadGrantChanges=true;
	
	
	/**
	 * 
	 * Object changes
	 * @var array Array of NGObjectChange
	 */
	public $objectChanges=array();
	
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
		parent::loadRequest();
		
		foreach ($this->requestDocument->documentElement->childNodes as $paramElement) {
			/* @var $paramElement DOMElement */
			if ($paramElement->nodeType==XML_ELEMENT_NODE) {
				if ($paramElement->nodeName==self::NodeObjectUID) {
					$this->objectUID=$paramElement->nodeValue;
				}
				if ($paramElement->nodeName==self::NodeRevisionUID) {
					$this->revisionUID=$paramElement->nodeValue;
					if ($paramElement->hasAttribute(self::NodeNull)) {
						if ($paramElement->getAttribute(self::NodeNull)) {
							$this->revisionUID=null;
						}
					}
				}
				if ($paramElement->nodeName==self::NodeLoadPropertyChanges) {
					$this->loadPropertyChanges=NGUtil::StringXMLToBool($paramElement->nodeValue);
				}
				if ($paramElement->nodeName==self::NodeLoadGrantChanges) {
					$this->loadGrantChanges=NGUtil::StringXMLToBool($paramElement->nodeValue);
				}
			}
		}
		
	}

	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		$this->objectChanges=$this->objectAdapter->loadObjectChanges($this->objectUID, $this->loadPropertyChanges, $this->loadGrantChanges, $this->revisionUID);
		
		if ($this->objectChanges==null) {
			throw new Exception('objectchanges not found', 20000);
		}
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->saveObjectChanges($this->objectChanges, $this->responseDocument->documentElement);
	}
	
	/**
	 * 
	 * Saves the object changes as node
	 * @param array $objectChanges Array of NGObjectChange
	 * @param DOMElement $parentElement Node to append to
	 */
	function saveObjectChanges($objectChanges, DOMElement $parentElement) {
		$objectChangesNode=$this->appendElement($parentElement, self::NodeObjectChanges);

		$objectChangeSaver=new NGRestLoadObjectChange();
		
		$objectChangeSaver->loadPropertyChanges=$this->loadPropertyChanges;
		$objectChangeSaver->loadGrantChanges=$this->loadGrantChanges;
		
		foreach ($objectChanges as $objectChange) {
			/* @var $objectChange NGObjectChange */
			$objectChangeSaver->saveObjectChange($objectChange, $objectChangesNode);
		}
	}
}