<?php

class NGFTS {
	
	const TableFTS = 'fts';
	const ColumnObjectUID = 'object_uid';
	const ColumnData = 'data';
	const ColumnMeta = 'meta';
	const AliasFTS = 'f';
	
	/**
	 * 
	 * Object UID to store in fts
	 * @var string
	 */
	public $objectUID = '';
	
	/**
	 * 
	 * Visible data to store
	 * @var string
	 */
	public $data = '';
	
	/**
	 * 
	 * Invisible meta
	 * @var string
	 */
	public $meta = '';
	
	/**
	 * 
	 * Number of found hits
	 * @var int
	 */
	public $count;
	
	/**
	 * 
	 * Criteria to serach
	 * @var string
	 */
	public $criteria = '';
	
	/**
	 * 
	 * Max length of result
	 * @var string
	 */
	public $length = 250;
	
	/**
	 * 
	 * Offset of result
	 * @var int
	 */
	public $offset = 0;
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $itemsPerPage = 5;
	
	/**
	 * 
	 * Result of search
	 * @var unknown_type
	 */
	public $result = array ();
	
	/**
	 * 
	 * User preview mode
	 * @var bool
	 */
	public $previewMode = false;
	
	/**
	 * 
	 * Get Pictures
	 * @var bool
	 */
	public $getPictures = true;
	
	/**
	 * 
	 * Size of picture
	 * @var int
	 */
	public $pictureSize = 128;
	
	/**
	 * 
	 * Stores a page in the index
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
	 * Clears the index
	 */
	public function clear() {
		$queryDelete = new NGDBQueryDelete ();
		$queryDelete->table = self::TableFTS;
		$queryDelete->executeQuery ();
	}
	
