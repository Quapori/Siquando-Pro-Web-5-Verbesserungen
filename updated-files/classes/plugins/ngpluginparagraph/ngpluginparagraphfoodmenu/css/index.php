<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginparagraph/ngpluginparagraphfoodmenu/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginfoodmenu';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginparagraph/ngpluginparagraphfoodmenu/settings/ngfoodmenusettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginParagraphFoodMenuSettings */
			$settings = $c->loadSetting ( NGFoodMenuSettings::IdFoodMenu, NGFoodMenuSettings::ObjectTypeNGFoodMenuSettings );
						
			$css->templateFilename = 'ngpluginparagraph/ngpluginparagraphfoodmenu/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();