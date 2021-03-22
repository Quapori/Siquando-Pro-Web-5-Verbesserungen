<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		$id=NGUtil::get('id','nav');
						
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginnavigation/ngpluginnavigationhorizontal/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'navigationhorizontal'.$id;
				
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginnavigation/ngpluginnavigationhorizontal/ngpluginnavigationhorizontal.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/settings/ngpluginlayoutflexsettings.php';
			
			$property=$id.'navigationhorizontal';
			if (!property_exists(NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings, $property)) NGUtil::HeaderNotFound();			
			
			$adapter = new NGDBAdapterObject ();			
			$settings = $adapter->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
			
			$css->templateFilename = 'ngpluginnavigation/ngpluginnavigationhorizontal/tpl/css.tpl';
			$css->template->assign ( 'settings', $settings );
			$css->template->assign ( 'config', NGPluginNavigationHorizontal::parseConfig($settings->$property));
			$css->template->assign ( 'target', $id);
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();