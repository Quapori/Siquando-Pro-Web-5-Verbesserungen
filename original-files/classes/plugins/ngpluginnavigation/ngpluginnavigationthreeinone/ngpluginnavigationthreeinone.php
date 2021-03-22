<?php

class NGPluginNavigationThreeInOne extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		$sound = $settings [7];
		$animate = $settings [8] == 'true';
		$height = intval ( $settings [1] );
		
		$navleft = 0;
		
		if ($settings [5] == 'true') {
			
			// Create navigation
			$navigation = new NGRenderNavigation ();
			$navigation->previewMode = $this->previewMode;
			
			$level = $settings [6];
			$includeHome = true;
			
			if ($level == 0) {
				$level = 1;
				$includeHome = false;
			}
			
			$home = NGSession::getInstance ()->getNavRootHome ();
			
			$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level + 1 );
			$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
			
			$htmlNav = ($home == NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level ), 4, $includeHome, $activeTopicUid );
			
			$this->isEmpty = ($htmlNav == '');
			
			// Fill template
			if (! $this->isEmpty) {
				$this->template->assign ( 'nav', $htmlNav );
				$this->template->assign ( 'target', $this->targetDIV );
				$this->template->assign ( 'sound', ($sound == '') ? '' : NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationthreeinone/sounds/' . $sound ) );
				$this->template->assign ( 'animate', $animate );
			}
		}
		
		if ($settings [2] !== '') {
			
			$pictureAdapter = new NGDBAdapterObject ();
			
			/* @var $picture NGPicture */
			$picture = $pictureAdapter->loadObject ( $settings [2], NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
			if ($picture != null) {
				
				$picturepadding = new NGMargin ( $settings [4] );
				
				$pictureheight = $height - $picturepadding->totalHeight ();
				
				if ($pictureheight > 4) {
					
					$size = $picture->getResizedSize ( - 1, $pictureheight );
					
					$this->template->assign ( 'logosource', NGLink::getPictureURL ( $settings [2], $size->width, $size->height ) );
					$this->template->assign ( 'logowidth', $size->width );
					$this->template->assign ( 'logoheight', $size->height );
					
					$this->template->assign ( 'logolink', NGLink::getLinkToHome ( $this->previewMode ) );
					
					if ($settings [3] == 'Left') {
						$navleft = $size->width + $picturepadding->totalWidth ();
					}
				
				}
			}
		}
		
		if ($settings [16] == 'true') {
			
			$objectAdapter = new NGDBAdapterObject ();
			try {
				
				/* @var $standardTopics NGSettingsStandardTopics */
				$standardTopics = $objectAdapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
				if (! array_key_exists ( 'common', $standardTopics->topicuids ))
					return false;
				
				$childs = $objectAdapter->loadChildObjects ( $standardTopics->topicuids ['common'], NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage );
				
				$topic = $objectAdapter->loadObject ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
				
				$childs = NGUtil::sortItems ( $childs, $topic->sortManualPages );
				
				$items = Array ();
				
				$lightbox = $settings [17] === 'true';
				
				foreach ( $childs as $child ) {
					/* @var $child NGPluginPage */
					if ($child->isVisible ()) {
						$link = new NGLink ( $this->previewMode );
						$link->uid = $child->objectUID;
						$link->linkType = $lightbox ? NGLink::LinkPagePopup : NGLink::LinkPage;
						$items [] = new NGThreeInOneCommonPage ( $child->caption, $link->getURL () );
					}
					$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $child->nextVisibilityChange () );
				}
				
				$this->template->assign ( 'common', $items );
				$this->template->assign ( 'commonlightbox', $lightbox );
			
			} catch ( Exception $ex ) {
			}
		
		}
		
		$this->template->assign ( 'navleft', $navleft );
		
		if (NGUtil::StringXMLToBool ( $settings [22] ))
			$this->setSearch ();
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationthreeinone/tpl/navigation.tpl' );
		
		$this->styleSheets ['navigationdropdown' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationthreeinone/css/?id=' . $this->targetDIV );
		if ($animate || $sound != '')
			$this->javaScripts ['ngpluginnavigationthreeinone'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationthreeinone/js/menu.js' );
	
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '140';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = 'Left';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '0';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'true';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = '1';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = '';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'true';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = '10';
		if (! array_key_exists ( 10, $settings )) {
			$settings [10] = 'Tahoma,13,false,false,false,000000';
		} else {
			$settings [10] = NGUtil::unescapeComma ( $settings [10] );
			self::registerFont ( $settings [10] );
		}
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = 'f6f6f6';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'dddddd';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '0';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = 'f0f0f0';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = '000000';
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = 'true';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = 'false';
		if (! array_key_exists ( 18, $settings )) {
			$settings [18] = 'Tahoma,13,false,false,false,000000';
		} else {
			$settings [18] = NGUtil::unescapeComma ( $settings [18] );
			self::registerFont ( $settings [18] );
		}
		if (! array_key_exists ( 19, $settings ))
			$settings [19] = '10';
		if (! array_key_exists ( 20, $settings ))
			$settings [20] = 'f6f6f6';
		if (! array_key_exists ( 21, $settings ))
			$settings [21] = '000000';
		if (! array_key_exists ( 22, $settings ))
			$settings [22] = 'true';
		if (! array_key_exists ( 23, $settings ))
			$settings [23] = '000000';
		if (! array_key_exists ( 24, $settings ))
			$settings [24] = 'solid ffffff';
		if (! array_key_exists ( 25, $settings ))
			$settings [25] = 'd3d3d3';
		if (! array_key_exists ( 26, $settings ))
			$settings [26] = '1';
		if (! array_key_exists ( 27, $settings ))
			$settings [27] = '0';
		if (! array_key_exists ( 28, $settings ))
			$settings [28] = 'default';
		if (! array_key_exists ( 29, $settings ))
			$settings [29] = '160';
		if (! array_key_exists ( 30, $settings ))
			$settings [30] = '0';
		if (! array_key_exists ( 31, $settings ))
			$settings [31] = 'dddddd';
		if (! array_key_exists ( 32, $settings ))
			$settings [32] = '57 10 10 10';
			
		$settings[-1] = explode ( ' ', $settings[13] );
		
		if (count ($settings[-1])==1) 
		{
			$settings[-1][1]=$settings[-1][0];
			$settings[-1][2]=$settings[-1][0];
			$settings[-1][3]=$settings[-1][0];
		}
							
		$settings[-2] = explode ( ' ', $settings[32] );
				
		return $settings;
	}
	
	/**
	 * 
	 * Register used font
	 * @param string $font
	 */
	public static function registerFont($font) {
		$ngfont = new NGFont ( $font );
		NGFontUtil::getInstance ()->getFontStack ( $ngfont->fontfamily );
	}
}

class NGThreeInOneCommonPage {
	public $caption;
	public $link;
	
	public function __construct($caption, $link) {
		$this->caption = $caption;
		$this->link = $link;
	}
}