<?php

/**
 *
 * Renders a robots.txt file
 *
 */
class NGRenderRobots
{
    /**
     *
     * DB Adapter
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     * @var bool
     */
    private $noDisallows = true;

    /**
     *
     * Render the whole robots.txt
     */
    public function renderRobots()
    {

        header("Content-Type: text/plain");

        echo('User-agent: *');

        if ($this->doNotIndex(NGSettingsSite::getInstance()->metaTags)) {
            $this->disallowUrl(NGConfig::RootURL);
        } else {
            $this->adapter = new NGDBAdapterObject ();
            $content = $this->adapter->loadObject(NGUtil::ObjectUIDRootHome, null, 'NGRobotsItem', '');
            $this->addItem($content, NGConfig::RootURL);
            $common = $this->adapter->loadObject(NGUtil::ObjectUIDRootCommon, null, 'NGRobotsItem', '');
            $this->addItem($common, NGConfig::RootURL);
        }

        if ($this->noDisallows)
        {
            echo("\r\nDisallow:");
        }
    }

    /**
     *
     * Do not index item
     * @param array $metaTags
     */
    private function doNotIndex($metaTags)
    {
        if (array_key_exists('robots', $metaTags)) {
            if (strpos($metaTags ['robots'], 'noindex') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     *
     * Add a item
     * @param NGRobotsItem $item
     * @param string $url
     */
    public function addItem($item, $url)
    {

        if ($item->objectUID === NGUtil::ObjectUIDRootHome) {
            $itemUrl = NGUtil::joinPaths($url, NGConfig::FolderContent);
            $itemUrl = NGUtil::joinPaths($itemUrl, '/');
        } else {
            if (NGConfig::VanityURLs) {
                $itemUrl = NGUtil::joinPaths($url, $item->name);
                if ($item->class === 'NGTopic')
                    $itemUrl = NGUtil::joinPaths($itemUrl, '/');
            } else {
                $itemUrl = NGConfig::RootURL . '?t=' . $item->objectUID;
            }
        }

        if ($this->doNotIndex($item->metaTags)) {
            if ($item->objectUID === NGUtil::ObjectUIDRootHome) {
                $this->disallowUrl(NGConfig::RootURL);
                return false;
            } else {
                $this->disallowUrl($itemUrl);
                return false;
            }
        }

        if ($item->class === 'NGTopic') {
            $subpages = $this->adapter->loadChildObjects($item->objectUID, 'NGPluginPage', 'NGRobotsItem', '');
            foreach ($subpages as $subpage) {

                $this->addItem($subpage, $itemUrl);
            }
            $subtopics = $this->adapter->loadChildObjects($item->objectUID, 'NGTopic', 'NGRobotsItem', '', true);
            foreach ($subtopics as $subtopic) {
                $this->addItem($subtopic, $itemUrl);
            }
        }

        return true;
    }

    public function disallowUrl($url)
    {
        printf("\r\nDisallow: %s", parse_url($url, PHP_URL_PATH));
        $this->noDisallows = false;
    }
}

/**
 *
 * Simple class to store information about item
 *
 */
class NGRobotsItem extends NGObjectMapped
{
    const DomainName = 'name';
    const DomainFolder = 'folder';

    public $name = '';
    public $metaTags = array();

    protected function getPropertiesMapped()
    {
        $this->propertiesMapped [] = new NGPropertyMapped ('name', NGProperty::TypeString, self::DomainName, 'name', NGPropertyMapped::MultiplicityScalar, false, '', true);
        $this->propertiesMapped [] = new NGPropertyMapped ('metatags', NGProperty::TypeString, NGUtil::DomainSEO, 'metaTags', NGPropertyMapped::MultiplicityDictornary, true);
    }
}