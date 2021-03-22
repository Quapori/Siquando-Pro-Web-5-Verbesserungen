<?php

class NGAccess
{
    private $objectAdapter;

    private $allowedRealms;

    private $sessionRealms = array();

    public $previewMode = false;

    public $pageUID;

    const SessionKeyRealms = 'NGRealms';

    const Salt = 'fskhuwe73KLkjsdhbcjkh';

    public function handleAccess($folderUID, $pageUID)
    {
        $realms = $this->getRealms($folderUID);

        $this->pageUID = $pageUID;

        if ($realms === '') {
            return true;
        } else {
            $this->allowedRealms = explode(',', $realms);
            $this->getSessionRealms();

            if ($this->sessionRealmsMatch()) {
                return true;
            } else {
                $this->forwardToLogin();
                exit ();
            }
        }
    }

    /**
     * Checks if user may access
     *
     * @param $realms
     * @return bool
     */
    public function checkAccess($realms) {
        if ($realms==='') return true;

        $this->allowedRealms = explode(',', $realms);
        $this->getSessionRealms();

        return ($this->sessionRealmsMatch());
    }

    private function forwardToLogin()
    {
        $pages = $this->objectAdapter->loadSetting(NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages);
        if (array_key_exists('login', $pages->pageuids) && $pages->pageuids ['login'] !== '') {
            $link = new NGLink ();
            $link->linkType = NGLink::LinkPage;
            $link->previewMode = $this->previewMode;
            $link->uid = $pages->pageuids ['login'];

            $query = array('ngtargetuid' => $this->pageUID);

            NGUtil::Forward($link->getUrlAndQuery($query), $this->previewMode);
        } else {
            NGUtil::HeaderForbidden();
        }

    }

    private function sessionRealmsMatch()
    {
        $validRealms = array_intersect($this->sessionRealms, $this->allowedRealms);

        return (count($validRealms) > 0);
    }

    private function getSessionRealms()
    {
        NGUtil::startSession();

        if (array_key_exists(self::SessionKeyRealms, $_SESSION)) {
            $this->sessionRealms = explode(',', $_SESSION [self::SessionKeyRealms]);
        }
    }

    private function getRealms($folderUID)
    {
        /* @var $folder NGFolder */
        $folder = $this->objectAdapter->loadObject($folderUID, null, NGTopic::ObjectTypeFolder);

        if ($folder->realms !== '')
            return $folder->realms;

        if ($folder->parentUID !== NGUtil::ObjectUIDRootContent) {
            return $this->getRealms($folder->parentUID);
        } else {
            return '';
        }
    }

    /**
     *
     * Check user credentials
     * @param string $name
     * @param string $password
     * @return NGAccount account if credentials correct, else NULL
     */
    public function checkUser($name, $password = null)
    {

        $criteria = array();
        $criteria [] = new NGPropertyCriteria ('name', NGPropertyCriteria::TypeString, $name, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGObjectNamed::DomainName);
        if ($password !== null)
            $criteria [] = new NGPropertyCriteria ('password', NGPropertyCriteria::TypeString, md5($password . self::Salt), false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGUser::DomainSecurity);
        $criteria [] = new NGPropertyCriteria ('loginstate', NGPropertyCriteria::TypeString, NGAccount::LoginStateActive, false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, NGAccount::DomainAccount);

        $accounts = $this->objectAdapter->queryObjects(NGAccount::ObjectTypeAccount, $criteria, false, NGAccount::ObjectTypeAccount, '', '', NGUtil::ObjectUIDRootUsersAndGroups);

        if (count($accounts) === 1) {
            return $this->objectAdapter->loadObject($accounts [0]->objectUID, NGAccount::ObjectTypeAccount, NGAccount::ObjectTypeAccount);
        } else {
            return null;
        }
    }

    /**
     *
     * Logout current user
     */
    public function logoutUser()
    {
        unset($_SESSION [self::SessionKeyRealms]);
    }

    /**
     *
     * Authenticae user
     * @param string $name
     * @param string $password
     */
    public function authenticateUser($name, $password)
    {

        /* @var $account NGAccount */
        $account = $this->checkUser($name, $password);

        if ($account !== null) {

            $realms = array();

            foreach ($account->realmmemberships as $realm => $date) {

                if ($date === '') {
                    $realms [] = $realm;
                } else {
                    if (NGSession::getInstance()->callTimestamp < (strtotime($date) + 24 * 60 * 60))
                        $realms [] = $realm;
                }
            }

            NGUtil::startSession();

            $_SESSION [self::SessionKeyRealms] = join(',', $realms);

            return true;

        }

        return false;

    }

    public function __construct()
    {
        $this->objectAdapter = new NGDBAdapterObject ();
    }
}