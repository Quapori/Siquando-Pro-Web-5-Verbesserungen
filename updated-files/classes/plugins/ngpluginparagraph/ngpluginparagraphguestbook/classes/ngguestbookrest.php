<?php

class NGGuestbookRest {
	
	/**
	 * 
	 * main data adapter
	 * @var NGDBAdapterObject
	 */
	public $adapter;
	
	/**
	 * 
	 * Language adapter
	 * @var NGLanguageAdapter
	 */
	public $lang;
	
	/**
	 * 
	 * paragraph
	 * @var NGPluginParagraphGuestbook
	 */
	public $paragraph;
	
	/**
	 * 
	 * Settings
	 * @var NGGuestbookSettings
	 */
	private $settings;
	
	public function handle() {
		$action = NGUtil::post ( 'action', '' );
		
		switch ($action) {
			case 'post' :
				$this->handlePost ();
				break;
			case 'get' :
				$this->handleGet ();
				break;
			default :
				header ( "HTTP/1.1 500 Internal Server Error" );
				echo ('Action is not implemented');
				break;
		}
	}
	
	public function handlePost() {
		$name = NGUtil::post ( 'name', '' );
		$email = NGUtil::post ( 'email', '' );
		$location = NGUtil::post ( 'location', '' );
		$message = NGUtil::post ( 'message', '' );
		$caption = NGUtil::post ( 'caption', '' );
		$stars = intval ( NGUtil::post ( 'stars', '0' ) );
		$privacymustconsent = NGUtil::post('privacymustconsent', '');
        $privacyconsent = NGUtil::post('privacyconsent', '');

		$missingfields = array ();
		
		$this->settings = $this->adapter->loadSetting ( NGGuestbookSettings::IdGuestbook, NGGuestbookSettings::ObjectTypeNGGuestbookSettings );
		
		if ($this->paragraph === null) {
			$this->handleError ( 'paranotfound' );
			return;
		}
		
		if ($name === '' || strlen ( $name ) > 200)
			$missingfields [] = 'name';
		if (($location === '' || strlen ( $location ) > 200) && $this->paragraph->location)
			$missingfields [] = 'location';
		if ($message === '' || strlen ( $email ) > 2000)
			$missingfields [] = 'message';
		if ($caption === '' || strlen ( $caption ) > 250)
			$missingfields [] = 'caption';

        if ($this->paragraph->email && ! NGUtil::checkEmail ( $email ))
			$missingfields [] = 'email';

        if (count ( $missingfields ) > 0) {
            $this->handleError($this->lang->languageResources ['missingfields']->value, $missingfields);
            return;
        } else if ($privacymustconsent === 'privacymustconsent' && $privacyconsent !=='privacyconsent') {
            $missingfields [] = 'privacyconsent';
            $this->handleError ( $this->lang->languageResources ['mustconsent']->value, $missingfields );
            return;
        } else {
			if ($this->settings->recaptchapublic !== '') {
				if (! $this->checkCaptcha ()) {
					$missingfields [] = 'captcha';
					$this->handleError ( $this->lang->languageResources ['invalidcaptcha']->value, $missingfields );
					return;
				}
			}
		}
		
		if (! $this->paragraph->locked) {
			$guestBookPost = new NGGuestbookPost ();
			$guestBookPost->caption = $caption;
			$guestBookPost->email = $email;
			$guestBookPost->location = $location;
			$guestBookPost->message = $message;
			$guestBookPost->name = $name;
			$guestBookPost->stars = $stars;
			$guestBookPost->uidparagraph = $this->paragraph->filterUID ();
			$guestBookPost->visible = ! $this->paragraph->moderate;
			$this->adapter->saveObject ( $guestBookPost );
		}
		
		if ($this->paragraph->mail && NGUtil::checkEmail ( $this->paragraph->sendto )) {
			$template = new NGTemplate ();
			$template->assign ( 'lang', $this->lang->languageResources );
			
			$template->assign ( 'name', $name );
			$template->assign ( 'caption', $caption );
			$template->assign ( 'message', $message );
			$template->assign ( 'mod', $this->paragraph->moderate );
			
			/* @var $stream NGParagraphStream */
			$stream = $this->adapter->loadObject ( $this->paragraph->parentUID, NGParagraphStream::ObjectTypeParagraphStream );
			
			if ($stream != null) {
				/* @var $page NGPluginPage */
				$page = $this->adapter->loadObject ( $stream->parentUID, NGPluginPage::ObjectTypePluginPage );
				
				if ($page != null) {
					$link = new NGLink ();
					$link->linkType = NGLink::LinkPage;
					$link->uid = $page->objectUID;
					$link->absolute = true;
					$template->assign ( 'link', $link->getURL () );
				}
			}
			
			if ($this->paragraph->location)
				$template->assign ( 'location', $location );
			
			if ($this->paragraph->email)
				$template->assign ( 'email', $email );
			
			if ($stars > 0) {
				$template->assign ( 'stars', $this->lang->languageResources ['star' . $stars]->value );
			}
			
			$sendMail = new NGMail ();
			$sendMail->sendTo = $this->paragraph->sendto;
			$sendMail->fromMail = $this->paragraph->from;
			$sendMail->fromName = $this->paragraph->fromname;
			$sendMail->subject = $this->paragraph->subject;
			$sendMail->html = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphguestbook/tpl/mail.tpl' );
			
			$sendMail->send ();
		
		}
		
		$this->handleSuccess ( $this->lang->languageResources [$this->paragraph->moderate ? 'thankyoumod' : 'thankyou']->value );
	
	}
	
