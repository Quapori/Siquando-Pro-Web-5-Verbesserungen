<?php

class NGDBQPartCriteria implements iNGDBCreatesSQL {	
    const TypeString=1;
    const TypeNumeric=2;
    const TypeBoolean=3;

    /**
     * 
     * Criteria to check against
     * @var mixed
     */
    public $criteria;
    
    /**
     * 
     * Type of criteria  NGDBQPartCriteria::TypeString, NGDBQPartCriteria::TypeNumeric, NGDBQPartCriteria::TypeBoolean
     * @var unknown_type
     */
    public $type;
    
    /**
     * 
     * Column to march against
     * @var mixed Column
     */
    public $column;

    /**
     * 
     * Constructor
     * @param string $column Name of column 
     * @param string $criteria Value to match against
     * @param int $type Type of Column 
     */
    public function __construct($column, $criteria, $type) {
        $this->column=$column;
        $this->criteria=$criteria;
        $this->type=$type;
    }

    /**
     * 
     * Prepares SQL
     * @return string SQL String
     */
    public function sql() {
    	if (is_array($this->criteria)) {
    		return array_map(array($this, 'escapeCriteria'), $this->criteria); 
    	} else {
    		return $this->escapeCriteria($this->criteria);
    	}
    }
    
    /**
     * 
     * Escapes a given value depending on $type
     * @param mixed $value
     * @return string Escaped value
     */
    private function escapeCriteria($value) {
        switch ($this->type) {
            case self::TypeString:
                return "'".NGDBConnector::getInstance()->connection->real_escape_string($value)."'";
            case self::TypeNumeric:
            	if (!is_numeric($value)) {
            		throw new Exception($value.' is not numeric', 20000);
            	}
                return  $value;
            case self::TypeBoolean:
                return NGUtil::boolToInt($value);
        }
    }
}