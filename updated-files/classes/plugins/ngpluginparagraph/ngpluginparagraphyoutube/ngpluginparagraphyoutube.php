<?php

class NGPluginParagraphYouTube extends NGPluginParagraph
{
    const ObjectTypePluginParagraphYouTube = 'NGPluginParagraphYouTube';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphYouTube = "paragraphyoutube";
    public $id = '';
    public $width = 640;
    public $height = 360;
    public $autoplay = false;
    public $controls = true;
    public $loop = false;
    public $modestbranding = false;
    public $pictureuid = '';
    public $requestallwaysfullwidth = false;
    public $nocookie = false;

    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('id', NGProperty::TypeString, self::DomainParagraphYouTube, 'id', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('width', NGProperty::TypeString, self::DomainParagraphYouTube, 'width', NGPropertyMapped::MultiplicityScalar, false, 640, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('height', NGProperty::TypeString, self::DomainParagraphYouTube, 'height', NGPropertyMapped::MultiplicityScalar, false, 360, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('autoplay', NGProperty::TypeBool, self::DomainParagraphYouTube, 'autoplay', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('controls', NGProperty::TypeBool, self::DomainParagraphYouTube, 'controls', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('loop', NGProperty::TypeBool, self::DomainParagraphYouTube, 'loop', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('modestbranding', NGProperty::TypeBool, self::DomainParagraphYouTube, 'modestbranding', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureuid', NGProperty::TypeUID, self::DomainParagraphYouTube, 'pictureuid', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('requestallwaysfullwidth', NGProperty::TypeBool, self::DomainParagraphYouTube, 'requestallwaysfullwidth', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('nocookie', NGProperty::TypeBool, self::DomainParagraphYouTube, 'nocookie', NGPropertyMapped::MultiplicityScalar, false, false, false);
    }

    public function render()
    {
        if ($this->id != '') {

            $width = $this->width;
            $height = $this->height;

            if ($width > $this->renderWidth) {
                $ratio = $height / $width;
                $width = $this->renderWidth;
                $height = floor($width * $ratio);
            }

            $template = new NGTemplate ();

            $template->assign('fullwidth', $this->width);
            $template->assign('fullheight', $this->height);
            $template->assign('width', $width);
            $template->assign('height', $height);
            $template->assign('url', $this->buildurl());
            $template->assign('responsive', $this->responsive);
            $template->assign('ratio', number_format(($this->height / $this->width * 100), 4, '.', ''));

            if ($this->pictureuid === '') {
                $templatefile = 'inline.tpl';
            } else {
                $pictureAdapter = new NGDBAdapterObject ();
                /* @var $picture NGPicture */
                $picture = $pictureAdapter->loadObject($this->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                if ($picture != null) {

                    $size = $picture->getResizedSize($this->renderWidth);
                    $template->assign('source', NGLink::getPictureURL($picture->objectUID, $size->width, $size->height));
                    $template->assign('sourceplay', NGUtil::prependRootPath('classes/plugins/ngpluginparagraph/ngpluginparagraphyoutube/img/play.svg'));
                    $template->assign('picturewidth', $size->width);
                    $template->assign('pictureheight', $size->height);
                    $templatefile = 'popup.tpl';
                }
            }
            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphyoutube/tpl/' . $templatefile);

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;

            if ($this->requestallwaysfullwidth && $this->allowAlwaysFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }

    private function buildurl()
    {
        $query = Array();

        if ($this->autoplay)
            $query [] = 'autoplay=1';
        if (!$this->controls)
            $query [] = 'controls=0';
        if ($this->loop) {
            $query [] = 'loop=1';
            $query [] = 'playlist=' . $this->id;
        }
        if ($this->modestbranding)
            $query [] = 'modestbranding=1';

        return ($this->nocookie ? 'https://www.youtube-nocookie.com/embed/' : 'https://www.youtube.com/embed/') . $this->id . '?' . implode('&', $query);
    }
}