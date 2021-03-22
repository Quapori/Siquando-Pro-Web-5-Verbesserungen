<?php
class NGPluginParagraphAudioCharts extends NGPluginParagraph {
	const ObjectTypePluginParagraphAudioCharts = 'NGPluginParagraphAudioCharts';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphAudioCharts = 'paragraphaudiocharts';
	
	/*
	 * Loaded items
	 */
	public $items = '';
	
	/**
	 *
	 * Style
	 * 
	 * @var string
	 */
	public $pluginstyle = 'default';
	
	/**
	 * 
	 * Color of icon
	 * 
	 * @var string
	 */
	public $coloricon = '555555';
	
	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphAudioCharts, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'pluginstyle', NGProperty::TypeString, self::DomainParagraphAudioCharts, 'pluginstyle', NGPropertyMapped::MultiplicityScalar, false, 'default', false );
		$this->propertiesMapped[]=new NGPropertyMapped('coloricon', NGProperty::TypeString,self::DomainParagraphAudioCharts,'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555');
	}
	public function render() {
		$tracks = Array ();
		
		$controller = new NGDBAdapterObject ();
		
		if ($this->items !== '') {
			
			$xml = new DOMDocument ( '1.0', 'UTF-8' );
			$xml->loadXML ( $this->items );
			
			foreach ( $xml->documentElement->childNodes as $itemElement ) {
				/* @var $itemElement DOMElement */
				if ($itemElement->nodeType == XML_ELEMENT_NODE) {
					if ($itemElement->nodeName == 'item') {
						$track = new NGPluginParagraphAudioChartsTrack ();
						
						foreach ( $itemElement->childNodes as $node ) {
							/* @var $node DOMElement */
							if ($node->nodeType == XML_ELEMENT_NODE) {
								switch ($node->nodeName) {
									case 'uid' :
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$track->url = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'ogg' :
										$download = $controller->loadObject ( $node->nodeValue, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
										if ($download != null)
											$track->ogg = NGUtil::prependStorePath ( $download->pathToFile () );
										break;
									case 'caption' :
										$track->caption = $node->nodeValue;
										break;
								}
							}
						}
						
						if ($track->url !== '')
							$tracks [] = $track;
					}
				}
			}
			
			if (count ( $tracks ) > 0) {
				
				$template = new NGTemplate ();
				
				$template->assign ( 'tracks', $tracks );
				$template->assign ( 'id', $this->objectUID );
				
				$this->styleSheets ['NGPluginParagraphAudioCharts'] = $this->prependPluginsPath ( 'ngpluginparagraphaudiocharts/css/' );
				$this->javaScripts ['NGPluginParagraphAudioCharts'] = $this->prependPluginsPath ( 'ngpluginparagraphaudiocharts/js/audiocharts.js' );
				
				$styleTemplate = new NGTemplate ();
				$styleTemplate->assign ( 'id', $this->objectUID );
				
				if (substr ( $this->pluginstyle, - 4 ) === '.svg') {
					$styleTemplate->assign ( 'src', NGUtil::prependRootPath ( sprintf ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphaudiocharts/styles/img/?f=%s&c=%s', substr ( $this->pluginstyle, 0, - 4 ), $this->coloricon ) ) );
				} else {
					$styleTemplate->assign ( 'src', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphaudiocharts/styles/sprites_' . $this->pluginstyle . '.png' ) );
				}
				
				$this->styles ['NGPluginParagraphAudioCharts' . $this->objectUID] = $styleTemplate->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphaudiocharts/tpl/localstyle.tpl' );
				
				$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphaudiocharts/tpl/layout.tpl' );
			}
		}
	}
}
class NGPluginParagraphAudioChartsTrack {
	public $caption = '';
	public $url = '';
	public $ogg;
}