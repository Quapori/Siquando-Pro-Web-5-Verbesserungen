<?php

include_once './../../classes/includes.php';

/**
 * 
 * Creates background pictures
  *
 */
class NGDividerPicture {
	/**
	 * 
	 * Width of picture
	 * @var unknown_type
	 */
	public $width = 900;
	
	/**
	 * 
	 * Script to parse
	 * @var string
	 */
	public $script = '';
	
	/**
	 * 
	 * Image to create
	 */
	private $image=null;
	
	/**
	 * 
	 * Current color
	 * @var unknown_type
	 */
	private $color=null;
	
	/**
	 * 
	 * Tokenized script
	 * @var Array
	 */
	private $tokens = Array ();
	
	/**
	 * 
	 * Folder to use
	 * @var unknown_type
	 */
	const FolderDivider='image_divider';
			
	/**
	 * 
	 * Generate a image filename
	 */
	private function imageFilename()
	{
		return NGUtil::safeFilename($this->width.$this->script.'.png');
	}
	
	/**
	 * 
	 * Render the image
	 */
	public function render() {
		
		NGUtil::createPath(NGConfig::storePath(), self::FolderDivider);
		
		$folder=NGUtil::joinPaths(NGConfig::storePath(), self::FolderDivider);
		$filename=NGUtil::joinPaths($folder, $this->imageFilename());
		
		if (!file_exists($filename))
		{
			$this->parseScript();
			$this->createImage();
			imagepng($this->image, $filename);
		} 
		
		header('Content-Type: image/png');
		readfile($filename);
	}
	
	/**
	 * 
	 * Parse the script
	 */
	private function parseScript() {
		$this->tokens = Array ();
		
		$token = null;
		
		for($i = 0; $i < strlen ( $this->script ); $i ++) {
			$char = substr ( $this->script, $i, 1 );
			
			if ($char == 'l' || $char == 'p') {
				if ($token != null)
					$this->tokens [] = $token;
				$token = new NGToken ( $char );
			} else {
				if ($token != null)
					$token->parameter .= $char;
			}
		}
		
		if ($token != null)
			$this->tokens [] = $token;
	}
	
	/**
	 * 
	 * Create the image
	 */
	private function createImage()
	{
		$this->image = imagecreatetruecolor ( $this->width, 1 );		
		imagesavealpha($this->image, true);
		$this->color = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
		imagefill ( $this->image, 0, 0, $this->color );	
		
		foreach ($this->tokens as $token)
		{
			$this->handleToken($token);
		}
	}
	
	/**
	 * 
	 * Handle a token
	 * @param NGToken $token
	 */
	private function handleToken(NGToken $token)
	{
		switch ($token->action)
		{
			case 'l':
				$this->handleLineToken($token);
				break;
			case 'p':
				$this->handlePaletteToken($token);
				break;
		}
	}
	
	/**
	 * 
	 * Handle a line token
	 * @param NGToken $token
	 */
	private function handleLineToken(NGToken $token)
	{
		$coordinates=explode('t', $token->parameter);
		
		$x1=$coordinates[0];
		$x2=$coordinates[1];
		
		imagefilledrectangle($this->image, $x1, 0, $x2, 0, $this->color);
	}
	
	/**
	 * 
	 * Handle a palette token
	 * @param NGToken $token
	 */
	private function handlePaletteToken(NGToken $token)
	{
		$r=base_convert(substr($token->parameter, 0, 2), 16, 10);
		$g=base_convert(substr($token->parameter, 2, 2), 16, 10);
		$b=base_convert(substr($token->parameter, 4, 2), 16, 10);
				
		$this->color = imagecolorallocate($this->image, $r, $g, $b);
	}
}

/**
 * 
 * Token
  *
 */
class NGToken {
	
	/**
	 * 
	 * Action to perform
	 * @var string
	 */
	public $action = '';
	
	/**
	 * 
	 * Parameter of action
	 * @var string
	 */
	public $parameter = '';
	
	public function __construct($action) {
		$this->action = $action;
	}
}

$picture = new NGDividerPicture();

$picture->width=NGUtil::get('w',900);
$picture->script=NGUtil::get('s','');

$picture->render();