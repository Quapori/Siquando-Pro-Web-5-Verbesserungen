<?php

class NGPluginLayoutFlexSettings extends NGSetting {
	const IdLayoutFlex = 'LayoutFlex';
	const ObjectTypePluginLayoutFlexSettings = 'NGPluginLayoutFlexSettings';
	const DomainLayoutFlex = 'LayoutFlex';
	
	public $background = 'solid ffffff';
	public $center = true;
	public $width = 960;
	public $margin = '0';
	public $captionposition='content';
	
	public $leftwidth = 200;
	public $rightwidth = 200;
	
	public $navposition = 'above';
	public $navbackground = 'solid ffffff';
	public $navbordercolor = 'd3d3d3';
	public $navborderwidth = 1;
	public $navmargin = '10 0 10 0';
	public $navpadding = '0';
	public $navroundedcorners = '0';
	public $navvisible = true;
	public $navshadow = '3 3 0 SE';
	public $navnavigationhorizontal = 'NGPluginNavigationDropDown';
	public $navfill = '';
	public $navlinetop = '0 d3d3d3';
	public $navlinebottom = '0 d3d3d3';
	
	public $eyecatcherbackground = '';
	public $eyecatcherbordercolor = 'd3d3d3';
	public $eyecatcherborderwidth = 1;
	public $eyecatchermargin = '0 0 10 0';
	public $eyecatcherpadding = '10';
	public $eyecatcherroundedcorners = '0';
	public $eyecatchervisible = true;
	public $eyecatchershadow = '3 3 0 SE';
	public $eyecatcherfill = '';
	public $eyecatcherlinetop = '0 d3d3d3';
	public $eyecatcherlinebottom = '0 d3d3d3';
	public $eyecatchereyecatcher = 'NGPluginEyecatcherPicture';
	
	public $leftbackground = '';
	public $leftbordercolor = 'd3d3d3';
	public $leftborderwidth = 1;
	public $leftmargin = '0 10 0 0';
	public $leftpadding = '10';
	public $leftroundedcorners = '0';
	public $leftvisible = true;
	public $leftshadow = '3 3 0 SE';
	
	public $logoleftwidth = 200;
	public $logoleftlogo = '';
	public $logoleftbackground = '';
	public $logoleftbordercolor = 'd3d3d3';
	public $logoleftborderwidth = 1;
	public $logoleftmargin = '0 10 10 0';
	public $logoleftpadding = '10';
	public $logoleftroundedcorners = '0';
	public $logoleftvisible = true;
	public $logoleftshadow = '3 3 0 SE';
	
	public $contentbackground = '';
	public $contentbordercolor = 'd3d3d3';
	public $contentborderwidth = 0;
	public $contentmargin = '0';
	public $contentpadding = '0';
	public $contentroundedcorners = '0';
	public $contentshadow = '3 3 0 SE';
	public $contentshowbreadcrumbs = false;
	public $contentborderbreadcrumbs = '';
	public $contentsubnav = '';
	
	public $rightbackground = '';
	public $rightbordercolor = 'd3d3d3';
	public $rightborderwidth = 1;
	public $rightmargin = '0 0 0 10';
	public $rightpadding = '10';
	public $rightroundedcorners = '0';
	public $rightvisible = true;
	public $rightshadow = '3 3 0 SE';
	
	public $logorightwidth = 200;
	public $logorightlogo = '';
	public $logorightbackground = '';
	public $logorightbordercolor = 'd3d3d3';
	public $logorightborderwidth = 1;
	public $logorightmargin = '0 0 10 10';
	public $logorightpadding = '10';
	public $logorightroundedcorners = '0';
	public $logorightvisible = true;
	public $logorightshadow = '3 3 0 SE';
	
