<?php

class NGLink
{
    public $url;

    public $uid;

    public $linkType = self::LinkUndefined;

    public $previewMode = false;

    public $absolute = false;

    public $includeDomainAndScheme = true;

    const LinkUndefined = 0;
    const LinkWWW = 1;
    const LinkMailTo = 2;
    const LinkPage = 3;
    const LinkPicture = 4;
    const LinkDownload = 5;
    const LinkTopic = 6;
    const LinkPagePopup = 7;
    const LinkTopicPopup = 8;
    const LinkTel = 9;
    const LinkStandardPage = 10;

    public function parseURL($url)
    {
        if ($url == '') {
            $this->linkType = self::LinkUndefined;
            $this->uid = '';
        } else {
            $this->linkType == self::LinkUndefined;

            $this->url = $url;
            $parts = parse_url($url);

            if ($parts ['scheme'] == 'ng') {
                switch ($parts ['host']) {
                    case 'page' :
                        $this->linkType = self::LinkPage;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                    case 'standardpage' :
                        $this->linkType = self::LinkStandardPage;
                        $this->uid = $this->resolveStandardPage(substr($parts ['path'], 1));
                        break;
                    case 'pagepopup' :
                        $this->linkType = self::LinkPagePopup;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                    case 'picture' :
                        $this->linkType = self::LinkPicture;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                    case 'download' :
                        $this->linkType = self::LinkDownload;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                    case 'topic' :
                        $this->linkType = self::LinkTopic;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                    case 'topicpopup' :
                        $this->linkType = self::LinkTopicPopup;
                        $this->uid = substr($parts ['path'], 1);
                        break;
                }
            }
            if ($parts ['scheme'] == 'http' || $parts ['scheme'] == 'https') {
                $this->linkType = self::LinkWWW;
            }
            if ($parts ['scheme'] == 'mailto') {
                $this->linkType = self::LinkMailTo;
            }
            if ($parts ['scheme'] == 'tel') {
                $this->linkType = self::LinkTel;
            }
        }
    }

    private function resolveStandardPage($uid)
    {
        $objectAdapter = new NGDBAdapterObject();
        $pages = $objectAdapter->loadSetting(NGSettingsStandardPages::IdPages, NGSettingsStandardPages::ObjectTypeSettingsStandardPages);
        if (array_key_exists($uid, $pages->pageuids) && $pages->pageuids [$uid] !== '') {
            return $pages->pageuids[$uid];
        }

        return NGUtil::ObjectUIDHomePage;
    }

    public function getURL()
    {
        if ($this->previewMode && ($this->linkType !== self::LinkTopicPopup) && ($this->linkType !== self::LinkPagePopup)) {
            return $this->getPreviewURL();
        } else {
            return $this->getWebURL();
        }
    }

    public function getUrlAndQuery($query)
    {
        $url = $this->getURL();

        foreach ($query as $key => $value) {
            $url .= (strpos($url, '?') === false) ? '?' : '&';
            $url .= $key . '=' . urlencode($value);
        }
        return $url;
    }

    private function getPreviewURL()
    {
        switch ($this->linkType) {
            case self::LinkPage :
            case self::LinkStandardPage :
                return 'ng://page/' . $this->uid;
            case self::LinkTopic :
                return 'ng://topic/' . $this->uid;
            case self::LinkPicture :
                return self::getPictureURL($this->uid);
            case self::LinkDownload :
                return self::getDownloadURL($this->uid);
            case self::LinkWWW :
                return $this->url;
        }
    }

