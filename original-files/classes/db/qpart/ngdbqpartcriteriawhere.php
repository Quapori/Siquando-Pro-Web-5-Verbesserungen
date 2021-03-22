<?php

class NGDBQPartCriteriaWhere extends NGDBQPartCriteria implements iNGDBCreatesSQL {

    const CompareNone = 0;
    const CompareIs = 1;
	const CompareIsNot = 2;
	const CompareLike = 3;
	const CompareNotLike = 4;
	const CompareGreater = 5;
	const CompareSmaller = 6;
	const CompareGreaterOrEqual = 7;
	const CompareSmallerOrEqual = 8;
	const CompareFulltext = 9;
	
	/**
	 * 
	 * Compare mode
	 * @var int Compare mode
	 */
	public $compare;
	
	/**
	 * 
	 * Creates a new where criteria
	 * @param string $column
	 * @param string $criteria
	 * @param int $type
	 * @param string $compare
	 */
	public function __construct($column, $criteria, $type, $compare) {
		parent::__construct ( $column, $criteria, $type );
		$this->compare = $compare;
	}
	
	/**
	 * 
	 * Creates a where statement
	 * @return string SQL statement
	 */
	public function sql() {
		$criterias=parent::sql();
		
		if (is_array($criterias)) {
			return $this->sqlMulti($criterias);
		} else {
			return $this->sqlSingle($criterias);
		}
	}
	
	/**
	 * 
	 * Cretes SQL for multiple criteria
	 * @param array $criterias
	 */
	private function sqlMulti($criterias) {
		$sql='(';
		$first=true;
		foreach ($criterias as $criteria) {
			if (!$first) $sql.=' OR ';
			$sql.=$this->sqlSingle($criteria);
			$first=false;
		}
		$sql.=')';
		return $sql;
	} 
	
	/**
	 * 
	 * Creates SQL for single criteria
	 * @param mixed $criteria
	 */
	private function sqlSingle($criteria) {
		switch ($this->compare) {
			case self::CompareIs :
				return $this->escapeColumn($this->column) . ' = ' . $criteria;
			case self::CompareIsNot :
				return $this->createNot($this->escapeColumn($this->column) . ' = ' . $criteria);
			case self::CompareLike :
				return $this->escapeColumn($this->column) . ' LIKE ' . $criteria;
			case self::CompareNotLike :
				return $this->createNot($this->escapeColumn($this->column) . ' LIKE ' . $criteria);
			case self::CompareGreater :
				return $this->escapeColumn($this->column) . ' > ' . $criteria;
			case self::CompareSmaller :
				return $this->escapeColumn($this->column) . ' < ' . $criteria;
			case self::CompareGreaterOrEqual :
				return $this->escapeColumn($this->column) . ' >= ' . $criteria;
			case self::CompareSmallerOrEqual :
				return $this->escapeColumn($this->column) . ' <= ' . $criteria;
			case self::CompareFulltext :
				if (is_array($this->column)) {
					
					$columns=array();
					foreach ($this->column as $col) {
						$columns[]=$this->escapeColumn($col);
					}
					
					return 'MATCH ('.implode(',',$columns).') AGAINST ('.$criteria.' IN BOOLEAN MODE)';
				} else {
					return 'MATCH ('.$this->escapeColumn($this->column).') AGAINST ('.$criteria.' IN BOOLEAN MODE)';
				}
		}	
	}
	
	/**
	 * 
	 * Creates a NOT( .. ) statement
	 * @param string $value Positive statement
	 * @return string NOT statement
	 */
	private function createNot($value) {
		return 'NOT ('.$value.')';
	}
	
	/**
	 * 
	 * Escapes a colums
	 * @param mixed $value
	 * @return string Escaped column 
	 */
	private function escapeColumn($value) {
		if ($value instanceof iNGDBCreatesSQL) {
			/* @var $value iNGDBCreatesSQL */
			return $value->sql ();
		} else {
			return NGDBConnector::escapeIdentifier ( $value );
		}
	}
}