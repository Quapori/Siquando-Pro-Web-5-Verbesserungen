<?php

include_once './../../../../includes.php';

class renderCSS {
    function render() {
        NGSession::getInstance ()->user = NGUser::getUserSystem ();
        NGSession::getInstance ()->stepsToRoot=5;
        NGSession::getInstance()->currentPath='classes/plugins/ngpluginparagraph/ngpluginparagraphchat/css/';
        NGDBConnector::getInstance ()->connect ();

        $css = new NGRenderCSS ();
        $css->cacheId = 'ngpluginchat';

        if (!$css->fetchFromCache ()) {
            $adapter = new NGDBAdapterObject ();

            /* @var NGPluginTypographySettings $settingsTypo */
            $settingsTypo = $adapter->loadSetting ( NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings );

            $css->templateFilename = 'ngpluginparagraph/ngpluginparagraphchat/tpl/style.tpl';
            $css->template->assign ( 'typo', $settingsTypo );

            $font = new NGFont($settingsTypo->defaultfont);
            $css->template->assign('lineheight', floor($font->fontsize*1.1));

            $css->render ();
        }
        $css->write ();
    }
}

$renderCSS = new renderCSS ();
$renderCSS->render ();