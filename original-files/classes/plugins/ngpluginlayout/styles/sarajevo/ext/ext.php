<?php

class NGPluginLayoutProExt {

	/**
	 *
	 * Placeholder for layout
	 *
	 * @var NGPluginLayoutPro
	 */
	public $layout;

	/**
	 *
	 * Array
	 *
	 * @var Array
	 */
	public $config;
	
	/**
	 *
	 * Width of mobile device
	 *
	 * @var integer
	 */
	const MobileWidth = 1023;
	
	/**
	 *
	 * Width on desktop device
	 *
	 * @var integer
	 */
	const DesktopWidth = 1100;

	/**
	 * Render the layout
	 */
	public function render() {
		$this->layout->template->assign ( 'htmlclass', 'sqr' );
		
		if (array_key_exists ( 'hiddenstreams', $this->layout->settings->config )) {
			foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
				/* @var $paragraphStream NGParagraphStream */
				if (strpos ( $this->layout->settings->config ['hiddenstreams'], $paragraphStream->name ) !== false) {
					$paragraphStream->isVisible = false;
				}
			}
		}
		
		$this->layout->javaScripts ['sarajevo'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginlayout/styles/sarajevo/js/sarajevo.js' );
		
		$viewport = 'width=device-width, initial-scale=1.0';
		
		if (! NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.userscalable'] )) {
			$viewport .= ', user-scalable=no';
		}
		
		$this->layout->template->assign ( 'viewport', $viewport );
		
		foreach ( $this->layout->page->paragraphStreams as $paragraphStream ) {
			/* @var $paragraphStream NGParagraphStream */
			$paragraphStream->responsive = true;
			$paragraphStream->allowMobileFullWidth = true;
			$paragraphStream->mobileWidth = self::MobileWidth;
		}
		
		$renderWidth = self::DesktopWidth;
		
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->allowAlwaysFullWidth = true;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->renderWidth = $renderWidth;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->allowAlwaysFullWidth = true;
		$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamFooter]->renderWidth = $renderWidth;
		
