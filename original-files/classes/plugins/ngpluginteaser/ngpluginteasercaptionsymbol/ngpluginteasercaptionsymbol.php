<?php

class NGPluginTeaserCaptionSymbol extends NGPluginTeaser {
	
	const Product = 'SIQUANDO Pro 5';

	private $icon=null;

	private $columns;

	private $fontsize;

	private $color;

	private $colorhover;

	private $pictures;

	private $icons;

	private $circle;

	private $align;
	
	public function render() {

        $this->columns = array_key_exists('columns', $this->configuration) ? intval($this->configuration ['columns']) : 3;
        $this->fontsize = array_key_exists('fontsize', $this->configuration) ? intval($this->configuration ['fontsize']) : 150;
        $this->color = array_key_exists('color', $this->configuration) ? $this->configuration ['color'] : 'a9a9a9';
        $this->colorhover = array_key_exists('colorhover', $this->configuration) ? $this->configuration ['colorhover'] : '696969';
        $this->icons = array_key_exists('icons', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['icons']) : true;
        $this->pictures = array_key_exists('pictures', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['pictures']) : false;
        $this->circle = array_key_exists('circle', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['circle']) : true;
        $this->align = array_key_exists('align', $this->configuration) ? $this->configuration ['align'] : 'center';

		foreach ( $this->bouquet->items as $item ) {

			/* @var $item NGBouquetItem */
			$teaserItem = new NGPluginTeaserItem();
			$teaserItem->caption = $item->displayCaption ();
			$teaserItem->link = $item->displayLink ();

			if ($this->icons) {
                if ($item->item->class === NGTopic::ObjectTypeTopic) {
                    if ($item->item->icon !== '') {

                        if ($this->icon === null) {
                            $this->icon = new NGPluginIcon();
                            $this->icon->class = 'ngteasercaptionsymbolsymbol';
                        }

                        $teaserItem->icon = $this->icon->getSvg($item->item->icon);
                    }
                }
            }

            if ($this->pictures &&  !isset($teaserItem->icon) ) {
                $picture = $item->displayPicture();
                if ($picture != null) {
                    $teaserItem->picturesource = NGLink::getPictureURL($picture->objectUID, 128, 128, NGPicture::Ratio1by1);
                }
            }


            $this->teaserItems [] = $teaserItem;


		}
		
		$template = new NGTemplate ();

        $template->assign ( 'columns', $this->columns );
		$template->assign ( 'items', $this->teaserItems );
        $template->assign ( 'uid', $this->objectUID );
        $template->assign ( 'fontsize', $this->fontsize );
        $template->assign ( 'color', $this->color );
        $template->assign ( 'colorhover', $this->colorhover );
        $template->assign ( 'circle', $this->circle );
        $template->assign ( 'align', $this->align );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteasercaptionsymbol/tpl/template.tpl' );
        $this->styleSheets ['NGPluginTeaserCaptionSymbol'] = $this->prependPluginsPath('ngpluginteasercaptionsymbol/css/style.css');
        $this->styles ['NGPluginTeaserCSY' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginteaser/ngpluginteasercaptionsymbol/tpl/css.tpl');
	}
}