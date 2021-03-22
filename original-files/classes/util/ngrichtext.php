<?php

class NGRichText
{
    public $previewMode = false;

    public $absolute = false;

    public $includeDomainAndScheme = true;

    public $icons = true;

    private $link;

    /**
     * @var NGPluginIcon
     */
    private $icon = null;

    /**
     *
     * XML Document
     * @var DOMDocument
     */
    private $doc;

    /**
     *
     * XPath Parser
     * @var DOMXPath
     */
    private $xpath;

    /**
     * @var NGDBAdapterObject
     */
    private $objectAdapter;

    public function parse($text)
    {

        $this->doc = new DOMDocument ('1.0', 'UTF-8');
        $this->doc->loadXML('<html>' . $text . '</html>');

        $this->xpath = new DOMXPath ($this->doc);

        $this->link = new NGLink ($this->previewMode, $this->absolute, $this->includeDomainAndScheme);

        // Parse links
        $links = $this->xpath->query('//a[@href]');
        if ($links != null) {

            foreach ($links as $link) {
                /* @var $link DOMElement */
                $this->link->parseURL($link->getAttribute('href'));
                $link->setAttribute('href', $this->link->getURL());

                if ($this->link->linkType == NGLink::LinkPicture) {
                    $link->setAttribute('class', 'gallery');
                } else if ($this->link->linkType == NGLink::LinkPagePopup || $this->link->linkType == NGLink::LinkTopicPopup) {
                    $link->setAttribute('class', 'galleryiframe');
                } else if ($this->link->linkType == NGLink::LinkWWW || ($this->link->linkType == NGLink::LinkStandardPage && !$this->previewMode)) {
                    $link->setAttribute('target', '_blank');
                } else if ($this->link->linkType == NGLink::LinkDownload) {
                    if ($this->icons) {
                        if ($this->objectAdapter === null) {
                            $this->objectAdapter = new NGDBAdapterObject();
                        }

                        /* @var $download NGDownload */
                        $download = $this->objectAdapter->loadObject($this->link->uid, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);

                        if ($download !== null) {
                            if ($download->icon !== '') {
                                if ($this->icon === null) {
                                    $this->icon = new NGPluginIcon();
                                    $this->icon->class = 'sqplinkicon';
                                }

                                $fragment = $this->doc->createDocumentFragment();
                                $fragment->appendXML($this->icon->getSvg($download->icon));

                                $link->insertBefore($fragment, $link->firstChild);
                            }
                        }
                    }
                }

                if ($this->link->linkType===NGLink::LinkStandardPage) {
                    $link->setAttribute('class', 'nglink');
                }
            }
        }

        // Parse font stacks
        $spans = $this->xpath->query('//span[@style]');
        if ($spans !== null) {
            foreach ($spans as $span) {
                /* @var $span DOMElement */
                $style = $span->getAttribute('style');
                $newparts = array();
                $parts = explode(';', $style);
                foreach ($parts as $part) {
                    $keyvalue = explode(':', $part);
                    if (count($keyvalue) == 2 && $keyvalue [0] == 'font-family') {
                        $newparts [] = 'font-family:' . NGFontUtil::getInstance()->getFontStack($keyvalue [1]);
                    } else {
                        $newparts [] = $part;
                    }
                }
                $span->setAttribute('style', join(';', $newparts));
            }
        }

        // Fill empty paragraphs
        $ps = $this->doc->getElementsByTagName('p');

        if ($ps !== null) {
            foreach ($ps as $p) {
                /* @var $p DOMElement */

                if (!$p->hasChildNodes()) {
                    $p->appendChild($this->doc->createTextNode(''));
                }
            }
        }

        return strtr($this->doc->saveXML($this->doc->documentElement), array('<html>' => '', '</html>' => '', '<html/>' => ''));
    }

}