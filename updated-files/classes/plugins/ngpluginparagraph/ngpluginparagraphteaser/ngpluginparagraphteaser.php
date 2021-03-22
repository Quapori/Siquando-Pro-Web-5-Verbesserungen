<?php

class NGPluginParagraphTeaser extends NGPluginParagraph {
	const ObjectTypePluginParagraphTeaser = 'NGPluginParagraphTeaser';
	const Product='SIQUANDO Pro 5';
	const DomainParagraphTeaser = "paragraphteaser";
	
	public $sortMode = '';
	public $itemsSource = '';
	public $items;
	public $itemsParentUID;
	public $teaserstyle = 'NGPluginTeaserCaption';
	public $configuration;
	public $maxitems = 0;
	public $skipitems = 0;
	
	/**
	 * 
	 * Bouquet to use
	 * @var NGBouquet
	 */
	private $bouquet;
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'sortmode', NGProperty::TypeString, self::DomainParagraphTeaser, 'sortMode', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemssource', NGProperty::TypeString, self::DomainParagraphTeaser, 'itemsSource', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'items', NGProperty::TypeText, self::DomainParagraphTeaser, 'items', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'itemsparentuid', NGProperty::TypeString, self::DomainParagraphTeaser, 'itemsParentUID', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'teaserstyle', NGProperty::TypeString, self::DomainParagraphTeaser, 'teaserstyle', NGPropertyMapped::MultiplicityScalar, false, 'NGPluginTeaserCaption', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'configuration', NGProperty::TypeText, self::DomainParagraphTeaser, 'configuration', NGPropertyMapped::MultiplicityDictornary, false, Array () );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'maxitems', NGProperty::TypeInt, self::DomainParagraphTeaser, 'maxitems', NGPropertyMapped::MultiplicityScalar, false, 0, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'skipitems', NGProperty::TypeInt, self::DomainParagraphTeaser, 'skipitems', NGPropertyMapped::MultiplicityScalar, false, 0, false );
	
	}
	
	public function render() {
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = $this->itemsSource;
		$this->bouquet->sortMode = $this->sortMode;
		$this->bouquet->itemsXML = $this->items;
		$this->bouquet->parentUID = $this->itemsParentUID != '' ? $this->itemsParentUID : $this->currentPage->parentUID;
		$this->bouquet->previewMode = $this->previewMode;
		$this->bouquet->maxItemCount = $this->maxitems;
		$this->bouquet->skipItems = $this->skipitems;
		
		$this->bouquet->prepare ($this->currentPage->objectUID);
		$this->nextScheduledChange = $this->bouquet->nextScheduledChange;
		
		$plugin = NGPluginTeaser::createByID ( $this->teaserstyle );
		$plugin->previewMode = $this->previewMode;
		$plugin->renderWidth = $this->renderWidth;
		$plugin->responsive = $this->responsive;
		$plugin->allowAlwaysFullWidth = $this->allowAlwaysFullWidth;
		$plugin->allowMobileFullWidth= $this->allowMobileFullWidth;
		$plugin->configuration = $this->configuration;
		$plugin->bouquet = $this->bouquet;
		$plugin->objectUID = $this->objectUID;
		$plugin->render ();
		$this->output = $plugin->output;
		$this->renderMode=$plugin->renderMode;
		
		foreach ( $plugin->styleSheets as $id => $stylesheet ) {
			if (! array_key_exists ( $id, $this->styleSheets ))
				$this->styleSheets [$id] = $stylesheet;
		}
		foreach ( $plugin->styles as $id => $style ) {
			if (! array_key_exists ( $id, $this->styles ))
				$this->styles [$id] = $style;
		}
		foreach ( $plugin->javaScripts as $id => $javaScript ) {
			if (! array_key_exists ( $id, $this->javaScripts ))
				$this->javaScripts [$id] = $javaScript;
		}
	
	}
}