<?php

include_once './../../../../includes.php';

class renderCSS {
	function render() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot = 5;
		NGSession::getInstance ()->currentPath = 'classes/plugins/ngpluginparagraph/ngpluginparagraphguestbook/css/';
		NGDBConnector::getInstance ()->connect ();
		
		$css = new NGRenderCSS ();
		$css->cacheId = 'ngpluginguestbook';
		
		if (! $css->fetchFromCache ()) {
			include_once NGConfig::pluginsPath () . '/ngplugintypography/settings/ngplugintypographysettings.php';
			include_once NGConfig::pluginsPath () . '/ngpluginparagraph/ngpluginparagraphguestbook/settings/ngguestbooksettings.php';
			
			$c = new NGDBAdapterObject ();
			
			/* @var $typo NGPluginTypographySettings */
			$typo = $c->loadSetting ( NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings );
			
			/* @var $settings NGGuestbookSettings */
			$settings = $c->loadSetting ( NGGuestbookSettings::IdGuestbook, NGGuestbookSettings::ObjectTypeNGGuestbookSettings );
			
			$css->templateFilename = 'ngpluginparagraph/ngpluginparagraphguestbook/tpl/style.tpl';
			$css->template->assign ( 'typo', $typo );
			$css->template->assign ( 'settings', $settings );
			
			if ($settings->reply === 'custom' && $settings->replypictureuid !== '') {
				$css->template->assign ( 'replypicture', NGLink::getPictureURL ( $settings->replypictureuid, $settings->getReplyPictureSize(), $settings->getReplyPictureSize(), NGPicture::Ratio1by1 ) );
			}
			
			$css->render ();
		}
		$css->write ();
	}
}

$renderCSS = new renderCSS ();
$renderCSS->render ();