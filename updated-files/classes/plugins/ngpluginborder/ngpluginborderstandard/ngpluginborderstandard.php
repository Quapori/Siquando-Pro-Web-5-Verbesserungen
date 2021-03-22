<?php

class NGPluginBorderStandard {

	public $input;

	public $output;

	public $inputWidth;

	public $outputWidth;

	public $objectUID;

	public $responsive = false;

	public $localStyle = true;

	/**
	 *
	 * Settings
	 *
	 * @var NGPluginBorderStandardSettings
	 */
	public $settings;

	/**
	 *
	 * Array with links to style sheets
	 *
	 * @var Array
	 */
	public $styles = Array ();

	/**
	 *
	 * Array with links to style sheets
	 *
	 * @var Array
	 */
	public $styleSheets = Array ();

	public function prepare() {
		if (! $this->localStyle) {
			$this->adapater = new NGDBAdapterObject ();
			$this->settings = $this->adapater->loadSetting ( NGPluginBorderStandardSettings::IdBorder, NGPluginBorderStandardSettings::ObjectTypeBorderSettings );
		}
		$this->outputWidth = $this->inputWidth - $this->totalExtraWidth ( $this->settings->margin, $this->settings->padding, $this->settings->borderwidth );
	}

	public function render() {
		$this->template = new NGTemplate ();
		
		if ($this->localStyle) {
			$this->templateCSS = new NGRenderCSS ();
			$this->templateCSS->templateFilename = 'ngpluginborder/ngpluginborderstandard/tpl/css.tpl';
			$this->templateCSS->template->assign ( 'settings', $this->settings );
			$this->templateCSS->template->assign ( 'uid', $this->objectUID );
			$this->templateCSS->render ();
			$this->styles ['border' . $this->objectUID] = $this->templateCSS->output;
			$this->template->assign ( 'uid', $this->objectUID );
		} else {
			$this->styleSheets ['NGBorderStandard'] = NGUtil::prependRootPath ( 'classes/plugins/ngpluginborder/ngpluginborderstandard/css/' );
			$this->template->assign ( 'uid', 'default' );
		}
		
		$this->template->assign ( 'para', $this->input );
		$this->template->assign ( 'width', $this->outputWidth );
		$this->template->assign ( 'responsive', $this->responsive );
		
		$this->output = $this->template->fetchPluginTemplate ( 'ngpluginborder/ngpluginborderstandard/tpl/border.tpl' );
	}

	public function __construct() {
		$this->settings = new NGPluginBorderStandardSettings ();
	}

	private function totalExtraWidth($marginvalue, $paddingvalue, $bordervalue) {
		$margin = new NGMargin ( $marginvalue );
		$padding = new NGMargin ( $paddingvalue );
		$border = new NGMargin ( $bordervalue );
		
		return $margin->totalWidth () + $padding->totalWidth () + $border->totalWidth ();
	}
}