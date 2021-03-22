<?php

class NGDBQueryUpdate extends NGDBQueryWhere {
    /**
     * 
     * Columns to be updated
     * @var array Array of NGDbQueryCriteria
     */
    public $updateCriterias=array();
    

    /**
     * Generate SQL statement for query
     * @return string SQL statement
     */
    public function sql() {
        $sql='UPDATE ';
        $sql.=NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table)."\n";
        $sql.=$this->sqlSet()."\n";
        $sql.=$this->sqlWhere();

        return $sql;
    }

    /**
     * 
     * Creates the SET sql statements
     * @return string prepared statements
     */
    private function sqlSet() {
        $sql='';
        $first=true;

        foreach($this->updateCriterias as $criteria) {
        	/* @var $criteria NGDBQPartCriteria */
        	$sql.=$first?'SET ':', ';
        	$sql.=NGDBConnector::escapeIdentifier($criteria->column).' = ';
            $sql.=$criteria->sql();
            $first=false;
        }
        return $sql;
    }    
}