<?php

class NGPluginTeaserWow extends NGPluginTeaser {
	const Product = 'SIQUANDO Pro 5';

	private $columns;

	private $picturewidth;

	private $foreground;

	private $background;

	private $fade;

	private $crop;

	private $circle;

	public function render() {
				
		$this->columns = array_key_exists ( 'columns', $this->configuration ) ? intval ( $this->configuration ['columns'] ) : 3;
		$this->foreground = array_key_exists ( 'foreground', $this->configuration ) ? $this->configuration ['foreground'] : 'ffffff';
		$this->background = array_key_exists ( 'background', $this->configuration ) ? $this->configuration ['background'] : '555555';
		$this->fade = array_key_exists ( 'fade', $this->configuration ) ? $this->configuration ['fade'] : '000000';
		$this->crop = array_key_exists ( 'crop', $this->configuration ) ? $this->configuration ['crop'] : 'Ratio1by1';
		$this->circle = array_key_exists ( 'circle', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['circle'] ) : false;
				
		$pictureWidth = floor ( $this->renderWidth / $this->columns );
		$ratio = NGPicture::stringToRatio ( $this->crop );
		
		if ($this->responsive && $pictureWidth < 512)
			$pictureWidth = 512;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$teaserItem = new NGPluginTeaserItem ();
			$teaserItem->link = $item->displayLink ();
			$teaserItem->caption = $item->displayCaption ();
			
			$picture = $item->displayPicture ();
			
			if ($picture != null) {
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $pictureWidth, - 1, $ratio );
				$teaserItem->picturesize = $picture->getResizedSize ( $pictureWidth, - 1, $ratio );
			}
			
			$this->teaserItems [] = $teaserItem;
		}
		
		$template = new NGTemplate ();
		
		$template->assign ( 'items', $this->teaserItems );
		$template->assign ( 'foreground', $this->foreground );
		$template->assign ( 'background', $this->background );
		$template->assign ( 'fade', $this->fade );
		$template->assign ( 'crop', strtolower ( $this->crop ) );
		$template->assign ( 'circle', $this->circle && $ratio===NGPicture::Ratio1by1 );
		$template->assign ( 'cols', $this->columns );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaserwow/tpl/template.tpl' );
		$this->styleSheets ['NGPluginTeaserWow'] = $this->prependPluginsPath ( 'ngpluginteaserwow/css/style.css' );
	}
}