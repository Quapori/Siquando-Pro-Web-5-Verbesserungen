<?php

class NGPluginParagraphSFXSplit extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXSplit = 'NGPluginParagraphSFXSplit';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXSplit = "paragraphsfxsplit";

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

    public $backgroundcolor = '444444';

    public $foregroundcolor = 'ffffff';

    public $pictureposition = 'Left';

    public $more = 'mehr';

    public $fontsize = 150;

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

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphSFXSplit, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundcolor', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'backgroundcolor', NGPropertyMapped::MultiplicityScalar, false, '444444', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('foregroundcolor', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'foregroundcolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureposition', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'pictureposition', NGPropertyMapped::MultiplicityScalar, false, 'Left', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('more', NGProperty::TypeString, self::DomainParagraphSFXSplit, 'more', NGPropertyMapped::MultiplicityScalar, true, 'mehr', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('fontsize', NGProperty::TypeInt, self::DomainParagraphSFXSplit, 'fontsize', NGPropertyMapped::MultiplicityScalar, true, 150, false);
    }

    public function render()
    {
        $width = $this->renderWidth;
        if ($this->allowAlwaysFullWidth) $width = 1920;
        $width = $width / 2;
        if ($width < 1024) $width = 1024;

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
            $picture = new NGPluginParagraphSFXSplitItem ();
            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, -1, NGPicture::Ratio3by4);
            $picture->size = $item->displayPicture()->getResizedSize($width, -1, NGPicture::Ratio3by4);
            $picture->caption = $item->displayCaption();
            $picture->summary = $item->displaySummary();
            $picture->alt=$item->displayPicture()->displayAlt();
            $picture->link = new NGLink($this->previewMode);
            $picture->link->parseURL($item->link);

            $this->pictures [] = $picture;
        }

        if (count($this->pictures) > 0) {

            $template = new NGTemplate ();

            $template->assign('pictures', $this->pictures);
            $template->assign('uid', $this->objectUID);
            $template->assign('backgroundcolor', $this->backgroundcolor);
            $template->assign('foregroundcolor', $this->foregroundcolor);
            $template->assign('pictureposition', $this->pictureposition);
            $template->assign('more', $this->more);
            $template->assign('fontsize', $this->fontsize);

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxsplit/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphSFXSplit'] = $this->prependPluginsPath('ngpluginparagraphsfxsplit/css/style.css');
            $this->javaScripts ['NGPluginParagraphSFXSplit'] = $this->prependPluginsPath('ngpluginparagraphsfxsplit/js/split.js');
            $this->styles ['NGPluginParagraphSFXSplit'.$this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxsplit/tpl/local.tpl');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}

class NGPluginParagraphSFXSplitItem
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
     * @var
     */
    public $alt;

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