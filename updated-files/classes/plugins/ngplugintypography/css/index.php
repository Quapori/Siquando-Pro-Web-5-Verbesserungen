<?php

include_once './../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=4;
		NGSession::getInstance()->currentPath='classes/plugins/ngplugintypography/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngplugintypography';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngplugintypography/settings/ngplugintypographysettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginTypographySettings */
			$settings = $c->loadSetting ( NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings );
						
			$css->templateFilename = 'ngplugintypography/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
			
			$settings->registerWebFonts();
						
			$css->template->assign ( 'fonts', NGFontUtil::getInstance ()->styleSheets );
			
			
			
						
			$css->render ();			
		}
		$css->write ();
	}
	
}

$renderCSS = new renderCSS ();
$renderCSS->render ();