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
			include_once NGConfig::pluginsPath () . '/ngplugineyecatcher/ngplugineyecatchergallery/ngplugineyecatchergallery.php';
			include_once NGConfig::pluginsPath () . '/ngpluginlayout/ngpluginlayoutflex/settings/ngpluginlayoutflexsettings.php';
			
			$property=$id.'eyecatcher';
			if (!property_exists(NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings, $property)) NGUtil::HeaderNotFound();			
			
			$adapter = new NGDBAdapterObject ();	

			/* @var $settings NGPluginLayoutFlexSettings */
			$settings = $adapter->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
			
			$css->templateFilename = 'ngplugineyecatcher/ngplugineyecatchergallery/tpl/css.tpl';
			
			$eyecatcher=new NGPluginEyecatcherGallery();
			
			$config=NGPluginEyecatcherGallery::parseConfig($settings->$property);
			
			$ratioType = NGPicture::stringToRatio($config [1]);
			$ratio = NGPicture::ratioByRatioType($ratioType);
			
			$css->template->assign ( 'id', $id );
			
			$width= $settings->width-$settings->eyecatcherExtraWidth();
			$height =round($width/$ratio);
			
			$css->template->assign('width',$width);
			$css->template->assign('height',$height);
			$css->template->assign('bulletsposition', strtolower($config[5]));
			$css->template->assign('color', $config[6]);
			$css->template->assign('colorhover', $config[7]);
			$css->template->assign('colorselected', $config[8]);
			
			
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();