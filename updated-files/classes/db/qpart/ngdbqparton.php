<?php
class NGDBQPartOn implements iNGDBCreatesSQL {
	/**
	 * 
	 * Left column to compare
	 * @var string|NGDBQueryTableAndColumn
	 */
	public $leftColumn;

	/**
	 * 
	 * right column to compare
	 * @var string|NGDBQueryTableAndColumn
	 */
	public $rightColumn;
	
	/**
	 * 
	 * Constructor
	 * @param string|NGDBQueryTableAndColumn $leftColumn Left column
	 * @param string|NGDBQueryTableAndColumn $rightColumn Right column
	 */
	public function __construct($leftColumn, $rightColumn) {
		$this->leftColumn=$leftColumn;
		$this->rightColumn=$rightColumn;
	}
	
	/**
	 * 
	 * Returns the formatted sql statement part
	 * @return string SQL
	 */
	public function sql() {
		$sql='';
		
		if ($this->leftColumn instanceof iNGDBCreatesSQL) {
			$sql.=$this->leftColumn->sql();
		} else {
			$sql.=NGDBConnector::escapeIdentifier($this->leftColumn);
		}
		
		$sql.='=';

		if ($this->rightColumn instanceof iNGDBCreatesSQL) {
			$sql.=$this->rightColumn->sql();
		} else {
			$sql.=NGDBConnector::escapeIdentifier($this->rightColumn);
		}
		
		return $sql;
	}
}