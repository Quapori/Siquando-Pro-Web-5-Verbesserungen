<?php

include_once(NGClassFolder() . 'plugins/ngpluginparagraph/ngpluginparagraphbloghead/settings/ngblogheadsettings.php');

class NGPluginParagraphBlogTeaser extends NGPluginParagraph
{
    const ObjectTypePluginParagraphBlogTeaser = 'NGPluginParagraphBlogTeaser';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphBlogTeaser = 'paragraphblogteaser';

    public $searchmode = 'ChildPages';
    public $cropratio = 'Ratio2by1';
    public $sortmode = 'DateDescending';
    public $parentfolder = '';
    public $showauthor = true;
    public $showauthorpicture = true;
    public $showissuedate = true;
    public $showpicture = true;
    public $showintro = true;
    public $showcaptions = true;
    public $showreadmore = true;
    public $twocols = false;
    public $animate = true;
    public $maxitems = 0;
    public $skipitems = 0;

    /**
     * @var NGLink
     */
    private $link;

    /**
     * @var NGLink
     */
    private $authorlink;

    /**
     * @var NGTemplate
     */
    private $template;

    /**
     * @var NGRichText
     */
    private $richText;

    /**
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     * @var Array
     */
    private $posts;

    /**
     * @var NGBlogHeadSettings
     */
    private $settings;

