<?php

class NGPluginLayoutProExt {
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
	
	public function render() {
		
		$this->config = $this->layout->settings->config;
		
		if (array_key_exists ( 'hiddenstreams', $this->config )) {
			foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
				/* @var $paragraphStream NGParagraphStream */
				if (strpos ( $this->config ['hiddenstreams'], $paragraphStream->name ) !== false) {
					$paragraphStream->isVisible = false;
				}
			}
		}
		
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 2 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$nav = ($home == NULL) ? '' : $navigation->renderList ( $home, 1, false, $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		$this->layout->template->assign ( 'home', $home->fullURL ( $this->layout->previewMode ) );
		$this->layout->template->assign ( 'homecaption', $home->caption );
		$this->layout->template->assign ( 'preview', $this->layout->previewMode );
		
		if ($activeTopic === NULL) {
			$this->layout->template->assign ( 'subnav', $home );
		} else {
			$this->layout->template->assign ( 'subnav', $activeTopic );
		}
		
		$this->layout->createCommonNav ();
		$this->layout->setSearch ();

        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 930, 310, NGPicture::Ratio3by1 );
		$this->layout->createImage ( 'logo', - 1, 44, NGPicture::RatioNone );
		
		$colcount = 1;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$colcount ++;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$colcount ++;
		
		$width = floor ( (930 - 40 * ($colcount - 1)) / $colcount );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 930;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 930;
		
		$this->layout->template->assign ( 'width', $width )	;
		if (NGUtil::StringXMLToBool ( $this->config ['options.breadcrumbs'] )) {
			$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
		}
		
		NGFontUtil::getInstance()->getFontStack('Signika');
	}
}