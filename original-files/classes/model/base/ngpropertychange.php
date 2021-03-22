<?php
class NGPropertyChange extends NGProperty {
	const ChangeTypeInsert=1;
	const ChangeTypeUpdate=2;
	const ChangeTypeDelete=3;
	const ChangeTypeUnchanged=4;
	
	/**
	 * 
	 * Type of change
	 * @var int
	 */
	public $changeType;
	    
	/**
	 * 
	 * Constructor
	 * @param int $changeType
     * @param string $name Name of property
     * @param int $type Type
     * @param mixed $value Value of property
     * @param string $domain Domain of property
     * @param string $lang Language of property
	 */
    public function __construct($changeType, $name, $type, $value, $lang, $domain, $index, $unique) {
    	parent::__construct($name, $type, $value, $lang, $domain, $index, $unique);
    	$this->changeType=$changeType;
    }
}