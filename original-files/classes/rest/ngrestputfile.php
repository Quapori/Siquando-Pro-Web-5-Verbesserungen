<?php

class NGRestPutFile extends NGRestObjectBase
{
	const FieldPutfile='putfile';
	const FieldName='name';
	const FieldTmpName='tmp_name';
		
	const StageStart=1;
	const StageResume=2;
	const StageEnd=3;
	
	const ValueStageStart='start';
	const ValueStageResume='resume';
	const ValueStageEnd='end';
	
	public static $stageToValue = array(
		self::StageStart=>self::ValueStageStart,
		self::StageResume=>self::ValueStageResume,
		self::StageEnd=>self::ValueStageEnd
	);
	
	public static $valueToStage = array(
		self::ValueStageStart=>self::StageStart,
		self::ValueStageResume=>self::StageResume,
		self::ValueStageEnd=>self::StageEnd
	);
	
	/**
	 * 
	 * ObjectUID to store file for
	 * @var string
	 */
	private $objectUID='';

	/**
	 * 
	 * RevisionUID to store file for
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
	 * Stage of upload
	 * @var unknown_type
	 */
	private $stage=self::StageStart;
	
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
		
		if (!$this->object->permissions[NGObject::ActionModify]) 
		{
			throw new NGAccessDeniedException(NGObject::ActionModify, $this->objectUID);
		}
		
		
		
		// Check payload
		
		if (!array_key_exists(self::FieldPutfile, $_FILES)) {
			throw new NGException('Missing payload data on putfile', 30009);
		}
		
		// Create path
		
		$this->filePath=NGUtil::pathForUID($this->objectUID);
		NGUtil::createPath(NGConfig::storePath(), $this->filePath);
		$storePath=NGUtil::joinPaths(NGConfig::storePath(), $this->filePath);
		
		// Create filenames
		
		$filenameMain=$_FILES[self::FieldPutfile][self::FieldName];
		$filenamePart=$filenameMain.'.part';
		$filenameUpload=$filenameMain.'.upload';
		
		$pathMain = NGUtil::joinPaths($storePath ,$filenameMain);
		$pathPart = NGUtil::joinPaths($storePath ,$filenamePart);
		$pathUpload = NGUtil::joinPaths($storePath ,$filenameUpload);
		
		// Delete old file
		
		if ($this->stage==self::StageStart) {
			if (file_exists($pathMain)) @unlink($pathMain);
			if (file_exists($pathPart)) @unlink($pathPart);
		}
		
		if (file_exists($pathUpload)) @unlink($pathUpload);		
		
		move_uploaded_file($_FILES[self::FieldPutfile][self::FieldTmpName], $pathUpload );
		
		// Apend to part
		
		$reader = @fopen($pathUpload, 'rb');
		$writer = @fopen($pathPart, ($this->stage==self::StageStart)?'wb':'ab');
		
		while (!feof($reader)) {
			$buffer = fread($reader, 8192);
			fwrite($writer, $buffer);
		} 
		
		@fflush($writer);
		@fclose($writer);
		@fclose($reader);
		
		@unlink($pathUpload);
		
		// Move part to main
		
		if ($this->stage==self::StageEnd) rename($pathPart, $pathMain);
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
				if ($requestNode->nodeName == self::NodeStage) {
					$this->stage = self::$valueToStage[$requestNode->nodeValue];
				}
			}
		}
		
	}

	/* (non-PHPdoc)
	 * @see NGRest::saveResponse()
	 */
	function saveResponse() {
		$this->appendElement($this->responseDocument->documentElement, self::NodePath, $this->filePath);	
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
	