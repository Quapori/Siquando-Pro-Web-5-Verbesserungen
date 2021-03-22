<?php

class NGPluginEyecatcherCaption extends NGPluginEyecatcher {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$uid = $settings [4];
		
		if ($uid !== '') {
			
			$paddingCaption = new NGMargin ( $settings [3] );
			$paddingLogo = new NGMargin ( $settings [5] );
			$font = new NGFont ( NGUtil::unescapeComma ( $settings [2] ) );
			
			$height = $font->fontsize + $paddingCaption->totalHeight () - $paddingLogo->totalHeight ();
			
			if ($height > 4) {
				
				$pictureAdapter = new NGDBAdapterObject ();
				
				/* @var $picture NGPicture */
				$picture = $pictureAdapter->loadObject ( $uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
				
				$size = $picture->getResizedSize ( - 1, $height, NGPicture::RatioNone );
				
				$this->template->assign ( 'source', NGLink::getPictureURL ( $uid, $size->width, $size->height, NGPicture::RatioNone ) );
				$this->template->assign ( 'width', $size->width );
				$this->template->assign ( 'home', NGLink::getLinkToHome ( $this->previewMode ) );
				$this->template->assign ( 'height', $size->height );
				$this->template->assign ( 'paddinglogo', $settings [5] );
			}
		}
		
		$this->template->assign ( 'caption', NGUtil::unescapeComma ( $settings [1] ) );
		$this->template->assign ( 'paddingcaption', $settings [3] );
		$this->template->assign ( 'id', $this->targetDIV );
		$this->template->assign ( 'font', NGUtil::unescapeComma ( $settings [2] ) );
		$this->template->assign ( 'captionshadow', $settings [6]  );
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatchercaption/tpl/eyecatcher.tpl' );
		$this->styles ['eyecatchercaption' . $this->targetDIV] = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatchercaption/tpl/style.tpl' );
		$this->isEmpty = false;
	
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'Tahoma, 16, false, false, false, 000000';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '0';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '';
		if (! array_key_exists ( 5, $settings ))
			$settings [5] = '0';
		if (! array_key_exists ( 6, $settings ))
			$settings [6] = '0 3 3 SE';
			
		return $settings;
	}
}