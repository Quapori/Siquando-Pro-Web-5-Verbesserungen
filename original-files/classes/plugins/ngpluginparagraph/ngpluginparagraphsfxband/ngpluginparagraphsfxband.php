<?php

class NGPluginParagraphSFXBand extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXBand = 'NGPluginParagraphSFXBand';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXBand = "paragraphsfxband";

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

    public $effect = -20;

    public $size = 20;

    public $gutter = 10;

    public $inertia = 0;

    /**
     *
     * @var NGPluginParagraphSFXBandItem[]
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

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphSFXBand, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphSFXBand, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphSFXBand, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphSFXBand, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('effect', NGProperty::TypeInt, self::DomainParagraphSFXBand, 'effect', NGPropertyMapped::MultiplicityScalar, false, -20, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('size', NGProperty::TypeInt, self::DomainParagraphSFXBand, 'size', NGPropertyMapped::MultiplicityScalar, false, 20, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('gutter', NGProperty::TypeInt, self::DomainParagraphSFXBand, 'gutter', NGPropertyMapped::MultiplicityScalar, false, 10, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('inertia', NGProperty::TypeInt, self::DomainParagraphSFXBand, 'inertia', NGPropertyMapped::MultiplicityScalar, false, 0, false);
    }

    public function render()
    {
        $width = $this->renderWidth;
        if ($this->allowAlwaysFullWidth) $width = 1920;
        if ($width < 1024) $width = 1024;

        $height = floor($width * $this->size / 100);

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
            $picture = new NGPluginParagraphSFXBandItem ();
            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, -1, $height);
            $picture->size = $item->displayPicture()->getResizedSize(-1, $height);
            $picture->alt = $item->displayPicture()->displayAlt();

            $this->pictures [] = $picture;
        }

        if (count($this->pictures) > 0) {

            $pictures = array();
            $i = 0;
            $requiredWidth = $width * (100 + abs($this->effect)) / 100;
            $totalWidth = 0;

            while ($totalWidth < $requiredWidth) {
                $picture = $this->pictures[$i];
                $pictures[] = $picture;
                $totalWidth += $picture->size->width;
                $totalWidth += $this->gutter;
                $i++;

                if ($i >= count($this->pictures)) $i = 0;
            }

            $template = new NGTemplate ();

            $template->assign('pictures', $pictures);
            $template->assign('effect', $this->effect);
            $template->assign('gutter', $this->gutter);
            $template->assign('size', $this->size);
            $template->assign('inertia', $this->inertia);

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxband/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphSFXBand'] = $this->prependPluginsPath('ngpluginparagraphsfxband/css/style.css');
            $this->javaScripts ['NGPluginParagraphSFXBand'] = $this->prependPluginsPath('ngpluginparagraphsfxband/js/band.js');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}

class NGPluginParagraphSFXBandItem
{
    /**
     *
     * Source of picture
     *
     * @var string
     */
    public $source;

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

}