<?php

class NGPluginParagraphFacts extends NGPluginParagraph
{
    const ObjectTypePluginParagraphFacts = 'NGPluginParagraphFacts';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphFacts = 'paragraphfacts';

    /**
     * @var string
     */
    public $items = '';

    /**
     * @var string
     */
    public $colorsymbol = '696969';

    /**
     * @var string
     */
    public $colorcaption = '';

    /**
     * @var string
     */
    public $colorsummary = '';

    /**
     * @var string
     */
    public $alignmentlink = 'Right';

    /**
     * @var string
     */
    public $alignmentcaption = 'Center';

    /**
     * @var string
     */
    public $alignmentsummary = 'Justify';

    /**
     * @var bool
     */
    public $animate = true;


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphFacts, 'items', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorsymbol', NGProperty::TypeString, self::DomainParagraphFacts, 'colorsymbol', NGPropertyMapped::MultiplicityScalar, false, '696969', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorcaption', NGProperty::TypeString, self::DomainParagraphFacts, 'colorcaption', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('colorsummary', NGProperty::TypeString, self::DomainParagraphFacts, 'colorsummary', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alignmentlink', NGProperty::TypeString, self::DomainParagraphFacts, 'alignmentlink', NGPropertyMapped::MultiplicityScalar, false, 'Right', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alignmentcaption', NGProperty::TypeString, self::DomainParagraphFacts, 'alignmentcaption', NGPropertyMapped::MultiplicityScalar, false, 'Center', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alignmentsummary', NGProperty::TypeString, self::DomainParagraphFacts, 'alignmentsummary', NGPropertyMapped::MultiplicityScalar, false, 'Justify', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animate', NGProperty::TypeBool, self::DomainParagraphFacts, 'animate', NGPropertyMapped::MultiplicityScalar, false, true, false);
    }

    public function render()
    {

        if ($this->items !== '') {

            $richText = new NGRichText();
            $richText->previewMode = $this->previewMode;

            $icon = new NGPluginIcon();

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($this->items);

            $facts = array();

            $controller = new NGDBAdapterObject ();

            foreach ($xml->documentElement->childNodes as $itemElement) {
                /* @var $itemElement DOMElement */
                if ($itemElement->nodeType == XML_ELEMENT_NODE) {
                    if ($itemElement->nodeName == 'item') {
                        $fact = new NGPluginParagraphFactsFact();

                        foreach ($itemElement->childNodes as $node) {
                            /* @var $node DOMElement */
                            if ($node->nodeType == XML_ELEMENT_NODE) {
                                switch ($node->nodeName) {
                                    case 'caption' :
                                        $fact->caption = $node->nodeValue;
                                        break;
                                    case 'summary' :
                                        $fact->summary = $richText->parse($node->nodeValue);
                                        break;
                                    case 'icon' :
                                        $fact->src = $this->prependPluginsPath(sprintf('ngpluginparagraphfacts/img/?f=%s&c=%s', $node->nodeValue, $this->colorsymbol));
                                        $fact->alt = '';
                                        break;
                                    case 'pictureuid' :
                                        $picture = $controller->loadObject($node->nodeValue, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);
                                        if ($picture != null) {
                                            $fact->src = NGLink::getPictureURL($picture->objectUID, 160, 160, NGPicture::Ratio1by1);
                                            $fact->alt = $picture->alt;
                                            $fact->class='sqwpluginfactsbubble';
                                        }
                                        break;
                                    case 'linkcaption' :
                                        $fact->linkcaption = $node->nodeValue;
                                        break;
                                    case 'linkuid' :
                                        if ($node->nodeValue !== '') {
                                            $link = new NGLink ($this->previewMode);
                                            $link->parseURL($node->nodeValue);
                                            $fact->link = $link;
                                        }
                                        break;
                                }
                            }
                        }

                        $facts [] = $fact;
                    }
                }
            }

            if (count($facts) > 0) {

                $template = new NGTemplate ();

                $cols = min(count($facts), 5);

                $template->assign('facts', $facts);
                $template->assign('cols', $cols);
                $template->assign('animate', $this->animate);
                $template->assign('uid', $this->objectUID);
                $template->assign('colorsymbol', $this->colorsymbol);
                $template->assign('colorcaption', $this->colorcaption);
                $template->assign('colorsummary', $this->colorsummary);
                $template->assign('alignmentcaption', strtolower($this->alignmentcaption));
                $template->assign('alignmentsummary', strtolower($this->alignmentsummary));
                $template->assign('alignmentlink', strtolower($this->alignmentlink));

                $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphfacts/tpl/template.tpl');

                $this->styleSheets ['NGPluginParagraphFacts'] = $this->prependPluginsPath('ngpluginparagraphfacts/css/');
                $this->javaScripts ['NGPluginParagraphFacts'] = $this->prependPluginsPath('ngpluginparagraphfacts/js/facts.js');
                $this->styles ['NGPluginParagraphFacts' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphfacts/tpl/stylelocal.tpl');

            }
        }


    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphFactsFact
{
    public $caption = '';
    public $summary = '';
    public $link = null;
    public $src = '';
    public $alt = '';
    public $linkcaption = '';
    public $class='';
}