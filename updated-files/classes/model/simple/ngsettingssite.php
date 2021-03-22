<?php

class NGSettingsSite extends NGSetting
{
    const IdSite = 'site';
    const ObjectTypeSettingsSite = 'NGSettingsSite';
    const DomainSite = 'site';

    private static $instance = NULL;

    public $metaTags = array();

    public $htmlCode = array();

    public $canonical = '';

    public $googleAnalytics = '';

    public $googleAnalyticsAnonIp = true;

    public $mobileagents = array(
        'Android',
        'iPhone',
        'iPod'
    );

    public $showmobile = false;

    public $title = '[t]';

    public $favicon = '';

    public $touchicon = '';

    public $touchiconprecomposed = false;

    public $lazyload = false;

    public $hdpictures = false;

    public $protectpictures = false;

    public $jpegquality = 75;

    public $showcookiewarning = false;

    public $cookiewarning = '';

    public $cookiewarningcolor = '#ffffff';

    public $cookiewarningtop = false;

    public $cookiemessage = '';

    public $isshop=false;

    public $compress=false;

    public $webp=false;

    public $deferjs=false;

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('metatags', NGProperty::TypeString, NGUtil::DomainSEO, 'metaTags', NGPropertyMapped::MultiplicityDictornary, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('htmlcode', NGProperty::TypeString, NGUtil::DomainSEO, 'htmlCode', NGPropertyMapped::MultiplicityDictornary);
        $this->propertiesMapped [] = new NGPropertyMapped ('canonical', NGProperty::TypeString, NGUtil::DomainSEO, 'canonical', NGPropertyMapped::MultiplicityScalar);
        $this->propertiesMapped [] = new NGPropertyMapped ('googleanalytics', NGProperty::TypeString, self::DomainSite, 'googleAnalytics', NGPropertyMapped::MultiplicityScalar);
        $this->propertiesMapped [] = new NGPropertyMapped ('googleanalyticsanonip', NGProperty::TypeBool, self::DomainSite, 'googleAnalyticsAnonIp', NGPropertyMapped::MultiplicityScalar);
        $this->propertiesMapped [] = new NGPropertyMapped ('mobileagents', NGProperty::TypeText, self::DomainSite, 'mobileagents', NGPropertyMapped::MultiplicityList);
        $this->propertiesMapped [] = new NGPropertyMapped ('showmobile', NGProperty::TypeBool, self::DomainSite, 'showmobile', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('title', NGProperty::TypeText, self::DomainSite, 'title', NGPropertyMapped::MultiplicityScalar, true, '[t]');
        $this->propertiesMapped [] = new NGPropertyMapped ('favicon', NGProperty::TypeUID, self::DomainSite, 'favicon', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('touchicon', NGProperty::TypeUID, self::DomainSite, 'touchicon', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('touchiconprecomposed', NGProperty::TypeBool, self::DomainSite, 'touchiconprecomposed', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('lazyload', NGProperty::TypeBool, self::DomainSite, 'lazyload', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('hdpictures', NGProperty::TypeBool, self::DomainSite, 'hdpictures', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('protectpictures', NGProperty::TypeBool, self::DomainSite, 'protectpictures', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('jpegquality', NGProperty::TypeInt, self::DomainSite, 'jpegquality', NGPropertyMapped::MultiplicityScalar, false, 75, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showcookiewarning', NGProperty::TypeBool, self::DomainSite, 'showcookiewarning', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cookiewarningtop', NGProperty::TypeBool, self::DomainSite, 'cookiewarningtop', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cookiewarning', NGProperty::TypeText, self::DomainSite, 'cookiewarning', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cookiemessage', NGProperty::TypeText, self::DomainSite, 'cookiemessage', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cookiewarningcolor', NGProperty::TypeString, self::DomainSite, 'cookiewarningcolor', NGPropertyMapped::MultiplicityScalar, false, '#ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('isshop', NGProperty::TypeBool, self::DomainSite, 'isshop', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('compress', NGProperty::TypeBool, self::DomainSite, 'compress', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('webp', NGProperty::TypeBool, self::DomainSite, 'webp', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('deferjs', NGProperty::TypeBool, self::DomainSite, 'deferjs', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdSite);
    }

    public function getIsShop()
    {
        return NGConfig::IsShop && $this->isshop;
    }

    /**
     *
     * Creates an instance
     *
     * @return NGSettingsSite
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            $adapter = new NGDBAdapterObject ();
            self::$instance = $adapter->loadSetting(NGSettingsSite::IdSite, NGSettingsSite::ObjectTypeSettingsSite);
        }
        return self::$instance;
    }
}