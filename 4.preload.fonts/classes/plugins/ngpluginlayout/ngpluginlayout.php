<?php

class NGPluginLayout
{

    /**
     *
     * Rendered output
     *
     * @var string
     */
    public $output = '';

    /**
     *
     * Should everything be rendered in preview mode
     *
     * @var bool
     */
    public $previewMode = false;

    /**
     *
     * Array with links to style sheets
     *
     * @var Array
     */
    public $styleSheets = array();

    /**
     *
     * Array with links to webfont files
     *
     * @var Array
     */
    public $fontfiles = array();

    /**
     *
     * Array with inline styles
     *
     * @var Array
     */
    public $styles = array();

    /**
     *
     * Array with javascript
     *
     * @var Array
     */
    public $javaScripts = array();

    /**
     *
     * Template renderer
     *
     * @var NGTemplate
     */
    public $template;

    /**
     *
     * FTS Parser
     *
     * @var NGFTS
     */
    public $fts;

    /**
     *
     * Page to be rendered
     *
     * @var NGPluginPage
     */
    public $page;

    /**
     *
     * Topic to be rendered
     *
     * @var NGTopic
     */
    public $topic;

    /**
     *
     * Page for template
     *
     * @var NGPluginPage
     */
    public $templatePage = null;

    /**
     *
     * Meta Tags
     *
     * @var Array
     */
    public $metaTags = array();

    /**
     *
     * HTMl Code
     *
     * @var Array
     */
    public $htmlCode = array();

    /**
     *
     * Database adapter
     *
     * @var NGDBAdapterObject
     */
    public $adapter;

    /**
     *
     * Sets the next time the paragraph will change
     *
     * @var string
     */
    public $nextScheduledChange = '';

    /**
     *
     * Appends or overrides metatags
     *
     * @param Array $metaTagsToAppend
     */
    public function appendMetaTags(&$metaTagsToAppend)
    {
        foreach ($metaTagsToAppend as $key => $value) {
            if ($value !== '') {
                if ($key == 'keywords') {
                    if (array_key_exists('keywords', $this->metaTags)) {
                        $this->metaTags ['keywords'] = NGUtil::joinCommaSeparatedValues($this->metaTags ['keywords'], $value);
                    } else {
                        $this->metaTags ['keywords'] = $value;
                    }
                } else {
                    $this->metaTags [$key] = $value;
                }
            }
        }
    }

    /**
     * Get the page Template
     */
    public function getTemplatePage()
    {
        /* @var NGTopic $topic */
        $topic = $this->topic;

        $topicAdapter = new NGDBAdapterObject ();

        while ($topic !== null && $topic->templateUID === NGUtil::ObjectUIDInherit) {
            $topic = $topicAdapter->loadObject($topic->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true);
        }

        if ($topic == null)
            return;

        $pageAdapter = new NGDBAdapterObject ();

        $this->templatePage = $pageAdapter->loadObject($topic->templateUID, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage, '', true, false, false, false);
    }

