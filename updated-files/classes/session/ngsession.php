<?php
class NGSession {
	
	const TableSession = 'session';
	const ColumnSessionUID = 'session_uid';
	const ColumnTimeStart = 'time_start';
	const ColumnTimeExpire = 'time_expire';
	const ColumnUserUID = 'user_uid';
	
	/**
	 * 
	 * User currently logged in 
	 * @var NGUser
	 */
	public $user;
	
	/**
	 * 
	 * UID of current session
	 * @var string
	 */
	public $sessionUID;
	
	/**
	 * 
	 * Start time of Session
	 * @var int
	 */
	public $timeStart;
	
	/**
	 * 
	 * Enter description here ...
	 * @var int
	 */
	public $timeExpire;
	
	/**
	 * 
	 * Timestamp when current operation started 
	 * @var int
	 */
	public $callTimestamp;
	
	/**
	 * 
	 * Path to root
	 * @var string
	 */
	public $stepsToRoot = 0;
	
	public function pathToRoot() {
		if ($this->stepsToRoot == 0) {
			return './';
		} else {
			return str_repeat ( '../', $this->stepsToRoot );
		}
	}
	
	private $languageRessources = Array ();
	
	/**
	 * 
	 * Current path
	 * @var string
	 */
	public $currentPath;
	
	/**
	 * 
	 * Navigation instance
	 * @var NGNavigation
	 */
	public $navigation = null;
	
	/**
	 * 
	 * Language to be used, when a property is localized
	 * @var string
	 */
	public $localizedLang = NGUtil::LanguageDefault;
	
	private $navContent = NULL;
	
	private static $instance = NULL;
	
	private function __construct() {
		$this->callTimestamp = time ();
	}
	
	private function __clone() {
	
	}
	
	/**
	 * Singleton database access
	 *
	 * @return NGSession Unique class instance
	 */
	public static function getInstance() {
		
		if (self::$instance === NULL) {
			self::$instance = new self ();
		}
		return self::$instance;
	}
	
	/**
	 * 
	 * Creates a random session ID
	 * @return string
	 */
	private function createSessionUID() {
		$sessionUID = '';
		
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		
		for($i = 0; $i < 32; $i ++) {
			$sessionUID .= substr ( $chars, rand ( 0, 35 ), 1 );
		}
		
		return $sessionUID;
	}
	
