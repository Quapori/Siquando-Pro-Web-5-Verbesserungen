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

        $navigation = new NGRenderNavigation ();
        $navigation->previewMode = $this->layout->previewMode;
        $navigation->useSpan = true;
        $navigation->classHome = 'sqrnavhome';

        $home = NGSession::getInstance()->getNavRootHome();

        if (NGConfig::IsShop) {
            $adapter = new NGDBAdapterObject ();

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);
            if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                $navigation->uidCartIndicator = $standardTopics->topicuids['shopcartindicator'];
                $this->layout->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->layout->previewMode ? '?ngm=p' : ''));
            }
        }


        $nav = $navigation->renderList($home, 3, NGUtil::StringXMLToBool($this->layout->settings->config ['options.includehome']));

        $this->layout->template->assign('nav', $nav);
        $this->layout->template->assign('home', NGLink::getLinkToHome($this->layout->previewMode));
        $this->layout->javaScripts ['centum'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/styles/centum/js/navigation.js');

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

        $renderWidth = intval($this->layout->settings->config ['options.width']);

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
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
        }

        if ($renderWidthLeft < self::MobileWidth)
            $renderWidthLeft = self::MobileWidth;
        if ($renderWidthRight < self::MobileWidth)
            $renderWidthRight = self::MobileWidth;
        if ($renderWidthContent < self::MobileWidth)
            $renderWidthContent = self::MobileWidth;

        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil($renderWidthContent);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = ceil($renderWidthContent);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil($renderWidthLeft);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil($renderWidthRight);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = ceil($renderWidthContent);
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;


        if (array_key_exists('options.breadcrumbs', $this->layout->settings->config)) {
            if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.breadcrumbs'])) {
                $this->layout->template->assign('breadcrumbs', NGRenderBreadcrumbs::render($this->layout->page->parentUID, $this->layout->previewMode));
            }
        }

        $this->layout->createImage('logo', 480, -1, NGPicture::RatioNone);

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

            $sliderratio = NGUtil::StringXMLToBool($this->layout->settings->config ['options.largeslider']) ? NGPicture::Ratio16by9 : NGPicture::Ratio3by1;

            foreach ($bouquet->items as $item) {
                /* @var $item NGBouquetItem */

                $size = $item->displayPicture()->getResizedSize(1920, -1, $sliderratio);

                $pictures [] = array(
                    'source' => NGLink::getPictureURL($item->displayPicture()->objectUID, 1920, -1, $sliderratio),
                    'size' => $size
                );
            }

            if (count($pictures) === 0 && $this->layout->settings->config ['options.galeryinheritance'] == 'true') {
                $this->layout->createImage('eyecatcher', 1920, 640, NGPicture::Ratio3by1);
            }

            if (array_key_exists('h264', $this->layout->topic->linkedmedia)) {
                $h264download = $adapter->loadObject($this->layout->topic->linkedmedia ['h264'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($h264download !== null) {
                    $this->layout->template->assign('topich264', NGUtil::prependStorePath($h264download->pathToFile()));
                }
            }
            if (array_key_exists('ogv', $this->layout->topic->linkedmedia)) {
                $ogvdownload = $adapter->loadObject($this->layout->topic->linkedmedia ['ogv'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($ogvdownload !== null) {
                    $this->layout->template->assign('topicogv', NGUtil::prependStorePath($ogvdownload->pathToFile()));
                }
            }
            if (array_key_exists('webm', $this->layout->topic->linkedmedia)) {
                $webmdownload = $adapter->loadObject($this->layout->topic->linkedmedia ['webm'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($webmdownload !== null) {
                    $this->layout->template->assign('topicwebm', NGUtil::prependStorePath($webmdownload->pathToFile()));
                }
            }
            if (array_key_exists('poster', $this->layout->topic->linkedmedia)) {
                $this->layout->template->assign('poster', NGLink::getPictureURL($this->layout->topic->linkedmedia ['poster'], 1920, 1080, NGPicture::RatioNone));
            }

            if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.mutevideo'])) {
                $this->layout->template->assign('mutevideo', true);
            }
        }

        $this->layout->template->assign('pictures', $pictures);


        $this->layout->template->assign('autoprogress', $this->layout->settings->config ['slider.autoprogress']);

        $richtext = new NGRichText ();
        $richtext->previewMode = $this->layout->previewMode;
        $this->layout->template->assign('footer', $richtext->parse($this->layout->settings->config ['footer.html']));

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'topic') {
            $this->layout->createCommonNavHierarchical();
        } else {
            $this->layout->createCommonNav();
        }
    }
}