<?php

class NGPluginEyecatcher
{
	/**
	 * 
	 * Render page in preview mode
	 * @var bool
	 */
	public $previewMode = false;
	
	/**
	 * 
	 * Output of renderer
	 * @var string
	 */
	public $output = '';
	
	/**
	 * 
	 * Current page
	 * @var NGPluginPage
	 */
	public $currentPage = null;
	
	/**
	 * 
	 * Current topic
	 * @var NGTopic
	 */
	public $currentTopic = null;
	
	/**
	 * 
	 * Array with links to style sheets
	 * @var Array
	 */
	public $styleSheets = Array ();
	
	/**
	 * 
	 * Array with required scripts
	 * @var Array
	 */
	public $javaScripts = Array ();
	
	/**
	 * 
	 * Array with inline styles
	 * @var Array
	 */
	public $styles = Array ();
	
	/**
	 * 
	 * Is the plugin visible
	 * @var bool
	 */
	public $isVisible=true;
	
	/**
	 * 
	 * Render width of plugin
	 * @var int
	 */
	public $renderWidth;
	
	/**
	 * 
	 * Target DIV to render to
	 * @var string
	 */
	public $targetDIV;
	
	/**
	 * 
	 * Setting
	 * @var string
	 */
	public $setting;
	
	/**
	 * 
	 * Renders as empty
	 * @var bool
	 */
	public $isEmpty=false;

	/**
	 * 
	 * Sets the next time the paragraph will change
	 * @var string
	 */
	public $nextScheduledChange='';
	
		
	/**
	 * 
	 * Creates a eyecatcher plugin by id
	 * @param string $id
	 * @return NGPluginEyecatcher
	 */
	public static function createByID($id)
	{
		$includeFilename=NGClassFolder().'plugins/ngplugineyecatcher/'.strtolower($id).'/'.strtolower($id).'.php';	
		
		if (file_exists($includeFilename)) {
			require_once($includeFilename);
			return new $id;	
		} else {
			return new NGPluginEyecatcher();
		} 
	}
	
	/**
	 * 
	 * Creates a eyectacher plugin by setting
	 * @param string $setting
	 * @return NGPluginEyecatcher
	 */
	public static function createBySetting($setting)
	{
		/* $plugin NGPluginEyecatcher */
		$plugin = self::createByID(NGUtil::leftOfSeparator($setting, ','));
		$plugin->setting=$setting;
		
		return $plugin;
	}
	
	/**
	 * 
	 * Sets search
	 */
	protected function setSearch() {
		$adapter=new NGDBAdapterObject();
		
		$pages = $adapter->loadSetting ( NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages );
		if (array_key_exists ( 'search', $pages->pageuids )) {
			$seachlink = new NGLink ();
			$seachlink->linkType = NGLink::LinkPage;
			$seachlink->previewMode = $this->previewMode;
			$seachlink->uid = $pages->pageuids ['search'];
			$this->template->assign ( 'search', $seachlink->getURL () );
		} else {
			$this->template->assign ( 'search', '' );
		}
		$langSearch = new NGLanguageAdapter ();
		$langSearch->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphsearch/language/langsearch.xml';
		$langSearch->load ();
		$this->template->assign ( 'langsearch', $langSearch->languageResources );
	}
	
	
	/**
	 * 
	 * Renders the paragraph
	 */
	public function render()
	{
		$this->output='<p style="text-align: center;">Plugin <em>"'.NGUtil::leftOfSeparator($this->setting, ',').'"</em> is not installed.</p>';
	}
	
	/**
	 * 
	 * Template renderer
	 * @var NGTemplate
	 */
	public $template;
	
	public function __construct() {
		$this->template = new NGTemplate ();
	}
	
}