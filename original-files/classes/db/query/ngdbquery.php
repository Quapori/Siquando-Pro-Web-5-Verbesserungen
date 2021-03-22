<?php

abstract class NGDBQuery implements iNGDBCreatesSQL
{

    /**
     *
     * Table to run the query on
     * @var string|NGDBQPartTableAs $table
     */
    public $table;

    /**
     * Executes the query
     * @return mysqli_result The query result
     */
    public function executeQuery()
    {
        $sql = $this->sql();

        // echo($sql)."\n";

        $result = NGDBConnector::getInstance()->connection->query($sql);

        if (!$result) {
            if (NGDBConnector::getInstance()->connection->errno === 1062) {
                throw new NGDatabaseDuplicateKeyException(NGDBConnector::getInstance()->connection->errno, NGDBConnector::getInstance()->connection->error, $sql);
            } else {
                throw new NGDatabaseException(NGDBConnector::getInstance()->connection->errno, NGDBConnector::getInstance()->connection->error, $sql);
            }
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getInsertId()
    {
        return NGDBConnector::getInstance()->connection->insert_id;
    }
}