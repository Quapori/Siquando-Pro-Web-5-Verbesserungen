<?php

class NGPluginTeaserAnimatedBox extends NGPluginTeaser {
	const Product = 'SIQUANDO Pro 5';

	private $infoonleft;

	private $opaque;

	private $opacity;

	private $infowidth;

	private $colorbackgroundcaption;

	private $colortextcaption;

	private $colorbackgroundcountdown;

	private $colorforegroundcountdown;

	private $colorborder;

	private $borderwidth;

	private $animateslide;

	private $delay;

	private $wideratio;

	private $stageWidth;

	private $stageHeight;

	private $pictureWidth;

	private $pictureWidthPercent;

	private $pictureRatio;

	private $pictureLeft;

	private $pictureLeftPercent;

	private $boxWidth;

	private $boxWidthPercent;

	private $boxLeft;

	private $boxLeftPercent;

	private $boxColor;

	private function infowidthtoratio($infowidth) {
		switch ($infowidth) {
			case 'small' :
				return 0.4;
			case 'large' :
				return 0.6;
			default :
				return 0.5;
		}
	}

	private function rgba($color, $opactiy) {
		$r = hexdec ( substr ( $color, 0, 2 ) );
		$g = hexdec ( substr ( $color, 2, 2 ) );
		$b = hexdec ( substr ( $color, 4, 2 ) );
		$a = $opactiy / 100;
		
		return sprintf ( 'rgba(%u,%u,%u,%.1F)', $r, $g, $b, $a );
	}

	public function render() {
		$richtext = new NGRichText ();
		$richtext->previewMode = $this->previewMode;
		
		$this->infoonleft = array_key_exists ( 'infoonleft', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['infoonleft'] ) : false;
		$this->opaque = array_key_exists ( 'opaque', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['opaque'] ) : false;
		$this->opacity = array_key_exists ( 'opacity', $this->configuration ) ? intval ( $this->configuration ['opacity'] ) : 70;
		$this->infowidth = array_key_exists ( 'infowidth', $this->configuration ) ? $this->configuration ['infowidth'] : 'medium';
		$this->colorbackgroundcaption = array_key_exists ( 'colorbackgroundcaptionib', $this->configuration ) ? $this->configuration ['colorbackgroundcaptionib'] : '000000';
		$this->colortextcaption = array_key_exists ( 'colortextcaptionib', $this->configuration ) ? $this->configuration ['colortextcaptionib'] : 'ffffff';
		$this->colorborder = array_key_exists ( 'colorborder', $this->configuration ) ? $this->configuration ['colorborder'] : '000000';
		$this->borderwidth = array_key_exists ( 'borderwidth', $this->configuration ) ? intval ( $this->configuration ['borderwidth'] ) : 1;
		$this->colorbackgroundcountdown = array_key_exists ( 'colorbackgroundcountdown', $this->configuration ) ? $this->configuration ['colorbackgroundcountdown'] : '000000';
		$this->colorforegroundcountdown = array_key_exists ( 'colorforegroundcountdown', $this->configuration ) ? $this->configuration ['colorforegroundcountdown'] : 'ffffff';
		$this->animateslide = array_key_exists ( 'animateslide', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['animateslide'] ) : false;
		$this->delay = array_key_exists ( 'delay', $this->configuration ) ? intval ( $this->configuration ['delay'] ) : 5;
		$this->wideratio = array_key_exists ( 'wideratio', $this->configuration ) ? NGUtil::StringXMLToBool ( $this->configuration ['wideratio'] ) : false;
		
		$this->stageWidth = $this->renderWidth - 2 * $this->borderwidth;
		
		$this->boxWidth = floor ( $this->stageWidth * $this->infowidthtoratio ( $this->infowidth ) );
		$this->boxWidthPercent = $this->infowidthtoratio ( $this->infowidth ) * 100;
		
		if ($this->infoonleft) {
			$this->boxLeft = 0;
			$this->boxLeftPercent = 0;
		} else {
			$this->boxLeft = $this->stageWidth - $this->boxWidth;
			$this->boxLeftPercent = 100 - $this->boxWidthPercent;
		}
		
		if ($this->opaque) {
			$this->pictureWidth = $this->stageWidth - $this->boxWidth;
			$this->pictureWidthPercent = 100 - $this->boxWidthPercent;
			
			if ($this->wideratio) {
				$this->stageHeight = ceil ( $this->pictureWidth * 3 / 4 );
				$this->pictureRatio = NGPicture::Ratio4by3;
			} else {
				$this->stageHeight = ceil ( $this->pictureWidth * 4 / 3 );
				$this->pictureRatio = NGPicture::Ratio3by4;
			}
			$this->boxColor = '#' . $this->colorbackgroundcaption;
			
			if ($this->infoonleft) {
				$this->pictureLeft = $this->stageWidth - $this->pictureWidth;
				$this->pictureLeftPercent = 100 - $this->pictureWidthPercent;
			} else {
				$this->pictureLeft = 0;
				$this->pictureLeftPercent = 0;
			}
		} else {
			if ($this->wideratio) {
				$this->stageHeight = ceil ( $this->stageWidth / 3 );
				$this->pictureRatio = NGPicture::Ratio3by1;
			} else {
				$this->stageHeight = ceil ( $this->stageWidth * 3 / 4 );
				$this->pictureRatio = NGPicture::Ratio4by3;
			}
			$this->pictureWidth = $this->stageWidth;
			$this->pictureWidthPercent = 100;
			$this->pictureLeft = 0;
			$this->pictureLeftPercent = 0;
			$this->boxColor = $this->rgba ( $this->colorbackgroundcaption, $this->opacity );
		}
		
		$i = 0;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$picture = $item->displayPicture ();
			
			if ($picture !== null) {
				
				$teaserItem = new NGPluginTeaserItem ();
				$teaserItem->link = $item->displayLink ();
				$teaserItem->caption = $item->displayCaption ();
				
				$teaserItem->picturesource = NGLink::getPictureURL ( $picture->objectUID, $this->pictureWidth, $this->stageHeight, $this->pictureRatio );
				$teaserItem->summary = $richtext->parse ( $item->displaySummary () );
				$this->teaserItems [] = $teaserItem;
				$i ++;
			}
		}
		
