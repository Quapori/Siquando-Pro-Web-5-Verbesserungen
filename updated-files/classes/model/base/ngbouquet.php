<?php

class NGBouquet {
	const SortModeNatural = 'Natural';
	const SortModeNameAsc = 'NameAsc';
	const SortModeNameDesc = 'NameDesc';
	const SortModeCreationDateAsc = 'CreationDateAsc';
	const SortModeCreationDateDesc = 'CreationDateDesc';
	
	const ItemsSourceChildPages = 'ChildPages';
	const ItemsSourceChildFolders = 'ChildFolders';
	const ItemsSourceChildPictures = 'ChildPictures';
	const ItemsSourceManual = 'Manual';
	
	/**
	 * 
	 * The way the bouquet should be sorted
	 * @var string
	 */
	public $sortMode = self::SortModeNameAsc;
	
	/**
	 * 
	 * Source of bouquet
	 * @var string
	 */
	public $itemSource = self::ItemsSourceChildPages;
	
	/**
	 * 
	 * UID of parent folder
	 * @var string
	 */
	public $parentUID;
	
	/**
	 * 
	 * Maximum number of items
	 * @var int
	 */
	public $maxItemCount = 0;
	
	/**
	 * 
	 * Skip numer of items
	 * @var int
	 */
	public $skipItems = 0;
	
	/**
	 * 
	 * Collected items
	 * @var Array
	 */
	public $items = Array ();
	
	/**
	 * 
	 * Items a XML
	 * @var string
	 */
	public $itemsXML = '';
	
	/**
	 * 
	 * use preview Mode
	 * @var bool
	 */
	public $previewMode = false;
	
	/**
	 * 
	 * Time for next change
	 * @var string
	 */
	public $nextScheduledChange = '';
	
	/**
	 * 
	 * Prepare items
	 */
	public function prepare($omitUID = '') {
		switch ($this->itemSource) {
			case self::ItemsSourceChildPictures :
				$this->prepareChildObjects ( NGPicture::ObjectTypePicture );
				break;
			case self::ItemsSourceChildPages :
				$this->prepareChildObjects ( NGPluginPage::ObjectTypePluginPage, $omitUID );
				break;
			case self::ItemsSourceChildFolders :
				$this->prepareChildObjects ( NGTopic::ObjectTypeTopic );
				break;
			case self::ItemsSourceManual :
				$this->prepareManual ();
				break;
		}
	}
	
	/**
	 * 
	 * Prepare manual items
	 */
	private function prepareManual() {
		$objectAdapter = new NGDBAdapterObject ();
		
		$this->items = Array ();
		
		if ($this->itemsXML != '') {
			$xml = new DOMDocument ( '1.0', 'UTF-8' );
			$xml->loadXML ( $this->itemsXML );
			
			foreach ( $xml->documentElement->childNodes as $itemElement ) {
				/* @var $itemElement DOMElement */
				if ($itemElement->nodeType == XML_ELEMENT_NODE) {
					if ($itemElement->nodeName == 'item') {
						$uid = ($itemElement->hasAttribute ( 'uid' )) ? ($itemElement->getAttribute ( 'uid' )) : '';
						$objectClass = ($itemElement->hasAttribute ( 'objectclass' )) ? ($itemElement->getAttribute ( 'objectclass' )) : '';
						
						if ($uid != '' && $objectClass != '') {
							try {
								$object = $objectAdapter->loadObject ( $uid, $objectClass, $objectClass );
								if ($object != null) {
									$item = new NGBouquetItem ( $object, $this->previewMode );
									
									foreach ( $itemElement->childNodes as $attributeElement ) {
										/* @var $attributeElement DOMElement */
										if ($attributeElement->nodeType == XML_ELEMENT_NODE) {
											switch ($attributeElement->nodeName) {
												case 'caption' :
													$item->overrideCaption = true;
													$item->caption = $attributeElement->nodeValue;
													break;
												case 'summary' :
													$item->overrideSummary = true;
													$item->summary = $attributeElement->nodeValue;
													break;
												case 'link' :
													$item->overrideLink = true;
													$item->link = $attributeElement->nodeValue;
													break;
												case 'picture' :
													$item->overridePictureUID = true;
													$item->pictureUID = $attributeElement->nodeValue;
													break;
											}
										}
									}
									$this->items [] = $item;
								}
							} catch ( Exception $ex ) {
							}
							if ($this->maxItemCount > 0) {
								if (count ( $this->items ) >= $this->maxItemCount)
									break;
							}
						}
					}
				}
			}
		}
	}
	