	/**
	 * 
	 * Start a Session by authentification
	 * @param string $login
	 * @param string $password
	 * @param bool $captureSession
	 * @param int $minutesToLive
	 */
	public function startByAuth($login, $password, $minutesToLive = 1440, $captureSession = false) {
		NGDBConnector::getInstance ()->connect ();
		
		if ($login == NGUtil::UserSystem && $password ===  NGConfig::SystemPassword ) {
			$user = NGUser::getUserSystem ();
			return $this->startByUser ( $user, $minutesToLive );
		} else {
			$userAdapter = new NGDBAdapterObject ();
			
			$users = $userAdapter->queryObjects ( NGUser::ObjectTypeUser, array (new NGPropertyCriteria ( 'login', NGPropertyCriteria::TypeString, $login, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGUser::DomainUser ), new NGPropertyCriteria ( 'password', NGPropertyCriteria::TypeString, $password, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGUser::DomainSecurity ), new NGPropertyCriteria ( 'enabled', NGPropertyCriteria::TypeBool, true, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGUser::DomainUser ) ), false, NGUser::ObjectTypeUser, '', '', NGUtil::ObjectUIDRootUsersAndGroups );
			
			if (count ( $users ) === 1) {
				$user = $userAdapter->loadObject ( $users [0]->objectUID, NGUser::ObjectTypeUser, NGUser::ObjectTypeUser );
				
				if (! $captureSession) {
					$sessionQuery = new NGDBQuerySelect ();
					$sessionQuery->table = self::TableSession;
					$sessionQuery->colums = array (self::ColumnUserUID );
					$sessionQuery->whereCriterias = array (new NGDBQPartCriteriaWhere ( self::ColumnUserUID, $user->objectUID, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
					
					$result = $sessionQuery->executeQuery ();
										
					if ($result->num_rows>0)
						throw new NGAlreadyLoggedInException ( $login );
				}
				
				return $this->startByUser ( $user, $minutesToLive );
			} else {
				throw new NGIllegalCredentialsException ();
			}
		}
		
		return '';
	}
	
	/**
	 * 
	 * Starts a new session
	 * @param NGUser $user
	 * @param int $minutesToLive
	 */
	public function startByUser($user, $minutesToLive = 1440) {
		NGDBConnector::getInstance ()->connect ();
		
		$this->sessionUID = $this->createSessionUID ();
		$this->timeStart = time ();
		$this->timeExpire = $this->timeStart + 60 * $minutesToLive;
		$this->user = $user;
		
		$this->deleteExpiredSessions ();
		$this->deleteOrphanSessions ( $this->user->objectUID );
		
		return $this->saveSession ();
	}
	
	/**
	 * 
	 * Retrieves a session from the database
	 * @param string $sessionUID
	 * @return bool true if session is o.k.
	 */
	public function resume($sessionUID) {
		NGDBConnector::getInstance ()->connect ();
		
		$this->user = new NGUser ();
		$this->sessionUID = $sessionUID;
		
		$sessionQuery = new NGDBQuerySelect ();
		$sessionQuery->table = self::TableSession;
		$sessionQuery->colums = array (self::ColumnUserUID, self::ColumnTimeStart, self::ColumnTimeExpire );
		$sessionQuery->whereCriterias = array (new NGDBQPartCriteriaWhere ( self::ColumnSessionUID, $this->sessionUID, NGDBQPartCriteria::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
		$result = $sessionQuery->executeQuery ();
		
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc ();
			
			$userUID = $row [self::ColumnUserUID];
			$this->timeStart = strtotime ( $row [self::ColumnTimeStart] );
			$this->timeExpire = strtotime ( $row [self::ColumnTimeExpire] );
			
			$userAdapter = new NGDBAdapterObject ();
			
			$this->user = $userAdapter->loadObject ( $userUID, NGUser::ObjectTypeUser, NGUser::ObjectTypeUser, '', true, false, false );
			return true;
		}
		
		$this->sessionUID = '';
		
		return false;
	}
	
	/**
	 * 
	 * Terminates a session
	 */
	public function terminate() {
		NGDBConnector::getInstance ()->connect ();
		$this->deleteSession ( $this->sessionUID );
		$this->sessionUID = '';
		$this->user = new NGUser ();
	}
	
	/**
	 * 
	 * Deletes "hanging" sessions of the same user
	 * @param string $userUID
	 */
	private function deleteOrphanSessions($userUID) {
		$deleteQuery = new NGDBQueryDelete ();
		$deleteQuery->table = self::TableSession;
		
		$deleteQuery->whereCriterias = array (new NGDBQPartCriteriaWhere ( self::ColumnUserUID, $userUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
		
		$deleteQuery->executeQuery ();
	}
	
	/**
	 * 
	 * Deletes expired sessions
	 */
	private function deleteExpiredSessions() {
		$deleteQuery = new NGDBQueryDelete ();
		$deleteQuery->table = self::TableSession;
		
		$deleteQuery->whereCriterias = array (new NGDBQPartCriteriaWhere ( self::ColumnTimeExpire, date ( DATE_ATOM ), NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareSmaller ) );
		
		$deleteQuery->executeQuery ();
	}
	
	/**
	 * 
	 * Deletes a given session
	 * @param string $sessionUID
	 */
	private function deleteSession($sessionUID) {
		$deleteQuery = new NGDBQueryDelete ();
		$deleteQuery->table = self::TableSession;
		
		$deleteQuery->whereCriterias = array (new NGDBQPartCriteriaWhere ( self::ColumnSessionUID, $sessionUID, NGDBQPartCriteriaWhere::TypeString, NGDBQPartCriteriaWhere::CompareIs ) );
		
		$deleteQuery->executeQuery ();
	}
	
	/**
	 * 
	 * Saves the current session
	 */
	private function saveSession() {
		
		$insertQuery = new NGDBQueryInsert ();
		
		$insertQuery->table = self::TableSession;
		
		$insertQuery->insertCriterias = array (new NGDBQPartCriteria ( self::ColumnSessionUID, $this->sessionUID, NGDBQPartCriteria::TypeString ), new NGDBQPartCriteria ( self::ColumnTimeStart, date ( DATE_ATOM, $this->timeStart ), NGDBQPartCriteria::TypeString ), new NGDBQPartCriteria ( self::ColumnTimeExpire, date ( DATE_ATOM, $this->timeExpire ), NGDBQPartCriteria::TypeString ), new NGDBQPartCriteria ( self::ColumnUserUID, $this->user->objectUID, NGDBQPartCriteria::TypeString ) );
		
		$insertQuery->executeQuery ();
		
		return $this->sessionUID;
	}
	
	/**
	 * 
	 * Get the Navigation for the content tree
	 * @return NGNavItem
	 */
	public function getNavContent() {
		if ($this->navigation == null) {
			$this->navigation = new NGNavigation ();
			$this->navContent = $this->navigation->getNavigation ( NGUtil::ObjectUIDRootContent, NGTopic::ObjectTypeTopic );
		}
		
		return $this->navContent;
	}
	
	/**
	 * 
	 * Get the navigation for the Home root
	 * @return NGNavItem
	 */
	public function getNavRootHome() {
		return $this->getNavContent ()->findByUID ( NGUtil::ObjectUIDRootHome );
	}

    /**
     * @param $url
     * @return NGLanguageResource[]
     * @throws NGException
     */
	public function getLanguageRessource($url) {
		if (array_key_exists ( $url, $this->languageRessources )) {
			return $this->languageRessources [$url];
		} else {
			$languageAdapter = new NGLanguageAdapter ();
			$languageAdapter->langURL = $url;
			$languageAdapter->load ();
			$this->languageRessources [$url] = $languageAdapter->languageResources;
			return $languageAdapter->languageResources;
		}
	}
}