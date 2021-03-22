<?php

class NGPluginParagraphLogin extends NGPluginParagraph
{
    const ObjectTypePluginParagraphLogin = 'NGPluginParagraphLogin';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphLogin = 'paragraphlogin';

    const FieldLogin = 'nglogin';
    const FieldPassword = 'ngpassword';
    const FieldNewPassword = 'ngnewpassword';
    const FieldPasswordRepeat = 'ngpasswordrepeat';
    const FieldLoginAction = 'ngloginaction';
    const FieldTargetUID = 'ngtargetuid';

    const ActionLogin = 'login';
    const ActionForgotPassword = 'forgotpassword';
    const ActionCreateAccount = 'createaccount';
    const ActionChangePassword = 'changepassword';

    const DefaultEmailSubject = 'Ihr Kennwort';
    const DefaultEmailText = 'Sehr geehrter Nutzer. <br/><br/>Ihr Kennwort für unsere Site lautet [p].<br/><br/>Verwenden Sie es zusammen mit Ihrer E-Mail-Adresse, um sich anzumelden.';

    const DefaultAlertSubject = 'Neue Nutzeranmeldung';
    const DefaultAlertText = 'Der neue Nutzer [u] hat sich angemeldet, wurde aber noch nicht freigeschaltet. Öffnen Sie die Funktion "Zugriffsschutz" in Pro Web und setzen Sie seinen Status auf "Aktiv", um ihm Zugriff zu gewähren.';

    public $forgotpassword = true;
    public $changepassword = true;
    public $createaccount = false;
    public $createaccountpending = true;
    public $sendpassword = false;
    public $realmmemberships = array();

    public $emailsubject = self::DefaultEmailSubject;
    public $emailtext = self::DefaultEmailText;

    public $emailsenderaddress = '';
    public $emailsendername = '';

    public $alertsubject = self::DefaultAlertSubject;
    public $alerttext = self::DefaultAlertText;

    public $alertsenderaddress = '';
    public $alertrecipientaddress = '';
    public $alertsendername = '';


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
     * Language resources
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     *
     * Template engine
     * @var NGTemplate
     */
    private $template;

