<?php

/**
 * Database abstraction class
 */
final class NGDBConnector {
	
	const DefaultCharset='utf8';
	const DefaultCollate='utf8_unicode_ci';
	
    private static $instance = NULL;
    /**
     *
     * @var mysqli Database connection
     */
    public $connection = NULL;

    private function __construct() {

    }

    private function __clone() {

    }

    /**
     * Singleton database access
     *
     * @return NGDBConnector Unique class instance
     */
    public static function getInstance() {

        if (self::$instance === NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Connects the database
     * @return msqli Database connection
     */
    public function connect() {
		try {
			if ($this->connection === NULL) {
				$this->connection = @new mysqli ( NGConfig::DatabaseHost, NGConfig::DatabaseUser, NGConfig::DatabasePassword, NGConfig::DatabaseSchema, NGConfig::DatabasePort );
				
				if (mysqli_connect_error ()) {
					throw new NGDatabaseException ( mysqli_connect_errno (), mysqli_connect_error () );
				}
				
				$this->connection->query ( "SET NAMES 'utf8'" );

				if (NGConfig::DatabaseSqlBigSelects) $this->connection->query ( "SET SESSION SQL_BIG_SELECTS=1" );
			}
		} catch ( Exception $ex ) {
			throw new NGDatabaseException ( $ex->getCode(), $ex->getMessage() );
		}

        return $this->connection;
    }

    /**
     * Disconnects the database
     */
    public function disconnect() {
        if ($this->isConnected()) {
            $this->connection->close();
            $this->connection = NULL;
        }
    }

    /**
     * Checks if the database is connected
     * @return bool true if database is connected
     */
    public function isConnected() {
        return!($this->connection == NULL);
    }
    
    /**
     * 
     * Escapes an identifier
     * @param string $name
     * @return string escaped identifier
     */
    public static function escapeIdentifier($name) {
    	return '`'.$name.'`';
    }
    
    public function beginTransaction() {
    	$this->connection->autocommit(false);
    }
    
    public function commitTransaction() {
    	$this->connection->commit();
    }

}