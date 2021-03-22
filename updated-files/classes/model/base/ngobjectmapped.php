<?php
/**
 * 
 * Baseclass for objects with mapped properties
 *
 *
 */
abstract class NGObjectMapped extends NGObject {
	
	/**
	 * 
	 * Mapped Properties
	 * @var array
	 */
	public $propertiesMapped = array ();
	
	/**
	 * 
	 * saves the mapped properties from vars to $this-properties
	 */
	public function savePropertiesMapped() {
		
		$this->properties = array ();
		
		foreach ( $this->propertiesMapped as $propertyMapped ) {
			/* @var $propertyMapped NGPropertyMapped */
			switch ($propertyMapped->multiplicity) {
				case NGPropertyMapped::MultiplicityScalar :
					$this->properties [] = new NGProperty ( $propertyMapped->name, $propertyMapped->type, $this->{$propertyMapped->mapToVar}, $propertyMapped->lang, $propertyMapped->domain, '', $propertyMapped->unique );
					break;
				case NGPropertyMapped::MultiplicityList :
					$i = 0;
					foreach ( $this->{$propertyMapped->mapToVar} as $value ) {
						$this->properties [] = new NGProperty ( $propertyMapped->name, $propertyMapped->type, $value, $propertyMapped->lang, $propertyMapped->domain, ( string ) $i, $propertyMapped->unique );
						$i ++;
					}
					;
					break;
				case NGPropertyMapped::MultiplicityDictornary :
					$i = 0;
					foreach ( $this->{$propertyMapped->mapToVar} as $key => $value ) {
						$this->properties [] = new NGProperty ( $propertyMapped->name, $propertyMapped->type, $value, $propertyMapped->lang, $propertyMapped->domain, $key, $propertyMapped->unique );
						$i ++;
					}
					;
					break;
			}
		}
	}
	
	/**
	 * 
	 * loads the mapped properties from $this->properties and stores them as vars
	 */
	public function loadPropertiesMapped() {
		foreach ( $this->propertiesMapped as $propertyMapped ) {
			/* @var $propertyMapped NGPropertyMapped */
			
			if ($propertyMapped->multiplicity === NGPropertyMapped::MultiplicityList | $propertyMapped->multiplicity === NGPropertyMapped::MultiplicityDictornary) {
				$this->{$propertyMapped->mapToVar} = array ();
			}
			
			foreach ( $this->properties as $property ) {
				/* @var $property NGProperty */
				if ($propertyMapped->name == $property->name) {
					if ($propertyMapped->domain == $property->domain) {
						switch ($propertyMapped->multiplicity) {
							case NGPropertyMapped::MultiplicityScalar :
								$this->{$propertyMapped->mapToVar} = $property->value;
								if ($propertyMapped->mapFileDataToVar !== '')
									$this->{$propertyMapped->mapFileDataToVar} = $property->fileState;
								break;
							case NGPropertyMapped::MultiplicityDictornary :
							case NGPropertyMapped::MultiplicityList :
								$this->{$propertyMapped->mapToVar} [$property->index] = $property->value;
								if ($propertyMapped->mapFileDataToVar !== '')
									$this->{$propertyMapped->mapFileDataToVar} [$property->index] = $property->fileState;
								break;
						}
					}
				}
			}
			
			if ($propertyMapped->multiplicity === NGPropertyMapped::MultiplicityList)
				ksort ( $this->{$propertyMapped->mapToVar} );
		
		}
		
		unset ( $this->properties );
	}
	
	/**
	 * 
	 * Gets a list of all mapped Domains
	 * @return array All mapped Domains
	 */
	public function getDomainsMapped() {
		$domains = array ();
		
		foreach ( $this->propertiesMapped as $propertyMapped ) {
			/* @var $propertyMapped NGPropertyMapped */
			if (! in_array ( $propertyMapped->domain, $domains, true )) {
				$domains [] = $propertyMapped->domain;
			}
		}
		
		return $domains;
	}
	
	public function __construct() {
		$this->getPropertiesMapped ();
		$this->class = get_class ( $this );
	}
	
	/**
	 * 
	 * Must return the mapped properties
	 * @return array properties mapped
	 */
	abstract protected function getPropertiesMapped();
}