		$colcount = 1;
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible)
			$colcount ++;
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible)
			$colcount ++;
		if ($colcount == 1)
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->allowAlwaysFullWidth = true;
		
		$this->layout->template->assign ( 'cols', $colcount );
		
		if ($this->layout->settings->config ['options.mainlayout'] === 'sidebars' && $colcount > 1) {
			if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
				$this->layout->template->assign ( 'mainstyle', 'sqrmain3collr' );
				$renderWidthLeft = ceil ( $renderWidth * 0.21 );
				$renderWidthRight = ceil ( $renderWidth * 0.21 );
				$gutter = ceil ( $renderWidth * 0.04 ) * 2;
				$renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
			} else if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && ! $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
				$this->layout->template->assign ( 'mainstyle', 'sqrmain2coll' );
				$renderWidthLeft = ceil ( $renderWidth * 0.21 );
				$renderWidthRight = 0;
				$gutter = ceil ( $renderWidth * 0.04 );
				$renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
			} else if (! $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->isVisible && $this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->isVisible) {
				$this->layout->template->assign ( 'mainstyle', 'sqrmain2colr' );
				$renderWidthLeft = 0;
				$renderWidthRight = ceil ( $renderWidth * 0.21 );
				$gutter = ceil ( $renderWidth * 0.04 );
				$renderWidthContent = $renderWidth - $renderWidthLeft - $renderWidthRight - $gutter;
			}
			
			if ($renderWidthLeft < self::MobileWidth)
				$renderWidthLeft = self::MobileWidth;
			if ($renderWidthRight < self::MobileWidth)
				$renderWidthRight = self::MobileWidth;
			if ($renderWidthContent < self::MobileWidth)
				$renderWidthContent = self::MobileWidth;
			
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil ( $renderWidthContent );
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil ( $renderWidthLeft );
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil ( $renderWidthRight );
		} else {
			$renderWidthColumn = ceil ( $renderWidth / $colcount );
			if ($renderWidthColumn < self::MobileWidth)
				$renderWidthColumn = self::MobileWidth;
			
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamContent]->renderWidth = ceil ( $renderWidthColumn );
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarLeft]->renderWidth = ceil ( $renderWidthColumn );
			$this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamSidebarRight]->renderWidth = ceil ( $renderWidthColumn );
			$this->layout->template->assign ( 'mainstyle', 'sqrmain' . $colcount . 'col' );
		}
		
		$this->layout->createImage ( 'logo', - 1, 22, NGPicture::RatioNone );
		$this->layout->createImage ( 'logosmall', - 1, 22, NGPicture::RatioNone );
		
		$this->layout->template->assign ( 'up', $this->layout->settings->config ['options.up'] );
		$this->layout->template->assign ( 'speed', $this->layout->settings->config ['options.speed'] );
		$this->layout->template->assign ( 'fadeeffect', $this->layout->settings->config ['options.fadeeffect'] );
		$this->layout->template->assign ( 'autoprogress', $this->layout->settings->config ['slider.autoprogress'] );
		$this->layout->template->assign ( 'parallax', NGUtil::StringXMLToBool ( $this->layout->settings->config ['options.parallax'] ) );
		
		if ($this->layout->page->paragraphStreams [NGParagraphStream::ParagraphStreamHeader]->isVisible) {
			$this->layout->template->assign ( 'topcolor', $this->layout->settings->config ['palette.background.header'] );
		} else {
			$this->layout->template->assign ( 'topcolor', $this->layout->settings->config ['palette.background'] );
		}

		$pictures = Array ();

        $adapter = new NGDBAdapterObject ();

        if (!$this->layout->topic->hideeyecatcher) {

            $bouquet = new NGBouquet ();
            $bouquet->itemSource = $this->layout->topic->bouquetitemssource;
            $bouquet->sortMode = $this->layout->topic->bouqetsortmode;
            $bouquet->itemsXML = $this->layout->topic->bouquetitems;
            $bouquet->parentUID = $this->layout->topic->bouquetparentuid;
            $bouquet->previewMode = $this->layout->previewMode;
            $bouquet->prepare ();


            foreach ($bouquet->items as $item) {
                /* @var $item NGBouquetItem */
                $pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, 1920, 640, NGPicture::Ratio3by1);
            }

            if (count($pictures) === 0 && $this->layout->settings->config ['options.galeryinheritance'] == 'true') {
                $this->layout->createImage('eyecatcher', 1920, 640, NGPicture::Ratio3by1);
            }


            if (array_key_exists('h264', $this->layout->topic->linkedmedia)) {
                $h264download = $adapter->loadObject($this->layout->topic->linkedmedia ['h264'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($h264download !== null) {
                    $this->layout->template->assign('topich264', NGUtil::prependStorePath($h264download->pathToFile()));
                }
            }

            if (array_key_exists('ogv', $this->layout->topic->linkedmedia)) {
                $ogvdownload = $adapter->loadObject($this->layout->topic->linkedmedia ['ogv'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($ogvdownload !== null) {
                    $this->layout->template->assign('topicogv', NGUtil::prependStorePath($ogvdownload->pathToFile()));
                }
            }
            if (array_key_exists('webm', $this->layout->topic->linkedmedia)) {
                $webmdownload = $adapter->loadObject($this->layout->topic->linkedmedia ['webm'], NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);
                if ($webmdownload !== null) {
                    $this->layout->template->assign('topicwebm', NGUtil::prependStorePath($webmdownload->pathToFile()));
                }
            }

            if (array_key_exists('poster', $this->layout->topic->linkedmedia)) {
                $this->layout->template->assign('poster', NGLink::getPictureURL($this->layout->topic->linkedmedia ['poster'], 1920, 1080, NGPicture::RatioNone));
            }

            if (NGUtil::StringXMLToBool($this->layout->settings->config ['options.mutevideo'])) {
                $this->layout->template->assign('mutevideo', true);
            }
        }

        $this->layout->template->assign('pictures', $pictures);


        $richtext = new NGRichText ();
		$richtext->previewMode = $this->layout->previewMode;
		$this->layout->template->assign ( 'footer', $richtext->parse ( $this->layout->settings->config ['footer.html'] ) );
		
		$this->layout->createCommonNav ();
	}
}