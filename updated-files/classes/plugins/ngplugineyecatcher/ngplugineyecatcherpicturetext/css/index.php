<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		$id=NGUtil::get('id','eyecatcher');
						
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginnavigation/ngpluginnavigationhorizontal/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'eyecatcherpictext'.$id;
				
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngplugineyecatcher/ngplugineyecatcherpicturetext/ngplugineyecatcherpicturetext.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/settings/ngpluginlayoutflexsettings.php';
			
			$property=$id.'eyecatcher';
			if (!property_exists(NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings, $property)) NGUtil::HeaderNotFound();			
			
			$adapter = new NGDBAdapterObject ();			
			$settings = $adapter->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
			
			$css->templateFilename = 'ngplugineyecatcher/ngplugineyecatcherpicturetext/tpl/css.tpl';
			
			$eyecatcher=new NGPluginEyecatcherPictureText();
			
			$config=NGPluginEyecatcherPictureText::parseConfig($settings->$property);
			
			$css->template->assign('items',$eyecatcher->getItems(NGUtil::unescapeComma ($config[4]), true));
			$css->template->assign ( 'id', $id );
			
					
			
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();