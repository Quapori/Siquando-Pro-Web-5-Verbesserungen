<?php

include_once './../../../../includes.php';

$session = NGSession::getInstance();
$session->user = NGUser::getUserSystem();
NGDBConnector::getInstance()->connect();

$dbAdapter = new NGDBAdapterObject();

/* @var $settings NGSettingsTabs */
$settings = $dbAdapter->loadSetting(NGSettingsTabs::IdTabs, NGSettingsTabs::ObjectTypeSettingsTabs);

$css = new NGRenderCSS();
$css->cacheId = 'ngplugincontainertab';
$css->templateFilename = 'ngplugincontainer/ngplugincontainertab/tpl/css.tpl';
$css->template->assign('uid', 'default');
$css->template->assign('border', '#' . $settings->colorBorder);
$css->template->assign('borderhover', '#' . ($settings->colorBorderHover === '' ? $settings->colorBorder : $settings->colorBorderHover));
$css->template->assign('borderactive', '#' . ($settings->colorBorderActive === '' ? $settings->colorBorder : $settings->colorBorderActive));
$css->template->assign('background', '#' . $settings->colorBackground);
$css->template->assign('backgroundactive', '#' . ($settings->colorBackgroundActive === '' ? $settings->colorBackground : $settings->colorBackgroundActive));
$css->template->assign('backgroundhover', '#' . ($settings->colorBackgroundHover === '' ? $settings->colorBackground : $settings->colorBackgroundHover));
$css->template->assign('text', '#' . $settings->colorText);
$css->template->assign('textactive', '#' . ($settings->colorTextActive === '' ? $settings->colorText : $settings->colorTextActive));
$css->template->assign('texthover', '#' . ($settings->colorTextHover === '' ? $settings->colorText : $settings->colorTextHover));
$css->template->assign('roundedcorners', $settings->roundedCorners);
$css->template->assign('tabborder', $settings->tabBorder);
$css->template->assign('paddingvertical', $settings->paddingvertical);
$css->template->assign('paddinghorizontal', $settings->paddinghorizontal);
$css->render();
$css->write();