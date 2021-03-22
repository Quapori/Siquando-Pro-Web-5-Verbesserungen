<?php

class NGPluginLayoutPhone extends NGPluginLayout {
	
	public function render() {
		$this->appendDefaultIncludes ();
		
		$this->styleSheets ['layout'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutphone/css/' );
		
		$this->page->previewMode = $this->previewMode;
		
		$this->page->prepare ();
		
		$this->topic = $this->adapter->loadObject ( $this->page->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true );
		
		$this->getTemplatePage ();
		
		if ($this->templatePage !== null) {
			$this->templatePage->previewMode = $this->previewMode;
			$this->templatePage->prepare ();
		}
		
		/* @var $settings NGPluginLayoutPhoneSettings */
		$settings = $this->adapter->loadSetting ( NGPluginLayoutPhoneSettings::IdLayoutPhone, NGPluginLayoutPhoneSettings::ObjectTypePluginLayoutPhoneSettings );
		
		if ($settings->width == 320)
			$settings->width = 340;
		
		if (! $settings->leftvisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible = false;
		if (! $settings->rightvisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible = false;
		if (! $settings->footervisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->isVisible = false;
		if (! $settings->headervisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->isVisible = false;
		
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $settings->mainWidth () - $settings->headerExtraWidth ();
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $settings->mainWidth () - $settings->leftExtraWidth ();
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $settings->mainWidth () - $settings->contentExtraWidth ();
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $settings->mainWidth () - $settings->rightExtraWidth ();
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $settings->mainWidth () - $settings->footerExtraWidth ();
		
		$this->template->assign ( 'lang', NGSession::getInstance ()->getLanguageRessource ( NGUtil::LanguageResourcesMain ) );
		$this->template->assign ( 'langphone', NGSession::getInstance ()->getLanguageRessource ( 'classes/plugins/ngpluginlayout/ngpluginlayoutphone/language/langphone.xml' ) );
		$this->template->assign ( 'viewportwidth', $settings->width );
		$this->template->assign ( 'previewmode', $this->previewMode );
		
		if ($settings->navvisible) {
			$this->renderNav ();
		}
		
		if ($settings->choosevisible) {
			$this->javaScripts ['jquery.cookie'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutphone/js/jquery.cookie.js' );
			$this->javaScripts ['chooselayout'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutphone/js/chooselayout.js' );
		}
		
		if ($settings->navshownav) {
			$this->javaScripts ['togglenav'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutphone/js/togglenav.js' );
		}
		
		$this->page->render ();
		
		if ($this->templatePage !== null) {
			$this->renderParagraphStreamTemplates ();
		}
		
		$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $this->page->nextScheduledChange );
		
		$this->appendPageIncludes ();
		
		$this->setMiscellaneous ();
		
		if ($settings->contentshowbreadcrumbs) {
			$this->template->assign ( 'breadcrumbs', NGRenderBreadcrumbs::render ( $this->page->parentUID, $this->previewMode ) );
		}
		
		if ($settings->contentsubnav != '') {
			$this->renderSubNav ( $settings->contentsubnav );
		}
		
		if ($settings->eyecatchervisible && $settings->eyecatcherpicture != '') {
			$nglink = new NGLink ( false );
			$this->template->assign ( 'eyecatchersource', $nglink->getPictureURL ( $settings->eyecatcherpicture, $settings->width - $settings->eyecatcherExtraWidth (), - 1, NGPicture::RatioNone ) );
		}
		
		$this->template->assign ( 'choosevisible', $settings->choosevisible );
		$this->template->assign ( 'navshownav', $settings->navshownav );
		
		if ($settings->searchvisible) {
			$this->setSearch ();
		}
		
		if ($settings->commonvisible) {
			
			if ($settings->commonstyle === 'pages') {
				$this->createCommonNavPages ();
			}
			if ($settings->commonstyle === 'folderspages') {
				$this->createCommonNavTopics ();
			}
		}
		
		$this->appendWebFonts ();
		
		$this->setDefaultVariables ();
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginlayout/ngpluginlayoutphone/tpl/layout.tpl' );
        if (NGSettingsSite::getInstance()->compress) $this->output=NGUtil::compressHTML($this->output);
	
	}
	
	private function renderNav() {
		$containsHome = false;
		
		$root = NGSession::getInstance ()->getNavRootHome ()->findByUID ( $this->page->parentUID );
		
		$navItems = Array ();
		
		if ($root != null) {
			
			foreach ( $root->children as $navItem ) {
				$navItems [] = $navItem;
			}
			
			if ($root->parent != null) {
				if ($root->parent->objectUID != NGUtil::ObjectUIDRootContent) {
					
					if ($root->parent->objectUID == NGUtil::ObjectUIDRootHome) {
						array_unshift ( $navItems, $root->parent );
						$containsHome = true;
					} else {
						$navItems [] = $root->parent;
					}
				}
			}
		}
		
		if (! $containsHome)
			array_unshift ( $navItems, NGSession::getInstance ()->getNavRootHome () );
		
		$this->template->assign ( 'nav', $navItems );
	
	}
	
	private function createCommonNavTopics() {
		/* @var $standardTopics NGSettingsStandardTopics */
		$standardTopics = $this->adapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
		if (! array_key_exists ( 'common', $standardTopics->topicuids ))
			return false;
		
		$topics = $this->adapter->loadChildObjects ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
		
		/* @var $parenttopic NGTopic  */
		$parenttopic = $this->adapter->loadObject ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
		
		$topics = NGUtil::sortItems ( $topics, $parenttopic->sortManualTopics );
		
		$items = Array ();
		
		foreach ( $topics as $topic ) {
			
			/* @var $topic NGFolder */
			
			$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $topic->nextVisibilityChange () );
			
			if ($topic->isVisible ()) {
				
				$item = new NGCommonTopic ( $topic->caption );
				
				$pages = $this->adapter->loadChildObjects ( $topic->objectUID, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage );
				
				$pages = NGUtil::sortItems ( $pages, $topic->sortManualPages );
				
				foreach ( $pages as $page ) {
					if ($page->isVisible ()) {
						$link = new NGLink ( $this->previewMode );
						$link->uid = $page->objectUID;
						$link->linkType = NGLink::LinkPage;
						$item->pages [] = new NGCommonPage ( $page->caption, $link->getUrl () );
					}
					$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $page->nextVisibilityChange () );
				}
				
				if (count ( $item->pages ) > 0 )
					$items [] = $item;
			}
		}
		
		if (count ( $items ) > 0) {
			$this->template->assign ( 'commontopics', $items );
		}
	
	}
	
	public function createCommonNavPages() {
		try {
			
			/* @var $standardTopics NGSettingsStandardTopics */
			$standardTopics = $this->adapter->loadSetting ( NGSettingsStandardTopics::IdTopics, NGSettingsStandardTopics::ObjectTypeSettingsStandardTopics );
			if (! array_key_exists ( 'common', $standardTopics->topicuids ))
				return false;
			
			$childs = $this->adapter->loadChildObjects ( $standardTopics->topicuids ['common'], NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage );
			
			$topic = $this->adapter->loadObject ( $standardTopics->topicuids ['common'], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
			
			$childs = NGUtil::sortItems ( $childs, $topic->sortManualPages );
			
			$items = Array ();
			
			foreach ( $childs as $child ) {
				/* @var $child NGPluginPage */
				if ($child->isVisible ()) {
					$link = new NGLink ( $this->previewMode );
					$link->uid = $child->objectUID;
					$link->linkType = NGLink::LinkPage;
					$items [] = new NGCommonPage ( $child->caption, $link->getURL () );
				}
				$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $child->nextVisibilityChange () );
			}
			
			if (count ( $items ) > 0) {
				$this->template->assign ( 'commonpages', $items );
			}
		
		} catch ( Exception $ex ) {
		}
	}
}

class NGCommonPage {
	public $caption;
	public $link;
	
	public function __construct($caption, $link) {
		$this->caption = $caption;
		$this->link = $link;
	}
}

class NGCommonTopic {
	public $caption;
	public $pages;
	
	public function __construct($caption) {
		$this->caption = $caption;
		$this->pages = Array ();
	}
}