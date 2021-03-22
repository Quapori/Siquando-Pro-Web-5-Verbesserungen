<?php

class NGPluginLayoutProExt {

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
	public function render() {
		$this->layout->template->assign ( 'htmlclass', 'sqr' );
		
		if (array_key_exists ( 'hiddenstreams', $this->layout->settings->config )) {
			foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
				/* @var $paragraphStream NGParagraphStream */
				if (strpos ( $this->layout->settings->config ['hiddenstreams'], $paragraphStream->name ) !== false) {
					$paragraphStream->isVisible = false;
				}
			}
		}
		
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		$navigation->useSpan = true;
		$navigation->classHome = 'sqrnavhome';
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findByUID ( $this->layout->page->parentUID );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;

        if (NGConfig::IsShop) {
            $adapter = new NGDBAdapterObject ();

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting(NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics);

            if ($standardTopics!==null) {
                if (array_key_exists('shopcartindicator', $standardTopics->topicuids)) {
                    $navigation->uidCartIndicator=$standardTopics->topicuids['shopcartindicator'];
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

        $nav = $navigation->renderList ( $home, 6, NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.includehome'] ), $activeTopicUid );

        $this->layout->template->assign ( 'nav', $nav );
		$this->layout->template->assign ( 'home', NGLink::getLinkToHome ( $this->layout->previewMode ) );
		$this->layout->javaScripts ['iguacu'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/iguacu/js/navigation.js' );
		
		$viewport = 'width=device-width, initial-scale=1.0';
		
		if (! NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.userscalable'] )) {
			$viewport .= ', user-scalable=no';
		}
		
		$this->layout->template->assign ( 'viewport', $viewport );
		
		if (NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.search'] )) {
			$this->layout->setSearch ();
		} else {
			$this->layout->template->assign ( 'search', '' );
		}
		
		foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
			/* @var $paragraphStream NGParagraphStream */
			$paragraphStream->responsive = true;
			$paragraphStream->allowMobileFullWidth = true;
			$paragraphStream->mobileWidth = self::MobileWidth;
		}
		
		$renderWidth = intval ( $this->layout->settings->config ['options.width'] ) - intval ( $this->layout->settings->config ['options.navwidth'] ) - 50;

		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $renderWidth;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $renderWidth;
		
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
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil ( $renderWidthContent );
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil ( $renderWidthLeft );
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil ( $renderWidthRight );
		
		if (array_key_exists ( 'options.breadcrumbs', $this->layout->settings->config )) {
			if (NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.breadcrumbs'] )) {
				$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
			}
		}

        $icon = new NGPluginIcon();
        $icon->class = 'sqpnavicon';

		$this->layout->template->assign ( 'expandnav', $this->layout->settings->config ['options.expandnav'] );
		$this->layout->createImage ( 'logo', -1, 26, NGPicture::RatioNone );
        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 1200, -1, NGPicture::Ratio3by1 );
        $this->layout->template->assign('icon', $icon);
        $this->layout->template->assign('config', $this->layout->settings->config);

		$richtext = new NGRichText ();
		$richtext->previewMode = $this->layout->previewMode;
		$this->layout->template->assign ( 'footer', $richtext->parse ( $this->layout->settings->config ['footer.html'] ) );

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'topic' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNavHierarchical();

        if ($this->layout->settings->config ['options.commonnavhierarchical'] == 'page' || $this->layout->settings->config ['options.commonnavhierarchical'] == 'dual')
            $this->layout->createCommonNav();
	}
}

?>