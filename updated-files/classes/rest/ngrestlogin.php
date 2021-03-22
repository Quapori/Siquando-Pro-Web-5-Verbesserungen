<?php

class NGRestLogin extends NGRest
{
    const NodeLogin = 'login';
    const NodePassword = 'password';
    const NodeSessionUID = 'sessionuid';
    const NodeUser = 'user';
    const NodeMaingroup = 'maingroup';
    const NodeExpires = 'expires';
    const NodeCaptureSession = 'capturesession';
    const NodePermissions = 'permissions';
    const NodePermission = 'permission';
    const NodeSignature = 'signature';
    const NodeId = 'id';
    const NodeServerTime = 'servertime';
    const NodeCustomerName = 'customername';
    const NodeCustomerEmail = 'customeremail';
    const NodeCustomerId = 'customerid';
    const NodeVersion = 'version';
    const NodeBuild = 'build';
    const NodeProduct = 'product';
    const NodeIsShop = 'isshop';
    public $login = '';
    public $password = '';
    public $sessionUID = '';
    public $captureSession = false;

    /*
     * (non-PHPdoc)
     * @see NGRest::handleRequest()
     */
    function handleRequest()
    {
        $this->sessionUID = NGSession::getInstance()->startByAuth($this->login, $this->password, 1440, $this->captureSession);
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    /*
     * (non-PHPdoc)
     * @see NGRest::loadRequest()
     */
    function loadRequest()
    {
        foreach ($this->requestDocument->documentElement->childNodes as $loginNode) {
            /* @var $loginNode DOMElement */
            if ($loginNode->nodeType == XML_ELEMENT_NODE) {
                switch ($loginNode->nodeName) {
                    case self::NodeLogin :
                        $this->login = $loginNode->nodeValue;
                        break;
                    case self::NodePassword :
                        $this->password = $loginNode->nodeValue;
                        break;
                    case self::NodeCaptureSession :
                        $this->captureSession = NGUtil::StringXMLToBool($loginNode->nodeValue);
                        break;
                }
            }
        }
    }

    /*
     * (non-PHPdoc)
     * @see NGRest::saveResponse()
     */
    function saveResponse()
    {
        if ($this->sessionUID != '') {
            $this->appendElement($this->responseDocument->documentElement, self::NodeSessionUID, $this->sessionUID);
            $this->appendElement($this->responseDocument->documentElement, self::NodeExpires, date(DATE_ATOM, NGSession::getInstance()->timeExpire));
            $this->appendElement($this->responseDocument->documentElement, self::NodeUser, NGSession::getInstance()->user->objectUID);
            $this->appendElement($this->responseDocument->documentElement, self::NodeMaingroup, NGSession::getInstance()->user->maingroup);
            $this->appendElement($this->responseDocument->documentElement, self::NodeIsShop, NGUtil::boolToStringXML(NGConfig::IsShop));
            $this->savePermissions();
        } else {
            $this->appendElement($this->responseDocument->documentElement, self::NodeSessionUID, '');
            $this->appendElement($this->responseDocument->documentElement, self::NodeExpires, date(DATE_ATOM));
            $this->appendElement($this->responseDocument->documentElement, self::NodeUser, '');
        }

        $this->appendElement($this->responseDocument->documentElement, self::NodeVersion, NGConfig::ServerVersion);
        $this->appendElement($this->responseDocument->documentElement, self::NodeBuild, NGConfig::ServerBuild);
    }

    /**
     * Save permissions node
     */
    function savePermissions()
    {
        $this->appendElement($this->responseDocument->documentElement, self::NodeServerTime, date(DATE_ATOM));

        $permissionsElement = $this->appendElement($this->responseDocument->documentElement, self::NodePermissions, null, array(
            self::NodeId => NGConfig::InstallationId,
            self::NodeSignature => NGConfigPermissions::PermissionsSignature,
            self::NodeCustomerName => NGConfigPermissions::CustomerName,
            self::NodeCustomerEmail => NGConfigPermissions::CustomerEmail,
            self::NodeCustomerId => NGConfigPermissions::CustomerId,
            self::NodeProduct => NGConfig::Product
        ));

        $permissions = explode(',', NGConfigPermissions::Permissions);

        foreach ($permissions as $permission) {
            $parts = explode(':', $permission);

            if (count($parts) == 3) {
                $permissionElement = $this->appendElement($permissionsElement, self::NodePermission, $parts [2]);
                $this->appendAttribute($permissionElement, self::NodeId, $parts [0]);
                if ($parts [1] != '')
                    $this->appendAttribute($permissionElement, self::NodeExpires, $parts [1]);
            }
        }
    }

    /*
     * (non-PHPdoc)
     * @see NGRest::loginRequired()
     */
    function loginRequired()
    {
        return false;
    }

    /*
     * (non-PHPdoc)
     * @see NGRest::loginRequired()
     */
    function connectionRequired()
    {
        return true;
    }
}