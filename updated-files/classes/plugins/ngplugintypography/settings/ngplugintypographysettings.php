<?php

class NGPluginTypographySettings extends NGSetting {
	const IdTypography = 'typography';
	const ObjectTypeNGPluginTypographySettings = 'NGPluginTypographySettings';
	const DomainTypography = 'typography';
	
	public $defaultfont = 'Open Sans,16,false,false,false,000000';
	public $defaultmargin = '10 10';
	public $defaultlineheight = 160;
	
	public $headline1font = 'Open Sans,36,false,false,false,5a5a5a';
	public $headline1margin = '0 0';
	public $headline1lineheight = 160;
	
	public $headline2font = 'Open Sans,20,false,false,true,5a5a5a';
	public $headline2margin = '10 10';
	public $headline2lineheight = 160;
	
	public $headline3font = 'Open Sans,16,true,false,true,5a5a5a';
	public $headline3margin = '10 10';
	public $headline3lineheight = 160;
	
	public $headline4font = 'Open Sans,16,false,false,true,000000';
	public $headline4margin = '10 10';
	public $headline4lineheight = 160;
	
	public $headline5font = 'Open Sans,16,false,true,false,000000';
	public $headline5margin = '10 10';
	public $headline5lineheight = 160;
	
	public $headline6font = 'Open Sans,16,false,false,false,000000';
	public $headline6margin = '10 10';
	public $headline6lineheight = 160;
	
	public $linkfontstyle = 'true,false,false,395e8a';
	public $linkunderline = false;
	public $linkhoverfontstyle = 'true,false,false,395e8a';
	public $linkhoverunderline = true;
	
	public $fieldfont = 'Open Sans,16,false,false,false,000000';
	public $fieldbordercolor = 'c3c3c3';
	public $fieldborderwidth = '1';
	public $fieldbackground = 'solid ffffff';
	public $fieldpadding = '6 12 6 12';
	public $fieldroundedcorners = '0';
	public $fieldshadow = '3 3 0 SE';
	
	public $fieldcaptionfont = 'Open Sans,16,false,false,false,5a5a5a';
	public $fieldcaptionerrorcolor = 'c0312d';
	
	public $submitfont = 'Open Sans,14,false,false,true,ffffff';
	public $submitbordercolor = '444444';
	public $submitborderwidth = '0';
	public $submitbackground = 'solid 444444';
	public $submitpadding = '10 20 10 20';
	public $submitroundedcorners = '0';
	public $submitshadow = '3 3 0 SE';
	public $submithoverfontstyle = 'false,false,true,ffffff';
	public $submithoverbordercolor = '000000';
	public $submithoverbackground = 'solid 000000';
	
	public $cellfont = 'Open Sans,16,false,false,false,464646';
	public $cellbordercolor = 'c3c3c3';
	public $cellborderwidth = '1';
	public $cellbackground = 'solid ffffff';
	public $cellaltbackground = 'solid f0f0f0';
	public $cellpadding = '6 12 6 12';
	
	public $cellheaderfont = 'Open Sans,16,true,false,false,464646';
	public $cellheaderbordercolor = 'c3c3c3';
	public $cellheaderborderwidth = '1';
	public $cellheaderbackground = 'solid ebebeb';
	public $cellheaderpadding = '6 12 6 12';
	
	public function registerWebFonts() {
		$this->registerWebFont ( $this->defaultfont );
		$this->registerWebFont ( $this->headline1font );
		$this->registerWebFont ( $this->headline2font );
		$this->registerWebFont ( $this->headline3font );
		$this->registerWebFont ( $this->headline4font );
		$this->registerWebFont ( $this->headline5font );
		$this->registerWebFont ( $this->headline6font );
		$this->registerWebFont ( $this->fieldfont );
		$this->registerWebFont ( $this->fieldcaptionfont );
		$this->registerWebFont ( $this->submitfont );
		$this->registerWebFont ( $this->cellfont );
		$this->registerWebFont ( $this->cellheaderfont );
	}
	
