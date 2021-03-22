<?php

class NGRestGetURL extends NGRest
{

    const NodeItem = 'item';
    const NodeObjectUID = 'objectuid';
    const NodeObjectType = 'objecttype';
    const ObjectTypePage = 'page';
    const ObjectTypeTopic = 'topic';
    const ObjectTypePicture = 'picture';
    const ObjectTypeDownload = 'download';


    /**
     * @var NGRestGetURLItem[]
     */
    private $items = array();


    /* (non-PHPdoc)
     * @see NGRest::handleRequest()
     */
    function handleRequest()
    {
        $link = new NGLink();
        $link->previewMode = false;
        $link->absolute = true;

        foreach ($this->items as $item) {
            $link->linkType = $item->objectType;
            $link->uid = $item->objectUID;
            $item->url = $link->getURL();
        }
    }

    /* (non-PHPdoc)
     * @see NGRest::loadRequest()
     */
    function loadRequest()
    {
        foreach ($this->requestDocument->documentElement->childNodes as $itemNode) {
            /* @var $itemNode DOMElement */
            if ($itemNode->nodeType == XML_ELEMENT_NODE) {
                if ($itemNode->nodeName == self::NodeItem) {
                    $item = new NGRestGetURLItem();

                    if ($itemNode->hasAttribute(self::NodeObjectType)) {
                        switch ($itemNode->getAttribute(self::NodeObjectType)) {
                            case self::ObjectTypePage:
                                $item->objectType = NGLink::LinkPage;
                                break;
                            case self::ObjectTypeTopic:
                                $item->objectType = NGLink::LinkTopic;
                                break;
                            case self::ObjectTypeDownload:
                                $item->objectType = NGLink::LinkDownload;
                                break;
                            case self::ObjectTypePicture:
                                $item->objectType = NGLink::LinkPicture;
                                break;
                        }
                    }

                    if ($itemNode->hasAttribute(self::NodeObjectUID)) $item->objectUID = $itemNode->getAttribute(self::NodeObjectUID);

                    if ($item->objectType !== NGLink::LinkUndefined && $item->objectUID !== '') {
                        $this->items[] = $item;
                    }
                }
            }
        }
    }

    /* (non-PHPdoc)
     * @see NGRest::saveResponse()
     */
    function saveResponse()
    {
        foreach ($this->items as $item) {
            switch ($item->objectType) {
                case NGLink::LinkPage:
                    $objectType = self::ObjectTypePage;
                    break;
                case NGLink::LinkTopic:
                    $objectType = self::ObjectTypeTopic;
                    break;
                case NGLink::LinkPicture:
                    $objectType = self::ObjectTypePicture;
                    break;
                case NGLink::LinkDownload:
                    $objectType = self::ObjectTypeDownload;
                    break;
                default:
                    $objectType = '';
                    break;
            }

            $this->appendElement($this->responseDocument->documentElement, self::NodeItem, $item->url, array(
                    self::NodeObjectUID => $item->objectUID,
                    self::NodeObjectType => $objectType)
            );
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

class NGRestGetURLItem
{
    public $objectType = NGLink::LinkUndefined;
    public $objectUID = '';
    public $url = '';
}