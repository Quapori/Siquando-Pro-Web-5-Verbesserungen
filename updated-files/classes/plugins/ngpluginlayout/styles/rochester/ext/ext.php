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
		
		$nav = ($home === NULL) ? '' : $navigation->renderList ( $home, 9, NGUtil::StringXMLToBool ( $this->config ['options.includehome'] ), $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		$this->layout->template->assign ( 'navwidth', count ( $home->children ) * 160 );
		
		$this->layout->createImage ( 'logo', - 1, 84, NGPicture::RatioNone );
        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 960, 320, NGPicture::Ratio3by1 );
		
		$colcount = 1;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$colcount ++;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$colcount ++;
		
		$width = floor ( (860 - 60 * ($colcount - 1)) / $colcount );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 860;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 860;
		
		if (array_key_exists ( 'options.breadcrumbs', $this->config )) {
			if (NGUtil::StringXMLToBool ( $this->config ['options.breadcrumbs'] )) {
				$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
			}
		}
		
		$this->layout->template->assign ( 'width', $width );
		$this->layout->createCommonNav ();
		$this->layout->setSearch ();
	
	}
}