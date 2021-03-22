<?php

class NGPluginParagraphShare extends NGPluginParagraph
{
    const ObjectTypePluginParagraphShare = 'NGPluginParagraphShare';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphShare = "paragraphshare";

    public $ogtitle = '';

    public $ogdescription = '';

    public $ogimage = '';

    public $showtwitter = true;

    public $showfacebook = true;

    public $showgoogleplus = false;

    public $showlinkedin = true;

    public $showxing = true;

    public $twitterlargeimage = false;

    public $smallicons = false;

    public $coloricons = true;

    public $alignicons = 'AlignRight';

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('ogtitle', NGProperty::TypeText, self::DomainParagraphShare, 'ogtitle', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('ogdescription', NGProperty::TypeText, self::DomainParagraphShare, 'ogdescription', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('ogimage', NGProperty::TypeUID, self::DomainParagraphShare, 'ogimage', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showfacebook', NGProperty::TypeBool, self::DomainParagraphShare, 'showfacebook', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showtwitter', NGProperty::TypeBool, self::DomainParagraphShare, 'showtwitter', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showgoogleplus', NGProperty::TypeBool, self::DomainParagraphShare, 'showgoogleplus', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showlinkedin', NGProperty::TypeBool, self::DomainParagraphShare, 'showlinkedin', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showxing', NGProperty::TypeBool, self::DomainParagraphShare, 'showxing', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('twitterlargeimage', NGProperty::TypeBool, self::DomainParagraphShare, 'twitterlargeimage', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('smallicons', NGProperty::TypeBool, self::DomainParagraphShare, 'smallicons', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('coloricons', NGProperty::TypeBool, self::DomainParagraphShare, 'coloricons', NGPropertyMapped::MultiplicityScalar, false, true, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('alignicons', NGProperty::TypeString, self::DomainParagraphShare, 'alignicons', NGPropertyMapped::MultiplicityScalar, false, 'AlignRight', false);
    }

    public function render()
    {
        $adapter = new NGDBAdapterObject ();


        $ogtitle = $this->ogtitle;
        if ($ogtitle === '')
            $ogtitle = $this->currentPage->caption;

        $ogdescription = $this->ogdescription;
        if ($ogdescription === '')
            $ogdescription = strip_tags($this->currentPage->summary);

        $ogimage = $this->ogimage;
        if ($ogimage === '')
            $ogimage = $this->currentPage->picture;

        if ($ogtitle !== '')
            $this->metaTags ['og:title'] = $ogtitle;

        if ($ogdescription !== '')
            $this->metaTags ['og:description'] = $ogdescription;

        if ($ogimage !== '')
            $this->metaTags ['og:image'] = NGLink::getPictureURL($ogimage, 700, -1, NGPicture::RatioNone, true);

        $lang = new NGLanguageAdapter ();
        $lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphshare/language/langshare.xml';
        $lang->load();

        $div = new NGRenderTag ('div');
        $div->class = 'ngparashare';

        if ($this->alignicons === 'AlignLeft') $div->class .= ' ngparashareleft';
        if ($this->alignicons === 'AlignCenter') $div->class .= ' ngparasharecenter';

        if ($this->smallicons) $div->class .= ' ngparasharesmall';
        if ($this->coloricons) $div->class .= ' ngparasharecolor';

        $a = new NGRenderA ();
        $a->attributes ['target'] = '_blank';
        $link = new NGLink ();
        $link->absolute = true;
        $link->uid = $this->currentPage->objectUID;
        $link->linkType = NGLink::LinkPage;
        $url = $link->getURL();

        $this->metaTags ['og:url'] = $url;
        $this->metaTags ['og:type'] = 'website';

        if ($this->showfacebook) {
            $a->href = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
            $a->class = 'ngparasharefb';
            $a->attributes ['title'] = $lang->languageResources ['facebook']->value;
            $div->content .= $a->render();
        }
        if ($this->showtwitter) {
            $a->href = 'https://twitter.com/intent/tweet?text=' . urlencode($ogtitle) . '&url=' . urlencode($link->getURL());
            $a->class = 'ngparasharetwitter';
            $a->attributes ['title'] = $lang->languageResources ['twitter']->value;
            $div->content .= $a->render();
            $this->metaTags ['twitter:card'] = $this->twitterlargeimage ? 'summary_large_image' : 'summary';

            if ($ogimage !== '')
                $this->metaTags ['twitter:image'] = NGLink::getPictureURL($ogimage, 700, -1, NGPicture::RatioNone, true);
        }
        if ($this->showgoogleplus) {
            $a->href = 'https://plus.google.com/share?url=' . urlencode($link->getURL());
            $a->class = 'ngparasharegplus';
            $a->attributes ['title'] = $lang->languageResources ['googleplus']->value;
            $div->content .= $a->render();
        }

        if ($this->showlinkedin) {
            $a->href = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($link->getURL()) . '&title=' . urlencode($ogtitle) . '&summary=' . urlencode($ogdescription);
            $a->class = 'ngparasharein';
            $a->attributes ['title'] = $lang->languageResources ['linkedin']->value;
            $div->content .= $a->render();
        }

        if ($this->showxing) {
            $a->href = 'https://www.xing.com/spi/shares/new?url=' . urlencode($link->getURL());
            $a->class = 'ngparasharexing';
            $a->attributes ['title'] = $lang->languageResources ['xing']->value;
            $div->content .= $a->render();
        }

        $this->output = $div->render();

        $this->styleSheets ['NGPluginParagraphShare'] = $this->prependPluginsPath('ngpluginparagraphshare/css/style.css');
        $this->javaScripts ['NGPluginParagraphShare'] = $this->prependPluginsPath('ngpluginparagraphshare/js/share.js');
    }
}