<?php

class NGParagraphStream extends NGObjectNamed
{
    const ObjectTypeParagraphStream = 'NGParagraphStream';
    const DomainParagraphStream = 'paragraphstream';
    const ParagraphStreamHeader = 'header';
    const ParagraphStreamSidebarLeft = 'sidebarleft';
    const ParagraphStreamContent = 'content';
    const ParagraphStreamSidebarRight = 'sidebarright';
    const ParagraphStreamFooter = 'footer';

    /**
     *
     * Width to render
     *
     * @var int
     */
    public $renderWidth = 0;

    /**
     *
     * Render page in preview mode
     *
     * @var bool
     */
    public $previewMode = false;

    /**
     *
     * Output of renderer
     *
     * @var string
     */
    public $output = '';

    /**
     *
     * Web version of picture
     *
     * @var string
     */
    public $sortManual = '';

    /**
     *
     * Render as responsive
     *
     * @var bool
     */
    public $responsive = false;

    /**
     *
     * Render fullwidth
     *
     * @var bool
     */
    public $allowAlwaysFullWidth = false;

    /**
     *
     * Render fullwidth
     *
     * @var bool
     */
    public $allowMobileFullWidth = false;

    /**
     *
     * Mobile width
     *
     * @var integer
     */
    public $mobileWidth = 1023;

    /**
     *
     * All items, paragraphs and containers
     *
     * @var Array
     */
    public $items = Array();

    /**
     *
     * All paragraphs
     *
     * @var Array
     */
    private $allParagraphs = Array();

    /**
     *
     * Paragraphs found in list
     *
     * @var Array
     */
    private $foundParagraphs = Array();

    /**
     *
     * Spacing of tabs inside
     *
     * @var int
     */
    public $tabSpacing = 20;

    /**
     *
     * Indentation of accordion
     *
     * @var int
     */
    public $accordionIndent = 20;

    /**
     *
     * Array with links to style sheets
     *
     * @var Array
     */
    public $styleSheets = Array();

    /**
     *
     * Array with inline styles
     *
     * @var Array
     */
    public $styles = Array();

    /**
     *
     * Array with required scripts
     *
     * @var Array
     */
    public $javaScripts = Array();

    /**
     *
     * Array with metatags
     *
     * @var Array
     */
    public $metaTags = Array();

    /**
     *
     * Sets the next time the stream will change
     *
     * @var string
     */
    public $nextScheduledChange = '';

    /**
     *
     * keywords found in paragraphs
     *
     * @var string
     */
    public $keywords = '';

    /**
     *
     * Parent page
     *
     * @var NGPluginPage
     */
    public $currentPage = null;

    /**
     *
     * Is the stream visible
     *
     * @var boolean
     */
    public $isVisible = true;

    /**
     *
     * Adapter for settings
     *
     * @var NGDBAdapterObject
     */
    private $settingsAdapter = null;

    /**
     *
     * Do not cache
     *
     * @var boolean
     */
    public $dontCache = false;

