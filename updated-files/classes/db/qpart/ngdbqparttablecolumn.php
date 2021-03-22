<?php
class NGDBQPartTableColumn implements iNGDBCreatesSQL {
	public $table;
	public $column;
	
	
	/**
	 * 
	 * Constructor
	 * @param string $column
	 * @param String $table
	 */
	public function __construct($table, $column) {
		$this->table=$table;
		$this->column=$column;
	}
	
	/**
	 * 
	 * Prepares SQL
	 * @return string SQL
	 */
	public function sql() {
		return NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table).'.'.NGDBConnector::escapeIdentifier($this->column);
	}
}