<?php

class NGPluginParagraphPictures extends NGPluginParagraph
{
    const ObjectTypePluginParagraphPictures = 'NGPluginParagraphPictures';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphPictures = 'paragraphpictures';

    public $items = '';

    public $picturemargin = 0;

    public $picturepadding = 15;

    public $pictureratio = 'Ratio1by1';

    public $captionuppercase = true;

    public $captionbold = false;

    public $captionitalic = false;

    public $captionwide = true;

    public $captionshadow = true;

    public $captionsize = 2;

    public $animate = true;

    public $panorama = false;


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphPictures, 'items', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('picturemargin', NGProperty::TypeInt, self::DomainParagraphPictures, 'picturemargin', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('picturepadding', NGProperty::TypeInt, self::DomainParagraphPictures, 'picturepadding', NGPropertyMapped::MultiplicityScalar, false, 15, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureratio', NGProperty::TypeString, self::DomainParagraphPictures, 'pictureratio', NGPropertyMapped::MultiplicityScalar, false, 'Ratio1By1', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionuppercase', NGProperty::TypeBool, self::DomainParagraphPictures, 'captionuppercase', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionbold', NGProperty::TypeBool, self::DomainParagraphPictures, 'captionbold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionitalic', NGProperty::TypeBool, self::DomainParagraphPictures, 'captionitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionwide', NGProperty::TypeBool, self::DomainParagraphPictures, 'captionwide', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionshadow', NGProperty::TypeBool, self::DomainParagraphPictures, 'captionshadow', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsize', NGProperty::TypeInt, self::DomainParagraphPictures, 'captionsize', NGPropertyMapped::MultiplicityScalar, false, 2, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animate', NGProperty::TypeBool, self::DomainParagraphPictures, 'animate', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('panorama', NGProperty::TypeBool, self::DomainParagraphPictures, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

    public function render()
    {

        if ($this->items !== '') {

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($this->items);

            $pictures = array();

            $controller = new NGDBAdapterObject ();

            foreach ($xml->documentElement->childNodes as $itemElement) {
                /* @var $itemElement DOMElement */
                if ($itemElement->nodeType == XML_ELEMENT_NODE) {
                    if ($itemElement->nodeName == 'item') {
                        $picture = new NGPluginParagraphPicturesPicture();

                        foreach ($itemElement->childNodes as $node) {
                            /* @var $node DOMElement */
                            if ($node->nodeType == XML_ELEMENT_NODE) {
                                switch ($node->nodeName) {
                                    case 'caption' :
                                        $picture->caption = $node->nodeValue;
                                        break;
                                    case 'pictureuid' :
                                        $picture->pictureuid = $node->nodeValue;
                                        break;
                                    case 'picturecolor' :
                                        $picture->picturecolor = $node->nodeValue;
                                        break;
                                    case 'pictureposition':
                                        $picture->pictureposition = $node->nodeValue;
                                        break;
                                    case 'link' :
                                        if ($node->nodeValue !== '') {
                                            $link = new NGLink ($this->previewMode);
                                            $link->parseURL($node->nodeValue);
                                            $picture->link = $link;
                                        }
                                }
                            }
                        }

                        $pictures [] = $picture;
                    }
                }
            }

            $cols = min(count($pictures), 5);

            if ($cols > 0) {

                $renderwidth = $this->renderWidth;
                if ($this->responsive && $this->allowAlwaysFullWidth && $this->panorama) $renderwidth = 1920;

                $width = floor($renderwidth / $cols);
                if ($width < 768) $width = 768;

                $pictureratio = NGPicture::stringToRatio($this->pictureratio);

                $height = floor($width / NGPicture::ratioByRatioType($pictureratio));

                foreach ($pictures as $picture) {
                    $pictureObject = $controller->loadObject($picture->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);
                    if ($picture != null) {
                        $picture->src = NGLink::getPictureURL($picture->pictureuid, $width, $width, $pictureratio);
                        $picture->alt = $pictureObject->alt;
                    }
                }


                $template = new NGTemplate ();


                $template->assign('pictures', $pictures);
                $template->assign('uid', $this->objectUID);
                $template->assign('cols', $cols);
                $template->assign('margin', $this->picturemargin);
                $template->assign('padding', $this->picturepadding);
                $template->assign('wide', $this->captionwide);
                $template->assign('bold', $this->captionbold);
                $template->assign('italic', $this->captionitalic);
                $template->assign('shadow', $this->captionshadow);
                $template->assign('uppercase', $this->captionuppercase);
                $template->assign('width', $width);
                $template->assign('height', $height);
                $template->assign('animate', $this->animate);
                $template->assign('ratio', strtolower($this->pictureratio));

                switch ($this->captionsize) {
                    case 1:
                        $template->assign('size', '90%');
                        break;
                    case 3:
                        $template->assign('size', '120%');
                        break;
                    default:
                        $template->assign('size', '100%');
                        break;
                }

                $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphpictures/tpl/template.tpl');
                $this->styleSheets ['NGPluginParagraphPictures'] = $this->prependPluginsPath('ngpluginparagraphpictures/css/style.css');
                $this->styles ['NGPluginParagraphPictures' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphpictures/tpl/stylelocal.tpl');
            }

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth && $this->panorama)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;

        }


    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphPicturesPicture
{
    public $caption = '';
    public $link = null;
    public $pictureuid = '';
    public $src = '';
    public $alt = '';
    public $picturecolor = 'ffffff';
    public $pictureposition = 'BottomRight';
}