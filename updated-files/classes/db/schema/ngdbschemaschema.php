<?php

class NGDBSchemaSchema
{
    public $dropTables = array();
    public $tables = array();

    public function createSchema($currentVersion)
    {
        foreach ($this->dropTables as $dropTable) {
            /* @var $dropTable NGDBSchemaDropTable */
            if ($currentVersion < $dropTable->version) $this->query($dropTable->sql());
        }
        foreach ($this->tables as $table) {
            /* @var $table NGDBSchemaTable */
            if ($currentVersion < $table->version)  $this->query($table->sql());

        }
        foreach ($this->tables as $table) {
            /* @var $table NGDBSchemaTable */
            if ($currentVersion >= $table->version) {
                foreach ($table->alterSql($currentVersion) as $sql) {
                    $this->query($sql);
                }
            }
        }
    }

    private function query($sql)
    {
        $result = NGDBConnector::getInstance()->connection->query($sql);

        if (!$result) {
            throw new Exception(NGDBConnector::getInstance()->connection->error . ':' . $sql);
        }
    }
}