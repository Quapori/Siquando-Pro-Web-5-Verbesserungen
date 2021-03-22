<?php

class NGPluginLayoutFlexR extends NGPluginLayout
{

    /**
     *
     * @var NGPluginLayoutFlexRSettings
     */
    private $settings;

    /**
     *
     * @var NGRichText
     */
    private $richtext;

    /**
     *
     * @var NGRenderNavigation
     */
    private $navigation;

    /**
     *
     * Calculate the width of an element
     *
     * @param string $paddingData
     * @return int
     */
    private function elementWidth($paddingData)
    {
        $padding = new NGMargin ($paddingData);

        return max($this->settings->mobilewidth, $this->settings->width - $padding->totalWidth());
    }

    public function render()
    {
        $this->appendDefaultIncludes();

        $this->styleSheets ['layout'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/ngpluginlayoutflexr/css/');

        $this->page->previewMode = $this->previewMode;

        $this->page->prepare();

        $this->topic = $this->adapter->loadObject($this->page->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true);

        $this->getTemplatePage();

        if ($this->templatePage !== null) {
            $this->templatePage->previewMode = $this->previewMode;
            $this->templatePage->prepare();
        }

        $this->settings = $this->adapter->loadSetting(NGPluginLayoutFlexRSettings::IdLayoutFlexR, NGPluginLayoutFlexRSettings::ObjectTypePluginLayoutFlexRSettings);

        $this->template->assign('lang', NGSession::getInstance()->getLanguageRessource(NGUtil::LanguageResourcesMain));
        $this->template->assign('settings', $this->settings);
        $this->template->assign('previewmode', $this->previewMode);
        $this->template->assign('htmlclass', 'sqr');
        $this->template->assign('viewport', 'width=device-width, initial-scale=1.0');

        if (!$this->settings->leftvisible)
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible = false;
        if (!$this->settings->rightvisible)
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible = false;
        if (!$this->settings->footervisible)
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->isVisible = false;
        if (!$this->settings->headervisible)
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->isVisible = false;

        foreach ($this->page->paragraphStreams as $paragraphStream) {
            /* @var $paragraphStream NGParagraphStream */
            $paragraphStream->responsive = true;
            $paragraphStream->allowMobileFullWidth = true;
            $paragraphStream->mobileWidth = $this->settings->mobilewidth;
        }

        $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
        $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $this->elementWidth($this->settings->headerpadding);
        $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
        $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $this->elementWidth($this->settings->footerpadding);

        $colcount = 1;

        if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
            $colcount++;
        if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
            $colcount++;
        if ($colcount == 1)
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = true;

        $this->template->assign('cols', $colcount);

        if ($this->settings->mainsidebarmode === 'equal' || $colcount === 1) {
            $renderWidthColumn = max(ceil($this->settings->width / $colcount), $this->settings->mobilewidth);
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil($renderWidthColumn);
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil($renderWidthColumn);
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil($renderWidthColumn);
            $this->template->assign('mainstyle', 'sqrmain' . $colcount . 'col');
        } else {

            $sidebarWidth = 0.25;

            if ($this->settings->mainsidebarmode === 'small')
                $sidebarWidth = 0.20;
            if ($this->settings->mainsidebarmode === 'large')
                $sidebarWidth = 0.30;

            if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->template->assign('mainstyle', 'sqrmain3collr');
                $renderWidthLeft = ceil($this->settings->width * $sidebarWidth);
                $renderWidthRight = ceil($this->settings->width * $sidebarWidth);
            } else if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && !$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->template->assign('mainstyle', 'sqrmain2coll');
                $renderWidthLeft = ceil($this->settings->width * $sidebarWidth);
                $renderWidthRight = 0;
            } else if (!$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->template->assign('mainstyle', 'sqrmain2colr');
                $renderWidthLeft = 0;
                $renderWidthRight = ceil($this->settings->width * $sidebarWidth);
            }

            $renderWidthContent = $this->settings->width - $renderWidthLeft - $renderWidthRight;

            if ($renderWidthLeft < $this->settings->mobilewidth)
                $renderWidthLeft = $this->settings->mobilewidth;
            if ($renderWidthRight < $this->settings->mobilewidth)
                $renderWidthRight = $this->settings->mobilewidth;
            if ($renderWidthContent < $this->settings->mobilewidth)
                $renderWidthContent = $this->settings->mobilewidth;

            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil($renderWidthContent);
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil($renderWidthLeft);
            $this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil($renderWidthRight);
        }

