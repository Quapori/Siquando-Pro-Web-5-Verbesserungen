<?php

class NGPluginParagraphFloatingPictures extends NGPluginParagraph
{
    const ObjectTypePluginParagraphFloatingPictures = 'NGPluginParagraphFloatingPictures';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphFloatingPictures = "paragraphfloatingpictures";

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
     * Crop ratio
     *
     * @var string
     */
    public $crop = 'Ratio16by9';

    /**
     *
     * Panoramic display
     *
     * @var bool
     */
    public $panorama = false;

    /**
     *
     * Text overlay
     *
     * @var string
     */
    public $textoverlay = '';

    /**
     *
     * Delay
     *
     * @var int
     */
    public $delay = 5;

    /**
     *
     * Text size
     *
     * @var int
     */
    public $textsize = 3;

    /**
     *
     * Color of text
     *
     * @var string
     */
    public $textcolor = 'ffffff';

    /**
     * @var bool
     */
    public $textitalic=false;

    /**
     * @var bool
     */
    public $textbold=false;

    /**
     * @var int
     */
    public $zoomdepht=50;

    /**
     *
     * @var array
     */
    private $pictures = array();

    /**
     *
     * @var NGBouquet
     */
    private $bouquet;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphFloatingPictures, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphFloatingPictures, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphFloatingPictures, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphFloatingPictures, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('crop', NGProperty::TypeString, self::DomainParagraphFloatingPictures, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio4by3', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('panorama', NGProperty::TypeBool, self::DomainParagraphFloatingPictures, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('textoverlay', NGProperty::TypeText, self::DomainParagraphFloatingPictures, 'textoverlay', NGPropertyMapped::MultiplicityScalar, true, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('delay', NGProperty::TypeInt, self::DomainParagraphFloatingPictures, 'delay', NGPropertyMapped::MultiplicityScalar, false, 5, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('textsize', NGProperty::TypeInt, self::DomainParagraphFloatingPictures, 'textsize', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('textcolor', NGProperty::TypeString, self::DomainParagraphFloatingPictures, 'textcolor', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('textbold', NGProperty::TypeBool, self::DomainParagraphFloatingPictures, 'textbold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('textitalic', NGProperty::TypeBool, self::DomainParagraphFloatingPictures, 'textitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('zoomdepht', NGProperty::TypeInt, self::DomainParagraphFloatingPictures, 'zoomdepht', NGPropertyMapped::MultiplicityScalar, false, 50, false);
    }

    public function render()
    {
        $width = $this->renderWidth;

        if ($this->panorama && $this->responsive)
            $width = 1920;

        $ratioType = NGPicture::stringToRatio($this->crop);
        $ratio = NGPicture::ratioByRatioType($ratioType);

        $height = floor($width / $ratio);

        $this->bouquet = new NGBouquet ();
        $this->bouquet->itemSource = $this->itemsSource;
        $this->bouquet->sortMode = $this->sortMode;
        $this->bouquet->itemsXML = $this->items;
        $this->bouquet->parentUID = $this->itemsParentUID;
        $this->bouquet->previewMode = $this->previewMode;

        $this->bouquet->prepare();

        $this->pictures = Array();

        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */

            $this->pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, $height, $ratioType);
        }

        if (count($this->pictures) > 1) {

            $template = new NGTemplate ();

            $template->assign('textcolor', $this->textcolor);
            $template->assign('textsize', $this->textsize);
            $template->assign('delay', $this->delay);
            $template->assign('textoverlay', $this->textoverlay);
            $template->assign('pictures', $this->pictures);
            $template->assign('width', $width);
            $template->assign('height', $height);
            $template->assign('textbold', $this->textbold);
            $template->assign('textitalic', $this->textitalic);
            $template->assign('zoomdepht', $this->zoomdepht);
            $template->assign('ratio', number_format(1/$ratio*100,3,'.',''));

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphfloatingpictures/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphFloatingPictures'] = $this->prependPluginsPath('ngpluginparagraphfloatingpictures/css/style.css');
            $this->javaScripts ['NGPluginParagraphFloatingPictures'] = $this->prependPluginsPath('ngpluginparagraphfloatingpictures/js/floatingpictures.js');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth && $this->panorama)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}