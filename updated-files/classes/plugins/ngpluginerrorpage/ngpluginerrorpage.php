<?php

class NGPluginErrorPage extends NGSetting
{
    const DomainErrorPage = 'errorpage';
    const ObjectClassPluginErrorPage = 'NGPluginErrorPage';
    const IdErrorPage = 'errpage';
    const ObjectTypePluginErrorPageSettings = 'NGPluginUnderConstSettings';
    const PlaceHolderCaption = "[[caption]]";
    const PlaceHolderSummary = "[[summary]]";

    public $picture = '';

    public $background = 'ffffff';

    public $captionfontfamily = 'Tahoma';
    public $captionfontsize = 36;
    public $captionfontcolor = '4682B4';
    public $captionbold = true;
    public $captionitalic = false;

    public $summaryfontfamily = 'Tahoma';
    public $summaryfontsize = 14;
    public $summaryfontcolor = '696969';
    public $summarybold = false;
    public $summaryitalic = false;

    public $linkfontfamily = 'Tahoma';
    public $linkfontsize = 14;
    public $linkfontcolor = 'ffffff';
    public $linkbold = true;
    public $linkitalic = false;

    public $linkpaddinghorizontal = 8;
    public $linkpaddingvertical = 8;
    public $linkroundedcorners = 6;
    public $backgroundlink = '4682b4';
    public $backgroundlinkhover = 'b0c4d5';

    public $captionnotfound = '';
    public $summarynotfound = '';

    public $captionforbidden = '';
    public $summaryforbidden = '';

    public $links = '';


