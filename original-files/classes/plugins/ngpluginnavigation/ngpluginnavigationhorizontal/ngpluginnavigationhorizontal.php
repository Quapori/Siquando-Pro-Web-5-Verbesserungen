<?php

class NGPluginNavigationHorizontal extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, intval ( $settings [9] ) + 1 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$htmlNav = ($home === NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [9] ), 1, $settings [9] == 1, $activeTopicUid );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			
			if (NGUtil::StringXMLToBool ( $settings [12] ))
				$this->setSearch ();
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationhorizontal/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationhorizontal' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationhorizontal/css/?id=' . $this->targetDIV );
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '000000';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '000000';
		if (! array_key_exists ( 4, $settings )) {
			$settings [4] = 'Tahoma';
		} else {
			$settings [4] = NGFontUtil::getInstance ()->getFontStack ( $settings [4] );
		}
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = '12';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = 'false';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'false';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'false';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = '1';
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = 'solid f0f0f0';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '10';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'false';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '000000';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = 'solid ffffff';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = 'd3d3d3';
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = '1';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = '0';
		if (! array_key_exists ( 18, $settings ))
			$settings [18] = 'default';
		if (! array_key_exists ( 19, $settings ))
			$settings [19] = '5';
		if (! array_key_exists ( 20, $settings ))
			$settings [20] = '5';
		if (! array_key_exists ( 21, $settings ))
			$settings [21] = '160';
		if (! array_key_exists ( 22, $settings ))
			$settings [22] = 'solid dcdcdc';
		if (! array_key_exists ( 23, $settings ))
			$settings [23] = '000000';
		
		return $settings;
	}
}