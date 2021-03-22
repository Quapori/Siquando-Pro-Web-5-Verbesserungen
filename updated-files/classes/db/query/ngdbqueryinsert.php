<?php

class NGDBQueryInsert extends NGDBQuery {
    public $insertCriterias=array();

    /**
     * Generate SQL statement for query
     * @return string SQL statement
     */
    public function sql() {
        $sql='INSERT into ';
        $sql.=NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table);
        $sql.=' (';
        $sql.=$this->sqlColumns();
        $sql.=")\n";
        $sql.=$this->sqlValues();

        return $sql;
    }

    private function sqlColumns() {
        $sql='';
        foreach ($this->insertCriterias as $criteria) {
			/* @var $criteria NGDBQPartCriteria */
            if ($sql!='') $sql.=',';
            $sql.=NGDBConnector::escapeIdentifier($criteria->column);
        }

        return $sql;
    }

    private function sqlValues() {
        $sql='VALUES (';
        $first=true;

        foreach($this->insertCriterias as $criteria) {
        	/* @var $criteria NGDBQPartCriteria */
        	if (!$first) $sql.=',';
            $sql.=$criteria->sql();
            $first=false;
        }
        
        $sql.=')';
        return $sql;
    }
}