<?php

class NGAdvancedPropertyDefinitionCategories {

    /**
     * @var NGAdvancedPropertyDefinitionCategory[]
     */
    public $items = array();


    /**
     * @param $xml string
     */
    public function parseXMLString($xml)
    {
        if ($xml === '') return;

        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->loadXML($xml);

        $this->parseXMLNode($doc->documentElement);
    }

    /**
     * @param $xml
     * @return NGAdvancedPropertyDefinitionCategories
     */
    public static function FromXMLString($xml)
    {
        $advancedpropertydefinitioncategories = new NGAdvancedPropertyDefinitionCategories();
        $advancedpropertydefinitioncategories->parseXMLString($xml);
        return $advancedpropertydefinitioncategories;
    }

    /**
     * @param $root DOMElement
     */
    public function parseXMLNode($root)
    {
        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */
            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === NGAdvancedPropertyDefinitionCategory::NodeCategory) {
                $item = new NGAdvancedPropertyDefinitionCategory($node);
                $this->items[$item->id] = $item;
            }
        }
    }

    /**
     * @param $id
     * @return NGAdvancedPropertyDefinition|null
     */
    public function getDefinitionById($id) {
        foreach ($this->items as $category) {
            foreach ($category->items as $property) {
                if ($property->id===$id) return $property;
            }
        }

        return null;
    }

}