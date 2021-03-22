<?php

class NGGuestbookPost extends NGObjectMapped
{
	const ObjectTypeGuestBookPost = 'NGGuestBookPost';
	
	const DomainGuestbookPost = 'gbpost';
	
	/**
	 * 
	 * Caption of post
	 * @var string
	 */
	public $caption='';
	
	/**
	 * 
	 * Name of author
	 * @var string
	 */
	public $name='';
	
	/**
	 * 
	 * Email of author
	 * @var string
	 */
	public $email='';
	
	/**
	 * 
	 * Location of author
	 * @var string
	 */
	public $location='';
	
	/**
	 * 
	 * Post is visilbe
	 * @var bool
	 */
	public $visible='';
	
	/**
	 * 
	 * Message
	 * @var string
	 */
	public $message = '';
	

	/**
	 * 
	 * Reply
	 * @var string
	 */
	public $reply = '';
	
	/**
	 * 
	 * Stars
	 * @var int
	 */
	public $stars=0;
	
	
	/**
	 * 
	 * UID of paragraph
	 * @var string
	 */
	public $uidparagraph;
	
	protected function getPropertiesMapped() {
		$this->propertiesMapped [] = new NGPropertyMapped ( 'caption', NGProperty::TypeString, self::DomainGuestbookPost, 'caption', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'name', NGProperty::TypeString, self::DomainGuestbookPost, 'name', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'visible', NGProperty::TypeBool, self::DomainGuestbookPost, 'visible', NGPropertyMapped::MultiplicityScalar, false, '', false );		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'uidparagraph', NGProperty::TypeUID, self::DomainGuestbookPost, 'uidparagraph', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'message', NGProperty::TypeFulltext, self::DomainGuestbookPost, 'message', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'reply', NGProperty::TypeFulltext, self::DomainGuestbookPost, 'reply', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'email', NGProperty::TypeString, self::DomainGuestbookPost, 'email', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'location', NGProperty::TypeString, self::DomainGuestbookPost, 'location', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'stars', NGProperty::TypeInt, self::DomainGuestbookPost, 'stars', NGPropertyMapped::MultiplicityScalar, false, 0, false );
	}
	
	public function __construct() {
		parent::__construct ();
		$this->parentUID=NGPluginParagraphGuestbook::uidDataFolder();
	}
}