<?php

class NGPluginParagraphConsent extends NGPluginParagraph
{
    const ObjectTypePluginParagraphConsent = 'NGPluginParagraphConsent';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphConsent = 'paragraphconsent';

    /**
     *
     * Template engine
     * @var NGTemplate
     */
    private $template;

    /**
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     * @var string
     */
    public $items = '';


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeFulltext, self::DomainParagraphConsent, 'items', NGPropertyMapped::MultiplicityScalar, true, '');
    }

    public function render()
    {
        if (NGSettingsSite::getInstance()->showcookiewarning) {

            /* @var $items NGPluginParagraphFoodMenuItem[] */
            $items = array();


            if ($this->items != '') {

                $richtext = new NGRichText();
                $richtext->previewMode = $this->previewMode;


                $xml = new DOMDocument ('1.0', 'UTF-8');
                $xml->loadXML($this->items);

                foreach ($xml->documentElement->childNodes as $nodeItem) {
                    /* @var $nodeItem DOMNode */
                    if ($nodeItem->nodeType === XML_ELEMENT_NODE) {
                        if ($nodeItem->nodeName == 'item') {
                            $item = new NGPluginParagraphConsentItem();
                            $items[] = $item;

                            foreach ($nodeItem->childNodes as $node) {
                                /* @var $node DOMNode */
                                if ($node->nodeType === XML_ELEMENT_NODE) {
                                    if ($node->nodeName == 'caption') $item->caption = $node->nodeValue;
                                    if ($node->nodeName == 'id') $item->id = $node->nodeValue;
                                    if ($node->nodeName == 'summary') $item->summary = $richtext->parse($node->nodeValue);
                                    if ($node->nodeName == 'essential') $item->essential = NGUtil::StringXMLToBool($node->nodeValue);
                                }
                            }
                        }
                    }

                    if (count($items) > 0) {
                        $this->template = new NGTemplate ();

                        $this->lang = new NGLanguageAdapter ();
                        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphconsent/language/langconsent.xml';
                        $this->lang->load();

                        $this->template->assign('lang', $this->lang->languageResources);
                        $this->template->assign('items', $items);

                        $nonessential=false;

                        foreach ($items as $item) {
                            if (!$item->essential) {
                                $nonessential=true;
                                break;
                            }
                        }

                        $this->template->assign('nonessential', $nonessential);


                        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphconsent/tpl/template.tpl');

                        $this->javaScripts ['ngpluginparagraphconsent'] = $this->prependPluginsPath('ngpluginparagraphconsent/js/consent.js');
                        $this->styleSheets ['ngpluginparagraphconsent'] = $this->prependPluginsPath('ngpluginparagraphconsent/css/');
                    }
                }
            }
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGPluginParagraphConsentItem
{
    public $caption = '';
    public $summary = '';
    public $id='';
    public $essential=false;

}