		if ($i > 1) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'uid', $this->objectUID );
			$template->assign ( 'items', $this->teaserItems );
			$template->assign ( 'stagewidth', $this->stageWidth );
			$template->assign ( 'stageheight', $this->stageHeight );
			$template->assign ( 'picturewidth', $this->pictureWidth );
			$template->assign ( 'picturewidthpercent', $this->pictureWidthPercent );
			$template->assign ( 'pictureleft', $this->pictureLeft );
			$template->assign ( 'pictureleftpercent', $this->pictureLeftPercent );
			$template->assign ( 'borderwidth', $this->borderwidth );
			$template->assign ( 'colorborder', $this->colorborder );
			$template->assign ( 'colortextcaption', $this->colortextcaption );
			$template->assign ( 'boxwidth', $this->boxWidth );
			$template->assign ( 'boxwidthpercent', $this->boxWidthPercent );
			$template->assign ( 'boxleft', $this->boxLeft );
			$template->assign ( 'boxleftpercent', $this->boxLeftPercent );
			$template->assign ( 'boxcolor', $this->boxColor );
			$template->assign ( 'colorbackgroundcountdown', $this->colorbackgroundcountdown );
			$template->assign ( 'colorforegroundcountdown', $this->colorforegroundcountdown );
			$template->assign ( 'delay', $this->delay );
			$template->assign ( 'animateslide', $this->animateslide );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaseranimatedbox/tpl/template.tpl' );
			$this->styles = Array (
					'NGPluginTeaserAB' . $this->objectUID => $template->fetchPluginTemplate ( 'ngpluginteaser/ngpluginteaseranimatedbox/tpl/css.tpl' ) 
			);
			$this->styleSheets = Array (
					'NGPluginTeaserAB' => $this->prependPluginsPath ( 'ngpluginteaseranimatedbox/css/style.css' ) 
			);
			$this->javaScripts ['NGPluginTeaserAB'] = $this->prependPluginsPath ( 'ngpluginteaseranimatedbox/js/animatedbox.js' );
		}
	}
}