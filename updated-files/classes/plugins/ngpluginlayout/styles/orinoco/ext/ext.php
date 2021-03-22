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
     *
     * Width on desktop device
     *
     * @var integer
     */
    const DesktopWidth = 1100;

    /**
     * Render the layout
     */
    public function render()
    {

        $width = intval($this->layout->settings->config ['options.width']);
        $renderWidth = intval($this->layout->settings->config ['options.width.content']);

        if ($renderWidth < self::MobileWidth) $renderWidth = self::MobileWidth;

        $this->layout->template->assign('htmlclass', 'sqr');

        if (array_key_exists('hiddenstreams', $this->layout->settings->config)) {
            foreach ($this->layout->page->paragraphStreams as $paragraphStream) {
                /* @var $paragraphStream NGParagraphStream */
                if (strpos($this->layout->settings->config ['hiddenstreams'], $paragraphStream->name) !== false) {
                    $paragraphStream->isVisible = false;
                }
            }
        }

        $viewport = 'width=device-width, initial-scale=1.0';

        if (!NGUtil::StringXMLToBool($this->layout->settings->config ['options.userscalable'])) {
            $viewport .= ', user-scalable=no';
        }

        $this->layout->template->assign('viewport', $viewport);

        $this->layout->setSearch();

        foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
            /* @var $paragraphStream NGParagraphStream */
            $paragraphStream->responsive = true;
            $paragraphStream->allowMobileFullWidth = true;
            $paragraphStream->mobileWidth = self::MobileWidth;
        }

        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $renderWidth;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
        $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $renderWidth;

        $colcount = 1;

        if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
            $colcount ++;
        if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
            $colcount ++;
        if ($colcount == 1)
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = true;

        $this->layout->template->assign ( 'cols', $colcount );

        if ($this->layout->settings->config ['options.mainlayout'] === 'sidebars' && $colcount > 1) {
            if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->layout->template->assign ( 'mainstyle', 'sqrmain3collr' );
                $renderWidthLeft = ceil ( $renderWidth * 0.21 );
                $renderWidthRight = ceil ( $renderWidth * 0.21 );
                $gutter = ceil ( $renderWidth * 0.04 ) * 2;
                $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
            } else if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && ! $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->layout->template->assign ( 'mainstyle', 'sqrmain2coll' );
                $renderWidthLeft = ceil ( $renderWidth * 0.21 );
                $renderWidthRight = 0;
                $gutter = ceil ( $renderWidth * 0.04 );
                $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
            } else if (! $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
                $this->layout->template->assign ( 'mainstyle', 'sqrmain2colr' );
                $renderWidthLeft = 0;
                $renderWidthRight = ceil ( $renderWidth * 0.21 );
                $gutter = ceil ( $renderWidth * 0.04 );
                $renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
            }

            if ($renderWidthLeft < self::MobileWidth)
                $renderWidthLeft = self::MobileWidth;
            if ($renderWidthRight < self::MobileWidth)
                $renderWidthRight = self::MobileWidth;
            if ($renderWidthContent < self::MobileWidth)
                $renderWidthContent = self::MobileWidth;

            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil ( $renderWidthContent );
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil ( $renderWidthLeft );
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil ( $renderWidthRight );
        } else {
            $renderWidthColumn = ceil ( $renderWidth / $colcount );
            if ($renderWidthColumn < self::MobileWidth)
                $renderWidthColumn = self::MobileWidth;

            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil ( $renderWidthColumn );
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil ( $renderWidthColumn );
            $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil ( $renderWidthColumn );
            $this->layout->template->assign ( 'mainstyle', 'sqrmain' . $colcount . 'col' );
        }



        if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.breadcrumbs'])) {
            $this->layout->template->assign('breadcrumbs', NGRenderBreadcrumbs::render($this->layout->page->parentUID, $this->layout->previewMode));
        }

        if (NGConfig::IsShop) {
            $adapter = new NGDBAdapterObject ();

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);

            if ($standardTopics!==null) {
                if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                    $this->layout->template->assign('cartindicator', $standardTopics->topicuids['shopcartindicator']);
                    $this->layout->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->layout->previewMode ? '?ngm=p' : ''));

                }
            }

            /* @var $standardPages NGSettingsStandardPages */
            $standardPages = $adapter->loadSetting ( NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages );

            if ($standardPages!==null) {
                $link = new NGLink ();
                $link->linkType = NGLink::LinkPage;
                $link->previewMode = $this->layout->previewMode;

                if (array_key_exists('shopaccount', $standardPages->pageuids)) {
                    $link->uid = $standardPages->pageuids ['shopaccount'];
                    $this->layout->template->assign('accountlink', $link->getURL());
                }
                if (array_key_exists('shopcart', $standardPages->pageuids)) {
                    $link->uid = $standardPages->pageuids ['shopcart'];
                    $this->layout->template->assign('cartlink', $link->getURL());
                }
            }
        }


        $home = NGSession::getInstance()->getNavRootHome();
        $activeTopic = $home->findByUID($this->layout->page->parentUID);
        $icon = new NGPluginIcon();
        $icon->class = 'sqpnavicon';

        $this->layout->template->assign('resmenu', $this->layout->settings->config ['options.res.menu']);
        $this->layout->template->assign('ressearch', $this->layout->settings->config ['options.res.search']);
        $this->layout->template->assign('home', $home);
        $this->layout->template->assign('previewMode', $this->layout->previewMode);
        $this->layout->template->assign('topicuid', ($activeTopic === null) ? '' : $activeTopic->objectUID);
        $this->layout->template->assign('navpictures', NGUtil::StringXMLToBool($this->layout->settings->config ['options.navpictures']));
        $this->layout->template->assign('cropratio', NGPicture::stringToRatio($this->layout->settings->config ['options.cropratio']));
        $this->layout->template->assign('icon', $icon);
        $this->layout->template->assign('config', $this->layout->settings->config);

        $this->layout->javaScripts ['orinoco'] = NGUtil::prependRootPath('classes/plugins/ngpluginlayout/styles/orinoco/js/navigation.js');

        if (!$this->layout->topic->hideeyecatcher) {
            $this->layout->createImage('eyecatcher', $width, -1, NGPicture::Ratio3by1);

            if (array_key_exists('eyecatcher', $this->layout->settings->config)) {
                $this->layout->settings->config['eyecatcherq'] = $this->layout->settings->config['eyecatcher'];
                if (array_key_exists('eyecatcher.override', $this->layout->settings->config)) $this->layout->settings->config['eyecatcherq.override'] = $this->layout->settings->config['eyecatcher.override'];
                $this->layout->createImage('eyecatcherq', 768, 768, NGPicture::Ratio1by1);
            }
        }

        $this->layout->createImage('logo', 180, -1, NGPicture::RatioNone);

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'topic' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNavHierarchical();

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'page' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNav();

        $richtext = new NGRichText ();
        $richtext->previewMode = $this->layout->previewMode;
        $this->layout->template->assign('footer', $richtext->parse($this->layout->settings->config ['footer.html']));

        $this->layout->createCommonNav();
    }
}

?>