    /**
     * @var NGLanguageAdapter
     */
    private $lang;

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


    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('searchmode', NGProperty::TypeString, self::DomainParagraphBlogTeaser, 'searchmode', NGPropertyMapped::MultiplicityScalar, false, 'ChildPages');
        $this->propertiesMapped [] = new NGPropertyMapped ('cropratio', NGProperty::TypeString, self::DomainParagraphBlogTeaser, 'cropratio', NGPropertyMapped::MultiplicityScalar, false, 'Ratio2by1');
        $this->propertiesMapped [] = new NGPropertyMapped ('sortmode', NGProperty::TypeString, self::DomainParagraphBlogTeaser, 'sortmode', NGPropertyMapped::MultiplicityScalar, false, 'DateDescending');
        $this->propertiesMapped [] = new NGPropertyMapped ('parentfolder', NGProperty::TypeUID, self::DomainParagraphBlogTeaser, 'parentfolder', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('showauthor', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showauthor', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showauthorpicture', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showauthorpicture', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showissuedate', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showissuedate', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showpicture', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showpicture', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showintro', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showintro', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showcaptions', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showcaptions', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('showreadmore', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'showreadmore', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('twocols', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'twocols', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('animate', NGProperty::TypeBool, self::DomainParagraphBlogTeaser, 'animate', NGPropertyMapped::MultiplicityScalar, false, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('maxitems', NGProperty::TypeInt, self::DomainParagraphBlogTeaser, 'maxitems', NGPropertyMapped::MultiplicityScalar, false, 0);
        $this->propertiesMapped [] = new NGPropertyMapped ('skipitems', NGProperty::TypeInt, self::DomainParagraphBlogTeaser, 'skipitems', NGPropertyMapped::MultiplicityScalar, false, 0);
    }

    public function render()
    {
        $renderWidth = $this->renderWidth;

        $criterias = array();

        $criterias [] = new NGPropertyCriteria ('pluginname', NGProperty::TypeString, 'NGPluginParagraphBlogHead', false, NGPropertyCriteria::CompareIs, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, 'paragraph');
        $criterias [] = new NGPropertyCriteria ('heading', NGProperty::TypeText, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageDefault, 'paragraphbloghead');
        $criterias [] = new NGPropertyCriteria ('subheading', NGProperty::TypeText, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageDefault, 'paragraphbloghead');
        $criterias [] = new NGPropertyCriteria ('intro', NGProperty::TypeText, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageDefault, 'paragraphbloghead');
        $criterias [] = new NGPropertyCriteria ('pictureuid', NGProperty::TypeUID, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, 'paragraphbloghead');
        $criterias [] = new NGPropertyCriteria ('issuedate', NGProperty::TypeDateTime, '', true, NGPropertyCriteria::CompareNone, ($this->sortmode == 'DateAscending' ? NGPropertyCriteria::SortAsc : NGPropertyCriteria::SortDesc), NGUtil::LanguageNeutral, 'paragraphbloghead');
        $criterias [] = new NGPropertyCriteria ('authoruid', NGProperty::TypeUID, '', true, NGPropertyCriteria::CompareNone, NGPropertyCriteria::SortNone, NGUtil::LanguageNeutral, 'paragraphbloghead');

        $this->adapter = new NGDBAdapterObject();

        $this->link = new NGLink();
        $this->link->previewMode = $this->previewMode;

        $this->authorlink = new NGLink();
        $this->authorlink->previewMode = $this->previewMode;


        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphblogteaser/language/langblogteaser.xml';
        $this->lang->load();


        if ($this->searchmode == 'ChildPages' || $this->searchmode == 'ChildTopics') {
            $parentUid = $this->currentPage->parentUID;
        } else {
            $parentUid = $this->parentfolder;
        }

        if ($this->searchmode == 'Pages' || $this->searchmode == 'ChildPages') {
            $ancestorLevel = 2;
            $this->link->linkType = NGLink::LinkPage;
        } else {
            $ancestorLevel = 3;
            $this->link->linkType = NGLink::LinkTopic;
        }

        /* @var $settings NGBlogHeadSettings */
        $this->settings = $this->adapter->loadSetting(NGBlogHeadSettings::IdBlogHead, NGBlogHeadSettings::ObjectTypeNGBlogHeadSettings);


        $this->posts = $this->adapter->queryObjects('NGPluginParagraph', $criterias, false, 'NGBlogPost', '', '', $parentUid, $ancestorLevel);

        $this->template = new NGTemplate();

        $this->richText = new NGRichText();
        $this->richText->previewMode = $this->previewMode;

        $cropratio = NGPicture::stringToRatio($this->cropratio);

        $skippedItems = 0;
        $posts = array();

        /* @var $post NGBlogPost */
        foreach ($this->posts as $post) {

            if ($this->maxitems === 0 || count($posts) < $this->maxitems) {

                $visible = true;

                /* @var $page NGPluginPage */
                $page = $this->adapter->loadObject($post->ancestorObjectUIDs[1], NGPluginPageDefault::ObjectTypePluginPage, NGPluginPageDefault::ObjectTypePluginPage);

                if ($page !== null) {
                    if (!$page->isVisible()) $visible = false;
                    $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $page->nextVisibilityChange());

                    if (count($post->ancestorObjectUIDs) > 2) {
                        /* @var $topic NGTopic */
                        $topic = $this->adapter->loadObject($post->ancestorObjectUIDs[2], NGTopic::ObjectTypeTopic, NGTopic::ObjectTypeTopic);

                        if ($topic !== null) {
                            if (!$topic->isVisible()) $visible = false;
                            $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $topic->nextVisibilityChange());
                        }
                    }

                    if ($visible) {
                        if ($this->skipitems > 0 && $skippedItems < $this->skipitems) {
                            $skippedItems++;
                        } else {

                            $this->link->uid = $post->ancestorObjectUIDs[$ancestorLevel - 1];
                            $post->url = $this->link->getURL();
                            if ($this->showintro) {
                                $post->intro = $this->richText->parse($post->intro);
                            } else {
                                unset($post->intro);
                            }

                            if ($this->showpicture && $post->pictureuid !== '') {
                                /* @var $picture NGPicture */
                                $picture = $this->adapter->loadObject($post->pictureuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                                if ($picture !== null) {
                                    $post->picturesize = $picture->getResizedSize($renderWidth, -1, $cropratio);
                                    $post->picturesource = NGLink::getPictureURL($post->pictureuid, $renderWidth, -1, $cropratio);
                                }
                            }

                            if ($post->authoruid !== '' && $this->showauthor) {
                                $author = $this->settings->getAuthor($post->authoruid);

                                if ($author !== null) {

                                    if (($this->showauthorpicture) && ($author->pictureuid !== '')) {
                                        $post->authorpicture = NGLink::getPictureURL($author->pictureuid, 64, 64, NGPicture::Ratio1by1);
                                        if (NGSettingsSite::getInstance()->hdpictures) {
                                            $post->authorpicturehd = NGLink::getPictureURL($author->pictureuid, 128, 128, NGPicture::Ratio1by1);
                                        }
                                    }

                                    if ($author->pageuid !== '') {
                                        $this->authorlink->parseURL($author->pageuid);
                                        $post->authorlinkurl = $this->authorlink->getURL();
                                        switch ($this->authorlink->linkType) {
                                            case NGLink::LinkPicture :
                                                $post->authorlinkclass = 'gallery';
                                                break;
                                            case NGLink::LinkPagePopup :
                                            case NGLink::LinkTopicPopup :
                                                $post->authorlinkclass = 'galleryiframe';
                                                break;
                                            case NGLink::LinkWWW :
                                                $post->authorlinktarget = '_blank';
                                                break;
                                        }
                                    }

                                    $post->authorcaption = $author->caption;
                                }

                            }

                            if ($this->showissuedate) {
                                $post->nicedate = $this->niceDate(new DateTime($post->issuedate));
                            }

                            $posts[] = $post;
                        }
                    }
                }
            }
        }

        $this->template->assign('ratio', strtolower($this->cropratio));
        $this->template->assign('posts', $posts);
        $this->template->assign('twocols', $this->twocols);
        $this->template->assign('animate', $this->animate);
        $this->template->assign('showcaptions', $this->showcaptions);
        $this->template->assign('by', $this->lang->languageResources['by']->value);
        if ($this->showreadmore) {
            $this->template->assign('more', $this->lang->languageResources['more']->value);
        }

        $this->styleSheets['NGPluginParagraphBlogTeaser'] = $this->prependPluginsPath('ngpluginparagraphblogteaser/css/style.css');

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphblogteaser/tpl/template.tpl');

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
        return htmlspecialchars($this->lang->languageResources [$this->weekdayIds [($weekday + 6) % 7]]->value);
    }

