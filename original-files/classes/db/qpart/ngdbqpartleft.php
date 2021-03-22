<?php
class NGDBQPartLeft implements iNGDBCreatesSQL {
	public $column;
	public $length;
	
	public function __construct($column, $length) {
		$this->column=$column;
		$this->length=$length;
	}
	
	/**
	 * 
	 * Prepares SQL
	 * @return string SQL
	 */
	public function sql() {
		return 'LEFT('.NGDBConnector::escapeIdentifier($this->column).','.$this->length.') AS '.NGDBConnector::escapeIdentifier($this->column);
	}
}