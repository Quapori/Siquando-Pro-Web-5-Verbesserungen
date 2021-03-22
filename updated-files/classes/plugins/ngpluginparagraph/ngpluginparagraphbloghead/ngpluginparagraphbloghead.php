<?php

include_once(NGClassFolder(). 'plugins/ngpluginparagraph/ngpluginparagraphbloghead/settings/ngblogheadsettings.php');

class NGPluginParagraphBlogHead extends NGPluginParagraph
{
    const ObjectTypePluginParagraphBlogHead = 'NGPluginParagraphBlogHead';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphBlogHead = 'paragraphbloghead';

    public $authoruid = '';
    public $issuedate = '';
    public $heading = '';
    public $subheading = '';
    public $intro = '';
    public $pictureuid = '';
    public $colorbackground = 'ffffff';
    public $colorforeground = '696969';
    public $showtwitter = false;
    public $showfacebook = false;
    public $showgoogleplus = false;
    public $showlinkedin = false;
    public $showxing = false;
    public $showmail = false;
    public $introposition = 'MarginLeft';
    public $cropratio = 'RatioUnknown';
    public $panorama = false;

    /**
     * @var NGRichText
     */
    private $richtext;

    /**
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     * @var NGTemplate
     */
    private $template;

    /**
     * @var NGBlogHeadSettings
     */
    private $settings;

    /**
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     * @var NGBlogHeadAuthor
     */
    private $author;

    /**
     * @var NGLink
     */
    private $link;

    /**
     *
     * resoruce ids of months
     *
     * @var array
     */
    private $monthIds = array(
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december'
    );

