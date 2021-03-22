<?php

class NGObjectNamedSummary extends NGObjectNamed {
	const DomainSummary='summary';
	
	public $summary='';
	
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('summary', NGProperty::TypeFulltext,self::DomainSummary,'summary',NGPropertyMapped::MultiplicityScalar,true,'',false);
	}

}