<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginlayout/ngpluginlayoutpro/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginlayoutpro';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutpro/ngpluginlayoutpro.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutpro/settings/ngpluginlayoutprosettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginLayoutProSettings */
			$settings = $c->loadSetting ( NGPluginLayoutProSettings::IdLayoutPro, NGPluginLayoutProSettings::ObjectTypePluginLayoutProSettings );
						
			$css->templateFilename = 'ngpluginlayout/styles/'.$settings->template.'/tpl/style.tpl';
						
			$css->template->assign ( 'config', $settings->config );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();