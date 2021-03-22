<?php

class NGPluginParagraphButtons extends NGPluginParagraph
{
    const ObjectTypePluginParagraphFacts = 'NGPluginParagraphButtons';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphButtons = 'paragraphbuttons';

    /**
     * @var string
     */
    public $items = '';

    /**
     * @var string
     */
    public $justifyitems='right';



    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphButtons, 'items', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('justifyitems', NGProperty::TypeString, self::DomainParagraphButtons, 'justifyitems', NGPropertyMapped::MultiplicityScalar, false, 'right', false);
    }

    public function render()
    {

        if ($this->items !== '') {

            $icon = new NGPluginIcon();
            $icon->class='sqpnavicon';

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($this->items);

            $items = array();

            $controller = new NGDBAdapterObject ();

            foreach ($xml->documentElement->childNodes as $itemElement) {
                /* @var $itemElement DOMElement */
                if ($itemElement->nodeType == XML_ELEMENT_NODE) {
                    if ($itemElement->nodeName == 'item') {
                        $item = new NGPluginParagraphButtonsItem();

                        foreach ($itemElement->childNodes as $node) {
                            /* @var $node DOMElement */
                            if ($node->nodeType == XML_ELEMENT_NODE) {
                                switch ($node->nodeName) {
                                    case 'icon' :
                                        $item->svg = $icon->getSvg($node->nodeValue);
                                        break;
                                    case 'linkcaption' :
                                        $item->linkcaption = $node->nodeValue;
                                        break;
                                    case 'linktitle' :
                                        $item->linktitle = $node->nodeValue;
                                        break;
                                    case 'linkuid' :
                                        if ($node->nodeValue !== '') {
                                            $link = new NGLink ($this->previewMode);
                                            $link->parseURL($node->nodeValue);
                                            $item->link = $link;
                                        }
                                        break;
                                }
                            }
                        }

                        $items [] = $item;
                    }
                }
            }

            if (count($items) > 0) {

                $template = new NGTemplate ();

                $template->assign('items', $items);
                $template->assign('uid', $this->objectUID);
                $template->assign('justifyitems', strtolower($this->justifyitems));

                $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphbuttons/tpl/template.tpl');

                $this->styleSheets ['NGPluginParagraphButtons'] = $this->prependPluginsPath('ngpluginparagraphbuttons/css/');

            }
        }


    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphButtonsItem
{
    public $link = null;
    public $linkcaption = '';
    public $linktitle = '';
    public $svg='';
}