<?php
abstract class NGDBQueryWhere extends NGDBQuery {
	
	/**
	 * 
	 * WHERE criterias
	 * @var array Array of NGDBQPartCriteriaWhere
	 */
	public $whereCriterias=array();
	
	/**
     * 
     * Creates the where statements
     * @return string prepared statements
     */
    protected function sqlWhere() {
        $sql='';
        $first=true;

        foreach($this->whereCriterias as $criteria) {
        	/* @var $criteria NGDBQPartCriteriaWhere */
        	$sql.=($first?'WHERE ':'AND ');
            $sql.=$criteria->sql()."\n";
            $first=false;
        }
        return $sql;
    }
	
	
}