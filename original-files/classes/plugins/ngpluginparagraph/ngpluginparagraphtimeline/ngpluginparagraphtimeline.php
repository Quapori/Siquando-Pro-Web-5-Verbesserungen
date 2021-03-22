<?php

class NGPluginParagraphTimeline extends NGPluginParagraph {
	const ObjectTypePluginParagraphTimeline = 'NGPluginParagraphTimeline';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphTimeline = 'paragraphtimeline';

	public $items = array ();

	public $dark = 'dddddd';

	public $bright = 'ffffff';

	public $animate = false;
	
	public $columns = 2;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTimeline, 'items', NGPropertyMapped::MultiplicityList, true, null, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'dark', NGProperty::TypeString, self::DomainParagraphTimeline, 'dark', NGPropertyMapped::MultiplicityScalar, false, 'eeeeee', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'bright', NGProperty::TypeString, self::DomainParagraphTimeline, 'bright', NGPropertyMapped::MultiplicityScalar, false, 'ffffff', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'animate', NGProperty::TypeBool, self::DomainParagraphTimeline, 'animate', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'columns', NGProperty::TypeInt, self::DomainParagraphTimeline, 'columns', NGPropertyMapped::MultiplicityScalar, false, 2, false );
	}

	public function render() {
		if (count ( $this->items ) > 0) {
			$template = new NGTemplate ();
			$richText = new NGRichText ();
			$richText->previewMode = $this->previewMode;
			$pictureAdapter = new NGDBAdapterObject ();
			
			$renderWidth = floor ( $this->renderWidth / $this->columns );
			
			if ($renderWidth < 768 && $this->responsive)
				$renderWidth = 768;
			
			$webitems = array ();
			
			foreach ( $this->items as $item ) {
				
				$webitem = new NGPluginParagraphTimelineItem ();
				
				$xml = new DOMDocument ( '1.0', 'UTF-8' );
				$xml->loadXML ( $item );
				
				/* @var $childElement DOMElement */
				foreach ( $xml->documentElement->childNodes as $childElement ) {
					if ($childElement->nodeType == XML_ELEMENT_NODE) {
						switch ($childElement->nodeName) {
							case 'caption' :
								$webitem->caption = $childElement->nodeValue;
								break;
							case 'summary' :
								$webitem->summary = $richText->parse ( $childElement->nodeValue );
								break;
							case 'position' :
								$webitem->position = strtolower ( $childElement->nodeValue );
								break;
							case 'pictureuid' :
								/* @var $picture NGPicture */
								$picture = $pictureAdapter->loadObject ( $childElement->nodeValue, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture );
								if ($picture != null) {
									$webitem->picture = $childElement->nodeValue;
									$webitem->picturesize = $picture->getResizedSize ( $renderWidth, - 1 );
									$webitem->pictureurl = NGLink::getPictureURL ( $childElement->nodeValue, $renderWidth );
									$webitem->picturetitle = $picture->caption;
									$webitem->picturealt = $picture->displayAlt();
									
									if (NGSettingsSite::getInstance ()->lazyload) {
										if (NGSettingsSite::getInstance ()->hdpictures) {
											$webitem->pictureurlhd = NGLink::getPictureURL ( $picture->objectUID, $webitem->picturesize->width * 2, $webitem->picturesize->height * 2 );
										}
									}
								}
								break;
							case 'style' :
								$webitem->bullet = $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphtimeline/img/?f=%s&ca=%s&cb=%s', $childElement->nodeValue, $this->dark, $this->bright ) );
								break;
							case 'click' :
								$webitem->click = $childElement->nodeValue;
								break;
							case 'link' :
								$webitem->link = $childElement->nodeValue;
								break;
						}
					}
				}
				
				if (isset ( $webitem->pictureurl )) {
					
					switch ($webitem->click) {
						case 'Enlarge' :
							$webitem->linkurl = NGLink::getPictureURL ( $webitem->picture );
							$webitem->linkclass = 'gallery';
							break;
						case 'Link' :
							$link = new NGLink ( $this->previewMode );
							$link->parseURL ( $webitem->link );
							$webitem->linkurl = $link->getURL ();
							switch ($link->linkType) {
								case NGLink::LinkPicture :
									$webitem->linkclass = 'gallery';
									break;
								case NGLink::LinkPagePopup :
								case NGLink::LinkTopicPopup :
									$webitem->linkclass = 'galleryiframe';
									break;
								case NGLink::LinkWWW :
									$webitem->linktarget = '_blank';
									break;
							}
							break;
					}
				}
				
				$webitems [] = $webitem;
			}
			
			$template->assign ( 'items', $webitems );
			$template->assign ( 'bar', $this->prependPluginsPath ( sprintf ( 'ngpluginparagraphtimeline/img/?f=bar&ca=%s', $this->dark ) ) );
			$template->assign ( 'id', $this->objectUID );
			$template->assign ( 'animate', $this->animate );
			$template->assign ( 'columns', $this->columns );
			
			if (NGSettingsSite::getInstance ()->lazyload) {
				$template->assign ( 'lazyload', NGUtil::prependRootPath ( 'classes/plugins/ngpluginlazyload/img/trans.gif' ) );
			}
			
			if ($this->animate) {
				$this->javaScripts ['NGPluginParagraphTimeline'] = $this->prependPluginsPath ( 'ngpluginparagraphtimeline/js/timeline.js' );
			}
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphtimeline/tpl/layout.tpl' );
			$this->styleSheets ['NGPluginParagraphTimeline'] = $this->prependPluginsPath ( 'ngpluginparagraphtimeline/css/style.css' );
		}
	}

	public function __construct() {
		parent::__construct ();
	}
}

class NGPluginParagraphTimelineItem {

	public $caption;

	public $summary;

	public $position = 'left';

	public $bullet;

	public $picture;

	public $pictureurl;

	public $pictureurlhd;

	public $picturesize;

	public $click = 'Enlarge';

	public $link = '';

	public $linkurl;

	public $linkclass;

	public $linktarget;
	
	public $picturetitle='';
	
	public $picturealt='';
}