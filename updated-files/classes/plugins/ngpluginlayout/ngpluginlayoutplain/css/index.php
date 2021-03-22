<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginlayout/ngpluginlayoutplain/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginlayoutphone';
		
		if (!$css->fetchFromCache ()) {
		 	include_once NGConfig::pluginsPath () . '/ngpluginlightbox/settings/ngpluginlightboxsettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginLightboxSettings */
			$settings = $c->loadSetting ( NGPluginLightboxSettings::IdLightbox, NGPluginLightboxSettings::ObjectTypeNGPluginLightboxSettings );
			
			$css->templateFilename = 'ngpluginlayout/ngpluginlayoutplain/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();