    /**
     *
     * ressource ids of weekday
     *
     * @var array
     */
    private $weekdayIds = array(
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun'
    );


    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('authoruid', NGProperty::TypeUID, self::DomainParagraphBlogHead, 'authoruid', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('issuedate', NGProperty::TypeDateTime, self::DomainParagraphBlogHead, 'issuedate', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('heading', NGProperty::TypeText, self::DomainParagraphBlogHead, 'heading', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('subheading', NGProperty::TypeText, self::DomainParagraphBlogHead, 'subheading', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('intro', NGProperty::TypeText, self::DomainParagraphBlogHead, 'intro', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureuid', NGProperty::TypeUID, self::DomainParagraphBlogHead, 'pictureuid', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorbackground', NGProperty::TypeString, self::DomainParagraphBlogHead, 'colorbackground', NGPropertyMapped::MultiplicityScalar, false, 'ffffff');
        $this->propertiesMapped [] = new NGPropertyMapped ('colorforeground', NGProperty::TypeString, self::DomainParagraphBlogHead, 'colorforeground', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('showfacebook', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showfacebook', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showtwitter', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showtwitter', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showgoogleplus', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showgoogleplus', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showlinkedin', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showlinkedin', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showxing', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showxing', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('showmail', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'showmail', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('introposition', NGProperty::TypeString, self::DomainParagraphBlogHead, 'introposition', NGPropertyMapped::MultiplicityScalar, false, 'MarginLeft');
        $this->propertiesMapped [] = new NGPropertyMapped ('cropratio', NGProperty::TypeString, self::DomainParagraphBlogHead, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, 'RatioUnknown');
        $this->propertiesMapped [] = new NGPropertyMapped ('panorama', NGProperty::TypeBool, self::DomainParagraphBlogHead, 'panorama', NGPropertyMapped::MultiplicityScalar, false, false);

    }

    public function render()
    {
        $this->richtext = new NGRichText();
        $this->richtext->previewMode = $this->previewMode;
        $this->adapter = new NGDBAdapterObject();
        $this->template = new NGTemplate ();

        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphbloghead/language/langbloghead.xml';
        $this->lang->load();

        $renderwidth = $this->renderWidth;

        if ($this->responsive && $renderwidth < 768) $renderwidth = 768;

        if ($this->panorama) $renderwidth=1920;

        $validpicture = false;

        if ($this->pictureuid !== '') {
            $picture = $this->adapter->loadObject($this->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

            if ($picture != null) {

                $cropratio = NGPicture::stringToRatio($this->cropratio);

                $size = $picture->getResizedSize($renderwidth, -1, $cropratio);

                $this->template->assign('picturesource', NGLink::getPictureURL($picture->objectUID, $renderwidth, -1, $cropratio));
                $this->template->assign('picturewidth', $size->width);
                $this->template->assign('pictureheight', $size->height);

                $validpicture = true;

            }
        }

        if (!$validpicture) $this->introposition = 'NoMargin';

        /* @var $settings NGBlogHeadSettings */
        $this->settings = $this->adapter->loadSetting(NGBlogHeadSettings::IdBlogHead, NGBlogHeadSettings::ObjectTypeNGBlogHeadSettings);

        $this->author = $this->settings->getAuthor($this->authoruid);

        if ($this->author !== null) {

            if ($this->author->pictureuid !== '') {
                $this->template->assign('authorpicture', NGLink::getPictureURL($this->author->pictureuid, 64, 64, NGPicture::Ratio1by1));
                if (NGSettingsSite::getInstance()->hdpictures) {
                    $this->template->assign('authorpicturehd', NGLink::getPictureURL($this->author->pictureuid, 128, 128, NGPicture::Ratio1by1));
                }
            }

            if ($this->author->pageuid !== '') {
                $this->link = new NGLink ($this->previewMode);
                $this->link->parseURL($this->author->pageuid);
                $this->template->assign('authorlink', $this->link->getURL());
                switch ($this->link->linkType) {
                    case NGLink::LinkPicture :
                        $this->template->assign('authorlinkclass', 'gallery');
                        break;
                    case NGLink::LinkPagePopup :
                    case NGLink::LinkTopicPopup :
                        $this->template->assign('authorlinkclass', 'galleryiframe');
                        break;
                    case NGLink::LinkWWW :
                        $this->template->assign('authorlinktarget', '_blank');
                        break;
                }
            }

            $this->template->assign('authorcaption', $this->author->caption);
        }

        if ($this->showfacebook || $this->showgoogleplus || $this->showlinkedin || $this->showtwitter || $this->showxing || $this->showmail) {
            $link = new NGLink ();
            $link->absolute = true;
            $link->uid = $this->currentPage->objectUID;
            $link->linkType = NGLink::LinkPage;
            $url = $link->getURL();

            if ($this->showfacebook) {
                $this->template->assign('urlfacebook', 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url));
                $this->template->assign('titlefacebook', $this->lang->languageResources ['facebook']->value);
            }

            if ($this->showtwitter) {
                $this->template->assign('urltwitter', 'https://twitter.com/intent/tweet?text=' . urlencode($this->heading) . '&url=' . urlencode($link->getURL()));
                $this->template->assign('titletwitter', $this->lang->languageResources ['twitter']->value);
                $this->metaTags ['twitter:image'] = NGLink::getPictureURL($this->pictureuid, 700, -1, NGPicture::RatioNone, true);;
            }
            if ($this->showgoogleplus) {
                $this->template->assign('urlgoogleplus', 'https://plus.google.com/share?url=' . urlencode($link->getURL()));
                $this->template->assign('titlegoogleplus', $this->lang->languageResources ['googleplus']->value);
            }

            if ($this->showlinkedin) {
                $this->template->assign('urllinkedin', 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($link->getURL()) . '&title=' . urlencode($this->heading) . '&summary=' . urlencode($this->plainIntro()));
                $this->template->assign('titlelinkedin', $this->lang->languageResources ['linkedin']->value);
            }

            if ($this->showxing) {
                $this->template->assign('urlxing', 'https://www.xing.com/spi/shares/new?url=' . urlencode($link->getURL()));
                $this->template->assign('titlexing', $this->lang->languageResources ['xing']->value);
            }

            if ($this->showmail) {
                $this->template->assign('urlmail', 'mailto:?subject=' . rawurlencode($this->heading) . '&body=' . rawurlencode($this->plainIntro() . "\n\n" . $url));
                $this->template->assign('titlemail', $this->lang->languageResources ['mail']->value);
            }

            $this->template->assign('share', true);
            $this->metaTags ['og:title'] = $this->heading;
            $this->metaTags ['og:description'] = $this->plainIntro();
            $this->metaTags ['og:image'] = NGLink::getPictureURL($this->pictureuid, 700, -1, NGPicture::RatioNone, true);
            $this->metaTags ['og:url'] = $url;

            $this->javaScripts['NGPluginParagraphBlogHead'] = $this->prependPluginsPath('ngpluginparagraphbloghead/js/share.js');
        }


        $this->template->assign('uid', $this->objectUID);
        $this->template->assign('heading', $this->heading);
        $this->template->assign('subheading', $this->subheading);
        $this->template->assign('issuedate', $this->niceDate(new DateTime($this->issuedate)));
        $this->template->assign('intro', $this->richtext->parse($this->intro));
        $this->template->assign('colorbackground', $this->colorbackground);
        $this->template->assign('colorforeground', $this->colorforeground);
        $this->template->assign('introposition', strtolower($this->introposition));
        $this->template->assign('by', $this->lang->languageResources['by']->value);

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphbloghead/tpl/template.tpl');
        $this->styleSheets['NGPluginParagraphBlogHead'] = $this->prependPluginsPath('ngpluginparagraphbloghead/css/style.css');
        $this->styles['BlogHead' . $this->objectUID] = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphbloghead/tpl/style.tpl');

        if ($this->allowMobileFullWidth) $this->renderMode = self::RenderModeMobileFullWidth;

        if ($this->panorama && $this->allowAlwaysFullWidth) $this->renderMode = self::RenderModeAlwaysFullWidth;
    }

    /**
     * A plain and shortened version of the intro
     * @return string
     */
    private function plainIntro()
    {
        $plainintro = strip_tags($this->intro);
        if (strlen($plainintro) > 200) $plainintro = substr($plainintro, 0, 200) . ' ...';

        return $plainintro;
    }

    /**
     * @param DateTime $date
     * @return string
     */
    private function niceDate($date)
    {
        $year = intval($date->format('Y'));
        $month = intval($date->format('n'));
        $day = intval($date->format('d'));
        $weekday = intval($date->format('w'));

        return $this->niceWeekday($weekday) . ', ' . $day . '. ' . $this->niceMonth($month) . ' ' . $year;


    }

    private function niceMonth($month)
    {
        return htmlspecialchars($this->lang->languageResources [$this->monthIds [$month - 1]]->value);
    }

    private function niceWeekday($weekday)
    {
        return htmlspecialchars($this->lang->languageResources [$this->weekdayIds [($weekday + 6) % 7 ]]->value);
    }
}