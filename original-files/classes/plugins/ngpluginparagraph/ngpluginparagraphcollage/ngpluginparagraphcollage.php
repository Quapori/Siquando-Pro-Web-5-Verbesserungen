<?php

class NGPluginParagraphCollage extends NGPluginParagraph {
	const ObjectTypePluginParagraphCollage = 'NGPluginParagraphCollage';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphCollage = "paragraphcollage";

	public $data = '';

	public $columns = 2;

	public $rows = 2;

	public $bordercolor = '';

	public $transeffect = 'updown';

	private $tiles = array ();

	private $gutter = 0;

	/**
	 *
	 * Language resources
	 * 
	 * @var NGLanguageAdapter
	 */
	private $lang;

	/**
	 *
	 * Richtext parser
	 * 
	 * @var NGRichText
	 */
	private $richText;

	/**
	 *
	 * Adapter to load pictures
	 * 
	 * @var NGDBAdapterObject
	 */
	private $pictureAdapter;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'data', NGProperty::TypeText, self::DomainParagraphCollage, 'data', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'columns', NGProperty::TypeInt, self::DomainParagraphCollage, 'columns', NGPropertyMapped::MultiplicityScalar, false, 2, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rows', NGProperty::TypeInt, self::DomainParagraphCollage, 'rows', NGPropertyMapped::MultiplicityScalar, false, 2, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bordercolor', NGProperty::TypeString, self::DomainParagraphCollage, 'bordercolor', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'transeffect', NGProperty::TypeString, self::DomainParagraphCollage, 'transeffect', NGPropertyMapped::MultiplicityScalar, false, 'UpDown', false );
	}

	public function render() {
		if ($this->data != '') {
			
			$this->lang = new NGLanguageAdapter ();
			$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphcollage/language/langcollage.xml';
			$this->lang->load ();
			
			$this->pictureAdapter = new NGDBAdapterObject ();
			$this->richText = new NGRichText ();
			$this->richText->previewMode = $this->previewMode;
			
			$this->tiles = $this->parseData ( $this->data );
			
			$this->gutter = $this->bordercolor === '' ? 0 : 1;
			
			$tileleft = 0;
			
			$stageWidth = $this->renderWidth - 2 * $this->gutter;
			
			for($column = 0; $column < $this->columns; $column ++) {
				$tilewidth = ceil ( $stageWidth / $this->columns );
				$tileheight = $tilewidth;
				
				if ($column == $this->columns - 1)
					$tilewidth = $stageWidth - $tileleft;
				$tiletop = 0;
				
				for($row = 0; $row < $this->rows; $row ++) {
					$this->tiles [$column + $row * $this->columns]->width = $tilewidth;
					$this->tiles [$column + $row * $this->columns]->height = $tileheight;
					$this->tiles [$column + $row * $this->columns]->left = $tileleft;
					$this->tiles [$column + $row * $this->columns]->top = $tiletop;
					
					$this->placeItems ( $this->tiles [$column + $row * $this->columns], $column == $this->columns - 1, $row == $this->rows - 1 );
					
					$tiletop += $tileheight;
				}
				$tileleft += $tilewidth;
			}
			
			$template = new NGTemplate ();
			
			$template->assign ( 'tiles', $this->tiles );
			$template->assign ( 'width', $stageWidth );
			$template->assign ( 'bordercolor', $this->bordercolor );
			$template->assign ( 'height', $tiletop );
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'lang', $this->lang );
			$template->assign ( 'responsive', $this->responsive );
			$template->assign ( 'transeffect', strtolower ( $this->transeffect ) );
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphcollage/tpl/template.tpl' );
			
			$this->styleSheets ['ngpluginparagraphcollage'] = $this->prependPluginsPath ( 'ngpluginparagraphcollage/css/style.css' );
			$this->javaScripts ['ngpluginparagraphcollage'] = $this->prependPluginsPath ( 'ngpluginparagraphcollage/js/collage.js' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = self::RenderModeMobileFullWidth;
		}
	}

	private function placeItems(CollageTile $tile, $lastColumn, $lastRow) {
		switch ($tile->mode) {
			case 'One' :
				$this->placeItem ( $tile->items [0], 0, 0, $tile->width, $tile->height, NGPicture::Ratio1by1, $lastColumn, $lastRow );
				break;
			case 'Vertical' :
				$halfwidth = ceil ( $tile->width / 2 );
				$this->placeItem ( $tile->items [0], 0, 0, $halfwidth, $tile->height, NGPicture::Ratio3by4, false, $lastRow );
				$this->placeItem ( $tile->items [1], $halfwidth, 0, $tile->width - $halfwidth, $tile->height, NGPicture::Ratio3by4, $lastColumn, $lastRow );
				break;
			case 'Horizontal' :
				$halfheight = ceil ( $tile->height / 2 );
				$this->placeItem ( $tile->items [0], 0, 0, $tile->width, $halfheight, NGPicture::Ratio4by3, $lastColumn, false );
				$this->placeItem ( $tile->items [1], 0, $halfheight, $tile->width, $tile->height - $halfheight, NGPicture::Ratio4by3, $lastColumn, $lastRow );
				break;
			case 'Four' :
				$halfwidth = ceil ( $tile->width / 2 );
				$halfheight = ceil ( $tile->height / 2 );
				$this->placeItem ( $tile->items [0], 0, 0, $halfwidth, $halfheight, NGPicture::Ratio1by1, false, false );
				$this->placeItem ( $tile->items [1], $halfwidth, 0, $tile->width - $halfwidth, $halfheight, NGPicture::Ratio1by1, $lastColumn, false );
				$this->placeItem ( $tile->items [2], 0, $halfheight, $halfwidth, $tile->height - $halfheight, NGPicture::Ratio1by1, false, $lastRow );
				$this->placeItem ( $tile->items [3], $halfwidth, $halfheight, $tile->width - $halfwidth, $tile->height - $halfheight, NGPicture::Ratio1by1, $lastColumn, $lastRow );
				break;
		}
	}

	private function placeItem(CollageTileItem $item, $left, $top, $width, $height, $ratio, $lastColumn, $lastRow) {
		$item->left = $left;
		$item->top = $top;
		$item->width = $width;
		$item->height = $height;
		if (! $lastColumn)
			$item->borderRight = $this->gutter;
		if (! $lastRow)
			$item->borderBottom = $this->gutter;
		
		if ($item->linkUrl != '') {
			$item->link = new NGLink ( $this->previewMode );
			$item->link->parseURL ( $item->linkUrl );
		}
		
		/* $picture NGPicture */
		$picture = $this->pictureAdapter->loadObject ( $item->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
		
		if ($picture != null) {
			switch ($ratio) {
				case NGPicture::Ratio1by1:
					/* NGSize $size */
					$max = max ( $item->width, $item->height );
					$size = $picture->getResizedSize ( $max, $max, NGPicture::Ratio1by1 );
					$item->pictureSource = NGLink::getPictureURL ( $item->pictureUID, $max, $max, NGPicture::Ratio1by1 );
					if (NGSettingsSite::getInstance ()->hdpictures)
						$item->pictureSourceHD = NGLink::getPictureURL ( $item->pictureUID, $max * 2, $max * 2, NGPicture::Ratio1by1 );
					$item->pictureWidth = $size->width;
					$item->pictureHeight = $size->height;
					break;
				case NGPicture::Ratio4by3:
					/* NGSize $size */
					$size = $picture->getResizedSize ( $item->width, - 1, NGPicture::Ratio4by3 );
					$item->pictureSource = NGLink::getPictureURL ( $item->pictureUID, $item->width, - 1, NGPicture::Ratio4by3 );
					if (NGSettingsSite::getInstance ()->hdpictures)
						$item->pictureSourceHD = NGLink::getPictureURL ( $item->pictureUID, $item->width * 2, - 1, NGPicture::Ratio4by3 );
					$item->pictureWidth = $size->width;
					$item->pictureHeight = $size->height;
					$item->pictureTop = floor ( ($item->height - $size->height) / 2 );
					break;
				case NGPicture::Ratio3by4:
					/* NGSize $size */
					$size = $picture->getResizedSize ( - 1, $item->height, NGPicture::Ratio3by4 );
					$item->pictureSource = NGLink::getPictureURL ( $item->pictureUID, - 1, $item->height, NGPicture::Ratio3by4 );
					if (NGSettingsSite::getInstance ()->hdpictures)
						$item->pictureSource = NGLink::getPictureURL ( $item->pictureUID, - 1, $item->height * 2, NGPicture::Ratio3by4 );
					$item->pictureWidth = $size->width;
					$item->pictureHeight = $size->height;
					$item->pictureLeft = floor ( ($item->width - $size->width) / 2 );
					break;
			}
		}
	}

	public function parseData($data) {
		$tiles = array ();
		$xml = new DOMDocument ( '1.0', 'UTF-8' );
		$xml->loadXML ( $data );
		
		foreach ( $xml->documentElement->childNodes as $tileElement ) {
			/* @var $tileElement DOMElement */
			if ($tileElement->nodeType == XML_ELEMENT_NODE) {
				if ($tileElement->nodeName == 'tile') {
					$tile = new CollageTile ();
					if ($tileElement->hasAttribute ( 'mode' ))
						$tile->mode = $tileElement->getAttribute ( 'mode' );
					
					foreach ( $tileElement->childNodes as $itemElement ) {
						/* @var $itemElement DOMElement */
						
						if ($itemElement->nodeType == XML_ELEMENT_NODE) {
							if ($itemElement->nodeName == 'item') {
								$tileItem = new CollageTileItem ();
								
								foreach ( $itemElement->childNodes as $itemPropertyElement ) {
									/* @var $itemPropertyElement DOMElement */
									if ($itemPropertyElement->nodeType == XML_ELEMENT_NODE) {
										switch ($itemPropertyElement->nodeName) {
											case 'pictureuid' :
												$tileItem->pictureUID = $itemPropertyElement->nodeValue;
												break;
											case 'link' :
												$tileItem->linkUrl = $itemPropertyElement->nodeValue;
												break;
											case 'text' :
												$tileItem->text = $this->richText->parse ( $itemPropertyElement->nodeValue );
												break;
										}
									}
								}
								$tile->items [] = $tileItem;
							}
						}
					}
					$tiles [] = $tile;
				}
			}
		}
		
		return $tiles;
	}
}

class CollageTile {

	public $mode = 'One';

	public $width = 0;

	public $height = 0;

	public $left = 0;

	public $top = 0;

	public $items = array ();
}

class CollageTileItem {

	public $pictureUID = '';

	public $text = '';

	public $linkUrl = '';

	public $width = 0;

	public $height = 0;

	public $left = 0;

	public $top = 0;

	public $pictureWidth = 0;

	public $pictureHeight = 0;

	public $pictureLeft = 0;

	public $pictureTop = 0;

	public $pictureSource = '';

	public $pictureSourceHD;

	public $link;

	public $borderRight = 0;

	public $borderBottom = 0;
}