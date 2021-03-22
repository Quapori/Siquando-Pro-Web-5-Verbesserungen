<?php

class NGGuestbookSettings extends NGSetting {
	const IdGuestbook = 'guestbook';
	const ObjectTypeNGGuestbookSettings = 'NGGuestbookSettings';
	const DomainGuestbook = 'guestbook';
	
	public $star = 'default';
	public $reply = 'default';
	public $recaptchapublic = '';
	public $recaptchaprivate = '';
	public $colorbarbackground = 'ebebeb';
	public $colorbarforeground = 'a4bbd6';
	public $colorstarinactivestroke = 'c3c3c3';
	public $colorstarinactivefill = 'ffffff';
	public $colorstaractivestroke = '5779a3';
	public $colorstaractivefill = 'd4e0f0';
	public $colorreply = 'a4bbd6';
	public $replypictureuid='';
	public $replypicturesize='small';
	
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'star', NGPropertyMapped::TypeString, self::DomainGuestbook, 'star', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'reply', NGPropertyMapped::TypeString, self::DomainGuestbook, 'reply', NGPropertyMapped::MultiplicityScalar, false, 'default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'recaptchapublic', NGPropertyMapped::TypeString, self::DomainGuestbook, 'recaptchapublic', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'recaptchaprivate', NGPropertyMapped::TypeString, self::DomainGuestbook, 'recaptchaprivate', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbarbackground', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorbarbackground', NGPropertyMapped::MultiplicityScalar, false, 'ebebeb' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorbarforeground', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorbarforeground', NGPropertyMapped::MultiplicityScalar, false, 'a4bbd6' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorstarinactivestroke', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorstarinactivestroke', NGPropertyMapped::MultiplicityScalar, false, '5779a3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorstarinactivefill', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorstarinactivefill', NGPropertyMapped::MultiplicityScalar, false, 'ffffff' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorstaractivestroke', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorstaractivestroke', NGPropertyMapped::MultiplicityScalar, false, '5779a3' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorstaractivefill', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorstaractivefill', NGPropertyMapped::MultiplicityScalar, false, 'd4e0f0' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'colorreply', NGPropertyMapped::TypeString, self::DomainGuestbook, 'colorreply', NGPropertyMapped::MultiplicityScalar, false, 'a4bbd6' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'replypictureuid', NGPropertyMapped::TypeString, self::DomainGuestbook, 'replypictureuid', NGPropertyMapped::MultiplicityScalar, false, '' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'replypicturesize', NGPropertyMapped::TypeString, self::DomainGuestbook, 'replypicturesize', NGPropertyMapped::MultiplicityScalar, false, 'small' );
	}
	
	public function __construct() {
		parent::__construct ();
		
		$this->setId ( self::IdGuestbook );
	}
	
	/**
	 * 
	 * Get the real size of reply picture
	 */
	public function getReplyPictureSize()
	{
		switch ($this->replypicturesize) {
			case 'medium':
				return 48;				
			case 'large':
				return 64;				
			default:
				return 32;
		}
	}
}