<?php
class NGPluginParagraphText extends NGPluginParagraph {
	const ObjectTypePluginParagraphText = 'NGPluginParagraphText';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphText = "paragraphtext";
	
	/**
	 *
	 * Text to display
	 *
	 * @var string
	 */
	public $text = '';
	
	/**
	 *
	 * Mode of sidebar, can be 'None', 'Picture' or 'Text'
	 *
	 * @var string
	 */
	public $sidebarMode = 'None';
	
	/**
	 *
	 * Position of sidebar, can be 'Right' or 'Left'
	 *
	 * @var string
	 */
	public $sidebarPlacement = 'Right';
	
	/**
	 *
	 * Size of sidebar, can be 'Small','Medium','Large' or 'VeryLarge'
	 *
	 * @var string
	 */
	public $sidebarWidth = 'Medium';
	
	/**
	 *
	 * Should the text flow around the sidebar?
	 *
	 * @var bool
	 */
	public $sidebarFlow = false;
	
	/**
	 *
	 * Picture UID
	 *
	 * @var string
	 */
	public $sidebarPictureUID = '';
	
	/**
	 *
	 * Use local caption
	 *
	 * @var string
	 */
	public $sidebarPictureUselocalcaption = false;
	
	/**
	 *
	 * Local caption
	 *
	 * @var string
	 */
	public $sidebarPictureLocalCaption = '';
	
	/**
	 *
	 * Local summary
	 *
	 * @var string
	 */
	public $sidebarPictureLocalSummary = '';
	
	/**
	 *
	 * Action, when the Picture is clicked, can be 'Enlarge', 'Link' or 'DoNothing'
	 *
	 * @var string
	 */
	public $sidebarPictureClick = '';
	
	/**
	 *
	 * Crop of picture
	 *
	 * @var string
	 */
	public $sidebarPictureCrop = 'RatioUnknown';
	
	/**
	 *
	 * Link on picture
	 *
	 * @var string
	 */
	public $sidebarPictureLink = '';
	
	/**
	 *
	 * Hide text
	 *
	 * @var string
	 */
	public $sidebarPictureNoText = false;
	
	/**
	 *
	 * Text of sidebar
	 *
	 * @var string
	 */
	public $sidebarText = '';
	
	/**
	 *
	 * Style of border
	 *
	 * @var string
	 */
	public $sidebarBorderstyle = 'None';
	
	/**
	 *
	 * Selected FX Style
	 *
	 * @var string
	 */
	public $sidebarFxstyle = 'default';
	
	/**
	 *
	 * Background
	 *
	 * @var string
	 */
	public $sidebarBackground = 'solid ffffff';
	
	/**
	 *
	 * Width of border
	 *
	 * @var string
	 */
	public $sidebarBorderwidth = '1';
	
	/**
	 *
	 * Color of border
	 *
	 * @var string
	 */
	public $sidebarBordercolor = 'e3e3e3';
	
	/**
	 *
	 * Margin of border
	 *
	 * @var string
	 */
	public $sidebarMargin = '0';
	
	/**
	 *
	 * Padding of border
	 *
	 * @var string
	 */
	public $sidebarPadding = '10';
	
	/**
	 *
	 * Shadow of border
	 *
	 * @var unknown_type
	 */
	public $sidebarShadow = '3 3 0 SE';
	
	/**
	 *
	 * roundness of border
	 *
	 * @var string
	 */
	public $sidebarRoundedcorners = '0';
	
	/**
	 *
	 * Rich text renderer
	 *
	 * @var NGRichText
	 */
	private $richText;
	
	/**
	 *
	 * Gutter between text and sidebar
	 *
	 * @var int
	 */
	public $gutter = 30;
	
	/**
	 *
	 * Calculated width of content
	 *
	 * @var int
	 */
	public $widthContent;
	
	/**
	 *
	 * Calculated width of sidebar
	 *
	 * @var ind
	 */
	public $widthSidebar;
	
	/**
	 *
	 * Main template
	 *
	 * @var NGTemplate
	 */
	public $template;
	
	/**
	 *
	 * Sidebar template
	 *
	 * @var NGTemplate
	 */
	public $templateSidebar;
	
