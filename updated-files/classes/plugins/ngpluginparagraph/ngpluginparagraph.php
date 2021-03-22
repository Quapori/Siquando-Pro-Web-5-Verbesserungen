<?php
class NGPluginParagraph extends NGObjectNamedSummaryPicture {
	const ObjectTypePluginParagraph = 'NGPluginParagraph';
	const DomainParagraph = 'paragraph';
	const DomainBorder = 'border';
	const RenderModeAlwaysBoxed = 'allwaysboxed';
	const RenderModeMobileFullWidth = 'mobilefullwidth';
	const RenderModeAlwaysFullWidth = 'allwaysfullwidth';
	
	/**
	 *
	 * Name of plugin
	 * 
	 * @var string
	 */
	public $pluginName = '';
	
	/**
	 *
	 * Category of plugin
	 * 
	 * @var string
	 */
	public $pluginCategory = '';
	
	/**
	 *
	 * Style of border
	 * 
	 * @var string
	 */
	public $borderstyle = 'None';
	
	/**
	 *
	 * Selected FX Style
	 * 
	 * @var string
	 */
	public $fxstyle = 'default';
	
	/**
	 *
	 * Background
	 * 
	 * @var string
	 */
	public $background = 'solid ffffff';
	
	/**
	 *
	 * Width of border
	 * 
	 * @var string
	 */
	public $borderwidth = '1';
	
	/**
	 *
	 * Color of border
	 * 
	 * @var string
	 */
	public $bordercolor = 'e3e3e3';
	
	/**
	 *
	 * Margin of border
	 * 
	 * @var string
	 */
	public $margin = '0';
	
	/**
	 *
	 * Padding of border
	 * 
	 * @var string
	 */
	public $padding = '10';
	
	/**
	 *
	 * Shadow of border
	 * 
	 * @var unknown_type
	 */
	public $shadow = '3 3 0 SE';
	
	/**
	 *
	 * roundness of border
	 * 
	 * @var string
	 */
	public $roundedcorners = '0';
	
	/**
	 *
	 * Keywords
	 * 
	 * @var string
	 */
	public $keywords = '';
	
	/**
	 *
	 * Date and time the paragraph is visible from
	 * 
	 * @var string
	 */
	public $visibleFrom = '';
	
	/**
	 *
	 * Date and time the paragraph is visible to
	 * 
	 * @var string
	 */
	public $visibleTo = '';
	
	/**
	 *
	 * Hide the pararaph
	 * 
	 * @var bool
	 */
	public $hide = false;
	
	/**
	 *
	 * Hide the pararaph
	 * 
	 * @var bool
	 */
	public $hideMobile = false;
	
	/**
	 *
	 * Hide the pararaph
	 *
	 * @var bool
	 */
	public $hideDesktop = false;
	
	/**
	 *
	 * Level of paragraph headline 1-6
	 * 
	 * @var int
	 */
	public $level = 2;
	
	/**
	 *
	 * Margin bottom
	 * 
	 * @var int
	 */
	public $marginbottom = 30;
	
	/**
	 *
	 * Width of paragraph to render
	 * 
	 * @var int
	 */
	public $renderWidth = 0;
	
	/**
	 *
	 * Width of paragrapgh with border
	 * 
	 * @var int
	 */
	public $renderWidthWithBorder = 0;
	
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
	 * Sets the next time the paragraph will change
	 * 
	 * @var string
	 */
	public $nextScheduledChange = '';
	
	/**
	 *
	 * Current page
	 * 
	 * @var NGPluginPage
	 */
	public $currentPage = null;

    /**
     *
     * Current paragraph stream
     *
     * @var NGPluginPage
     */
    public $currentParagraphStream = null;


	/**
	 *
	 * Array with links to style sheets
	 * 
	 * @var Array
	 */
	public $styleSheets = Array ();
	
	/**
	 *
	 * Array with inline styles
	 * 
	 * @var Array
	 */
	public $styles = Array ();
	
	/**
	 *
	 * Array with javascripts
	 * 
	 * @var Array
	 */
	public $javaScripts = Array ();
	
