<?php

class NGPluginParagraphFlexMatrix extends NGPluginParagraph {
	const ObjectTypePluginParagraphFlexMatrix = 'NGPluginParagraphFlexMatrix';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphFlexMatrix = "paragraphflexmatrix";

	/**
	 *
	 * Sortmode for bouquet
	 * 
	 * @var string
	 */
	public $sortMode = '';

	/**
	 *
	 * Source for bouquet
	 * 
	 * @var string
	 */
	public $itemsSource = '';

	/**
	 *
	 * Found items
	 * 
	 * @var string
	 */
	public $items;

	/**
	 *
	 * PArent UID
	 * 
	 * @var string
	 */
	public $itemsParentUID = '';

	/**
	 *
	 * Gutter between cols
	 * 
	 * @var int
	 */
	public $gutter = 3;

	/**
	 *
	 * Color of border
	 * 
	 * @var string
	 */
	public $matrixbordercolor = '';

	/**
	 *
	 * Maximum row count
	 * 
	 * @var int
	 */
	public $maxRowCount = 5;

	/**
	 *
	 * Emphasize the first picture
	 * 
	 * @var bool
	 */
	public $emphasizefirst = true;

	/**
	 *
	 * Show captions
	 * 
	 * @var bool
	 */
	public $showcaptions = true;

	/**
	 *
	 * Bouquet to use
	 * 
	 * @var NGBouquet
	 */
	private $bouquet;

	/**
	 *
	 * Loaded pictures
	 * 
	 * @var Array
	 */
	private $pictures = Array ();

	private $x;

	private $y;

	private $rowHeight;

	private $index;

	private $rowCount;

