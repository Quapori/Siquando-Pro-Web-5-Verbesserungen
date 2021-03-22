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
				
		$nav = ($home == NULL) ? '' : $navigation->renderList ( $home, 2, false, $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 840;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 840;
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = 840;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth -= 280;
		
		$this->layout->template->assign ( 'config', $this->config );
		$this->layout->template->assign ( 'contentwidth', $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth );
		
		$this->layout->createImage('logo', 220, -1, NGPicture::RatioNone);
        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage('eyecatcher', 880, -1, NGPicture::Ratio3by1);
		
		$this->layout->template->assign ('homeurl', NGSession::getInstance()->getNavRootHome()->fullURL($this->layout->previewMode));
		$this->layout->template->assign ('homecaption', NGSession::getInstance()->getNavRootHome()->caption);
				
		$this->layout->javaScripts ['louisville'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/louisville/js/louisville.js' );
		
		$this->layout->createCommonNav();
		$this->layout->setSearch();
		
	}
}