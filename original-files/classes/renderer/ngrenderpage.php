<?php

/**
 *
 * Displays a page
 *
 */
class NGRenderPage
{

    public $previewMode = false;

    public $topicUID = '';

    public $pageUID = '';

    public $url = '';

    public $layout = '';

    /**
     *
     * Session being used
     * @var NGSession
     */
    private $session;

    private $allowedCookies = array();

    /**
     * @var string|null
     */
    private $cookieMessage = null;

    /**
     * @var strig|null
     */
    private $allowCookieLink = null;

    /**
     *
     * Page cache
     * @var NGPageCache
     */
    private $pageCache;

    public function render()
    {
        if (NGConfig::VanityURLs) {
            if ($this->url != '') {
                $result = NGLink::resolveVanityURL($this->url, NGTopic::ObjectTypeTopic, NGPluginPage::ObjectTypePluginPage, NGUtil::ObjectUIDRootContent);
                if ($result === null) {
                    if (!$this->previewMode && NGConfig::ForwardMissingTrailingSlash && substr($this->url, -1) !== '/') {
                        $result = NGLink::resolveVanityURL($this->url . '/', NGTopic::ObjectTypeTopic, NGPluginPage::ObjectTypePluginPage, NGUtil::ObjectUIDRootContent);
                        if ($result !== null) {
                            NGUtil::HeaderMovedPermanently(NGUtil::joinPaths(NGConfig::RootURL, $this->url . '/'));
                        }
                    }

                    NGUtil::HeaderNotFound();
                }
                $this->topicUID = $result->folderUID;
                $this->pageUID = $result->itemUID;

                NGSession::getInstance()->stepsToRoot = $result->stepsToRoot;
                NGSession::getInstance()->currentPath = $this->url;
            }
        }

        if (!$this->previewMode) {
            if (file_exists(NGConfig::pluginsPath() . '/ngpluginunderconstruction/ngpluginunderconstructionbase.php')) {
                include_once NGConfig::pluginsPath() . '/ngpluginunderconstruction/ngpluginunderconstructionbase.php';

                if (NGPluginUnderConstructionBase::getIsEnabled()) {
                    include_once NGConfig::pluginsPath() . '/ngpluginunderconstruction/ngpluginunderconstruction.php';

                    NGPluginUnderConstruction::render();

                    return;
                }
            }
        }

        if ($this->pageUID != '') {
            $this->loadAndRenderPage($this->pageUID);
        } else {
            if ($this->topicUID != '') {
                $this->loadAndRenderTopic($this->topicUID);
            } else {
                $this->loadAndRenderTopic(NGUtil::ObjectUIDRootHome);
            }
        }
    }

    private function loadAndRenderTopic($uid)
    {

        $topicController = new NGDBAdapterObject ();
        /* @var $topic NGTopic */
        $topic = $topicController->loadObject($uid, NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);

        if ($topic === null)
            NGUtil::HeaderNotFound();

        $controller = new NGDBAdapterObject ();
        $pages = $controller->loadChildObjects($uid, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage, '');

        $pageFound = null;

        foreach ($pages as $page) {
            if ($pageFound === null) {
                $pageFound = $page;
            } else {
                if ($page->objectUID == $topic->indexUID)
                    $pageFound = $page;
            }
        }

        if ($pageFound === null)
            NGUtil::HeaderNotFound();

        $this->renderPage($pageFound);
    }

    private function loadAndRenderPage($uid)
    {
        $controller = new NGDBAdapterObject ();

        $page = $controller->loadObject($uid, NGPluginPage::ObjectTypePluginPage, NGPluginPage::ObjectTypePluginPage, '', true, false, false, false);

        if ($page === null)
            NGUtil::HeaderNotFound();

        $this->renderPage($page);
    }

