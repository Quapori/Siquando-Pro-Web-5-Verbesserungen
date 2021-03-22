<?php

class NGPluginTeaserPictureBand extends NGPluginTeaser {
	
	const Product = 'SIQUANDO Pro 5';
	
	private $columns;
	private $cropratio;
	private $colorborder;
	private $colorbuttons;
	private $colorbuttonshover;
	private $colorbackgroundcaption;
	private $colorbackgroundcaptionhover;
	private $colortextcaption;
	private $darkarrows;
	
	private $pictureWidth;
	private $pictureHeight;
	private $stageWidth;
	private $buttonWidth = 32;
	
	public function render() {
		$this->columns = array_key_exists ( 'columns', $this->configuration ) ? intval ( $this->configuration ['columns'] ) : 3;
		$this->cropratio = array_key_exists ( 'cropratio', $this->configuration ) ? NGPicture::stringToRatio ( $this->configuration ['cropratio'] ) : NGPicture::Ratio1by1;
		$this->colorborder = array_key_exists ( 'colorborder', $this->configuration ) ? $this->configuration ['colorborder'] : 'e0e0e0';
		$this->colorbuttons = array_key_exists ( 'colorbuttons', $this->configuration ) ? $this->configuration ['colorbuttons'] : 'e0e0e0';
		$this->colorbuttonshover = array_key_exists ( 'colorbuttonshover', $this->configuration ) ? $this->configuration ['colorbuttonshover'] : 'd8d8d8';
		$this->colorbackgroundcaption = array_key_exists ( 'colorbackgroundcaption', $this->configuration ) ? $this->configuration ['colorbackgroundcaption'] : 'f8f8f8';
		$this->colorbackgroundcaptionhover = array_key_exists ( 'colorbackgroundcaptionhover', $this->configuration ) ? $this->configuration ['colorbackgroundcaptionhover'] : 'f0f0f0';
		$this->colortextcaption = array_key_exists ( 'colortextcaption', $this->configuration ) ? $this->configuration ['colortextcaption'] : '444444';
		$this->darkarrows = array_key_exists ( 'darkarrows', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['darkarrows'] ) : false;
		
		$this->stageWidth = $this->renderWidth - $this->buttonWidth - 2;
		$this->pictureWidth = floor ( $this->stageWidth / $this->columns ) - 1;
		$this->stageWidth = ($this->pictureWidth + 1) * $this->columns + $this->buttonWidth-1;
		$this->pictureHeight = ceil ( $this->pictureWidth / NGPicture::ratioByRatioType ( $this->cropratio ) );
		
		$count = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$picture = $item->displayPicture ();
			
			if ($picture != null) {
				
				$teaserItem = new NGPluginTeaserItem ();
				$teaserItem->link = $item->displayLink ();
				$teaserItem->caption = $item->displayCaption ();
				
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $this->pictureWidth, $this->pictureHeight, $this->cropratio );
				
				$this->teaserItems [] = $teaserItem;
				
				$count ++;
			}
		}
		
		if ($count > $this->columns) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'items', $this->teaserItems );
			$template->assign ( 'stagewidth', $this->stageWidth );
			$template->assign ( 'bandwidth', ($this->pictureWidth + 1) * $count );
			$template->assign ( 'picturewidth', $this->pictureWidth );
			$template->assign ( 'pictureheight', $this->pictureHeight );
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'colorborder', $this->colorborder );
			$template->assign ( 'colorbuttons', $this->colorbuttons );
			$template->assign ( 'colorbuttonshover', $this->colorbuttonshover );
			$template->assign ( 'colorbackgroundcaption', $this->colorbackgroundcaption );
			$template->assign ( 'colorbackgroundcaptionhover', $this->colorbackgroundcaptionhover );
			$template->assign ( 'colortextcaption', $this->colortextcaption );
			$template->assign ( 'darkarrows', $this->darkarrows );
			$template->assign ( 'ratio', NGPicture::ratioByRatioType ( $this->cropratio ) );
			$template->assign ( 'columns', $this->columns );
			$template->assign ( 'responsive', $this->responsive );
			
			$picture = $this->darkarrows ? 'black' : 'white';
			
			$template->assign ( 'next', $this->prependPluginsPath ( 'ngpluginteaserpictureband/images/next' . $picture . '.svg' ) );
			$template->assign ( 'prev', $this->prependPluginsPath ( 'ngpluginteaserpictureband/images/prev' . $picture . '.svg' ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpictureband/tpl/template.tpl' );
			$this->styles = Array ('NGPluginTeaserPB' . $this->objectUID => $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpictureband/tpl/css.tpl' ) );
			$this->styleSheets = Array ('NGPluginTeaserPB' => $this->prependPluginsPath ( 'ngpluginteaserpictureband/css/style.css' ) );
			$this->javaScripts ['NGPluginTeaserPB'] = $this->prependPluginsPath ( 'ngpluginteaserpictureband/js/pictureband.js' );
			
			if ($this->allowMobileFullWidth) $this->renderMode=NGPluginParagraph::RenderModeMobileFullWidth;
		}
	}
}