    /**
     *
     * The rendered output is empty
     *
     * @var bool
     */
    public $outputEmtpy = true;


    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('sortmanual', NGProperty::TypeString, self::DomainParagraphStream, 'sortManual', NGPropertyMapped::MultiplicityScalar, false, '', false);
    }

    /**
     * Render output
     */
    public function render()
    {
        $this->styles = Array();

        $this->styleSheets = Array();

        $this->parseStructure();

        foreach ($this->items as $item) {
            /* @var NGParagraphOrContainerContainer $item */

            switch ($item->containerType) {
                case 'paragraph' :
                    $this->renderParagraph($item->paragraph, $this->renderWidth, $this->allowAlwaysFullWidth, $this->allowMobileFullWidth);
                    break;
                case 'column' :
                    $this->renderColumn($item);
                    break;
                case 'tab' :
                    $this->renderTab($item);
                    break;
                case 'faq' :
                    $this->renderFAQ($item);
                    break;
                case 'accordion' :
                    $this->renderAccordion($item);
                    break;
            }
        }

        $template = new NGTemplate ();
        $template->assign('items', $this->items);
        $template->assign('preview', $this->previewMode);
        $template->assign('streamwidth', $this->renderWidth);
        $template->assign('streamid', $this->name);
        $template->assign('streamuid', $this->objectUID);
        $template->assign('imageedit', NGUtil::prependImagesPath('ui/edit.png'));
        $template->assign('imageadd', NGUtil::prependImagesPath('ui/add.png'));
        $template->assign('imageaddtext', NGUtil::prependImagesPath('ui/addtext.png'));
        $template->assign('imageaddpicture', NGUtil::prependImagesPath('ui/addpicture.png'));
        $template->assign('imagedelete', NGUtil::prependImagesPath('ui/delete.png'));
        $template->assign('mobile', NGUtil::isMobile());
        $template->assign('responsive', $this->responsive);

        $this->output = $template->fetch('paragraphstream.tpl');
    }

    /**
     *
     * Render a column ContainerCointainer
     *
     * @param NGParagraphOrContainerContainer $columnContainerContainer
     */
    private function renderColumn(NGParagraphOrContainerContainer $columnContainerContainer)
    {
        if (NGUtil::isMobile()) {
            $columnContainerContainer->renderWidth = $this->renderWidth;
            $columnContainerContainer->gutter = 0;
        } else {
            if ($columnContainerContainer->overrideStyle) {
                $color = $columnContainerContainer->separatorColor;
                $lineWidth = $columnContainerContainer->separatorWidth;
                $gutter = $columnContainerContainer->gutter;
            } else {
                if ($this->settingsAdapter == null)
                    $this->settingsAdapter = new NGDBAdapterObject ();
                /* @var $settings NGSettingsColumns */
                $settings = $this->settingsAdapter->loadSetting(NGSettingsColumns::IdColumns, NGSettingsColumns::ObjectTypeSettingsColumns);
                $color = $settings->colorSeparator;
                $lineWidth = $settings->widthSeparator;
                $gutter = $settings->gutter;
            }

            $totalWidth = $this->renderWidth - $gutter * (count($columnContainerContainer->containers) - 1);
            $columnContainerContainer->renderWidth = floor($totalWidth / count($columnContainerContainer->containers));

            if ($this->responsive && $columnContainerContainer->renderWidth < $this->mobileWidth)
                $columnContainerContainer->renderWidth = $this->mobileWidth;

            $columnContainerContainer->gutter = $gutter;

            if ($lineWidth > 0) {
                $script = 'p' . $color;
                for ($i = 1; $i < count($columnContainerContainer->containers); $i++) {
                    $left = floor(($columnContainerContainer->renderWidth + $gutter) * $i - $gutter / 2 - $lineWidth / 2);
                    $right = $left + $lineWidth - 1;
                    $script .= 'l' . $left . 't' . $right;
                }

                if (!$this->responsive)
                    $columnContainerContainer->columnimage = NGUtil::prependImagesPath(sprintf('/divider?w=%u&s=%s', $this->renderWidth, $script));
            }
        }

        foreach ($columnContainerContainer->containers as $columnContainer) {
            /* @var $columnContainer NGContainer */
            foreach ($columnContainer->paragraphs as $paragraph) {
                $this->renderParagraph($paragraph, $columnContainerContainer->renderWidth, false, true);
            }
        }

        if (!array_key_exists('NGContainerColumns', $this->styleSheets))
            $this->styleSheets ['NGContainerColumns'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontainercolumns/css/style.css');
    }

    /**
     *
     * Render a tab ContainerContainer
     *
     * @param NGParagraphOrContainerContainer $tabContainerContainer
     */
    private function renderTab(NGParagraphOrContainerContainer $tabContainerContainer)
    {
        $tabContainerContainer->renderWidth = $this->renderWidth - (($this->tabSpacing + 1) * 2);

        if ($this->responsive && $tabContainerContainer->renderWidth < $this->mobileWidth)
            $tabContainerContainer->renderWidth = $this->mobileWidth;

        foreach ($tabContainerContainer->containers as $columnContainer) {
            /* @var $columnContainer NGContainer */
            foreach ($columnContainer->paragraphs as $paragraph) {
                $this->renderParagraph($paragraph, $tabContainerContainer->renderWidth, false, $this->allowMobileFullWidth);
            }
        }

        if (!array_key_exists('NGContainerTabs', $this->javaScripts))
            $this->javaScripts ['NGContainerTabs'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontainertab/js/tab.js');

        if ($tabContainerContainer->overrideStyle) {
            $css = new NGRenderCSS ();
            $css->templateFilename = 'ngplugincontainer/ngplugincontainertab/tpl/css.tpl';
            $css->template->assign('uid', $tabContainerContainer->uid);
            $css->template->assign('border', '#' . $tabContainerContainer->colorBorder);
            $css->template->assign('borderactive', '#' . ($tabContainerContainer->colorBorderActive === '' ? $tabContainerContainer->colorBorder : $tabContainerContainer->colorBorderActive));
            $css->template->assign('borderhover', '#' . ($tabContainerContainer->colorBorderHover === '' ? $tabContainerContainer->colorBorder : $tabContainerContainer->colorBorderHover));
            $css->template->assign('background', '#' . $tabContainerContainer->colorBackground);
            $css->template->assign('backgroundactive', '#' . ($tabContainerContainer->colorBackgroundActive === '' ? $tabContainerContainer->colorBackground : $tabContainerContainer->colorBackgroundActive));
            $css->template->assign('backgroundhover', '#' . ($tabContainerContainer->colorBackgroundHover === '' ? $tabContainerContainer->colorBackground : $tabContainerContainer->colorBackgroundHover));
            $css->template->assign('text', '#' . $tabContainerContainer->colorText);
            $css->template->assign('textactive', '#' . ($tabContainerContainer->colorTextActive === '' ? $tabContainerContainer->colorText : $tabContainerContainer->colorTextActive));
            $css->template->assign('texthover', '#' . ($tabContainerContainer->colorTextHover === '' ? $tabContainerContainer->colorText : $tabContainerContainer->colorTextHover));
            $css->template->assign('roundedcorners', $tabContainerContainer->roundedCorners);
            $css->template->assign('tabborder', $tabContainerContainer->tabBorder);
            $css->template->assign('paddingvertical', $tabContainerContainer->paddingvertical);
            $css->template->assign('paddinghorizontal', $tabContainerContainer->paddinghorizontal);

            $css->render();
            $this->styles [$tabContainerContainer->uid] = $css->output;
        } else {
            if (!array_key_exists('NGContainerTabs', $this->styleSheets))
                $this->styleSheets ['NGContainerTabs'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontainertab/css/');
        }
    }

    /**
     *
     * Render a tab ContainerContainer
     *
     * @param NGParagraphOrContainerContainer $faqContainerContainer
     */
    private function renderFAQ(NGParagraphOrContainerContainer $faqContainerContainer)
    {
        $faqContainerContainer->renderWidth = floor($this->renderWidth * 0.75);

        if ($faqContainerContainer->overrideStyle) {
            $faqContainerContainer->renderWidth -= $faqContainerContainer->paddinghorizontal;
        } else {
            if ($this->settingsAdapter == null)
                $this->settingsAdapter = new NGDBAdapterObject ();
            /* @var $settings NGSettingsFAQ */
            $settings = $this->settingsAdapter->loadSetting(NGSettingsFAQ::IdFAQ, NGSettingsFAQ::ObjectTypeSettingsFAQ);
            $faqContainerContainer->renderWidth -= $settings->paddinghorizontal;
        }

        if ($this->responsive && $faqContainerContainer->renderWidth < $this->mobileWidth)
            $faqContainerContainer->renderWidth = $this->mobileWidth;

        foreach ($faqContainerContainer->containers as $columnContainer) {
            /* @var $columnContainer NGContainer */
            foreach ($columnContainer->paragraphs as $paragraph) {
                $this->renderParagraph($paragraph, $faqContainerContainer->renderWidth, false, $this->allowMobileFullWidth);
            }
        }

        if (!array_key_exists('NGContainerFAQ', $this->javaScripts))
            $this->javaScripts ['NGContainerFAQ'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontainerfaq/js/faq.js');

        if ($faqContainerContainer->overrideStyle) {
            $css = new NGRenderCSS ();
            $css->templateFilename = 'ngplugincontainer/ngplugincontainerfaq/tpl/css.tpl';
            $css->template->assign('uid', $faqContainerContainer->uid);
            $css->template->assign('border', '#' . $faqContainerContainer->colorBorder);
            $css->template->assign('borderactive', '#' . ($faqContainerContainer->colorBorderActive === '' ? $faqContainerContainer->colorBorder : $faqContainerContainer->colorBorderActive));
            $css->template->assign('borderhover', '#' . ($faqContainerContainer->colorBorderHover === '' ? $faqContainerContainer->colorBorder : $faqContainerContainer->colorBorderHover));
            $css->template->assign('text', '#' . $faqContainerContainer->colorText);
            $css->template->assign('textactive', '#' . ($faqContainerContainer->colorTextActive === '' ? $faqContainerContainer->colorText : $faqContainerContainer->colorTextActive));
            $css->template->assign('texthover', '#' . ($faqContainerContainer->colorTextHover === '' ? $faqContainerContainer->colorText : $faqContainerContainer->colorTextHover));
            $css->template->assign('paddingvertical', $faqContainerContainer->paddingvertical);
            $css->template->assign('paddinghorizontal', $faqContainerContainer->paddinghorizontal);

            if ($this->settingsAdapter == null) $this->settingsAdapter = new NGDBAdapterObject ();
            /* @var $settingsTypo NGPluginTypographySettings */
            $settingsTypo = $this->settingsAdapter->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);
            $css->template->assign('lineheight', $settingsTypo->defaultlineheight / 100);


            $css->render();
            $this->styles [$faqContainerContainer->uid] = $css->output;
        } else {
            if (!array_key_exists('NGContainerFAQ', $this->styleSheets))
                $this->styleSheets ['NGContainerFAQ'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontainerfaq/css/');
        }
    }


    /**
     *
     * Render a accordion ContainerContainer
     *
     * @param NGParagraphOrContainerContainer $accordionContainerContainer
     */
    private function renderAccordion(NGParagraphOrContainerContainer $accordionContainerContainer)
    {
        $accordionContainerContainer->renderWidth = $this->renderWidth - $this->accordionIndent;

        foreach ($accordionContainerContainer->containers as $columnContainer) {
            /* @var $columnContainer NGContainer */
            foreach ($columnContainer->paragraphs as $paragraph) {
                $this->renderParagraph($paragraph, $accordionContainerContainer->renderWidth, false, false);
            }
        }

        if ($accordionContainerContainer->overrideStyle) {
            $css = new NGRenderCSS ();
            $css->templateFilename = 'ngplugincontainer/ngplugincontaineraccordion/tpl/css.tpl';
            $css->template->assign('uid', $accordionContainerContainer->uid);
            $css->template->assign('linewidth', $accordionContainerContainer->lineWidth);
            $css->template->assign('linecolor', $accordionContainerContainer->lineColor);
            $css->template->assign('iconcolor', $accordionContainerContainer->iconColor);

            if (substr($accordionContainerContainer->styleUID, -4) == '.svg') {
                $css->template->assign('closed', NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/styles/img/?f=' . substr($accordionContainerContainer->styleUID, 0, -4) . '_closed&c=' . $accordionContainerContainer->iconColor));
                $css->template->assign('open', NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/styles/img/?f=' . substr($accordionContainerContainer->styleUID, 0, -4) . '_open&c=' . $accordionContainerContainer->iconColor));
            } else {
                $css->template->assign('closed', NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/styles/' . $accordionContainerContainer->styleUID . '_closed.png'));
                $css->template->assign('open', NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/styles/' . $accordionContainerContainer->styleUID . '_open.png'));
            }
            $css->render();
            $this->styles [$accordionContainerContainer->uid] = $css->output;
        } else {
            if ($this->settingsAdapter == null)
                $this->settingsAdapter = new NGDBAdapterObject ();
            /* @var $settings NGSettingsAccordion */
            $settings = $this->settingsAdapter->loadSetting(NGSettingsAccordion::IdAccordion, NGSettingsAccordion::ObjectTypeSettingsAccordion);
            $accordionContainerContainer->animate = $settings->animate;

            if (!array_key_exists('NGContainerAccordion', $this->styleSheets))
                $this->styleSheets ['NGContainerAccordion'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/css/');
        }

        if (!array_key_exists('NGContainerAccordion', $this->javaScripts))
            $this->javaScripts ['NGContainerAccordion'] = NGUtil::prependRootPath('classes/plugins/ngplugincontainer/ngplugincontaineraccordion/js/accordion.js');
    }

    /**
     *
     * Render a paragraph
     *
     * @param NGPluginParagraph $paragraph
     * @param int $renderWidth
     */
    private function renderParagraph(NGPluginParagraph $paragraph, $renderWidth, $allowAlwaysFullWidth, $allowMobileFullWidth)
    {
        $paragraph->responsive = $this->responsive;

        if ($paragraph->isVisible()) {

            $this->outputEmtpy = false;

            $paragraph->previewMode = $this->previewMode;

            if ($paragraph->paragraphwidth !== 100 || $paragraph->paragraphmaxwidth !== -1) {
                $paragraph->allowAlwaysFullWidth = false;
                $paragraph->allowMobileFullWidth = false;
                $paragraph->renderWidthWithBorder = floor($renderWidth * $paragraph->paragraphwidth / 100);
                if ($paragraph->paragraphmaxwidth !== -1 && $paragraph->renderWidthWithBorder > $paragraph->paragraphmaxwidth) {
                    $paragraph->renderWidthWithBorder = $paragraph->paragraphmaxwidth;
                }
            } else {
                $paragraph->allowAlwaysFullWidth = $allowAlwaysFullWidth;
                $paragraph->allowMobileFullWidth = $allowMobileFullWidth;
                $paragraph->renderWidthWithBorder = $renderWidth;
            }

            $paragraph->currentPage = $this->currentPage;
            $paragraph->currentParagraphStream = $this;
            $paragraph->renderWithBorder();

            foreach ($paragraph->styleSheets as $id => $stylesheet) {
                if (!array_key_exists($id, $this->styleSheets))
                    $this->styleSheets [$id] = $stylesheet;
            }
            foreach ($paragraph->styles as $id => $style) {
                if (!array_key_exists($id, $this->styles))
                    $this->styles [$id] = $style;
            }
            foreach ($paragraph->javaScripts as $id => $javaScript) {
                if (!array_key_exists($id, $this->javaScripts))
                    $this->javaScripts [$id] = $javaScript;
            }
            foreach ($paragraph->metaTags as $id => $metaTag) {
                $this->metaTags [$id] = $metaTag;
            }

            if ($paragraph->dontCache)
                $this->dontCache = true;

            $this->keywords = NGUtil::joinCommaSeparatedValues($this->keywords, $paragraph->keywords);
        }
        $this->nextScheduledChange = NGUtil::nextDate($this->nextScheduledChange, $paragraph->nextScheduledChange());
    }

    /**
     * Parse the struture
     */
    private function parseStructure()
    {
        $controller = new NGDBAdapterObject ();
        $this->allParagraphs = $controller->loadChildObjects($this->objectUID, NGPluginParagraph::ObjectTypePluginParagraph, NGPluginParagraph::ObjectTypePluginParagraph, '', true, false, false, false);

        // Sort Manual

        if ($this->sortManual !== '') {

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($this->sortManual);

            foreach ($xml->documentElement->childNodes as $containerContainerOrParagraphElement) {
                /* @var $containerContainerElement DOMElement */
                if ($containerContainerOrParagraphElement->nodeType == XML_ELEMENT_NODE) {
                    $this->parseContainerContainerOrParagraph($containerContainerOrParagraphElement);
                }
            }
        }

        // Remaining

        foreach ($this->allParagraphs as $paragraph) {
            /* @var $paragraph NGPluginParagraph */
            if (!in_array($paragraph->objectUID, $this->foundParagraphs)) {
                $item = new NGParagraphOrContainerContainer ('paragraph');
                $item->paragraph = $paragraph;
                $this->items [] = $item;
            }
        }
    }

    /**
     *
     * Parse a container of pargarph
     *
     * @param DOMElement $containerContainerOrParagraphElement
     */
    private
    function parseContainerContainerOrParagraph(DOMElement $containerContainerOrParagraphElement)
    {
        switch ($containerContainerOrParagraphElement->nodeName) {
            case 'column' :
            case 'tab' :
            case 'faq' :
            case 'accordion' :
                $this->parseContainerContainer($containerContainerOrParagraphElement);
                break;
            case 'paragraph' :
                $this->parseParagraph($containerContainerOrParagraphElement);
                break;
        }
    }

    /**
     *
     * Parse a paragraph
     *
     * @param DOMElement $paragraphElement
     */
    private
    function parseParagraph(DOMElement $paragraphElement)
    {
        foreach ($this->allParagraphs as $paragraph) {
            /* @var $paragraph NGPluginParagraph */
            if ($paragraph->objectUID === $paragraphElement->nodeValue) {
                $item = new NGParagraphOrContainerContainer ($paragraphElement->nodeName);
                $item->paragraph = $paragraph;
                $this->items [] = $item;
                $this->foundParagraphs [] = $paragraph->objectUID;
                break;
            }
        }
    }

    /**
     *
     * Parse a ContainerContainer
     *
     * @param DOMElement $containerContainerElement
     */
    private
    function parseContainerContainer(DOMElement $containerContainerElement)
    {
        $item = new NGParagraphOrContainerContainer ($containerContainerElement->nodeName);

        if ($containerContainerElement->hasAttribute('uid'))
            $item->uid = $containerContainerElement->getAttribute('uid');

        if ($containerContainerElement->hasAttribute('colorborder')) {
            $item->overrideStyle = true;
            if ($containerContainerElement->hasAttribute('colorbackground'))
                $item->colorBackground = $containerContainerElement->getAttribute('colorbackground');
            if ($containerContainerElement->hasAttribute('colorbackgroundactive'))
                $item->colorBackgroundActive = $containerContainerElement->getAttribute('colorbackgroundactive');
            if ($containerContainerElement->hasAttribute('colorbackgroundhover'))
                $item->colorBackgroundHover = $containerContainerElement->getAttribute('colorbackgroundhover');
            if ($containerContainerElement->hasAttribute('colortext'))
                $item->colorText = $containerContainerElement->getAttribute('colortext');
            if ($containerContainerElement->hasAttribute('colortextactive'))
                $item->colorTextActive = $containerContainerElement->getAttribute('colortextactive');
            if ($containerContainerElement->hasAttribute('colortexthover'))
                $item->colorTextHover = $containerContainerElement->getAttribute('colortexthover');
            if ($containerContainerElement->hasAttribute('colorborder'))
                $item->colorBorder = $containerContainerElement->getAttribute('colorborder');
            if ($containerContainerElement->hasAttribute('colorborderactive'))
                $item->colorBorderActive = $containerContainerElement->getAttribute('colorborderactive');
            if ($containerContainerElement->hasAttribute('colorborderhover'))
                $item->colorBorderHover = $containerContainerElement->getAttribute('colorborderhover');
            if ($containerContainerElement->hasAttribute('roundedcorners'))
                $item->roundedCorners = $containerContainerElement->getAttribute('roundedcorners');
            if ($containerContainerElement->hasAttribute('tabborder'))
                $item->tabBorder = NGUtil::StringXMLToBool($containerContainerElement->getAttribute('tabborder'));
            if ($containerContainerElement->hasAttribute('paddingvertical'))
                $item->paddingvertical = $containerContainerElement->getAttribute('paddingvertical');
            if ($containerContainerElement->hasAttribute('paddinghorizontal'))
                $item->paddinghorizontal = $containerContainerElement->getAttribute('paddinghorizontal');
        }

        if ($containerContainerElement->hasAttribute('styleuid')) {
            $item->overrideStyle = true;
            $item->styleUID = $containerContainerElement->getAttribute('styleuid');
            $item->animate = NGUtil::StringXMLToBool($containerContainerElement->getAttribute('animate'));
            $item->lineColor = $containerContainerElement->getAttribute('linecolor');
            $item->lineWidth = $containerContainerElement->getAttribute('linewidth');

            if ($containerContainerElement->hasAttribute('iconcolor'))
                $item->iconColor = $containerContainerElement->getAttribute('iconcolor');
        }

        if ($containerContainerElement->hasAttribute('caption')) {
            $item->caption = $containerContainerElement->getAttribute('caption');
            $item->level = $containerContainerElement->getAttribute('level');
        }

        if ($containerContainerElement->hasAttribute('separatorcolor')) {
            $item->overrideStyle = true;
            $item->separatorColor = $containerContainerElement->getAttribute('separatorcolor');
            $item->separatorWidth = $containerContainerElement->getAttribute('separatorwidth');
            $item->gutter = $containerContainerElement->getAttribute('gutter');
        }

        foreach ($containerContainerElement->childNodes as $containerElement) {
            /* @var $containerElement DomElement */
            if ($containerElement->nodeType == XML_ELEMENT_NODE) {
                if ($containerElement->nodeName == 'item') {
                    $item->containers [] = $this->parseContainer($containerElement);
                }
            }
        }

        $this->items [] = $item;
    }

    /**
     *
     * Parse a Container
     *
     * @param DOMElement $containerElement
     */
    private
    function parseContainer(DOMElement $containerElement)
    {
        $item = new NGContainer ();

        if ($containerElement->hasAttribute('caption'))
            $item->caption = $containerElement->getAttribute('caption');
        if ($containerElement->hasAttribute('uid'))
            $item->uid = $containerElement->getAttribute('uid');
        if ($containerElement->hasAttribute('open'))
            $item->open = NGUtil::StringXMLToBool($containerElement->getAttribute('open'));

        foreach ($containerElement->childNodes as $paragraphElement) {
            /* @var $containerElement DomElement */
            if ($containerElement->nodeType == XML_ELEMENT_NODE) {
                foreach ($this->allParagraphs as $paragraph) {
                    /* @var $paragraph NGPluginParagraph */
                    if ($paragraph->objectUID === $paragraphElement->nodeValue) {
                        $item->paragraphs [] = $paragraph;
                        $this->foundParagraphs [] = $paragraph->objectUID;
                    }
                }
            }
        }

        return $item;
    }
}

/**
 * Represents a ContainerContainer
 */
class NGParagraphOrContainerContainer
{

    /**
     *
     * Type
     *
     * @var string
     */
    public $containerType;

    /**
     *
     * Contained containers, if ContainerContainer
     *
     * @var Array
     */
    public $containers = Array();

    /**
     *
     * Paragraph, if paragraph
     *
     * @var NGPluginParagraph
     */
    public $paragraph;

    /**
     *
     * Render width
     *
     * @var int
     */
    public $renderWidth;

    /**
     *
     * Override the tab
     *
     * @var bool
     */
    public $overrideStyle = false;

    public $colorBackground;

    public $colorBackgroundActive;

    public $colorBackgroundHover;

    public $colorText;

    public $colorTextActive = '';

    public $colorTextHover = '';

    public $colorBorder;

    public $colorBorderActive = '';

    public $colorBorderHover = '';

    public $roundedCorners;

    public $tabBorder;

    public $styleUID;

    public $animate;

    public $separatorColor;

    public $separatorWidth;

    public $columnimage = '';

    public $gutter;

    public $caption = '';

    public $level = 2;

    public $lineColor;

    public $iconColor = '333333';

    public $lineWidth;

    public $paddingvertical = 4;

    public $paddinghorizontal = 10;

    /**
     *
     * Container uid
     *
     * @var string
     */
    public $uid;

    public function __construct($containerType)
    {
        $this->containerType = $containerType;
    }
}

/**
 * Represents a container
 */
class NGContainer
{

    /**
     *
     * Caption
     *
     * @var string
     */
    public $caption;

    /**
     *
     * uid
     *
     * @var string
     */
    public $uid;

    /**
     *
     * Open on startup?
     *
     * @var bool
     */
    public $open = false;

    /**
     *
     * Contained paragraphs
     *
     * @var Array
     */
    public $paragraphs = Array();
}