        if ($this->settings->eyecatchervisible) {

            $topic = $this->topic;

            if ($this->settings->eyecatcherinheritance) {
                while ($topic->bouquetitemssource === NGBouquet::ItemsSourceManual && $topic->bouquetitems === '' && $topic->parentUID != NGUtil::ObjectUIDRootContent) {
                    $topic = $this->adapter->loadObject($topic->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);
                }
            }

            $bouquet = new NGBouquet ();
            $bouquet->itemSource = $topic->bouquetitemssource;
            $bouquet->sortMode = $topic->bouqetsortmode;
            $bouquet->itemsXML = $topic->bouquetitems;
            $bouquet->parentUID = $topic->bouquetparentuid;
            $bouquet->previewMode = $this->previewMode;
            $bouquet->prepare();

            $pictures = Array();

            if (!$this->topic->hideeyecatcher) {

                $renderWidthEyecatcher = 1920;

                if (!$this->settings->eyecatcherpanorama)
                    $renderWidthEyecatcher = $this->settings->width;

                if ($renderWidthEyecatcher < $this->settings->mobilewidth)
                    $renderWidthEyecatcher = $this->settings->mobilewidth;

                foreach ($bouquet->items as $item) {
                    /* @var $item NGBouquetItem */
                    $pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, $renderWidthEyecatcher, -1, NGPicture::Ratio16by9);
                }

                if ((count($pictures) === 0) && $this->settings->eyecatcherinheritance && $this->settings->eyecatcherpicture !== '') {
                    $pictures [] = NGLink::getPictureURL($this->settings->eyecatcherpicture, $renderWidthEyecatcher, -1, NGPicture::Ratio16by9);
                }

                if (array_key_exists('h264', $this->topic->linkedmedia)) {
                    $h264download = $this->adapter->loadObject($this->topic->linkedmedia ['h264'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                    if ($h264download !== null) {
                        $this->template->assign('topich264', NGUtil::prependStorePath($h264download->pathToFile()));
                    }
                }

                if (array_key_exists('ogv', $this->topic->linkedmedia)) {
                    $ogvdownload = $this->adapter->loadObject($this->topic->linkedmedia ['ogv'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                    if ($ogvdownload !== null) {
                        $this->template->assign('topicogv', NGUtil::prependStorePath($ogvdownload->pathToFile()));
                    }
                }
                if (array_key_exists('webm', $this->topic->linkedmedia)) {
                    $webmdownload = $this->adapter->loadObject($this->topic->linkedmedia ['webm'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                    if ($webmdownload !== null) {
                        $this->template->assign('topicwebm', NGUtil::prependStorePath($webmdownload->pathToFile()));
                    }
                }

                if (array_key_exists('poster', $this->topic->linkedmedia)) {
                    $this->template->assign('poster', NGLink::getPictureURL($this->topic->linkedmedia ['poster'], 1920, 1080, NGPicture::RatioNone));
                }
            }

            $this->template->assign('pictures', $pictures);

        }

        if ($this->settings->logovisible) {
            $this->createImage($this->settings->logologo, 'logologo', $this->settings->logowidth);
        }

        if ($this->settings->commonvisible) {
            $this->richtext = new NGRichText ();
            $this->richtext->previewMode = $this->previewMode;
            $this->template->assign('commonhtml', $this->richtext->parse($this->settings->commonhtml));

            if ($this->settings->commonshowfolders)
                $this->createCommonNavHierarchical();

            if ($this->settings->commonshowpages || $this->settings->commontopvisible)
                $this->createCommonNav();
        }

        if ($this->settings->navvisible) {

            $this->navigation = new NGRenderNavigation ();
            $this->navigation->previewMode = $this->previewMode;
            $this->navigation->useSpan = true;
            $this->navigation->classHome = 'sqrnavhome';

            $home = NGSession::getInstance()->getNavRootHome();
            if ($this->settings->navmarkactive) {
                $activeTopic = $home->findByUID($this->page->parentUID);
                $activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
            } else {
                $activeTopicUid = '';
            }

            if (NGConfig::IsShop) {
                /* @var $standardTopics NGSettingsStandardTopics */
                $standardTopics = $this->adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
                if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                    $this->navigation->uidCartIndicator = $standardTopics->topicuids['shopcartindicator'];
                    $this->template->assign('cartindicator', $standardTopics->topicuids['shopcartindicator']);
                    $this->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->previewMode ? '?ngm=p' : ''));
                }

                /* @var $standardPages NGSettingsStandardPages */
                $standardPages = $this->adapter->loadSetting(NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages);

                if ($standardPages !== null) {
                    $link = new NGLink ();
                    $link->linkType = NGLink::LinkPage;
                    $link->previewMode = $this->previewMode;

                    if ($this->settings->navstyleaccount !== 'none' && array_key_exists('shopaccount', $standardPages->pageuids)) {
                        /* @var $pageaccount NGPluginPageDefault */
                        $pageaccount = $this->adapter->loadObject($standardPages->pageuids ['shopaccount'], NGPluginPageDefault::ObjectTypePluginPage, NGPluginPageDefault::ObjectTypePluginPage);

                        if ($pageaccount !== null) {
                            $link->uid = $standardPages->pageuids ['shopaccount'];
                            $this->template->assign('accountlink', $link->getURL());
                            $this->template->assign('accountcaption', $pageaccount->caption);
                        }
                    }
                    if ($this->settings->navstylecart !== 'none' && array_key_exists('shopcart', $standardPages->pageuids)) {
                        /* @var $pageaccount NGPluginPageDefault */
                        $pagecart = $this->adapter->loadObject($standardPages->pageuids ['shopcart'], NGPluginPageDefault::ObjectTypePluginPage, NGPluginPageDefault::ObjectTypePluginPage);

                        if ($pagecart !== null) {
                            $link->uid = $standardPages->pageuids ['shopcart'];
                            $this->template->assign('cartlink', $link->getURL());
                            $this->template->assign('cartcaption', $pagecart->caption);
                        }
                    }
                }
            }

            if ($this->settings->navsuper) {
                $this->template->assign('topicuid', $activeTopicUid);
                $this->template->assign('previewMode', $this->previewMode);
                if ($this->settings->navpicturespri !== 'Hidden') $this->template->assign('cropratio1', NGPicture::stringToRatio($this->settings->navpicturespri));
                if ($this->settings->navpicturessec !== 'Hidden') $this->template->assign('cropratio2', NGPicture::stringToRatio($this->settings->navpicturessec));
                if ($this->settings->navpicturester !== 'Hidden') $this->template->assign('cropratio3', NGPicture::stringToRatio($this->settings->navpicturester));
                $icon = new NGPluginIcon();
                $icon->class = 'sqpnavicon';
                $this->template->assign('icon', $icon);

                $picturePadding = new NGMargin($this->settings->navpaddingsec);

                $picturewidth = ceil(($this->settings->width - $this->settings->navcolumns * $picturePadding->getLeft() - $picturePadding->getRight()) / $this->settings->navcolumns);
                $picturewidthmobile = ceil(($this->settings->mobilewidth - 2 * $picturePadding->getLeft() - $picturePadding->getRight()) / 2);

                $this->template->assign('picturewidth', max($picturewidth, $picturewidthmobile));



            } else {
                $nav = $this->navigation->renderList($home, 3, $this->settings->navincludehome, $activeTopicUid);
                $this->template->assign('nav', $nav);
            }
            $this->template->assign('home', $home);
            $this->template->assign('animate', NGUtil::boolToStringXML($this->settings->navanimate));
            $this->template->assign('homelink', NGLink::getLinkToHome($this->previewMode));
        }
        if ($this->settings->navshowsearch) {
            $this->setSearch();
        } else {
            $this->template->assign('search', '');
        }

        if ($this->settings->breadcrumbs) {
            $this->template->assign('breadcrumbs', NGRenderBreadcrumbs::render($this->page->parentUID, $this->previewMode));
        }

        $this->createImage($this->settings->navlogo, 'navlogo', -1, $this->settings->navheightpri());

        $this->javaScripts ['flexrslider'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/ngpluginlayoutflexr/js/slider.js');

        if ($this->settings->navsuper) {
            $this->javaScripts ['flexrsuper'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/ngpluginlayoutflexr/js/super.js');
        } else {
            $this->javaScripts ['flexrdropdown'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/ngpluginlayoutflexr/js/dropdown.js');
        }

        $this->page->render();

        if ($this->templatePage !== null) {
            $this->renderParagraphStreamTemplates();
        }

        $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $this->page->nextScheduledChange);

        $this->appendPageIncludes();

        $this->setMiscellaneous();

        $this->registerFont($this->settings->commontext);
        $this->registerFont($this->settings->navfontpri);
        $this->registerFont($this->settings->navfontsec);
        $this->registerFont($this->settings->navfontsearch);
        $this->registerFont($this->settings->commontoppages);
        $this->registerFont($this->settings->commonpages);
        $this->registerFont($this->settings->commonfolders);

        $this->appendWebFonts();

        $this->setDefaultVariables();

        $this->output = $this->template->fetchPluginTemplate('ngpluginlayout/ngpluginlayoutflexr/tpl/layout.tpl');

        if (NGSettingsSite::getInstance()->compress) $this->output = NGUtil::compressHTML($this->output);

        $this->prepareFTS();
    }

    /**
     *
     * Create an image
     *
     * @param string $id
     * @param string $width
     * @param string $height
     * @param string $ratio
     */
    private function createImage($uid, $id, $width = -1, $height = -1, $ratio = NGPicture::RatioNone)
    {
        if ($uid !== '') {

            /* @var $picture NGPicture */
            $picture = $this->adapter->loadObject($uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

            if ($picture != null) {

                $size = $picture->getResizedSize($width, $height, $ratio);

                $this->template->assign($id . 'source', NGLink::getPictureURL($uid, $size->width, $size->height, $ratio));

                if (NGSettingsSite::getInstance()->hdpictures) {
                    $this->template->assign($id . 'sourcehd', NGLink::getPictureURL($uid, $size->width * 2, $size->height * 2, $ratio));
                }

                $this->template->assign($id . 'width', $size->width);
                $this->template->assign($id . 'height', $size->height);
            }
        }
    }

    private function registerFont($setting)
    {
        $font = new NGFont ($setting);
        NGFontUtil::getInstance()->getFontStack($font->fontfamily);
    }

    public function createCommonNav()
    {
        try {

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $this->adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
            if (!array_key_exists('common', $standardTopics->topicuids))
                return false;

            $childs = $this->adapter->loadChildObjects($standardTopics->topicuids ['common'], NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage);

            $topic = $this->adapter->loadObject($standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);

            $childs = NGUtil::sortItems($childs, $topic->sortManualPages);

            $items = Array();

            foreach ($childs as $child) {
                /* @var $child NGPluginPage */
                if ($child->isVisible()) {
                    $link = new NGLink ($this->previewMode);
                    $link->uid = $child->objectUID;
                    $link->linkType = NGLink::LinkPage;
                    $items [] = new NGCommonPage ($child->caption, $link->getURL());
                }
                $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $child->nextVisibilityChange());
            }

            $this->template->assign('commonnav', $items);
        } catch (Exception $ex) {
        }
    }

    public function createCommonNavHierarchical()
    {
        /* @var $standardTopics NGSettingsStandardTopics */
        $standardTopics = $this->adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
        if (!array_key_exists('common', $standardTopics->topicuids))
            return false;

        $topics = $this->adapter->loadChildObjects($standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);

        /* @var $parenttopic NGTopic */
        $parenttopic = $this->adapter->loadObject($standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);

        $topics = NGUtil::sortItems($topics, $parenttopic->sortManualTopics);

        $items = Array();

        foreach ($topics as $topic) {

            /* @var $topic NGFolder */

            $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $topic->nextVisibilityChange());

            if ($topic->isVisible()) {

                $item = new NGCommonHierarchicalTopic ($topic->caption);

                $pages = $this->adapter->loadChildObjects($topic->objectUID, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage);

                $pages = NGUtil::sortItems($pages, $topic->sortManualPages);

                foreach ($pages as $page) {
                    if ($page->isVisible()) {
                        $link = new NGLink ($this->previewMode);
                        $link->uid = $page->objectUID;
                        $link->linkType = NGLink::LinkPage;
                        $item->pages [] = new NGCommonHierarchicalPage ($page->caption, $link->getUrl());
                    }
                    $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $page->nextVisibilityChange());
                }

                if (count($item->pages) > 0)
                    $items [] = $item;
            }
        }

        if (count($items) > 0) {
            $this->template->assign('commonnavhierarchical', $items);
        }
    }
}

class NGCommonPage
{

    public $caption;

    public $link;

    public function __construct($caption, $link)
    {
        $this->caption = $caption;
        $this->link = $link;
    }
}

class NGCommonHierarchicalPage
{

    public $caption;

    public $link;

    public function __construct($caption, $link)
    {
        $this->caption = $caption;
        $this->link = $link;
    }
}

class NGCommonHierarchicalTopic
{

    public $caption;

    public $pages;

    public function __construct($caption)
    {
        $this->caption = $caption;
        $this->pages = Array();
    }
}