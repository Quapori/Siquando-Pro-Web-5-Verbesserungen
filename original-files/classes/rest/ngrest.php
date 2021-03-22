<?php
/**
 * 
 * Basic frame for a REST call handler
 *
 *
 */
abstract class NGRest {
	
	const NodeResponse='response';
	const NodeState='state';	
	const ValueOK='ok';
	
	/**
	 * 
	 * Response document
	 * @var DOMDocument
	 */
	public $responseDocument;
		
	/**
	 * 
	 * Request document
	 * @var DOMDocument
	 */
	public $requestDocument;
		
	/**
	 * 
	 * Constructor
	 */
	public function __construct() {

	}
	
	/**
	 * 
	 * Destructor
	 */
	public function __destruct() {
		
	}
	
	/**
	 * 
	 * Creates an element and appends it 
	 * @param DOMElement $parentElement Element to append to
	 * @param string $name Name of Element
	 * @param string $value Value of Element
	 * @param array $attributes Associative array of attributes
	 * @return DOMElement 
	 */
	protected function appendElement(DOMElement $parentElement, $name, $value=null, array $attributes=array()) {
		$element=$parentElement->ownerDocument->createElement($name);
		if ($value!==null) {
			$textNode=$parentElement->ownerDocument->createTextNode($value);
			$element->appendChild($textNode);
		}
				
		$parentElement->appendChild($element);
		$this->appendAttributes($element, $attributes);
		
		return $element;
	}
	
	/**
	 * 
	 * Creates and appends multiple attributes
	 * @param DOMElement $parentElement Element to append to
	 * @param array $attributes Associative array of Attributes
	 */
	protected function appendAttributes(DOMElement $parentElement, array $attributes) {
		foreach ($attributes as $name => $value) {
			self::appendAttribute($parentElement, $name, $value);	
		}
	}
	
	/**
	 * 
	 * Creates and appends an attribute
	 * @param DOMElement $parentElement Element to append to
	 * @param unknown_type $name Name of Attribute
	 * @param unknown_type $value Value of Attribute
	 */
	protected function appendAttribute(DOMElement $parentElement, $name, $value) {
		$parentElement->setAttribute($name, $value);
	}
	
	/**
	 * 
	 * Escapes a property value for XML
	 * @param NGProperty $property
	 * @return string escaped property
	 */
	protected function propertyValue(NGProperty $property) {
		/* @var $property NGProperty */
		switch ($property->type) {
			case NGProperty::TypeBool:
				return NGUtil::boolToStringXML($property->value);
			default:
				return $property->value;
		}
	}
	
	/**
	 * 
	 * Load the request from requestDocument here
	 */
	abstract function loadRequest();

	/**
	 * 
	 * Handle request action here
	 */
	abstract function handleRequest();
	
	/**
	 * 
	 * Save the response into responseDocument here
	 */
	abstract function saveResponse();
	
	/**
	 * 
	 * @return boolean true, when login is required
	 */
	abstract function loginRequired();

	/**
	 * 
	 * @return boolean true, when a connection is required
	 */
	abstract function connectionRequired();
	
	
	/**
	 * 
	 * Handle the REST call
	 * @param string $query REST Query
	 * @return string REST Response
	 */
	public function restCall($query=null) {
		if ($query) {
			$this->requestDocument=new DOMDocument('1.0', 'UTF-8');
			$this->requestDocument->loadXML($query);
			$this->loadRequest();
		}
		
		$this->responseDocument=new DOMDocument('1.0', 'UTF-8');
		$this->responseDocument->formatOutput=true;
		
		if ($this->connectionRequired()) NGDBConnector::getInstance()->connect();
	
		$responseNode=$this->responseDocument->createElement(self::NodeResponse);
		$this->responseDocument->appendChild($responseNode);
		$this->appendAttribute($responseNode, self::NodeState, self::ValueOK);
		
		$this->handleRequest();
		$this->saveResponse();
		return $this->responseDocument->saveXML();

		if ($this->connectionRequired()) NGDBConnector::getInstance()->disconnect();
	}
}