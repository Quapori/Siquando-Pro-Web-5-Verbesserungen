<?php

class NGDBQuerySelect extends NGDBQueryWhere {
	
	/**
	 * 
	 * Offset to fetch
	 * @var int
	 */
	public $limitOffset = - 1;
	
	/**
	 * 
	 * Numer of items to fetch
	 * @var int
	 */
	public $limitCount = - 1;
	
	/**
	 * 
	 * Columns to query
	 * @var array 
	 */
	public $colums = array ();
	
	/**
	 * 
	 * Order Colums as array of NGDBQueryOrderColumn
	 * @var array 
	 */
	public $orderColumns = array ();
	
	/**
	 * 
	 * Array of join objects
	 * @var array 
	 */
	public $joins = array ();
	
	/**
	 * Generate SQL statement for query
	 * @return string SQL statement
	 */
	public function sql() {
		$sql = 'SELECT ';
		$sql .= $this->sqlColumns () . "\n";
		$sql .= $this->sqlFrom () . "\n";
		$sql .= $this->sqlJoins ();
		$sql .= $this->sqlWhere ();
		$sql .= $this->sqlOrderColumns ();
		$sql .= $this->sqlLimit ();
		
		return $sql;
	}
	
	/**
	 * 
	 * SQL for from
	 * @var string SQL statement
	 */
	private function sqlFrom() {
		$sql = 'FROM ';
		
		if ($this->table instanceof iNGDBCreatesSQL) {
			$sql .= $this->table->sql ();
		} else {
			$sql .= NGDBConnector::escapeIdentifier ( NGConfig::DatabaseTablePrefix . $this->table );
		}
		
		return $sql;
	}
	
	/**
	 * 
	 * SQL for joins
	 * @return string SQL statement
	 */
	private function sqlJoins() {
		$sql = '';
		foreach ( $this->joins as $join ) {
			/* @var $join NGDBQPartJoin */
			$sql .= $join->sql () . "\n";
		}
		
		return $sql;
	}
	
	/**
	 * 
	 * SQL for columns
	 * @return string SQL statement
	 */
	private function sqlColumns() {
		$sql = '';
		
		foreach ( $this->colums as $column ) {
			if ($sql != '')
				$sql .= ',';
			
			if ($column instanceof iNGDBCreatesSQL) {
				/* @var $column iNGDBCreatesSQL */
				$sql .= $column->sql ();
			} else {
				$sql .= NGDBConnector::escapeIdentifier ( $column );
			}
		}
		
		return $sql;
	}
	
	/**
	 * 
	 * SQL for order columns
	 * @return string SQL statement
	 */
	private function sqlOrderColumns() {
		$sql = '';
		
		foreach ( $this->orderColumns as $orderColumn ) {
			/* @var $orderColumn NGDBQPartOrderColumn */
			$sql .= ($sql == '') ? 'ORDER BY ' : ',';
			$sql .= $orderColumn->sql () . "\n";
		}
		
		return $sql;
	}
	
	private function sqlLimit() {
		$sql = '';
		
		if ($this->limitCount != - 1 && $this->limitOffset != - 1)
			$sql .= sprintf ( ' LIMIT %u,%u', $this->limitOffset, $this->limitCount );
		
		return $sql;
	}
}