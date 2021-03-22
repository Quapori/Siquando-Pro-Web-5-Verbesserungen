<?php

class NGObjectNamedSummaryPicture extends NGObjectNamedSummary {
	const DomainPicture='picture';
	
	public $picture='';
	
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('picture', NGProperty::TypeUID,self::DomainPicture,'picture',NGPropertyMapped::MultiplicityScalar,false,'',false);
	}

}