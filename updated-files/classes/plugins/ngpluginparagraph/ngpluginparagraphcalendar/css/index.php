<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginparagraph/ngpluginparagraphcalendar/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngplugincalendar';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginparagraph/ngpluginparagraphcalendar/settings/ngcalendarsettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGPluginParagraphCalendarSettings */
			$settings = $c->loadSetting ( NGCalendarSettings::IdCalendar, NGCalendarSettings::ObjectTypeNGCalendarSettings );
						
			$css->templateFilename = 'ngpluginparagraph/ngpluginparagraphcalendar/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();