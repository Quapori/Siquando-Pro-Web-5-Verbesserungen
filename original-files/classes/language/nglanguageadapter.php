<?php

class NGLanguageAdapter
{
    const NodeLanguageResourceDictionary = 'languageresourcedictionary';
    const NodeLanguageResource = 'languageresource';
    const NodeCaption = 'caption';
    const NodeDefault = 'default';
    const NodeValue = 'value';
    const NodeDescription = 'description';
    const NodeUID = 'uid';
    const NodeJS = 'js';
    const NodeStdPages = 'stdpages';
    const NodeStdPage = 'stdpage';
    const NodeName = 'name';

    public $langURL = '';

    /**
     * @var NGLanguageResource[]
     */
    public $languageResources = Array();

    public $uid;

    public $caption;

    private $xml;

    /**
     *
     * Loads resources
     * @param bool $loadAll
     * @param bool $loadUserChanges
     * @throws NGException
     */
    public function load($loadAll = false, $loadUserChanges = true)
    {
        if ($this->langURL == '')
            throw new NGException ('langURL not set');

        $this->xml = new DOMDocument ('1.0', 'UTF-8');

        if (!file_exists($this->fullPath()))
            throw new NGException (sprintf('File "%s" not found.', $this->langURL));

        $this->xml->load($this->fullPath());
        $this->parseXML($loadAll);
        if ($loadUserChanges)
            $this->loadUserChanges();
    }

    /**
     * Load user changes
     */
    private function loadUserChanges()
    {
        $adapter = new NGDBAdapterObject ();

        /* @var $settings NGSettingsLanguage */
        $settings = $adapter->loadSetting($this->uid, NGSettingsLanguage::ObjectTypeSettingsLanguage);

        foreach ($settings->languageResources as $uid => $value) {
            if (array_key_exists($uid, $this->languageResources)) {
                $this->languageResources [$uid]->value = $value;
            }
        }
    }

    /**
     *
     * Save user changes
     */
    public function save()
    {
        $settings = new NGSettingsLanguage ();
        $settings->setId($this->uid);

        foreach ($this->languageResources as $uid => $languageResource) {
            /* @var $languageResource NGLanguageResource */
            if ($languageResource->isDirty()) {
                $settings->languageResources [$uid] = $languageResource->value;
            }
        }

        $adapter = new NGDBAdapterObject ();
        return $adapter->saveObject($settings, '', false, false, true);
    }

    /**
     *
     * Parse XML
     * @param bool $loadAll
     */
    private function parseXML($loadAll)
    {

        if ($loadAll) {
            $this->caption = $this->xml->documentElement->getAttribute(self::NodeCaption);
        }
        $this->uid = $this->xml->documentElement->getAttribute(self::NodeUID);

        foreach ($this->xml->documentElement->childNodes as $languageResourceNode) {
            /* @var $languageResourceNode DOMElement */
            if ($languageResourceNode->nodeType == XML_ELEMENT_NODE) {
                if ($languageResourceNode->nodeName == self::NodeLanguageResource) {
                    $langaugeResource = new NGLanguageResource ();
                    foreach ($languageResourceNode->childNodes as $propertyNode) {
                        /* @var $propertyNode DOMElement */
                        if ($propertyNode->nodeType == XML_ELEMENT_NODE) {
                            switch ($propertyNode->nodeName) {
                                case self::NodeCaption :
                                    if ($loadAll) {
                                        $langaugeResource->caption = $propertyNode->nodeValue;
                                    }
                                    break;
                                case self::NodeDefault :
                                    if ($loadAll) {
                                        $langaugeResource->default = $propertyNode->nodeValue;
                                        $langaugeResource->value = $propertyNode->nodeValue;
                                    } else {
                                        $langaugeResource->value = $propertyNode->nodeValue;
                                    }
                                    break;
                                case self::NodeDescription :
                                    if ($loadAll) {
                                        $langaugeResource->description = $propertyNode->nodeValue;
                                    }
                                    break;
                                case self::NodeStdPages:
                                    if ($loadAll) {
                                        foreach ($propertyNode->childNodes as $stdPageNode) {
                                            /* @var $stdPageNode DOMElement */
                                            if ($stdPageNode->nodeType === XML_ELEMENT_NODE) {
                                                if ($stdPageNode->nodeName === self::NodeStdPage) {
                                                    $langaugeResource->stdpages[$stdPageNode->getAttribute(self::NodeName)] = $stdPageNode->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    break;
                            }
                        }
                    }
                    $uid = $languageResourceNode->getAttribute(self::NodeUID);
                    $langaugeResource->js = NGUtil::StringXMLToBool($languageResourceNode->getAttribute(self::NodeJS));
                    $this->languageResources [$uid] = $langaugeResource;
                }
            }
        }

    }

    private function fullPath()
    {
        return realpath(NGUtil::joinPaths(dirname(__FILE__) . '/../../', $this->langURL));
    }
}