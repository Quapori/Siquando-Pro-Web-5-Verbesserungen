<?php
/**
 * 
 * Query part. Represents alias and column name  
 *
 */
class NGDBQPartAliasColumn implements iNGDBCreatesSQL {
	public $alias;
	public $column;
	
	
	/**
	 * 
	 * Constructor
	 * @param string $column
	 * @param String $alias
	 */
	public function __construct($alias, $column) {
		$this->alias=$alias;
		$this->column=$column;
	}
	
	/**
	 * 
	 * Prepares SQL
	 * @return string SQL
	 */
	public function sql() {
		return NGDBConnector::escapeIdentifier($this->alias).'.'.NGDBConnector::escapeIdentifier($this->column);
	}
}