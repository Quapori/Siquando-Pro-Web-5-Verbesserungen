<?php

class NGPluginUnderConstruction extends NGPluginUnderConstructionBase
{
    const DomainUnderConstruction = 'underconstruction';
    const ObjectClassPluginUnderConstruction = 'NGPluginUnderConstruction';

    public $picture = '';

    public $caption = '';
    public $captionfontfamily = 'Tahoma';
    public $captionfontsize = 36;
    public $captionfontcolor = '4682B4';
    public $captionbold = true;
    public $captionitalic = false;

    public $summary = '';
    public $summaryfontfamily = 'Tahoma';
    public $summaryfontsize = 14;
    public $summaryfontcolor = '696969';
    public $summarybold = false;
    public $summaryitalic = false;

    public static function render()
    {
        $cache = new NGPageCache ();
        $cache->objectUID = self::ObjectClassPluginUnderConstruction;
        $cache->stepsToRoot = NGSession::getInstance ()->stepsToRoot;

        NGUtil::DefaultHTMLHeaders();

        if ($cache->fetch()) {
            echo($cache->output);
        } else {
            $adapter = new NGDBAdapterObject ();

            /* @var $settings NGPluginUnderConstructionSettings */
            $settings = $adapter->loadSetting(NGPluginUnderConstructionBase::IdUnderConstruction, NGPluginUnderConstruction::ObjectTypePluginUnderConstructionSettings, NGPluginUnderConstruction::ObjectClassPluginUnderConstruction);

            $template = new NGTemplate ();

            $template->assign('settings', $settings);
            $template->assign('captionfontfamily', NGFontUtil::getInstance()->getFontStack($settings->captionfontfamily));
            $template->assign('summaryfontfamily', NGFontUtil::getInstance()->getFontStack($settings->summaryfontfamily));
            $template->assign('fonts', NGFontUtil::getInstance()->styleSheets);
            $template->assign('fontspath', NGUtil::prependRootPath('classes/plugins/ngplugintypography/css/'));
            $template->assign('metatags', NGSettingsSite::getInstance()->metaTags);

            $pictureAdapter = new NGDBAdapterObject ();

            if ($settings->picture !== '') {

                /* @var $picture NGPicture */
                $picture = $pictureAdapter->loadObject($settings->picture, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                if ($picture != null) {
                    $size = $picture->getResizedSize(800, 640);

                    $template->assign('picturesource', NGLink::getPictureURL($picture->objectUID, $size->width, $size->height));
                    $template->assign('picturewidth', $size->width);
                    $template->assign('pictureheight', $size->height);
                }
            }

            if (NGSettingsSite::getInstance()->favicon !== '') {
                $template->assign('favicon', NGLink::getPictureURL(NGSettingsSite::getInstance()->favicon, 16, 16, NGPicture::Ratio1by1));
            }
            if (NGSettingsSite::getInstance()->touchicon !== '') {
                $touchicons = Array();
                $touchicons ['114x114'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 114, 114, NGPicture::Ratio1by1);
                $touchicons ['144x144'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 144, 144, NGPicture::Ratio1by1);
                $touchicons ['72x72'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 72, 72, NGPicture::Ratio1by1);
                $touchicons [''] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 57, 57, NGPicture::Ratio1by1);
                $template->assign('touchicons', $touchicons);
                $template->assign('touchiconprecomposed', NGSettingsSite::getInstance()->touchiconprecomposed);
            }

            $output=$template->fetchPluginTemplate('ngpluginunderconstruction/tpl/template.tpl');
            $cache->output = $output;
            $cache->store ();
            echo($output);
        }

    }


    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('picture', NGProperty::TypeString, self::DomainUnderConstruction, 'picture', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('background', NGProperty::TypeString, self::DomainUnderConstruction, 'background', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('caption', NGProperty::TypeText, self::DomainUnderConstruction, 'caption', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontfamily', NGProperty::TypeString, self::DomainUnderConstruction, 'captionfontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Tahoma', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontsize', NGProperty::TypeInt, self::DomainUnderConstruction, 'captionfontsize', NGPropertyMapped::MultiplicityScalar, false, 36, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontcolor', NGProperty::TypeString, self::DomainUnderConstruction, 'captionfontcolor', NGPropertyMapped::MultiplicityScalar, false, '4682B4', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionbold', NGProperty::TypeBool, self::DomainUnderConstruction, 'captionbold', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionitalic', NGProperty::TypeBool, self::DomainUnderConstruction, 'captionitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summary', NGProperty::TypeText, self::DomainUnderConstruction, 'summary', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontfamily', NGProperty::TypeString, self::DomainUnderConstruction, 'summaryfontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Tahoma', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontsize', NGProperty::TypeInt, self::DomainUnderConstruction, 'summaryfontsize', NGPropertyMapped::MultiplicityScalar, false, 13, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontcolor', NGProperty::TypeString, self::DomainUnderConstruction, 'summaryfontcolor', NGPropertyMapped::MultiplicityScalar, false, '696969', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summarybold', NGProperty::TypeBool, self::DomainUnderConstruction, 'summarybold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryitalic', NGProperty::TypeBool, self::DomainUnderConstruction, 'summaryitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

    public function __construct()
    {
        parent::__construct();
    }
}