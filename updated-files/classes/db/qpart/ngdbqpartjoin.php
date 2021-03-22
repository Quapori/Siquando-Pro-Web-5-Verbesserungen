<?php
class NGDBQPartJoin implements iNGDBCreatesSQL {
	const JoinInner='INNER';
	const JoinLeft='LEFT';
	const JoinRight='RIGHT';
	
	public $type=self::JoinInner;
	
	/**
	 * 
	 * Table join
	 * @var string|NGDBQueryTableAndAs
	 */
	public $table;
	
	/**
	 * 
	 * Columns to match in Join
	 * @var array 
	 */
	public $ons;
	
	public function __construct($table, $ons,$type=self::JoinInner) {
		$this->table=$table;
		$this->ons=$ons;
		$this->type=$type;
	}
	
	/**
	 * 
	 * Prepares SQL statements
	 * @return string SQL statement
	 */
	public function sql() {
		$sql=$this->type;
		
		$sql.=' JOIN ';
		
		if ($this->table instanceof iNGDBCreatesSQL) {
			$sql.=$this->table->sql();
		} else {
			$sql.=NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table);
		}
				
		$first=true;

		foreach($this->ons as $on) {
			/* @var $on NGDBQPartOn */
			
			$sql.="\n";
			$sql.=$first?'   ON ':'   AND ';
			$sql.=$on->sql();
			$first=false;
		}
		
		return $sql;
	}
}