    public function renderParagraphStreamTemplates()
    {
        $overwriteMode = array();

        foreach ($this->templatePage->paragraphStreams as $id => $paragraphStream)
            $overwriteMode [$id] = 'o';

        $parts = explode('&', $this->topic->templateOverwrite);

        foreach ($parts as $part) {
            $keyvalue = explode('=', $part);

            if (count($keyvalue) == 2)
                $overwriteMode [$keyvalue [0]] = $keyvalue [1];
        }

        foreach ($this->page->paragraphStreams as $id => $paragraphStream) {
            /* @var $paragraphStream NGParagraphStream */

            if ($paragraphStream->isVisible) {

                if (array_key_exists($id, $this->templatePage->paragraphStreams)) {
                    /* @var $templateParagraphStream NGParagraphStream */

                    if ($overwriteMode [$id] !== 'o' || $paragraphStream->outputEmtpy) {
                        $templateParagraphStream = $this->templatePage->paragraphStreams [$id];
                        $templateParagraphStream->renderWidth = $paragraphStream->renderWidth;
                        $templateParagraphStream->responsive = $paragraphStream->responsive;
                        $templateParagraphStream->allowMobileFullWidth = $paragraphStream->allowMobileFullWidth;
                        $templateParagraphStream->allowAlwaysFullWidth = $paragraphStream->allowAlwaysFullWidth;
                        $templateParagraphStream->mobileWidth = $paragraphStream->mobileWidth;

                        $this->templatePage->renderParagraphStream($templateParagraphStream, $this->page);

                        if (!$templateParagraphStream->outputEmtpy) {
                            switch ($overwriteMode [$id]) {
                                case 'o' :
                                    $paragraphStream->output = $templateParagraphStream->output;
                                    break;
                                case 'b' :
                                    $paragraphStream->output .= $templateParagraphStream->output;
                                    break;
                                case 'a' :
                                    $paragraphStream->output = $templateParagraphStream->output . $paragraphStream->output;
                                    break;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     *
     * Appends HTMl Code
     *
     * @param Array $htmlCodeToAppend
     */
    public function appendHTMLCode(&$htmlCodeToAppend)
    {
        foreach ($htmlCodeToAppend as $key => $value) {
            if ($value !== '') {
                if (array_key_exists($key, $this->htmlCode)) {
                    $this->htmlCode [$key] = $this->htmlCode [$key] . "\r\n" . $value;
                } else {
                    $this->htmlCode [$key] = $value;
                }
            }
        }
    }

    /**
     *
     * Renders the subnav
     *
     * @param unknown_type $mode
     */
    protected function renderSubNav($mode)
    {
        $subNav = new NGPluginSubNavigation ();
        $subNav->currentPage = $this->page;
        $subNav->previewMode = $this->previewMode;
        $subNav->mode = $mode;
        $subNav->render();
        $this->template->assign('subnav', $subNav->output);

        foreach ($subNav->styleSheets as $id => $stylesheet) {
            if (!array_key_exists($id, $this->styleSheets))
                $this->styleSheets [$id] = $stylesheet;
        }
        foreach ($subNav->javaScripts as $id => $javaScript) {
            if (!array_key_exists($id, $this->javaScripts))
                $this->javaScripts [$id] = $javaScript;
        }
    }

    public function render()
    {
    }

    /**
     * Adds the includes for the current page
     */
    public function appendPageIncludes()
    {
        foreach ($this->page->styleSheets as $id => $stylesheet) {
            if (!array_key_exists($id, $this->styleSheets))
                $this->styleSheets [$id] = $stylesheet;
        }
        foreach ($this->page->styles as $id => $style) {
            if (!array_key_exists($id, $this->styles))
                $this->styles [$id] = $style;
        }
        foreach ($this->page->javaScripts as $id => $javaScript) {
            if (!array_key_exists($id, $this->javaScripts))
                $this->javaScripts [$id] = $javaScript;
        }
    }

    public function appendDefaultIncludes()
    {
        $this->javaScripts ['jquery'] = NGUtil::prependRootPath('js/jquery.js');
        $this->javaScripts ['lightbox'] = NGUtil::prependRootPath('classes/plugins/ngpluginlightbox/js/lightbox.js');
        $this->styleSheets ['lightbox'] = NGUtil::prependRootPath('classes/plugins/ngpluginlightbox/css/');
        $this->styleSheets ['main'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/css/');

        if (NGSettingsSite::getInstance()->lazyload) {
            $this->styleSheets ['lazyload'] = NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/css/style.css');
            $this->javaScripts ['lazyload'] = NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/js/lazyload.js');
        }

        if (NGSettingsSite::getInstance()->protectpictures) {
            $this->javaScripts ['protectpictures'] = NGUtil::prependRootPath('classes/plugins/ngpluginprotectpictures/js/protectpictures.js');
        }


        if (NGSettingsSite::getInstance()->cookiewarning) {
            $this->styleSheets ['cookiewarning'] = NGUtil::prependRootPath('classes/plugins/ngplugincookiewarning/css/');
            $this->javaScripts ['cookiewarning'] = NGUtil::prependRootPath('classes/plugins/ngplugincookiewarning/js/cookiewarning.js');
        }
    }

    /**
     * Append all web fonts
     */
    public function appendWebFonts()
    {
        $fontutil = NGFontUtil::getInstance();

        foreach ($fontutil->styleSheets as $styleSheet) {
            $this->styleSheets ['webfont' . $styleSheet] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/css/' . $styleSheet . '.css');
            // Beginn des neuen Codeschnipsel
            if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-regular-webfont.woff'))) {
                $this->fontfiles[$styleSheet . '-regular-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-regular-webfont.woff');
            }
            if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-italic-webfont.woff'))) {
                $this->fontfiles[$styleSheet . '-italic-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-italic-webfont.woff');
            }
            if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bold-webfont.woff'))) {
                $this->fontfiles[$styleSheet . '-bold-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bold-webfont.woff');
            }
            if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bolditalic-webfont.woff'))) {
                $this->fontfiles[$styleSheet . '-bolditalic-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bolditalic-webfont.woff');
            }
            if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-webfont.woff'))) {
                $this->fontfiles[$styleSheet . '-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-webfont.woff');
            }
            // Ende des neuen Codeschnipsel
        }
    }

    public function setDefaultVariables()
    {
        $this->template->assign('page', $this->page);
        $this->template->assign('streams', $this->page->paragraphStreams);

        // ksort($this->styleSheets);

        $this->template->assign('stylesheets', $this->styleSheets);
        $this->template->assign('javascripts', $this->javaScripts);
        $this->template->assign('styles', $this->styles);
        // neue Zeile hinzugefügt
        $this->template->assign('fontfiles', $this->fontfiles);
    }

    public function setMiscellaneous()
    {
        $this->metaTags ['generator'] = NGConfig::Generator . ' (#' . NGConfigPermissions::CustomerId . ')';
        $this->appendMetaTags(NGSettingsSite::getInstance()->metaTags);
        $this->appendMetaTags($this->topic->metaTags);
        $this->appendMetaTags($this->page->metaTags);
        $this->template->assign('metatags', $this->metaTags);
        $this->template->assign('deferjs', NGSettingsSite::getInstance()->deferjs);
        $this->template->assign('title', str_replace('[t]', $this->page->displayTitle(), NGSettingsSite::getInstance()->title));
        $this->appendHTMLCode(NGSettingsSite::getInstance()->htmlCode);
        $this->appendHTMLCode($this->topic->htmlCode);
        $this->appendHTMLCode($this->page->htmlCode);
        $this->template->assign('htmlcode', $this->htmlCode);

        $this->template->assign('googleanalytics', NGSettingsSite::getInstance()->googleAnalytics);
        $this->template->assign('googleanalyticsanonip', NGSettingsSite::getInstance()->googleAnalyticsAnonIp);

        if (NGSettingsSite::getInstance()->canonical !== '') {
            if (NGConfig::VanityURLs) {

                $controller = new NGDBAdapterObject ();
                $pages = $controller->loadChildObjects($this->topic->objectUID, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage, '');

                $indexPage = null;

                foreach ($pages as $page) {
                    if ($indexPage === null) {
                        $indexPage = $page;
                    } else {
                        if ($page->objectUID == $this->topic->indexUID)
                            $indexPage = $page;
                    }
                }

                if ($indexPage !== null && $this->page->objectUID === $indexPage->objectUID) {
                    if ($this->topic->objectUID === NGUtil::ObjectUIDRootHome) {
                        $this->template->assign('canonical', NGSettingsSite::getInstance()->canonical);
                    } else {
                        $this->template->assign('canonical', NGSettingsSite::getInstance()->canonical . NGLink::getVanityURL($this->topic->objectUID));
                    }
                } else {
                    $this->template->assign('canonical', NGSettingsSite::getInstance()->canonical . NGLink::getVanityURL($this->page->objectUID));
                }
            } else {
                $this->template->assign('canonical', NGSettingsSite::getInstance()->canonical . '?p=' . $this->page->objectUID);
            }
        }

        if (NGSettingsSite::getInstance()->favicon !== '') {
            $this->template->assign('favicon', NGLink::getPictureURL(NGSettingsSite::getInstance()->favicon, 16, 16, NGPicture::Ratio1by1));
            $this->template->assign('favicon2x', NGLink::getPictureURL(NGSettingsSite::getInstance()->favicon, 32, 32, NGPicture::Ratio1by1));
        }
        if (NGSettingsSite::getInstance()->touchicon !== '') {
            $touchicons = array();
            $touchicons ['152x152'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 152, 152, NGPicture::Ratio1by1);
            $touchicons ['167x167'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 167, 167, NGPicture::Ratio1by1);
            $touchicons [''] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 180, 180, NGPicture::Ratio1by1);
            $this->template->assign('touchicons', $touchicons);
            $this->template->assign('touchiconprecomposed', NGSettingsSite::getInstance()->touchiconprecomposed);
            $this->template->assign('androidicon', NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 192, 192, NGPicture::Ratio1by1));
        }

        NGSession::getInstance()->getNavContent();

        $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, NGSession::getInstance()->navigation->nextVisibiltyChange);

        if (!$this->previewMode) {
            if (array_key_exists('mp3', $this->topic->linkedmedia)) {
                $mp3download = $this->adapter->loadObject($this->topic->linkedmedia ['mp3'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($mp3download !== null) {
                    $this->template->assign('topicmp3', NGUtil::prependStorePath($mp3download->pathToFile()));
                }
            }

            if (array_key_exists('ogg', $this->topic->linkedmedia)) {
                $oggdownload = $this->adapter->loadObject($this->topic->linkedmedia ['ogg'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($oggdownload !== null) {
                    $this->template->assign('topicogg', NGUtil::prependStorePath($oggdownload->pathToFile()));
                }
            }
        }

        if (NGSettingsSite::getInstance()->showcookiewarning) {
            $richttext = new NGRichText ();
            $richttext->previewMode = $this->previewMode;
            $this->template->assign('cookiewarning', $richttext->parse(NGSettingsSite::getInstance()->cookiewarning));
            $this->template->assign('cookiewarningtop', NGSettingsSite::getInstance()->cookiewarningtop);
        }
    }

    public function setSearch()
    {
        $pages = $this->adapter->loadSetting(NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages);
        if (array_key_exists('search', $pages->pageuids)) {
            $seachlink = new NGLink ();
            $seachlink->linkType = NGLink::LinkPage;
            $seachlink->previewMode = $this->previewMode;
            $seachlink->uid = $pages->pageuids ['search'];
            $this->template->assign('search', $seachlink->getURL());
        } else {
            $this->template->assign('search', '');
        }
        $langSearch = new NGLanguageAdapter ();
        $langSearch->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphsearch/language/langsearch.xml';
        $langSearch->load();
        $this->template->assign('langsearch', $langSearch->languageResources);
    }

    public function prepareFTS()
    {

        if (!$this->previewMode && !$this->page->dontCache) {
            $this->fts->objectUID = $this->page->objectUID;

            if ($this->page->fts) {
                $this->fts->data = $this->page->ftsData;
                $this->fts->meta = $this->page->caption . ' ' . implode(' ', $this->metaTags);
            } else {
                $this->fts->data = '';
                $this->fts->meta = '';
            }

            $this->fts->store();
        }
    }

    public function __construct()
    {
        $this->template = new NGTemplate ();
        $this->fts = new NGFTS ();
        $this->adapter = new NGDBAdapterObject ();
    }

    /**
     *
     * Convenience constructor
     *
     * @param string $pluginName
     * @return NGPluginLayout
     */
    public static function create($pluginName)
    {
        $filename = strtolower($pluginName);
        include_once NGConfig::pluginsPath() . sprintf('/ngpluginlayout/%s/%s.php', $filename, $filename);

        $settingsfilename = NGConfig::pluginsPath() . sprintf('/ngpluginlayout/%s/settings/%ssettings.php', $filename, $filename);
        if (is_file($settingsfilename))
            include_once($settingsfilename);

        return new $pluginName ();
    }
}
