<?php
include_once './../../../../includes.php';
include_once './../ngpluginparagraphcounter.php';
class NGCounter {
	
	/**
	 *
	 * URI of SVG namepsace
	 *
	 * @var string
	 */
	const SVG_NS = 'http://www.w3.org/2000/svg';
	
	/**
	 *
	 * Image template
	 *
	 * @var resource
	 */
	public $imageDigits;
	
	/**
	 *
	 * @var DOMDocument
	 */
	public $docDigits;
	
	/**
	 *
	 * @var DOMDocument
	 */
	public $doc;
	
	/**
	 *
	 * Output image
	 *
	 * @var resource
	 */
	public $image;
	
	/**
	 *
	 * Filename of template
	 *
	 * @var string
	 */
	public $filename;
	
	/**
	 *
	 * Vector
	 *
	 * @var bool
	 */
	public $svg = false;
	
	/**
	 *
	 * Numer of digits
	 *
	 * @var int
	 */
	public $numberOfDigits = 8;
	
	/**
	 *
	 * Size of segment
	 *
	 * @var unknown_type
	 */
	public $size;
	
	/**
	 *
	 * Object UID of paragraph
	 *
	 * @var string
	 */
	public $objectUID = '';
	
	/**
	 *
	 * Number of hits
	 *
	 * @var int
	 */
	public $number = 0;
	
	/**
	 *
	 * Enter description here ...
	 *
	 * @var NGPluginParagraphCounter
	 */
	public $paragraph;
	
	/**
	 *
	 * Enter description here ...
	 *
	 * @var NGPluginParagraphCounter
	 */
	public $paragraphViews;
	
	/**
	 * Renders all
	 */
	public function render() {
		$this->count ();
		$this->setupStyle ();
		if ($this->svg) {
			$this->loadSVG ();
			$this->createSVG ();
			$this->outputSVG ();
		} else {
			$this->load ();
			$this->create ();
			$this->output ();
		}
	}
	
	/**
	 * Counts access
	 */
	public function count() {
		if ($this->objectUID === '')
			NGUtil::HeaderNotFound ();
		
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGSession::getInstance ()->stepsToRoot = 5;
		NGSession::getInstance ()->currentPath = 'classes/plugins/ngpluginparagraph/ngpluginparagraphcounter/images/';
		NGDBConnector::getInstance ()->connect ();
		
		$adapter = new NGDBAdapterObject ();
		$this->paragraphView = $adapter->loadObject ( $this->objectUID, NGPluginParagraph::ObjectTypePluginParagraph, NGPluginParagraphCounterViews::ObjectTypePluginParagraphCounterViews );
		
		if ($this->paragraphView === null)
			NGUtil::HeaderNotFound ();
		
		$this->paragraphView->views ++;
		$this->number = $this->paragraphView->views;
		
		$adapter->saveObject ( $this->paragraphView, '', false, false, true, false, false, false );
	}
	
	/**
	 * Loads the template
	 */
	public function load() {
		if ($this->paragraph->style != '_blank') {
			$this->imageDigits = imagecreatefrompng ( $this->filename );
			$this->size = imagesy ( $this->imageDigits );
		}
	}
	/**
	 * Loads the template
	 */
	public function loadSVG() {
		if ($this->paragraph->style != '_blank') {
			
			$this->docDigits = new DOMDocument ( '1.0', 'UTF-8' );
			$this->docDigits->load ( $this->filename );
			
			/* @var $root DOMElement */
			$root = $this->size = $this->docDigits->documentElement;
			
			$this->size = intval ( $root->getAttribute ( 'height' ) );
		}
	}
	
	/**
	 *
	 * @param double $value        	
	 * @return string
	 */
	private static function formatDouble($value) {
		return number_format ( $value, 5, '.','' );
	}
	
