<?php

include_once './../../classes/includes.php';

/**
 * 
 * Creates background pictures
 *
 */
class NGGradientPicture {
	/**
	 * 
	 * height of picture
	 * @var int
	 */
	public $height = 256;
	
	/**
	 * 
	 * Start color
	 * @var string
	 */
	public $startColor = 'ffffff';
	
	/**
	 * 
	 * End color
	 * @var string
	 */
	public $endColor = '000000';
			
	
	/**
	 * 
	 * SVG Prototype
	 * @var string 
	 */
	const SVG='<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full" width="1" height="[h]" viewBox="0 0 1.00 [h].00" xml:space="preserve"><linearGradient id="fade" gradientUnits="objectBoundingBox" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#[s]"/><stop offset="1" stop-color="#[e]"/></linearGradient><rect x="0" y="0" fill="url(#fade)" width="1" height="[h]"/></svg>';
	
	/**
	 * 
	 * Generate a image filename
	 */
	private function imageFilename() {
		return NGUtil::safeFilename ( $this->startColor . $this->endColor . $this->height . '.svg' );
	}
	
	/**
	 * 
	 * Render the image
	 */
	public function render() {
		NGUtil::handleEtag( $this->imageFilename() );
		header ( 'Content-Type: image/svg+xml' );
		echo (str_replace(array('[s]','[e]','[h]'), array($this->startColor, $this->endColor, $this->height), self::SVG));
	}	
}

$picture = new NGGradientPicture ();

$picture->startColor = NGUtil::get ( 's', 'ffffff' );
$picture->endColor = NGUtil::get ( 'e', '000000' );
$picture->height = NGUtil::get ( 'h', 256 );

$picture->render ();