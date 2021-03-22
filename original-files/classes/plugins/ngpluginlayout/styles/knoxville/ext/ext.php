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
		
		$nav = ($home == NULL) ? '' : $navigation->renderList ( $home, 3, true, $activeTopicUid );
		
		$this->layout->template->assign ( 'nav', $nav );
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = 920;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = 220;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = 920;
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = 920;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth -= 280;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth -= 280;
		
		$this->layout->template->assign ( 'config', $this->config );
		$this->layout->template->assign ( 'contentwidth', $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth );

        if (!$this->layout->topic->hideeyecatcher) $this->layout->createImage ( 'eyecatchertop', 920, - 1, NGPicture::Ratio3by1 );
        $this->layout->createImage ( 'eyecatcherleft', 200, - 1, NGPicture::RatioNone );
		$this->layout->createImage ( 'logo', - 1, 58, NGPicture::RatioNone );
		$this->layout->createCommonNav ();
		$this->layout->setSearch ();
		
		if (array_key_exists ( 'options.breadcrumbs', $this->config )) {
			if (NGUtil::StringXMLToBool ( $this->config ['options.breadcrumbs'] )) {
				$this->layout->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->layout->page->parentUID, $this->layout->previewMode ) );
			}
		}
		
		$this->layout->javaScripts ['jquery.color'] = NGUtil::prependRootPath ( 'js/jquery.color.js' );
		$this->layout->javaScripts ['ngflymenu'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/knoxville/js/ngflymenu.js' );
		$this->layout->javaScripts ['ngfademenu'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/knoxville/js/ngfademenu.js' );
	
	}
}