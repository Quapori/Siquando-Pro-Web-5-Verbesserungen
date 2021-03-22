<?php

class NGPluginParagraphSFXOneOfMany extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXOneOfMany = 'NGPluginParagraphSFXOneOfMany';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXOneOfMany = "paragraphsfxoneofmany";

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

    public $crop = 'Ratio3by4';

    public $shift = 600;

    public $spacing = 10;

    public $radius = 0;

    /**
     *
     * @var array
     */
    private $pictures = array();

    /**
     * @var NGBouquet
     */
    private $bouquet;

    /**
     * @var NGPluginParagraphSFXOneOfManyColumn[]
     */
    private $columns = array();

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphSFXOneOfMany, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphSFXOneOfMany, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphSFXOneOfMany, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphSFXOneOfMany, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('crop', NGProperty::TypeString, self::DomainParagraphSFXOneOfMany, 'crop', NGPropertyMapped::MultiplicityScalar, false, 'Ratio3by4', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('shift', NGProperty::TypeInt, self::DomainParagraphSFXOneOfMany, 'shift', NGPropertyMapped::MultiplicityScalar, false, 600, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('radius', NGProperty::TypeInt, self::DomainParagraphSFXOneOfMany, 'radius', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('spacing', NGProperty::TypeInt, self::DomainParagraphSFXOneOfMany, 'spacing', NGPropertyMapped::MultiplicityScalar, false, 10, false);
    }

    public function render()
    {
        $width = $this->renderWidth;
        if ($this->allowAlwaysFullWidth) $width = 1920;

        $width = ceil(($width ) / 5) - $this->spacing * 2;

        $crop = NGPicture::stringToRatio($this->crop);
        $ratio = round(NGPicture::ratioByRatioType($crop), 3);

        $this->bouquet = new NGBouquet ();
        $this->bouquet->itemSource = $this->itemsSource;
        $this->bouquet->sortMode = $this->sortMode;
        $this->bouquet->itemsXML = $this->items;
        $this->bouquet->parentUID = $this->itemsParentUID;
        $this->bouquet->maxItemCount = 20;
        $this->bouquet->previewMode = $this->previewMode;

        $this->bouquet->prepare();

        $this->pictures = array();

        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */

            $picture = new NGPluginParagraphSFXOneOfManyPicture();

            if (count($this->pictures)===0) {
                $scale = 2;
                $picture->priority = 1;
            } else {
                $scale = 1;
                $picture->priority = 2;
            }

            $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, $width*$scale, -1, $crop);
            $picture->size = $item->displayPicture()->getResizedSize($width*$scale, -1, $crop);
            $picture->alt = $item->displayPicture()->displayAlt();
            $this->pictures [] = $picture;
        }

        $this->columns[] = new NGPluginParagraphSFXOneOfManyColumn(3);
        $this->columns[] = new NGPluginParagraphSFXOneOfManyColumn(2);
        $this->columns[] = new NGPluginParagraphSFXOneOfManyColumn(1);
        $this->columns[] = new NGPluginParagraphSFXOneOfManyColumn(2);
        $this->columns[] = new NGPluginParagraphSFXOneOfManyColumn(3);

        while (count($this->pictures) >= 5) {
            if (count($this->columns[0]->pictures) === 0) {
                $this->columns[2]->pictures[] = array_shift($this->pictures);
                $this->columns[0]->pictures[] = array_shift($this->pictures);
                $this->columns[1]->pictures[] = array_shift($this->pictures);
                $this->columns[3]->pictures[] = array_shift($this->pictures);
                $this->columns[4]->pictures[] = array_shift($this->pictures);
            } else {
                for ($i = 0; $i < 5; $i++) {
                    $this->columns[$i]->pictures[] = array_shift($this->pictures);
                }
            }
        }

        if (count($this->columns[0]->pictures) >= 0) {

            $template = new NGTemplate ();

            $template->assign('columns', $this->columns);
            $template->assign('shift', $this->shift);
            $template->assign('ratio', $ratio);
            $template->assign('spacing', $this->spacing);
            $template->assign('radius', $this->radius);

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxoneofmany/tpl/template.tpl');

            $this->styleSheets ['NGPluginParagraphSFXOneOfMany'] = $this->prependPluginsPath('ngpluginparagraphsfxoneofmany/css/style.css');
            $this->javaScripts ['NGPluginParagraphSFXOneOfMany'] = $this->prependPluginsPath('ngpluginparagraphsfxoneofmany/js/oneofmany.js');


            if ($this->allowAlwaysFullWidth) {
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
            } else {
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            }
        }
    }
}

class NGPluginParagraphSFXOneOfManyColumn
{
    public $priority;

    public $pictures = array();

    function __construct($priority)
    {
        $this->priority = $priority;
    }
}

class NGPluginParagraphSFXOneOfManyPicture
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
    public $alt;

    /**
     * *
     *
     * @var NGSize
     */
    public $size;

    /**
     * @var int
     */
    public $priority;

}