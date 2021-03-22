<?php

class NGPluginLayoutProExt
{

    /**
     *
     * Placeholder for layout
     *
     * @var NGPluginLayoutPro
     */
    public $layout;

    /**
     *
     * Array
     *
     * @var Array
     */
    public $config;

    /**
     *
     * Width of mobile device
     *
     * @var integer
     */
    const MobileWidth = 1023;

    /**
     * Render the layout
     */
    public function render()
    {
        $this->layout->template->assign('htmlclass', 'sqr');

        if (array_key_exists('hiddenstreams', $this->layout->settings->config)) {
            foreach ($this->layout->page->paragraphStreams as $paragraphStream) {
                /* @var $paragraphStream NGParagraphStream */
                if (strpos($this->layout->settings->config ['hiddenstreams'], $paragraphStream->name) !== false) {
                    $paragraphStream->isVisible = false;
                }
            }
        }

        $adapter = new NGDBAdapterObject ();

        $navigation = new NGRenderNavigation ();
        $navigation->previewMode = $this->layout->previewMode;
        $navigation->useSpan = true;
        $navigation->classHome = 'sqrnavhome';

        if (NGConfig::IsShop) {

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);

            if ($standardTopics !== null) {
                if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                    $navigation->uidCartIndicator = $standardTopics->topicuids['shopcartindicator'];
                    $this->layout->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->layout->previewMode ? '?ngm=p' : ''));

                }
            }
        }

        $home = NGSession::getInstance()->getNavRootHome();

        $activeTopic = $home->findByUID($this->layout->page->parentUID);
        $activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;

        $nav = $navigation->renderList($home, 3, NGUtil::StringXMLToBool($this->layout->settings->config ['options.includehome']), $activeTopicUid);

        $this->layout->template->assign('nav', $nav);
        $this->layout->template->assign('home', NGLink::getLinkToHome($this->layout->previewMode));
        $this->layout->javaScripts ['wyntherscharff'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/styles/wyntherscharff/js/navigation.js');

        $viewport = 'width=device-width, initial-scale=1.0';

        if (!NGUtil::StringXMLToBool($this->layout->settings->config ['options.userscalable'])) {
            $viewport .= ', user-scalable=no';
        }

        $this->layout->template->assign('viewport', $viewport);

        if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.search'])) {
            $this->layout->setSearch();
        } else {
            $this->layout->template->assign('search', '');
        }

        foreach ($this->layout->page->paragraphStreams as $paragraphStream) {
            /* @var $paragraphStream NGParagraphStream */
            $paragraphStream->responsive = true;
            $paragraphStream->allowMobileFullWidth = true;
            $paragraphStream->mobileWidth = self::MobileWidth;
        }

        $renderWidth = ceil(intval($this->layout->settings->config ['options.width'])*0.75);

        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $renderWidth;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $renderWidth;

        if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
            $this->layout->template->assign('mainstyle', 'sqrmain3collr');
            $renderWidthLeft = ceil($renderWidth * 0.21);
            $renderWidthRight = ceil($renderWidth * 0.21);
            $gutter = ceil($renderWidth * 0.04) * 2;
            $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
        } else if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && !$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
            $this->layout->template->assign('mainstyle', 'sqrmain2coll');
            $renderWidthLeft = ceil($renderWidth * 0.21);
            $renderWidthRight = 0;
            $gutter = ceil($renderWidth * 0.04);
            $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
        } else if (!$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
            $this->layout->template->assign('mainstyle', 'sqrmain2colr');
            $renderWidthLeft = 0;
            $renderWidthRight = ceil($renderWidth * 0.21);
            $gutter = ceil($renderWidth * 0.04);
            $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
        } else {
            $renderWidthLeft = 0;
            $renderWidthRight = 0;
            $renderWidthContent = $renderWidth;
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = true;
        }

        if ($renderWidthLeft < self::MobileWidth)
            $renderWidthLeft = self::MobileWidth;
        if ($renderWidthRight < self::MobileWidth)
            $renderWidthRight = self::MobileWidth;
        if ($renderWidthContent < self::MobileWidth)
            $renderWidthContent = self::MobileWidth;

        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil($renderWidthContent);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil($renderWidthLeft);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil($renderWidthRight);

        if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.breadcrumbs'])) {
            $this->layout->template->assign('breadcrumbs', NGRenderBreadcrumbs::render($this->layout->page->parentUID, $this->layout->previewMode));
        }

        $this->layout->template->assign('captionposition', $this->layout->settings->config ['options.captionposition']);
        $this->layout->createImage('logo', -1, 42, NGPicture::RatioNone);

        $topic = $this->layout->topic;

        if ($this->layout->settings->config ['options.galeryinheritance'] == 'true') {
            while ($topic->bouquetitemssource === NGBouquet::ItemsSourceManual && $topic->bouquetitems === '' && $topic->parentUID != NGUtil::ObjectUIDRootContent) {
                $topic = $adapter->loadObject($topic->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);
            }
        }
        
        $pictures = Array();

        if (!$this->layout->topic->hideeyecatcher) {
            $bouquet = new NGBouquet ();
            $bouquet->itemSource = $topic->bouquetitemssource;
            $bouquet->sortMode = $topic->bouqetsortmode;
            $bouquet->itemsXML = $topic->bouquetitems;
            $bouquet->parentUID = $topic->bouquetparentuid;
            $bouquet->previewMode = $this->layout->previewMode;
            $bouquet->prepare();

            $pictureWidth = $renderWidth - 2;

            if ($this->layout->settings->config ['options.eyecatcherposition'] === 'content') $pictureWidth = ceil($pictureWidth * 0.75);

            foreach ($bouquet->items as $item) {
                /* @var $item NGBouquetItem */
                $pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, $pictureWidth, -1, NGPicture::Ratio3by1);
            }

            if (count($pictures) === 0 && $this->layout->settings->config ['options.galeryinheritance'] == 'true') {
                $this->layout->createImage('eyecatcher', $pictureWidth, -1, NGPicture::Ratio3by1);
            }
        }
        $this->layout->template->assign('pictures', $pictures);
        $this->layout->template->assign('autoprogress', $this->layout->settings->config ['slider.autoprogress']);


        $richtext = new NGRichText ();
        $richtext->previewMode = $this->layout->previewMode;
        $this->layout->template->assign('footer', $richtext->parse($this->layout->settings->config ['footer.html']));

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'topic' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNavHierarchical();

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'page' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNav();

        $this->layout->template->assign('config', $this->layout->settings->config);
    }
}

?>