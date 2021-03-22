<?php

class NGPluginSubNavigation {
	private $bouquet;
	
	private $template;
	
	public $mode;
	
	public $previewMode;
	
	/**
	 * 
	 * Enter description here ...
	 * @var NGPluginPage
	 */
	public $currentPage;
	public $output = '';
	
	public $javaScripts = Array ();
	
	public $styleSheets = Array ();
	
	public function render() {
		$this->bouquet = new NGBouquet ();
		$this->bouquet->itemSource = NGBouquet::ItemsSourceChildPages;
		$this->bouquet->sortMode = NGBouquet::SortModeNatural;
		$this->bouquet->parentUID = $this->currentPage->parentUID;
		$this->bouquet->previewMode = $this->previewMode;
		$this->bouquet->prepare ();
		
		if (count ( $this->bouquet->items ) > 1) {
			
			$this->template = new NGTemplate ();
			$this->template->assign ( 'items', $this->bouquet->items );
			$this->template->assign ( 'current', $this->currentPage->objectUID );
			
			switch ($this->mode) {
				case 'dropdown' :
					self::renderDropDown ();
					break;
				case 'numbers' :
					self::renderNumbers ();
					break;
				case 'nextprevious' :
					self::renderNextPrevious ();
					break;
			}
		}
	}
	
	private function renderDropDown() {
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginsubnavigation/tpl/dropdown.tpl' );
		$this->javaScripts ['ngsubnavdropdown'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginsubnavigation/js/dropdown.js' );
		$this->styleSheets ['ngsubnavdropdown'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginsubnavigation/css/dropdown.css' );
	}
	
	private function renderNumbers() {
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginsubnavigation/tpl/numbers.tpl' );
		$this->styleSheets ['ngsubnavnumbers'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginsubnavigation/css/numbers.css' );
	}
	
	private function renderNextPrevious() {
		$this->template->assign ( 'lang', NGSession::getInstance ()->getLanguageRessource ( NGUtil::LanguageResourcesMain ) );
		
		$previous = '';
		$next = '';
		$currentFound = false;
		
		foreach ( $this->bouquet->items as $item ) {
			/* @var $item NGBouquetItem */
			if ($item->item->objectUID == $this->currentPage->objectUID) {
				$currentFound = true;
			} else {
				if ($currentFound) {
					$next = $item->displayLink ()->getURL ();
					break;
				} else {
					$previous = $item->displayLink ()->getURL ();
				}
			}
		}
		$this->template->assign ( 'previous', $previous );
		$this->template->assign ( 'next', $next );
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginsubnavigation/tpl/nextprevious.tpl' );
		$this->styleSheets ['ngsubnavnumbers'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginsubnavigation/css/nextprevious.css' );
	}
}