	private function registerWebFont($font) {
		$parts = explode ( ',', $font );
		NGFontUtil::getInstance ()->getFontStack ( $parts [0] );
	}
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'defaultfont', NGPropertyMapped::TypeString, self::DomainTypography, 'defaultfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'defaultmargin', NGPropertyMapped::TypeString, self::DomainTypography, 'defaultmargin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'defaultlineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'defaultlineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline1font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline1font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,36,false,false,false,5a5a5a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline1margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline1margin', NGPropertyMapped::MultiplicityScalar, false, '0 0' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline1lineheight', NGPropertyMapped::TypeString, self::DomainTypography, 'headline1lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline2font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline2font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,20,false,false,true,5a5a5a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline2margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline2margin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline2lineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'headline2lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline3font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline3font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,true,false,true,5a5a5a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline3margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline3margin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline3lineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'headline3lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline4font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline4font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,true,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline4margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline4margin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline4lineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'headline4lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline5font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline5font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,true,false,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline5margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline5margin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline5lineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'headline5lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline6font', NGPropertyMapped::TypeString, self::DomainTypography, 'headline6font', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline6margin', NGPropertyMapped::TypeString, self::DomainTypography, 'headline6margin', NGPropertyMapped::MultiplicityScalar, false, '10 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'headline6lineheight', NGPropertyMapped::TypeInt, self::DomainTypography, 'headline6lineheight', NGPropertyMapped::MultiplicityScalar, false, 160 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'linkfontstyle', NGPropertyMapped::TypeString, self::DomainTypography, 'linkfontstyle', NGPropertyMapped::MultiplicityScalar, false, 'true,false,false,395e8a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'linkunderline', NGPropertyMapped::TypeBool, self::DomainTypography, 'linkunderline', NGPropertyMapped::MultiplicityScalar, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'linkhoverfontstyle', NGPropertyMapped::TypeString, self::DomainTypography, 'linkhoverfontstyle', NGPropertyMapped::MultiplicityScalar, false, 'true,false,false,395e8a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'linkhoverunderline', NGPropertyMapped::TypeBool, self::DomainTypography, 'linkhoverunderline', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldfont', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldbordercolor', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'c3c3c3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldborderwidth', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldpadding', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldpadding', NGPropertyMapped::MultiplicityScalar, false, '4' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldroundedcorners', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '0' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldshadow', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 0 SE' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldcaptionfont', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldcaptionfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,5a5a5a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fieldcaptionerrorcolor', NGPropertyMapped::TypeString, self::DomainTypography, 'fieldcaptionerrorcolor', NGPropertyMapped::MultiplicityScalar, false, 'a65856' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitfont', NGPropertyMapped::TypeString, self::DomainTypography, 'submitfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,5a5a5a' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitbordercolor', NGPropertyMapped::TypeString, self::DomainTypography, 'submitbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'afafaf' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitborderwidth', NGPropertyMapped::TypeString, self::DomainTypography, 'submitborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'submitbackground', NGPropertyMapped::MultiplicityScalar, false, 'gradient ffffff d3d3d3 24' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitpadding', NGPropertyMapped::TypeString, self::DomainTypography, 'submitpadding', NGPropertyMapped::MultiplicityScalar, false, '5 10 5 10' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitroundedcorners', NGPropertyMapped::TypeString, self::DomainTypography, 'submitroundedcorners', NGPropertyMapped::MultiplicityScalar, false, '2' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submitshadow', NGPropertyMapped::TypeString, self::DomainTypography, 'submitshadow', NGPropertyMapped::MultiplicityScalar, false, '3 3 9 SE' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submithoverfontstyle', NGPropertyMapped::TypeString, self::DomainTypography, 'submithoverfontstyle', NGPropertyMapped::MultiplicityScalar, false, 'false,false,false,000000' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submithoverbordercolor', NGPropertyMapped::TypeString, self::DomainTypography, 'submithoverbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'c3c3c3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'submithoverbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'submithoverbackground', NGPropertyMapped::MultiplicityScalar, false, 'gradient ffffff ebebeb 24' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellfont', NGPropertyMapped::TypeString, self::DomainTypography, 'cellfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,false,false,false,464646' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellbordercolor', NGPropertyMapped::TypeString, self::DomainTypography, 'cellbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'c3c3c3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellborderwidth', NGPropertyMapped::TypeString, self::DomainTypography, 'cellborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'cellbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellaltbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'cellaltbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid f0f0f0' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellpadding', NGPropertyMapped::TypeString, self::DomainTypography, 'cellpadding', NGPropertyMapped::MultiplicityScalar, false, '4' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellheaderfont', NGPropertyMapped::TypeString, self::DomainTypography, 'cellheaderfont', NGPropertyMapped::MultiplicityScalar, false, 'Open Sans,16,true,false,false,464646' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellheaderbordercolor', NGPropertyMapped::TypeString, self::DomainTypography, 'cellheaderbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'c3c3c3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellheaderborderwidth', NGPropertyMapped::TypeString, self::DomainTypography, 'cellheaderborderwidth', NGPropertyMapped::MultiplicityScalar, false, '1' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellheaderbackground', NGPropertyMapped::TypeString, self::DomainTypography, 'cellheaderbackground', NGPropertyMapped::MultiplicityScalar, false, 'solid ebebeb' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'cellheaderpadding', NGPropertyMapped::TypeString, self::DomainTypography, 'cellheaderpadding', NGPropertyMapped::MultiplicityScalar, false, '4' );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdTypography );
	}
	
	public function fieldExtraWidth() {
		return $this->totalExtraWidth ( '0', $this->fieldpadding, $this->fieldborderwidth );
	}
}