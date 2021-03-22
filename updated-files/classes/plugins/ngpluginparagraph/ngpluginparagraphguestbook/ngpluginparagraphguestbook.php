<?php

class NGPluginParagraphGuestbook extends NGPluginParagraph
{
    const ObjectTypePluginParagraphGuestbook = 'NGPluginParagraphGuestbook';
    const Product = 'SIQUANDO Pro 5';

    const DomainParagraphGuestbook = 'paragraphguestbook';

    const PrefixData = 'w002';

    /**
     *
     * Aks for email
     * @var boolean
     */
    public $email = false;

    /**
     *
     * Ask for location
     * @var boolean
     */
    public $location = false;

    /**
     *
     * Moderate guestbook
     * @var boolean
     */
    public $moderate = false;

    /**
     *
     * User global guestbook
     * @var boolean
     */
    public $isglobal = false;

    /**
     *
     * posts per page
     * @var int
     */
    public $postsperpage = 3;

    /**
     *
     * Show stars
     * @var bool
     */
    public $stars = false;

    /**
     *
     * Show stars result
     * @var bool
     */
    public $starsresult = false;

    /**
     *
     * Show stars result
     * @var bool
     */
    public $starsresultdetails = false;

    /**
     *
     * Guestbook is locked
     * @var bool
     */
    public $locked = false;

    /**
     *
     * Send mail
     * @var bool
     */
    public $mail = false;

    /**
     *
     * Send mail to
     * @var string
     */
    public $sendto = '';

    /**
     *
     * Send mail from
     * @var string
     */
    public $from = '';

    /**
     *
     * Send mail from
     * @var string
     */
    public $fromname = '';

    /**
     *
     * Mail subject
     * @var string
     */
    public $subject = '';

    /**
     * Privacy text
     * @var string
     */
    public $privacytext = '';

    /**
     * Ask for consent
     * @var bool
     */
    public $privacyconsent = false;

    /**
     *
     * Template render
     * @var NGTemplate
     */
    private $template;

    /**
     *
     * Language resources
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     *
     * Settings
     * @var NGGuestbookSettings
     */
    private $settings;

    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('email', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'email', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('moderate', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'moderate', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('isglobal', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'isglobal', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('postsperpage', NGProperty::TypeInt, self::DomainParagraphGuestbook, 'postsperpage', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('stars', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'stars', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('starsresult', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'starsresult', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('starsresultdetails', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'starsresultdetails', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('locked', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'locked', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('location', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'location', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('mail', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'mail', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sendto', NGProperty::TypeString, self::DomainParagraphGuestbook, 'sendto', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('from', NGProperty::TypeString, self::DomainParagraphGuestbook, 'from', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('fromname', NGProperty::TypeString, self::DomainParagraphGuestbook, 'fromname', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('subject', NGProperty::TypeString, self::DomainParagraphGuestbook, 'subject', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacytext', NGProperty::TypeFulltext, self::DomainParagraphGuestbook, 'privacytext', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacyconsent', NGProperty::TypeBool, self::DomainParagraphGuestbook, 'privacyconsent', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

    public function filterUID()
    {
        return $this->isglobal ? '' : $this->objectUID;
    }

    public function render()
    {
        $richtext = new NGRichText();
        $richtext->previewMode = $this->previewMode;

        $this->checkDataFolder();

        $this->template = new NGTemplate ();

        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphguestbook/language/langguestbook.xml';
        $this->lang->load();

        include_once NGConfig::pluginsPath() . '/ngpluginparagraph/ngpluginparagraphguestbook/settings/ngguestbooksettings.php';

        $adapter = new NGDBAdapterObject ();
        $this->settings = $adapter->loadSetting(NGGuestbookSettings::IdGuestbook, NGGuestbookSettings::ObjectTypeNGGuestbookSettings);

        $this->template->assign('lang', $this->lang);
        $this->template->assign('recaptchapublic', $this->settings->recaptchapublic);
        $this->template->assign('email', $this->email);
        $this->template->assign('location', $this->location);
        $this->template->assign('uid', $this->objectUID);
        $this->template->assign('postsperpage', $this->postsperpage);
        $this->template->assign('stars', $this->stars);
        $this->template->assign('locked', $this->locked);
        $this->template->assign('starsresult', $this->starsresult);
        $this->template->assign('starsresultdetails', $this->starsresultdetails);

        if ($this->privacyconsent) $this->template->assign('privacytext', $richtext->parse($this->privacytext));

        $this->template->assign('rest', $this->prependPluginsPath('ngpluginparagraphguestbook/rest/'));
        $this->template->assign('star', $this->prependPluginsPath(sprintf('ngpluginparagraphguestbook/img/star/?ca=%s&cb=%s&f=%s', $this->settings->colorstaractivestroke, $this->settings->colorstaractivefill, $this->settings->star)));

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphguestbook/tpl/template.tpl');
        $this->styleSheets ['NGPluginParagraphGuestbook'] = $this->prependPluginsPath('ngpluginparagraphguestbook/css/');
        $this->javaScripts ['NGPluginParagraphGuestbook'] = $this->prependPluginsPath('ngpluginparagraphguestbook/js/guestbook.js');

        if ($this->settings->recaptchapublic !== '') {
            $this->javaScripts ['grecaptcha'] = 'https://www.google.com/recaptcha/api.js';
        }

    }

    public static function uidDataFolder()
    {
        return NGUtil::idToUID(self::PrefixData, 'guestbook');
    }

    private function checkDataFolder()
    {
        $folderAdapter = new NGDBAdapterObject ();
        $dataFolder = $folderAdapter->loadObject($this->uidDataFolder(), NGFolder::ObjectTypeFolder, NGFolder::ObjectTypeFolder);

        if ($dataFolder === null) {
            $dataFolder = new NGFolder ();
            $dataFolder->objectUID = self::uidDataFolder();
            $dataFolder->parentUID = NGUtil::ObjectUIDRootSettings;
            $dataFolder->name = 'guestbookdata';
            $dataFolder->grants = array(NGObject::ActionView => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny, NGUtil::ObjectUIDUsersGroup => NGObject::AccessAny), NGObject::ActionAdd => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny, NGUtil::ObjectUIDUsersGroup => NGObject::AccessAny), NGObject::ActionModify => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny, NGUtil::ObjectUIDUsersGroup => NGObject::AccessAny), NGObject::ActionDelete => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny, NGUtil::ObjectUIDUsersGroup => NGObject::AccessAny), NGObject::ActionAdmin => array(NGUtil::ObjectUIDAdminGroup => NGObject::AccessAny));

            $folderAdapter->saveObject($dataFolder, '', false, true, true, false, false, true);
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}