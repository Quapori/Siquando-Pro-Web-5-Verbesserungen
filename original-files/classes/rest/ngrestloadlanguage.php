<?php

class NGRestLoadLanguage extends NGRest
{
    const NodeLanguageURL = 'languageurl';

    /**
     *
     * Language Adapter to use
     * @var NGLanguageAdapter
     */
    private $languageAdapter;

    private $langURL = '';

    /* (non-PHPdoc)
     * @see NGRest::handleRequest()
     */
    function handleRequest()
    {
        $this->languageAdapter = new NGLanguageAdapter();
        $this->languageAdapter->langURL = $this->langURL;
        $this->languageAdapter->load(true);
    }

    /* (non-PHPdoc)
     * @see NGRest::loadRequest()
     */
    function loadRequest()
    {
        foreach ($this->requestDocument->documentElement->childNodes as $requestNode) {

            /* @var $requestNode DOMElement */
            if ($requestNode->nodeType == XML_ELEMENT_NODE) {
                if ($requestNode->nodeName == self::NodeLanguageURL) {
                    $this->langURL = $requestNode->nodeValue;
                }
            }
        }
    }

    /* (non-PHPdoc)
     * @see NGRest::saveResponse()
     */
    function saveResponse()
    {
        $dictionaryElement = $this->appendElement(
            $this->responseDocument->documentElement,
            NGLanguageAdapter::NodeLanguageResourceDictionary,
            null,
            array(
                NGLanguageAdapter::NodeCaption => $this->languageAdapter->caption,
                NGLanguageAdapter::NodeUID => $this->languageAdapter->uid,
            )
        );

        foreach ($this->languageAdapter->languageResources as $uid => $languageResource) {
            $this->saveLanguageResource($dictionaryElement, $languageResource, $uid);
        };
    }

    private function saveLanguageResource(DOMElement $parentElement, NGLanguageResource $languageResource, $uid)
    {
        $languageResourceElement = $this->appendElement(
            $parentElement,
            NGLanguageAdapter::NodeLanguageResource,
            null,
            array(
                NGLanguageAdapter::NodeUID => $uid
            )
        );

        $this->appendElement($languageResourceElement, NGLanguageAdapter::NodeCaption, $languageResource->caption);
        $this->appendElement($languageResourceElement, NGLanguageAdapter::NodeValue, $languageResource->value);
        $this->appendElement($languageResourceElement, NGLanguageAdapter::NodeDefault, $languageResource->default);
        $this->appendElement($languageResourceElement, NGLanguageAdapter::NodeDescription, $languageResource->description);

        if (count($languageResource->stdpages) > 0) {
            $stdPagesElement = $this->appendElement($languageResourceElement, NGLanguageAdapter::NodeStdPages);
            foreach ($languageResource->stdpages as $stdPageName => $stdPageValue) {
                $this->appendElement($stdPagesElement, NGLanguageAdapter::NodeStdPage, $stdPageValue, [NGLanguageAdapter::NodeName => $stdPageName]);
            }
        }
    }


    /* (non-PHPdoc)
     * @see NGRest::loginRequired()
     */
    function loginRequired()
    {
        return true;
    }

    /* (non-PHPdoc)
     * @see NGRest::loginRequired()
     */
    function connectionRequired()
    {
        return true;
    }
}
	