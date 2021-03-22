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

		$this->layout->setSearch ();
		$this->layout->createCommonNav ();
		
		$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
		
		$width = 880;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$width -= 260;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$width -= 260;
		
		$this->layout->template->assign ( 'width', $width );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 880;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 880;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		
		$activeTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 2 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$activeSubTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 3 );
		$activeSubTopicUid = ($activeSubTopic === null) ? '' : $activeSubTopic->objectUID;
		
		$nava = ($home === NULL) ? '' : $navigation->renderList ( $home, 1, false, $activeTopicUid );
		$navb = ($activeTopic === NULL) ? '' : $navigation->renderList ( $activeTopic, 1, false, $activeSubTopicUid );
		
		$this->layout->template->assign ( 'nava', $nava );
		$this->layout->template->assign ( 'navb', $navb );

        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 960, 320, NGPicture::Ratio3by1 );
		
		$this->layout->template->assign ( 'home', $home->fullURL ( $this->layout->previewMode ) );
		$this->layout->template->assign ( 'homecaption', $home->caption );
	
	}
}