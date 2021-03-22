<?php

include_once './../../../../includes.php';

class renderCSS {
    function render() {
        NGSession::getInstance ()->user = NGUser::getUserSystem ();
        NGSession::getInstance ()->stepsToRoot=5;
        NGSession::getInstance()->currentPath='classes/plugins/ngpluginparagraph/ngpluginparagraphproslider/css/';
        NGDBConnector::getInstance ()->connect ();

        $css = new NGRenderCSS ();
        $css->cacheId = 'ngpluginproslider';

        if (!$css->fetchFromCache ()) {
            include_once NGConfig::pluginsPath () . '/ngplugintypography/settings/ngplugintypographysettings.php';

            $c = new NGDBAdapterObject ();

            /* @var $settings NGPluginTypographySettings */
            $settings = $c->loadSetting ( NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings );

            $css->templateFilename = 'ngpluginparagraph/ngpluginparagraphproslider/tpl/style.tpl';
            $css->template->assign ( 'settings', $settings );

            $css->render ();
        }
        $css->write ();
    }
}

$renderCSS = new renderCSS ();
$renderCSS->render ();