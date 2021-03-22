<?php

class NGGroup extends NGSecurityPrincipal {

	const ObjectTypeGroup = 'NGGroup';
		
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
	}		
}