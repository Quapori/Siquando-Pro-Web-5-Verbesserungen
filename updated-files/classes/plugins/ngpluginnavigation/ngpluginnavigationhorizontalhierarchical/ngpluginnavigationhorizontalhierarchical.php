<?php

class NGPluginNavigationHorizontalHierarchical extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		$htmlNav = ($home === NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [15] ), 2, false, $this->currentPage->parentUID );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			
			if (NGUtil::StringXMLToBool ( $settings [18] ))
				$this->setSearch ();
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationhorizontalhierarchical/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationhorizontalhierarchical' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationhorizontalhierarchical/css/?id=' . $this->targetDIV );
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '000000';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '4682b4';
		if (! array_key_exists ( 3, $settings )) {
			$settings [3] = 'Tahoma';
		} else {
			$settings [3] = NGFontUtil::getInstance ()->getFontStack ( $settings [3] );
		}
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '12';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'false';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = 'false';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'true';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = '696969';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = '4682b4';
		if (! array_key_exists ( 10, $settings )) {
			$settings [10] = 'Tahoma';
		} else {
			$settings [10] = NGFontUtil::getInstance ()->getFontStack ( $settings [10] );
		}
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '11';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'false';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = 'false';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = 'false';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = '1';
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = '10';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = '0 10 10 10';
		if (! array_key_exists ( 18, $settings ))
			$settings [18] = 'false';
		if (! array_key_exists ( 19, $settings ))
			$settings [19] = '000000';
		if (! array_key_exists ( 20, $settings ))
			$settings [20] = 'solid ffffff';
		if (! array_key_exists ( 21, $settings ))
			$settings [21] = 'd3d3d3';
		if (! array_key_exists ( 22, $settings ))
			$settings [22] = '1';
		if (! array_key_exists ( 23, $settings ))
			$settings [23] = '0';
		if (! array_key_exists ( 24, $settings ))
			$settings [24] = 'default';
		if (! array_key_exists ( 25, $settings ))
			$settings [25] = '5';
		if (! array_key_exists ( 26, $settings ))
			$settings [26] = '5';
		if (! array_key_exists ( 27, $settings ))
			$settings [27] = '160';
		if (! array_key_exists ( 28, $settings ))
			$settings [28] = '000000';
		if (! array_key_exists ( 29, $settings ))
			$settings [29] = '000000';
		
		return $settings;
	}
}