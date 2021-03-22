<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginlayout/ngpluginlayouttphone/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginlayoutphone';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutphone/ngpluginlayoutphone.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutphone/settings/ngpluginlayoutphonesettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginLayoutPhoneSettings */
			$settings = $c->loadSetting ( NGPluginLayoutPhoneSettings::IdLayoutPhone, NGPluginLayoutPhoneSettings::ObjectTypePluginLayoutPhoneSettings );
			
			if ($settings->width==320) $settings->width=340;
			
			$css->templateFilename = 'ngpluginlayout/ngpluginlayoutphone/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();