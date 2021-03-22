<?php

class NGPluginEyecatcherGallery extends NGPluginEyecatcher {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$ratioType = NGPicture::stringToRatio($settings [1]);
		$ratio = NGPicture::ratioByRatioType($ratioType);
		
		$topic = $this->currentTopic;
		
		while ( $topic->bouquetitemssource === NGBouquet::ItemsSourceManual && $topic->bouquetitems === '' && $topic->parentUID != NGUtil::ObjectUIDRootContent ) {
			if (! isset ( $adapter ))
				$adapter = new NGDBAdapterObject ();
			$topic = $adapter->loadObject ( $topic->parentUID, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic );
		}
		
		$bouquet = new NGBouquet ();
		$bouquet->itemSource = $topic->bouquetitemssource;
		$bouquet->sortMode = $topic->bouqetsortmode;
		$bouquet->itemsXML = $topic->bouquetitems;
		$bouquet->parentUID = $topic->bouquetparentuid;
		$bouquet->previewMode = $this->previewMode;
		$bouquet->prepare ();
		
		$pictures = Array ();
		
		foreach ( $bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			
			$picture = Array (
				'source' => NGLink::getPictureURL ( $item->displayPicture ()->objectUID, $this->renderWidth, -1, $ratioType ), 
				'link' => ($item->overrideLink) ? $item->displayLink () : null, 
				'alt' => $item->displayPicture ()->alt 
			);
						
			$pictures [] = $picture;
		}
		
		$this->template->assign ( 'pictures', $pictures );
		$this->template->assign ( 'settings', $settings);
		
		$this->styleSheets ['eyecatchergallery' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngplugineyecatcher/ngplugineyecatchergallery/css/?id=' . $this->targetDIV );
		
		$this->javaScripts['eyecatchergallery']=NGUtil::prependRootPath ( 'classes/plugins/ngplugineyecatcher/ngplugineyecatchergallery/js/gallery.js'  );
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatchergallery/tpl/eyecatcher.tpl' );
	
	}

	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = 'Ratio3by1';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'Slide';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '6';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = 'PrevNext';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = 'Left';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = 'ffffff';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'eeeeee';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'dddddd';
			
		return $settings;
	}
}