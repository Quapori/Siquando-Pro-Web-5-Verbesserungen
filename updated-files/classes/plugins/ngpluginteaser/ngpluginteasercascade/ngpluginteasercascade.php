<?php

class NGPluginTeaserCascade extends NGPluginTeaser
{
    const Product = 'SIQUANDO Pro 5';

    private $columns;
    private $rows;
    private $foreground;
    private $background;
    private $backgroundfill;
    private $crop;
    private $panorama;
    private $padding;
    private $innerpadding;
    private $hover;
    private $textshow;
    private $lazy;
    private $shadow;

    public function render()
    {
        $this->columns = array_key_exists('columns', $this->configuration) ? intval($this->configuration ['columns']) : 4;
        $this->rows = array_key_exists('rows', $this->configuration) ? intval($this->configuration ['rows']) : 0;
        $this->foreground = array_key_exists('foreground', $this->configuration) ? $this->configuration ['foreground'] : '444444';
        $this->background = array_key_exists('background', $this->configuration) ? $this->configuration ['background'] : 'ffffff';
        $this->backgroundfill = array_key_exists('backgroundfill', $this->configuration) ? $this->configuration ['backgroundfill'] : '';
        $this->crop = array_key_exists('crop', $this->configuration) ? $this->configuration ['crop'] : 'RatioUnknown';
        $this->panorama = array_key_exists('panorama', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['panorama']) : false;
        $this->hover = array_key_exists('hover', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['hover']) : true;
        $this->padding = array_key_exists('padding', $this->configuration) ? ((int)$this->configuration ['padding']) : 20;
        $this->innerpadding = array_key_exists('innerpadding', $this->configuration) ? ((int)$this->configuration ['innerpadding']) : 20;
        $this->textshow = array_key_exists('textshow', $this->configuration) ? $this->configuration['textshow'] : '';
        $this->lazy = array_key_exists('lazy', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['lazy']) : false;
        $this->shadow = array_key_exists('shadow', $this->configuration) ? NGUtil::StringXMLToBool($this->configuration ['shadow']) : true;

        $renderWidth = $this->renderWidth;

        if ($this->allowAlwaysFullWidth && $this->panorama) $renderWidth = 1920;

        $pictureWidth = floor($renderWidth / $this->columns);

        $pictureWidth = $pictureWidth - $this->padding * 2;

        $realPictureWidth = $pictureWidth;
        $ratio = NGPicture::stringToRatio($this->crop);

        $richtext = new NGRichText ();
        $richtext->previewMode = $this->previewMode;

        if ($this->responsive && $pictureWidth < 768 - $this->padding * 2)
            $pictureWidth = 768 - $this->padding * 2;

        $columns = array($this->columns);
        $height = array($this->columns);

        for ($i = 0; $i < $this->columns; $i++) {
            $height[$i] = 0;
            $columns[$i] = array();
        }

        $maxitems = $this->rows * $this->columns;
        $showbutton = false;
        $itemcount = 0;

        foreach ($this->bouquet->items as $item) {
            /* @var $item NGBouquetItem */

            $teaserItem = new NGPluginTeaserItem ();
            $teaserItem->link = $item->displayLink();
            $teaserItem->caption = $item->displayCaption();

            $picture = $item->displayPicture();

            if ($picture != null) {
                $teaserItem->picturesource = NGLink::getPictureURL($picture->objectUID, $pictureWidth, -1, $ratio);
                $teaserItem->picturesize = $picture->getResizedSize($pictureWidth, -1, $ratio);
                $teaserItem->summary = $richtext->parse($item->displaySummary());

                $itemcount++;

                if ($maxitems !== 0 && $itemcount > $maxitems) {
                    $showbutton = true;
                    $teaserItem->hidden = true;
                } else {
                    $teaserItem->hidden = false;
                }

                $column = 0;
                $smallesttop = 9999999;

                for ($i = 0; $i < $this->columns; $i++) {
                    if ($height[$i] < $smallesttop) {
                        $column = $i;
                        $smallesttop = $height[$i];
                    }
                }

                $itemheight = $picture->getResizedSize($realPictureWidth, -1, $ratio)->height;
                $itemheight += floor(strlen($teaserItem->summary) * 100 / $realPictureWidth * 2);

                $columns[$column][] = $teaserItem;
                $height[$column] += $itemheight;
            }


        }

        $template = new NGTemplate ();

        $template->assign('items', $this->teaserItems);
        $template->assign('foreground', $this->foreground);
        $template->assign('background', $this->background);
        $template->assign('backgroundfill', $this->backgroundfill);
        $template->assign('columns', $columns);
        $template->assign('padding', $this->padding);
        $template->assign('innerpadding', $this->innerpadding);
        $template->assign('halfpadding', floor($this->padding / 2));
        $template->assign('columncount', $this->columns);
        $template->assign('uid', $this->objectUID);
        $template->assign('hover', $this->hover);
        $template->assign('lazy', $this->lazy);
        $template->assign('showbutton', $showbutton);
        $template->assign('textshow', $this->textshow);
        $template->assign('shadow', $this->shadow);

        if ($showbutton) {
            $adapter = new NGDBAdapterObject ();

            /* @var $settings NGPluginTypographySettings */
            $typographysettings = $adapter->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);
            $template->assign('settings', $typographysettings);
        }

        if ($this->lazy) {
            $template->assign ( 'transgif', NGUtil::prependRootPath('classes/plugins/ngpluginlazyload/img/trans.gif') );
        }

        $this->output = $template->fetchPluginTemplate('ngpluginteaser/ngpluginteasercascade/tpl/template.tpl');
        $this->styleSheets ['NGPluginTeaserCascade'] = $this->prependPluginsPath('ngpluginteasercascade/css/style.css');
        $this->styles ['NGPluginTeaserCSC' . $this->objectUID] = $template->fetchPluginTemplate('ngpluginteaser/ngpluginteasercascade/tpl/css.tpl');

        if ($showbutton || $this->lazy) $this->javaScripts ['NGPluginTeaserCSC'] = $this->prependPluginsPath('ngpluginteasercascade/js/cascade.js');

        if ($this->responsive && $this->allowMobileFullWidth) $this->renderMode = NGPluginParagraph::RenderModeMobileFullWidth;
        if ($this->responsive && $this->allowAlwaysFullWidth && $this->panorama) $this->renderMode = NGPluginParagraph::RenderModeAlwaysFullWidth;
    }
}