<?php

/**
 * 
 * Key for table
 *
 *
 */
class NGDBSchemaKey implements iNGDBCreatesSQL {
	/**
	 * 
	 * Name of key
	 * @var string
	 */
	public $name;

    /**
     * @var string Introduced in version
     */
	public $version = '1.0';
	
	/**
	 * 
	 * Columns to include in key
	 * @var array
	 */
	public $columns=array();
	
	/**
	 * 
	 * Type of Key
	 * 
	 * @var int
	 */
	public $type;
	
	const typeKey=1;
	const typePrimaryKey=2;
	const typeUniqueKey=3;
	const typeFulltextKey=4;
	
	/**
	 * 
	 * Convert type to string
	 * @var array
	 */
	private $types=array(
		self::typeKey=>'KEY %n',
		self::typePrimaryKey=>'PRIMARY KEY',
		self::typeUniqueKey=>'UNIQUE KEY %n',
		self::typeFulltextKey=>'FULLTEXT KEY %n'
	);
		
	/**
	 * (non-PHPdoc)
	 * @see iNGDBCreatesSQL::sql()
	 */
	function sql() {
		$sql='  '.str_replace('%n', NGDBConnector::escapeIdentifier($this->name), $this->types[$this->type]).' (';
		
		$first=true;
		foreach ($this->columns as $column) {
			if (!$first) $sql.=',';
			$sql.=NGDBConnector::escapeIdentifier($column);
			$first=false;
		}
		
		$sql.=')';
		
		return $sql;
	}
}