<?php

/**
 * Class NGPluginIcon
 * Creates SVG Icons
 */
class NGPluginIcon
{
    /**
     * @var DOMDocument
     */
    private $document;

    /**
     * @var string Class name to use
     */
    public $class = '';

    /**
     * @var array Styles to inject
     */
    public $styles = array();

    /**
     * NGPluginIcon constructor.
     */
    public function __construct()
    {
        $this->document = new DOMDocument();
    }

    /**
     * @param $id Id of Icon
     * @return string Icon SVG
     */
    public function getSvg($id)
    {
        if ($id === '') return '';

        try {

            $filename = NGUtil::joinPaths(NGConfig::pluginsPath(), 'ngpluginicon/styles/' . $id . '.svg');

            if (!file_exists($filename)) return '';

            @$this->document->load($filename);

            if ($this->document===null) return '';
            if ($this->document->documentElement===null) return '';

            if ($this->class !== '') $this->document->documentElement->setAttribute('class', $this->class);

            if (count($this->styles) > 0) {
                $style = '';
                foreach ($this->styles as $key => $value) {
                    $style .= $key . ':' . $value . ';';
                }
                $this->document->documentElement->setAttribute('style', $style);
            }

            $xml=$this->document->saveXML($this->document->documentElement);

            $xml=preg_replace('/(xmlns|xmlns:xlink|version|baseProfile)=".*?"/','',$xml);

            return $xml;
        }
        catch (Exception $e)
        {
            return '';
        }
    }
}