<?php

class NGPluginEyecatcherIFrame extends NGPluginEyecatcher {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$this->isEmpty = true;
		
		if ($settings [1] !== '') {
			
			$this->template->assign ( 'source', $settings [1] );
			$this->template->assign ( 'width', $this->renderWidth );
			$this->template->assign ( 'height', $settings [2] );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatcheriframe/tpl/eyecatcher.tpl' );
			$this->isEmpty = false;
		}
	
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = '100';
		
		return $settings;
	}
}