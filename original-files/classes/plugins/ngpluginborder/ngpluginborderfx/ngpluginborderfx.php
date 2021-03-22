<?php

class NGPluginBorderFX {
	public $input;
	
	public $output;
	
	public $inputWidth;
	
	public $outputWidth;
	
	public $objectUID;
	
	public $style;
	
	private $template;
	
	private $cssTemplate;
	
	private $fxStyle;
	
	/**
	 * 
	 * Array with links to style sheets
	 * @var Array
	 */
	public $styles = Array ();
	
	public function prepare() {
		$this->fxStyle = new NGPluginBorderFXStyle ( $this->style );
		
		if ($this->fxStyle->leftInside===-1) $this->fxStyle->leftInside=$this->fxStyle->left;
		if ($this->fxStyle->rightInside===-1) $this->fxStyle->rightInside=$this->fxStyle->right;
		
		$this->outputWidth = $this->inputWidth - $this->fxStyle->totalBorder ();
	}
	
	/**
	 * 
	 * Render the template
	 */
	public function render() {
		$this->templateCSS = new NGRenderCSS ();
		$this->templateCSS->templateFilename = 'ngpluginborder/ngpluginborderfx/tpl/css.tpl';
		$this->templateCSS->template->assign ( 'uid', $this->objectUID );
		$this->templateCSS->template->assign ( 'width', $this->outputWidth );
		$this->templateCSS->template->assign ( 'totalwidth', $this->inputWidth );
		$this->templateCSS->template->assign ( 'fx', $this->fxStyle );
		$this->templateCSS->template->assign ( 'image', NGUtil::prependRootPath ( 'classes/plugins/ngpluginborder/ngpluginborderfx/image/' ) );
		$this->templateCSS->render ();
		$this->styles ['borderfx' . $this->objectUID] = $this->templateCSS->output;
		
		$this->template = new NGTemplate ();
		$this->template->assign ( 'uid', $this->objectUID );
		$this->template->assign ( 'para', $this->input );
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginborder/ngpluginborderfx/tpl/border.tpl' );
	}
}

class NGPluginBorderFXStyle {
	const FolderBorderFX = 'image_borderfx';
	
	public $styleFile = '';
	
	public $top = 0;
	
	public $bottom = 0;
	
	public $left = 0;
	
	public $leftInside = - 1;
	
	public $rightInside = - 1;
	
	public $right = 0;
	
	public $imageWidth = 0;
	
	public $imageHeight = 0;
	
	public $inputImage = '';
	
	public $outputImage;
	
	public $outputWidth = 900;
	
	private function stylesFolder() {
		return NGUtil::joinPaths ( NGConfig::pluginsPath (), 'ngpluginborder/ngpluginborderfx/styles' );
	}
	
	public function totalBorder() {
		return $this->leftInside + $this->rightInside;
	}
	
	/**
	 * 
	 * Generate a image filename
	 */
	private function imageFilename($mode) {
		return NGUtil::safeFilename ( $this->styleFile . $this->outputWidth . strtolower ( $mode ) . '.png' );
	}
	
	/**
	 * 
	 * Render the image
	 * @param string $mode
	 */
	public function render($mode) {
		NGUtil::createPath ( NGConfig::storePath (), self::FolderBorderFX );
		$folder = NGUtil::joinPaths ( NGConfig::storePath (), self::FolderBorderFX );
		$filename = NGUtil::joinPaths ( $folder, $this->imageFilename ( $mode ) );
				
		NGUtil::handleEtag ( $filename );
		
		if (! file_exists ( $filename ) || NGConfig::DebugMode) {
			$this->createImage ( $mode );
			imagepng ( $this->outputImage, $filename );
		}
		
		
		header ( 'Content-Type: image/png' );
		readfile ( $filename );
	}
	
	public function createImage($mode) {
				
		
		NGUtil::createPath ( NGConfig::storePath (), self::FolderBorderFX );
		
		$this->inputImage = imagecreatefrompng ( NGUtil::joinPaths ( $this->stylesFolder (), $this->styleFile . '/image.png' ) );
				
		if (!$this->inputImage) NGUtil::HeaderNotFound();
		
		$this->imageWidth = imagesx ( $this->inputImage );
		$this->imageHeight = imagesy ( $this->inputImage );
				
		
		switch ($mode) {
			case 't' :
				$top = 0;
				$height = $this->top+1;
				// 1px extra for overlap in zoomed browsers
				break;
			case 'm' :
				$top = $this->top;
				$height = $this->imageHeight - $this->top - $this->bottom;
				break;
			case 'b' :
				$top = $this->imageHeight - $this->bottom;
				$height = $this->bottom;
				break;
		}
				
				
		$this->outputImage = imagecreatetruecolor ( $this->outputWidth, $height );
		imagealphablending ( $this->outputImage, false );
		imagesavealpha ( $this->outputImage, true );
		$color = imagecolorallocatealpha ( $this->outputImage, 0, 0, 0, 127 );
		imagefill ( $this->outputImage, 0, 0, $color );
		
		$outputInnerWidth = $this->outputWidth - $this->left - $this->right;
		$inputInnerWidth = $this->imageWidth - $this->left - $this->right;
		
		$offset = floor ( ($inputInnerWidth - $outputInnerWidth) / 2 );
		
		imagecopy ( $this->outputImage, $this->inputImage, 0, 0, 0, $top, $this->left, $height);
		imagecopy ( $this->outputImage, $this->inputImage, $this->outputWidth - $this->right, 0, $this->imageWidth - $this->right, $top, $this->right, $height);
		imagecopy ( $this->outputImage, $this->inputImage, $this->left, 0, $this->left + $offset, $top, $outputInnerWidth, $height );
	}
	
	public function __construct($filename) {
		$this->styleFile = $filename;
		$this->parseStyleFile ();
	}
	
	public function parseStyleFile() {
		$xml = new DOMDocument ('1.0', 'UTF-8');
		$xml->load ( NGUtil::joinPaths ( $this->stylesFolder (), $this->styleFile . '/style.xml' ) );
		
		foreach ( $xml->documentElement->childNodes as $configNode ) {
			/* @var $configNode DOMElement */
			if ($configNode->nodeType == XML_ELEMENT_NODE) {
				switch ($configNode->nodeName) {
					case 'top' :
						$this->top = $configNode->nodeValue;
						break;
					case 'bottom' :
						$this->bottom = $configNode->nodeValue;
						break;
					case 'left' :
						$this->left = $configNode->nodeValue;
						break;
					case 'leftinside' :
						$this->leftInside = $configNode->nodeValue;
						break;
					case 'right' :
						$this->right = $configNode->nodeValue;
						break;
					case 'rightinside' :
						$this->rightInside = $configNode->nodeValue;
						break;
				}
			}
		}
	
	}
}