	public function checkCaptcha() {
		$recaptcha = new ReCaptcha ( $this->settings->recaptchaprivate );
		$resp = $recaptcha->verifyResponse ( $_SERVER ['REMOTE_ADDR'], NGUtil::post ( 'g-recaptcha-response', '' ) );
		
		return $resp->success;
	}
	
	public function handleError($message, $missingfields) {
		$data = array ('state' => 'error', 'message' => $message, 'missing' => $missingfields );
		$this->sendJsonHeader ();
		echo (json_encode ( $data ));
	}
	
	public function handleSuccess($message) {
		$data = array ('state' => 'ok', 'message' => $message );
		$this->sendJsonHeader ();
		echo (json_encode ( $data ));
	}
	
	private function sendJsonHeader() {
		header ( 'Content-Type: application/json' );
	}
	
	public function handleGet() {
		
		$criterias = array ();
		
		$stars = array (0, 0, 0, 0, 0 );
		
		$starsFilter = intval ( NGUtil::post ( 'stars', '0' ) );
		
		$criterias [] = new NGPropertyCriteria ( 'uidparagraph', NGProperty::TypeUID, $this->paragraph->filterUID (), false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGGuestbookPost::DomainGuestbookPost );
		$criterias [] = new NGPropertyCriteria ( 'visible', NGProperty::TypeBool, true, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGGuestbookPost::DomainGuestbookPost );
		$criterias [] = new NGPropertyCriteria ( 'caption', NGProperty::TypeString, '', false, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageDefault, NGGuestbookPost::DomainGuestbookPost );
		$criterias [] = new NGPropertyCriteria ( 'name', NGProperty::TypeString, '', false, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageDefault, NGGuestbookPost::DomainGuestbookPost );
		$criterias [] = new NGPropertyCriteria ( 'stars', NGProperty::TypeInt, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGGuestbookPost::DomainGuestbookPost );
		
		$results = $this->adapter->queryObjects ( NGGuestbookPost::ObjectTypeGuestBookPost, $criterias, NGPropertyCriteria::SortDesc, NGObject::ObjectTypeObject, '', '', NGPluginParagraphGuestbook::uidDataFolder () );
		
		$items = array ();
		
		$page = intval ( NGUtil::post ( 'page', '0' ) );
		
		$first = $page * $this->paragraph->postsperpage;
		$last = $first + $this->paragraph->postsperpage - 1;
		
		$offset = 0;
		
		$total = 0;
		
		foreach ( $results as $result ) {
			/* @var $result NGObject */
			
			$star = $result->properties [0]->value;
			
			if ($star >= 1 && $star <= 5)
				$stars [$star - 1] ++;
			
			if ($starsFilter === 0 || $starsFilter === $star) {
				
				$total ++;
				
				if ($offset >= $first && $offset <= $last) {
					
					$postObject = $this->adapter->loadObject ( $result->objectUID, NGGuestbookPost::ObjectTypeGuestBookPost, NGGuestbookPost::ObjectTypeGuestBookPost, '', true, false, false, false );
					/* @var $postObject NGGuestbookPost */
					
					$item = array ('date' => date ( NGConfig::DateFormatLocal, strtotime ( $postObject->creationDate ) ), 'caption' => $postObject->caption, 'name' => $postObject->name, 'message' => $postObject->message, 'reply' => $postObject->reply );
					
					if ($this->paragraph->stars)
						$item ['stars'] = $postObject->stars;
					if ($this->paragraph->location)
						$item ['location'] = $postObject->location;
					
					$items [] = $item;
				
				}
				$offset ++;
			}
		}
		
		$data = array ('state' => 'ok', 'total' => $total, 'items' => $items, 'stars' => $stars );
		
		$this->sendJsonHeader ();
		echo (json_encode ( $data ));
	
	}
	
	public function __construct() {
		NGSession::getInstance ()->user = NGUser::getUserSystem ();
		NGDBConnector::getInstance ()->connect ();
		
		$this->adapter = new NGDBAdapterObject ();
		
		$this->lang = new NGLanguageAdapter ();
		$this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphguestbook/language/langguestbook.xml';
		$this->lang->load ();
		
		$uid = NGUtil::post ( 'uid', '' );
		$this->paragraph = $this->adapter->loadObject ( $uid, NGPluginParagraphGuestbook::ObjectTypePluginParagraph, NGPluginParagraphGuestbook::ObjectTypePluginParagraphGuestbook );
	}

}