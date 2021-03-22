<?php

class NGDBQueryDelete extends NGDBQueryWhere {
    /**
     * Generate SQL statement for query
     * @return string SQL statement
     */
    public function sql() {
        $sql='DELETE FROM ';
        $sql.=NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->table);
        $sql.=$this->sqlWhere();

        return $sql;
    }
}