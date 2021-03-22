<?php

class NGPluginTeaserCaptionSummaryPicture extends NGPluginTeaser {
	const Product = 'SIQUANDO Pro 5';

	private $pictureWidth;

	private $bordercolor;

	private $borderwidth;

	private $pictureSize;

	private $picturePercent;

	/**
	 *
	 * Language resources
	 * 
	 * @var NGLanguageAdapter
	 */
	private $lang = null;

	/**
	 *
	 * Show more
	 * 
	 * @var bool
	 */
	private $showmore = false;

	public function render() {
		$richtext = new NGRichText ();
		$richtext->previewMode = $this->previewMode;
		
		$renderWidth = $this->renderWidth;
		
		
		$this->pictureSize = array_key_exists ( 'picturesize', $this->configuration ) ? intval ( $this->configuration ['picturesize'] ) : 2;
		$this->picturePercent = 100 * ((1 + $this->pictureSize) / 15);
		$this->pictureWidth = floor ( $renderWidth * $this->picturePercent / 100 );
		$this->bordercolor = array_key_exists ( 'bordercolor', $this->configuration ) ? $this->configuration ['bordercolor'] : 'f0f0f0';
		$this->borderwidth = array_key_exists ( 'borderwidth', $this->configuration ) ? intval ( $this->configuration ['borderwidth'] ) : 1;
		
		if ($this->lang === null) {
			$this->lang = new NGLanguageAdapter ();
			$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphteaser/language/langteaser.xml';
			$this->lang->load ();
		}
		
		$this->showmore = array_key_exists ( 'showmore', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['showmore'] ) : false;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$teaserItem = new NGPluginTeaserItem ();
			$teaserItem->caption = $item->displayCaption ();
			$teaserItem->summary = $richtext->parse ( $item->displaySummary () );
			$teaserItem->link = $item->displayLink ();
			$picture = $item->displayPicture ();
			
			if ($picture != null) {
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
				$teaserItem->picturesize = $picture->getResizedSize ( $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
			} else {
				$teaserItem->picturesource = '';
			}
			
			$this->teaserItems [] = $teaserItem;
		}
		
		$template = new NGTemplate ();
		
		$template->assign ( 'items', $this->teaserItems );
		$template->assign ( 'picturepercent', $this->picturePercent );
		$template->assign ( 'uid', $this->objectUID );
		$template->assign ( 'borderwidth', $this->borderwidth );
		$template->assign ( 'bordercolor', $this->bordercolor );
		$template->assign ( 'lang', $this->lang->languageResources );
		$template->assign ( 'showmore', $this->showmore );

        if (NGSettingsSite::getInstance ()->lazyload)
            $template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteasercaptionsummarypicture/tpl/template.tpl' );
		$this->styles = Array (
				'NGPluginTeaserCSP' . $this->objectUID => $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteasercaptionsummarypicture/tpl/css.tpl' ) 
		);
		$this->styleSheets = Array (
				'NGPluginTeaserCSP' => $this->prependPluginsPath ( 'ngpluginteasercaptionsummarypicture/css/style.css' ) 
		);
	}
}