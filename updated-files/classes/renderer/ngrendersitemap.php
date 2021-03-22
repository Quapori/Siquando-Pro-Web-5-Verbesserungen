<?php

/**
 *
 * Renders an XML Sitemap
 *
 */
class NGRenderSitemap
{
    /**
     *
     * DB Adapter
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     *
     * Sitemap Document to create
     * @var DOMDocument
     */
    private $document;

    /**
     *
     * Render the whole sitemap
     */
    public function renderSitemap()
    {
        $this->adapter = new NGDBAdapterObject ();
        $this->document = new DOMDocument ('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $this->document->appendChild($this->document->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset'));

        $content = $this->adapter->loadObject(NGUtil::ObjectUIDRootHome, null, 'NGSitemapTopic', '');
        $this->addTopic($content, NGConfig::RootURL, '0.5', 'weekly');
        $common = $this->adapter->loadObject(NGUtil::ObjectUIDRootCommon, null, 'NGSitemapTopic', '');
        $this->addTopic($common, NGConfig::RootURL, '0.5', 'weekly');

        NGUtil::XMLHeader();

        echo $this->document->saveXML();
    }

    /**
     *
     * Add a topic
     * @param NGSitemapTopic $topic
     * @param string $url
     * @param string $priority
     * @param string $changefreq
     */
    public function addTopic($topic, $url, $priority, $changefreq)
    {

        if ($topic->sitemapinclude && !$topic->hide && NGUtil::isCurrentDateBetween($topic->visibleFrom, $topic->visibleTo)) {
            $nodeUrl = $this->document->createElement('url');

            $this->document->documentElement->appendChild($nodeUrl);

            if (NGConfig::VanityURLs) {
                if ($topic->objectUID === NGUtil::ObjectUIDRootHome) {
                    $topicUrl = NGUtil::joinPaths($url, NGConfig::FolderContent);
                } else {
                    $topicUrl = NGUtil::joinPaths($url, $topic->name);
                }
                $topicUrl = NGUtil::joinPaths($topicUrl, '/');
            } else {
                $topicUrl = NGConfig::RootURL . '?t=' . $topic->objectUID;
            }

            if ($topic->objectUID === NGUtil::ObjectUIDRootHome) {
                $nodeUrl->appendChild($this->document->createElement('loc', NGConfig::RootURL));
            } else {
                $nodeUrl->appendChild($this->document->createElement('loc', $topicUrl));
            }

            $topicPriority = $topic->sitemappriority == '' ? $priority : $topic->sitemappriority;
            $nodeUrl->appendChild($this->document->createElement('priority', $topicPriority));

            $topicChangefreq = $topic->sitemapchangefreq == '' ? $changefreq : $topic->sitemapchangefreq;
            $nodeUrl->appendChild($this->document->createElement('changefreq', $topicChangefreq));

            $subpages = $this->adapter->loadChildObjects($topic->objectUID, 'NGPluginPage', 'NGSitemapPage', '');

            $indexPage = null;

            foreach ($subpages as $subpage) {

                if ($indexPage === null) {
                    $indexPage = $subpage;
                } else {
                    if ($subpage->objectUID == $topic->indexUID)
                        $indexPage = $subpage;
                }
            }

            if ($indexPage !== null) {
                $lastmod = $this->getlastmod($indexPage);
                $nodeUrl->appendChild($this->document->createElement('lastmod', $lastmod));
            }

            foreach ($subpages as $subpage) {
                if ($subpage !== $indexPage) {
                    $this->addPage($subpage, $topicUrl, $topicPriority, $topicChangefreq);
                }
            }

            $subtopics = $this->adapter->loadChildObjects($topic->objectUID, 'NGTopic', 'NGSitemapTopic', '', true);

            foreach ($subtopics as $subtopic) {
                $this->addTopic($subtopic, $topicUrl, $topicPriority, $topicChangefreq);
            }
        }
    }

    /**
     *
     * Add a page
     * @param NGSitemapPage $page
     * @param string $url
     * @param string $priority
     * @param string $changefreq
     */
    public function addPage($page, $url, $priority, $changefreq)
    {
        if ($page->sitemapinclude && !$page->hide && NGUtil::isCurrentDateBetween($page->visibleFrom, $page->visibleTo)) {
            $nodeUrl = $this->document->createElement('url');

            $this->document->documentElement->appendChild($nodeUrl);

            if (NGConfig::VanityURLs) {
                $nodeUrl->appendChild($this->document->createElement('loc', $url . $page->name));
            } else {
                $nodeUrl->appendChild($this->document->createElement('loc', NGConfig::RootURL . '?p=' . $page->objectUID));
            }

            $pagePriority = $page->sitemappriority == '' ? $priority : $page->sitemappriority;
            $nodeUrl->appendChild($this->document->createElement('priority', $pagePriority));

            $pageChangefreq = $page->sitemapchangefreq == '' ? $changefreq : $page->sitemapchangefreq;
            $nodeUrl->appendChild($this->document->createElement('changefreq', $pageChangefreq));

            $lastmod = $this->getlastmod($page);
            $nodeUrl->appendChild($this->document->createElement('lastmod', $lastmod));
        }
    }

    /**
     *
     * Get last modification of a given object
     * @param NGObject $element
     * @param lastmod $lastmod
     */
    public function getlastmod($element, $lastmod = '')
    {
        if ($lastmod === '' || $lastmod < $element->changeDate)
            $lastmod = $element->changeDate;

        $children = $this->adapter->loadChildObjects($element->objectUID, null, 'NGObject', '', false, false, false);

        foreach ($children as $child) {
            $lastmod = $this->getlastmod($child, $lastmod);
        }

        return $lastmod;
    }
}

