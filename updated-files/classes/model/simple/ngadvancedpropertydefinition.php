<?php

abstract class NGAdvancedPropertyDefinition
{
    const NodeCaption = 'caption';
    const NodeDefinition = 'definition';
    const NodeID = 'id';
    const NodeType = 'type';

    public $caption = '';

    public $id = '';

    public $propertyType = '';

    /**
     * @param $xml DOMElement
     * @return NGAdvancedPropertyDefinition
     */
    public static function FromXMLNode($xml)
    {
        switch ($xml->getAttribute(self::NodeType)) {
            case NGAdvancedPropertyDefinitionString::TypeString:
                return new NGAdvancedPropertyDefinitionString($xml);
            case NGAdvancedPropertyDefinitionInt::TypeInt:
                return new NGAdvancedPropertyDefinitionInt($xml);
            case NGAdvancedPropertyDefinitionFloat::TypeFloat:
                return new NGAdvancedPropertyDefinitionFloat($xml);
            case NGAdvancedPropertyDefinitionColor::TypeColor:
                return new NGAdvancedPropertyDefinitionColor($xml);
            case NGAdvancedPropertyDefinitionBool::TypeBool:
                return new NGAdvancedPropertyDefinitionBool($xml);
            case NGAdvancedPropertyDefinitionSelect::TypeSelect:
                return new NGAdvancedPropertyDefinitionSelect($xml);
            case NGAdvancedPropertyDefinitionPicture::TypePicture:
                return new NGAdvancedPropertyDefinitionPicture($xml);
            case NGAdvancedPropertyDefinitionDownload::TypeDownload:
                return new NGAdvancedPropertyDefinitionDownload($xml);
            case NGAdvancedPropertyDefinitionPage::TypePage:
                return new NGAdvancedPropertyDefinitionPage($xml);
            case NGAdvancedPropertyDefinitionTopic::TypeTopic:
                return new NGAdvancedPropertyDefinitionTopic($xml);
        }
    }

    /**
     * @param $xml DOMElement
     */
    public function ParseXmlNode($xml)
    {
        $this->id = $xml->getAttribute(self::NodeID);
        $this->propertyType = $xml->getAttribute(self::NodeType);
        foreach ($xml->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeCaption) {
                $this->caption = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties
     * @return mixed
     */
    public abstract function getValue($properties);
}

class NGAdvancedPropertyDefinitionString extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypeString = 'string';

    public $defaultValue = '';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }
}

class NGAdvancedPropertyDefinitionInt extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';
    const NodeMinValue = 'minvalue';
    const NodeMaxValue = 'maxvalue';
    const NodeUnit = 'unit';

    const TypeInt = 'int';

    public $defaultValue = 0;

    public $unit = '';

    public $minValue;

    public $maxValue;

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE) {
                switch ($node->nodeName) {
                    case self::NodeDefaultValue:
                        $this->defaultValue = intval($node->nodeValue);
                        break;
                    case self::NodeMinValue:
                        $this->minValue = intval($node->nodeValue);
                        break;
                    case self::NodeMaxValue:
                        $this->maxValue = intval($node->nodeValue);
                        break;
                    case self::NodeUnit:
                        $this->unit = $node->nodeValue;
                        break;
                }
            }
        }
    }

    /**
     * @param $properties array
     * @return int
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return intval($properties[$this->id]);
        } else {
            return $this->defaultValue;
        }
    }
}

class NGAdvancedPropertyDefinitionFloat extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';
    const NodeMinValue = 'minvalue';
    const NodeMaxValue = 'maxvalue';
    const NodePrecision = 'precision';
    const NodeUnit = 'unit';

    const TypeFloat = 'float';

    public $defaultValue = 0.0;

    public $precision = 2;

    public $minValue;

    public $maxValue;

    public $unit='';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE) {
                switch ($node->nodeName) {
                    case self::NodeDefaultValue:
                        $this->defaultValue = floatval($node->nodeValue);
                        break;
                    case self::NodeMinValue:
                        $this->minValue = floatval($node->nodeValue);
                        break;
                    case self::NodeMaxValue:
                        $this->maxValue = floatval($node->nodeValue);
                        break;
                    case self::NodePrecision:
                        $this->precision = intval($node->nodeValue);
                        break;
                    case self::NodeUnit:
                        $this->unit = $node->nodeValue;
                        break;
                }
            }
        }
    }

    /**
     * @param $properties array
     * @return float
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return floatval($properties[$this->id]);
        } else {
            return $this->defaultValue;
        }
    }

}

class NGAdvancedPropertyDefinitionColor extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypeColor = 'color';

    public $defaultValue = 'ffffff';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }

}

class NGAdvancedPropertyDefinitionBool extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypeBool = 'bool';

    public $defaultValue = false;

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = NGUtil::StringXMLToBool($node->nodeValue);
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return NGUtil::StringXMLToBool($properties[$this->id]);
        } else {
            return $this->defaultValue;
        }
    }

}

class NGAdvancedPropertyDefinitionSelect extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';
    const NodeValue = 'value';

    const TypeSelect = 'select';

    public $defaultValue = false;

    public $values = array();

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE) {
                switch ($node->nodeName) {
                    case self::NodeDefaultValue:
                        $this->defaultValue = $node->nodeValue;
                        break;
                    case self::NodeValue:
                        $this->values[] = $node->nodeValue;
                        break;
                }

            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }

}

class NGAdvancedPropertyDefinitionPicture extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypePicture = 'picture';

    public $defaultValue = '';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }
}

class NGAdvancedPropertyDefinitionDownload extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypeDownload = 'download';

    public $defaultValue = '';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }
}

class NGAdvancedPropertyDefinitionPage extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypePage = 'page';

    public $defaultValue = '';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }
}

class NGAdvancedPropertyDefinitionTopic extends NGAdvancedPropertyDefinition
{
    const NodeDefaultValue = 'defaultvalue';

    const TypeTopic = 'topic';

    public $defaultValue = '';

    /**
     * NGCustomField constructor.
     * @param DOMElement $root
     */
    public function __construct($root)
    {
        parent::ParseXmlNode($root);

        foreach ($root->childNodes as $node) {
            /* @var $node DOMElement */

            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === self::NodeDefaultValue) {
                $this->defaultValue = $node->nodeValue;
            }
        }
    }

    /**
     * @param $properties array
     * @return string
     */
    public function getValue($properties)
    {
        if (array_key_exists($this->id, $properties)) {
            return $properties[$this->id];
        } else {
            return $this->defaultValue;
        }
    }
}
