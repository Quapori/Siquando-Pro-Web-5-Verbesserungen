<?php

include_once './../../../../includes.php';

$session = NGSession::getInstance();
$session->user = NGUser::getUserSystem();
NGDBConnector::getInstance()->connect();

$dbAdapter = new NGDBAdapterObject();

/* @var $settings NGSettingsFAQ */
$settings = $dbAdapter->loadSetting(NGSettingsFAQ::IdFAQ, NGSettingsFAQ::ObjectTypeSettingsFAQ);

/* @var $settingsTypo NGPluginTypographySettings */
$settingsTypo =  $dbAdapter->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);

$css = new NGRenderCSS();
$css->cacheId = 'ngplugincontainerfaq';
$css->templateFilename = 'ngplugincontainer/ngplugincontainerfaq/tpl/css.tpl';
$css->template->assign('uid', 'default');
$css->template->assign('border', '#' . $settings->colorBorder);
$css->template->assign('borderhover', '#' . ($settings->colorBorderHover === '' ? $settings->colorBorder : $settings->colorBorderHover));
$css->template->assign('borderactive', '#' . ($settings->colorBorderActive === '' ? $settings->colorBorder : $settings->colorBorderActive));
$css->template->assign('text', '#' . $settings->colorText);
$css->template->assign('textactive', '#' . ($settings->colorTextActive === '' ? $settings->colorText : $settings->colorTextActive));
$css->template->assign('texthover', '#' . ($settings->colorTextHover === '' ? $settings->colorText : $settings->colorTextHover));
$css->template->assign('paddingvertical', $settings->paddingvertical);
$css->template->assign('paddinghorizontal', $settings->paddinghorizontal);
$css->template->assign('lineheight', $settingsTypo->defaultlineheight/100);
$css->render();
$css->write();