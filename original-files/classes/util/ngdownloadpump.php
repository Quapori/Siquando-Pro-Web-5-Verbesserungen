<?php

/**
 *
 * Pumps downloads and delivers them
 *
 *
 */
class NGDownloadPump
{

    /**
     *
     * Loaded picture
     * @var NGDownload
     */
    public $download;

    /**
     *
     * Adapter to load download
     * @var NGDBAdapterObject
     */
    public $downloadAdapter;

    /**
     *
     * UID of download to load
     * @var string
     */
    public $uid = '';

    /**
     *
     * Url of download
     * @var string
     */
    public $url = '';

    /**
     *
     * Pumps the image and outputs it
     */
    public function pumpDownload()
    {

        if (NGConfig::VanityURLs) {
            if ($this->url != '') {

                $result = NGLink::resolveVanityURL($this->url, NGFolder::ObjectTypeFolder, NGDownload::ObjectTypeDownload, NGUtil::ObjectUIDRootAssets);

                if ($result === null)
                    NGUtil::HeaderNotFound();
                $this->uid = $result->itemUID;
            }
        }

        $this->download = $this->downloadAdapter->loadObject($this->uid, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload);

        if ($this->download == null)
            NGUtil::HeaderNotFound();

        header('Content-Type: ' . NGMime::getMimeType($this->download->name));
        header('Content-Disposition: attachment; filename="' . $this->download->name . '"');

        readfile(NGConfig::storePath() . $this->download->pathToFile());
    }

    /**
     *
     * Constructor
     */
    public function __construct()
    {
        NGSession::getInstance()->user = NGUser::getUserSystem();
        NGDBConnector::getInstance()->connect();

        $this->downloadAdapter = new NGDBAdapterObject ();
    }
}