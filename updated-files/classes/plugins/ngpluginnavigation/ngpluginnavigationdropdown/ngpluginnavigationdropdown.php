<?php

class NGPluginNavigationDropDown extends NGPluginNavigation {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		$sound = $settings [13];
		$animate = $settings [12] == 'true';
		
		// Create navigation
		$navigation = new NGRenderNavigation ();
		$navigation->previewMode = $this->previewMode;
		
		$level = $settings [14];
		$includeHome = true;
		
		if ($level == 0) {
			$level = 1;
			$includeHome = false;
		}
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		$activeTopic = $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level + 1 );
		$activeTopicUid = ($activeTopic === null) ? '' : $activeTopic->objectUID;
		
		$htmlNav = ($home == NULL) ? '' : $navigation->renderList ( $home->findAchestorAtLevel ( $this->currentPage->parentUID, $level ), 3, $includeHome, $activeTopicUid );
		
		$this->isEmpty = ($htmlNav == '');
		
		// Fill template
		if (! $this->isEmpty) {
			$this->template->assign ( 'nav', $htmlNav );
			$this->template->assign ( 'target', $this->targetDIV );
			$this->template->assign ( 'sound', ($sound == '') ? '' : NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationdropdown/sounds/' . $sound ) );
			$this->template->assign ( 'animate', $animate );
			
			if ($settings [26] !== '') {
				
				$pictureAdapter = new NGDBAdapterObject ();
				
				/* @var $picture NGPicture */
				$picture = $pictureAdapter->loadObject ( $settings [26], NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
				
				if ($picture != null) {
					
					$itempadding = new NGMargin ( $settings [15] );
					$picturepadding = new NGMargin ( $settings [27] );
					
					$fontBar = new NGFont ( $settings [1] );
					
					$height = $fontBar->fontsize + 4 + $itempadding->totalHeight () - $picturepadding->totalHeight ();
					
					if ($height > 4) {
						
						$size = $picture->getResizedSize ( - 1, $height );
						
						$this->template->assign ( 'logosource', NGLink::getPictureURL ( $settings [26], $size->width, $size->height ) );
						$this->template->assign ( 'logowidth', $size->width );
						$this->template->assign ( 'logoheight', $size->height );
						
						$this->template->assign ( 'logolink', NGLink::getLinkToHome ( $this->previewMode ) );
					
					}
				}
			}
			
			if (NGUtil::StringXMLToBool ( $settings [16] ))
				$this->setSearch ();
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginnavigation/ngpluginnavigationdropdown/tpl/navigation.tpl' );
			
			$this->styleSheets ['navigationdropdown' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationdropdown/css/?id=' . $this->targetDIV );
			if ($animate || $sound != '')
				$this->javaScripts ['ngpluginnavigationdropdown'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginnavigation/ngpluginnavigationdropdown/js/menu.js' );
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings )) {
			$settings [1] = 'Tahoma,12,false,false,false,000000';
		} else {
			$settings [1] = NGUtil::unescapeComma ( $settings [1] );
			self::registerFont($settings[1]);
		}
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'solid f0f0f0';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '000000';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = 'solid dcdcdc';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = '000000';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = '';
		if (! array_key_exists ( 7, $settings ))
			$settings [7] = 'd3d3d3';
		if (! array_key_exists ( 8, $settings ))
			$settings [8] = 'solid ffffff';
		if (! array_key_exists ( 9, $settings )) {
			$settings [9] = 'Tahoma,12,false,false,false,000000';
		} else {
			$settings [9] = NGUtil::unescapeComma ( $settings [9] );
			self::registerFont($settings[9]);
		}
		if (! array_key_exists ( 10, $settings ))
			$settings [10] = 'solid f0f0f0';
		if (! array_key_exists ( 11, $settings ))
			$settings [11] = '000000';
		if (! array_key_exists ( 12, $settings ))
			$settings [12] = 'false';
		if (! array_key_exists ( 13, $settings ))
			$settings [13] = '';
		if (! array_key_exists ( 14, $settings ))
			$settings [14] = '1';
		if (! array_key_exists ( 15, $settings ))
			$settings [15] = '10';
		if (! array_key_exists ( 16, $settings ))
			$settings [16] = 'false';
		if (! array_key_exists ( 17, $settings ))
			$settings [17] = '000000';
		if (! array_key_exists ( 18, $settings ))
			$settings [18] = 'solid ffffff';
		if (! array_key_exists ( 19, $settings ))
			$settings [19] = 'd3d3d3';
		if (! array_key_exists ( 20, $settings ))
			$settings [20] = '1';
		if (! array_key_exists ( 21, $settings ))
			$settings [21] = '';
		if (! array_key_exists ( 22, $settings ))
			$settings [22] = 'default';
		if (! array_key_exists ( 23, $settings ))
			$settings [23] = '5';
		if (! array_key_exists ( 24, $settings ))
			$settings [24] = '5';
		if (! array_key_exists ( 25, $settings ))
			$settings [25] = '160';
		if (! array_key_exists ( 26, $settings ))
			$settings [26] = '';
		if (! array_key_exists ( 27, $settings ))
			$settings [27] = '0 10 0 0';
		
		$settings [- 1] = new NGMargin ( $settings [15] );
		return $settings;
	}
	
	/**
	 * 
	 * Register used font
	 * @param string $font
	 */
	public static function registerFont($font)
	{
		$ngfont = new NGFont($font);
		NGFontUtil::getInstance()->getFontStack($ngfont->fontfamily);
	}
}