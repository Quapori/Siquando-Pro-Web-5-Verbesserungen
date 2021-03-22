<?php

class NGPluginNavigationFlyOut extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		$sound = $settings [13];
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$level = $settings [14];
		$includeHome = true;
		
		if ($level == 0) {
			$level = 1;
			$includeHome = false;
		}
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level + 1 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$htmlNav = ($home == NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level ), 5, $includeHome, $activeTopicUid );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			$this->template->assign ( 'sound', ($sound == '') ? '' : NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationflyout/sounds/' . $sound ) );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationflyout/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationflyout' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationflyout/css/?id=' . $this->targetDIV );
			if ($sound != '')
				$this->javaScripts ['ngpluginnavigationflyout'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationflyout/js/menu.js' );
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings )) {
			$settings [1] = 'Tahoma,12,false,false,false,000000';
		} else {
			$settings [1] = NGUtil::unescapeComma ( $settings [1] );
			self::registerFont ( $settings [1] );
		}
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'solid f0f0f0';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '000000';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = 'solid dcdcdc';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = '000000';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = '';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'd3d3d3';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'solid ffffff';
		if (! array_key_exists ( 9, $settings )) {
			$settings [9] = 'Tahoma,12,false,false,false,000000';
		} else {
			$settings [9] = NGUtil::unescapeComma ( $settings [9] );
			self::registerFont ( $settings [9] );
		}
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = 'solid f0f0f0';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '000000';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'false';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = '1';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = '10';
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = 'false';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = '';
			
		$settings [- 1] = new NGMargin ( $settings [15] );
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