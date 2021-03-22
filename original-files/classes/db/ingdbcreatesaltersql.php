<?php
interface iNGDBCreatesAlterSQL {
	/**
	 * 
	 * Returns the SQL-Part as a string
	 * @return array SQL statments
	 */
	public function alterSql($currentVersion);
}