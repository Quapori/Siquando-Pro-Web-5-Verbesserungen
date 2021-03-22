<?php

class NGPluginTeaserCaptionSummary extends NGPluginTeaser {	
	
	const Product = 'SIQUANDO Pro 5';
	
	/**
	 * 
	 * Language resources
	 * @var NGLanguageAdapter
	 */
	private $lang = null;
	
	/**
	 * 
	 * Show more
	 * @var bool
	 */
	private $showmore = false;
	
	public function render() {
		
		$richtext=new NGRichText();
		$richtext->previewMode=$this->previewMode;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$teaserItem = new NGPluginTeaserItem();
			$teaserItem->caption = $item->displayCaption ();
			$teaserItem->summary = $richtext->parse($item->displaySummary ());
			$teaserItem->link = $item->displayLink ();			
			$this->teaserItems [] = $teaserItem;
		}
		
		if ($this->lang===null)
		{
			$this->lang = new NGLanguageAdapter ();
			$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphteaser/language/langteaser.xml';
			$this->lang->load ();
		}
		
		$this->showmore = array_key_exists ( 'showmore', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['showmore'] ) : false;		
		
		$template = new NGTemplate ();
		
		$template->assign ( 'items', $this->teaserItems );
		$template->assign ( 'lang', $this->lang->languageResources );
		$template->assign ( 'showmore', $this->showmore );

		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteasercaptionsummary/tpl/template.tpl' );
		$this->styleSheets = Array ('NGPluginTeaserCS' => $this->prependPluginsPath ( 'ngpluginteasercaptionsummary/css/style.css' ) );	
	}
}