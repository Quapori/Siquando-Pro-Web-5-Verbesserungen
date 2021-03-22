<?php

class NGCalendarSettings extends NGSetting {
	const IdCalendar = 'calendar';
	const ObjectTypeNGCalendarSettings = 'NGCalendarSettings';
	const DomainParagraphCalendar = 'paragraphcalendar';
	
	public $backcolorday = 'ffffff';
	public $fontcolorday = '444444';
	public $backcolorevent = '828282';
	public $fontcolorevent = 'ffffff';
	public $backcolorgreen = 'e5eed5';
	public $fontcolorgreen = '8ba15d';
	public $backcolororange = 'ffeada';
	public $fontcolororange = 'b27a4c';
	public $backcolorred = 'f3d6d5';
	public $fontcolorred = 'a65826';
	public $backcolorselected = '5779a3';
	public $fontcolorselected = 'ffffff';
	public $calendarbordercolor = 'ededed';
	public $colorinactive = 'f7f7f7';
	
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolorday', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolorday', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolorday', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolorday', NGPropertyMapped::MultiplicityScalar, false, '444444' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolorevent', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolorevent', NGPropertyMapped::MultiplicityScalar, false, '828282' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolorevent', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolorevent', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolorgreen', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolorgreen', NGPropertyMapped::MultiplicityScalar, false, 'e5eed5' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolorgreen', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolorgreen', NGPropertyMapped::MultiplicityScalar, false, '8ba15d' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolororange', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolororange', NGPropertyMapped::MultiplicityScalar, false, 'ffeada' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolororange', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolororange', NGPropertyMapped::MultiplicityScalar, false, 'b27a4c' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolorred', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolorred', NGPropertyMapped::MultiplicityScalar, false, 'f3d6d5' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolorred', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolorred', NGPropertyMapped::MultiplicityScalar, false, 'a65826' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'backcolorselected', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'backcolorselected', NGPropertyMapped::MultiplicityScalar, false, '5779a3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'fontcolorselected', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'fontcolorselected', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'calendarbordercolor', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'calendarbordercolor', NGPropertyMapped::MultiplicityScalar, false, 'ededed' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorinactive', NGPropertyMapped::TypeString, self::DomainParagraphCalendar, 'colorinactive', NGPropertyMapped::MultiplicityScalar, false, 'f7f7f7' );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdCalendar );
	}	
}