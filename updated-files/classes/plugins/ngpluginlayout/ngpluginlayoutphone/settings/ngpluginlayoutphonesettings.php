<?php

class NGPluginLayoutPhoneSettings extends NGSetting {
	const IdLayoutPhone = 'LayoutPhone';
	const ObjectTypePluginLayoutPhoneSettings = 'NGPluginLayoutPhoneSettings';
	const DomainLayoutPhone = 'LayoutPhone';
	
	public $background = 'solid ffffff';
	public $width = 320;
	public $padding = '0';
	
	public $choosebackground = 'solid FCFCEB';
	public $choosebordercolor = 'd3d3d3';
	public $chooseborderwidth = '0 0 1 0';
	public $choosemargin = '0';
	public $choosepadding = '10';
	public $chooseroundedcorners = '0';
	public $choosevisible = true;
	public $chooseshadow = '3 3 0 SE';
	public $choosefonttext = 'Arial,14,false,false,false,333333';
	public $choosefontlink = 'Arial,14,true,false,false,CA5E5D';
	public $choosemarginlink = '10 0 0 0';
	public $choosepaddinglink = '10';
	public $choosebackgroundlink = 'solid FAF2F2';
	public $choosebordercolorlink = 'CA5E5D';
	public $chooseborderwidthlink = '2';
	public $chooseroundedcornerslink = '0';
	
	public $navbackground = 'solid f7f7f7';
	public $navbordercolor = 'd3d3d3';
	public $navborderwidth = '0 0 1 0';
	public $navmargin = '0';
	public $navpadding = '0';
	public $navroundedcorners = '0';
	public $navvisible = true;
	public $navshadow = '3 3 0 SE';
	public $navstyle = 'default';
	public $navfont = 'Arial,16,true,false,false,666666';
	public $navseparator = '1 d3d3d3';
	public $navnavpadding = '10';
	public $navshownav = true;
	public $navshownavstyle = 'navigation';
	
	public $eyecatcherbackground = 'solid ffffff';
	public $eyecatcherbordercolor = 'd3d3d3';
	public $eyecatcherborderwidth = '0 0 1 0';
	public $eyecatchermargin = '0';
	public $eyecatcherpadding = '0';
	public $eyecatcherroundedcorners = '0';
	public $eyecatchervisible = true;
	public $eyecatchershadow = '3 3 0 SE';
	public $eyecatcherpicture = '';
	
	public $contentbackground = '';
	public $contentbordercolor = 'd3d3d3';
	public $contentborderwidth = 0;
	public $contentmargin = '0';
	public $contentpadding = '10';
	public $contentroundedcorners = '0';
	public $contentshadow = '3 3 0 SE';
	public $contentshowbreadcrumbs = false;
	public $contentborderbreadcrumbs = '';
	public $contentsubnav = '';
	
	public $rightbackground = '';
	public $rightbordercolor = 'd3d3d3';
	public $rightborderwidth = '0';
	public $rightmargin = '0';
	public $rightpadding = '0 10 10 10';
	public $rightroundedcorners = '0';
	public $rightvisible = false;
	public $rightshadow = '3 3 0 SE';
	
	public $leftbackground = '';
	public $leftbordercolor = 'd3d3d3';
	public $leftborderwidth = '0';
	public $leftmargin = '0';
	public $leftpadding = '10 10 0 10';
	public $leftroundedcorners = '0';
	public $leftvisible = false;
	public $leftshadow = '3 3 0 SE';
	
	public $footerbackground = '';
	public $footerbordercolor = 'd3d3d3';
	public $footerborderwidth = '0';
	public $footermargin = '0';
	public $footerpadding = '0 10 10 10';
	public $footerroundedcorners = '0';
	public $footervisible = true;
	public $footershadow = '3 3 0 SE';
	
	public $headerbackground = '';
	public $headerbordercolor = 'd3d3d3';
	public $headerborderwidth = '0';
	public $headermargin = '0';
	public $headerpadding = '10 10 0 10';
	public $headerroundedcorners = '0';
	public $headervisible = true;
	public $headershadow = '3 3 0 SE';
	
	public $searchbackground = '';
	public $searchbordercolor = 'd3d3d3';
	public $searchborderwidth = 1;
	public $searchmargin = '0 10 10 0';
	public $searchpadding = '10';
	public $searchroundedcorners = '0';
	public $searchvisible = false;
	public $searchshadow = '3 3 0 SE';
	public $searchsearchcolor = '444444';
	public $searchsearchbordercolor = 'eeeeee';
	public $searchsearchbackground = 'solid ffffff';
	public $searchsearchborderwidth = '1';
	public $searchsearchroundedcorners = '0';
	public $searchsearchstyle = 'default';
	
