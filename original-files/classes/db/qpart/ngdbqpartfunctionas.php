<?php
class NGDBQPartFunctionAs implements iNGDBCreatesSQL {
	public $as;
	public $column;
	public $function;
	
	/**
	 * 
	 * Constructor
	 * @param string $table
	 * @param string $column
	 * @param string $as
	 */
	public function __construct($function, $column, $as) {
		$this->function=$function;
		$this->column=$column;
		$this->as=$as;
	}
	
	/**
	 * 
	 * @see NGDBQPartTableColumn::sql()
	 */
	public function sql() {
		return sprintf('%s(%s) as %s', $this->function, NGDBConnector::escapeIdentifier($this->column), NGDBConnector::escapeIdentifier($this->as));		
	}
}