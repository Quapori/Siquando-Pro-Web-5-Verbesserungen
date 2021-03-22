<?php

/**
 * 
 * Creates an edge
  *
 */
class NGEdge {
	
	/**
	 * 
	 * Image to create
	 */
	private $image=null;
	
	/**
	 * 
	 * Color
	 * @var string
	 */
	public $color='ff0000';
					
	/**
	 * 
	 * Render the image
	 */
	public function render() {
		
		$this->handleEtag($this->color);
		$this->createImage();
		header('Content-Type: image/png');
		imagepng($this->image);		
	}
	
	
	/**
	 * 
	 * Create the image
	 */
	private function createImage()
	{	
		$this->image = imagecreatetruecolor ( 20,10 );		
		imagesavealpha($this->image, true);
		$transcolor = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
		imagefill ( $this->image, 0, 0, $transcolor );

		$r=base_convert(substr($this->color, 0, 2), 16, 10);
		$g=base_convert(substr($this->color, 2, 2), 16, 10);
		$b=base_convert(substr($this->color, 4, 2), 16, 10);
				
		$fillcolor = imagecolorallocate($this->image, $r, $g, $b);
	
		$points = array(
            0,0,
            20,0,
            20,10   
        );
        
        imagefilledpolygon($this->image, $points, 3, $fillcolor);
	}
	
	/**
	 * 
	 * Handles an etag
	 * @param string $tag
	 */
	private function handleEtag($tag) {
		
		$etag = '"' . md5 ( $tag ) . '"';
		if (isset ( $_SERVER ['HTTP_IF_NONE_MATCH'] )) {
			if ($_SERVER ['HTTP_IF_NONE_MATCH'] == $etag) {
				header ( 'Etag: ' . $etag );
				header ( 'HTTP/1.1 304 Not Modified' );
				exit ();
			}
		}
		header ( 'Etag: ' . $etag );
	}
	
}

$picture = new NGEdge();
$picture->color=array_key_exists('c', $_GET) ? $_GET['c'] : 'ffffff';
$picture->render();