<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot=5;
		NGSession::getInstance()->currentPath='classes/plugins/ngpluginparagraph/ngpluginparagraphconsent/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginconsent';
		
		if (!$css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngpluginparagraph/ngpluginparagraphconsent/settings/ngconsentsettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $settings NGConsentSettings */
			$settings = $c->loadSetting ( NGconsentSettings::IdConsent, NGConsentSettings::ObjectTypeNGConsentSettings );

            /* @var $settingsTypo NGPluginTypographySettings */
            $settingsTypo = $c->loadSetting ( NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings );

			$css->templateFilename = 'ngpluginparagraph/ngpluginparagraphconsent/tpl/style.tpl';
			$css->template->assign ( 'settings', $settings );
            $css->template->assign ( 'settingstypo', $settingsTypo );


						
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();