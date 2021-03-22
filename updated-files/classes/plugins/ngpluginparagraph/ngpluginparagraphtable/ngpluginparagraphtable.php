<?php

class NGPluginParagraphTable extends NGPluginParagraph
{
    const ObjectTypePluginParagraphTable = 'NGPluginParagraphTable';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphTable = "paragraphtable";

    /**
     *
     * number of colums
     *
     * @var int
     */
    public $columns;

    /**
     *
     * Number of rows
     *
     * @var int
     */
    public $rows;

    /**
     *
     * Array holding all cell data
     *
     * @var Array
     */
    public $cells;

    /**
     *
     * Width of column from -3 to 3
     *
     * @var int
     */
    public $columnWidth;

    /**
     *
     * Show column headers?
     *
     * @var bool
     */
    public $columnHeaders;

    /**
     *
     * Show row headers
     *
     * @var bool
     */
    public $rowHeaders;

    /**
     *
     * Altmode
     *
     * @var string
     */
    public $altmode;

    /**
     *
     * Calculated col width
     *
     * @var array
     */
    private $columnWidthCalc = array();

    /**
     *
     * Calculated col width
     *
     * @var int
     */
    private $headerWidthCalc = array();

    /**
     *
     * Text align of last cell
     *
     * @var string
     */
    public $textAlign = null;

    /**
     *
     * Vertical align of last cell
     *
     * @var string
     */
    public $verticalAlign = null;

    /**
     * Reflow the table
     *
     * @var boolean
     */
    public $pivot = false;

    /**
     * @var string
     */
    public $bulletstyle = 'default';

    /**
     * @var string
     */
    public $bulletcolor = '4f81bd';

    /**
     *
     * Rich text renderer
     *
     * @var NGRichText
     */
    private $richText;

