<?php

class NGPluginParagraphSFXGallery extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXGallery = 'NGPluginParagraphSFXGallery';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXGallery = "paragraphsfxgallery";

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
     * @var int
     */
    public $zoom =20;

    /**
     * @var string
     */
    public $fadecolor = '000000';

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

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphSFXGallery, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphSFXGallery, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphSFXGallery, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphSFXGallery, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('zoom', NGProperty::TypeInt, self::DomainParagraphSFXGallery, 'zoom', NGPropertyMapped::MultiplicityScalar, false, 20);
        $this->propertiesMapped [] = new NGPropertyMapped ('fadecolor', NGProperty::TypeInt, self::DomainParagraphSFXGallery, 'fadecolor', NGPropertyMapped::MultiplicityScalar, false, '000000');
    }

    public function render()
    {
        $width = $this->renderWidth;
        if ( $this->allowAlwaysFullWidth) $width = 1920;
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
            $this->pictures [] = NGLink::getPictureURL($item->displayPicture()->objectUID, $width, $width);
        }

        if (count($this->pictures) > 0) {

            $template = new NGTemplate ();

            $template->assign('pictures', $this->pictures);
            $template->assign('zoom', $this->zoom);
            $template->assign('fadecolor', $this->fadecolor);

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxgallery/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphSFXGallery'] = $this->prependPluginsPath('ngpluginparagraphsfxgallery/css/style.css');
            $this->javaScripts ['NGPluginParagraphSFXGallery'] = $this->prependPluginsPath('ngpluginparagraphsfxgallery/js/gallery.js');


            if ($this->allowAlwaysFullWidth) {
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
            } else {
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            }
        }
    }
}