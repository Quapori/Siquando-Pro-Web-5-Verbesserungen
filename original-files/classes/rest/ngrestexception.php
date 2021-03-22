<?php
class NGRestException extends NGRest {
	const NodeMessage='message';
	const NodeCode='code';
	const NodeFile='file';
	const NodeLine='line';
	const NodeType='type';
	const NodeException='exception';
	
	const ValueException='exception';
	
	/**
	 * 
	 * Exception
	 * @var Exception Excpetion to output
	 */
	public $exception;	
	
	
	/**
	 * 
	 * Hide the debug info
	 * @var bool
	 */
	public $hideDebugInfo;
	
	/**
	 * 
	 * Additional information to be appended
	 * @var array
	 */
	public $additionalInfo=null;
	
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
		$this->saveException($this->exception);
	}
	
	public function __construct(Exception $exception, $hideDebugInfo=false, $additionalInfo=null) {
		parent::__construct();
		$this->exception=$exception;
		$this->hideDebugInfo=$hideDebugInfo;
		$this->additionalInfo=$additionalInfo;
	}

	/**
	 * 
	 * Save the exception to the response node
	 * @param Exception $exception Exception to save
	 */
	private function saveException(Exception $exception) {	
		$this->responseDocument->documentElement->getAttributeNode(self::NodeState)->nodeValue=self::ValueException;
		
		$exceptionNode=$this->appendElement($this->responseDocument->documentElement, self::NodeException);

		$this->appendElement($exceptionNode, self::NodeCode, $exception->getCode());
		$this->appendElement($exceptionNode, self::NodeMessage, $exception->getMessage());
		$this->appendAttribute($exceptionNode, self::NodeType, get_class($exception));
		
		if (!$this->hideDebugInfo) {
			$this->appendElement($exceptionNode, self::NodeFile, $exception->getFile());
			$this->appendElement($exceptionNode, self::NodeLine, $exception->getLine());
		}
		
		if ($this->additionalInfo!=null) {
			foreach ($this->additionalInfo as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $info) {
						$infoElement = $this->appendElement($exceptionNode, $key);
						$this->appendAttributes($infoElement, $info);
					}
				} else {
					$this->appendElement($exceptionNode, $key, $value);
				}
			}
		}
		
		
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