	/**
	 *
	 * Array with metaTags
	 *
	 * @var Array
	 */
	public $metaTags = Array ();
	
	
	/**
	 *
	 * Do not cache
	 * 
	 * @var boolean
	 */
	public $dontCache = false;
	
	/**
	 * 
	 * Is Paragraph an anchor?
	 * 
	 * @var boolean
	 */
	public $isanchor=false;
	
	/**
	 * 
	 * Text of acnhor
	 * 
	 * @var string
	 */
	public $anchortext='';

    /**
     * @var int width of paragraph in percent
     */
	public $paragraphwidth=100;

    /**
     * @var int maximal paragraph width, -1 when undefined
     */
	public $paragraphmaxwidth=-1;

    /**
     * @var string Alignment of paragraph
     */
	public $paragraphalign='Center';
	
	
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
	 * Mobile width
	 *
	 * @var integer
	 */
	public $mobileWidth = 1023;
	
	
	/**
	 *
	 * @var chosen rendermode
	 */
	public $renderMode = self::RenderModeAlwaysBoxed;
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pluginname', NGProperty::TypeString, self::DomainParagraph, 'pluginName', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'plugincategory', NGProperty::TypeString, self::DomainParagraph, 'pluginCategory', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'borderstyle', NGProperty::TypeString, self::DomainBorder, 'borderstyle', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fxstyle', NGProperty::TypeString, self::DomainBorder, 'fxstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'background', NGProperty::TypeString, self::DomainBorder, 'background', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'borderwidth', NGProperty::TypeString, self::DomainBorder, 'borderwidth', NGPropertyMapped::MultiplicityScalar, false, '1', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bordercolor', NGProperty::TypeString, self::DomainBorder, 'bordercolor', NGPropertyMapped::MultiplicityScalar, false, 'e3e3e3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'margin', NGProperty::TypeString, self::DomainBorder, 'margin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'padding', NGProperty::TypeString, self::DomainBorder, 'padding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'shadow', NGProperty::TypeString, self::DomainBorder, 'shadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'roundedcorners', NGProperty::TypeString, self::DomainBorder, 'roundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'keywords', NGProperty::TypeFulltext, NGUtil::DomainSEO, 'keywords', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visiblefrom', NGProperty::TypeDateTime, self::DomainParagraph, 'visibleFrom', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visibleto', NGProperty::TypeDateTime, self::DomainParagraph, 'visibleTo', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hide', NGProperty::TypeBool, self::DomainParagraph, 'hide', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hidemobile', NGProperty::TypeBool, self::DomainParagraph, 'hideMobile', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'hidedesktop', NGProperty::TypeBool, self::DomainParagraph, 'hideDesktop', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'level', NGProperty::TypeInt, self::DomainParagraph, 'level', NGPropertyMapped::MultiplicityScalar, false, 2, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'marginbottom', NGProperty::TypeInt, self::DomainParagraph, 'marginbottom', NGPropertyMapped::MultiplicityScalar, false, 10, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'isanchor', NGProperty::TypeBool, self::DomainParagraph, 'isanchor', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'anchortext', NGProperty::TypeString, self::DomainParagraph, 'anchortext', NGPropertyMapped::MultiplicityScalar, true, '', false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'paragraphwidth', NGProperty::TypeInt, self::DomainParagraph, 'paragraphwidth', NGPropertyMapped::MultiplicityScalar, false, 100, false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'paragraphmaxwidth', NGProperty::TypeInt, self::DomainParagraph, 'paragraphmaxwidth', NGPropertyMapped::MultiplicityScalar, false, -1, false );
        $this->propertiesMapped [] = new NGPropertyMapped ( 'paragraphalign', NGProperty::TypeString, self::DomainParagraph, 'paragraphalign', NGPropertyMapped::MultiplicityScalar, false, 'Center', false );
	}
	
	/**
	 * 
	 * Anchor text or caption
	 * 
	 * @return string
	 */
	public function DisplayAnchorText()
	{
		return $this->anchortext==='' ? $this->caption : $this->anchortext; 
	}
	
	/**
	 * Should the paragraph be visible
	 */
	public function isVisible() {
		
		
		if ($this->hide) return false;
		if (NGUtil::isMobile () && $this->hideMobile) return false;
		if (!$this->responsive && $this->hideDesktop && !NGUtil::isMobile()) return false;
		
		
		return NGUtil::isCurrentDateBetween ( $this->visibleFrom, $this->visibleTo );
	}
	
	public function getVisibleClass() {
		if ($this->responsive) {
			if ($this->hideDesktop) return 'sqrdesktophidden';
			if ($this->hideMobile) return 'sqrmobilehidden';
		}
		return '';
	}
	
	/**
	 * When will the visibility change for the next time
	 */
	private function nextVisibilityChange() {
		return NGUtil::nextDate ( $this->visibleFrom, $this->visibleTo );
	}
	
	/**
	 * When will the paragraph change its content for the next time
	 */
	public function nextScheduledChange() {
		return NGUtil::nextDate ( $this->nextScheduledChange, $this->nextVisibilityChange () );
	}
	public function prependPluginsPath($path) {
		return NGUtil::prependRootPath ( NGUtil::joinPaths ( 'classes/plugins/ngpluginparagraph', $path ) );
	}
	
	/**
	 * Renders the output
	 */
	public function render() {
		$this->output = '';
	}
	public function renderWithBorder() {
		if (NGUtil::isMobile ()) {
			$this->renderWidth = $this->renderWidthWithBorder;
			$this->render ();
		} else {
			switch ($this->borderstyle) {
				case 'GlobalStandard' :
				case 'LocalStandard' :
					$borderStandard = new NGPluginBorderStandard ();
					$borderStandard->inputWidth = $this->renderWidthWithBorder;
					$borderStandard->objectUID = $this->objectUID;
					$borderStandard->localStyle = $this->borderstyle === 'LocalStandard';
					$borderStandard->settings->background = $this->background;
					$borderStandard->settings->borderwidth = $this->borderwidth;
					$borderStandard->settings->bordercolor = $this->bordercolor;
					$borderStandard->settings->margin = $this->margin;
					$borderStandard->settings->padding = $this->padding;
					$borderStandard->settings->shadow = $this->shadow;
					$borderStandard->settings->roundedcorners = $this->roundedcorners;
					$borderStandard->responsive = $this->responsive;
					$borderStandard->prepare ();
					$this->renderWidth = $borderStandard->outputWidth;
					
					if ($this->responsive && $this->renderWidth < $this->mobileWidth && $this->allowMobileFullWidth)
						$this->renderWidth = $this->mobileWidth;

					$this->render ();
					$borderStandard->input = $this->output;
					$borderStandard->render ();
					$this->output = $borderStandard->output;
					
					foreach ( $borderStandard->styles as $id => $style ) {
						if (! array_key_exists ( $id, $this->styles ))
							$this->styles [$id] = $style;
					}
					foreach ( $borderStandard->styleSheets as $id => $style ) {
						if (! array_key_exists ( $id, $this->styles ))
							$this->styleSheets [$id] = $style;
					}
					
					break;
				case 'FX' :
					if ($this->responsive) {
						$this->renderWidth = $this->renderWidthWithBorder;
						$this->render ();
					} else {
						$borderFX = new NGPluginBorderFX ();
						$borderFX->inputWidth = $this->renderWidthWithBorder;
						$borderFX->objectUID = $this->objectUID;
						$borderFX->style = $this->fxstyle;
						$borderFX->prepare ();
						$this->renderWidth = $borderFX->outputWidth;
						$this->render ();
						$borderFX->input = $this->output;
						$borderFX->render ();
						$this->output = $borderFX->output;
						
						foreach ( $borderFX->styles as $id => $style ) {
							if (! array_key_exists ( $id, $this->styles ))
								$this->styles [$id] = $style;
						}
					}
					break;
				default :
					$this->renderWidth = $this->renderWidthWithBorder;
					$this->render ();
					break;
			}
		}
	}
	
	/**
	 *
	 * Perform a callback
	 * 
	 * @param string $param        	
	 * @throws NGException
	 */
	public function callback($method, $param) {
		throw new NGException ( 'Class does not support callback', 30010, true );
	}
}