	public $footerbackground = '';
	public $footerbordercolor = 'd3d3d3';
	public $footerborderwidth = 1;
	public $footermargin = '10 0 10 0';
	public $footerpadding = '10';
	public $footerroundedcorners = '0';
	public $footervisible = true;
	public $footershadow = '3 3 0 SE';
	public $footerfill = '';
	public $footerlinetop = '0 d3d3d3';
	public $footerlinebottom = '0 d3d3d3';
	
	public $headerbackground = '';
	public $headerbordercolor = 'd3d3d3';
	public $headerborderwidth = 1;
	public $headermargin = '0 0 10 0';
	public $headerpadding = '10';
	public $headerroundedcorners = '0';
	public $headervisible = true;
	public $headershadow = '3 3 0 SE';
	public $headerfill = '';
	public $headerlinetop = '0 d3d3d3';
	public $headerlinebottom = '0 d3d3d3';
	
	public $navleftwidth = 200;
	public $navleftbackground = '';
	public $navleftbordercolor = 'd3d3d3';
	public $navleftborderwidth = 1;
	public $navleftmargin = '0 10 10 0';
	public $navleftpadding = '10';
	public $navleftroundedcorners = '0';
	public $navleftvisible = false;
	public $navleftshadow = '3 3 0 SE';
	public $navleftnavigationvertical = 'NGPluginNavigationVertical';
	
	public $navrightwidth = 200;
	public $navrightbackground = '';
	public $navrightbordercolor = 'd3d3d3';
	public $navrightborderwidth = 1;
	public $navrightmargin = '0 0 10 10';
	public $navrightpadding = '10';
	public $navrightroundedcorners = '0';
	public $navrightvisible = false;
	public $navrightshadow = '3 3 0 SE';
	public $navrightnavigationvertical = 'NGPluginNavigationVertical';
	
	public $searchleftwidth = 200;
	public $searchleftbackground = '';
	public $searchleftbordercolor = 'd3d3d3';
	public $searchleftborderwidth = 1;
	public $searchleftmargin = '0 10 10 0';
	public $searchleftpadding = '10';
	public $searchleftroundedcorners = '0';
	public $searchleftvisible = false;
	public $searchleftshadow = '3 3 0 SE';
	public $searchleftsearchcolor = '444444';
	public $searchleftsearchbordercolor = 'eeeeee';
	public $searchleftsearchbackground = 'solid ffffff';
	public $searchleftsearchborderwidth = '1';
	public $searchleftsearchroundedcorners = '0';
	public $searchleftsearchstyle = 'default';
	
	public $searchrightwidth = 200;
	public $searchrightbackground = '';
	public $searchrightbordercolor = 'd3d3d3';
	public $searchrightborderwidth = 1;
	public $searchrightmargin = '0 0 10 10';
	public $searchrightpadding = '10';
	public $searchrightroundedcorners = '0';
	public $searchrightvisible = false;
	public $searchrightshadow = '3 3 0 SE';
	public $searchrightsearchcolor = '444444';
	public $searchrightsearchbordercolor = 'eeeeee';
	public $searchrightsearchbackground = 'solid ffffff';
	public $searchrightsearchborderwidth = '1';
	public $searchrightsearchroundedcorners = '0';
	public $searchrightsearchstyle = 'default';
	
	public $containermainbackground = 'solid ffffff';
	public $containermainbordercolor = 'd3d3d3';
	public $containermainborderwidth = 0;
	public $containermainmargin = '0';
	public $containermainpadding = '0';
	public $containermainroundedcorners = '0';
	public $containermainshadow = '3 3 0 SE';
	public $containermainfill = '';
	public $containermainlinetop = '0 d3d3d3';
	public $containermainlinebottom = '0 d3d3d3';
	
	public $containerleftbackground = 'solid ffffff';
	public $containerleftbordercolor = 'd3d3d3';
	public $containerleftborderwidth = 0;
	public $containerleftmargin = '0';
	public $containerleftpadding = '0';
	public $containerleftroundedcorners = '0';
	public $containerleftshadow = '3 3 0 SE';
	public $containerleftfill = '';
	public $containerleftedge = '';
	
