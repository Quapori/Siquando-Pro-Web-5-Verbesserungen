<?php
/**
 * 
 * A column of a table in a schema
 *
 */
class NGDBSchemaColumn implements iNGDBCreatesSQL {
	/**
	 * 
	 * Name of column
	 * @var string
	 */
	public $name;

    /**
     * @var string Introduced in version
     */
    public $version = '1.0';

	/**
	 * 
	 * Type of column
	 * @var int 
	 */
	public $type;
	
	/**
	 * 
	 * Size of column
	 * @var int
	 */
	public $size;
	
	/**
	 * 
	 * May the column be null?
	 * @var bool
	 */
	public $null=false;

    /**
     * @var default value
     */
	public $default = null;

    /**
     * @var bool
     */
	public $autoincrement=false;
	
	const TypeInt=1;
	const TypeFloat=2;
	const TypeChar=3;
	const TypeVarchar=4;
	const TypeDateTime=5;
	const TypeText=6;
	
	/**
	 * 
	 * Convert type to string
	 * @var array
	 */
	private $typeToString=array(
		self::TypeInt=>'int(11)',
		self::TypeFloat=>'double',
		self::TypeChar=>'char(%s)',
		self::TypeVarchar=>'varchar(%s)',
		self::TypeDateTime=>'datetime',
		self::TypeText=>'mediumtext'	
	);
	
	/**
	 * (non-PHPdoc)
	 * @see iNGDBCreatesSQL::sql()
	 */
	public function sql() {
		$sql='  '.NGDBConnector::escapeIdentifier($this->name).' ';
		$sql.=str_replace('%s', $this->size, $this->typeToString[$this->type]).' ';
		$sql.=($this->null)?'DEFAULT NULL':'NOT NULL';
		if ($this->default!==null) $sql.=' DEFAULT "'.$this->default.'"';
		if ($this->autoincrement) $sql.=' AUTO_INCREMENT';
		return $sql;
	}
}  