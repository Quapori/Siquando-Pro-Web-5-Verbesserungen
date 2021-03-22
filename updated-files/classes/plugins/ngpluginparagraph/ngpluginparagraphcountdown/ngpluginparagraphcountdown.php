<?php

class NGPluginParagraphCountdown extends NGPluginParagraph
{
    const ObjectTypePluginParagraphCountdown = 'NGPluginParagraphCountdown';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphCountdown = 'paragraphcountdown';

    public $targettime = '2018-01-01T00:00:00+00:00';
    public $colorface = 'dcdcdc';
    public $colorbackground = '3c3c3c';
    public $colorgap = '000000';
    public $colorcaption = '';
    public $fontsize = 50;
    public $fontsizemobile = -1;
    public $shadowface = 25;
    public $shadowbackground = 25;
    public $borderradius = 10;
    public $fontclassical = false;
    public $daydigits = 3;
    public $reload = false;
    public $animationspeed = 'medium';


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('targettime', NGProperty::TypeDateTime, self::DomainParagraphCountdown, 'targettime', NGPropertyMapped::MultiplicityScalar, false, '2018-01-01T00:00:00+00:00');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorface', NGProperty::TypeString, self::DomainParagraphCountdown, 'colorface', NGPropertyMapped::MultiplicityScalar, false, 'dcdcdc');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorbackground', NGProperty::TypeString, self::DomainParagraphCountdown, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '3c3c3c');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorgap', NGProperty::TypeString, self::DomainParagraphCountdown, 'colorgap', NGPropertyMapped::MultiplicityScalar, false, '000000');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorcaption', NGProperty::TypeString, self::DomainParagraphCountdown, 'colorcaption', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('fontsize', NGProperty::TypeInt, self::DomainParagraphCountdown, 'fontsize', NGPropertyMapped::MultiplicityScalar, false, 50);
        $this->propertiesMapped [] = new NGPropertyMapped ('fontsizemobile', NGProperty::TypeInt, self::DomainParagraphCountdown, 'fontsizemobile', NGPropertyMapped::MultiplicityScalar, false, -1);
        $this->propertiesMapped [] = new NGPropertyMapped ('shadowface', NGProperty::TypeInt, self::DomainParagraphCountdown, 'shadowface', NGPropertyMapped::MultiplicityScalar, false, 25);
        $this->propertiesMapped [] = new NGPropertyMapped ('shadowbackground', NGProperty::TypeInt, self::DomainParagraphCountdown, 'shadowbackground', NGPropertyMapped::MultiplicityScalar, false, 25);
        $this->propertiesMapped [] = new NGPropertyMapped ('borderradius', NGProperty::TypeInt, self::DomainParagraphCountdown, 'borderradius', NGPropertyMapped::MultiplicityScalar, false, 10);
        $this->propertiesMapped [] = new NGPropertyMapped ('fontclassical', NGProperty::TypeBool, self::DomainParagraphCountdown, 'fontclassical', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('daydigits', NGProperty::TypeInt, self::DomainParagraphCountdown, 'daydigits', NGPropertyMapped::MultiplicityScalar, false, 3);
        $this->propertiesMapped [] = new NGPropertyMapped ('reload', NGProperty::TypeBool, self::DomainParagraphCountdown, 'reload', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animationspeed', NGProperty::TypeString, self::DomainParagraphCountdown, 'animationspeed', NGPropertyMapped::MultiplicityScalar, false, 'medium');
    }

    public function render()
    {
        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphcountdown/language/langcountdown.xml';
        $this->lang->load();

        $template = new NGTemplate();

        $template->assign('targettime', $this->targettime);
        $template->assign('uid', $this->objectUID);
        $template->assign('colorface', $this->colorface);
        $template->assign('colorbackground', $this->colorbackground);
        $template->assign('colorgap', $this->colorgap);
        $template->assign('colorcaption', $this->colorcaption);
        $template->assign('fontsize', $this->fontsize);
        $template->assign('fontsizemobile', $this->fontsizemobile);
        $template->assign('shadowface', number_format($this->shadowface / 100, 3, '.', ''));
        $template->assign('shadowbackground', number_format($this->shadowbackground / 100, 2, '.', ''));
        $template->assign('borderradius', number_format($this->borderradius / 100, 2, '.', ''));
        $template->assign('fontclassical', $this->fontclassical);
        $template->assign('daydigits', $this->daydigits);
        $template->assign('animationspeed', strtolower($this->animationspeed));
        $template->assign('reload', NGUtil::boolToStringXML($this->reload));
        $template->assign('lang', $this->lang->languageResources);


        $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphcountdown/tpl/layout.tpl');

        $this->styleSheets ['NGPluginParagraphCountdown'] = $this->prependPluginsPath('ngpluginparagraphcountdown/css/style.css');
        $this->javaScripts ['NGPluginParagraphCountdown'] = $this->prependPluginsPath('ngpluginparagraphcountdown/js/countdown.js');
        $this->styles['CountDown' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphcountdown/tpl/style.tpl');

    }

    public function __construct()
    {
        parent::__construct();
    }

}