	public $containerrightbackground = 'solid ffffff';
	public $containerrightbordercolor = 'd3d3d3';
	public $containerrightborderwidth = 0;
	public $containerrightmargin = '0';
	public $containerrightpadding = '0';
	public $containerrightroundedcorners = '0';
	public $containerrightshadow = '3 3 0 SE';
	public $containerrightfill = '';
	public $containerrightedge = '';
	
	public $commonbackground = 'solid ffffff';
	public $commonbordercolor = 'd3d3d3';
	public $commonborderwidth = 0;
	public $commonmargin = '10 0 10 0';
	public $commonpadding = '0';
	public $commonroundedcorners = '0';
	public $commonvisible = true;
	public $commonshadow = '3 3 0 SE';
	public $commonnavigationcommon = 'NGPluginNavigationCommon';
	public $commonfill = '';
	public $commonlinetop = '0 d3d3d3';
	public $commonlinebottom = '0 d3d3d3';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'background', NGProperty::TypeString, self::DomainLayoutFlex, 'background', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'center', NGProperty::TypeBool, self::DomainLayoutFlex, 'center', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'width', NGProperty::TypeInt, self::DomainLayoutFlex, 'width', NGPropertyMapped::MultiplicityScalar, false, 960, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'margin', NGProperty::TypeString, self::DomainLayoutFlex, 'margin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'captionposition', NGProperty::TypeString, self::DomainLayoutFlex, 'captionposition', NGPropertyMapped::MultiplicityScalar, false, 'content', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navposition', NGProperty::TypeString, self::DomainLayoutFlex, 'navposition', NGPropertyMapped::MultiplicityScalar, false, 'above', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'navbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'navbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'navborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'navmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'navpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'navroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'navvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'navshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navnavigationhorizontal', NGProperty::TypeText, self::DomainLayoutFlex, 'navnavigationhorizontal', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginNavigationDropDown', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navfill', NGProperty::TypeString, self::DomainLayoutFlex, 'navfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'navlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'navlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'eyecatcherborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchermargin', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatchermargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchervisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'eyecatchervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchershadow', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatchershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherfill', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatcherlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'eyecatcherlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'eyecatchereyecatcher', NGProperty::TypeText, self::DomainLayoutFlex, 'eyecatchereyecatcher', NGPropertyMapped::MultiplicityScalar, true, 'NGPluginEyecatcherPicture', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftlogo', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftlogo', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'logoleftborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftmargin', NGPropertyMapped::MultiplicityScalar, false, '0 10 0 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'logoleftvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'logoleftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logoleftwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'logoleftwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'leftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'leftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'leftborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'leftmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'leftpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'leftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'leftvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'leftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'leftwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'leftwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'contentbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'contentbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'contentborderwidth', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'contentmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'contentpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'contentroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'contentshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentshowbreadcrumbs', NGProperty::TypeBool, self::DomainLayoutFlex, 'contentshowbreadcrumbs', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentborderbreadcrumbs', NGProperty::TypeString, self::DomainLayoutFlex, 'contentborderbreadcrumbs', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'contentsubnav', NGProperty::TypeString, self::DomainLayoutFlex, 'contentsubnav', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'rightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'rightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'rightborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'rightmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 0 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'rightpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'rightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'rightvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'rightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'rightwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'rightwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightlogo', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightlogo', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'logorightborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightmargin', NGPropertyMapped::MultiplicityScalar, false, '0 10 0 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'logorightvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'logorightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'logorightwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'logorightwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'footerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'footerbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'footerborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footermargin', NGProperty::TypeString, self::DomainLayoutFlex, 'footermargin', NGPropertyMapped::MultiplicityScalar, false, '10 0 0 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'footerpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'footerroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footervisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'footervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footershadow', NGProperty::TypeString, self::DomainLayoutFlex, 'footershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerfill', NGProperty::TypeString, self::DomainLayoutFlex, 'footerfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'footerlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'footerlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'footerlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'headerbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'headerbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'headerborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headermargin', NGProperty::TypeString, self::DomainLayoutFlex, 'headermargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'headerpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'headerroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headervisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'headervisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headershadow', NGProperty::TypeString, self::DomainLayoutFlex, 'headershadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerfill', NGProperty::TypeString, self::DomainLayoutFlex, 'headerfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'headerlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headerlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'headerlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'navleftborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftmargin', NGPropertyMapped::MultiplicityScalar, false, '0 10 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'navleftvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'navleftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftnavigationvertical', NGProperty::TypeText, self::DomainLayoutFlex, 'navleftnavigationvertical', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginNavigationVertical', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navleftwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'navleftwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'navrightborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'navrightvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'navrightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightnavigationvertical', NGProperty::TypeText, self::DomainLayoutFlex, 'navrightnavigationvertical', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginNavigationVertical', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'navrightwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'navrightwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'searchleftborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftmargin', NGPropertyMapped::MultiplicityScalar, false, '0 10 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'searchleftvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'searchleftwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchcolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchcolor', NGPropertyMapped::MultiplicityScalar, false, '444444', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'eeeeee', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchborderwidth', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchleftsearchstyle', NGProperty::TypeString, self::DomainLayoutFlex, 'searchleftsearchstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'searchrightborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'searchrightvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'searchrightwidth', NGPropertyMapped::MultiplicityScalar, false, 200, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchcolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchcolor', NGPropertyMapped::MultiplicityScalar, false, '444444', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'eeeeee', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchborderwidth', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'searchrightsearchstyle', NGProperty::TypeString, self::DomainLayoutFlex, 'searchrightsearchstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'containermainborderwidth', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainfill', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containermainlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'containermainlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'containerleftborderwidth', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftfill', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerleftedge', NGProperty::TypeString, self::DomainLayoutFlex, 'containerleftedge', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'containerrightborderwidth', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightmargin', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightpadding', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightfill', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'containerrightedge', NGProperty::TypeString, self::DomainLayoutFlex, 'containerrightedge', NGPropertyMapped::MultiplicityScalar, false, '', false );
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonbackground', NGProperty::TypeString, self::DomainLayoutFlex, 'commonbackground', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonbordercolor', NGProperty::TypeString, self::DomainLayoutFlex, 'commonbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'd3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonborderwidth', NGProperty::TypeInt, self::DomainLayoutFlex, 'commonborderwidth', NGPropertyMapped::MultiplicityScalar, false, 1, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonmargin', NGProperty::TypeString, self::DomainLayoutFlex, 'commonmargin', NGPropertyMapped::MultiplicityScalar, false, '0 0 10 0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonpadding', NGProperty::TypeString, self::DomainLayoutFlex, 'commonpadding', NGPropertyMapped::MultiplicityScalar, false, '10', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonroundedcorners', NGProperty::TypeString, self::DomainLayoutFlex, 'commonroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonvisible', NGProperty::TypeBool, self::DomainLayoutFlex, 'commonvisible', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonshadow', NGProperty::TypeString, self::DomainLayoutFlex, 'commonshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonnavigationcommon', NGProperty::TypeText, self::DomainLayoutFlex, 'commonnavigationcommon', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginNavigationCommon', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonfill', NGProperty::TypeString, self::DomainLayoutFlex, 'commonfill', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonlinetop', NGProperty::TypeString, self::DomainLayoutFlex, 'commonlinetop', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'commonlinebottom', NGProperty::TypeString, self::DomainLayoutFlex, 'commonlinebottom', NGPropertyMapped::MultiplicityScalar, false, '0 d3d3d3', false );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdLayoutFlex );
	}
	
	public function leftExtraWidth() {
		return $this->totalExtraWidth ( $this->leftmargin, $this->leftpadding, $this->leftborderwidth );
	}
	
	public function leftTotalWidth() {
		return $this->leftwidth + $this->leftExtraWidth ();
	}
	
	public function rightExtraWidth() {
		return $this->totalExtraWidth ( $this->rightmargin, $this->rightpadding, $this->rightborderwidth );
	}
	
	public function rightTotalWidth() {
		return $this->rightwidth + $this->rightExtraWidth ();
	}
	
	public function contentExtraWidth() {
		return $this->totalExtraWidth ( $this->contentmargin, $this->contentpadding, $this->contentborderwidth );
	}
	
	public function headerExtraWidth() {
		return $this->totalExtraWidth ( $this->headermargin, $this->headerpadding, $this->headerborderwidth );
	}
	
	public function footerExtraWidth() {
		return $this->totalExtraWidth ( $this->footermargin, $this->footerpadding, $this->footerborderwidth );
	}
	
	public function eyecatcherExtraWidth() {
		return $this->totalExtraWidth ( $this->eyecatchermargin, $this->eyecatcherpadding, $this->eyecatcherborderwidth );
	}
	
	public function navleftExtraWidth() {
		return $this->totalExtraWidth ( $this->navleftmargin, $this->navleftpadding, $this->navleftborderwidth );
	}
	
	public function navleftTotalWidth() {
		return $this->navleftwidth + $this->navleftExtraWidth ();
	}
	
	public function navrightExtraWidth() {
		return $this->totalExtraWidth ( $this->navrightmargin, $this->navrightpadding, $this->navrightborderwidth );
	}
	
	public function navrightTotalWidth() {
		return $this->navrightwidth + $this->navrightExtraWidth ();
	}
	
	public function navExtraWidth() {
		return $this->totalExtraWidth ( $this->navmargin, $this->navpadding, $this->navborderwidth );
	}
		
	
	public function containermainExtraWidth() {
		return $this->totalExtraWidth ( $this->containermainmargin, $this->containermainpadding, $this->containermainborderwidth );
	}
	
	public function containerleftExtraWidth() {
		return $this->totalExtraWidth ( $this->containerleftmargin, $this->containerleftpadding, $this->containerleftborderwidth );
	}
	
	public function containerrightExtraWidth() {
		return $this->totalExtraWidth ( $this->containerrightmargin, $this->containerrightpadding, $this->containerrightborderwidth );
	}
	
	public function searchleftExtraWidth() {
		return $this->totalExtraWidth ( $this->searchleftmargin, $this->searchleftpadding, $this->searchleftborderwidth );
	}
	
	public function searchleftTotalWidth() {
		return $this->searchleftwidth + $this->searchleftExtraWidth ();
	}
	
	public function searchrightExtraWidth() {
		return $this->totalExtraWidth ( $this->searchrightmargin, $this->searchrightpadding, $this->searchrightborderwidth );
	}
	
	public function searchrightTotalWidth() {
		return $this->searchrightwidth + $this->searchrightExtraWidth ();
	}
	
	public function commonExtraWidth() {
		return $this->totalExtraWidth ( $this->commonmargin, $this->commonpadding, $this->commonborderwidth );
	}
	
	public function commonTotalWidth() {
		return $this->commonwidth + $this->commonExtraWidth ();
	}
	
	public function logoleftExtraWidth() {
		return $this->totalExtraWidth ( $this->logoleftmargin, $this->logoleftpadding, $this->logoleftborderwidth );
	}
	
	public function logoleftTotalWidth() {
		return $this->logoleftwidth + $this->logoleftExtraWidth ();
	}
	
	public function logorightExtraWidth() {
		return $this->totalExtraWidth ( $this->logorightmargin, $this->logorightpadding, $this->logorightborderwidth );
	}
	
	public function logorightTotalWidth() {
		return $this->logorightwidth + $this->logorightExtraWidth ();
	}
}