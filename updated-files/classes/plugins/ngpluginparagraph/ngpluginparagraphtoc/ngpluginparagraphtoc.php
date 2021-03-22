<?php

class NGPluginParagraphTOC extends NGPluginParagraph
{
    const ObjectTypePluginParagraphTOC = 'NGPluginParagraphTOC';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphTOC = 'paragraphtoc';

    public $pluginstyle = 'default';
    public $coloricon = '555555';

    private $items = [];

    /* (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped[] = new NGPropertyMapped('pluginstyle', NGProperty::TypeString, self::DomainParagraphTOC, 'pluginstyle', NGPropertyMapped::MultiplicityScalar, false, 'default');
        $this->propertiesMapped[] = new NGPropertyMapped('coloricon', NGProperty::TypeString, self::DomainParagraphTOC, 'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555');

    }

    public function render()
    {
        foreach ($this->currentParagraphStream->items as $item) {
            /* @var NGParagraphOrContainerContainer $item */
            switch ($item->containerType) {
                case 'paragraph' :
                    $this->appendParagraph($item->paragraph);
                    break;
                case 'column' :
                case 'tab' :
                case 'accordion' :
                    $this->appendContainerContainer($item);
                    break;
            }
        }

        $template = new NGTemplate();

        $template->assign('items', $this->items);
        $template->assign('uid', $this->objectUID);
        $template->assign('bullet', NGUtil::prependRootPath(sprintf('classes/plugins/ngpluginparagraph/ngpluginparagraphtoc/styles/img/?f=%s&c=%s', $this->pluginstyle, $this->coloricon)));

        $this->styleSheets ['NGPluginParagraphTOC'] = $this->prependPluginsPath('ngpluginparagraphtoc/css/style.css');
        $this->javaScripts ['NGPluginParagraphTOC'] = $this->prependPluginsPath('ngpluginparagraphtoc/js/toc.js');
        $this->output = $template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphtoc/tpl/template.tpl');
    }

    /**
     * @param NGParagraphOrContainerContainer $columnContainerContainer
     */
    private function appendContainerContainer($columnContainerContainer)
    {
        /**
         * @var $columnContainer NGContainer
         */
        foreach ($columnContainerContainer->containers as $columnContainer) {
            /* @var $columnContainer NGContainer */
            foreach ($columnContainer->paragraphs as $paragraph) {
                $this->appendParagraph($paragraph);
            }
        }
    }


    /**
     * @param NGPluginParagraph $paragraph
     */
    private function appendParagraph($paragraph)
    {
        if ($paragraph->isVisible() && $paragraph->isanchor && $paragraph->objectUID!==$this->objectUID) {
            $item = new NGPluginParagraphTOCItem();
            $item->anchor = 'nga' . $paragraph->objectUID;
            $item->caption = $paragraph->anchortext === '' ? $paragraph->caption : $paragraph->anchortext;
            if ($item->caption !== '') $this->items[] = $item;
        }

    }

    public function __construct()
    {
        parent::__construct();
    }


}

class NGPluginParagraphTOCItem
{
    public $anchor;
    public $caption;
}