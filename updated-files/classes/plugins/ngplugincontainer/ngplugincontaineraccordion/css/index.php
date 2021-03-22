<?php
include_once './../../../../includes.php';

$session = NGSession::getInstance ();
$session->user = NGUser::getUserSystem ();
NGDBConnector::getInstance ()->connect ();

$dbAdapter = new NGDBAdapterObject ();

/* @var $settings NGSettingsAccordion */
$settings = $dbAdapter->loadSetting ( NGSettingsAccordion::IdAccordion, NGSettingsAccordion::ObjectTypeSettingsAccordion );

$css = new NGRenderCSS ();
$css->templateFilename = 'ngplugincontainer/ngplugincontaineraccordion/tpl/css.tpl';
$css->template->assign ( 'uid', 'default' );
$css->template->assign ( 'linewidth', $settings->widthLine );
$css->template->assign ( 'linecolor', $settings->colorLine );
if (substr ( $settings->styleUID, - 4 ) == '.svg') {
	$css->template->assign ( 'closed', '../styles/img/?f=' . substr ( $settings->styleUID, 0, - 4 ) . '_closed&c=' . $settings->colorIcon );
	$css->template->assign ( 'open', '../styles/img/?f=' . substr ( $settings->styleUID, 0, - 4 ) . '_open&c=' . $settings->colorIcon );
} else {
	$css->template->assign ( 'closed', './../styles/' . $settings->styleUID . '_closed.png' );
	$css->template->assign ( 'open', './../styles/' . $settings->styleUID . '_open.png' );
}
$css->render ();
$css->write ();