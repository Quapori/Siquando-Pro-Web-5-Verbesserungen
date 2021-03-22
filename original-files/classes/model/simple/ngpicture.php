<?php

class NGPicture extends NGFile
{
    const ObjectTypePicture = 'NGPicture';
    const DomainPicture = 'picture';
    const RatioNone = 0;
    const Ratio3by1 = 1;
    const Ratio4by3 = 2;
    const Ratio1by1 = 3;
    const Ratio3by4 = 4;
    const Ratio1by3 = 5;
    const Ratio16by9 = 6;
    const Ratio3by2 = 7;
    const Ratio2by1 = 8;
    const Ratio2by3 = 9;
    const Ratio1by2 = 10;

    const NameRatio3by1 = 'Ratio3by1';
    const NameRatio4by3 = 'Ratio4by3';
    const NameRatio1by1 = 'Ratio1by1';
    const NameRatio3by4 = 'Ratio3by4';
    const NameRatio1by3 = 'Ratio1by3';
    const NameRatio16by9 = 'Ratio16by9';
    const NameRatio3by2 = 'Ratio3by2';
    const NameRatio2by1 = 'Ratio2by1';
    const NameRatio2by3 = 'Ratio2by3';
    const NameRatio1by2 = 'Ratio1by2';

    private $ratioToString = array(
        self::Ratio3by1 => self::NameRatio3by1,
        self::Ratio4by3 => self::NameRatio4by3,
        self::Ratio1by1 => self::NameRatio1by1,
        self::Ratio3by4 => self::NameRatio3by4,
        self::Ratio1by3 => self::NameRatio1by3,
        self::Ratio16by9 => self::NameRatio16by9,
        self::Ratio3by2 => self::NameRatio3by2,
        self::Ratio2by1 => self::NameRatio2by1,
        self::Ratio2by3 => self::NameRatio2by3,
        self::Ratio1by2 => self::NameRatio1by2

    );

    /**
     *
     * Web version of picture
     *
     * @var string
     */
    public $fileWeb = '';

    /**
     *
     * File data
     *
     * @var NGFileState
     */
    public $fileWebState = null;

    /**
     *
     * Thumbnail
     *
     * @var string
     */
    public $fileThumb = '';

    /**
     *
     * File data for thumb
     *
     * @var NGFileState
     */
    public $fileThumbState = null;

    /**
     *
     * Width
     *
     * @var int
     */
    public $width = 0;

    /**
     *
     * Height
     *
     * @var int
     */
    public $height = 0;

    /**
     *
     * Width web
     *
     * @var int
     */
    public $widthWeb = 0;

    /**
     *
     * Height web
     *
     * @var int
     */
    public $heightWeb = 0;

    /**
     *
     * Crop information
     *
     * @var unknown_type
     */
    public $cropValue = array();

    /**
     *
     * ALT-Tag
     *
     * @var string
     */
    public $alt = '';

    /**
     *
     * Title-Tag
     *
     * @var string
     */
    public $title = '';

