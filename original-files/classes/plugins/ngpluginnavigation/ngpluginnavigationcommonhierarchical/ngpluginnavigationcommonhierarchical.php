<?php

class NGPluginNavigationCommonHierarchical extends NGPluginNavigation {

	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$objectAdapter = new NGDBAdapterObject ();
		
		try {
			
			/* @var $standardTopics NGSettingsStandardTopics */
			$standardTopics = $objectAdapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
			if (! array_key_exists ( 'common', $standardTopics->topicuids ))
				return false;
			
			$topics = $objectAdapter->loadChildObjects ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
			
			/* @var $parenttopic NGTopic  */
			$parenttopic = $objectAdapter->loadObject ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
			
			$topics = NGUtil::sortItems ( $topics, $parenttopic->sortManualTopics );
			
			$items = Array ();
			
			$lightbox = $settings [7] === 'true';
			
			foreach ( $topics as $topic ) {
				
				/* @var $topic NGFolder */
				
				$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $topic->nextVisibilityChange () );
				
				if ($topic->isVisible ()) {
					
					$item = new NGCommonHierarchicalTopic ( $topic->caption );
					
					$objectAdapter = new NGDBAdapterObject ();
					
					$pages = $objectAdapter->loadChildObjects ( $topic->objectUID, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage );
					
					$pages = NGUtil::sortItems ( $pages, $topic->sortManualPages );
					
					foreach ( $pages as $page ) {
						if ($page->isVisible ()) {
							$link = new NGLink ( $this->previewMode );
							$link->uid = $page->objectUID;
							$link->linkType = $lightbox ? NGLink::LinkPagePopup : NGLink::LinkPage;
							$item->pages [] = new NGCommonHierarchicalPage ( $page->caption, $link->getUrl () );
						}
						$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $page->nextVisibilityChange () );
					}
					
					if (count ( $item->pages ) > 0)
						$items [] = $item;
				}
			}
			
			if (count ( $items ) > 0)
				$this->template->assign ( 'width', floor ( ($this->renderWidth / count ( $items )) ) );
			$this->template->assign ( 'topics', $items );
			$this->template->assign ( 'lightbox', $lightbox );
			$this->template->assign ( 'separator', $settings [10] );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationcommonhierarchical/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationcommonhierarchical' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationcommonhierarchical/css/?id=' . $this->targetDIV );
		} catch ( Exception $ex ) {
			return false;
		}
		
		return true;
	}

	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '000000';
		if (! array_key_exists ( 2, $settings )) {
			$settings [2] = 'Tahoma';
		} else {
			$settings [2] = NGFontUtil::getInstance ()->getFontStack ( $settings [2] );
		}
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '12';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = 'true';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'false';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = 'false';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'false';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = '000000';
		if (! array_key_exists ( 9, $settings )) {
			$settings [9] = 'Tahoma';
		} else {
			$settings [9] = NGFontUtil::getInstance ()->getFontStack ( $settings [9] );
		}
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = '12';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = 'false';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'false';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = 'false';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = '000000';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = 'true';
		
		return $settings;
	}
}

class NGCommonHierarchicalPage {

	public $caption;

	public $link;

	public function __construct($caption, $link) {
		$this->caption = $caption;
		$this->link = $link;
	}
}

class NGCommonHierarchicalTopic {

	public $caption;

	public $pages;

	public function __construct($caption) {
		$this->caption = $caption;
		$this->pages = Array ();
	}
}