<?php
class NGPropertyMapped extends NGProperty {
	const MultiplicityScalar=0;
	const MultiplicityList=1;
	const MultiplicityDictornary=2;
	
	/**
	 * 
	 * Selects the property to map to
	 * @var string
	 */
	public $mapToVar;
	
	
	/**
	 * 
	 * Selects a var to map fileData to
	 * @var string
	 */
	public $mapFileDataToVar;
	
    /**
     * 
     * MultiplicityScalar=Single Variable, MultiplicityList=Numeric Array, MultiplicityDictornary=Associative Array
     * @var int
     */
	public $multiplicity;


	/**
	 * 
	 * Constructor
     * @param string $name Name of property
     * @param int $type Type
     * @param mixed $value Value of property
     * @param string $mapToVar Class variable to map to
     * @param string $domain Domain of property
     * @param string $lang Language of property
     */
    public function __construct ($name, $type, $domain=NGUtil::DomainCore, $mapToVar='', $multiplicity=self::MultiplicityScalar, $localized=false, $value='', $unique=false, $mapFileDataTo='') {
    	parent::__construct($name, $type, $value, ($localized==true?NGSession::getInstance()->localizedLang:NGUtil::LanguageNeutral), $domain, '', $unique);
    	$this->mapToVar=($mapToVar=='')?$name:$mapToVar;
    	$this->multiplicity=$multiplicity;
    	$this->mapFileDataToVar=$mapFileDataTo;
    }
}