	public $commonbackground = 'solid 666666';
	public $commonbordercolor = '666666';
	public $commonborderwidth = '0 0 0 0';
	public $commonmargin = '0';
	public $commonpadding = '0';
	public $commonroundedcorners = '0';
	public $commonvisible = false;
	public $commonshadow = '3 3 0 SE';
	public $commonfontpages = 'Arial,16,false,false,false,f0f0f0';
	public $commonfontfolders = 'Arial,16,true,false,false,f0f0f0';
	public $commonnavpadding = '10';
	public $commonstyle = 'pages';
	
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosebackground', NGProperty::TypeString, self::DomainLayoutPhone, 'choosebackground', NGPropertyMapped::MultiplicityScalar, false, 'solid FCFCEB', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosebordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'choosebordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'chooseborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'chooseborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0 0 1 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosemargin', NGProperty::TypeString, self::DomainLayoutPhone, 'choosemargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosepadding', NGProperty::TypeString, self::DomainLayoutPhone, 'choosepadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'chooseroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'chooseroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosevisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'choosevisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'chooseshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'chooseshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosefonttext', NGProperty::TypeString, self::DomainLayoutPhone, 'choosefonttext', NGPropertyMapped::MultiplicityScalar, false, 'Arial,14,false,false,false,333333', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosefontlink', NGProperty::TypeString, self::DomainLayoutPhone, 'choosefontlink', NGPropertyMapped::MultiplicityScalar, false, 'Arial,14,true,false,false,CA5E5D', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosemarginlink', NGProperty::TypeString, self::DomainLayoutPhone, 'choosemarginlink', NGPropertyMapped::MultiplicityScalar, false, '10 0 0 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosepaddinglink', NGProperty::TypeString, self::DomainLayoutPhone, 'choosepaddinglink', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosebackgroundlink', NGProperty::TypeString, self::DomainLayoutPhone, 'choosebackgroundlink', NGPropertyMapped::MultiplicityScalar, false, 'solid FAF2F2', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'choosebordercolorlink', NGProperty::TypeString, self::DomainLayoutPhone, 'choosebordercolorlink', NGPropertyMapped::MultiplicityScalar, false, 'CA5E5D', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'chooseborderwidthlink', NGProperty::TypeString, self::DomainLayoutPhone, 'chooseborderwidthlink', NGPropertyMapped::MultiplicityScalar, false, '2', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'chooseroundedcornerslink', NGProperty::TypeString, self::DomainLayoutPhone, 'chooseroundedcornerslink', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'background', NGProperty::TypeString, self::DomainLayoutPhone, 'background', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'padding', NGProperty::TypeString, self::DomainLayoutPhone, 'padding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'width', NGProperty::TypeInt, self::DomainLayoutPhone, 'width', NGPropertyMapped::MultiplicityScalar, false, 320, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'navbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid f7f7f7', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'navbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'navborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0 0 1 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'navmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'navpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'navroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navvisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'navvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'navshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navstyle', NGProperty::TypeString, self::DomainLayoutPhone, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navfont', NGProperty::TypeString, self::DomainLayoutPhone, 'navfont', NGPropertyMapped::MultiplicityScalar, false, 'Arial,16,true,false,false,666666', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navseparator', NGProperty::TypeString, self::DomainLayoutPhone, 'navseparator', NGPropertyMapped::MultiplicityScalar, false, '1 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navnavpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'navnavpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navshownav', NGProperty::TypeBool, self::DomainLayoutPhone, 'navshownav', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navshownavstyle', NGProperty::TypeString, self::DomainLayoutPhone, 'navshownavstyle', NGPropertyMapped::MultiplicityScalar, false, 'navigation', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatcherbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatcherbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'eyecatcherborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0 0 1 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchermargin', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatchermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatcherpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatcherroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchervisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'eyecatchervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchershadow', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatchershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherpicture', NGProperty::TypeString, self::DomainLayoutPhone, 'eyecatcherpicture', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'leftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'leftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'leftborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'leftmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'leftpadding', NGPropertyMapped::MultiplicityScalar, false, '10 10 0 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'leftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftvisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'leftvisible', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'leftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'contentbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'contentbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'contentborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'contentmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'contentpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'contentroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'contentshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentshowbreadcrumbs', NGProperty::TypeBool, self::DomainLayoutPhone, 'contentshowbreadcrumbs', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentborderbreadcrumbs', NGProperty::TypeString, self::DomainLayoutPhone, 'contentborderbreadcrumbs', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentsubnav', NGProperty::TypeString, self::DomainLayoutPhone, 'contentsubnav', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'rightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'rightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'rightborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'rightmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'rightpadding', NGPropertyMapped::MultiplicityScalar, false, '0 10 10 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'rightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightvisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'rightvisible', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'rightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'footerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'footerbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'footerborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footermargin', NGProperty::TypeString, self::DomainLayoutPhone, 'footermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'footerpadding', NGPropertyMapped::MultiplicityScalar, false, '0 10 10 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'footerroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footervisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'footervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footershadow', NGProperty::TypeString, self::DomainLayoutPhone, 'footershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'headerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'headerbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'headerborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headermargin', NGProperty::TypeString, self::DomainLayoutPhone, 'headermargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'headerpadding', NGPropertyMapped::MultiplicityScalar, false, '10 10 0 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'headerroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headervisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'headervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headershadow', NGProperty::TypeString, self::DomainLayoutPhone, 'headershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'searchbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'searchbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'searchborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0 0 1 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'searchmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'searchpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'searchroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchvisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'searchvisible', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'searchshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchcolor', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchcolor', NGPropertyMapped::MultiplicityScalar, false, '444444', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'eeeeee', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchborderwidth', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchsearchstyle', NGProperty::TypeString, self::DomainLayoutPhone, 'searchsearchstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
	
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonbackground', NGProperty::TypeString, self::DomainLayoutPhone, 'commonbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid 666666', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonbordercolor', NGProperty::TypeString, self::DomainLayoutPhone, 'commonbordercolor', NGPropertyMapped::MultiplicityScalar, false, '666666', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonborderwidth', NGProperty::TypeInt, self::DomainLayoutPhone, 'commonborderwidth', NGPropertyMapped::MultiplicityScalar, false, '0 0 0 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonmargin', NGProperty::TypeString, self::DomainLayoutPhone, 'commonmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'commonpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonroundedcorners', NGProperty::TypeString, self::DomainLayoutPhone, 'commonroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonvisible', NGProperty::TypeBool, self::DomainLayoutPhone, 'commonvisible', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonshadow', NGProperty::TypeString, self::DomainLayoutPhone, 'commonshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonfontpages', NGProperty::TypeString, self::DomainLayoutPhone, 'commonfontpages', NGPropertyMapped::MultiplicityScalar, false, 'Arial,16,false,false,false,f0f0f0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonfontfolders', NGProperty::TypeString, self::DomainLayoutPhone, 'commonfontfolders', NGPropertyMapped::MultiplicityScalar, false, 'Arial,16,true,false,false,f0f0f0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonnavpadding', NGProperty::TypeString, self::DomainLayoutPhone, 'commonnavpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonstyle', NGProperty::TypeString, self::DomainLayoutPhone, 'commonstyle', NGPropertyMapped::MultiplicityScalar, false, 'pages', false );
		
		
	}
	
	public function mainWidth() {
		$padding = new NGMargin ( $this->padding );
		return $this->width - $padding->totalWidth ();
	}
	
	public function chooseExtraWidth() {
		return $this->totalExtraWidth ( $this->choosemargin, $this->choosepadding, $this->chooseborderwidth );
	}
	
	public function chooseButtonWidth() {
		$margin = new NGMargin ( $this->choosemarginlink );
		return $this->width-$this->chooseExtraWidth()-$margin->totalWidth();
	}
	
	public function eyecatcherExtraWidth() {
		return $this->totalExtraWidth ( $this->eyecatchermargin, $this->eyecatcherpadding, $this->eyecatcherborderwidth );
	}
	
	public function headerExtraWidth() {
		return $this->totalExtraWidth ( $this->headermargin, $this->headerpadding, $this->headerborderwidth );
	}
	
	public function searchExtraWidth() {
		return $this->totalExtraWidth ( $this->searchmargin, $this->searchpadding, $this->searchborderwidth );
	}
	
	public function leftExtraWidth() {
		return $this->totalExtraWidth ( $this->leftmargin, $this->leftpadding, $this->leftborderwidth );
	}
	
	public function contentExtraWidth() {
		return $this->totalExtraWidth ( $this->contentmargin, $this->contentpadding, $this->contentborderwidth );
	}
	
	public function rightExtraWidth() {
		return $this->totalExtraWidth ( $this->rightmargin, $this->rightpadding, $this->rightborderwidth );
	}
	
	public function footerExtraWidth() {
		return $this->totalExtraWidth ( $this->footermargin, $this->footerpadding, $this->footerborderwidth );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdLayoutPhone );
	}
}