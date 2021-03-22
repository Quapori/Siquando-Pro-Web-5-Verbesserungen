<?php

class NGRestGetFileState extends NGRestObjectBase
{		
	
	
	/**
	 * 
	 * ObjectUID to store file for
	 * @var string
	 */
	private $objectUID='';
	
	
	/**
	 * RevisionUID
	 * @var string
	 */
	private $revisionUID='';
	
	/**
	 * 
	 * Relative path the file has been written to
	 * @var string
	 */
	private $filePath;
	
	/**
	 * 
	 * Filesname to check
	 * @var string
	 */
	private $filename;
	
	/**
	 * 
	 * Size of file
	 * @var int
	 */
	private $fileSize;
	
	/**
	 * 
	 * State of file
	 * @var NGFileState
	 */
	private $fileState;
	
	/**
	 * 
	 * Object to upload file for
	 * @var NGObject
	 */
	private $object;
	
	/* (non-PHPdoc)
	 * @see NGRest::handleRequest()
	 */
	function handleRequest() {
		
		$this->object = $this->objectAdapter->loadObject ( $this->objectUID, null, NGObject::ObjectTypeObject, $this->revisionUID, false, false, true );
		
		// Check perms
		
		if ($this->object === null) 
		{
			throw new NGNotFoundException($this->objectUID);
		}
		
		if (!$this->object->permissions[NGObject::ActionView]) 
		{
			throw new NGAccessDeniedException(NGObject::ActionModify, $this->objectUID);
		}
		
		
			
		$this->fileState=$this->objectAdapter->getFileState($this->objectUID, $this->filename);		
		
	}

	/* (non-PHPdoc)
	 * @see NGRest::loadRequest()
	 */
	function loadRequest() {
		foreach ( $this->requestDocument->documentElement->childNodes as $requestNode ) {
			
			/* @var $requestNode DOMElement */
			if ($requestNode->nodeType == XML_ELEMENT_NODE) {
				if ($requestNode->nodeName == self::NodeObjectUID) {
					$this->objectUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeRevisionUID) {
					$this->revisionUID = $requestNode->nodeValue;
				}
				if ($requestNode->nodeName == self::NodeFilename) {
					$this->filename = $requestNode->nodeValue;
				}
			}
		}
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->appendElement ( $this->responseDocument->documentElement, self::NodeState, parent::$fileStateToValue [$this->fileState->state] );
		
		if ($this->fileState->state !== NGFileState::FileStateMissing) {
			$this->appendElement ( $this->responseDocument->documentElement, self::NodeSize, $this->fileState->size );
			if ($this->fileState->state === NGFileState::FileStateComplete) {
				$this->appendElement ( $this->responseDocument->documentElement, self::NodePath, $this->fileState->path );
			}
		}
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
	