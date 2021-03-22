<?php

class NGFile extends NGObjectNamedSummary {
	
	const ObjectTypeFile = 'NGFile';
	const DomainFile='file';
	
	/**
	 * 
	 * Filename
	 * @var string
	 */
	public $file='';
	
	/**
	 * 
	 * Extendede FileState data
	 * @var NGFileState
	 */
	public $fileState=null;
	
	/**
	 * 
	 * Filesize
	 * @var int
	 */
	public $fileSize=0;
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('file', NGProperty::TypeFile,self::DomainFile,'file',NGPropertyMapped::MultiplicityScalar,false,'',false, 'fileState');
		$this->propertiesMapped[]=new NGPropertyMapped('filesize', NGProperty::TypeInt,self::DomainFile,'fileSize',NGPropertyMapped::MultiplicityScalar,false,0,false);
	}
}