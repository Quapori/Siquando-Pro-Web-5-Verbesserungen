<?php

class NGPluginParagraphEndlessSlider extends NGPluginParagraph
{
    const ObjectTypePluginParagraphEndlessSlider = 'NGPluginParagraphEndlessSlider';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphEndlessSlider = "paragraphendlessslider";

    /**
     *
     * Sortmode for bouquet
     *
     * @var string
     */
    public $sortMode = '';

    /**
     *
     * Source for bouquet
     *
     * @var string
     */
    public $itemsSource = '';

    /**
     *
     * Found items
     *
     * @var string
     */
    public $items;

    /**
     *
     * Parent UID
     *
     * @var string
     */
    public $itemsParentUID = '';

    /**
     *
     * Panoramic display
     *
     * @var bool
     */
    public $panorama = false;

    /**
     * @var int
     */
    public $autochange = 10;

    /**
     * @var int
     */
    public $sliderheight = 80;

    /**
     * @var bool
     */
    public $captionsupper = true;

    /**
     * @var bool
     */
    public $captionsbold = false;

    /**
     * @var bool
     */
    public $captionsitalic = false;

    /**
     * @var bool
     */
    public $captionswide = true;

    /**
     * @var bool
     */
    public $captionsshadow = true;

    /**
     * @var int
     */
    public $captionssize = 5;

    /**
     * @var string
     */
    public $captionscolor = 'ffffff';

    /**
     * @var string
     */
    public $bulletcolora='000000';

    /**
     * @var string
     */
    public $bulletcolorb='a9a9a9';

    /**
     * @var string
     */
    public $bulletstyle='default';


    /**
     *
     * @var array
     */
    private $pictures = array();

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphEndlessSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphEndlessSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphEndlessSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphEndlessSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('panorama', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false);

        $this->propertiesMapped [] = new NGPropertyMapped ('autochange', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'autochange', NGPropertyMapped::MultiplicityScalar, false, 10, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sliderheight', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'sliderheight', NGPropertyMapped::MultiplicityScalar, false, 80, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsupper', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'captionsupper', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsbold', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'captionsbold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsitalic', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'captionsitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionswide', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'captionswide', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsshadow', NGProperty::TypeBool, self::DomainParagraphEndlessSlider, 'captionsshadow', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionssize', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'captionssize', NGPropertyMapped::MultiplicityScalar, false, 5, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionscolor', NGProperty::TypeString, self::DomainParagraphEndlessSlider, 'captionscolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletcolora', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'bulletcolora', NGPropertyMapped::MultiplicityScalar, false, '000000', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletcolorb', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'bulletcolorb', NGPropertyMapped::MultiplicityScalar, false, 'a9a9a9', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletstyle', NGProperty::TypeInt, self::DomainParagraphEndlessSlider, 'bulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
    }

    public function render()
    {
        $width = $this->renderWidth;

        if ($this->panorama && $this->responsive)
            $width = 1920;

        $this->bouquet = new NGBouquet ();
        $this->bouquet->itemSource = $this->itemsSource;
        $this->bouquet->sortMode = $this->sortMode;
        $this->bouquet->itemsXML = $this->items;
        $this->bouquet->parentUID = $this->itemsParentUID;
        $this->bouquet->maxItemCount = 15;
        $this->bouquet->previewMode = $this->previewMode;

        $this->bouquet->prepare();

        $this->pictures = Array();

        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */
            $picture = new NGPluginParagraphEndlessSliderItem ();
            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, $width, NGPicture::RatioNone);
            $picture->size = $item->displayPicture()->getResizedSize($width, $width, NGPicture::RatioNone);
            $picture->caption = $item->displayCaption();
            $picture->link=new NGLink($this->previewMode);
            $picture->link->parseURL($item->link);

            $this->pictures [] = $picture;
        }

        if (count($this->pictures) >= 5) {

            $template = new NGTemplate ();

            $template->assign('pictures', $this->pictures);
            $template->assign('autochange', $this->autochange);
            $template->assign('sliderheight', $this->sliderheight);
            $template->assign('captionsupper', $this->captionsupper);
            $template->assign('captionsbold', $this->captionsbold);
            $template->assign('captionsitalic', $this->captionsitalic);
            $template->assign('captionswide', $this->captionswide);
            $template->assign('captionsshadow', $this->captionsshadow);
            $template->assign('captionssize', $this->captionssize);
            $template->assign('captionscolor', $this->captionscolor);
            $template->assign('uid', $this->objectUID);
            $template->assign ( 'bullet', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphendlessslider/styles/img/?f=%s&ca=%s&cb=%s', $this->bulletstyle, $this->bulletcolora, $this->bulletcolorb) ) );

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphendlessslider/tpl/template.tpl');

            $this->styles ['NGPluginParagraphEndlessSlider' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphendlessslider/tpl/style.tpl');
            $this->styleSheets ['NGPluginParagraphEndlessSlider'] = $this->prependPluginsPath('ngpluginparagraphendlessslider/css/style.css');
            $this->javaScripts ['NGPluginParagraphEndlessSlider'] = $this->prependPluginsPath('ngpluginparagraphendlessslider/js/endlessslider.js');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth && $this->panorama)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}

class NGPluginParagraphEndlessSliderItem
{

    /**
     *
     * Source of picture
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var string
     */
    public $caption;


    /**
     * *
     *
     * @var NGSize
     */
    public $size;

    /**
     * @var NGLink URL
     */
    public $link;
}