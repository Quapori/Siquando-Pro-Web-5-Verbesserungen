<?php

class NGPluginNavigationVerticalHierarchical extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		$htmlNav = ($home === NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $settings [9] ), 999, $settings [9] == 1, $this->currentPage->parentUID );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationverticalhierarchical/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationverticalhierarchical' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationverticalhierarchical/css/?id=' . $this->targetDIV );
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
			$settings [7] = 'false';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'default';
		if (! array_key_exists ( 9, $settings ))
			$settings [9] = '1';
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = '5 10 5 10';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '808080';
		
		return $settings;
	}
}