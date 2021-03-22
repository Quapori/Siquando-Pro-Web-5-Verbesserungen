<?php

class NGPluginEyecatcherPicture extends NGPluginEyecatcher {
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$this->isEmpty = true;
		
		$uid = $settings [1];
		
		if (NGUtil::StringXMLToBool ( $settings [4] ) && ($this->currentPage->picture !== ''))
			$uid = $this->currentPage->picture;
		
		if ($uid !== '') {
			
			$pictureAdapter = new NGDBAdapterObject ();
			
			/* @var $picture NGPicture */
			$picture = $pictureAdapter->loadObject ( $uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
			if ($picture != null) {
				
				switch ($settings [2]) {
					case 'fill31' :
						$ratio = NGPicture::Ratio3by1;
						$height = - 1;
						break;
					case 'fill43' :
						$ratio = NGPicture::Ratio4by3;
						$height = - 1;
						break;
					case 'fit' :
						$height = - 1;
						$ratio = NGPicture::RatioNone;
						break;
					case 'left' :
					case 'right' :
						$height = intval ( $settings [3] );
						$ratio = NGPicture::RatioNone;
						break;
				}
				
				$size = $picture->getResizedSize ( $this->renderWidth, $height, $ratio );
				
				$this->template->assign ( 'source', NGLink::getPictureURL ( $uid, $size->width, $height, $ratio ) );
				$this->template->assign ( 'width', $size->width );
				$this->template->assign ( 'home', NGLink::getLinkToHome($this->previewMode) );
				$this->template->assign ( 'height', $size->height );
				$this->template->assign ( 'right', $settings [2] === 'right' );
				
				$this->output = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatcherpicture/tpl/eyecatcher.tpl' );
				$this->isEmpty = false;
			
			}
		}
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'fill31';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = '100';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = 'false';
		
		return $settings;
	}
}