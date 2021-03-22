<?php

class NGPluginParagraphAnimatedCircles extends NGPluginParagraph
{
    const ObjectTypePluginParagraphAnimatedCircles = 'NGPluginParagraphAnimatedCircles';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphAnimatedCircles = 'paragraphanimatedcircles';

    /**
     * @var string
     */
    public $items = array();

    public $ringwidth = 20;

    public $animationduration = 2000;

    public $animationdelay = 500;

    public $valuesize = 3;

    public $captionsize = 3;

    public $valuebold = false;

    public $valueitalic = false;

    public $captionbold = false;

    public $captionitalic = false;

    public $columns = 1;


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphAnimatedCircles, 'items', NGPropertyMapped::MultiplicityList, true, null, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('ringwidth', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'ringwidth', NGPropertyMapped::MultiplicityScalar, false, 20, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animationduration', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'animationduration', NGPropertyMapped::MultiplicityScalar, false, 2000, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animationdelay', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'animationdelay', NGPropertyMapped::MultiplicityScalar, false, 500, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('valuesize', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'valuesize', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('valuebold', NGProperty::TypeBool, self::DomainParagraphAnimatedCircles, 'valuebold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('valueitalic', NGProperty::TypeBool, self::DomainParagraphAnimatedCircles, 'valueitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionsize', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'captionsize', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionbold', NGProperty::TypeBool, self::DomainParagraphAnimatedCircles, 'captionbold', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('captionitalic', NGProperty::TypeBool, self::DomainParagraphAnimatedCircles, 'captionitalic', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('columns', NGProperty::TypeInt, self::DomainParagraphAnimatedCircles, 'columns', NGPropertyMapped::MultiplicityScalar, false, 1, false);
    }

    public function render()
    {
        $circles = array();

        foreach ($this->items as $item) {

            $circle = new NGPluginParagraphAnimatedCirclesCirlce();

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($item);

            /* @var $childElement DOMElement */
            foreach ($xml->documentElement->childNodes as $childElement) {
                if ($childElement->nodeType == XML_ELEMENT_NODE) {
                    switch ($childElement->nodeName) {
                        case 'caption' :
                            $circle->caption = $childElement->nodeValue;
                            break;
                        case 'percentage' :
                            $circle->percentage = intval($childElement->nodeValue);
                            break;
                        case 'unit' :
                            $circle->unit = $childElement->nodeValue;
                            break;
                        case 'value' :
                            $circle->value = intval($childElement->nodeValue);
                            break;
                        case 'colortrack' :
                            $circle->colortrack = $childElement->nodeValue;
                            break;
                        case 'colorring' :
                            $circle->colorring = $childElement->nodeValue;
                            break;
                        case 'colorcaption' :
                            $circle->colorcaption = $childElement->nodeValue;
                            break;
                        case 'colorvalue' :
                            $circle->colorvalue = $childElement->nodeValue;
                            break;
                    }
                }
            }

            if ($circle->value === 0) $circle->value = $circle->percentage;

            $circles [] = $circle;
        }

        if (count($circles) > 0) {
            $template = new NGTemplate();

            $template->assign('circles', $circles);
            $template->assign('ringwidth', $this->ringwidth);
            $template->assign('animationduration', $this->animationduration);
            $template->assign('animationdelay', $this->animationdelay);
            $template->assign('valuesize', $this->valuesize);
            $template->assign('valuebold', $this->valuebold);
            $template->assign('valueitalic', $this->valueitalic);
            $template->assign('captionsize', $this->captionsize);
            $template->assign('captionbold', $this->captionbold);
            $template->assign('captionitalic', $this->captionitalic);

            $columns = $this->columns;

            if ($columns == 0) {
                $columns = count($circles);
                if ($columns > 5) $columns = 5;
            }

            $template->assign('columns', $columns);

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphanimatedcircles/tpl/layout.tpl');

            $this->styleSheets ['NGPluginParagraphAnimatedCircles'] = $this->prependPluginsPath('ngpluginparagraphanimatedcircles/css/style.css');
            $this->javaScripts ['NGPluginParagraphAnimatedCircles'] = $this->prependPluginsPath('ngpluginparagraphanimatedcircles/js/animatedcircles.js');
        }


    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphAnimatedCirclesCirlce
{
    public $caption = '';
    public $percentage = 100;
    public $unit = "%";
    public $value = 0;
    public $colortrack = 'd3d3d3';
    public $colorring = '4682b4';
    public $colorcaption = '';
    public $colorvalue = '';
}