<?php

class NGNavItem
{
    public $caption;
    public $objectUID;
    public $name;
    public $url;
    public $children = array();
    public $parent;
    public $level;
    public $summary;
    public $picture;
    public $icon;

    /* @var NGPicture */
    private $pictureObject;

    public static function create($objectUID, $caption, $name, $url, $parent, $level, $summary, $picture, $icon)
    {
        $navItem = new NGNavItem ();
        $navItem->objectUID = $objectUID;
        $navItem->caption = $caption;
        $navItem->name = $name;
        $navItem->url = $url;
        $navItem->parent = $parent;
        $navItem->level = $level;
        $navItem->summary = $summary;
        $navItem->picture = $picture;
        $navItem->icon = $icon;

        return $navItem;
    }

    public function findByUID($uid)
    {
        if ($this->objectUID == $uid) {
            return $this;
        } else {
            /* @var $child NGNavItem */
            foreach ($this->children as $child) {
                $hit = $child->findByUID($uid);
                if ($hit != null)
                    return $hit;
            }
            return null;
        }
    }

    public function findAchestorAtLevel($uid, $level)
    {
        if ($level == 1) return ($this->findByUID(NGUtil::ObjectUIDRootHome));

        $item = $this->findByUID($uid);

        if ($item == null) return null;

        if ($item->level < $level) return null;

        while ($item != null && $item->level > $level) {
            $item = $item->parent;
        }

        return $item;
    }

    public function fullURL($previewMode)
    {
        if ($previewMode) {
            return 'ng://topic/' . $this->objectUID;
        } else {
            if (NGConfig::VanityURLs) {
                if ($this->objectUID === NGUtil::ObjectUIDRootHome) {
                    return NGSession::getInstance()->pathToRoot();
                } else {
                    $path = NGUtil::combineAbsolutePaths(NGSession::getInstance()->currentPath, $this->url);
                    if ($path == '') $path = './';
                    return $path;
                }
            } else {
                return '?ngt=' . $this->objectUID;
            }
        }
    }

    public function pictureSource($width, $height, $crop)
    {
        return NGLink::getPictureURL($this->picture, $width, $height, $crop);
    }

    public function getPictureObject()
    {
        if (!isset($this->pictureObject)) {

            if ($this->picture === '') {
                $this->pictureObject = null;
            } else {
                $adapter = new NGDBAdapterObject();
                $this->pictureObject = $adapter->loadObject($this->picture, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);
            }
        }

        return $this->pictureObject;
    }

    public function pictureSize($width, $height, $crop)
    {

        if ($this->getPictureObject() === null) return NGSize::create(0, 0);

        return $this->getPictureObject()->getResizedSize($width, $height, $crop);
    }

}

class NGNavigation
{
    private $objectAdapter;

    public $nextVisibiltyChange = '';

    public function getNavigation($uidRoot, $objectTypeChildren)
    {
        /* @var $root NGTopic */

        $this->nextVisibiltyChange = '';

        $root = $this->objectAdapter->loadObject($uidRoot, NGTopic::ObjectTypeFolder, NGTopic::ObjectTypeFolder);

        $navItemRoot = NGNavItem::create($root->objectUID, $root->caption, $root->name, $root->nameForURL(), null, 1, '', '', '');

        return $this->getSubItems($navItemRoot, '', $objectTypeChildren, 1);
    }

    private function getSubItems(NGNavItem $navItem, $manualSort, $objectTypeChildren, $level)
    {
        $children = $this->objectAdapter->loadChildObjects($navItem->objectUID, $objectTypeChildren, $objectTypeChildren);

        if ($manualSort == '') {
            $sortedChildren = $children;
        } else {
            $sortedChildren = NGUtil::sortItems($children, $manualSort);
        }

        foreach ($sortedChildren as $child) {
            /* @var NGFolder $child */

            if ($child->isVisible()) {
                $url = $navItem->url . $child->nameForURL() . '/';

                $subItem = NGNavItem::create($child->objectUID, $child->caption, $child->name, $url, $navItem, $level, $child->summary, $child->picture, $child->icon);
                $navItem->children [] = $subItem;
                $this->getSubItems($subItem, $child->sortManualTopics, $objectTypeChildren, $level + 1);
            }

            $this->nextVisibiltyChange = NGUtil::nextDate($this->nextVisibiltyChange, $child->nextVisibilityChange());
        }

        return $navItem;
    }

    public function __construct()
    {
        $this->objectAdapter = new NGDBAdapterObject ();
    }
}