<?php

class NGPluginLayoutFlex extends NGPluginLayout {
	
	public function render() {
		
		$this->appendDefaultIncludes ();
		
		$this->styleSheets ['layout'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/ngpluginlayoutflex/css/' );
		
		$this->page->previewMode = $this->previewMode;
		
		$this->page->prepare ();
		
		$this->topic = $this->adapter->loadObject ( $this->page->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic, '', true );
		
		$this->getTemplatePage ();
		
		if ($this->templatePage !== null) {
			$this->templatePage->previewMode = $this->previewMode;
			$this->templatePage->prepare ();
		}
		
		/* @var $settings NGPluginLayoutFlexSettings */
		$settings = $this->adapter->loadSetting ( NGPluginLayoutFlexSettings::IdLayoutFlex, NGPluginLayoutFlexSettings::ObjectTypePluginLayoutFlexSettings );
		
		if (! $settings->leftvisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible = false;
		if (! $settings->rightvisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible = false;
		if (! $settings->footervisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->isVisible = false;
		if (! $settings->headervisible)
			$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->isVisible = false;
		
		$navVisible = $settings->navvisible ? $this->renderNavigationPlugin ( $settings->navnavigationhorizontal, 'nav', $settings->width - $settings->navExtraWidth () ) : false;
		$navleftVisible = $settings->navleftvisible ? $this->renderNavigationPlugin ( $settings->navleftnavigationvertical, 'navleft', $settings->navleftwidth ) : false;
		$navrightVisible = $settings->navrightvisible ? $this->renderNavigationPlugin ( $settings->navrightnavigationvertical, 'navright', $settings->navrightwidth ) : false;
		$commonVisible = $settings->commonvisible ? $this->renderNavigationPlugin ( $settings->commonnavigationcommon, 'common', $settings->width - $settings->commonExtraWidth () ) : false;
		$eyecatcherVisible = ($settings->eyecatchervisible && !$this->topic->hideeyecatcher) ? $this->renderEyecatcherPlugin ( $settings->eyecatchereyecatcher, 'eyecatcher', $settings->width - $settings->eyecatcherExtraWidth () ) : false;
		$logoleftvisible = $settings->logoleftvisible ? $this->renderLogo ( $settings->logoleftlogo, 'logoleft', $settings->logoleftwidth ) : false;
		$logorightvisible = $settings->logorightvisible ? $this->renderLogo ( $settings->logorightlogo, 'logoright', $settings->logorightwidth ) : false;
		
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = $settings->leftwidth;
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = $settings->rightwidth;
		
		$leftwidth = 0;
		$navleftwidth = 0;
		$searchleftwidth = 0;
		$logoleftwidth = 0;
		$rightwidth = 0;
		$navrightwidth = 0;
		$logorightwidth = 0;
		$searchrightwidth = 0;
		
		if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible === true)
			$leftwidth = $settings->leftTotalWidth ();
		if ($this->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible === true)
			$rightwidth = $settings->rightTotalWidth ();
		if ($navleftVisible)
			$navleftwidth = $settings->navleftTotalWidth ();
		if ($navrightVisible)
			$navrightwidth = $settings->navrightTotalWidth ();
		if ($settings->searchleftvisible)
			$searchleftwidth = $settings->searchleftTotalWidth ();
		if ($settings->searchrightvisible)
			$searchrightwidth = $settings->searchrightTotalWidth ();
		if ($logoleftvisible)
			$logoleftwidth = $settings->logoleftTotalWidth ();
		if ($logorightvisible)
			$logorightwidth = $settings->logorightTotalWidth ();
		
		$containerleftwidth = max ( $leftwidth, $navleftwidth, $searchleftwidth, $logoleftwidth );
		$containerrightwidth = max ( $rightwidth, $navrightwidth, $searchrightwidth, $logorightwidth );
		
		$this->template->assign ( 'containerleftwidth', $containerleftwidth );
		$this->template->assign ( 'containerrightwidth', $containerrightwidth );
		
		$this->template->assign ( 'navposition', $settings->navposition );
		$this->template->assign ( 'navvisible', $navVisible );
		$this->template->assign ( 'captionposition', $settings->captionposition );
		$this->template->assign ( 'commonvisible', $commonVisible );
		$this->template->assign ( 'previewmode', $this->previewMode );
		$this->template->assign ( 'navleftvisible', $navleftVisible );
		$this->template->assign ( 'navrightvisible', $navrightVisible );
		$this->template->assign ( 'logoleftvisible', $logoleftvisible );
		$this->template->assign ( 'logorightvisible', $logorightvisible );
		$this->template->assign ( 'searchleftvisible', $settings->searchleftvisible );
		$this->template->assign ( 'searchrightvisible', $settings->searchrightvisible );
		$this->template->assign ( 'eyecatchervisible', $eyecatcherVisible );
		$this->template->assign ( 'lang', NGSession::getInstance ()->getLanguageRessource ( NGUtil::LanguageResourcesMain ) );
		
		$contentwidth = $settings->width - $settings->contentExtraWidth () - $settings->containermainExtraWidth ();
		
		if ($containerleftwidth > 0)
			$contentwidth -= ($settings->containerleftExtraWidth () + $containerleftwidth);
		if ($containerrightwidth > 0)
			$contentwidth -= ($settings->containerrightExtraWidth () + $containerrightwidth);
		
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = $contentwidth;
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $settings->width - $settings->headerExtraWidth ();
		$this->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $settings->width - $settings->footerExtraWidth ();
		
		$this->template->assign ( 'containermainfauxcolumns', $this->createFauxColumns ( $settings, $containerleftwidth, $containerrightwidth ) );
		
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
		
		if ($settings->searchleftvisible || $settings->searchrightvisible) {
			$this->setSearch ();
		}
		
		$this->appendWebFonts ();
		
		$this->setDefaultVariables ();
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginlayout/ngpluginlayoutflex/tpl/layout.tpl' );

        if (NGSettingsSite::getInstance()->compress) $this->output=NGUtil::compressHTML($this->output);
		
		$this->prepareFTS ();
	}
	
	/**
	 * 
	 * Produce the faux columns image
	 * @param unknown_type $settings
	 * @param unknown_type $leftwidth
	 * @param unknown_type $rightwidth
	 */
	private function createFauxColumns($settings, $leftwidth, $rightwidth) {
		$script = '';
		
		$padding = new NGMargin ( $settings->containermainpadding );
		$border = new NGMargin ( $settings->containermainborderwidth );
		$margin = new NGMargin ( $settings->containermainmargin );
		$totalwidth = $settings->width - $margin->totalWidth () - $border->totalWidth ();
		
		if ($leftwidth > 0) {
			$totalleftwidth = $leftwidth + $settings->containerleftExtraWidth ();
			$totalleftwidth += (($padding->individualMargins ()) ? $padding->left : $padding->all);
			if ($settings->containerleftfill != '') {
				$script .= sprintf ( 'p%s', $settings->containerleftfill );
				$script .= sprintf ( 'l%ut%u', 0, $totalleftwidth - 1 );
			}
			if ($settings->containerleftedge != '') {
				$script .= sprintf ( 'p%s', $settings->containerleftedge );
				$script .= sprintf ( 'l%ut%u', $totalleftwidth, $totalleftwidth );
			}
		}
		
		if ($rightwidth > 0) {
			$totalrightwidth = $rightwidth + $settings->containerrightExtraWidth ();
			$totalrightwidth += (($padding->individualMargins ()) ? $padding->right : $padding->all);
			if ($settings->containerrightfill != '') {
				$script .= sprintf ( 'p%s', $settings->containerrightfill );
				$script .= sprintf ( 'l%ut%u', $totalwidth - $totalrightwidth, $totalwidth );
			}
			if ($settings->containerrightedge != '') {
				$script .= sprintf ( 'p%s', $settings->containerrightedge );
				$script .= sprintf ( 'l%ut%u', $totalwidth - $totalrightwidth - 1, $totalwidth - $totalrightwidth - 1 );
			}
		}
		
		if ($script != '') {
			$script = NGUtil::prependImagesPath ( sprintf ( 'divider/?w=%u&s=%s', $totalwidth, $script ) );
		}
		
		return $script;
	}
	
	private function renderLogo($uid, $target, $width) {
		$pictureAdapter = new NGDBAdapterObject ();
		
		/* @var $picture NGPicture */
		$picture = $pictureAdapter->loadObject ( $uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($picture != null) {
			
			$size = $picture->getResizedSize ( $width, - 1 );
			
			$this->template->assign ( $target . 'source', NGLink::getPictureURL ( $uid, $size->width, $size->height ) );
			$this->template->assign ( $target . 'width', $size->width );
			$this->template->assign ( $target . 'height', $size->height );
			$this->template->assign ( $target . 'link', NGLink::getLinkToHome ( $this->previewMode ) );
			return true;
		} else {
			return false;
		}
	}
	
	private function renderNavigationPlugin($setting, $targetDiv, $renderWidth) {
		/* @var $nav NGPluginNavigation */
		$nav = NGPluginNavigation::createBySetting ( $setting );
		$nav->targetDIV = $targetDiv;
		$nav->currentPage = $this->page;
		$nav->previewMode = $this->previewMode;
		$nav->renderWidth = $renderWidth;
		$nav->render ();
		$this->template->assign ( $targetDiv, $nav );
		
		foreach ( $nav->styleSheets as $id => $stylesheet ) {
			if (! array_key_exists ( $id, $this->styleSheets ))
				$this->styleSheets [$id] = $stylesheet;
		}
		foreach ( $nav->styles as $id => $style ) {
			if (! array_key_exists ( $id, $this->styles ))
				$this->styles [$id] = $style;
		}
		foreach ( $nav->javaScripts as $id => $javaScript ) {
			if (! array_key_exists ( $id, $this->javaScripts ))
				$this->javaScripts [$id] = $javaScript;
		}
		
		$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $nav->nextScheduledChange );
		
		return ! $nav->isEmpty;
	}
	
	private function renderEyecatcherPlugin($setting, $targetDiv, $renderWidth) {
		/* @var $eyecatcher NGPluginEyecatcher */
		$eyecatcher = NGPluginEyecatcher::createBySetting ( $setting );
		$eyecatcher->targetDIV = $targetDiv;
		$eyecatcher->currentPage = $this->page;
		$eyecatcher->currentTopic = $this->topic;
		$eyecatcher->previewMode = $this->previewMode;
		$eyecatcher->renderWidth = $renderWidth;
		$eyecatcher->render ();
		$this->template->assign ( $targetDiv, $eyecatcher );
		
		foreach ( $eyecatcher->styleSheets as $id => $stylesheet ) {
			if (! array_key_exists ( $id, $this->styleSheets ))
				$this->styleSheets [$id] = $stylesheet;
		}
		foreach ( $eyecatcher->styles as $id => $style ) {
			if (! array_key_exists ( $id, $this->styles ))
				$this->styles [$id] = $style;
		}
		foreach ( $eyecatcher->javaScripts as $id => $javaScript ) {
			if (! array_key_exists ( $id, $this->javaScripts ))
				$this->javaScripts [$id] = $javaScript;
		}
		
		$this->nextScheduledChange = NGUtil::nextDate ( $this->nextScheduledChange, $eyecatcher->nextScheduledChange );
		
		return ! $eyecatcher->isEmpty;
	}

}