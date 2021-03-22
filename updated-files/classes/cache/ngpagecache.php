<?php
class NGPageCache {
	public $objectUID = '';
	public $revisionUID = '';
	public $previewMode = false;
	public $layout = '';
	public $output = '';
	public $stepsToRoot = 0;
	public $valid = '';
	const TablePageCache = 'page_cache';
	const ColumnObjectUID = 'object_uid';
	const ColumnRevisionUID = 'revision_uid';
	const ColumnPreviewMode = 'preview_mode';
	const ColumnLayout = 'layout';
	const ColumnOutput = 'output';
	const ColumnValid = 'valid';
	const ColumnStepsToRoot = 'steps_to_root';
	
	/**
	 * Stores a page in the cache
	 */
	public function store() {
		$result = $this->retrievePage ();
		
		if ($result->num_rows == 0) {
			$this->insertPage ();
		} else {
			$this->updatePage ();
		}
	}
	
	/**
	 *
	 * Fetches a page from the cache
	 * 
	 * @return boolean true when page is in cahce
	 */
	public function fetch() {
		if (NGConfig::DebugMode)
			return false;
		
		$result = $this->retrievePage ();
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc ();
			
			if ($row [self::ColumnValid] !== '') {
				if (NGSession::getInstance ()->callTimestamp > strtotime ( $row [self::ColumnValid] ))
					return false;
			}
			
			$this->output = $row [self::ColumnOutput];
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Clears the cache
	 */
	public function clear() {
		$queryDelete = new NGDBQueryDelete ();
		$queryDelete->table = self::TablePageCache;
		$queryDelete->executeQuery ();
	}
	
	/**
	 *
	 * Retrieves a cached page
	 * 
	 * @return mysqli_result
	 */
	private function retrievePage() {
		$querySelect = new NGDBQuerySelect ();
		$querySelect->table = self::TablePageCache;
		$querySelect->colums = Array (
				self::ColumnOutput,
				self::ColumnValid 
		);
		$querySelect->whereCriterias = Array (
				new NGDBQPartCriteriaWhere ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnRevisionUID, $this->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnPreviewMode, $this->previewMode, NGDBQPartCriteriaWhere::TypeBoolean, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnStepsToRoot, $this->stepsToRoot, NGDBQPartCriteriaWhere::TypeNumeric, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnLayout, $this->layout, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ) 
		);
		
		return $querySelect->executeQuery ();
	}
	
	/**
	 * Perform insert
	 */
	private function insertPage() {
		$queryInsert = new NGDBQueryInsert ();
		$queryInsert->table = self::TablePageCache;
		$queryInsert->insertCriterias = Array (
				new NGDBQPartCriteria ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteriaWhere::TypeString ),
				new NGDBQPartCriteria ( self::ColumnRevisionUID, $this->revisionUID, NGDBQPartCriteriaWhere::TypeString ),
				new NGDBQPartCriteria ( self::ColumnLayout, $this->layout, NGDBQPartCriteriaWhere::TypeString ),
				new NGDBQPartCriteria ( self::ColumnPreviewMode, $this->previewMode, NGDBQPartCriteriaWhere::TypeBoolean ),
				new NGDBQPartCriteria ( self::ColumnStepsToRoot, $this->stepsToRoot, NGDBQPartCriteriaWhere::TypeNumeric ),
				new NGDBQPartCriteria ( self::ColumnOutput, $this->output, NGDBQPartCriteriaWhere::TypeString ),
				new NGDBQPartCriteria ( self::ColumnValid, $this->valid, NGDBQPartCriteriaWhere::TypeString ) 
		);
		
		$queryInsert->executeQuery ();
	}
	
	/**
	 * Perform update
	 */
	private function updatePage() {
		$queryUpdate = new NGDBQueryUpdate ();
		$queryUpdate->table = self::TablePageCache;
		$queryUpdate->whereCriterias = Array (
				new NGDBQPartCriteriaWhere ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnLayout, $this->layout, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnRevisionUID, $this->revisionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnPreviewMode, $this->previewMode, NGDBQPartCriteriaWhere::TypeBoolean, NGDBQPartCriteriaWhere::CompareIs ),
				new NGDBQPartCriteriaWhere ( self::ColumnStepsToRoot, $this->stepsToRoot, NGDBQPartCriteriaWhere::TypeNumeric, NGDBQPartCriteriaWhere::CompareIs ) 
		);
		
		$queryUpdate->updateCriterias = Array (
				new NGDBQPartCriteria ( self::ColumnOutput, $this->output, NGDBQPartCriteriaWhere::TypeString ),
				new NGDBQPartCriteria ( self::ColumnValid, $this->valid, NGDBQPartCriteriaWhere::TypeString ) 
		);
		
		$queryUpdate->executeQuery ();
	}
}