	/**
	 * 
	 * Performs the search
	 */
	public function search() {
		if ($this->criteria === '')
			return;
		
		$querySearch = new NGDBQuerySelect ();
		$querySearch->table = new NGDBQPartTableAs ( self::TableFTS, self::AliasFTS );
		$querySearch->joins [] = new NGDBQPartJoin ( new NGDBQPartTableAs ( NGDBAdapterObject::TableObject, NGDBAdapterObject::AliasObject ), Array (new NGDBQPartOn ( new NGDBQPartAliasColumn ( self::AliasFTS, self::ColumnObjectUID ), new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasObject, NGDBAdapterObject::ColumnObjectUID ) ) ) );
		$querySearch->joins [] = new NGDBQPartJoin ( new NGDBQPartTableAs ( NGDBAdapterObject::TableProperty, NGDBAdapterObject::AliasProperty ), Array (new NGDBQPartOn ( new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasProperty, NGDBAdapterObject::ColumnObjectUID ), new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasObject, NGDBAdapterObject::ColumnObjectUID ) ) ) );
		$querySearch->whereCriterias [] = new NGDBQPartCriteriaWhere ( new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasProperty, NGDBAdapterObject::ColumnName ), 'caption', NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs );
		$querySearch->whereCriterias [] = new NGDBQPartCriteriaWhere ( Array (self::ColumnData, self::ColumnMeta ), $this->criteria, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareFulltext );
		$querySearch->orderColumns = Array (new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasProperty, NGDBAdapterObject::ColumnValueString ) );
		$querySearch->colums = Array (new NGDBQPartAliasColumn ( self::AliasFTS, self::ColumnObjectUID ), new NGDBQPartAliasColumnAs ( NGDBAdapterObject::AliasProperty, NGDBAdapterObject::ColumnValueString, 'caption' ), new NGDBQPartLeft ( self::ColumnData, $this->length ) );
		
		if ($this->getPictures) {
			$querySearch->joins [] = new NGDBQPartJoin ( new NGDBQPartTableAs ( NGDBAdapterObject::TableProperty, NGDBAdapterObject::AliasProperty . '2' ), Array (new NGDBQPartOn ( new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasProperty . '2', NGDBAdapterObject::ColumnObjectUID ), new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasObject, NGDBAdapterObject::ColumnObjectUID ) ) ) );
			$querySearch->whereCriterias [] = new NGDBQPartCriteriaWhere ( new NGDBQPartAliasColumn ( NGDBAdapterObject::AliasProperty . '2', NGDBAdapterObject::ColumnName ), 'picture', NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs );
			$querySearch->colums [] = new NGDBQPartAliasColumnAs ( NGDBAdapterObject::AliasProperty . '2', 'value_string', 'picture' );
		}
				
		$result = $querySearch->executeQuery ();
		
		$this->count = $result->num_rows;
		
		if ($this->offset != 0)
			$result->data_seek ( $this->offset * $this->itemsPerPage );
		
		$row = $result->fetch_assoc ();
		
		$link = new NGLink ();
		$link->linkType = NGLink::LinkPage;
		$link->previewMode = $this->previewMode;
		
		$i = 0;
		
		while ( $row ) {
			$link->uid = $row [NGDBAdapterObject::ColumnObjectUID];
			
			$data = $row [self::ColumnData];
			
			if (strlen ( $data ) >= $this->length)
				$data .= ' …';
			
			$pictureUID = '';
			$pictureURL = '';
			
			if ($this->getPictures) {
				$pictureUID = $row ['picture'];
				if ($pictureUID !== '')
					$pictureURL = NGLink::getPictureURL ( $pictureUID, $this->pictureSize, -1, NGPicture::RatioNone );
			}
			
			$this->result [] = new NGFTSResult ( $row ['caption'], $data, $row [NGDBAdapterObject::ColumnObjectUID], $link->getURL (), $pictureUID, $pictureURL );
			
			$row = $result->fetch_assoc ();
			$i ++;
			if ($i >= $this->itemsPerPage)
				break;
		}
	}
	
	/**
	 * 
	 * Get a page from index
	 */
	private function retrievePage() {
		$querySelect = new NGDBQuerySelect ();
		$querySelect->table = self::TableFTS;
		$querySelect->colums = Array (self::ColumnObjectUID );
		$querySelect->whereCriterias = Array (new NGDBQPartCriteriaWhere ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
		return $querySelect->executeQuery ();
	}
	
	/**
	 * 
	 * Perform insert
	 */
	private function insertPage() {
		$queryInsert = new NGDBQueryInsert ();
		$queryInsert->table = self::TableFTS;
		$queryInsert->insertCriterias = Array (new NGDBQPartCriteria ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteriaWhere::TypeString ), new NGDBQPartCriteria ( self::ColumnData, $this->data, NGDBQPartCriteria::TypeString ), new NGDBQPartCriteria ( self::ColumnMeta, $this->meta, NGDBQPartCriteria::TypeString ) );
		
		$queryInsert->executeQuery ();
	}
	
	/**
	 * 
	 * Perform update
	 */
	private function updatePage() {
		$queryUpdate = new NGDBQueryUpdate ();
		$queryUpdate->table = self::TableFTS;
		$queryUpdate->whereCriterias = Array (new NGDBQPartCriteriaWhere ( self::ColumnObjectUID, $this->objectUID, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
		
		$queryUpdate->updateCriterias = Array (new NGDBQPartCriteria ( self::ColumnData, $this->data, NGDBQPartCriteria::TypeString ), new NGDBQPartCriteria ( self::ColumnMeta, $this->meta, NGDBQPartCriteria::TypeString ) );
		
		$queryUpdate->executeQuery ();
	}
}

class NGFTSResult {
	/**
	 * 
	 * Caption of result
	 * @var string
	 */
	public $caption;
	
	/**
	 * 
	 * Summaray
	 * @var string
	 */
	public $summary;
	
	/**
	 * 
	 * UID
	 * @var string
	 */
	public $objectUID;
	
	/**
	 * 
	 * URL
	 * @var string
	 */
	public $url;
	
	/**
	 * 
	 * Picture UID
	 * @var string
	 */
	public $pictureUID;
	
	/**
	 * 
	 * Picture URL
	 * @var string
	 */
	public $pictureURL;
	
	public function __construct($caption, $summary, $objectUID, $url, $pictureUID = '', $pictureURL = '') {
		$this->caption = $caption;
		$this->summary = $summary;
		$this->objectUID = $objectUID;
		$this->pictureUID = $pictureUID;
		$this->pictureURL = $pictureURL;
		$this->url = $url;
	}
}