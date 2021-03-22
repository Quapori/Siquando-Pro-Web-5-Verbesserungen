<?php

class NGPluginNavigationCommon extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$objectAdapter = new NGDBAdapterObject ();
		
		try {
			
			/* @var $standardTopics NGSettingsStandardTopics */ 
			$standardTopics = $objectAdapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
			if (!array_key_exists ( 'common', $standardTopics->topicuids )) return false;
						
			$childs = $objectAdapter->loadChildObjects ( $standardTopics->topicuids['common'], NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage );
			
			$topic = $objectAdapter->loadObject ( $standardTopics->topicuids['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
			
			$childs = NGUtil::sortItems ( $childs, $topic->sortManualPages );
			
			$items = Array ();
			
			$lightbox = $settings [11] === 'true';
			
			foreach ( $childs as $child ) {
				/* @var $child NGPluginPage */
				if ($child->isVisible()) {
					$link = new NGLink ( $this->previewMode );
					$link->uid = $child->objectUID;
					$link->linkType = $lightbox ? NGLink::LinkPagePopup : NGLink::LinkPage;
					$items [] = new NGCommonPage ( $child->caption, $link->getURL () );
				}
				$this->nextScheduledChange=NGUtil::nextDate($this->nextScheduledChange, $child->nextVisibilityChange());
			}
			
			$this->template->assign ( 'items', $items );
			$this->template->assign ( 'lightbox', $lightbox );
			$this->template->assign ( 'separator', $settings [10] );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationcommon/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationcommon' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationcommon/css/?id=' . $this->targetDIV );
		} catch ( Exception $ex ) {
			return false;
		}
		
		return true;
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '000000';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '000000';
		if (! array_key_exists ( 3, $settings ))
		{
			$settings [3] = 'Tahoma';
		} else 
		{
			$settings [3] = NGFontUtil::getInstance()->getFontStack($settings [3]);
		}
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '12';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'false';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = 'false';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'false';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'true';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = 'center';
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = 'pipe';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = 'false';
		
		return $settings;
	}
}

class NGCommonPage {
	public $caption;
	public $link;
	
	public function __construct($caption, $link) {
		$this->caption = $caption;
		$this->link = $link;
	}
}