    /**
     *
     * Settings of typography
     * @var NGPluginTypographySettings
     */
    private $settingsTypography;

    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('forgotpassword', NGProperty::TypeBool, self::DomainParagraphLogin, 'forgotpassword', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('changepassword', NGProperty::TypeBool, self::DomainParagraphLogin, 'changepassword', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('createaccount', NGProperty::TypeBool, self::DomainParagraphLogin, 'createaccount', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('createaccountpending', NGProperty::TypeBool, self::DomainParagraphLogin, 'createaccountpending', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sendpassword', NGProperty::TypeBool, self::DomainParagraphLogin, 'sendpassword', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('realmmemberships', NGProperty::TypeDateTime, self::DomainParagraphLogin, 'realmmemberships', NGPropertyMapped::MultiplicityDictornary);
        $this->propertiesMapped [] = new NGPropertyMapped ('emailsubject', NGProperty::TypeString, self::DomainParagraphLogin, 'emailsubject', NGPropertyMapped::MultiplicityScalar, true, self::DefaultEmailSubject, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('emailtext', NGProperty::TypeFulltext, self::DomainParagraphLogin, 'emailtext', NGPropertyMapped::MultiplicityScalar, true, self::DefaultEmailText, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('emailsenderaddress', NGProperty::TypeString, self::DomainParagraphLogin, 'emailsenderaddress', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('emailsendername', NGProperty::TypeString, self::DomainParagraphLogin, 'emailsendername', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacytext', NGProperty::TypeFulltext, self::DomainParagraphLogin, 'privacytext', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacyconsent', NGProperty::TypeBool, self::DomainParagraphLogin, 'privacyconsent', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alertsubject', NGProperty::TypeString, self::DomainParagraphLogin, 'alertsubject', NGPropertyMapped::MultiplicityScalar, true, self::DefaultAlertSubject, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alerttext', NGProperty::TypeFulltext, self::DomainParagraphLogin, 'alerttext', NGPropertyMapped::MultiplicityScalar, true, self::DefaultAlertText, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alertsenderaddress', NGProperty::TypeString, self::DomainParagraphLogin, 'alertsenderaddress', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alertrecipientaddress', NGProperty::TypeString, self::DomainParagraphLogin, 'alertrecipientaddress', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alertsendername', NGProperty::TypeString, self::DomainParagraphLogin, 'alertsendername', NGPropertyMapped::MultiplicityScalar, true, '', false);


    }

    /**
     * (non-PHPdoc)
     * @see NGPluginParagraph::render()
     */
    public function render()
    {

        $richtext = new NGRichText();
        $richtext->previewMode = $this->previewMode;

        $this->dontCache = true;

        NGUtil::startSession();

        $this->template = new NGTemplate ();

        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphlogin/language/langlogin.xml';
        $this->lang->load();

        $adapterTypography = new NGDBAdapterObject ();
        $this->settingsTypography = $adapterTypography->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);

        $this->template->assign('lang', $this->lang->languageResources);
        $this->template->assign('forgotpassword', $this->forgotpassword);
        $this->template->assign('forgotpasswordlink', $this->getQuery(array(self::FieldLoginAction => self::ActionForgotPassword)));
        $this->template->assign('changepassword', $this->changepassword);
        $this->template->assign('changepasswordlink', $this->getQuery(array(self::FieldLoginAction => self::ActionChangePassword)));
        $this->template->assign('createaccount', $this->createaccount);
        $this->template->assign('createaccountlink', $this->getQuery(array(self::FieldLoginAction => self::ActionCreateAccount)));
        $this->template->assign('backtologinlink', $this->getQuery(array(self::FieldLoginAction => self::ActionLogin)));

        if ($this->privacyconsent) $this->template->assign('privacytext', $richtext->parse($this->privacytext));

        $this->styleSheets = Array('NGPluginParagraphLogin' => $this->prependPluginsPath('ngpluginparagraphlogin/css/'));

        switch (NGUtil::get('ngloginaction', '')) {
            case self::ActionForgotPassword :
                $this->handleForgotPassword();
                break;
            case self::ActionChangePassword :
                $this->handleChangePassword();
                break;
            case self::ActionCreateAccount :
                $this->handleCreateAccount();
                break;
            default :
                $this->handleLogin();
                break;
        }
    }

    /**
     *
     * The user forgot his password
     */
    private function handleForgotPassword()
    {
        $login = NGUtil::post(self::FieldLogin, '');
        $this->template->assign(self::FieldLogin, $login);

        $newPassword = $this->randomPassword();

        $forgotSuccess = '';

        if ($login !== '') {
            $forgotSuccess = $this->lang->languageResources ['forgotpasswordsuccess']->value;

            $ngaccess = new NGAccess ();
            $ngaccess->previewMode = $this->previewMode;

            $account = $ngaccess->checkUser($login);

            if ($account !== null) {
                $account->password = md5($newPassword . NGAccess::Salt);
                $adapter = new NGDBAdapterObject ();
                $adapter->saveObject($account);
                $this->sendMail($login, $newPassword);
            }
        }

        $this->template->assign('forgotsuccess', $forgotSuccess);
        $this->template->assign('action', $this->getQuery(array('ngloginaction' => self::ActionForgotPassword)));
        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/forgotpassword.tpl');

    }

    /**
     *
     * Create a new account
     */
    private function handleCreateAccount()
    {
        $login = NGUtil::post(self::FieldLogin, '');
        $password = NGUtil::post(self::FieldPassword, '');
        $passwordrepeat = NGUtil::post(self::FieldPasswordRepeat, '');
        $privacymustconsent = NGUtil::post('privacymustconsent', '');
        $privacyconsent = NGUtil::post('privacyconsent', '');


        if ($this->sendpassword) {
            $password = $this->randomPassword();
            $passwordrepeat = $password;
        }

        $createSuccess = '';
        $createError = '';

        if ($login !== '' && $password != '') {

            if ($privacymustconsent === 'privacymustconsent' && $privacyconsent !== 'privacyconsent') {
                $createError = $this->lang->languageResources ['mustconsent']->value;
            } else {
                if (!NGUtil::checkEmail($login)) {
                    $createError = str_ireplace('[e]', $login, $this->lang->languageResources ['illegalemail']->value);
                } else {

                    if ($password !== $passwordrepeat) {
                        $createError = $this->lang->languageResources ['passwordmismatch']->value;
                    } else {

                        try {
                            /* @var $account NGAccount */
                            $account = new NGAccount ();

                            $account->name = $login;
                            $account->password = md5($password . NGAccess::Salt);
                            $account->loginstate = ($this->createaccountpending) ? NGAccount::LoginStatePending : NGAccount::LoginStateActive;
                            $account->realmmemberships = $this->realmmemberships;

                            $adapter = new NGDBAdapterObject ();
                            $adapter->saveObject($account);

                            if ($this->createaccountpending && $this->alertrecipientaddress !== '') {
                                $this->sendAlert($login);
                            }

                            if ($this->sendpassword) {
                                $this->sendMail($login, $password);
                                $createSuccess = $this->lang->languageResources ['createsuccesssend']->value;

                            } else {
                                $createSuccess = $this->lang->languageResources ['createsuccess']->value;
                            }
                        } catch (NGDuplicateValueException $ex) {
                            $createError = str_ireplace('[e]', $login, $this->lang->languageResources ['duplicateemail']->value);
                        }
                    }
                }
            }
        }

        $this->template->assign(self::FieldLogin, $login);
        $this->template->assign('sendpassword', $this->sendpassword);
        $this->template->assign('createsuccess', $createSuccess);
        $this->template->assign('createerror', $createError);
        $this->template->assign('action', $this->getQuery(array('ngloginaction' => self::ActionCreateAccount)));

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/createaccount.tpl');

    }

    /**
     *
     * Send password mail
     * @param string $login
     * @param string $password
     */
    private function sendMail($login, $password)
    {
        $mailTemplate = new NGTemplate ();
        $mailTemplate->assign('content', str_ireplace('[p]', '<strong>' . $password . '</strong>', $this->emailtext));

        $mail = new NGMail ();
        $mail->fromMail = $this->emailsenderaddress;
        $mail->fromName = $this->emailsendername;
        $mail->sendTo = $login;
        $mail->subject = $this->emailsubject;
        $mail->html = $mailTemplate->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/mail.tpl');

        $mail->send();
    }

    /**
     *
     * Send new user alert
     * @param string $login
     * @param string $password
     */
    private function sendAlert($login)
    {
        $mailTemplate = new NGTemplate ();
        $mailTemplate->assign('content', str_ireplace('[u]', '<strong>' . $login . '</strong>', $this->alerttext));

        $mail = new NGMail ();
        $mail->fromMail = $this->alertsenderaddress;
        $mail->fromName = $this->alertsendername;
        $mail->sendTo = $this->alertrecipientaddress;
        $mail->subject = $this->alertsubject;
        $mail->html = $mailTemplate->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/mail.tpl');

        $mail->send();
    }

    /**
     *
     * Change the password
     */
    private function handleChangePassword()
    {
        $login = NGUtil::post(self::FieldLogin, '');
        $password = NGUtil::post(self::FieldPassword, '');
        $newPassword = NGUtil::post(self::FieldNewPassword, '');
        $passwordRepeat = NGUtil::post(self::FieldPasswordRepeat, '');

        $changeSuccess = '';
        $changeError = '';

        if ($login !== '' && $password !== '' && $newPassword !== '' && $passwordRepeat !== '') {

            if (!NGUtil::checkEmail($login)) {
                $changeError = str_ireplace('[e]', $login, $this->lang->languageResources ['illegalemail']->value);
            } else {
                if ($newPassword !== $passwordRepeat) {
                    $changeError = $this->lang->languageResources ['passwordmismatch']->value;
                } else {
                    $ngaccess = new NGAccess ();
                    $ngaccess->previewMode = $this->previewMode;

                    $account = $ngaccess->checkUser($login, $password);

                    if ($account === null) {
                        $changeError = $this->lang->languageResources ['loginerror']->value;
                    } else {
                        $account->password = md5($newPassword . NGAccess::Salt);

                        $adapter = new NGDBAdapterObject ();
                        $adapter->saveObject($account);
                        $changeSuccess = $this->lang->languageResources ['changesuccess']->value;
                    }
                }
            }
        }

        $this->template->assign(self::FieldLogin, $login);

        $this->template->assign('action', $this->getQuery(array('ngloginaction' => self::ActionChangePassword)));

        $this->template->assign('changesuccess', $changeSuccess);
        $this->template->assign('changeerror', $changeError);

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/changepassword.tpl');
    }

    /**
     *
     * Perform login
     */
    private function handleLogin()
    {
        $login = NGUtil::post(self::FieldLogin, '');
        $password = NGUtil::post(self::FieldPassword, '');

        $loginerror = false;
        $loginsuccess = false;

        if ($login !== '' && $password != '') {
            $ngaccess = new NGAccess ();
            $ngaccess->previewMode = $this->previewMode;

            if ($ngaccess->authenticateUser($login, $password)) {
                $loginsuccess = true;
                if (NGUtil::get(self::FieldTargetUID, '') !== '') {
                    $link = new NGLink ();
                    $link->previewMode = $this->previewMode;
                    $link->uid = NGUtil::get(self::FieldTargetUID, '');
                    $link->linkType = NGLink::LinkPage;

                    if ($this->currentPage->sslmode != NGPluginPage::SSLModeKeep && NGConfig::SSLURL !== '') {
                        $link->absolute = true;
                        $setssl = NGUtil::prependRootPath('classes/util/setssl/');
                        $url = $link->getURL();
                        $url = substr($url, strlen(NGConfig::RootURL));
                        NGUtil::Forward($setssl . '?ngproto=http&ngurl=' . urlencode($url), $this->previewMode);
                    } else {
                        NGUtil::Forward($link->getURL(), $this->previewMode);
                    }

                    exit ();
                }
            } else {
                $loginerror = true;
            }
        }

        $this->template->assign('loginerror', $loginerror);
        $this->template->assign('loginsuccess', $loginsuccess);
        $this->template->assign(self::FieldLogin, $login);
        $this->template->assign('action', $this->getQuery(array(self::FieldLoginAction => self::ActionLogin)));

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphlogin/tpl/login.tpl');
    }

    /**
     *
     * Get a http query string
     * @param array $parameters
     */
    private function getQuery($parameters = array())
    {
        $get = array_merge($_GET, $parameters);

        $query = '';

        foreach ($get as $id => $value) {
            if ($id !== 'ngq') {
                $query .= ($query === '') ? '?' : '&';
                $query .= $id . '=' . urlencode($value);
            }
        }

        return $query;
    }

    /**
     *
     * Generate a random password
     */
    private function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass [] = $alphabet [$n];
        }
        return implode($pass);
    }
}