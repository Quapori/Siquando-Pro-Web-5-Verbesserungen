<?php
class NGDBQPartOrderColumn implements iNGDBCreatesSQL {
	/**
	 * 
	 * Colunn to sort by
	 * @var string|NGDBQueryTableAndColumn
	 */
	public $column;
	
	/**
	 * 
	 * Sort descending
	 * @var bool
	 */
	public $desc=false;
	
	/**
	 * 
	 * Constructor
	 * @param string|NGDBQueryTableAndColumn $column
	 * @param bool $desc
	 */
	public function __construct($column, $desc=false) {
		$this->column=$column;
		$this->desc=$desc;
	}
	
	/**
	 * 
	 * Produces DESC if sort DESC
	 * @return string SQL
	 */
	private function sqlDesc() {
		return ($this->desc)?' DESC':'';
	}
	
	/**
	 * 
	 * Produces SQL
	 * @return string SQL
	 */
	public function sql() {
		if ($this->column instanceof iNGDBCreatesSQL) {
			return $this->column->sql().$this->sqlDesc();
		} else {
			return NGDBConnector::escapeIdentifier($this->column).$this->sqlDesc();
		}
	} 
}