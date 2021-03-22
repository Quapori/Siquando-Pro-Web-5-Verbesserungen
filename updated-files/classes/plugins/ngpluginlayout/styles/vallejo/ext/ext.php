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
		
		$width = 782;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$width -= 211;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$width -= 211;
		
		$this->layout->template->assign ( 'width', $width );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 740;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = 160;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = 160;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width-42;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 740;


        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 780, 260, NGPicture::Ratio3by1 );
		$this->layout->createImage ( 'logo', 160, -1, NGPicture::RatioNone );
		
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 2 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$nav = ($home == NULL) ? '' : $navigation->renderList ( $home, 9, NGUtil::StringXMLToBool ( $this->config ['options.includehome'] ), $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		
		$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
		
		$this->layout->setSearch ();
		$this->layout->createCommonNav ();
		
	}
}