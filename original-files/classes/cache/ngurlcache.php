<?php

class NGURLCache {
	
	const TableURLCache = 'url_cache';
	const ColumnFolderUID = 'folder_uid';
	const ColumnItemUID = 'item_uid';
	const ColumnURL = 'url';
	const ColumnRootUID = 'root_uid';
	const ColumnStepsToRoot = 'steps_to_root';
	
	/**
	 * 
	 * Stores a url lookup in the cache
	 */
	public function storeURL($url, $rootUID, NGResolveVanityURLResult $lookup) {
		if ($this->selectURL ($url, $rootUID)->num_rows>0)
		{
			$this->updateURL($url, $rootUID, $lookup);
		} else 
		{
			$this->insertURL($url, $rootUID, $lookup);
		}		
	}
		
	/**
	 * 
	 * Clears the cache
	 */
	public function clear() {
		$queryDelete = new NGDBQueryDelete ();
		$queryDelete->table = self::TableURLCache;
		$queryDelete->executeQuery ();
	}
	
	/**
	 * 
	 * Lookup a url
	 * @param unknown_type $url
	 */
	public function lookupURL($url, $rootUID)
	{
		$result = $this->selectURL($url, $rootUID);
		
		if ($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
			$result = new NGResolveVanityURLResult();
			$result->folderUID=$row[self::ColumnFolderUID];
			$result->itemUID=$row[self::ColumnItemUID];
			$result->stepsToRoot=$row[self::ColumnStepsToRoot];
			return $result;
		} else 
		{
			return null;
		}
	}
	
	/**
	 * 
	 * Retrieves a cached page
	 * @return mysqli_result
	 */
	private function selectURL($url, $rootUID) {
		$querySelect = new NGDBQuerySelect ();
		$querySelect->table = self::TableURLCache;
		$querySelect->colums = Array (self::ColumnFolderUID, self::ColumnItemUID, self::ColumnStepsToRoot );
		$querySelect->whereCriterias = Array (
			new NGDBQPartCriteriaWhere ( self::ColumnURL, $url, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
			new NGDBQPartCriteriaWhere ( self::ColumnRootUID, $rootUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs )
			);
		return $querySelect->executeQuery();		
	}
	
	/**
	 * 
	 * Perform insert
	 */
	private function insertURL($url, $rootUID, NGResolveVanityURLResult $lookup) {
		$queryInsert = new NGDBQueryInsert ();
		$queryInsert->table = self::TableURLCache;
		$queryInsert->insertCriterias = Array(
			new NGDBQPartCriteria ( self::ColumnURL, $url, NGDBQPartCriteriaWhere::TypeString ), 
			new NGDBQPartCriteria ( self::ColumnRootUID, $rootUID, NGDBQPartCriteriaWhere::TypeString ), 
			new NGDBQPartCriteria ( self::ColumnFolderUID, $lookup->folderUID, NGDBQPartCriteriaWhere::TypeString ), 
			new NGDBQPartCriteria ( self::ColumnItemUID, $lookup->itemUID, NGDBQPartCriteriaWhere::TypeString ), 
			new NGDBQPartCriteria ( self::ColumnStepsToRoot, $lookup->stepsToRoot, NGDBQPartCriteriaWhere::TypeNumeric ) 
			);
		$queryInsert->executeQuery ();
	}
	
	/**
	 * 
	 * Perform update
	 */
	private function updateURL($url, $rootUID, NGResolveVanityURLResult $lookup) {
		$queryUpdate = new NGDBQueryUpdate ();
		$queryUpdate->table = self::TableURLCache;
		$queryUpdate->whereCriterias = Array ( 
			new NGDBQPartCriteriaWhere ( self::ColumnURL, $url, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
			new NGDBQPartCriteriaWhere ( self::ColumnRootUID, $rootUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs )
		);
		
		
		$queryUpdate->updateCriterias = Array (
			new NGDBQPartCriteria ( self::ColumnFolderUID, $lookup->folderUID, NGDBQPartCriteriaWhere::TypeString ) ,
			new NGDBQPartCriteria ( self::ColumnItemUID, $lookup->itemUID, NGDBQPartCriteriaWhere::TypeString ) ,
			new NGDBQPartCriteria ( self::ColumnStepsToRoot, $lookup->stepsToRoot, NGDBQPartCriteriaWhere::TypeNumeric )
		);
		
		$queryUpdate->executeQuery ();
	}
}