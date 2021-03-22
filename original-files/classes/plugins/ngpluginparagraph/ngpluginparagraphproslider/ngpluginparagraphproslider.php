<?php

class NGPluginParagraphProSlider extends NGPluginParagraph
{
    const ObjectTypePluginParagraphProSlider = 'NGPluginParagraphProSlider';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphProSlider = "paragraphproslider";

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
     * @var string
     */
    public $navstyle = 'default';

    /**
     * @var string
     */
    public $bulletstyle = 'default';

    /**
     * @var string
     */
    public $navcolor = '888888';

    /**
     * @var string
     */
    public $bulletcolor = '888888';

    /**
     * @var string
     */
    public $more='mehr';

    /**
     * @var bool Enable touch
     */
    public $touch = false;

    /**
     * @var string
     */
    public $crop = 'Ratio3by2';

    /**
     *
     * @var array
     */
    private $pictures = array();

    /**
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

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphProSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphProSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphProSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphProSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('crop', NGProperty::TypeString, self::DomainParagraphProSlider, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio3by2', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navstyle', NGProperty::TypeString, self::DomainParagraphProSlider, 'navstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletstyle', NGProperty::TypeString, self::DomainParagraphProSlider, 'bulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('navcolor', NGProperty::TypeString, self::DomainParagraphProSlider, 'navcolor', NGPropertyMapped::MultiplicityScalar, false, '888888', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletcolor', NGProperty::TypeString, self::DomainParagraphProSlider, 'bulletcolor', NGPropertyMapped::MultiplicityScalar, false, '888888', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('touch', NGProperty::TypeBool, self::DomainParagraphProSlider, 'touch', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('more', NGProperty::TypeString, self::DomainParagraphProSlider, 'more', NGPropertyMapped::MultiplicityScalar, true, 'mehr', false);
    }

    public function render()
    {
        $width = $this->renderWidth;
        if ($this->allowAlwaysFullWidth) $width = 1920;
        $width = floor($width * 0.8);
        if ($width > 930) $width = 930;

        $crop = NGPicture::stringToRatio($this->crop);
        $ratio = round(NGPicture::ratioByRatioType($crop),3);

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
            $picture = new NGPluginParagraphProSliderItem ();
            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, $width, $crop);
            $picture->size = $item->displayPicture()->getResizedSize($width, $width, $crop);
            $picture->caption = $item->displayCaption();
            $picture->summary = $item->displaySummary();
            $picture->link = new NGLink($this->previewMode);
            $picture->link->parseURL($item->link);

            $this->pictures [] = $picture;
        }

        if (count($this->pictures) >= 5) {

            $template = new NGTemplate ();

            $template->assign('pictures', $this->pictures);

            $template->assign('uid', $this->objectUID);
            $template->assign('more', $this->more);
            $template->assign('ratio', $ratio);
            $template->assign('touch', NGUtil::boolToStringXML($this->touch));
            $template->assign('next', sprintf($this->prependPluginsPath('ngpluginparagraphproslider/styles/nav/img/?f=%s_next&c=%s'), $this->navstyle, $this->navcolor));
            $template->assign('prev', sprintf($this->prependPluginsPath('ngpluginparagraphproslider/styles/nav/img/?f=%s_prev&c=%s'), $this->navstyle, $this->navcolor));

            if ($this->bulletstyle!=='none') {
                $template->assign('bullets', sprintf($this->prependPluginsPath('ngpluginparagraphproslider/styles/bullet/img/?f=%s&c=%s'), $this->bulletstyle, $this->bulletcolor));
                $this->styles ['NGPluginParagraphProSlider' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphproslider/tpl/local.tpl');
            }

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphproslider/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphProSlider'] = $this->prependPluginsPath('ngpluginparagraphproslider/css/');
            $this->javaScripts ['NGPluginParagraphProSlider'] = $this->prependPluginsPath('ngpluginparagraphproslider/js/proslider.js');


            if ($this->allowAlwaysFullWidth) {
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
            } else {
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            }
        }
    }
}

class NGPluginParagraphProSliderItem
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
     * @var string
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