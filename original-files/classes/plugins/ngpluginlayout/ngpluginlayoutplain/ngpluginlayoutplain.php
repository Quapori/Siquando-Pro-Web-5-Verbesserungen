<?php

class NGPluginLayoutPlain extends NGPluginLayout {
	
	const DesignWidth=840;
	
	const MobileWidth=640;
	
	public function render() {
		
		$this->appendDefaultIncludes ();
		
		$this->styleSheets ['layout'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutplain/css/' );
		
		$this->page->previewMode = $this->previewMode;
		
		$this->page->prepare ();
		
		$this->topic = $this->adapter->loadObject ( $this->page->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true );
				
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamHeader]->isVisible=false;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible=false;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamSidebarRight]->isVisible=false;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamFooter]->isVisible=false;
		
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->isVisible=true;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->renderWidth=self::DesignWidth;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->responsive = true;		
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->allowMobileFullWidth = false;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = false;
		$this->page->paragraphStreams[NGParagraphStream::ParagraphStreamContent]->mobileWidth = self::MobileWidth;
		
					
		$this->template->assign ( 'lang', NGSession::getInstance ()->getLanguageRessource ( NGUtil::LanguageResourcesMain ) );
		$this->template->assign ( 'previewmode', $this->previewMode );
						
		$this->page->render ();
		
		$this->appendPageIncludes ();
		
		$this->setMiscellaneous();
		
		$this->appendWebFonts();
		
		$this->setDefaultVariables ();
		
				
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginlayout/ngpluginlayoutplain/tpl/layout.tpl' );
		
	}
	
}