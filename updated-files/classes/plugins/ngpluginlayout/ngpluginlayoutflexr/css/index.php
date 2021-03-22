<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginlayout/ngpluginlayouttflexr/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginlayoutflexr';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflexr/ngpluginlayoutflexr.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflexr/settings/ngpluginlayoutflexrsettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginLayoutFlexRSettings */
			$settings = $c->loadSetting ( NGPluginLayoutFlexRSettings::IdLayoutFlexR, NGPluginLayoutFlexRSettings::ObjectTypePluginLayoutFlexRSettings );
			
						
			$css->templateFilename = 'ngpluginlayout/ngpluginlayoutflexr/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();