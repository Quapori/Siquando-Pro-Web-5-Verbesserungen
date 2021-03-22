<?php

class NGTemplate extends Smarty {
	public function __construct() {
		parent::__construct ();
		
		$this->setTemplateDir ( NGConfig::templatePath () );
		$this->setCompileDir ( NGConfig::storePath () . DIRECTORY_SEPARATOR . 'templates_c' . DIRECTORY_SEPARATOR );
		$this->setPluginsDir ( array (SMARTY_PLUGINS_DIR, NGConfig::pluginsPath () . '/smarty' ) );
		$this->setCacheDir ( NGConfig::storePath () . DIRECTORY_SEPARATOR. 'cache' . DIRECTORY_SEPARATOR );
		$this->setConfigDir ( NGConfig::templatePath () );
		
		if (NGConfig::DebugMode) {
			// $this->force_compile = true;
		} 
	}
	
	public function fetchPluginTemplate($file) {
		return $this->fetch ( 'file:' . NGUtil::joinPaths ( NGConfig::pluginsPath (), $file ) );
	}
	
	public function displayPluginTemplate($file) {
		return $this->display ( 'file:' . NGUtil::joinPaths ( NGConfig::pluginsPath (), $file ) );
	}
	
}