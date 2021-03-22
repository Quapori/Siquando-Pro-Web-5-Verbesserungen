<?php

class NGAdvancedPropertyDefinitionCategory
{
    const NodeCategory = 'category';
    const NodeCaption = 'caption';
    const NodeId = 'id';

    /**
     * @var NGAdvancedPropertyDefinition[]
     */
    public $items = array();

    /**
     * @var string
     */
    public $caption ='';

    /**
     * @var string
     */
    public $id='';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        $this->caption = $root->getAttribute(self::NodeCaption);
        $this->id = $root->getAttribute(self::NodeId);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType==XML_ELEMENT_NODE && $node->nodeName==NGAdvancedPropertyDefinition::NodeDefinition) {
                $item=NGAdvancedPropertyDefinition::FromXMLNode($node);

                $this->items[$item->id]=$item;
            }
        }
    }

}