	private $currentRenderWidth;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphFlexMatrix, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphFlexMatrix, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphFlexMatrix, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphFlexMatrix, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'gutter', NGProperty::TypeInt, self::DomainParagraphFlexMatrix, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maxrowcount', NGProperty::TypeInt, self::DomainParagraphFlexMatrix, 'maxRowCount', NGPropertyMapped::MultiplicityScalar, false, 5, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'emphasizefirst', NGProperty::TypeBool, self::DomainParagraphFlexMatrix, 'emphasizefirst', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'matrixbordercolor', NGProperty::TypeString, self::DomainParagraphFlexMatrix, 'matrixbordercolor', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showcaptions', NGProperty::TypeBool, self::DomainParagraphFlexMatrix, 'showcaptions', NGPropertyMapped::MultiplicityScalar, false, true, false );
	}

	private function nextPicture() {
		$this->index ++;
		
		if ($this->index >= count ( $this->bouquet->items ))
			return null;
		
		$picture = new NGPluginParagraphFlexMatrixItem ();
		$picture->item = $this->bouquet->items [$this->index];
		$picture->link = $picture->item->displayLink ();
		$picture->caption = $picture->item->displayCaption ();
		$picture->alt = $picture->item->displayPicture ()->alt;
		
		return $picture;
	}

	private function createRow() {
		$totalwidth = 0;
		$maxwidth = $this->currentRenderWidth - $this->x;
		
		$firstIndex = - 1;
		$lastIndex = - 1;
		
		$newPictures = Array ();
		
		while ( $totalwidth < $maxwidth ) {
			$picture = $this->nextPicture ();
			if ($picture === null)
				return false;
			
			$picture->pictureWidth = floor ( $this->rowHeight * $picture->item->displayPicture ()->width / $picture->item->displayPicture ()->height );
			$picture->boxWidth = $picture->pictureWidth;
			$picture->height = $this->rowHeight;
			
			$totalwidth += $picture->pictureWidth + $this->gutter;
			
			$newPictures [$this->index] = $picture;
			
			if ($firstIndex == - 1)
				$firstIndex = $this->index;
			$lastIndex = $this->index;
		}
		
		$this->pictures = array_merge ( $this->pictures, $newPictures );
		
		while ( $totalwidth > $maxwidth ) {
			for($index = $firstIndex; $index <= $lastIndex; $index ++) {
				
				if ($this->pictures [$index]->boxWidth > 1) {
					$cut = min ( floor ( $totalwidth / 50 ) + 1, $this->pictures [$index]->boxWidth, $totalwidth - $maxwidth );
					$this->pictures [$index]->boxWidth -= $cut;
					$totalwidth -= $cut;
				}
				
				if ($totalwidth === $maxwidth)
					break;
			}
		}
		
		if ($firstIndex != - 1) {
			for($i = $firstIndex; $i <= $lastIndex; $i ++) {
				$this->pictures [$i]->source = NGLink::getPictureURL ( $this->pictures [$i]->item->displayPicture ()->objectUID, - 1, $this->rowHeight );
				
				if (NGSettingsSite::getInstance ()->lazyload && NGSettingsSite::getInstance ()->hdpictures) {
					$this->pictures [$i]->sourcehd = NGLink::getPictureURL ( $this->pictures [$i]->item->displayPicture ()->objectUID, - 1, $this->rowHeight * 2 );
				}
				
				$this->pictures [$i]->left = $this->x;
				$this->pictures [$i]->top = $this->y;
				$this->x += $this->pictures [$i]->boxWidth + $this->gutter;
			}
			
			$this->y += $this->rowHeight + $this->gutter;
			$this->x = $this->gutter;
		}
		
		$this->rowCount ++;
		
		return true;
	}

	public function render() {
		$this->currentRenderWidth = $this->renderWidth;
		
		if ($this->responsive && $this->currentRenderWidth < 768)
			$this->currentRenderWidth = 768;
		
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID;
		$this->bouquet->previewMode = $this->previewMode;
		
		$this->bouquet->prepare ();
		
		if (count ( $this->bouquet->items ) == 0) {
			$this->output = '';
			return;
		}
		
		$this->pictures = Array ();
		
		$this->index = - 1;
		
		$this->x = $this->gutter;
		$this->y = $this->gutter;
		
		$this->rowCount = 0;
		
		if ($this->emphasizefirst) {
			$bigpicture = $this->nextPicture ();
			
			$bigpicture->left = $this->gutter;
			$bigpicture->top = $this->gutter;
			
			$bigwidth = floor ( $this->currentRenderWidth / 2 );
			$bigheight = $bigwidth;
			
			$bigpicture->pictureWidth = $bigwidth;
			$bigpicture->boxWidth = $bigwidth;
			$bigpicture->height = $bigheight;
			$bigpicture->source = NGLink::getPictureURL ( $bigpicture->item->displayPicture ()->objectUID, $bigwidth, $bigheight, NGPicture::Ratio1by1 );
			
			if (NGSettingsSite::getInstance ()->lazyload && NGSettingsSite::getInstance ()->hdpictures) {
				$bigpicture->sourcehd = NGLink::getPictureURL ( $bigpicture->item->displayPicture ()->objectUID, $bigwidth * 2, $bigheight * 2, NGPicture::Ratio1by1 );
			}
			
			$this->pictures [0] = $bigpicture;
			
			$this->x = $bigwidth + 2 * $this->gutter;
			$this->rowHeight = floor ( $bigheight / 2 );
			$this->createRow ();
			$this->rowHeight = $bigheight - $this->rowHeight - $this->gutter;
			$this->x = $bigwidth + 2 * $this->gutter;
			$this->createRow ();
		}
		
		$odd = true;
		
		while ( $this->maxRowCount === 0 || $this->rowCount < $this->maxRowCount ) {
			$this->rowHeight = floor ( $this->currentRenderWidth / ($odd ? 4 : 3) );
			$odd = ! $odd;
			if (! $this->createRow ())
				break;
		}
		
		if ($this->rowCount !== 0) {
			
			$template = new NGTemplate ();
			
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'pictures', $this->pictures );
			$template->assign ( 'width', $this->currentRenderWidth );
			$template->assign ( 'bordercolor', $this->matrixbordercolor );
			$template->assign ( 'responsive', $this->responsive );
			if (NGSettingsSite::getInstance ()->lazyload)
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			
			if (isset ( $bigpicture )) {
				$template->assign ( 'height', max ( $this->y, $bigpicture->height + 2 * $this->gutter ) );
			} else {
				$template->assign ( 'height', $this->y );
			}
			
			$template->assign ( 'showcaptions', $this->showcaptions );
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphflexmatrix/tpl/template.tpl' );
			
			$this->styleSheets ['NGPluginParagraphFlexMatrix'] = $this->prependPluginsPath ( 'ngpluginparagraphflexmatrix/css/style.css' );
			$this->javaScripts ['NGPluginParagraphFlexMatrix'] = $this->prependPluginsPath ( 'ngpluginparagraphflexmatrix/js/flexmatrix.js' );
			
			if ($this->allowMobileFullWidth)
				$this->renderMode = self::RenderModeMobileFullWidth;
		} else {
			$this->output = '';
		}
	}
}

class NGPluginParagraphFlexMatrixItem {

	/**
	 *
	 * Enter description here ...
	 * 
	 * @var NGPicture
	 */
	public $item;

	public $source;

	public $sourcehd;

	public $boxWidth;

	public $pictureWidth;

	public $height;

	public $left;

	public $top;

	public $link;

	public $caption;

	public $alt;

	public function offset() {
		return - floor ( ($this->pictureWidth - $this->boxWidth) / 2 );
	}
}