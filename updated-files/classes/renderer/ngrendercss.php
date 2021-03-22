<?php

class NGRenderCSS
{
    public $templateFilename;

    public $cacheId;

    public $template;

    public $disablecompression = false;

    public $output = '';

    private $cache = null;

    public function fetchFromCache()
    {
        if ($this->cacheId != '') {
            $this->cache = new NGPageCache ();
            $this->cache->objectUID = $this->cacheId;
            if ($this->cache->fetch()) {
                $this->output = $this->cache->output;
                return true;
            }
            return false;
        }
    }

    public function render()
    {
        if (!$this->fetchFromCache()) {

            if (NGConfig::DebugMode) usleep(rand(0, 100000));

            $this->output = $this->template->fetchPluginTemplate($this->templateFilename);

            if (!$this->disablecompression && NGSettingsSite::getInstance()->compress) $this->output = NGUtil::compressCSS($this->output);

            if ($this->cache !== null) {
                $this->cache->output = $this->output;
                $this->cache->store();
            }
        } else {
            $this->output = $this->template->fetchPluginTemplate($this->templateFilename);
        }
    }

    public function write()
    {
        $this->writeContentType('text/css');
    }

    public function writeContentType($contentType)
    {
        header('Content-Type: ' . $contentType . '; charset=utf-8');
        echo($this->output);
    }


    public function __construct()
    {
        $this->template = new NGTemplate ();
        $this->template->left_delimiter = '{{';
        $this->template->right_delimiter = '}}';
    }
}