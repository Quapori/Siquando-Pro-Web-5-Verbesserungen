<?php

class NGRenderNavigation
{
    public $previewMode = false;
    public $useSpan = false;
    public $renderIcon = true;
    public $classHome = null;
    public $divOnDepth = -1;
    public $cartIndicator = true;
    public $uidCartIndicator='';


    /**
     * @var NGPluginIcon
     */
    public $icon = null;

    public function renderList($rootItem, $maxDepth = 999, $includeRootItem = false, $activeTopicUid = '')
    {

        $out = '';

        /* @var $rootItem NGNavItem */

        if ($rootItem === null)
            return $out;

        if ($includeRootItem) {
            $renderA = new NGRenderA ();
            $renderLI = NGRenderTag::create('li');
            $renderLI->class = $this->classHome;

            if ($this->useSpan) {
                $renderSpan = NGRenderTag::create('span');
                $renderSpan->content = $rootItem->caption;
                $renderA->content = $renderSpan->render();
            } else {
                $renderA->content = $rootItem->caption;
            }
            $renderA->href = $rootItem->fullURL($this->previewMode);

            $renderLI->content = $renderA->render();
            $out = $renderLI->render() . "\r\n";
        }

        return $out . $this->renderSubItemsAsList($rootItem, false, 0, $maxDepth, $activeTopicUid);
    }

    private function renderSubItemsAsList(NGNavItem $navItem, $asUL = true, $currentDepth, $maxDepth, $activeTopicUid)
    {
        $renderA = new NGRenderA ();
        $renderLI = NGRenderTag::create('li');

        $currentDepth++;

        if ($currentDepth > $maxDepth)
            return '';

        $output = '';
        /* @var $child NGNavItem */
        foreach ($navItem->children as $child) {

            $content = $child->caption;

            if ($this->renderIcon) {

                if ($this->icon === null) {
                    $this->icon = new NGPluginIcon();
                    $this->icon->class = 'sqpnavicon';
                }

                $content = $this->icon->getSvg($child->icon) . $content;
            }

            if ($child->objectUID===$this->uidCartIndicator) {
                $renderEm = NGRenderTag::create('em');
                $renderEm->class='ngshopcartindicator';
                $content.=$renderEm->render();
            }

            if ($this->useSpan) {
                $renderSpan = NGRenderTag::create('span');
                $renderSpan->content = $content;
                $renderA->content = $renderSpan->render();
            } else {
                $renderA->content = $content;
            }

            $renderA->href = $child->fullURL($this->previewMode);

            $renderLI->content = $renderA->render();

            if ($child->objectUID === $activeTopicUid) {
                $renderLI->class = 'active';
            } else {
                $renderLI->class = null;
            }
            $renderLI->content .= $this->renderSubItemsAsList($child, true, $currentDepth, $maxDepth, $activeTopicUid);

            $output .= $renderLI->render() . "\r\n";
        }

        if ($asUL) {
            if ($output != '') {
                $renderUL = NGRenderTag::create('ul');
                $renderUL->content = "\r\n" . $output;
                if ($this->divOnDepth === $currentDepth) {
                    $renderDIV = new NGRenderTag('div');
                    $renderDIV->content = "\r\n" . $renderUL->render() . "\r\n";
                    return "\r\n" . $renderDIV->render() . "\r\n";
                } else {
                    return "\r\n" . $renderUL->render() . "\r\n";
                }
            }
        } else {
            return $output;
        }
    }
}