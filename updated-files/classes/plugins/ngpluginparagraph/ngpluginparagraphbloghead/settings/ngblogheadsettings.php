<?php

class NGBlogHeadSettings extends NGSetting
{
    const IdBlogHead = 'bloghead';
    const ObjectTypeNGBlogHeadSettings = 'NGBlogHeadSettings';
    const DomainBlogHeadSettings = 'paragraphbloghead';

    public $authors = '';
    private $authorsArray;

    /**
     * @return array
     */
    public function getAuthors()
    {
        if (!isset($this->authorsArray)) {
            $this->authorsArray = array();

            if ($this->authors !== '') {
                $xml = new DOMDocument ('1.0', 'UTF-8');
                $xml->loadXML($this->authors);

                foreach ($xml->documentElement->childNodes as $itemElement) {
                    /* @var $itemElement DOMElement */
                    if ($itemElement->nodeType == XML_ELEMENT_NODE) {
                        if ($itemElement->nodeName == 'author') {
                            $author = new NGBlogHeadAuthor();

                            foreach ($itemElement->childNodes as $node) {
                                /* @var $node DOMElement */
                                if ($node->nodeType == XML_ELEMENT_NODE) {
                                    switch ($node->nodeName) {
                                        case 'authoruid' :
                                            $author->authoruid = $node->nodeValue;
                                            break;
                                        case 'caption' :
                                            $author->caption = $node->nodeValue;
                                            break;
                                        case 'pictureuid' :
                                            $author->pictureuid = $node->nodeValue;
                                            break;
                                        case 'pageuid' :
                                            $author->pageuid = $node->nodeValue;
                                            break;
                                    }
                                }
                            }

                            $this->authorsArray [] = $author;
                        }
                    }
                }
            }
        }

        return $this->authorsArray;

    }

    public function getAuthor($authoruid)
    {
        /* @var $author NGBlogHeadAuthor */
        foreach ($this->getAuthors() as $author) {
            if ($author->authoruid === $authoruid) return $author;
        }

        return null;
    }


    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('authors', NGPropertyMapped::TypeText, self::DomainBlogHeadSettings, 'authors', NGPropertyMapped::MultiplicityScalar, true, '');
    }

    public function __construct()
    {
        parent::__construct();

        $this->setId(self::IdBlogHead);
    }
}

class NGBlogHeadAuthor
{
    public $authoruid='';
    public $caption='';
    public $pictureuid='';
    public $pageuid='';
}