	/**
	 * 
	 * Prepare child items
	 * @param string $className
	 */
	public function prepareChildObjects($className, $omitUID = '') {
		$objectAdapter = new NGDBAdapterObject ();
		
		$sortByCaption = false;
		$sortDesc = false;
		
		switch ($this->sortMode) {
			case self::SortModeCreationDateAsc :
				$sortByCaption = false;
				$sortDesc = false;
				break;
			case self::SortModeCreationDateDesc :
				$sortByCaption = false;
				$sortDesc = true;
				break;
			case self::SortModeNameAsc :
				$sortByCaption = true;
				$sortDesc = false;
				break;
			case self::SortModeNameDesc :
				$sortByCaption = true;
				$sortDesc = true;
				break;
		}
		
		$this->items = Array ();
		
		try {
		
		$childs = $objectAdapter->loadChildObjects ( $this->parentUID, $className, $className, '', true, true, true, false, $sortByCaption, $sortDesc );
		
		if ($this->sortMode == self::SortModeNatural && ($this->itemSource == self::ItemsSourceChildPages || $this->itemSource == self::ItemsSourceChildFolders)) {
			/* @var $topic NGTopic */
			$topic = $objectAdapter->loadObject ( $this->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );

			if ($topic===null) return;
			
			switch ($this->itemSource) {
				case self::ItemsSourceChildPages :
					$childs = NGUtil::sortItems ( $childs, $topic->sortManualPages );
					break;
				case self::ItemsSourceChildFolders :
					$childs = NGUtil::sortItems ( $childs, $topic->sortManualTopics );
					break;
			}
		}
		
		$i = 0;
		
		foreach ( $childs as $child ) {
			/* @var $child NGPluginPage */
			
			if ($child->isVisible () && $child->objectUID != $omitUID) {
				
				$i ++;
				
				if ($this->skipItems != 0 && $i <= $this->skipItems)
					continue;
				
				$item = new NGBouquetItem ( $child, $this->previewMode );
				$this->items [] = $item;
				
				if ($this->maxItemCount > 0) {
					if (count ( $this->items ) >= $this->maxItemCount)
						break;
				}
			}
			
			$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $child->nextVisibilityChange () );
		}
		}
		catch (NGNotFoundException $ex)
		{
		}
		catch (NGInTrashException $ex)
		{
		}
	}
	
}

/**
 * 
 * An item for a bouquet
 *
 *
 */
class NGBouquetItem {
	public $overrideCaption = false;
	
	public $caption = '';
	
	public $overrideSummary = false;
	
	public $summary = '';
	
	public $overridePictureUID = false;
	
	public $pictureUID = '';
	
	public $overrideLink = false;
	
	public $link = '';
	
	/**
	 * 
	 * Stored item 
	 * @var NGObjectNamedSummary
	 */
	public $item = null;
	
	private $linkedPicture = null;
	
	public $previewMode = false;
	
	/**
	 * Returns the picture
	 * @return NGPicture
	 */
	public function displayPicture() {
		switch ($this->item->class) {
			case NGPicture::ObjectTypePicture :
				return $this->item;
			default :
				return $this->getLinkedPicture ();
		}
	}
	
	private function getLinkedPicture() {
		if ($this->linkedPicture != null)
			return $this->linkedPicture;
		
		$uid = ($this->overridePictureUID) ? $this->pictureUID : $this->item->picture;
		
		$pictureAdapter = new NGDBAdapterObject ();
		
		$this->linkedPicture = $pictureAdapter->loadObject ( $uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		return $this->linkedPicture;
	}
	
	public function displayCaption() {
		return ($this->overrideCaption) ? $this->caption : $this->item->caption;
	}
	
	public function displaySummary() {
		return ($this->overrideSummary) ? $this->summary : $this->item->summary;
	}
	
	public function displayLink() {
		$link = new NGLink ( $this->previewMode );
		
		switch ($this->item->class) {
			case NGPicture::ObjectTypePicture :
				if ($this->overrideLink) {
					$link->parseURL ( $this->link );
				} else {
					$link->uid = $this->item->objectUID;
					$link->linkType = NGLink::LinkPicture;
				}
				break;
			case NGPluginPage::ObjectTypePluginPage :
				if ($this->overrideLink) {
					$link->parseURL ( $this->link );
				} else {
					$link->uid = $this->item->objectUID;
					$link->linkType = NGLink::LinkPage;
				}
				break;
			case NGTopic::ObjectTypeTopic :
				if ($this->overrideLink) {
					$link->parseURL ( $this->link );
				} else {
					$link->uid = $this->item->objectUID;
					$link->linkType = NGLink::LinkTopic;
				}
				break;
		}
		
		return $link;
	}
	
	public function __construct($item = null, $previewMode) {
		$this->item = $item;
		$this->previewMode = $previewMode;
	}
}