    public function renderPage(NGPluginPage $page)
    {

        if ($page->forward !== '') {
            header('Location: ' . $page->forward);
            exit ();
        }

        if (!$this->previewMode && NGConfig::SSLURL != '' && $page->sslmode != NGPluginPage::SSLModeKeep) {
            if (array_key_exists('ngsetproto', $_GET)) {
                if (array_key_exists(NGUtil::SessionName, $_GET))
                    NGUtil::startSession();
            } else {
                $setssl = NGUtil::prependRootPath('classes/util/setssl/');

                $query = '';

                foreach ($_GET as $key => $value) {
                    $query .= ($query == '') ? '?' : '&';
                    $query .= $key . '=' . $value;
                }

                NGUtil::Forward($setssl . '?ngproto=' . ($page->sslmode == NGPluginPage::SSLModeSSL ? 'ssl' : 'http') . '&ngurl=' . urlencode($this->url . $query), $this->previewMode);
                exit ();
            }
        }

        $access = new NGAccess ();
        $access->previewMode = $this->previewMode;
        if (!$access->handleAccess($page->parentUID, $page->objectUID))
            return;

        NGUtil::DefaultHTMLHeaders();

        $this->pageCache->objectUID = $page->objectUID;
        $this->pageCache->revisionUID = $page->revisionUID;
        $this->pageCache->previewMode = $this->previewMode;
        $this->pageCache->layout = $this->layout;
        $this->pageCache->stepsToRoot = NGSession::getInstance()->stepsToRoot;

        if ($this->pageCache->fetch()) {
            echo($this->applyConsent($this->pageCache->output));
        } else {
            $layout = NGPluginLayout::create($this->layout);
            $layout->previewMode = $this->previewMode;
            $layout->page = $page;
            $layout->render();

            if (!$layout->page->dontCache) {
                $this->pageCache->output = $layout->output;
                $this->pageCache->valid = $layout->nextScheduledChange;

                $this->pageCache->store();
            }
            echo($this->applyConsent($layout->output));
        }
    }

    /**
     * @param $page
     * @return string
     */
    private function applyConsent($page)
    {
        if (NGSettingsSite::getInstance()->showcookiewarning) {
            if (array_key_exists('ngcc', $_COOKIE)) {
                $this->allowedCookies = explode(',', $_COOKIE['ngcc']);
            }

            $page = preg_replace_callback('/<!-- START-NGCON(-MSG)? \[(.*?)\] -->(.*?)<!-- END-NGCON -->/s', array($this, 'filterCookie'), $page);
        }

        return $page;

    }

    /**
     * @param $match
     * @return string
     */
    private function filterCookie($match)
    {
        if (in_array('*', $this->allowedCookies) || in_array($match[2], $this->allowedCookies)) {
            return $match[3];
        } else {
            if ($match[1]==='-MSG')
            {
                return ($this->getCookieMessage($match[2]));
            } else {
                return ('');
            }
        }
    }

    private function getCookieMessage($cookieid)
    {
        if ($this->cookieMessage===null) {
            if (NGSettingsSite::getInstance()->cookiemessage==='')
            {
                $this->cookieMessage='';
            } else {
                $richText = new NGRichText();
                $richText->previewMode = $this->previewMode;
                $richText->absolute = true;

                $div = new NGRenderTag('div');
                $div->style->selectors['margin']='20px';
                $div->content=$richText->parse(NGSettingsSite::getInstance()->cookiemessage);

                $this->cookieMessage= $div->render();
            }

            if ($this->allowCookieLink===null) {
                $a = new NGRenderA();
                $a->class='ngcookieallow';
                $a->href='#';
                $a->attributes['data-ngcookieid']='[cookieid]';
                $a->content= htmlspecialchars(NGSession::getInstance()->getLanguageRessource(NGUtil::LanguageResourcesMain)['allowcookie']->value);

                $p = new NGRenderTag('p');
                $p->style->selectors['text-align']='center';

                $p->content=$a->render();

                $this->allowCookieLink= $p->render();
            }
        }


        return $this->cookieMessage. str_replace('[cookieid]', $cookieid, $this->allowCookieLink);
    }


    public function __construct()
    {
        $this->pageCache = new NGPageCache ();
    }
}