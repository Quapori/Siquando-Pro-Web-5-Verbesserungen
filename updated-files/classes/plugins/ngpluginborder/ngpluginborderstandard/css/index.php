<?php

include_once './../../../../includes.php';

$session = NGSession::getInstance ();
$session->user = NGUser::getUserSystem ();
$session->stepsToRoot=5;
NGDBConnector::getInstance ()->connect ();

$css = new NGRenderCSS ();
$css->cacheId = 'ngpluginborderstandard';

if (! $css->fetchFromCache ()) {
	$dbAdapter = new NGDBAdapterObject ();
	/* @var $settings NGSettingsAccordion */
	$settings = $dbAdapter->loadSetting ( NGPluginBorderStandardSettings::IdBorder, NGPluginBorderStandardSettings::ObjectTypeBorderSettings );
	$css->templateFilename = 'ngpluginborder/ngpluginborderstandard/tpl/css.tpl';
	$css->template->assign ( 'settings', $settings );
	$css->template->assign ( 'uid', 'default' );
	$css->render ();
}

$css->write ();