<?php
class NGDBSchemaTable implements iNGDBCreatesSQL, iNGDBCreatesAlterSQL {
	
	public $name;
	public $defaultCharset;
	public $collate;
	public $columns = array();
	public $keys = array();
	public $version = '1.0';

	public function __construct() {
		$this->defaultCharset=NGDBConnector::DefaultCharset;
		$this->collate=NGDBConnector::DefaultCollate;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see iNGDBCreatesSQL::sql()
	 */
	public function sql() {
		$sql='CREATE TABLE '.NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->name).' (';
		
		$first=true;
		
		foreach ($this->columns as $column) {
			/* @var $column NGDBSchemaColumn */
			
			if ($first==false) $sql.=',';
			
			$sql.="\n";
			$sql.=$column->sql();
			$first=false;
		}
		
		foreach ($this->keys as $key) {
			/* @var $key NGDBSchemaKey */
			
			if ($first==false) $sql.=',';
			
			$sql.="\n";
			$sql.=$key->sql();
			$first=false;
		}
		
		
		$sql.="\n)";
		$sql.=' ENGINE='.NGConfig::DatabaseEngine;
		$sql.=' DEFAULT CHARSET='.$this->defaultCharset;
		$sql.=' COLLATE='.$this->collate;
		$sql.="\n";

		return $sql;
	}

    /**
     * @inheritDoc
     */
    public function alterSql($currentVersion)
    {
        $result = array();

        foreach ($this->columns as $column) {
            /* @var $column NGDBSchemaColumn */

            if ($currentVersion<$column->version)
            {
                $sql = 'ALTER TABLE ' . NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix . $this->name);
                /* @var $column NGDBSchemaColumn */

                $sql .= "\n";
                $sql .= "  ADD ";
                $sql .= $column->sql();
                $sql .= "\n";

                $result[] = $sql;
            }
        }

        foreach ($this->keys as $key) {
            /* @var $key NGDBSchemaKey */

            if ($currentVersion<$key->version) {
                $sql = 'ALTER TABLE ' . NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix . $this->name);

                $sql .= "\n";
                $sql .= "  ADD ";
                $sql .= $key->sql();
                $sql .= "\n";

                $result[] = $sql;
            }
        }

        return $result;
    }
}