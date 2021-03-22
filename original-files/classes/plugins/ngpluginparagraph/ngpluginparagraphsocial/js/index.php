<?php

include_once './../../../../includes.php';

class renderCSS
{
    function render()
    {
        NGSession::getInstance()->user = NGUser::getUserSystem();
        NGSession::getInstance()->stepsToRoot = 5;
        NGSession::getInstance()->currentPath = 'classes/plugins/ngpluginnavigation/ngpluginnavigationdropdown/css/';
        NGDBConnector::getInstance()->connect();

        $css = new NGRenderCSS ();
        $css->disablecompression = true;
        $css->cacheId = 'ngpluginsocial';

        if (!$css->fetchFromCache()) {
            $lang = new NGLanguageAdapter();
            $lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphsocial/language/langsocial.xml';
            $lang->load();

            $css->templateFilename = 'ngpluginparagraph/ngpluginparagraphsocial/tpl/js.tpl';
            $css->template->assign('lang', $lang->languageResources);

            $css->render();
        }
        $css->writeContentType('text/javascript');
    }
}

$renderCSS = new renderCSS ();
$renderCSS->render();