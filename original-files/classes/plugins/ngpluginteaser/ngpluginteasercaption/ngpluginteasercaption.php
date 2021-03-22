<?php

class NGPluginTeaserCaption extends NGPluginTeaser {
	
	const Product = 'SIQUANDO Pro 5';
	
	public function render() {
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			$teaserItem = new NGPluginTeaserItem();
			$teaserItem->caption = $item->displayCaption ();
			$teaserItem->link = $item->displayLink ();			
			$this->teaserItems [] = $teaserItem;
		}
		
		$template = new NGTemplate ();
		
		$template->assign ( 'items', $this->teaserItems );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteasercaption/tpl/template.tpl' );
	}
}