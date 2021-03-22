<?php

class NGPluginParagraphPictureStretch extends NGPluginParagraph
{
    const ObjectTypePluginParagraphPictureStretch = 'NGPluginParagraphPictureStretch';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphTouchSlider = "paragraphpicturestretch";

    /**
     *
     * Sortmode for bouquet
     *
     * @var string
     */
    public $sortMode = '';

    /**
     *
     * Source for bouquet
     *
     * @var string
     */
    public $itemsSource = '';

    /**
     *
     * Found items
     *
     * @var string
     */
    public $items;

    /**
     *
     * Parent UID
     *
     * @var string
     */
    public $itemsParentUID = '';

    /**
     * Caption
     *
     * @var string
     */
    public $gallerycaption = '';

    /**
     *
     * Sumary
     *
     * @var string
     */
    public $gallerysummary = '';

    /**
     * @var string
     */
    public $foregroundcolor = '000000';

    /**
     * @var string
     */
    public $backgroundcolor = 'ffffff';

    /**
     * @var string
     */
    public $cropratio = 'Ratio16by9';

    /**
     *
     * @var array
     */
    private $pictures = array();

    /**
     *
     * @var NGBouquet
     */
    private $bouquet;

    /**
     * @var NGPageCache
     */
    private $cache;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemssource', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphTouchSlider, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsparentuid', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('gallerycaption', NGProperty::TypeText, self::DomainParagraphTouchSlider, 'gallerycaption', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('gallerysummary', NGProperty::TypeText, self::DomainParagraphTouchSlider, 'gallerysummary', NGPropertyMapped::MultiplicityScalar, true, '', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('foregroundcolor', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'foregroundcolor', NGPropertyMapped::MultiplicityScalar, false, '000000', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('backgroundcolor', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'backgroundcolor', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cropratio', NGProperty::TypeString, self::DomainParagraphTouchSlider, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, 'Ratio16by9', false);

    }

    public function render()
    {
        $this->bouquet = new NGBouquet ();
        $this->bouquet->itemSource = $this->itemsSource;
        $this->bouquet->sortMode = $this->sortMode;
        $this->bouquet->itemsXML = $this->items;
        $this->bouquet->parentUID = $this->itemsParentUID;
        $this->bouquet->previewMode = $this->previewMode;
        $this->bouquet->prepare();

        if (count($this->bouquet->items) > 1) {
            $template = new NGTemplate ();

            $renderWidth = $this->renderWidth;
            if ($renderWidth < 768) $renderWidth = 768;

            $lang = new NGLanguageAdapter ();
            $lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphpicturestretch/language/langpicturestretch.xml';
            $lang->load();

            $cropratio = NGPicture::stringToRatio($this->cropratio);

            $template->assign('source', NGLink::getPictureURL($this->bouquet->items[0]->displayPicture()->objectUID, $renderWidth, -1, $cropratio));
            $template->assign('size', $this->bouquet->items[0]->displayPicture()->getResizedSize($renderWidth, $cropratio));
            $template->assign('link', $this->prependPluginsPath('ngpluginparagraphpicturestretch/?uid=' . $this->objectUID) . ($this->previewMode ? '&ngm=p' : ''));
            $template->assign('pictures', str_replace('[n]', count($this->bouquet->items), $lang->languageResources['pictures']->value));
            $template->assign('uid', $this->objectUID);

            $this->styleSheets ['NGPluginParagraphPictureStretch'] = $this->prependPluginsPath('ngpluginparagraphpicturestretch/css/paragraph.css');

            $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphpicturestretch/tpl/paragraph.tpl');

            if ($this->allowMobileFullWidth) $this->renderMode = self::RenderModeMobileFullWidth;
        }

    }

    public function renderGallery()
    {
        NGUtil::DefaultHTMLHeaders();

        $this->cache = new NGPageCache ();
        $this->cache->objectUID = $this->objectUID;
        $this->cache->previewMode = $this->previewMode;
        $this->cache->stepsToRoot = NGSession::getInstance()->stepsToRoot;

        if ($this->cache->fetch()) {
            echo($this->cache->output);
        } else {
            $this->bouquet = new NGBouquet ();
            $this->bouquet->itemSource = $this->itemsSource;
            $this->bouquet->sortMode = $this->sortMode;
            $this->bouquet->itemsXML = $this->items;
            $this->bouquet->parentUID = $this->itemsParentUID;
            $this->bouquet->previewMode = $this->previewMode;

            $this->bouquet->prepare();

            if (count($this->bouquet->items) > 1) {

                $this->pictures = Array();

                foreach ($this->bouquet->items as $item) {
                    /* @var $item NGBouquetItem */
                    $picture = new NGPluginParagraphPictureStretchItem ();
                    $picture->source = NGLink::getPictureURL($item->displayPicture()->objectUID, 1536, -1);
                    $picture->caption = $item->displayCaption();
                    $picture->size = $item->displayPicture()->getResizedSize(1536, -1);
                    $this->pictures [] = $picture;
                }

                $template = new NGTemplate ();

                $template->assign('jquery', NGUtil::prependRootPath('js/jquery.js'));


                $richtext = new NGRichText();
                $richtext->previewMode = $this->previewMode;

                $adapter = new NGDBAdapterObject();

                /* @var $typographySettings NGPluginTypographySettings */
                $typographySettings = $adapter->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);

                $paragraphstream = $adapter->loadObject($this->parentUID, NGParagraphStream::ObjectTypeParagraphStream, NGParagraphStream::ObjectTypeParagraphStream);

                $link = new NGLink($this->previewMode);
                $link->linkType = NGLink::LinkPage;
                $link->uid = $paragraphstream->parentUID;

                $backlink = $link->getURL();

                if (!NGConfig::VanityURLs) $backlink='../../../../'.$backlink;

                $template->assign('backlink', $backlink) ;


                $font = new NGFont($typographySettings->defaultfont);
                NGFontUtil::getInstance()->getFontStack($font->fontfamily);

                $template->assign('font', $typographySettings->defaultfont);
                $template->assign('fonts', NGFontUtil::getInstance()->styleSheets);
                $template->assign('fontspath', NGUtil::prependRootPath('classes/plugins/ngplugintypography/css/'));
                $template->assign('metatags', NGSettingsSite::getInstance()->metaTags);
                $template->assign('caption', $this->gallerycaption === '' ? $this->caption : $this->gallerycaption);
                $template->assign('summary', $richtext->parse($this->gallerysummary));
                $template->assign('pictures', $this->pictures);
                $template->assign('background', $this->backgroundcolor);
                $template->assign('foreground', $this->foregroundcolor);
                $template->assign('closeimage', sprintf($this->prependPluginsPath('ngpluginparagraphpicturestretch/img/?f=%s&ca=%s&cb=s'), 'close', $this->backgroundcolor, $this->foregroundcolor));
                $template->assign('nextimage', sprintf($this->prependPluginsPath('ngpluginparagraphpicturestretch/img/?f=%s&ca=%s&cb=s'), 'next', $this->backgroundcolor, $this->foregroundcolor));
                $template->assign('previmage', sprintf($this->prependPluginsPath('ngpluginparagraphpicturestretch/img/?f=%s&ca=%s&cb=s'), 'prev', $this->backgroundcolor, $this->foregroundcolor));
                $template->assign('uid', $this->objectUID);

                $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphpicturestretch/tpl/gallery.tpl');

                $this->cache->output = $this->output;
                $this->cache->store();

                echo($this->output);
            }

        }
    }
}

class NGPluginParagraphPictureStretchItem
{

    /**
     *
     * Source of picture
     *
     * @var string
     */
    public $source;

    /**
     *
     * Alt
     *
     * @var string
     */
    public $caption;

    /**
     * @var NGSize
     */
    public $size;
}