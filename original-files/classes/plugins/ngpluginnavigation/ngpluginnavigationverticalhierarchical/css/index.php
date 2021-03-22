<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		$id=NGUtil::get('id','nav');
						
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginnavigation/ngpluginnavigationverticalhierarchical/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'navverticalh'.$id;
				
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginnavigation/ngpluginnavigationverticalhierarchical/ngpluginnavigationverticalhierarchical.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/settings/ngpluginlayoutflexsettings.php';
			
			$property=$id.'navigationvertical';
			if (!property_exists(NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings, $property)) NGUtil::HeaderNotFound();			
			
			$adapter = new NGDBAdapterObject ();			
			$settings = $adapter->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
			
			$css->templateFilename = 'ngpluginnavigation/ngpluginnavigationverticalhierarchical/tpl/css.tpl';
			$css->template->assign ( 'settings', $settings );
			$css->template->assign ( 'config', NGPluginNavigationVerticalHierarchical::parseConfig($settings->$property));
			$css->template->assign ( 'target', $id);
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();