    public static function render($code, $caption = '', $summary = '')
    {
        $cache = new NGPageCache ();
        $cache->objectUID = self::IdErrorPage . $code;
        $cache->stepsToRoot = NGSession::getInstance()->stepsToRoot;

        NGUtil::DefaultHTMLHeaders();

        if (!$cache->fetch()) {
            $adapter = new NGDBAdapterObject ();

            /* @var $settings NGPluginErrorPage */
            $settings = $adapter->loadSetting(NGPluginErrorPage::IdErrorPage, NGPluginErrorPage::ObjectTypePluginErrorPageSettings, NGPluginErrorPage::ObjectClassPluginErrorPage);

            $template = new NGTemplate ();

            $template->assign('settings', $settings);
            $template->assign('captionfontfamily', NGFontUtil::getInstance()->getFontStack($settings->captionfontfamily));
            $template->assign('summaryfontfamily', NGFontUtil::getInstance()->getFontStack($settings->summaryfontfamily));
            $template->assign('linkfontfamily', NGFontUtil::getInstance()->getFontStack($settings->linkfontfamily));
            $template->assign('fonts', NGFontUtil::getInstance()->styleSheets);
            $template->assign('fontspath', NGUtil::joinPaths(NGConfig::RootURL, 'classes/plugins/ngplugintypography/css/'));
            $template->assign('metatags', NGSettingsSite::getInstance()->metaTags);

            $pictureAdapter = new NGDBAdapterObject ();

            if ($settings->picture !== '') {

                /* @var $picture NGPicture */
                $picture = $pictureAdapter->loadObject($settings->picture, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                if ($picture != null) {
                    $size = $picture->getResizedSize(800, 640);

                    $template->assign('picturesource', NGLink::getPictureURL($picture->objectUID, $size->width, $size->height, NGPicture::RatioNone, true));
                    $template->assign('picturewidth', $size->width);
                    $template->assign('pictureheight', $size->height);
                }
            }

            if (NGSettingsSite::getInstance()->favicon !== '') {
                $template->assign('favicon', NGLink::getPictureURL(NGSettingsSite::getInstance()->favicon, 16, 16, NGPicture::Ratio1by1, true));
            }

            if (NGSettingsSite::getInstance()->touchicon !== '') {
                $touchicons = Array();
                $touchicons ['114x114'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 114, 114, NGPicture::Ratio1by1, true);
                $touchicons ['144x144'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 144, 144, NGPicture::Ratio1by1, true);
                $touchicons ['72x72'] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 72, 72, NGPicture::Ratio1by1, true);
                $touchicons [''] = NGLink::getPictureURL(NGSettingsSite::getInstance()->touchicon, 57, 57, NGPicture::Ratio1by1, true);
                $template->assign('touchicons', $touchicons);
                $template->assign('touchiconprecomposed', NGSettingsSite::getInstance()->touchiconprecomposed);
            }

            if ($code == 404) {
                $template->assign('caption', $settings->captionnotfound);
                $template->assign('summary', $settings->summarynotfound);
            } else if ($code == 403) {
                $template->assign('caption', $settings->captionforbidden);
                $template->assign('summary', $settings->summaryforbidden);
            } else {
                $template->assign('caption', self::PlaceHolderCaption);
                $template->assign('summary', self::PlaceHolderSummary);
            }

            if ($settings->links !== '') {
                $xml = new DOMDocument ('1.0', 'UTF-8');
                $xml->loadXML($settings->links);
                $links = array();
                $linkparser = new NGLink (false);
                $linkparser->absolute = true;

                foreach ($xml->documentElement->childNodes as $itemElement) {
                    /* @var $itemElement DOMElement */
                    if ($itemElement->nodeType == XML_ELEMENT_NODE) {
                        if ($itemElement->nodeName == 'link') {
                            $link = new NGPluginErrorPageLink();

                            foreach ($itemElement->childNodes as $node) {
                                /* @var $node DOMElement */
                                if ($node->nodeType == XML_ELEMENT_NODE) {
                                    switch ($node->nodeName) {
                                        case 'caption' :
                                            $link->caption = $node->nodeValue;
                                            break;
                                        case 'linkuid' :
                                            $linkparser->parseURL($node->nodeValue);
                                            $link->link = $linkparser->getURL();

                                            if ($linkparser->linkType !== NGLink::LinkWWW && $linkparser->linkType !== NGLink::LinkMailTo && $linkparser->linkType !== NGLink::LinkTel) {
                                                $link->link = preg_replace('/^.*?\/\/.*?\//', '/', $link->link);
                                            }

                                            break;
                                    }
                                }
                            }
                            $links [] = $link;
                        }
                    }
                }
                if (count($links) > 0) $template->assign('links', $links);
            }
            $output = $template->fetchPluginTemplate('ngpluginerrorpage/tpl/template.tpl');

            $cache->output = $output;
            $cache->store();
        }

        $output = $cache->output;
        $output = str_replace(self::PlaceHolderCaption, $caption, $output);
        $output = str_replace(self::PlaceHolderSummary, $summary, $output);

        echo($output);
    }

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('picture', NGProperty::TypeString, self::DomainErrorPage, 'picture', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('background', NGProperty::TypeString, self::DomainErrorPage, 'background', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontfamily', NGProperty::TypeString, self::DomainErrorPage, 'captionfontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Tahoma', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontsize', NGProperty::TypeInt, self::DomainErrorPage, 'captionfontsize', NGPropertyMapped::MultiplicityScalar, false, 36, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionfontcolor', NGProperty::TypeString, self::DomainErrorPage, 'captionfontcolor', NGPropertyMapped::MultiplicityScalar, false, '4682B4', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionbold', NGProperty::TypeBool, self::DomainErrorPage, 'captionbold', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionitalic', NGProperty::TypeBool, self::DomainErrorPage, 'captionitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontfamily', NGProperty::TypeString, self::DomainErrorPage, 'summaryfontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Tahoma', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontsize', NGProperty::TypeInt, self::DomainErrorPage, 'summaryfontsize', NGPropertyMapped::MultiplicityScalar, false, 13, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryfontcolor', NGProperty::TypeString, self::DomainErrorPage, 'summaryfontcolor', NGPropertyMapped::MultiplicityScalar, false, '696969', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summarybold', NGProperty::TypeBool, self::DomainErrorPage, 'summarybold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryitalic', NGProperty::TypeBool, self::DomainErrorPage, 'summaryitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkfontfamily', NGProperty::TypeString, self::DomainErrorPage, 'linkfontfamily', NGPropertyMapped::MultiplicityScalar, false, 'Tahoma', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkfontsize', NGProperty::TypeInt, self::DomainErrorPage, 'linkfontsize', NGPropertyMapped::MultiplicityScalar, false, 13, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkfontcolor', NGProperty::TypeString, self::DomainErrorPage, 'linkfontcolor', NGPropertyMapped::MultiplicityScalar, false, '696969', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkbold', NGProperty::TypeBool, self::DomainErrorPage, 'linkbold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkitalic', NGProperty::TypeBool, self::DomainErrorPage, 'linkitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundlink', NGProperty::TypeString, self::DomainErrorPage, 'backgroundlink', NGPropertyMapped::MultiplicityScalar, false, '4682b4', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundlinkhover', NGProperty::TypeString, self::DomainErrorPage, 'backgroundlinkhover', NGPropertyMapped::MultiplicityScalar, false, 'b0c4d5', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkpaddinghorizontal', NGProperty::TypeInt, self::DomainErrorPage, 'linkpaddinghorizontal', NGPropertyMapped::MultiplicityScalar, false, 8, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkpaddingvertical', NGProperty::TypeInt, self::DomainErrorPage, 'linkpaddingvertical', NGPropertyMapped::MultiplicityScalar, false, 8, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('linkroundedcorners', NGProperty::TypeInt, self::DomainErrorPage, 'linkroundedcorners', NGPropertyMapped::MultiplicityScalar, false, 6, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionnotfound', NGProperty::TypeText, self::DomainErrorPage, 'captionnotfound', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summarynotfound', NGProperty::TypeText, self::DomainErrorPage, 'summarynotfound', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionforbidden', NGProperty::TypeText, self::DomainErrorPage, 'captionforbidden', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('summaryforbidden', NGProperty::TypeText, self::DomainErrorPage, 'summaryforbidden', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('links', NGProperty::TypeText, self::DomainErrorPage, 'links', NGPropertyMapped::MultiplicityScalar, true, '', false);

    }

    public function __construct()
    {
        parent::__construct();

        $lang = parse_ini_file(dirname(__FILE__) . '/ngpluginerrorpage.lang');

        $this->captionnotfound = $lang['captionnotfound'];
        $this->summarynotfound = $lang['summarynotfound'];
        $this->captionforbidden = $lang['captionforbidden'];
        $this->summaryforbidden = $lang['summaryforbidden'];

        $this->setId(self::IdErrorPage);
    }
}

class NGPluginErrorPageLink
{
    public $caption = '';
    public $link = '';
}