    /**
     *
     * JPEG-Quality
     *
     * @var int
     */
    public $jpegquality = -1;

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('fileweb', NGProperty::TypeFile, self::DomainPicture, 'fileWeb', NGPropertyMapped::MultiplicityScalar, false, '', false, 'fileWebState');
        $this->propertiesMapped [] = new NGPropertyMapped ('filethumb', NGProperty::TypeFile, self::DomainPicture, 'fileThumb', NGPropertyMapped::MultiplicityScalar, false, '', false, 'fileThumbState');
        $this->propertiesMapped [] = new NGPropertyMapped ('width', NGProperty::TypeInt, self::DomainPicture, 'width', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('height', NGProperty::TypeInt, self::DomainPicture, 'height', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('widthweb', NGProperty::TypeInt, self::DomainPicture, 'widthWeb', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('heightweb', NGProperty::TypeInt, self::DomainPicture, 'heightWeb', NGPropertyMapped::MultiplicityScalar, false, 0, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cropvalue', NGProperty::TypeString, self::DomainPicture, 'cropValue', NGPropertyMapped::MultiplicityDictornary, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alt', NGProperty::TypeString, self::DomainPicture, 'alt', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('title', NGProperty::TypeString, self::DomainPicture, 'title', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('jpegquality', NGProperty::TypeInt, self::DomainPicture, 'jpegquality', NGPropertyMapped::MultiplicityScalar, false, -1);
    }

    /**
     * Should the paragraph be visible
     */
    public function isVisible()
    {
        return true;
    }

    /**
     * When will the visibility change for the next time
     */
    public function nextVisibilityChange()
    {
        return '';
    }

    /**
     * Gets the path to the thumb file
     */
    public function pathToThumb()
    {
        return $this->fileThumbState->path . $this->fileThumb;
    }

    /**
     * Gets the path to the web file
     */
    public function pathToWeb()
    {
        return $this->fileWebState->path . $this->fileWeb;
    }

    /**
     *
     * Calculate a resized size
     *
     * @param int $maxWidth
     * @param int $maxHeight
     * @param int $ratioType
     * @return NGSize Size
     */
    public function getResizedSize($maxWidth = -1, $maxHeight = -1, $ratioType = self::RatioNone)
    {
        $ratio = self::ratioByRatioType($ratioType);
        if ($ratio == 0)
            $ratio = $this->widthWeb / $this->heightWeb;

        if ($maxWidth == -1)
            $maxWidth = $this->widthWeb;
        if ($maxHeight == -1)
            $maxHeight = $this->heightWeb;

        $newWidth = min($this->widthWeb, $maxWidth);
        $newHeight = ceil($newWidth / $ratio);

        if ($newHeight > $maxHeight) {
            $newHeight = $maxHeight;
            $newWidth = floor($newHeight * $ratio);
        }

        return NGSize::create($newWidth, $newHeight);
    }

    /**
     *
     * Calculate a crop
     *
     * @param int $ratioType
     * @return NGCrop crop
     */
    public function getCrop($ratioType)
    {
        if (array_key_exists($ratioType, $this->ratioToString)) {
            $ratioString = $this->ratioToString [$ratioType];
            if (array_key_exists($ratioString, $this->cropValue)) {
                $crop = $this->cropValue [$ratioString];

                $parts = explode(',', $crop);

                $width = $parts [4];
                $height = $parts [5];

                if ($this->widthWeb == $width && $this->heightWeb == $height) {
                    return NGCrop::create($parts [0], $parts [1], $parts [2], $parts [3], false);
                }
            }
        }

        return $this->getDefaultCrop($ratioType);
    }

    /**
     *
     * Calculate the default crop, when user has not defined one
     *
     * @param int $ratioType
     * @return NGCrop crop
     */
    public function getDefaultCrop($ratioType)
    {
        $crop = new NGCrop ();
        $crop->isDefault = true;

        $ratio = self::ratioByRatioType($ratioType);
        $width = $this->widthWeb;
        $height = floor($width / $ratio);

        if ($height < $this->heightWeb) {
            $crop->left = 0;
            $crop->right = 0;
            $crop->top = floor(($this->heightWeb - $height) / 2);
            $crop->bottom = floor($this->heightWeb - $crop->top - $height);
        } else {
            $height = $this->heightWeb;
            $width = floor($height * $ratio);
            $crop->top = 0;
            $crop->bottom = 0;
            $crop->left = floor(($this->widthWeb - $width) / 2);
            $crop->right = floor($this->widthWeb - $crop->left - $width);
        }

        return $crop;
    }

    /**
     *
     * Get ratio for type
     *
     * @param int $ratioType
     */
    public static function ratioByRatioType($ratioType)
    {
        switch ($ratioType) {
            case self::RatioNone :
                return 0;
            case self::Ratio1by1 :
                return 1;
            case self::Ratio1by3 :
                return 1 / 3;
            case self::Ratio3by1 :
                return 3 / 1;
            case self::Ratio3by4 :
                return 3 / 4;
            case self::Ratio4by3 :
                return 4 / 3;
            case self::Ratio16by9 :
                return 16 / 9;
            case self::Ratio3by2 :
                return 3 / 2;
            case self::Ratio2by1 :
                return 2 / 1;
            case self::Ratio2by3 :
                return 2 / 3;
            case self::Ratio1by2 :
                return 1 / 2;
        }
    }

    public static function stringToRatio($ratioType)
    {
        switch ($ratioType) {
            case self::NameRatio1by1 :
                return self::Ratio1by1;
            case self::NameRatio1by3 :
                return self::Ratio1by3;
            case self::NameRatio3by1 :
                return self::Ratio3by1;
            case self::NameRatio3by4 :
                return self::Ratio3by4;
            case self::NameRatio4by3 :
                return self::Ratio4by3;
            case self::NameRatio16by9 :
                return self::Ratio16by9;
            case self::NameRatio3by2 :
                return self::Ratio3by2;
            case self::NameRatio2by1 :
                return self::Ratio2by1;
            case self::NameRatio2by3 :
                return self::Ratio2by3;
            case self::NameRatio1by2 :
                return self::Ratio1by2;
            default :
                return self::RatioNone;
        }
    }

    /**
     * Returns the alt tag, or the caption, if not set
     */
    public function displayAlt()
    {
        if ($this->alt !== '') {
            return $this->alt;
        } else {
            return $this->caption;
        }
    }
}