    /**
     * Icon creator
     * @var NGPluginIcon
     */
    private $icon;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('columns', NGProperty::TypeInt, self::DomainParagraphTable, 'columns', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('rows', NGProperty::TypeInt, self::DomainParagraphTable, 'rows', NGPropertyMapped::MultiplicityScalar, false, 3, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('cells', NGProperty::TypeFulltext, self::DomainParagraphTable, 'cells', NGPropertyMapped::MultiplicityDictornary, true, Array());
        $this->propertiesMapped [] = new NGPropertyMapped ('columnwidth', NGProperty::TypeInt, self::DomainParagraphTable, 'columnWidth', NGPropertyMapped::MultiplicityList, false, Array(), false);
        $this->propertiesMapped [] = new NGPropertyMapped ('columnheaders', NGProperty::TypeBool, self::DomainParagraphTable, 'columnHeaders', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('rowheaders', NGProperty::TypeBool, self::DomainParagraphTable, 'rowHeaders', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('altmode', NGProperty::TypeString, self::DomainParagraphTable, 'altmode', NGPropertyMapped::MultiplicityScalar, false, 'none', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('pivot', NGProperty::TypeBool, self::DomainParagraphTable, 'pivot', NGPropertyMapped::MultiplicityScalar, false, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletstyle', NGProperty::TypeString, self::DomainParagraphTable, 'bulletstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false);
        $this->propertiesMapped [] = new NGPropertyMapped ('bulletcolor', NGProperty::TypeString, self::DomainParagraphTable, 'bulletcolor', NGPropertyMapped::MultiplicityScalar, false, '4f81bd', false);
    }

    public function render()
    {
        $this->calculateColumnWidth();

        $this->richText->previewMode = $this->previewMode;

        $tagDiv = new NGRenderTag ('div');
        $tagDiv->class = 'tablecontainer';

        if (!$this->responsive)
            $tagDiv->style->selectors ['width'] = $this->renderWidth . 'px';

        $tagTable = new NGRenderTag ('table');
        $tagTable->class = 'paragraphtable';

        if ($this->pivot)
            $tagTable->class .= ' paragraphtablepivot';

        $tagTable->style->selectors ['width'] = '100%';
        $tagTR = new NGRenderTag ('tr');
        $tagTD = new NGRenderTag ('td');

        $tagHead = new NGRenderTag ('thead');
        $tagBody = new NGRenderTag ('tbody');

        $tagTable->content = '';

        for ($row = 0; $row < $this->rows; $row++) {
            $tagTR->content = '';

            $tagTD->tag = ($row == 0 && $this->columnHeaders) ? 'th' : 'td';

            for ($column = 0; $column < $this->columns; $column++) {
                if (($row == 0 && $this->columnHeaders) || ($column == 0 && $this->rowHeaders)) {
                    $tagTD->class = 'header';
                } else {
                    $tagTD->class = null;
                    if ($this->altmode == 'Row' && $row & 1)
                        $tagTD->class = 'alt';
                    if ($this->altmode == 'Column' && $column & 1)
                        $tagTD->class = 'alt';
                }
                if ($row == 0 && $this->columnHeaders) {
                    if ($this->responsive) {
                        $tagTD->style->selectors ['width'] = number_format($this->headerWidthCalc [$column] * 100 / $this->renderWidth, 2, '.', '') . '%';
                    } else {
                        $tagTD->style->selectors ['width'] = $this->headerWidthCalc [$column] . 'px';
                    }
                } else {
                    if ($this->responsive) {
                        $tagTD->style->selectors ['width'] = number_format($this->columnWidthCalc [$column] * 100 / $this->renderWidth, 2, '.', '') . '%';
                    } else {
                        $tagTD->style->selectors ['width'] = $this->columnWidthCalc [$column] . 'px';
                    }
                }
                $tagTD->content = "\r\n" . $this->renderCell($column, $row) . "\r\n";
                $tagTD->style->selectors ['text-align'] = $this->textAlign;
                $tagTD->style->selectors ['vertical-align'] = $this->verticalAlign;
                $tagTR->content .= $tagTD->render();
            }

            if ($row == 0 && $this->columnHeaders) {
                $tagHead->content .= $tagTR->render();
            } else {
                $tagBody->content .= $tagTR->render();
            }
        }

        if ($this->columnHeaders) $tagTable->content .= $tagHead->render();
        $tagTable->content .= $tagBody->render();

        $tagDiv->content = $tagTable->render();
        $this->output = $tagDiv->render();

        $this->styleSheets ['NGPluginParagraphTable'] = $this->prependPluginsPath('ngpluginparagraphtable/css/');

        if ($this->responsive && $this->pivot)
            $this->javaScripts ['NGPluginParagraphTable'] = $this->prependPluginsPath('ngpluginparagraphtable/js/tablepivot.js');
    }

    /**
     *
     * Get width
     *
     * @param int $maxWidth
     */
    private function calculateColumnWidth()
    {
        $typoAdapter = new NGDBAdapterObject ();

        /* @var $typoSettings NGPluginTypographySettings */
        $typoSettings = $typoAdapter->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);

        $marginCell = new NGMargin ($typoSettings->cellpadding);
        $marginHeader = new NGMargin ($typoSettings->cellheaderpadding);

        $total = 0;
        for ($column = 0; $column < $this->columns; $column++) {
            $factor = 0;

            if (array_key_exists($column, $this->columnWidth))
                $factor = $this->columnWidth [$column];

            $width = 100 + $factor * 20;

            $this->columnWidthCalc [$column] = $width;
            $this->headerWidthCalc [$column] = $width;
            $total += $width;
        }

        $availableWidthCell = $this->renderWidth - $marginCell->totalWidth() * $this->columns - (($this->columns + 1) * $typoSettings->cellborderwidth);

        for ($column = 0; $column < $this->columns; $column++) {
            $this->columnWidthCalc [$column] = floor($this->columnWidthCalc [$column] / $total * $availableWidthCell);
        }

        $availableWidthHeader = $this->renderWidth - $marginHeader->totalWidth() * $this->columns - (($this->columns + 1) * $typoSettings->cellheaderborderwidth);

        for ($column = 0; $column < $this->columns; $column++) {
            $this->headerWidthCalc [$column] = floor($this->headerWidthCalc [$column] / $total * $availableWidthHeader);
        }
    }

    /**
     *
     * Render a cell
     *
     * @param int $column
     * @param int $row
     */
    private function renderCell($column, $row)
    {
        $cell = ($this->cell($column, $row));
        switch (substr($cell, 0, 4)) {
            case 'txt:' :
                $this->textAlign = null;
                $this->verticalAlign = null;
                return $this->richText->parse(substr($cell, 4));
            case 'lst:' :
                $this->textAlign = null;
                $this->verticalAlign = null;
                $result = $this->richText->parse(substr($cell, 4));
                $ul = sprintf('<ul style="list-style: url(classes/plugins/ngpluginparagraph/ngpluginparagraphtable/styles/img/?f=%s&c=%s)">', $this->bulletstyle, $this->bulletcolor);
                return str_replace('<ul>', $ul, $result);
            case 'int:' :
                $this->textAlign = 'right';
                $this->verticalAlign = null;
                return number_format(substr($cell, 4), 0, NGConfig::DecimalSeparator, NGConfig::ThousandsSeparator);
            case 'dbl:' :
                $this->textAlign = 'right';
                $this->verticalAlign = null;
                return number_format(substr($cell, 4), 2, NGConfig::DecimalSeparator, NGConfig::ThousandsSeparator);
            case 'dat:' :
                $this->textAlign = 'center';
                $this->verticalAlign = null;
                $date = new DateTime (substr($cell, 4));
                return $date->format(NGConfig::DateFormatLocal);
            case 'boo:' :
                $this->textAlign = 'center';
                $this->verticalAlign = 'middle';
                return (NGUtil::StringXMLToBool(substr($cell, 4))) ? '<span class="paragraphtablecheck"></span>' : '';
            case 'pic:' :
                $this->textAlign = 'center';
                $this->verticalAlign = 'middle';
                $picwidth = ($this->columnHeaders && $row == 0) ? $this->headerWidthCalc [$column] : $this->columnWidthCalc [$column];

                if ($this->pivot && $this->responsive && $picwidth < 768)
                    $picwidth = 768;

                return $this->renderCellPicture(substr($cell, 4), $picwidth);
            case 'icn:' :
                $this->textAlign = 'center';
                $this->verticalAlign = 'middle';

                return $this->renderCellIcon(substr($cell, 4));
            case 'btn:' :
                $this->textAlign = 'center';
                $this->verticalAlign = 'middle';

                return $this->renderCellButton(substr($cell, 4));
            default :
                return '&nbsp;';
        }
    }

    /**
     *
     * Render cell as icon
     *
     * @param $cell
     * @return string
     */
    private function renderCellIcon($cell)
    {
        $parts = explode('|', $cell);

        if (count($parts) !== 2 && count($parts) !== 4) return '';

        if ($this->icon === null) {
            $this->icon = new NGPluginIcon();
            $this->icon->class = 'paragraphtableicon';
        }

        $this->icon->styles['width'] = $parts[1] . 'px';
        $this->icon->styles['height'] = $parts[1] . 'px';

        if (count($parts) == 4) {
            $a = new NGRenderA();
            $a->content = $this->icon->getSvg($parts[0]);

            $link = new NGLink($this->previewMode);

            $link->parseURL($parts[2]);

            $a->href = $link->getURL();

            if ($parts[3] !== '') $a->attributes['title'] = $parts[3];

            switch ($link->linkType) {
                case NGLink::LinkPagePopup :
                case NGLink::LinkTopicPopup :
                    $a->class = ' galleryiframe';
                    break;
                case NGLink::LinkWWW :
                    $a->attributes['target'] = '_blank';
                    break;
                case NGLink::LinkPicture :
                    $a->class .= ' gallery';
                    break;
            }

            return $a->render();
        } else {
            return $this->icon->getSvg($parts[0]);
        }

    }

    /**
     *
     * Render cell as button
     *
     * @param $cell
     * @return string
     */
    private function renderCellButton($cell)
    {
        $parts = explode('|', $cell);

        if (count($parts) !== 2) return '';

        if ($parts[0] === '') return '';
        if ($parts[1] === '') return '';

        $tag = new NGRenderA();
        $tag->content = $parts[0];

        $link = new NGLink($this->previewMode);

        $link->parseURL($parts[1]);

        $tag->href = $link->getURL();

        $tag->class = 'paragraphtablebutton';

        switch ($link->linkType) {
            case NGLink::LinkPagePopup :
            case NGLink::LinkTopicPopup :
                $tag->class .= ' galleryiframe';
                break;
            case NGLink::LinkWWW :
                $tag->attributes['target'] = '_blank';
                break;
            case NGLink::LinkPicture :
                $tag->class .= ' gallery';
                break;
        }

        return $tag->render();

    }


    /**
     *
     * Render cell with picture
     *
     * @param string $cell
     * @param int $maxWidth
     */
    private function renderCellPicture($cell, $maxWidth)
    {
        $parts = explode('|', $cell);

        switch (count($parts)) {
            case 1:
                $partsuid = $parts[0];
                $partsclick = '';
                $partslink = '';
                $partstitle = '';
                $partsscale = 'Fill';
                break;
            case 2:
                $partsuid = $parts[0];
                $partsclick = '';
                $partslink = '';
                $partstitle = '';
                $partsscale = $parts[1];
                break;
            case 4:
                $partsuid = $parts[0];
                $partsclick = $parts[1];
                $partslink = $parts[2];
                $partstitle = $parts[3];
                $partsscale = 'Fill';
                break;
            case 5:
                $partsuid = $parts[0];
                $partsclick = $parts[1];
                $partslink = $parts[2];
                $partstitle = $parts[3];
                $partsscale = $parts[4];
                break;
        }


        if ($partsuid !== '') {

            $pictureAdapter = new NGDBAdapterObject ();

            /* @var $picture NGPicture */
            $picture = $pictureAdapter->loadObject($partsuid, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

            if ($picture != null) {

                $size = $picture->getResizedSize($maxWidth, -1);

                $url = htmlspecialchars(NGLink::getPictureURL($partsuid, $maxWidth));
                $urlHd = htmlspecialchars(NGLink::getPictureURL($partsuid, $maxWidth * 2));
                $fullurl = htmlspecialchars(NGLink::getPictureURL($partsuid));

                $linkurl = '';
                $linkclass = 'gallery';
                $linktarget = '';

                switch ($partsclick) {
                    case 'DoNothing' :
                        $link = '';
                        break;
                    case 'Enlarge' :
                        $linkurl = $fullurl;
                    case 'Link' :
                        $link = new NGLink ($this->previewMode);
                        $link->parseURL($partslink);
                        $linkurl = $link->getURL();
                        switch ($link->linkType) {
                            case NGLink::LinkPagePopup :
                            case NGLink::LinkTopicPopup :
                                $linkclass = 'galleryiframe';
                                break;
                            case NGLink::LinkWWW :
                                $linkclass = '';
                                $linktarget = '_blank';
                                break;
                            case NGLink::LinkPage :
                            case NGLink::LinkTel :
                            case NGLink::LinkMailTo :
                            case NGLink::LinkTopic :
                            case NGLink::LinkDownload :
                                $linkclass = '';
                                break;
                        }
                        break;
                    default :
                        $linkurl = NGLink::getPictureURL($partsuid);
                        break;
                }

                $img = new NGRenderTag ('img', true);

                if (NGSettingsSite::getInstance()->lazyload) {
                    $img->attributes ['data-src'] = $url;
                    $img->attributes ['src'] = NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/img/trans.gif');
                    $img->class = 'nglazyload';
                    if (NGSettingsSite::getInstance()->hdpictures) {
                        $img->attributes ['data-src-hd'] = $urlHd;
                    }
                } else {
                    $img->attributes ['src'] = $url;
                }

                if ($this->responsive) {
                    $img->attributes ['width'] = $size->width;
                    $img->attributes ['height'] = $size->height;
                    $img->style->selectors ['width'] = '100%';
                    $img->style->selectors ['height'] = 'auto';

                    if ($partsscale === 'Center') {
                        $img->style->selectors ['max-width'] = $size->width . 'px';
                        $img->style->selectors ['margin-left'] = 'auto';
                        $img->style->selectors ['margin-right'] = 'auto';
                    }
                } else {
                    $img->style->selectors ['width'] = $size->width . 'px';
                    $img->style->selectors ['height'] = $size->height . 'px';
                }

                $img->attributes ['alt'] = $picture->displayAlt();
                if ($picture->title !== '')
                    $img->attributes ['title'] = $picture->title;

                if ($linkurl !== '') {
                    $a = new NGRenderTag ('a');
                    $a->attributes ['href'] = $linkurl;
                    if ($linkclass !== '')
                        $a->class = $linkclass;
                    if ($linktarget !== '')
                        $a->attributes ['target'] = $linktarget;
                    if ($partstitle !== '')
                        $a->attributes ['title'] = $partstitle;
                    $a->content = $img->render();

                    return $a->render();
                } else {
                    return $img->render();
                }
            }
        }
    }

    /**
     *
     * Get cell data
     *
     * @param int $column
     * @param int $row
     */
    private function cell($column, $row)
    {
        $id = $column . ':' . $row;

        if (array_key_exists($id, $this->cells)) {
            return $this->cells [$id];
        } else {
            return '';
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->richText = new NGRichText ();
    }
}