<?php

class NGPluginParagraphSplitSlider extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSplitSlider = 'NGPluginParagraphSplitSlider';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSplitSlider = "paragraphsplitslider";

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
     * @var bool
     */
    public $panorama = false;

    /**
     * @var string
     */
    public $pictureposition = 'Right';

    /**
     * @var string
     */
    public $picturewidth = 'Equal';

    /**
     * @var string
     */
    public $colorforeground = 'ffffff';

    /**
     * @var string
     */
    public $colorbackground = 'a9a9a9';

    /**
     * @var string
     */
    public $cropratio = 'Ratio1by1';

    /**
     * @var string
     */
    public $picturepadding = '10%';

    /**
     * @var int
     */
    public $autochange = 0;

    /**
     * @var string
     */
    public $bulletstyle = 'default';

    /**
     * @var string
     */
    public $morestyle = 'default';

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

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphSplitSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('panorama', NGProperty::TypeBool, self::DomainParagraphSplitSlider, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureposition', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'pictureposition', NGPropertyMapped::MultiplicityScalar, false, 'Right', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('picturewidth', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'picturewidth', NGPropertyMapped::MultiplicityScalar, false, 'Equal', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorforeground', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorbackground', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, 'a9a9a9', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cropratio', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, 'Ratio1by1', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('picturepadding', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'picturepadding', NGPropertyMapped::MultiplicityScalar, false, '10%', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('autochange', NGProperty::TypeInt, self::DomainParagraphSplitSlider, 'autochange', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletstyle', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'bulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('morestyle', NGProperty::TypeString, self::DomainParagraphSplitSlider, 'morestyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
    }

    public function render()
    {
        $width = $this->renderWidth;

        if ($this->responsive && $this->panorama && $this->allowAlwaysFullWidth) $width = 1920;

        switch ($this->picturewidth) {
            case 'Equal':
                $width = floor($width / 2);
            case 'Wider':
                $width = floor($width / 2 * 3);
            case 'Smaller':
                $width = floor($width / 3 * 2);
        }

        if ($this->responsive && $width < 768) $width = 768;


        $ratioType = NGPicture::stringToRatio($this->cropratio);
        $ratio = NGPicture::ratioByRatioType($ratioType);
        $height = floor($width / $ratio);


        $this->bouquet = new NGBouquet ();
        $this->bouquet->itemSource = $this->itemsSource;
        $this->bouquet->sortMode = $this->sortMode;
        $this->bouquet->itemsXML = $this->items;
        $this->bouquet->parentUID = $this->itemsParentUID;
        $this->bouquet->maxItemCount = 15;
        $this->bouquet->previewMode = $this->previewMode;

        $this->bouquet->prepare();

        $this->pictures = Array();

        $richtext = new NGRichText();
        $richtext->previewMode = $this->previewMode;

        $link = new NGLink($this->previewMode);


        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */
            $picture = new NGPluginParagraphSplitSliderItem ();
            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, $height, $ratioType);
            $picture->size = $item->displayPicture()->getResizedSize($width, $height, $ratioType);
            $picture->caption = $item->displayCaption();
            $picture->summary = $richtext->parse($item->displaySummary());
            $picture->link = new NGLink($this->previewMode);
            $picture->link->parseURL($item->link);

            $this->pictures [] = $picture;
        }

        if (count($this->pictures) >= 2) {

            $template = new NGTemplate ();

            $template->assign('pictures', $this->pictures);
            $template->assign('uid', $this->objectUID);
            $template->assign('colorbackground', $this->colorbackground);
            $template->assign('colorforeground', $this->colorforeground);
            $template->assign('picturewidth', strtolower($this->picturewidth));
            $template->assign('pictureposition', strtolower($this->pictureposition));
            $template->assign('autochange', strtolower($this->autochange));
            $template->assign('picturepadding', strtolower($this->picturepadding));
            $template->assign('bullet', $this->prependPluginsPath(sprintf('ngpluginparagraphsplitslider/styles/img/?f=%s&c=%s', $this->bulletstyle, $this->colorforeground)));
            $template->assign('more', $this->prependPluginsPath(sprintf('ngpluginparagraphsplitslider/stylesmore/img/?f=%s&c=%s', $this->morestyle, $this->colorforeground)));


            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsplitslider/tpl/template.tpl');

            $this->styles ['NGPluginParagraphSplitSlider' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsplitslider/tpl/style.tpl');
            $this->styleSheets ['NGPluginParagraphSplitSlider'] = $this->prependPluginsPath('ngpluginparagraphsplitslider/css/style.css');
            $this->javaScripts ['NGPluginParagraphSplitSlider'] = $this->prependPluginsPath('ngpluginparagraphsplitslider/js/splitslider.js');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth && $this->panorama)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}

class NGPluginParagraphSplitSliderItem
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
     * @var summary
     */
    public $summary;

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