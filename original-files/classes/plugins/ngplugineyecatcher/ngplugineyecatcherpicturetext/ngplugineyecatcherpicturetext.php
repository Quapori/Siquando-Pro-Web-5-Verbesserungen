<?php

class NGPluginEyecatcherPictureText extends NGPluginEyecatcher {
	
	/**
	 * 
	 * Richtext
	 * @var NGRichText
	 */
	private $richText;
	
	/**
	 * 
	 * Link
	 * @var NGLink
	 */
	private $link;
	
	private $currentID = 0;
	
	public $renderCSS = false;
	
	public function render() {
		
		// Set up settings
		$settings = self::parseConfig ( $this->setting );
		
		$this->isEmpty = true;
		
		$uid = $settings [1];
		
		if (NGUtil::StringXMLToBool ( $settings [3] ) && ($this->currentPage->picture !== ''))
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
				}
				
				$size = $picture->getResizedSize ( $this->renderWidth, $height, $ratio );
				
				$this->template->assign ( 'source', NGLink::getPictureURL ( $uid, $size->width, $height, $ratio ) );
				$this->template->assign ( 'width', $size->width );
				$this->template->assign ( 'height', $size->height );
				$this->template->assign ( 'items', $this->getItems ( NGUtil::unescapeComma ( $settings [4] ), false ) );
				
				$this->setSearch ();
				
				$this->output = $this->template->fetchPluginTemplate ( 'ngplugineyecatcher/ngplugineyecatcherpicturetext/tpl/eyecatcher.tpl' );
				
				$this->styleSheets ['eyecatcherpictext' . $this->targetDIV] = NGUtil::prependRootPath ( 'classes/plugins/ngplugineyecatcher/ngplugineyecatcherpicturetext/css/?id=' . $this->targetDIV );
				
				$this->isEmpty = false;
			
			}
		}
	}
	
	/**
	 * 
	 * Get items for design
	 * @param string $data
	 * @param bool $css
	 */
	public function getItems($data, $css) {
		
		$this->richText = new NGRichText ();
		$this->richText->previewMode = $this->previewMode;
		
		$this->link = new NGLink ( $this->previewMode );
		
		$items = Array ();
		
		if ($data !== '') {
			$lines = explode ( '~', $data );
			
			foreach ( $lines as $line ) {
				$item = $this->getItem ( NGUtil::unescapeTilde ( $line ), $css );
				if ($item !== null)
					$items [] = $item;
			}
		}
		
		return $items;
	}
	
	/**
	 * 
	 * Get one item
	 * @param string $data
	 * @param bool $css
	 */
	private function getItem($data, $css) {
		$item = new StageItem ();
		
		$parts = explode ( '|', $data );
		
		$item->id = ++ $this->currentID;
		$item->type = $parts [0];
		
		if ($css) {
			
			$item->left = $parts [1];
			$item->top = $parts [2];
			$item->width = $parts [3];
			$item->height = $parts [4];
		}
		
		switch ($item->type) {
			case 'head' :
				$item->fontfamily = NGFontUtil::getInstance ()->getFontStack ( $parts [6] );
				if ($css) {
					$item->color = $parts [10];
					$item->fontsize = $parts [7];
					$item->fontweight = (NGUtil::StringXMLToBool ( $parts [8] )) ? 'bold' : 'normal';
					$item->fontstyle = (NGUtil::StringXMLToBool ( $parts [9] )) ? 'italic' : 'normal';
					$item->hyperlinkcolor = $parts [10];
				} else {
					if (NGUtil::StringXMLToBool ( $parts [13] )) {
						$item->text = $this->currentPage->caption;
					} else {
						$item->text = NGUtil::unescapePipe ( $parts [5] );
					}
					
					if ($parts [11] !== '') {
						$this->link->parseURL ( $parts [11] );
						$item->link = $this->link->getURL ();
						
						if ($this->link->linkType == NGLink::LinkPicture) {
							$item->linkstyle = 'gallery';
						} else if ($this->link->linkType == NGLink::LinkPagePopup || $this->link->linkType == NGLink::LinkTopicPopup) {
							$item->linkstyle = 'galleryiframe';
						} else if ($this->link->linkType == NGLink::LinkWWW) {
							$item->linktarget = '_blank';
						}
					}
					
					if ($parts [12] !== '')
						$item->linktitle = $parts [12];
				}
				
				break;
			case 'text' :
				if ($css) {
					$item->color = $parts [6];
					$item->hyperlinkcolor = $parts [7];
				} else {
					if (NGUtil::StringXMLToBool ( $parts [8] )) {
						$text = $this->currentPage->summary;
					} else {
						$text = $parts [5];
					}
					
					$item->text = $this->richText->parse ( NGUtil::unescapePipe ( $text ) );
				
				}
				break;
			case 'search' :
				$item->fontfamily = NGFontUtil::getInstance ()->getFontStack ( $parts [11] );
				if ($css) {
					$item->color = $parts [5];
					$item->background = $parts [6];
					$item->bordercolor = $parts [7];
					$item->borderwidth = $parts [8];
					$item->roundedcorners = $parts [9];
					$item->style = $parts [10];
					$item->fontsize = $parts [12];
					$item->fontweight = (NGUtil::StringXMLToBool ( $parts [13] )) ? 'bold' : 'normal';
					$item->fontstyle = (NGUtil::StringXMLToBool ( $parts [14] )) ? 'italic' : 'normal';
					$margin = new NGMargin ( $item->borderwidth );
					$item->width = $item->width - 8 - $margin->totalWidth ();
				}
				break;
			case 'box' :
				if ($css) {
					$item->fill = $parts [5];
					$item->opacity = $parts [6];
					$item->shadow = $parts [7];
				}
				break;
			case 'picture' :
				if (! $css) {
					$item->picture = NGLink::getPictureURL ( $parts [7], intval ( $parts [3] ), intval ( $parts [4] ) );
					if ($parts [8] !== '') {
						$this->link->parseURL ( $parts [8] );
						$item->link = $this->link->getURL ();
						
						if ($this->link->linkType == NGLink::LinkPicture) {
							$item->linkstyle = 'gallery';
						} else if ($this->link->linkType == NGLink::LinkPagePopup || $this->link->linkType == NGLink::LinkTopicPopup) {
							$item->linkstyle = 'galleryiframe';
						} else if ($this->link->linkType == NGLink::LinkWWW) {
							$item->linktarget = '_blank';
						}
					}
					
					if ($parts [9] !== '')
						$item->linktitle = $parts [9];
				}
				break;
		}
		
		return $item;
	
	}
	
	public static function parseConfig($config) {
		$settings = explode ( ',', $config );
		
		if (! array_key_exists ( 1, $settings ))
			$settings [1] = '';
		if (! array_key_exists ( 2, $settings ))
			$settings [2] = 'fill31';
		if (! array_key_exists ( 3, $settings ))
			$settings [3] = 'false';
		if (! array_key_exists ( 4, $settings ))
			$settings [4] = '';
		
		return $settings;
	}
}

class StageItem {
	public $id;
	public $left;
	public $top;
	public $width;
	public $height;
	public $text;
	public $type;
	public $color;
	public $hyperlinkcolor;
	public $fontfamily;
	public $fontsize;
	public $fontweight;
	public $fontstyle;
	public $link;
	public $linkstyle;
	public $linktitle;
	public $linktarget;
	public $background;
	public $bordercolor;
	public $borderwidth;
	public $roundedcorners;
	public $style;
	public $shadow;
	public $opacity;
	public $fill;
	public $picture;
}