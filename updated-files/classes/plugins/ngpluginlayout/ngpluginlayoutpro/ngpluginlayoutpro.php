<?php

class NGPluginLayoutPro extends NGPluginLayout
{

    /**
     *
     * Loaded settings
     * @var NGPluginLayoutProSettings
     */
    public $settings;

    /**
     *
     * Custom Layout extension
     * @var NGPluginLayoutProExt
     */
    public $ext;

    public function render()
    {

        $this->appendDefaultIncludes();

        $this->styleSheets ['layout'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/ngpluginlayoutpro/css/');

        $this->page->previewMode = $this->previewMode;

        $this->page->prepare();

        $this->topic = $this->adapter->loadObject($this->page->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true);

        $this->getTemplatePage();

        if ($this->templatePage !== null) {
            $this->templatePage->previewMode = $this->previewMode;
            $this->templatePage->prepare();
        }

        $this->settings = $this->adapter->loadSetting(NGPluginLayoutProSettings::IdLayoutPro, NGPluginLayoutProSettings::ObjectTypePluginLayoutProSettings);

        $extPath = NGUtil::joinPaths(NGClassFolder(), '/plugins/ngpluginlayout/styles/' . $this->settings->template . '/ext/ext.php');

        if (is_file($extPath)) {
            include_once($extPath);
            $this->ext = new NGPluginLayoutProExt ();
            $this->ext->layout = $this;
            $this->ext->render();
        }

        $this->template->assign('lang', NGSession::getInstance()->getLanguageRessource(NGUtil::LanguageResourcesMain));
        $this->template->assign('previewmode', $this->previewMode);

        $this->page->render();

        if ($this->templatePage !== null) {
            $this->renderParagraphStreamTemplates();
        }

        $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $this->page->nextScheduledChange);

        $this->appendPageIncludes();

        $this->setMiscellaneous();

        $this->appendWebFonts();

        $this->setDefaultVariables();

        $templateFilename = 'ngpluginlayout/styles/' . $this->settings->template . '/tpl/layout.tpl';

        if (file_exists(NGUtil::joinPaths(NGConfig::pluginsPath(), $templateFilename))) {
            $this->output = $this->template->fetchPluginTemplate($templateFilename);

            if (NGSettingsSite::getInstance()->compress) $this->output=NGUtil::compressHTML($this->output);
        } else {
            die (sprintf('Das Layout „%s“ ist nicht installiert …', $this->settings->template));
        }

        $this->prepareFTS();
    }

    /**
     *
     * Create an image
     * @param string $id
     * @param string $width
     * @param string $height
     * @param string $ratio
     */
    public function createImage($id, $width, $height, $ratio)
    {
        if (array_key_exists($id, $this->settings->config)) {

            $uid = $this->settings->config [$id];

            if (array_key_exists($id . '.override', $this->settings->config)) {
                if (NGUtil::StringXMLToBool($this->settings->config [$id . '.override'])) {
                    if ($this->page->picture != '') {
                        $uid = $this->page->picture;
                    }
                }
            }

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
                    $this->template->assign($id . 'title', (array_key_exists($id . '.title', $this->settings->config)) ? $this->settings->config [$id . '.title'] : '');

                    if (array_key_exists($id . '.link', $this->settings->config)) {
                        $link = new NGLink ($this->previewMode);
                        $link->parseURL($this->settings->config [$id . '.link']);
                        if ($link->linkType != NGLink::LinkUndefined) {
                            $this->template->assign($id . 'link', $link->getURL());
                            switch ($link->linkType) {
                                case NGLink::LinkPicture :
                                    $this->template->assign($id . 'linkclass', 'gallery');
                                    break;
                                case NGLink::LinkPagePopup :
                                case NGLink::LinkTopicPopup :
                                    $this->template->assign($id . 'linkclass', 'galleryiframe');
                                    break;
                                case NGLink::LinkWWW :
                                    $this->template->assign($id . 'linktarget', '_blank');
                                    break;
                            }
                        }
                    }

                }
            }

        }
    }

    public function createCommonNav()
    {
        try {
            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $this->adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
            if (!array_key_exists('common', $standardTopics->topicuids)) return false;

            if ($standardTopics->topicuids ['common'] === '') return false;

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
        try {
            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $this->adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
            if (!array_key_exists('common', $standardTopics->topicuids)) return false;

            if ($standardTopics->topicuids ['common'] === '') return false;

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

        } catch (Exception $ex) {
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