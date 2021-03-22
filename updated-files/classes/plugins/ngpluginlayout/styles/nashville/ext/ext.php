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
		
		$colcount=1;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) $colcount++;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible) $colcount++;
		
		$width= floor((960- 40*($colcount-1))/$colcount) ;
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 960;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 960;		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width;
		
		
		$this->layout->template->assign ( 'config', $this->config );
		$this->layout->template->assign ( 'width', $width );
		
		$this->layout->createImage('eyecatcher', 1920, -1, NGPicture::RatioNone);
		$this->layout->createImage('logo', 220, -1, NGPicture::RatioNone);
					
		$this->layout->javaScripts ['nashville'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/nashville/js/nashville.js' );
					
	}
}