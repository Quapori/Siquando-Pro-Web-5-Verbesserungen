<?php

class NGPluginLayoutProExt
{
    /**
     *
     * Placeholder for layout
     * @var NGPluginLayoutPro
     */
    public $layout;

    /**
     *
     * Array
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

    public function render()
    {

        $renderWidth = intval($this->layout->settings->config ['options.width']);

        $this->layout->template->assign('htmlclass', 'sqr');

        if (array_key_exists('hiddenstreams', $this->layout->settings->config)) {
            foreach ($this->layout->page->paragraphStreams as $paragraphStream) {
                /* @var $paragraphStream NGParagraphStream */
                if (strpos($this->layout->settings->config ['hiddenstreams'], $paragraphStream->name) !== false) {
                    $paragraphStream->isVisible = false;
                }
            }
        }

        /* @var $home NGNavItem */
        $home = NGSession::getInstance()->getNavRootHome();
        $activeTopic = $home->findByUID($this->layout->page->parentUID);

        if (NGConfig::IsShop) {
            $adapter = new NGDBAdapterObject ();

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
            if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                $this->layout->template->assign('cartindicator', $standardTopics->topicuids['shopcartindicator']);
                $this->layout->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->layout->previewMode ? '?ngm=p' : ''));
            }
        }

        $this->layout->template->assign('topicuid', ($activeTopic === null) ? '' : $activeTopic->objectUID);
        $this->layout->template->assign('home', $home);
        $this->layout->template->assign('previewMode', $this->layout->previewMode);
        $this->layout->template->assign('navpictures1', NGUtil::StringXMLToBool($this->layout->settings->config ['options.navpictures.1']));
        $this->layout->template->assign('cropratio1', NGPicture::stringToRatio($this->layout->settings->config ['options.cropratio.1']));
        $this->layout->template->assign('navpictures2', NGUtil::StringXMLToBool($this->layout->settings->config ['options.navpictures.2']));
        $this->layout->template->assign('cropratio2', NGPicture::stringToRatio($this->layout->settings->config ['options.cropratio.2']));
        $this->layout->template->assign('navpictures3', NGUtil::StringXMLToBool($this->layout->settings->config ['options.navpictures.3']));
        $this->layout->template->assign('cropratio3', NGPicture::stringToRatio($this->layout->settings->config ['options.cropratio.3']));

        $icon = new NGPluginIcon();
        $icon->class = 'sqpnavicon';

        $this->layout->template->assign('icon', $icon);
        $this->layout->template->assign('config', $this->layout->settings->config);

        $this->layout->javaScripts ['kaiser'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/styles/kaiser/js/kaiser.js');

        $this->layout->template->assign('viewport', 'width=device-width, initial-scale=1.0');

        if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.search'])) {
            $this->layout->setSearch();
        }

        foreach ($this->layout->page->paragraphStreams as $paragraphStream) {
            /* @var $paragraphStream NGParagraphStream */
            $paragraphStream->responsive = true;
            $paragraphStream->allowMobileFullWidth = true;
            $paragraphStream->mobileWidth = self::MobileWidth;
        }

        $renderWidth = intval($this->layout->settings->config ['options.width']) - 40;

        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $renderWidth;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $renderWidth;

        $colcount = 1;

        if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
            $colcount++;
        if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
            $colcount++;
        if ($colcount == 1)
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = true;

        $this->layout->template->assign('cols', $colcount);

        if ($this->layout->settings->config ['options.mainlayout'] === 'sidebars' && $colcount > 1) {
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
        } else {
            $renderWidthColumn = ceil($renderWidth / $colcount);
            if ($renderWidthColumn < self::MobileWidth)
                $renderWidthColumn = self::MobileWidth;

            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil($renderWidthColumn);
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil($renderWidthColumn);
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil($renderWidthColumn);
            $this->layout->template->assign('mainstyle', 'sqrmain' . $colcount . 'col');
        }

        $this->layout->createImage('logo', 400, -1, NGPicture::RatioNone);

        $topic = $this->layout->topic;
        $adapter = new NGDBAdapterObject ();

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

            foreach ($bouquet->items as $item) {
                /* @var $item NGBouquetItem */
                $pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, 1920, 640, NGPicture::Ratio3by1);
            }

            if (count($pictures) === 0 && $this->layout->settings->config ['options.galeryinheritance'] == 'true') {
                $this->layout->createImage('eyecatcher', 1920, 640, NGPicture::Ratio3by1);
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

        if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.breadcrumbs']))
            $this->layout->template->assign('breadcrumbs', NGRenderBreadcrumbs::render($this->layout->page->parentUID, $this->layout->previewMode));

    }
}