<?php

/*
 * Image handling via GDLib
 */

class NGImage
{

    public $image;
    public $image_type;

    /**
     *
     * Load image
     * @param string $filename
     */
    function load($filename)
    {

        $this->image_type = self::getType($filename);
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function getType($filename)
    {
        $image_info = getimagesize($filename);
        return $image_info [2];
    }

    /**
     *
     * Save Image
     * @param string $filename
     * @param int $image_type
     * @param int $compression
     * @param unknown_type $permissions
     */
    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_WEBP) {
            imagewebp($this->image, $filename, $compression);
        }
    }

    /**
     *
     * Write image to output stream
     * @param int $image_type
     */
    function output($image_type = IMAGETYPE_JPEG)
    {

        if ($image_type == IMAGETYPE_JPEG) {
            $this->writeHeader($image_type);
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            $this->writeHeader($image_type);
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            $this->writeHeader($image_type);
            imagepng($this->image);
        } elseif ($image_type == IMAGETYPE_WEBP) {
            $this->writeHeader($image_type);
            imagewebp($this->image);
        }
    }

    /**
     *
     * Writes a header
     * @param int $image_type
     */
    function writeHeader($image_type = IMAGETYPE_JPEG)
    {
        header('Content-Type: ' . image_type_to_mime_type($image_type));
    }

    /**
     *
     * Width of image
     */
    function getWidth()
    {
        return imagesx($this->image);
    }

    /**
     *
     * Height of image
     */
    function getHeight()
    {
        return imagesy($this->image);
    }

    /**
     *
     * Resize to given height
     * @param int $height
     */
    function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = floor($this->getWidth() * $ratio);
        $this->resize($width, $height);
    }

    /**
     *
     * Resize to given width
     * @param unknown_type $width
     */
    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = floor($this->getheight() * $ratio);
        $this->resize($width, $height);
    }

    /**
     *
     * Resize to given with height
     * @param int $width
     * @param int $height
     */
    function resize($width, $height)
    {
        $newImage = $this->createNewImage($width, $height);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $newImage;
    }

    /**
     *
     * Resize an image with crop
     * @param int $width
     * @param int $height
     * @param int $cropLeft
     * @param int $cropTop
     * @param int $cropRight
     * @param int $cropBottom
     */
    function resizeWithCrop($width, $height, $cropLeft, $cropTop, $cropRight, $cropBottom)
    {
        $new_image = $this->createNewImage($width, $height);

        $sourceWidth = $this->getWidth() - $cropLeft - $cropRight;
        $sourceHeight = $this->getHeight() - $cropTop - $cropBottom;

        imagecopyresampled($new_image, $this->image, 0, 0, $cropLeft, $cropTop, $width, $height, $sourceWidth, $sourceHeight);
        $this->image = $new_image;
    }

    /**
     *
     * Create a new image for resizing
     * @param int $width
     * @param int $height
     */
    private function createNewImage($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);

        if ($this->image_type == IMAGETYPE_PNG) {
            imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }

        if ($this->image_type == IMAGETYPE_GIF) {
            $transIndex = imagecolortransparent($this->image);
            if ($transIndex >= 0) {
                $transColor = imagecolorsforindex($this->image, $transIndex);
                $transIndex = imagecolorallocate($newImage, $transColor ['red'], $transColor ['green'], $transColor ['blue']);
                imagefill($newImage, 0, 0, $transIndex);
                imagecolortransparent($newImage, $transIndex);
            }
        }

        return $newImage;
    }


    /**
     *
     * Resize to box size
     * @param int $width
     * @param int $height
     */
    function fill($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);

        $ratio = $width / $height;

        $newWidth = $this->getWidth();
        $newHeight = floor($newWidth / $ratio);

        if ($newHeight > $this->getHeight()) {
            $newHeight = $this->getHeight();
            $newWidth = floor($newHeight * $ratio);
        }

        $x = ($this->getWidth() - $newWidth) / 2;
        $y = ($this->getHeight() - $newHeight) / 2;

        imagecopyresampled($new_image, $this->image, 0, 0, $x, $y, $width, $height, $newWidth, $newHeight);
        $this->image = $new_image;
    }

}