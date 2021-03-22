<?php

class NGPluginTeaserPictureIntro extends NGPluginTeaser
{
    const Product = 'SIQUANDO Pro 5';

    private $columns;

    private $crop;

    private $showcaptions;

    private $caption;

    private $summary;

    private $link;

    private $linkcaption;

    private $picturemargin;

    private $roundedcorners;

    private $position;

    private $panorama;

    public function render()
    {

        $this->columns = array_key_exists('columns', $this->configuration) ? intval($this->configuration ['columns']) : 4;
        $this->crop = array_key_exists('crop', $this->configuration) ? $this->configuration ['crop'] : 'Ratio1by1';
        $this->showcaptions = array_key_exists('showcaptions', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration['showcaptions']) : true;
        $this->caption = array_key_exists('caption', $this->configuration) ? $this->configuration['caption'] : '';
        $this->summary = array_key_exists('summary', $this->configuration) ? $this->configuration['summary'] : '';
        $this->link = array_key_exists('link', $this->configuration) ? $this->configuration['link'] : '';
        $this->linkcaption = array_key_exists('linkcaption', $this->configuration) ? $this->configuration['linkcaption'] : '';
        $this->picturemargin = array_key_exists('picturemargin', $this->configuration) ? intval($this->configuration ['picturemargin']) : 4;
        $this->roundedcorners = array_key_exists('roundedcorners', $this->configuration) ? intval($this->configuration ['roundedcorners']) : 0;
        $this->hover = array_key_exists('hover', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration['hover']) : true;
        $this->position = array_key_exists('position', $this->configuration) ? $this->configuration['position'] : 'left';
        $this->panorama = array_key_exists('panorama', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration['panorama']) : false;

        $renderWidth = $this->renderWidth;

        $panorama = false;

        if ($this->responsive && $this->allowAlwaysFullWidth && $this->panorama) {
            $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
            $panorama = true;
            $renderWidth = 1920;
        }

        $pictureWidth = floor($renderWidth / $this->columns * 0.75);
        $ratio = NGPicture::stringToRatio($this->crop);

        if ($this->responsive && $pictureWidth < 512)
            $pictureWidth = 512;

        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */

            $picture = $item->displayPicture();

            if ($picture != null) {
                $teaserItem = new NGPluginTeaserItem ();
                $teaserItem->link = $item->displayLink();
                $teaserItem->caption = $item->displayCaption();
                $teaserItem->picturesource = NGLink::getPictureURL($picture->objectUID, $pictureWidth, -1, $ratio);
                $teaserItem->picturesize = $picture->getResizedSize($pictureWidth, -1, $ratio);
                $this->teaserItems [] = $teaserItem;
            }
        }

        if (count($this->teaserItems) > 0) {

            $richText = new NGRichText();
            $richText->previewMode = $this->previewMode;


            $template = new NGTemplate ();

            $template->assign('items', $this->teaserItems);
            $template->assign('cols', $this->columns);
            $template->assign('picturemargin', $this->picturemargin);
            $template->assign('caption', $this->caption);
            $template->assign('summary', $richText->parse($this->summary));
            $template->assign('showcaptions', $this->showcaptions);
            $template->assign('roundedcorners', $this->roundedcorners);
            $template->assign('hover', $this->hover);
            $template->assign('position', $this->position);

            if (NGSettingsSite::getInstance()->lazyload)
                $template->assign('lazyload', NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/img/trans.gif'));

            $template->assign('panorama', $panorama);


            if ($this->link !== "") {
                $link = new NGLink();
                $link->previewMode = $this->previewMode;
                $link->parseURL($this->link);
                $template->assign('link', $link);
                $template->assign('linkcaption', $this->linkcaption);
            }

            $this->output = $template->fetchPluginTemplate('ngpluginteaser/ngpluginteaserpictureintro/tpl/template.tpl');
            $this->styleSheets ['NGPluginTeaserPictureIntro'] = $this->prependPluginsPath('ngpluginteaserpictureintro/css/');
        }
    }
}