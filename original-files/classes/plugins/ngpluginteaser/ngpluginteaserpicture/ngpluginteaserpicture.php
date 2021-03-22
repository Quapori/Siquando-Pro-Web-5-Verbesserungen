<?php

class NGPluginTeaserPicture extends NGPluginTeaser {
	
	const Product = 'SIQUANDO Pro 5';
	
	private $gutter;
	private $bordercolor;
	private $borderwidth;
	private $columns;
	private $picturewidth;
	private $bordercolorhover;
	private $gutterPercent;
	private $picturePercent;
	
	public function render() {
		$this->columns = array_key_exists ( 'columns', $this->configuration ) ? intval ( $this->configuration ['columns'] ) : 4;
		$this->gutter = array_key_exists ( 'gutter', $this->configuration ) ? intval ( $this->configuration ['gutter'] ) : 5;
		$this->bordercolor = array_key_exists ( 'bordercolor', $this->configuration ) ? $this->configuration ['bordercolor'] : 'f0f0f0';
		$this->borderwidth = array_key_exists ( 'borderwidth', $this->configuration ) ? intval ( $this->configuration ['borderwidth'] ) : 1;
		$this->bordercolorhover = array_key_exists ( 'bordercolorhover', $this->configuration ) ? $this->configuration ['bordercolorhover'] : '666666';
		
		$renderWidth = $this->renderWidth;
				
		$totalWidth = $renderWidth - (($this->columns - 1) * $this->gutter);
		$this->pictureWidth = floor ( $totalWidth / $this->columns ) - 2 * $this->borderwidth;
		
		if ($this->responsive && $this->pictureWidth < 512)
			$this->pictureWidth = 512;
		
		$this->gutterPercent=$this->gutter*0.1;
		$this->picturePercent=(100- (($this->columns-1)*$this->gutterPercent))/$this->columns;
		$this->picturePercentTwo=(100- $this->gutterPercent)/2;
		
		$i = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$picture = $item->displayPicture ();
			
			if ($picture != null) {
				
				$teaserItem = new NGPluginTeaserItem ();
				$teaserItem->link = $item->displayLink ();
				$teaserItem->caption = $item->displayCaption ();
				
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
				$teaserItem->picturesize = $picture->getResizedSize ( $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
				
				$teaserItem->margintop = ($i>= $this->columns) ? $this->gutter : 0;
				$teaserItem->marginleft = ($i % $this->columns == 0) ? 0 : $picture->marginleft = $this->gutter;
				
				$this->teaserItems [] = $teaserItem;
				
				$i ++;
			}
		}
		
		$template = new NGTemplate ();
		
		$template->assign ( 'items', $this->teaserItems );
		$template->assign ( 'picturewidth', $this->picturePercent );
		$template->assign ( 'picturewidthtwo', $this->picturePercentTwo );
		$template->assign ( 'columns', $this->columns );
		$template->assign ( 'gutter', $this->gutterPercent );
		$template->assign ( 'responsive', $this->responsive );
		$template->assign ( 'uid', $this->objectUID );
		$template->assign ( 'borderwidth', $this->borderwidth );
		$template->assign ( 'bordercolor', $this->bordercolor );
		$template->assign ( 'bordercolorhover', $this->bordercolorhover );

        if (NGSettingsSite::getInstance()->lazyload)
            $template->assign('lazyload', NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/img/trans.gif'));

        $this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpicture/tpl/template.tpl' );
		$this->styles = Array ('NGPluginTeaserP' . $this->objectUID => $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpicture/tpl/css.tpl' ) );
		$this->styleSheets = Array ('NGPluginTeaserP' => $this->prependPluginsPath ( 'ngpluginteaserpicture/css/style.css' ) );
	}
}