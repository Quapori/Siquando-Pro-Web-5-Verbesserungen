<?php

class NGPluginParagraphSFXText extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXText = 'NGPluginParagraphSFXText';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXText = 'paragraphsfxtext';


    public $text = '';
    public $pictureUID = '';
    public $fontsize = 200;
    public $backgroundcolor = '000000';
    public $foregroundcolor = 'ffffff';

    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped[] = new NGPropertyMapped('text', NGProperty::TypeText, self::DomainParagraphSFXText, 'text', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureuid', NGProperty::TypeUID, self::DomainParagraphSFXText, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('fontsize', NGProperty::TypeInt, self::DomainParagraphSFXText, 'fontsize', NGPropertyMapped::MultiplicityScalar, false, 200, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundcolor', NGProperty::TypeString, self::DomainParagraphSFXText, 'backgroundcolor', NGPropertyMapped::MultiplicityScalar, false, '000000', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('foregroundcolor', NGProperty::TypeString, self::DomainParagraphSFXText, 'foregroundcolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
    }

    public function render()
    {
        if ($this->text!=='') {
            $pictureAdapter = new NGDBAdapterObject();

            /* @var $picture NGPicture */
            $picture = $pictureAdapter->loadObject($this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

            if ($picture != null) {
                $template = new NGTemplate ();
                $template->assign('source', NGLink::getPictureURL($picture->objectUID));

                $richText = new NGRichText();
                $richText->previewMode = $this->previewMode;

                $template->assign('source', NGLink::getPictureURL($picture->objectUID));
                $template->assign('text', $richText->parse($this->text));
                $template->assign('fontsize', $this->fontsize);
                $template->assign('foregroundcolor', $this->foregroundcolor);
                $template->assign('backgroundcolor', $this->backgroundcolor);

                $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphsfxtext/tpl/template.tpl');

                $this->styleSheets ['NGPluginParagraphSFXText'] = $this->prependPluginsPath('ngpluginparagraphsfxtext/css/style.css');
                $this->javaScripts ['NGPluginParagraphSFXText'] = $this->prependPluginsPath('ngpluginparagraphsfxtext/js/text.js');

                if ($this->allowMobileFullWidth)
                    $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
                if ($this->allowAlwaysFullWidth)
                    $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
            }
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}