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
		
		$nav = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $nav->findAchestorAtLevel ( $this->layout->page->parentUID, 2 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$this->layout->template->assign ( 'nav', $nav );
		$this->layout->template->assign ( 'preview', $this->layout->previewMode );
		$this->layout->template->assign ( 'active', $activeTopicUid );
		
		$this->layout->javaScripts ['wichita'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/wichita/js/wichita.js' );

        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatcher', 960, 320, NGPicture::Ratio3by1 );
		$this->layout->createImage ( 'logo', - 1, 58, NGPicture::RatioNone );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 960;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 960;
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = 960;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth -= 260;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth -= 260;
		
		$this->layout->template->assign ( 'width', $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth );
		
		$this->layout->createCommonNav ();
		$this->layout->setSearch ();
		
		if (NGUtil::StringXMLToBool ( $this->config ['options.includehome'] )) {
			$this->layout->template->assign ( 'home', $nav->fullURL ( $this->layout->previewMode ) );
			$this->layout->template->assign ( 'homecaption', $nav->caption );
		}
		
		if (NGUtil::StringXMLToBool ( $this->config ['options.breadcrumbs'] )) {
			$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
		}
		
		if (NGUtil::StringXMLToBool ( $this->config ['options.audio'] )) {
			$this->layout->template->assign ( 'openogg', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/wichita/sounds/sfxopen.ogg' ) );
			$this->layout->template->assign ( 'openmp3', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/wichita/sounds/sfxopen.mp3' ) );
			$this->layout->template->assign ( 'closeogg', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/wichita/sounds/sfxclose.ogg' ) );
			$this->layout->template->assign ( 'closemp3', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/wichita/sounds/sfxclose.mp3' ) );
		}
	
	}
}