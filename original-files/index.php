<?php
include_once './classes/includes.php';

NGSession::getInstance ()->stepsToRoot = 0;
NGSession::getInstance ()->currentPath = '.';

NGSession::getInstance ()->user = NGUser::getUserSystem ();
NGDBConnector::getInstance ()->connect ();

$renderPage = new NGRenderPage ();

$renderPage->pageUID = NGUtil::get ( 'ngp', '' );
$renderPage->topicUID = NGUtil::get ( 'ngt', '' );
$renderPage->url = NGUtil::get ( 'ngq', '' );

if (NGUtil::isMobile ()) {
	$renderPage->layout = 'NGPluginLayoutPhone';
} else if (NGUtil::isPlain ()) {
	$renderPage->layout = 'NGPluginLayoutPlain';
} else {
	
	$settingsController = new NGDBAdapterObject ();
	/* @var $settingsLayoutStyle NGSettingsLayoutStyle */
	$settingsLayoutStyle = $settingsController->loadSetting ( NGSettingsLayoutStyle::IdLayoutStyle, NGSettingsLayoutStyle::ObjectTypeSettingsLayoutStyle );
	$renderPage->layout=$settingsLayoutStyle->layouttype;	
} 


$renderPage->previewMode = (NGUtil::get ( 'ngm', '' ) == 'p') ? true : false;

$renderPage->render ();