<?php
class NGPluginParagraphSearch extends NGPluginParagraph {
	const ObjectTypePluginParagraphSearch = 'NGPluginParagraphSearch';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphSearch = "paragraphsearch";
	const GetCriteria = 'criteria';
	const GetOffset = 'offset';
	
	/**
	 *
	 * Number of items to display per page
	 *
	 * @var int
	 */
	public $itemsperpage = 5;
	
	/**
	 *
	 * Show a searchfield
	 *
	 * @var bool
	 */
	public $searchfield = true;
	
	/**
	 *
	 * Style of search button
	 *
	 * @var string
	 */
	public $searchstyle = 'default';
	
	/**
	 *
	 * Show pictures in result
	 *
	 * @var bool
	 */
	public $showpictures = false;
	
	/**
	 *
	 * Width of picture border
	 *
	 * @var int
	 */
	public $pictureborderwidth = 0;
	
	/**
	 *
	 * Width of picture
	 *
	 * @var int
	 */
	public $picturewidth = 100;
	
	/**
	 *
	 * Border color
	 *
	 * @var string
	 */
	public $picturebordercolor = '808080';
	
	/**
	 *
	 * Icon color
	 *
	 * @var string
	 */
	public $coloricon = '555555';
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsperpage', NGProperty::TypeInt, self::DomainParagraphSearch, 'itemsperpage', NGPropertyMapped::MultiplicityScalar, false, 5 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchfield', NGProperty::TypeBool, self::DomainParagraphSearch, 'searchfield', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchstyle', NGProperty::TypeString, self::DomainParagraphSearch, 'searchstyle', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showpictures', NGProperty::TypeBool, self::DomainParagraphSearch, 'showpictures', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pictureborderwidth', NGProperty::TypeInt, self::DomainParagraphSearch, 'pictureborderwidth', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'picturewidth', NGProperty::TypeInt, self::DomainParagraphSearch, 'picturewidth', NGPropertyMapped::MultiplicityScalar, false, 100 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'picturebordercolor', NGProperty::TypeInt, self::DomainParagraphSearch, 'picturebordercolor', NGPropertyMapped::MultiplicityScalar, false, '808080' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'coloricon', NGProperty::TypeString, self::DomainParagraphSearch, 'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555' );
	}
	public function render() {
		$fts = new NGFTS ();
		$fts->previewMode = $this->previewMode;
		$fts->criteria = NGUtil::get ( self::GetCriteria, '' );
		$fts->offset = NGUtil::get ( self::GetOffset, 0 );
		$fts->itemsPerPage = $this->itemsperpage;
		$fts->getPictures = $this->showpictures;
		
		$fts->pictureSize = $this->picturewidth;
		
		$fts->search ();
		
		$lang = new NGLanguageAdapter ();
		$lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphsearch/language/langsearch.xml';
		$lang->load ();
		
		$link = new NGLink ();
		$link->linkType = NGLink::LinkPage;
		$link->uid = $this->currentPage->objectUID;
		$link->previewMode = $this->previewMode;
		
		$template = new NGTemplate ();
		
		$template->assign ( 'fts', $fts );
		$template->assign ( 'lang', $lang->languageResources );
		$template->assign ( 'width', $this->renderWidth );
		$template->assign ( 'responsive', $this->responsive );
		$template->assign ( 'self', $link->getURL () );
		$template->assign ( 'searchfield', $this->searchfield );
		$template->assign ( 'borderwidth', $this->pictureborderwidth );
		$template->assign ( 'bordercolor', $this->picturebordercolor );
		$template->assign ( 'picturewidth', $this->picturewidth );
		if (substr ( $this->searchstyle, - 4 ) === '.svg') {
			$template->assign ( 'picture', self::prependPluginsPath ( sprintf ( 'ngpluginparagraphsearch/styles/img/?f=%s&c=%s', substr ( $this->searchstyle, 0, - 4 ), $this->coloricon ) ) );
		} else {
			$template->assign ( 'picture', self::prependPluginsPath ( 'ngpluginparagraphsearch/styles/' . $this->searchstyle . '.png' ) );
		}
		
		if ($fts->count > $fts->itemsPerPage) {
			$subpages = Array ();
			for($i = 0; $i < ceil ( $fts->count / $fts->itemsPerPage ); $i ++) {
				$subpage = new NGPluginParagraphSearchSubPage ();
				$subpage->caption = $i + 1;
				$subpage->url = $link->getUrlAndQuery ( Array (
						self::GetOffset => $i,
						self::GetCriteria => $fts->criteria 
				) );
				$subpage->iscurrent = $i == $fts->offset;
				
				$subpages [] = $subpage;
			}
			$template->assign ( 'subpages', $subpages );
		}
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphsearch/tpl/template.tpl' );
		
		$this->styleSheets = Array (
				'NGPluginParagraphSearch' => $this->prependPluginsPath ( 'ngpluginparagraphsearch/css/' ) 
		);
		
		$this->dontCache = true;
	}
}
class NGPluginParagraphSearchSubPage {
	public $caption;
	public $url;
	public $iscurrent;
}