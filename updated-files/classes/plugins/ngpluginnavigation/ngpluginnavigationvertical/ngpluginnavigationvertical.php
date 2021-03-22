<?php

class NGPluginNavigationVertical extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, intval ( $settings [10] ) + 1 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$htmlNav = ($home === NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [10] ), 1, $settings [10] == 1, $activeTopicUid );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationvertical/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationvertical' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationvertical/css/?id=' . $this->targetDIV );
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '000000';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '4682b4';
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
			$settings [9] = '';
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = '1';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = '10';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = '808080';
		
		return $settings;
	}
}