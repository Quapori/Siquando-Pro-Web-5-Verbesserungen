<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginlayout/ngpluginlayoutflex/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginlayoutflex';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/ngpluginlayoutflex.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/settings/ngpluginlayoutflexsettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginLayoutFlexSettings */
			$settings = $c->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
			
			$css->templateFilename = 'ngpluginlayout/ngpluginlayoutflex/tpl/css.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();