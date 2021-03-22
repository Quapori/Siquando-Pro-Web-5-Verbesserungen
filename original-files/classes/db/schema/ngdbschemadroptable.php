<?php

/**
 * 
 * Table to be dropped
 *
 *
 */
class NGDBSchemaDropTable implements iNGDBCreatesSQL {
	
	/**
	 * 
	 * Name of table
	 * @var string
	 */
	public $name;

	public $version = '1.0';
	
	/* (non-PHPdoc)
	 * @see iNGDBCreatesSQL::sql()
	 */
	public function sql() {
		return 'DROP TABLE IF EXISTS '.NGDBConnector::escapeIdentifier(NGConfig::DatabaseTablePrefix.$this->name)."\n";
	}

}