<?php

class NGPluginParagraphChat extends NGPluginParagraph
{
    const ObjectTypePluginParagraphChat = 'NGPluginParagraphChat';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphChat = 'paragraphchat';


    /**
     * @var NGTemplate
     */
    private $template;

    /**
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     * @var NGRichtext
     */
    private $richtext;

    /**
     * @var string foreground of own lines
     */
    public $foregroundmy = 'ffffff';

    /**
     * @var string foreground of other lines
     */
    public $foregroundothers = 'ffffff';

    /**
     * @var string background of my lines
     */
    public $backgroundmy = '4f81bd';

    /**
     * @var string background of other lines
     */
    public $backgroundothers = '9bbb59';

    /**
     * @var string realms that may write
     */
    public $realms = '';

    /**
     * @var string archive time
     */
    public $archivetime = 'OneDay';

    /**
     * @var int height of chat box
     */
    public $chatheight = 300;

    /**
     * @var bool show emojis
     */
    public $emojis = true;

    /**
     * @var bool show post date
     */
    public $postdate = false;

    /**
     * @var bool show privacy consent
     */
    public $privacyconsent = false;

    /**
     * @var string text of privacy consent
     */
    public $privacytext = '';

    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('foregroundmy', NGProperty::TypeString, self::DomainParagraphChat, 'foregroundmy', NGPropertyMapped::MultiplicityScalar, false, 'ffffff');
        $this->propertiesMapped [] = new NGPropertyMapped ('foregroundothers', NGProperty::TypeString, self::DomainParagraphChat, 'foregroundothers', NGPropertyMapped::MultiplicityScalar, false, 'ffffff');
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundmy', NGProperty::TypeString, self::DomainParagraphChat, 'backgroundmy', NGPropertyMapped::MultiplicityScalar, false, '4f81bd');
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundothers', NGProperty::TypeString, self::DomainParagraphChat, 'backgroundothers', NGPropertyMapped::MultiplicityScalar, false, '9bbb59');
        $this->propertiesMapped [] = new NGPropertyMapped ('realms', NGProperty::TypeText, self::DomainParagraphChat, 'realms', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('archivetime', NGProperty::TypeString, self::DomainParagraphChat, 'archivetime', NGPropertyMapped::MultiplicityScalar, false, 'OneDay');
        $this->propertiesMapped [] = new NGPropertyMapped ('chatheight', NGProperty::TypeInt, self::DomainParagraphChat, 'chatheight', NGPropertyMapped::MultiplicityScalar, false, 300);
        $this->propertiesMapped [] = new NGPropertyMapped ('emojis', NGProperty::TypeBool, self::DomainParagraphChat, 'emojis', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('postdate', NGProperty::TypeBool, self::DomainParagraphChat, 'postdate', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacyconsent', NGProperty::TypeBool, self::DomainParagraphChat, 'privacyconsent', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('privacytext', NGProperty::TypeText, self::DomainParagraphChat, 'privacytext', NGPropertyMapped::MultiplicityScalar, true, '');
    }

    /**
     *
     * render the plugin
     *
     * @throws NGException
     */
    public function render()
    {
        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphchat/language/langchat.xml';
        $this->lang->load();

        $this->richtext = new NGRichText();
        $this->richtext->previewMode = $this->previewMode;

        $this->template = new NGTemplate();

        $this->template->assign('rest', $this->prependPluginsPath('ngpluginparagraphchat/rest/'));
        $this->template->assign('uid', $this->objectUID);
        $this->template->assign('lang', $this->lang);
        $this->template->assign('emojis', $this->emojis);
        $this->template->assign('postdate', NGUtil::boolToStringXML($this->postdate));
        $this->template->assign('foregroundmy', $this->foregroundmy);
        $this->template->assign('foregroundothers', $this->foregroundothers);
        $this->template->assign('backgroundmy', $this->backgroundmy);
        $this->template->assign('backgroundothers', $this->backgroundothers);
        $this->template->assign('height', $this->chatheight);
        $this->template->assign('filemy', $this->prependPluginsPath(sprintf('ngpluginparagraphchat/img/?f=my&c=%s', $this->backgroundmy)));
        $this->template->assign('fileothers', $this->prependPluginsPath(sprintf('ngpluginparagraphchat/img/?f=others&c=%s', $this->backgroundothers)));

        if ($this->privacyconsent) $this->template->assign('privacytext', $this->richtext->parse($this->privacytext));

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphchat/tpl/template.tpl');

        $this->styleSheets ['NGPluginParagraphChat'] = $this->prependPluginsPath('ngpluginparagraphchat/css/');
        $this->javaScripts ['NGPluginParagraphChat'] = $this->prependPluginsPath('ngpluginparagraphchat/js/chat.js');
        $this->styles ['NGPluginParagraphChat' . $this->objectUID] = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphchat/tpl/localstyle.tpl');
    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphChatConversation extends NGObjectMapped
{
    const DomainChat = 'paragraphchatconversation';
    const ObjectTypePluginParagraphChatConversation = 'NGPluginParagraphChatConversation';

    public $items = '';


    protected function getPropertiesMapped()
    {
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainChat, 'items', NGPropertyMapped::MultiplicityScalar, true, '', false);
    }

    public function __construct()
    {
        parent::__construct();
        $this->class = NGPluginParagraph::ObjectTypePluginParagraph;
    }
}