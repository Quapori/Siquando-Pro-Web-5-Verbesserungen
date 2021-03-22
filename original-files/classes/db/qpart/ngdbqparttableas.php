<?php
class NGDBQPartTableAs implements iNGDBCreatesSQL {
	public $table;
	public $as;
	
	/**
	 * 
	 * Constructor
	 * @param string $column
	 * @param String $table
	 */
	public function __construct($table, $as) {
		$this->table=$table;
		$this->as=$as;
	}
	
	/**
	 * 
	 * Prepares SQL
	 * @return string SQL
	 */
	public function sql() {
		return NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table).' AS '.NGDBConnector::escapeIdentifier($this->as);
	}
}