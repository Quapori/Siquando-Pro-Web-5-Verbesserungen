<?php
/**
 * 
 * Query part. Represents alias, column name and as  
  *
 */
class NGDBQPartAliasColumnAs extends NGDBQPartAliasColumn implements iNGDBCreatesSQL {
	public $as;
	
	/**
	 * 
	 * Constructor
	 * @param string $alias
	 * @param string $column
	 * @param string $as
	 */
	public function __construct($alias, $column, $as) {
		parent::__construct($alias, $column);
		$this->as=$as;
	}
	
	/**
	 * @see NGDBQPartAliasColumn::sql()
	 */
	public function sql() {
		$sql=parent::sql();
		$sql.=' AS '.NGDBConnector::escapeIdentifier($this->as);
		
		return $sql;
	}
}