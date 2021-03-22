<?php

class NGPluginTeaser {

	/**
	 *
	 * Render page in preview mode
	 * 
	 * @var bool
	 */
	public $previewMode = false;

	/**
	 *
	 * Output of renderer
	 * 
	 * @var string
	 */
	public $output = '';

	/**
	 *
	 * Array with links to style sheets
	 * 
	 * @var Array
	 */
	public $styleSheets = Array ();

	/**
	 *
	 * Array with required scripts
	 * 
	 * @var Array
	 */
	public $javaScripts = Array ();

	/**
	 *
	 * Array with inline styles
	 * 
	 * @var Array
	 */
	public $styles = Array ();

	/**
	 *
	 * Render width of plugin
	 * 
	 * @var int
	 */
	public $renderWidth;
	
	/**
	 *
	 * Can render as mobilefullwidth
	 *
	 * @var bool
	 */
	public $allowMobileFullWidth = false;
	
	/**
	 *
	 * Can render as alwaysfullwidth
	 *
	 * @var bool
	 */
	public $allowAlwaysFullWidth = false;
	
	/**
	 *
	 * Render responsive
	 *
	 * @var bool
	 */
	public $responsive = false;
	
	/**
	 *
	 * @var chosen rendermode
	 */
	public $renderMode = NGPluginParagraph::RenderModeAlwaysBoxed;
	
	/**
	 *
	 * ID of plugin
	 * 
	 * @var string
	 */
	public $id = '';

	/**
	 *
	 * Configuration
	 * 
	 * @var Array
	 */
	public $configuration;

	/**
	 *
	 * Bouquet to use
	 * 
	 * @var NGBouquet
	 */
	public $bouquet;

	/**
	 *
	 * object UID of paragraph
	 * 
	 * @var string
	 */
	public $objectUID;

	/**
	 *
	 * Teaser items
	 * 
	 * @var Array
	 */
	protected $teaserItems = Array ();

	/**
	 *
	 * Creates a teaser plugin by id
	 * 
	 * @param string $id        	
	 * @return NGPluginTeaser
	 */
	public static function createByID($id) {
		$includeFilename = NGClassFolder () . 'plugins/ngpluginteaser/' . strtolower ( $id ) . '/' . strtolower ( $id ) . '.php';
		
		if (file_exists ( $includeFilename )) {
			require_once ($includeFilename);
			if (NGDBAdapterObject::isCompatibleSubclass ( $id )) {
				return new $id ();
			} else {
				$plugin = new NGPluginTeaser ();
				$plugin->id = $id;
				
				return $plugin;
			}
		} else {
			$plugin = new NGPluginTeaser ();
			$plugin->id = $id;
			
			return $plugin;
		}
	}

	/**
	 * Renders the paragraph
	 */
	public function render() {
		$this->output = '<p style="text-align: center;">Das Plugin <em>"' . $this->id . '"</em> ist nicht installiert oder nicht mit der aktuellen Version von SIQUANDO Pro kompatibel.</p>';
	}

	/**
	 *
	 * Prepend the plugins path
	 * 
	 * @param string $path        	
	 */
	public function prependPluginsPath($path) {
		return NGUtil::prependRootPath ( NGUtil::joinPaths ( 'classes/plugins/ngpluginteaser', $path ) );
	}

	/**
	 *
	 * Template renderer
	 * 
	 * @var NGTemplate
	 */
	public $template;

	public function __construct() {
		$this->template = new NGTemplate ();
	}
}

class NGPluginTeaserItem {

	public $caption;

	public $summary;

	public $link;

	public $picturesource;

	public $picturesize;

	public $margintop;

	public $marginleft;

	public $hidden;
}