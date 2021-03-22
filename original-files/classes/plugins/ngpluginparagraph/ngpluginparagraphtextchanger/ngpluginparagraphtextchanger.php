<?php

class NGPluginParagraphTextChanger extends NGPluginParagraph
{
    const ObjectTypePluginParagraphTextChanger = 'NGPluginParagraphTextChanger';
    const Product = 'SIQUANDO Pro 5';
    const DomainParagraphTextChanger = "paragraphtextchanger";

    public $items = array();

    public $delay = 5;

    private $richText;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('items', NGProperty::TypeText, self::DomainParagraphTextChanger, 'items', NGPropertyMapped::MultiplicityList, true, null, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('delay', NGProperty::TypeInt, self::DomainParagraphTextChanger, 'delay', NGPropertyMapped::MultiplicityScalar, false, 5, false);
    }

    public function render()
    {
        if (count($this->items) > 0) {
            $this->richText->previewMode = $this->previewMode;

            $div = new NGRenderTag ('div');
            $div->class = 'ngparagraphtextchanger';
            $div->attributes ['data-delay'] = $this->delay;

            $ul = new NGRenderTag ('ul');

            $li = new NGRenderTag ('li');

            foreach ($this->items as $item) {
                $li->content = $this->richText->parse($item);
                $ul->content .= $li->render();
            }

            $div->content = $ul->render();

            $this->output = $div->render();

            $this->styleSheets ['NGPluginParagraphTextChanger'] = $this->prependPluginsPath('ngpluginparagraphtextchanger/css/style.css');
            $this->javaScripts ['NGPluginParagraphTextChanger'] = $this->prependPluginsPath('ngpluginparagraphtextchanger/js/textchanger.js');
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->richText = new NGRichText ();
    }
}