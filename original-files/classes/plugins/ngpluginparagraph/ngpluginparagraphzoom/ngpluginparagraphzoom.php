<?php

class NGPluginParagraphZoom extends NGPluginParagraph
{
    const ObjectTypePluginParagraphZoom = 'NGPluginParagraphZoom';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphZoom = 'paragraphzoom';

    /**
     * @var string Ratio of pictures
     */
    public $cropratio = 'Ratio1by1';

    /**
     * @var string ZoomMode
     */
    public $zoommode = 'TwoPictures';

    /**
     * @var int Zoom factor
     */
    public $zoomfactorleft = 2;

    /**
     * @var int Zoom factor
     */
    public $zoomfactorright = 2;

    /**
     * @var string UID of first picture
     */
    public $picture1uid = '';

    /**
     * @var string UID of second picture
     */
    public $picture2uid = '';

    /**
     * @var string text
     */
    public $text = '';

    /**
     * @var string aligment of text
     */
    public $textalignment = 'bottom';

    /**
     * @var int inner padding
     */
    public $textpadding = 20;

    /**
     * @var string background color
     */
    public $colorbackground = '';

    /**
     * @var string foreground color
     */
    public $colorforeground = '444444';

    /**
     * @var NGRichText
     */
    private $richtext;

    /**
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     * @var NGTemplate;
     */
    private $template;


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped[] = new NGPropertyMapped('cropratio', NGProperty::TypeString, self::DomainParagraphZoom, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, 'Ratio1by1');
        $this->propertiesMapped[] = new NGPropertyMapped('zoommode', NGProperty::TypeString, self::DomainParagraphZoom, 'zoommode', NGPropertyMapped::MultiplicityScalar, false, 'TwoPictures');
        $this->propertiesMapped[] = new NGPropertyMapped('zoomfactorleft', NGProperty::TypeInt, self::DomainParagraphZoom, 'zoomfactorleft', NGPropertyMapped::MultiplicityScalar, false, 2);
        $this->propertiesMapped[] = new NGPropertyMapped('zoomfactorright', NGProperty::TypeInt, self::DomainParagraphZoom, 'zoomfactorright', NGPropertyMapped::MultiplicityScalar, false, 2);
        $this->propertiesMapped[] = new NGPropertyMapped('picture1uid', NGProperty::TypeUID, self::DomainParagraphZoom, 'picture1uid', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped[] = new NGPropertyMapped('picture2uid', NGProperty::TypeUID, self::DomainParagraphZoom, 'picture2uid', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped[] = new NGPropertyMapped('text', NGProperty::TypeText, self::DomainParagraphZoom, 'text', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped[] = new NGPropertyMapped('textalignment', NGProperty::TypeString, self::DomainParagraphZoom, 'textalignment', NGPropertyMapped::MultiplicityScalar, false, 'bottom');
        $this->propertiesMapped[] = new NGPropertyMapped('textpadding', NGProperty::TypeInt, self::DomainParagraphZoom, 'textpadding', NGPropertyMapped::MultiplicityScalar, false, 20);
        $this->propertiesMapped[] = new NGPropertyMapped('colorbackground', NGProperty::TypeString, self::DomainParagraphZoom, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped[] = new NGPropertyMapped('colorforeground', NGProperty::TypeString, self::DomainParagraphZoom, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, '444444');
    }

    public function render()
    {
        $this->richtext = new NGRichText();
        $this->richtext->previewMode = $this->previewMode;

        $this->template = new NGTemplate();

        $this->adapter = new NGDBAdapterObject();

        $pictureWidth = $this->renderWidth / 2;

        $ratio = NGPicture::stringToRatio($this->cropratio);

        $zoomFactor1 = 1;
        $zoomFactor2 = 1;

        switch ($this->zoommode) {
            case 'PictureLeft':
                $zoomFactor1 = $this->zoomfactorleft;
                $zoomWidth1 = $pictureWidth * $zoomFactor1;
                break;
            case 'PictureRight':
                $zoomFactor1 = $this->zoomfactorright;
                $zoomWidth1 = $pictureWidth * $zoomFactor1;
                break;
            case 'TwoPictures':
                $zoomFactor1 = $this->zoomfactorleft;
                $zoomWidth1 = $pictureWidth * $zoomFactor1;
                $zoomFactor2 = $this->zoomfactorright;
                $zoomWidth2 = $pictureWidth * $zoomFactor2;
                break;
        }

        if ($pictureWidth < 768) $pictureWidth = 768;


        if ($this->picture1uid === '') return;

        /**
         * @var $picture1 NGPicture
         */
        $picture1 = $this->adapter->loadObject($this->picture1uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);
        if ($picture1 === null) return;
        $this->template->assign('picture1size', $picture1->getResizedSize($pictureWidth, -1, $ratio));
        $this->template->assign('picture1source', NGLink::getPictureURL($this->picture1uid, $pictureWidth, -1, $ratio));
        if ($zoomFactor1>1) {
            $this->template->assign('picture1zoomsource', NGLink::getPictureURL($this->picture1uid, $zoomWidth1, -1, $ratio));
            $this->template->assign('picture1zoomfactor', $zoomFactor1);
        }

        if ($this->zoommode === 'TwoPictures') {
            if ($this->picture2uid === '') return;
            /**
             * @var $picture2 NGPicture
             */
            $picture2 = $this->adapter->loadObject($this->picture2uid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);
            if ($picture2 === null) return;
            $this->template->assign('picture2size', $picture2->getResizedSize($pictureWidth, -1, $ratio));
            $this->template->assign('picture2source', NGLink::getPictureURL($this->picture2uid, $pictureWidth, -1, $ratio));
            if ($zoomFactor2>1) {
                $this->template->assign('picture2zoomsource', NGLink::getPictureURL($this->picture2uid, $zoomWidth2, -1, $ratio));
                $this->template->assign('picture2zoomfactor', $zoomFactor2);
            }
        } else {
            $this->template->assign('text', $this->richtext->parse($this->text));
        }

        $this->template->assign('zoommode', $this->zoommode);
        $this->template->assign('uid', $this->objectUID);
        $this->template->assign('colorforeground', $this->colorforeground);
        $this->template->assign('textalignment', $this->textalignment);

        if ($this->zoommode === 'PictureLeft' || $this->zoommode === 'PictureRight') $this->template->assign('textpadding', $this->textpadding);
        if ($this->colorbackground !== '') $this->template->assign('colorbackground', $this->colorbackground);

        $this->styleSheets ['NGPluginParagraphZoom'] = $this->prependPluginsPath('ngpluginparagraphzoom/css/style.css');
        $this->javaScripts ['NGPluginParagraphZoom'] = $this->prependPluginsPath('ngpluginparagraphzoom/js/zoom.js');
        $this->styles ['NGPluginParagraphZoom' . $this->objectUID] = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphzoom/tpl/style.tpl');

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphzoom/tpl/template.tpl');
    }

    public function __construct()
    {
        parent::__construct();
    }

}