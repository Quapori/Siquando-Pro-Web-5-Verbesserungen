<?php

class NGPluginPage extends NGObjectNamedSummaryPicture {
	const ObjectTypePluginPage = 'NGPluginPage';
	const DomainPage = 'page';
	
	const SSLModeKeep='';
	const SSLModeSSL='ssl';
	const SSLModeHttp='http';
	
	/**
	 * 
	 * Name of plugin
	 * @var string
	 */
	public $pluginName = '';
	
	/**
	 * 
	 * Category of plugin
	 * @var string
	 */
	public $pluginCategory = '';
	
	/**
	 * 
	 * Meta tags 
	 * @var Array
	 */
	public $metaTags = array ();
	
	/**
	 * 
	 * User HTMl Code
	 * @var Array
	 */
	public $htmlCode = array ();
	
	/**
	 * 
	 * Date and time the paragraph is visible from
	 * @var string
	 */
	public $visibleFrom = '';
	
	/**
	 * 
	 * Date and time the paragraph is visible to
	 * @var string
	 */
	public $visibleTo = '';
	
	/**
	 * 
	 * Should the page be hidden
	 * @var bool
	 */
	public $hide = false;
	
	/**
	 * 
	 * Should the pagecaption be hidden
	 * @var bool
	 */
	public $hidecaption = false;
	
	/**
	 * 
	 * Forward to url
	 * @var unknown_type
	 */
	public $forward = '';
	
	/**
	 * 
	 * List of hidden paragraphStream
	 * @var string
	 */
	public $hiddenParagraphStreams = '';
	
	/**
	 * 
	 * Render page in preview mode
	 * @var bool
	 */
	public $previewMode = false;
	
	/**
	 * 
	 * Array with links to style sheets
	 * @var Array
	 */
	public $styleSheets = Array ();
	
	/**
	 * 
	 * Array with inline styles
	 * @var Array
	 */
	public $styles = Array ();
	
	/**
	 * 
	 * Array with javascript
	 * @var Array
	 */
	public $javaScripts = Array ();
	
	/**
	 * 
	 * FTS Data
	 * @var string
	 */
	public $ftsData = '';

    /**
     * @var bool Include in FTS
     */
	public $fts=true;
	
	/**
	 * 
	 * Do not cache
	 * @var boolean
	 */
	public $dontCache = false;
	
	/**
	 * 
	 * Deliver as SSL
	 * @var string
	 */
	public $sslmode=self::SSLModeKeep;

    /**
     * @var stringID of linked product
     */
	public $productuid='';
	
	/**
	 * 
	 * Loaded paragraph streams
	 * @var Array
	 */
	public $paragraphStreams = Array ();
	
	/**
	 * 
	 * HTML-Title
	 * @var string
	 */
	public $title='';
	
	
	public function render() {
	}
	
	public function prepare() {
	}
	
	public function renderParagraphStream(NGParagraphStream $paragraphStream, NGPluginPage $masterPage = null) {
	}
	
	/**
	 * 
	 * Time for next change
	 * @var string
	 */
	public $nextScheduledChange = '';
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pluginname', NGProperty::TypeString, self::DomainPage, 'pluginName', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'plugincategory', NGProperty::TypeString, self::DomainPage, 'pluginCategory', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hiddenparagraphstreams', NGProperty::TypeString, self::DomainPage, 'hiddenParagraphStreams', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'metatags', NGProperty::TypeString, NGUtil::DomainSEO, 'metaTags', NGPropertyMapped::MultiplicityDictornary, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'htmlcode', NGProperty::TypeString, NGUtil::DomainSEO, 'htmlCode', NGPropertyMapped::MultiplicityDictornary );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visiblefrom', NGProperty::TypeDateTime, self::DomainPage, 'visibleFrom', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visibleto', NGProperty::TypeDateTime, self::DomainPage, 'visibleTo', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hide', NGProperty::TypeBool, self::DomainPage, 'hide', NGPropertyMapped::MultiplicityScalar, false, false, false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'fts', NGProperty::TypeBool, self::DomainPage, 'fts', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'forward', NGProperty::TypeText, self::DomainPage, 'forward', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hidecaption', NGProperty::TypeBool, self::DomainPage, 'hidecaption', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'title', NGProperty::TypeString, NGUtil::DomainSEO, 'title', NGPropertyMapped::MultiplicityScalar, true, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sslmode', NGProperty::TypeString, self::DomainPage, 'sslmode', NGPropertyMapped::MultiplicityScalar, false, self::SSLModeKeep );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'productuid', NGProperty::TypeUID, self::DomainPage, 'productuid', NGPropertyMapped::MultiplicityScalar, false, '' );
		
	}
	
	public function pageCaption()
	{
		return ($this->hidecaption)?'':$this->caption;
	}
	
	public function displayTitle()
	{
		return ($this->title==='')?$this->caption:$this->title;
	}
	
	/**
	 * 
	 * Should the paragraph be visible
	 */
	public function isVisible() {
		return ($this->hide) ? false : NGUtil::isCurrentDateBetween ( $this->visibleFrom, $this->visibleTo );
	}
	
	/**
	 * 
	 * When will the visibility change for the next time
	 */
	public function nextVisibilityChange() {
		return NGUtil::nextDate ( $this->visibleFrom, $this->visibleTo );
	}
}