	/**
	 * Create SVG Document
	 */
	public function createSVG() {
		$implementation = new DOMImplementation ();
		$documentType = $implementation->createDocumentType ( "svg", "-//W3C//DTD SVG 1.1//EN", "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd" );
		
		$this->doc = $implementation->createDocument ( 'http://www.w3.org/2000/svg', 'svg', $documentType );
		$this->doc->formatOutput = true;
				
		/* @var $root DOMElement */
		$root = $this->doc->documentElement;
				
		$version = $this->doc->createAttribute ( 'version' );
		$version->value = '1.1';
		$root->appendChild ( $version );
		
		$baseProfile = $this->doc->createAttribute ( 'baseProfile' );
		$baseProfile->value = 'full';
		$root->appendChild ( $baseProfile );
		
		$totalWidth = ($this->numberOfDigits + 2) * $this->size;
		
		$width = $this->doc->createAttribute ( 'width' );
		$width->value = $totalWidth;
		$root->appendChild ( $width );
		
		$height = $this->doc->createAttribute ( 'height' );
		$height->value = $this->size;
		$root->appendChild ( $height );
		
		$viewBox = $this->doc->createAttribute ( 'viewBox' );
		$viewBox->value = sprintf ( '0 0 %s %s', self::formatDouble ( $totalWidth ), self::formatDouble ( $this->size ) );
		$root->appendChild ( $viewBox );
		
		$enableBackground = $this->doc->createAttribute ( 'enableBackground' );
		$enableBackground->value = sprintf ( '0 0 %s %s', self::formatDouble ( $totalWidth ), self::formatDouble ( $this->size ) );
		$root->appendChild ( $enableBackground );
		
		$left = $this->doc->importNode ( $this->getPart ( 0 ), true );
		$this->shiftElement ( $left, 0 );
		$root->appendChild ( $left );
		
		$right = $this->doc->importNode ( $this->getPart ( 11 ), true );
		$this->shiftElement ( $right, $totalWidth - $this->size * 12 );
		$root->appendChild ( $right );
		
		$pad = str_pad ( $this->number + $this->paragraph->offset, $this->numberOfDigits, '0', STR_PAD_LEFT );
		
		for($i = 0; $i < $this->numberOfDigits; $i ++) {
			$offset = ( int ) substr ( $pad, $i, 1 );
			$number = $this->doc->importNode ( $this->getPart ( $offset + 1 ), true );
			$this->shiftElement ( $number, ($i - $offset) * $this->size );
			$root->appendChild ( $number );
		}
	}
	/**
	 * Shift an element
	 *
	 * @param DOMElement $element        	
	 * @param inf $offset        	
	 */
	private function shiftElement(DOMElement $element, $offset) {
		foreach ( $element->childNodes as $childNode ) {
			/* @var $childNode DOMElement */
			if ($childNode->nodeType == XML_ELEMENT_NODE) {
				/* @var $x DOMAttr */
				$x = $childNode->getAttribute ( 'x' );
				if ($x !== '') {
					$childNode->setAttribute ( 'x', floatval ( $x ) + $offset );
				}
				$cx = $childNode->getAttribute ( 'cx' );
				if ($cx !== '') {
					$childNode->setAttribute ( 'cx', floatval ( $cx ) + $offset );
				}
				$d = $childNode->getAttribute ( 'd' );
				if ($d !== '') {
					$childNode->setAttribute ( 'd', $this->shiftData ( $d, $offset ) );
				}
				$fill = $childNode->getAttribute ( 'fill' );
				if ($fill !== '') {
					$childNode->setAttribute ( 'fill', str_replace ( '{color}', $this->paragraph->coloricon, $fill ) );
				}
			}
		}
	}
	/**
	 * Shift a digit
	 *
	 * @param string $digit        	
	 * @param string $offset        	
	 */
	private function shiftDigit($digit, $offset) {
		$last = substr ( $digit, - 1 );
		
		if ($last < '0' || $last > '9') {
			$digit = substr ( $digit, 0, - 1 );
		} else {
			$last = '';
		}
		
		$digit = floatval ( $digit ) + $offset;
		
		return $this->formatDouble ( $digit ) . $last;
	}
	
	/**
	 *
	 * @param string $data        	
	 * @param string $offset        	
	 */
	private function shiftData($data, $offset) {
		$parts = explode ( ' ', $data );
		
		for($i = 0; $i < count ( $parts ); $i ++) {
			$digits = explode ( ',', $parts [$i] );
			
			if (count ( $digits ) == 2) {
				$digits [0] = $this->shiftDigit ( $digits [0], $offset );
			}
			$parts [$i] = join ( ',', $digits );
		}
		
		return join ( ' ', $parts );
	}
	
	/**
	 *
	 * @param int $index        	
	 * @return DOMNode
	 */
	private function getPart($index) {
		$parts = $this->docDigits->documentElement->getElementsByTagName ( 'g' );
		
		return $parts [$index];
	}
	
	/**
	 * Output the svg
	 */
	public function outputSVG() {
		header ( 'Content-Type: image/svg+xml' );
		echo ($this->doc->saveXML ());
	}
	public function setupStyle() {
		$adapter = new NGDBAdapterObject ();
		$this->paragraph = $adapter->loadObject ( $this->objectUID, NGPluginParagraph::ObjectTypePluginParagraph, NGPluginParagraphCounter::ObjectTypePluginParagraphCounter );
		
		if (substr ( $this->paragraph->style, - 4 ) == '.svg') {
			$this->filename = './../styles/' . $this->paragraph->style;
			$this->svg = true;
		} else {
			$this->filename = './../styles/' . $this->paragraph->style . '.png';
		}
		$this->numberOfDigits = $this->paragraph->digits;
	}
	
	/**
	 * Outputs the image
	 */
	public function output() {
		header ( 'Content-Type: image/png' );
		imagepng ( $this->image );
	}
	
	/**
	 * Creates the image
	 */
	public function create() {
		if ($this->paragraph->style == '_blank') {
			$this->image = imagecreatetruecolor ( 1, 1 );
			imagesavealpha ( $this->image, true );
			$color = imagecolorallocatealpha ( $this->image, 0, 0, 0, 127 );
			imagefill ( $this->image, 0, 0, $color );
		} else {
			$this->image = imagecreatetruecolor ( ($this->numberOfDigits + 2) * $this->size, $this->size );
			imagesavealpha ( $this->image, true );
			$color = imagecolorallocatealpha ( $this->image, 0, 0, 0, 127 );
			imagefill ( $this->image, 0, 0, $color );
			imagecopy ( $this->image, $this->imageDigits, 0, 0, 0, 0, $this->size, $this->size );
			imagecopy ( $this->image, $this->imageDigits, ($this->numberOfDigits + 1) * $this->size, 0, 11 * $this->size, 0, $this->size, $this->size );
			
			$pad = str_pad ( $this->number + $this->paragraph->offset, $this->numberOfDigits, '0', STR_PAD_LEFT );
			
			for($i = 0; $i < $this->numberOfDigits; $i ++) {
				imagecopy ( $this->image, $this->imageDigits, ($i + 1) * $this->size, 0, (( int ) substr ( $pad, $i, 1 ) + 1) * $this->size, 0, $this->size, $this->size );
			}
		}
	}
}

$counter = new NGCounter ();
$counter->objectUID = NGUtil::get ( 'u', '' );
$counter->render ();