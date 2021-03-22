<?php

class NGPluginParagraphFoodMenu extends NGPluginParagraph
{
    const ObjectTypePluginParagraphFoodMenu = 'NGPluginParagraphFoodMenu';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphFoodMenu = 'paragraphfoodmenu';

    public $items = '';


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeFulltext, self::DomainParagraphFoodMenu, 'items', NGPropertyMapped::MultiplicityScalar, true, '');

    }

    public function render()
    {
        $width = $this->renderWidth;
        if ($this->allowMobileFullWidth && $width < 1024) $width = 1024;

        /* @var $items NGPluginParagraphFoodMenuItem[] */
        $items = array();


        if ($this->items != '') {

            $richtext = new NGRichText();
            $richtext->previewMode = $this->previewMode;

            $pictureAdapter=new NGDBAdapterObject();


            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($this->items);

            foreach ($xml->documentElement->childNodes as $nodeItem) {
                /* @var $nodeItem DOMNode */
                if ($nodeItem->nodeType === XML_ELEMENT_NODE) {
                    if ($nodeItem->nodeName == 'item') {
                        $item = new NGPluginParagraphFoodMenuItem();
                        $items[] = $item;

                        foreach ($nodeItem->childNodes as $node) {
                            /* @var $node DOMNode */
                            if ($node->nodeType === XML_ELEMENT_NODE) {
                                if ($node->nodeName == 'caption') $item->caption = $node->nodeValue;
                                if ($node->nodeName == 'price') $item->price = $node->nodeValue;
                                if ($node->nodeName == 'summary') {
                                    $item->summary = $richtext->parse($node->nodeValue);
                                }
                                if ($node->nodeName == 'picture') {
                                    /* @var $picture NGPicture */
                                    $picture = $pictureAdapter->loadObject($node->nodeValue, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                                    if ($picture != null) {
                                        $item->size = $picture->getResizedSize($width);
                                        $item->alt=$picture->displayAlt();
                                        $item->picture=NGLink::getPictureURL($picture->objectUID, $width);
                                        $item->fullpicture=NGLink::getPictureURL($picture->objectUID);
                                    }
                                }
                            }
                        }
                    }
                }

                if (count($items) > 0) {
                    $template = new NGTemplate();

                    $template->assign('items', $items);
                    $template->assign('id', $this->objectUID);
                    $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphfoodmenu/tpl/template.tpl');

                    $this->styleSheets ['NGPluginParagraphFoodMenu'] = $this->prependPluginsPath ( 'ngpluginparagraphfoodmenu/css/' );

                }


            }
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphFoodMenuItem
{
    public $caption = '';
    public $price='';
    public $summary;
    public $picture;
    public $fullpicture;
    public $size;
    public $alt;
}