/**
 *
 * Simple class to store information about sitemap page
 *
 */
class NGSitemapPage extends NGObjectMapped
{
    const DomainName = 'name';
    const DomainPage = 'page';

    public $name = '';
    public $visibleFrom = '';
    public $visibleTo = '';
    public $hide = false;

    public $sitemapinclude = true;
    public $sitemappriority = '';

    public $sitemapchangefreq = '';

    protected function getPropertiesMapped()
    {
        $this->propertiesMapped [] = new NGPropertyMapped ('name', NGProperty::TypeString, self::DomainName, 'name', NGPropertyMapped::MultiplicityScalar, false, '', true);
        $this->propertiesMapped [] = new NGPropertyMapped ('visiblefrom', NGProperty::TypeDateTime, self::DomainPage, 'visibleFrom', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('visibleto', NGProperty::TypeDateTime, self::DomainPage, 'visibleTo', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('hide', NGProperty::TypeBool, self::DomainPage, 'hide', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemapinclude', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemapinclude', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemapchangefreq', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemapchangefreq', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemappriority', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemappriority', NGPropertyMapped::MultiplicityScalar, false, '', false);
    }
}

/**
 *
 * Simple class to store information about sitemap topic
 *
 */
class NGSitemapTopic extends NGObjectMapped
{

    const DomainName = 'name';
    const DomainFolder = 'folder';
    const DomainTopic = 'topic';

    public $name = '';
    public $visibleFrom = '';
    public $visibleTo = '';
    public $hide = false;
    public $sitemapinclude = true;
    public $sitemappriority = '';
    public $sitemapchangefreq = '';
    public $indexUID = '';

    protected function getPropertiesMapped()
    {
        $this->propertiesMapped [] = new NGPropertyMapped ('name', NGProperty::TypeString, self::DomainName, 'name', NGPropertyMapped::MultiplicityScalar, false, '', true);
        $this->propertiesMapped [] = new NGPropertyMapped ('visiblefrom', NGProperty::TypeDateTime, self::DomainFolder, 'visibleFrom', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('visibleto', NGProperty::TypeDateTime, self::DomainFolder, 'visibleTo', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('hide', NGProperty::TypeBool, self::DomainFolder, 'hide', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemapinclude', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemapinclude', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemapchangefreq', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemapchangefreq', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sitemappriority', NGProperty::TypeString, NGUtil::DomainSEO, 'sitemappriority', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('indexuid', NGProperty::TypeUID, self::DomainTopic, 'indexUID');
    }
}