    public function __construct()
    {
        parent::__construct();
    }

}

class NGBlogPost extends NGObjectMapped
{
    const DomainParagraphBlogHead = 'paragraphbloghead';

    public $authoruid = '';
    public $issuedate = '';
    public $heading = '';
    public $subheading = '';
    public $intro = '';
    public $pictureuid = '';
    public $ancestorObjectUIDs = array();

    public $nicedate;

    public $url;

    public $picturesource;

    public $picturesize;

    public $authorcaption;

    public $authorpicture;

    public $authorpicturehd;

    public $authorlinkurl;

    public $authorlinkclass;

    public $authorlinktarget;


    /**
     * @var NGBlogHeadAuthor
     */
    private $author;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        $this->propertiesMapped [] = new NGPropertyMapped ('authoruid', NGProperty::TypeUID, self::DomainParagraphBlogHead, 'authoruid', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('issuedate', NGProperty::TypeDateTime, self::DomainParagraphBlogHead, 'issuedate', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('heading', NGProperty::TypeText, self::DomainParagraphBlogHead, 'heading', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('subheading', NGProperty::TypeText, self::DomainParagraphBlogHead, 'subheading', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('intro', NGProperty::TypeText, self::DomainParagraphBlogHead, 'intro', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('pictureuid', NGProperty::TypeUID, self::DomainParagraphBlogHead, 'pictureuid', NGPropertyMapped::MultiplicityScalar, false, '');
    }

    public function __construct()
    {
        parent::__construct();
    }
}
