<?php
class NGDBQPartTableColumnAs extends NGDBQPartTableColumn {
	public $as;
	
	/**
	 * 
	 * Constructor
	 * @param string $table
	 * @param string $column
	 * @param string $as
	 */
	public function __construct($table, $column, $as) {
		parent::__construct($table, $column);
		$this->as=$as;
	}
	
	/**
	 * 
	 * @see NGDBQPartTableColumn::sql()
	 */
	public function sql() {
		$sql=parent::sql();
		$sql.=' AS '.NGDBConnector::escapeIdentifier($this->as);
		
		return $sql;
	}
}