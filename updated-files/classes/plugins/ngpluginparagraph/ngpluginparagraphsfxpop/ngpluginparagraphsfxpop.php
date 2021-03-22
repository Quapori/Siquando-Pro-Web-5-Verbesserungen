<?php

class NGPluginParagraphSFXPop extends NGPluginParagraph
{
    const ObjectTypePluginParagraphSFXPop = 'NGPluginParagraphSFXPop';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphSFXPop = "paragraphsfxpop";

    public $pictureuid = '';

    public $borderradius = 25;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('pictureuid', NGProperty::TypeUID, self::DomainParagraphSFXPop, 'pictureUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('borderradius', NGProperty::TypeInt, self::DomainParagraphSFXPop, 'borderradius', NGPropertyMapped::MultiplicityScalar, false, 25, false);
    }

    public function render()
    {
        $pictureAdapter = new NGDBAdapterObject ();

        /* @var $picture NGPicture */
        $picture = $pictureAdapter->loadObject($this->pictureUID, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

        if ($picture != null) {

            $div = NGRenderTag::create('div');
            $div->class = 'ngparasfxpop';
            
            $img = NGRenderTag::create('img', true);

            $img->attributes ['src'] = NGLink::getPictureURL($picture->objectUID);
            $img->attributes ['width'] = $picture->widthWeb;
            $img->attributes ['height'] = $picture->heightWeb;
            $img->attributes ['alt'] = $picture->displayAlt();

            if ($this->borderradius>0) $img->style->selectors['border-radius']=$this->borderradius.'px';

            $div->content = $img->render();

            $this->output = $div->render();

            $this->javaScripts ['NGPluginParagraphSFXPop'] = $this->prependPluginsPath('ngpluginparagraphsfxpop/js/sfxpop.js');
            $this->styleSheets ['NGPluginParagraphSFXPop'] = $this->prependPluginsPath('ngpluginparagraphsfxpop/css/style.css');

            if ($this->allowMobileFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
            if ($this->allowAlwaysFullWidth)
                $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
        }
    }
}