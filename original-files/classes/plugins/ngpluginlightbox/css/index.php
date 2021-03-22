<?php
include_once './../../../includes.php';

class renderCSS
{
    function render()
    {
        NGSession::getInstance()->user = NGUser::getUserSystem();
        NGSession::getInstance()->stepsToRoot = 4;
        NGSession::getInstance()->currentPath = 'classes/plugins/ngpluginlightbox/css/';
        NGDBConnector::getInstance()->connect();

        $css = new NGRenderCSS ();
        $css->cacheId = 'ngpluginlightbox';

        if (!$css->fetchFromCache()) {
            include_once NGConfig::pluginsPath() . '/ngpluginlightbox/settings/ngpluginlightboxsettings.php';

            $c = new NGDBAdapterObject ();

            /* @var $settings NGPluginLightboxSettings */
            $settings = $c->loadSetting(NGPluginLightboxSettings::IdLightbox, NGPluginLightboxSettings::ObjectTypeNGPluginLightboxSettings);

            /* @var $settings NGPluginTypographySettings */
            $typographySettings = $c->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);


            $css->templateFilename = 'ngpluginlightbox/tpl/style.tpl';
            $css->template->assign('settings', $settings);
            $css->template->assign('typographysettings', $typographySettings);

            if (substr($settings->style, -4) == '.svg') {
                $css->template->assign('closer', sprintf('img/?f=%s&c=%s', substr($settings->style, 0, -4), $settings->colorcloser));
            } else {
                $css->template->assign('closer', $settings->style . '.png');
            }
            if (substr($settings->navstyle, -4) == '.svg') {
                $css->template->assign('next', sprintf('img/?f=%s_next&c=%s', substr($settings->navstyle, 0, -4), $settings->colornav));
                $css->template->assign('prev', sprintf('img/?f=%s_prev&c=%s', substr($settings->navstyle, 0, -4), $settings->colornav));
            } else {
                $css->template->assign('next', $settings->navstyle . '_next.png');
                $css->template->assign('prev', $settings->navstyle . '_prev.png');
            }

            $css->render();
        }
        $css->write();
    }
}

$renderCSS = new renderCSS ();
$renderCSS->render();