<?php

class NGPluginTeaserPictureCaption extends NGPluginTeaser {
	const Product = 'SIQUANDO Pro 5';

	private $gutter;

	private $bordercolor;

	private $borderwidth;

	private $foreground;

	private $background;

	private $columns;

	private $picturewidth;

	private $bordercolorhover;

	private $foregroundhover;

	private $backgroundhover;

	private $gutterPercent;

	private $picturePercent;

	public function render() {
		$this->columns = array_key_exists ( 'columns', $this->configuration ) ? intval ( $this->configuration ['columns'] ) : 4;
		$this->gutter = array_key_exists ( 'gutter', $this->configuration ) ? intval ( $this->configuration ['gutter'] ) : 5;
		$this->bordercolor = array_key_exists ( 'bordercolor', $this->configuration ) ? $this->configuration ['bordercolor'] : 'f0f0f0';
		$this->borderwidth = array_key_exists ( 'borderwidth', $this->configuration ) ? intval ( $this->configuration ['borderwidth'] ) : 1;
		$this->foreground = array_key_exists ( 'foreground', $this->configuration ) ? $this->configuration ['foreground'] : 'ffffff';
		$this->background = array_key_exists ( 'background', $this->configuration ) ? $this->configuration ['background'] : '000000';
		$this->bordercolorhover = array_key_exists ( 'bordercolorhover', $this->configuration ) ? $this->configuration ['bordercolorhover'] : '666666';
		$this->foregroundhover = array_key_exists ( 'foregroundhover', $this->configuration ) ? $this->configuration ['foregroundhover'] : 'ffffff';
		$this->backgroundhover = array_key_exists ( 'backgroundhover', $this->configuration ) ? $this->configuration ['backgroundhover'] : '666666';
		
		$renderWidth = $this->renderWidth;
				
		$totalWidth = $renderWidth - (($this->columns - 1) * $this->gutter);
		$this->pictureWidth = floor ( $totalWidth / $this->columns ) - 2 * $this->borderwidth;
		
		if ($this->responsive && $this->pictureWidth < 512)
			$this->pictureWidth = 512;
		
		$this->gutterPercent = $this->gutter * 0.1;
		$this->picturePercent = (100 - (($this->columns - 1) * $this->gutterPercent)) / $this->columns;
		$this->picturePercentTwo = (100 - $this->gutterPercent) / 2;
		
		$i = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$picture = $item->displayPicture ();
			
			if ($picture != null) {
				
				$teaserItem = new NGPluginTeaserItem ();
				$teaserItem->caption = $item->displayCaption ();
				$teaserItem->link = $item->displayLink ();
				
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
				$teaserItem->picturesize = $picture->getResizedSize ( $this->pictureWidth, $this->pictureWidth, NGPicture::Ratio1by1 );
				
				$teaserItem->margintop = ($i >= $this->columns) ? $this->gutter : 0;
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
		$template->assign ( 'uid', $this->objectUID );
		$template->assign ( 'borderwidth', $this->borderwidth );
		$template->assign ( 'bordercolor', $this->bordercolor );
		$template->assign ( 'foreground', $this->foreground );
		$template->assign ( 'background', $this->background );
		$template->assign ( 'bordercolorhover', $this->bordercolorhover );
		$template->assign ( 'foregroundhover', $this->foregroundhover );
		$template->assign ( 'backgroundhover', $this->backgroundhover );
		$template->assign ( 'responsive', $this->responsive );

        if (NGSettingsSite::getInstance ()->lazyload)
            $template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpicturecaption/tpl/template.tpl' );
		$this->styles = Array (
				'NGPluginTeaserPC' . $this->objectUID => $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserpicturecaption/tpl/css.tpl' ) 
		);
		$this->styleSheets = Array (
				'NGPluginTeaserPC' => $this->prependPluginsPath ( 'ngpluginteaserpicturecaption/css/style.css' ) 
		);
	}
}