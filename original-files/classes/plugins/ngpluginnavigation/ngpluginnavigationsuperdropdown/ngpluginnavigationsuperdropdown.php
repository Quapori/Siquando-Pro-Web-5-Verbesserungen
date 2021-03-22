<?php

class NGPluginNavigationSuperDropDown extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		$sound = $settings [6];
		$animate = $settings [5] == 'true';
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$root = ($home === NULL) ? '' : $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [12] );
		
		$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [26] + 1 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		// $this->isEmpty = ($htmlNav == '');
		

		// Fill template
		$this->template->assign ( 'root', $root );
		$this->template->assign ( 'preview', $this->previewMode );
		$this->template->assign ( 'target', $this->targetDIV );
		$this->template->assign ( 'sound', ($sound == '') ? '' : NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationsuperdropdown/sounds/' . $sound ) );
		$this->template->assign ( 'animate', $animate );
		$this->template->assign ( 'activeUID', $activeTopicUid );
		$this->template->assign ( 'crop', NGPicture::stringToRatio ( $settings [20] ) );
		
		if (NGUtil::StringXMLToBool ( $settings [22] ))
			$this->setSearch ();
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationsuperdropdown/tpl/navigation.tpl' );
		
		$this->styleSheets ['navigationsuperdropdown' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationsuperdropdown/css/?id=' . $this->targetDIV );
		if ($animate || $sound != '')
			$this->javaScripts ['ngpluginnavigationsuperdropdown'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationsuperdropdown/js/menu.js' );
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '888888';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'd3d3d3';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = 'solid f0f0f0';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '888888';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'false';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = '';
		if (! array_key_exists ( 7, $settings )) {
			$settings [7] = 'Tahoma';
		} else {
			$settings [7] = NGFontUtil::getInstance ()->getFontStack ( $settings [7] );
		}
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = '12';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = 'false';
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = 'false';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = 'false';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = '1';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '10';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = 'solid ffffff';
		if (! array_key_exists ( 15, $settings )) {
			$settings [15] = 'Tahoma';
		} else {
			$settings [15] = NGFontUtil::getInstance ()->getFontStack ( $settings [15] );
		}
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = '12';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = 'true';
		if (! array_key_exists ( 18, $settings ))
			$settings [18] = 'false';
		if (! array_key_exists ( 19, $settings ))
			$settings [19] = 'true';
		if (! array_key_exists ( 20, $settings ))
			$settings [20] = 'Ratio3by4';
		if (! array_key_exists ( 21, $settings ))
			$settings [21] = 'b0b0b0';
		if (! array_key_exists ( 22, $settings ))
			$settings [22] = 'false';
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
			$settings [29] = '5';
		if (! array_key_exists ( 30, $settings ))
			$settings [30] = '5';
		if (! array_key_exists ( 31, $settings ))
			$settings [31] = '160';
		if (! array_key_exists ( 32, $settings ))
			$settings [32] = 'solid dcdcdc';
		if (! array_key_exists ( 33, $settings ))
			$settings [33] = '000000';
		
		$settings [- 1] = new NGMargin ( $settings [13] );
		
		return $settings;
	}
}