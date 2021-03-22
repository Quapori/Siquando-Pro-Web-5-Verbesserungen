<?php

class NGDownload extends NGFile
{
	const ObjectTypeDownload = 'NGDownload';
	const DomainDownload='download';

	public $icon = '';
		
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();

        $this->propertiesMapped[]=new NGPropertyMapped('icon', NGProperty::TypeString,self::DomainDownload,'icon',NGPropertyMapped::MultiplicityScalar,false,'',false);
    }
	
	public function pathToFile() {
		return $this->fileState->path.$this->file;
	}	
}