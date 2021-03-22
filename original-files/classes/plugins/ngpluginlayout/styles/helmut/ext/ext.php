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
	 *
	 * Width on desktop device
	 *
	 * @var integer
	 */
	const DesktopWidth = 1100;

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
		
		$this->layout->createImage ( 'logo', - 1, 36, NGPicture::RatioNone );
		
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findByUID ( $this->layout->page->parentUID );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;

        if (NGConfig::IsShop)
        {
            $adapter = new NGDBAdapterObject ();

            /* @var $standardTopics NGSettingsStandardTopics */
            $standardTopics = $adapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
            if ( array_key_exists ( 'shopcartindicator', $standardTopics->topicuids )) {
                $navigation->uidCartIndicator=$standardTopics->topicuids['shopcartindicator'];
                $this->layout->javaScripts ['ngshopglobals'] = NGUtil::prependRootPath('classes/plugins/ngpluginshop/js/shopglobals/' . ($this->layout->previewMode ? '?ngm=p' : ''));
            }
        }
		
		$nav = $navigation->renderList ( $home, 1, NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.includehome'] ) , $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		$this->layout->template->assign ( 'home', NGLink::getLinkToHome ( $this->layout->previewMode ) );
		
		$viewport = 'width=device-width, initial-scale=1.0';
		
		$this->layout->template->assign ( 'viewport', $viewport );
		
		foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
			/* @var $paragraphStream NGParagraphStream */
			$paragraphStream->responsive = true;
			$paragraphStream->allowMobileFullWidth = true;
			$paragraphStream->mobileWidth = self::MobileWidth;
		}
		
		$renderWidth = intval ( $this->layout->settings->config ['options.width'] - 40 );
		
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
		
		if (array_key_exists ( 'options.breadcrumbs', $this->layout->settings->config )) {
			if (NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.breadcrumbs'] )) {
				$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
			}
		}
		
		$richtext = new NGRichText ();
		$richtext->previewMode = $this->layout->previewMode;
		$this->layout->template->assign ( 'footer', $richtext->parse ( $this->layout->settings->config ['footer.html'] ) );
		
		if ($this->layout->settings->config ['options.title'] !== '')
			$this->layout->template->assign ( 'websitetitle', $this->layout->settings->config ['options.title'] );
		
		if ($this->layout->page->pageCaption () !== '' && $this->layout->page->objectUID !== NGUtil::ObjectUIDHomePage)
			$this->layout->template->assign ( 'pagetitle', $this->layout->page->pageCaption () );
		
		$this->layout->createCommonNav ();
	}
}