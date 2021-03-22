<?php

/**
 *
 * Pumps images and delivers them
 *
 *
 */
class NGImagePump
{

    /**
     *
     * Loaded picture
     * @var NGPicture
     */
    public $picture;

    /**
     *
     * Adapter to load picture
     * @var NGDBAdapterObject
     */
    public $pictureAdapter;

    /**
     *
     * Image tool
     * @var NGImage
     */
    public $imageTool;

    /**
     *
     * Maximal width, may be -1 for no limit
     * @var int
     */
    public $maxWidth = -1;

    /**
     *
     * Maximal height, may be -1 for no limit
     * @var int
     */
    public $maxHeight = -1;

    /**
     *
     * Ratio to crop to
     * @var int
     */
    public $ratio = NGPicture::RatioNone;

    /**
     *
     * JPEG Quality
     * @var int
     */
    public $quality = 75;

    /**
     *
     * UID of picture to load
     * @var string
     */
    public $uid = '';

    /**
     *
     * Url of picture
     * @var string
     */
    public $url = '';

    /**
     *
     * Size of picture
     * @var NGSize
     */
    public $size;

    /**
     *
     * Crop info
     * @var NGCrop
     */
    public $crop;

    /**
     *
     * Pumps the image and outputs it
     */
    public function pumpImage()
    {
        $this->quality = NGSettingsSite::getInstance()->jpegquality;

        if (NGConfig::VanityURLs) {
            if ($this->url != '') {

                $result = NGLink::resolveVanityURL($this->url, NGFolder::ObjectTypeFolder, NGPicture::ObjectTypePicture, NGUtil::ObjectUIDRootPictures);

                if ($result === null)
                    NGUtil::HeaderNotFound();
                $this->uid = $result->itemUID;
            }
        }


        $this->picture = $this->pictureAdapter->loadObject($this->uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

        if ($this->picture == null)
            NGUtil::HeaderNotFound();

        if ($this->picture->jpegquality != -1)
            $this->quality = $this->picture->jpegquality;

        if ($this->maxHeight == -1 && $this->maxWidth == -1 && $this->ratio == NGPicture::RatioNone && !$this->useWebP()) {

            NGUtil::handleEtag($this->picture->pathToWeb());

            $this->imageTool->writeHeader($this->imageTool->getType(NGConfig::storePath() . $this->picture->pathToWeb()));
            readfile(NGConfig::storePath() . $this->picture->pathToWeb());
        } else {
            $this->size = $this->picture->getResizedSize($this->maxWidth, $this->maxHeight, $this->ratio);

            if ($this->ratio != NGPicture::RatioNone)
                $this->crop = $this->picture->getCrop($this->ratio);

            NGUtil::handleEtag($this->resizedFilename());

            if (file_exists(NGConfig::storePath() . $this->resizedFilename())) {
                $this->imageTool->writeHeader($this->imageTool->getType(NGConfig::storePath() . $this->resizedFilename()));
                readfile(NGConfig::storePath() . $this->resizedFilename());
            } else {
                $this->createNewResizedImage();
            }
        }
    }

    /**
     *
     * Create a new resized image (when not in cache)
     */
    private function createNewResizedImage()
    {
        $this->imageTool->load(NGConfig::storePath() . $this->picture->pathToWeb());

        if (!$this->imageTool->image)
            NGUtil::HeaderNotFound();

        $this->resizeImage();

        if ($this->useWebP()) $this->imageTool->image_type = IMAGETYPE_WEBP;

        $this->imageTool->save(NGConfig::storePath() . $this->resizedFilename(), $this->imageTool->image_type, $this->quality);

        $this->imageTool->writeHeader($this->imageTool->image_type);
        readfile(NGConfig::storePath() . $this->resizedFilename());
    }

    /**
     *
     * Resize the image
     */
    private function resizeImage()
    {
        if ($this->ratio == NGPicture::RatioNone) {
            $this->imageTool->resize($this->size->width, $this->size->height);
        } else {
            $this->imageTool->resizeWithCrop($this->size->width, $this->size->height, $this->crop->left, $this->crop->top, $this->crop->right, $this->crop->bottom);
        }
    }

    /**
     *
     * Constructor
     */
    public function __construct()
    {
        NGSession::getInstance()->user = NGUser::getUserSystem();
        NGDBConnector::getInstance()->connect();

        $this->imageTool = new NGImage ();
        $this->pictureAdapter = new NGDBAdapterObject ();
    }

    private function useWebP()
    {
        if (NGSettingsSite::getInstance()->webp) {
            if (strcasecmp(substr($this->picture->fileWeb, -4), '.jpg') === 0 || strcasecmp(substr($this->picture->fileWeb, -5), '.jpeg') === 0) {
                if (array_key_exists('HTTP_ACCEPT', $_SERVER)) {
                    if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     *
     * Get a filename for the resized picture
     */
    private function resizedFilename()
    {
        $filename = $this->picture->pathToWeb();
        if ($this->maxWidth != -1)
            $filename .= '.w' . $this->size->width;
        if ($this->maxHeight != -1)
            $filename .= '.h' . $this->size->height;
        if ($this->ratio != 0) {
            $filename .= '.x' . $this->ratio;
            if (!$this->crop->isDefault) {
                $filename .= '.l' . $this->crop->left;
                $filename .= '.t' . $this->crop->top;
                $filename .= '.r' . $this->crop->right;
                $filename .= '.b' . $this->crop->bottom;
            }
        }
        if ($this->quality != 75)
            $filename .= '.q' . $this->quality;
        if ($this->useWebP())
            $filename .= '.wp';
        return $filename;
    }
}