    private function getWebURL()
    {
        switch ($this->linkType) {
            case self::LinkPage :
            case self::LinkStandardPage :
                if (NGConfig::VanityURLs) {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), self::getVanityURL($this->uid));
                    } else {
                        return NGUtil::relativePathFromCurrentPath(self::getVanityURL($this->uid));
                    }
                } else {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), '?ngp=' . $this->uid);
                    } else {
                        return '?ngp=' . $this->uid;
                    }
                }
            case self::LinkPagePopup :
                if (NGConfig::VanityURLs) {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), self::getVanityURL($this->uid)) . '?nglayout=plain';
                    } else {
                        return NGUtil::relativePathFromCurrentPath(self::getVanityURL($this->uid)) . '?nglayout=plain';
                    }
                } else {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), '?ngp=' . $this->uid) . '&nglayout=plain';
                    } else {
                        return '?ngp=' . $this->uid . '&nglayout=plain';
                    }
                }
            case self::LinkTopic :
                if (NGConfig::VanityURLs) {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), self::getVanityURL($this->uid));
                    } else {
                        return NGUtil::relativePathFromCurrentPath(self::getVanityURL($this->uid));
                    }
                } else {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), '?ngt=' . $this->uid);
                    } else {
                        return '?ngt=' . $this->uid;
                    }
                }
            case self::LinkTopicPopup :
                if (NGConfig::VanityURLs) {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), self::getVanityURL($this->uid)) . '?nglayout=plain';
                    } else {
                        return NGUtil::relativePathFromCurrentPath(self::getVanityURL($this->uid)) . '?nglayout=plain';
                    }
                } else {
                    if ($this->absolute) {
                        return NGUtil::joinPaths($this->rootUrl(), '?ngt=' . $this->uid) . '&nglayout=plain';
                    } else {
                        return '?ngt=' . $this->uid . '&nglayout=plain';
                    }
                }
            case self::LinkPicture :
                return self::getPictureURL($this->uid, -1, -1, NGPicture::RatioNone, $this->absolute);
            case self::LinkDownload :
                return self::getDownloadURL($this->uid, $this->absolute);
            case self::LinkWWW :
                return $this->url;
            case self::LinkMailTo :
                return $this->url;
            case self::LinkTel :
                return $this->url;
        }
    }

    private function rootUrl()
    {
        if ($this->includeDomainAndScheme) {
            return NGConfig::RootURL;
        } else {
            Return NGConfig::getRootPath();
        }
    }

    public function __construct($previewMode = false, $absolute = false, $includeDomainAndScheme = true)
    {
        $this->previewMode = $previewMode;
        $this->absolute = $absolute;
        $this->includeDomainAndScheme = $includeDomainAndScheme;
    }

    public static function getPictureURL($uid, $maxWidth = -1, $maxHeight = -1, $ratio = NGPicture::RatioNone, $absolute = false, $includeDomainAndScheme = true)
    {

        $hasQuery = false;

        if (NGConfig::VanityURLs) {
            $url = self::getVanityURL($uid);
        } else {
            $url = '?ngu=' . $uid;
            $hasQuery = true;
        }

        if ($url === '')
            return '';

        if ($absolute) {
            $url = NGUtil::joinPaths(NGUtil::joinPaths($includeDomainAndScheme ? NGConfig::RootURL : NGConfig::getRootPath(), NGConfig::FolderImages), $url);
        } else {
            $url = NGUtil::prependImagesPath($url);
        }

        if ($maxWidth != -1) {
            $url .= ($hasQuery) ? '&' : '?';
            $url .= "w=$maxWidth";
            $hasQuery = true;
        }
        if ($maxHeight != -1) {
            $url .= ($hasQuery) ? '&' : '?';
            $url .= "h=$maxHeight";
            $hasQuery = true;
        }
        if ($ratio != NGPicture::RatioNone) {
            $url .= ($hasQuery) ? '&' : '?';
            $url .= "r=$ratio";
            $hasQuery = true;
        }
        return $url;
    }

    public static function getDownloadURL($uid, $absolute = false)
    {
        if (NGConfig::VanityURLs) {
            if ($absolute) {
                return NGUtil::joinPaths(NGUtil::joinPaths(NGConfig::RootURL, NGConfig::FolderAssets), self::getVanityURL($uid));
            } else {
                return NGUtil::relativePathFromCurrentPath(NGUtil::joinPaths(NGConfig::FolderAssets, self::getVanityURL($uid)));
            }
        } else {
            if ($absolute) {
                return NGUtil::joinPaths(NGUtil::joinPaths(NGConfig::RootURL, NGConfig::FolderAssets), self::getVanityURL('?ngu=' . $uid));
            } else {
                return NGUtil::prependAssetsPath('?ngu=' . $uid);
            }
        }
    }

    public static function getLinkToHome($previewMode)
    {
        $link = new NGLink ($previewMode);
        $link->linkType = self::LinkTopic;
        $link->uid = NGUtil::ObjectUIDRootHome;
        return $link->getURL();
    }

    public static function getVanityURL($objectUID)
    {
        $adapter = new NGDBAdapterObject ();

        try {

            $parts = $adapter->loadAncestors($objectUID, '', true, true, true);

        } catch (Exception $ex) {
            return '';
        }

        $url = '';

        foreach ($parts as $part) {
            /* @var $part NGObjectNamed */

            switch ($part->class) {
                case NGTopic::ObjectTypeTopic :
                case NGTopic::ObjectTypeFolder :
                    if ($part->nameForURL() !== '')
                        $url .= $part->nameForURL() . '/';
                    break;
                case NGPicture::ObjectTypePicture :
                case NGDownload::ObjectTypeDownload :
                case NGPluginPage::ObjectTypePluginPage :
                    $url .= ($part->nameForURL());
                    break;
            }
        }

        return $url;
    }

    /**
     *
     * Resolves a vanity url
     * @param string $url
     * @param string $folderType
     * @param string $itemType
     * @return NGResolveVanityURLResult
     */
    public static function resolveVanityURL($url, $folderType, $itemType, $rootUID)
    {

        $urlCache = new NGURLCache ();

        $resultCached = $urlCache->lookupURL($url, $rootUID);


        if ($resultCached !== null) {
            return $resultCached;
        } else {
            $result = new NGResolveVanityURLResult ();

            $adapter = new NGDBAdapterObject ();
            $parts = explode('/', $url);
            $currentDepth = 0;
            $stepsToRoot = 0;
            $currentUID = $rootUID;
            $folderUID = '';

            do {
                if ($currentDepth >= count($parts) - 1)
                    break;

                try {
                    $childFolders = $adapter->loadChildObjects($currentUID, $folderType, NGObjectNamed::ObjectTypeObjectNamed);
                } catch (Exception $ex) {
                    return null;
                }

                $found = false;

                foreach ($childFolders as $childFolder) {
                    /* @var $childFolder NGObjectNamed */

                    if ($childFolder->nameForURL() === $parts [$currentDepth]) {
                        $currentUID = $childFolder->objectUID;

                        if ($parts [$currentDepth] !== '')
                            $stepsToRoot++;

                        $currentDepth++;

                        $found = true;
                        break;
                    }
                }

                if (!$found)
                    return null;

            } while (true);

            if ($parts [count($parts) - 1] === '') {
                $result->folderUID = $currentUID;
            } else {
                $childItems = $adapter->loadChildObjects($currentUID, $itemType, NGObjectNamed::ObjectTypeObjectNamed);
                $found = false;

                foreach ($childItems as $childItem) {
                    /* @var $childPage NGPluginPage */

                    if ($childItem->name === $parts [count($parts) - 1]) {
                        $currentUID = $childItem->objectUID;
                        $found = true;
                        break;
                    }

                    if (NGConfig::AcceptPHPExtension) {
                        if (substr($childItem->name, -5) === '.html') {
                            if (substr($childItem->name, 0, -5) . '.php' === $parts [count($parts) - 1]) {
                                $currentUID = $childItem->objectUID;
                                $found = true;
                                break;
                            }
                        }
                        if (substr($childItem->name, -4) === '.php') {
                            if (substr($childItem->name, 0, -4) . '.html' === $parts [count($parts) - 1]) {
                                $currentUID = $childItem->objectUID;
                                $found = true;
                                break;
                            }
                        }
                    }

                }

                if (!$found)
                    return null;

                $result->itemUID = $currentUID;
            }

            $result->stepsToRoot = $stepsToRoot;

            $urlCache->storeURL($url, $rootUID, $result);

            return $result;
        }
    }
}

class NGResolveVanityURLResult
{
    public $folderUID = '';
    public $itemUID = '';
    public $stepsToRoot = 0;
}