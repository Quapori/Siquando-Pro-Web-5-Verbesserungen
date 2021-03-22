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
		
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->layout->previewMode;
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 2 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$activeSubTopic = $home->findAchestorAtLevel ( $this->layout->page->parentUID, 3 );
		$activeSubTopicUid = ($activeSubTopic === null) ? '' : $activeSubTopic->objectUID;
				
		$nava = ($home === NULL) ? '' : $navigation->renderList ( $home, 1, NGUtil::StringXMLToBool($this->config['options.includehome']), $activeTopicUid );
		$navb = ($activeTopic === NULL) ? '' : $navigation->renderList ( $activeTopic, 1, false, $activeSubTopicUid );
		
		$this->layout->template->assign ( 'nava', $nava );
		$this->layout->template->assign ( 'navb', $navb );
		$this->layout->template->assign ( 'fader', NGUtil::StringXMLToBool($this->config['options.fader']));
	
		$this->layout->createImage ( 'logo', -1, 36, NGPicture::RatioNone );
        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 940, -1, NGPicture::Ratio3by1 );
		$this->layout->setSearch ();
		
		if (array_key_exists ( 'hiddenstreams', $this->config )) {
			foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
				/* @var $paragraphStream NGParagraphStream */
				if (strpos ( $this->config ['hiddenstreams'], $paragraphStream->name ) !== false) {
					$paragraphStream->isVisible = false;
				}
			}
		}
						
		$colcount = 1;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$colcount ++;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$colcount ++;
		
		$width = floor ( (960 - 50 * ($colcount - 1)) / $colcount );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 960;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $width;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 960;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $width;
		
		$this->layout->template->assign ( 'width', $width );
		
		$this->layout->javaScripts ['poughkeepsie'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/poughkeepsie/js/poughkeepsie.js' );
		$this->layout->createCommonNav ();
		
	}
}