	/**
	 *
	 * Output of sidebar
	 *
	 * @var string
	 */
	public $outputSidebar = '';
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'text', NGProperty::TypeText, self::DomainParagraphText, 'text', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarmode', NGProperty::TypeString, self::DomainParagraphText, 'sidebarMode', NGPropertyMapped::MultiplicityScalar, false, 'None', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarplacement', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPlacement', NGPropertyMapped::MultiplicityScalar, false, 'Right', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarwidth', NGProperty::TypeString, self::DomainParagraphText, 'sidebarWidth', NGPropertyMapped::MultiplicityScalar, false, 'Medium', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarflow', NGProperty::TypeBool, self::DomainParagraphText, 'sidebarFlow', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpictureuid', NGProperty::TypeUID, self::DomainParagraphText, 'sidebarPictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpictureuselocalcaption', NGProperty::TypeBool, self::DomainParagraphText, 'sidebarPictureUselocalcaption', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpicturelocalcaption', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPictureLocalCaption', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpicturelocalsummary', NGProperty::TypeText, self::DomainParagraphText, 'sidebarPictureLocalSummary', NGPropertyMapped::MultiplicityScalar, true, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpictureclick', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPictureClick', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpicturelink', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPictureLink', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpicturenotext', NGProperty::TypeBool, self::DomainParagraphText, 'sidebarPictureNoText', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpicturecrop', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPictureCrop', NGPropertyMapped::MultiplicityScalar, false, 'RatioUnknown' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebartext', NGProperty::TypeText, self::DomainParagraphText, 'sidebarText', NGPropertyMapped::MultiplicityScalar, true, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarborderstyle', NGProperty::TypeString, self::DomainParagraphText, 'sidebarBorderstyle', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarfxstyle', NGProperty::TypeString, self::DomainParagraphText, 'sidebarFxstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarbackground', NGProperty::TypeString, self::DomainParagraphText, 'sidebarBackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarborderwidth', NGProperty::TypeString, self::DomainParagraphText, 'sidebarBorderwidth', NGPropertyMapped::MultiplicityScalar, false, '1', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarbordercolor', NGProperty::TypeString, self::DomainParagraphText, 'sidebarBordercolor', NGPropertyMapped::MultiplicityScalar, false, 'e3e3e3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarmargin', NGProperty::TypeString, self::DomainParagraphText, 'sidebarMargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarpadding', NGProperty::TypeString, self::DomainParagraphText, 'sidebarPadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarshadow', NGProperty::TypeString, self::DomainParagraphText, 'sidebarShadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sidebarroundedcorners', NGProperty::TypeString, self::DomainParagraphText, 'sidebarRoundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
	}
	public function render() {
		if (NGUtil::isMobile ())
			$this->sidebarMode = 'None';
		
		$this->template = new NGTemplate ();
		
		if ($this->responsive) {
			$this->widthContent = $this->renderWidth;
			$this->widthSidebar = $this->renderWidth;
			$this->template->assign ( 'sidebarwidthclass', strtolower ( $this->sidebarWidth ) );
		} else {
			switch ($this->sidebarWidth) {
				case 'Small' :
					$this->widthSidebar = floor ( 0.2 * $this->renderWidth );
					break;
				case 'Medium' :
					$this->widthSidebar = floor ( 0.3 * $this->renderWidth );
					break;
				case 'Large' :
					$this->widthSidebar = floor ( 0.4 * $this->renderWidth );
					break;
				case 'VeryLarge' :
					$this->widthSidebar = floor ( 0.5 * $this->renderWidth );
					break;
			}
			$this->widthContent = $this->renderWidth - $this->gutter - $this->widthSidebar;
			$this->template->assign ( 'widthsidebar', $this->widthSidebar );
			$this->template->assign ( 'widthcontent', $this->widthContent );
		}
		
		$this->richText->previewMode = $this->previewMode;
		
		if ($this->sidebarMode !== 'None') {
			$this->templateSidebar = new NGTemplate ();
			switch ($this->sidebarBorderstyle) {
				case 'GlobalStandard' :
				case 'LocalStandard' :
					$borderStandard = new NGPluginBorderStandard ();
					$borderStandard->inputWidth = $this->widthSidebar;
					$borderStandard->objectUID = 'sb_' . $this->objectUID;
					$borderStandard->localStyle = $this->sidebarBorderstyle === 'LocalStandard';
					$borderStandard->settings->background = $this->sidebarBackground;
					$borderStandard->settings->borderwidth = $this->sidebarBorderwidth;
					$borderStandard->settings->bordercolor = $this->sidebarBordercolor;
					$borderStandard->settings->margin = $this->sidebarMargin;
					$borderStandard->settings->padding = $this->sidebarPadding;
					$borderStandard->settings->shadow = $this->sidebarShadow;
					$borderStandard->settings->roundedcorners = $this->sidebarRoundedcorners;
					$borderStandard->prepare ();
					$borderStandard->responsive = $this->responsive;
					$this->widthSidebar = $borderStandard->outputWidth;
					break;
				case 'FX' :
					if (! $this->responsive) {
						$borderFX = new NGPluginBorderFX ();
						$borderFX->inputWidth = $this->widthSidebar;
						$borderFX->objectUID = 'sb_' . $this->objectUID;
						$borderFX->style = $this->sidebarFxstyle;
						$borderFX->prepare ();
						$this->widthSidebar = $borderFX->outputWidth;
					}
					break;
			}
		}
		
		$this->template->assign ( 'text', $this->richText->parse ( $this->text ) );
		$this->template->assign ( 'sidebarmode', $this->sidebarMode );
		$this->template->assign ( 'sidebarwidth', $this->sidebarWidth );
		$this->template->assign ( 'sidebarflow', $this->sidebarFlow );
		$this->template->assign ( 'sidebartext', $this->sidebarText );
		$this->template->assign ( 'sidebarplacement', strtolower ( $this->sidebarPlacement ) );
		$this->template->assign ( 'gutter', $this->gutter );
		
		if ($this->sidebarMode == 'Text') {
			$this->outputSidebar = $this->richText->parse ( $this->sidebarText );
		}
		
		if ($this->sidebarMode == 'Picture') {
			$pictureAdapter = new NGDBAdapterObject ();
			
			$ratio = NGPicture::stringToRatio ( $this->sidebarPictureCrop );
			
			/* @var $picture NGPicture */
			$picture = $pictureAdapter->loadObject ( $this->sidebarPictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
			
			if ($picture != null) {
				
				$size = $picture->getResizedSize ( $this->widthSidebar, - 1, $ratio );
				
				$this->templateSidebar->assign ( 'sidebarplacement', $this->sidebarPlacement );
				$this->templateSidebar->assign ( 'sidebarpicturesource', NGLink::getPictureURL ( $picture->objectUID, $size->width, $size->height, $ratio ) );
				$this->templateSidebar->assign ( 'sidebarpicturewidth', $size->width );
				$this->templateSidebar->assign ( 'sidebarpictureheight', $size->height );
				$this->templateSidebar->assign ( 'widthsidebar', $this->widthSidebar );
				$this->templateSidebar->assign ( 'sidebarpicturealt', $picture->displayAlt () );
				$this->templateSidebar->assign ( 'sidebarpicturetitle', $picture->title );
				$this->templateSidebar->assign ( 'gutter', $this->gutter );
				$this->templateSidebar->assign ( 'responsive', $this->responsive );
				
				if (NGSettingsSite::getInstance ()->lazyload) {
					$this->templateSidebar->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
					if (NGSettingsSite::getInstance ()->hdpictures) {
						$this->templateSidebar->assign ( 'sidebarpicturesourcehd', NGLink::getPictureURL ( $picture->objectUID, $size->width * 2, $size->height * 2, $ratio ) );
					}
				}
				
				switch ($this->sidebarPictureClick) {
					case 'Enlarge' :
						$this->templateSidebar->assign ( 'sidebarpicturelink', NGLink::getPictureURL ( $picture->objectUID ) );
						$this->templateSidebar->assign ( 'sidebarpicturelinkclass', 'gallery' );
						break;
					case 'Link' :
						$link = new NGLink ( $this->previewMode );
						$link->parseURL ( $this->sidebarPictureLink );
						$this->templateSidebar->assign ( 'sidebarpicturelink', $link->getURL () );
						
						switch ($link->linkType) {
							case NGLink::LinkPicture :
								$this->templateSidebar->assign ( 'sidebarpicturelinkclass', 'gallery' );
								break;
							case NGLink::LinkPagePopup :
							case NGLink::LinkTopicPopup :
								$this->templateSidebar->assign ( 'sidebarpicturelinkclass', 'galleryiframe' );
								break;
							case NGLink::LinkWWW :
								$this->templateSidebar->assign ( 'sidebarpicturelinktarget', '_blank' );
								break;
						}
						
						break;
					default :
						$this->templateSidebar->assign ( 'sidebarpicturelink', '' );
						break;
				}
				
				if ($this->sidebarPictureNoText) {
					$this->templateSidebar->assign ( 'sidebarpicturecaption', '' );
					$this->templateSidebar->assign ( 'sidebarpicturesummary', '' );
				} else {
					$this->templateSidebar->assign ( 'sidebarpicturecaption', $this->sidebarPictureUselocalcaption ? $this->sidebarPictureLocalCaption : $picture->caption );
					$this->templateSidebar->assign ( 'sidebarpicturesummary', $this->richText->parse ( $this->sidebarPictureUselocalcaption ? $this->sidebarPictureLocalSummary : $picture->summary ) );
				}
			} else {
				$this->templateSidebar->assign ( 'sidebarpicturesource', '' );
			}
			
			$this->outputSidebar = $this->templateSidebar->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtext/tpl/sidebarpicture.tpl' );
		}
		
		if ($this->sidebarMode !== 'None') {
			switch ($this->sidebarBorderstyle) {
				case 'GlobalStandard' :
				case 'LocalStandard' :
					$borderStandard->input = $this->outputSidebar;
					$borderStandard->render ();
					$this->outputSidebar = $borderStandard->output;
					
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
					if (! $this->responsive) {
						$borderFX->input = $this->outputSidebar;
						$borderFX->render ();
						$this->outputSidebar = $borderFX->output;
						
						foreach ( $borderFX->styles as $id => $style ) {
							if (! array_key_exists ( $id, $this->styles ))
								$this->styles [$id] = $style;
						}
					}
					break;
			}
		}
		
		$this->template->assign ( 'sidebar', $this->outputSidebar );
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtext/tpl/template.tpl' );
		
		if ($this->responsive) {
			$this->styleSheets ['NGPluginParagraphText'] = $this->prependPluginsPath ( 'ngpluginparagraphtext/css/sqrstyle.css' );
		} else {
			$this->styleSheets ['NGPluginParagraphText'] = $this->prependPluginsPath ( 'ngpluginparagraphtext/css/style.css' );
		}
	}
	public function __construct() {
		parent::__construct ();
		$this->richText = new NGRichText ();
	}
}