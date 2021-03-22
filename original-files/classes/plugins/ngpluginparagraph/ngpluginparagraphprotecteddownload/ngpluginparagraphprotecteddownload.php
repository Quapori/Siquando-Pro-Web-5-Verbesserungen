<?php

class NGPluginParagraphProtectedDownload extends NGPluginParagraph {
	const ObjectTypePluginParagraphProtectedDownload = 'NGPluginParagraphProtectedDownload';
	const Product = 'SIQUANDO Pro 5';
	const DomainParagraphProtectedDownload = 'paragraphprotecteddownload';

	public $download = '';

	public $errorpage = '';

	public $instructions = '';

	public $delay = 3;

	public $validity = 10;

	/**
	 *
	 * @var NGTemplate
	 */
	private $template;

	/**
	 *
	 * @var NGRichText
	 */
	private $richtext;

	/**
	 *
	 * @var string
	 */
	private $link;

	/**
	 *
	 * @var string
	 */
	private $instrutionswithlink;

	/**
	 *
	 * @var string
	 */
	private $code;

	/*
	 * (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'download', NGProperty::TypeUID, self::DomainParagraphProtectedDownload, 'download', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'errorpage', NGProperty::TypeUID, self::DomainParagraphProtectedDownload, 'errorpage', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'instructions', NGProperty::TypeText, self::DomainParagraphProtectedDownload, 'instructions', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'delay', NGProperty::TypeInt, self::DomainParagraphProtectedDownload, 'delay', NGPropertyMapped::MultiplicityScalar, false, 3, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'validity', NGProperty::TypeInt, self::DomainParagraphProtectedDownload, 'validity', NGPropertyMapped::MultiplicityScalar, false, 120, false );
	}

	public function render() {
		if ($this->download !== '') {
			header ( 'Expires: Sun, 01 Jan 2014 00:00:00 GMT' );
			header ( 'Cache-Control: no-store, no-cache, must-revalidate' );
			header ( 'Cache-Control: post-check=0, pre-check=0', FALSE );
			header ( 'Pragma: no-cache' );
			
			$this->template = new NGTemplate ();
			
			$time = dechex ( time () );
			
			$sign = md5 ( $this->objectUID . $this->download . $this->errorpage . $time . NGConfig::InstallationId );
			
			$this->code = $this->objectUID . '-' . $time . '-' . $sign;
			
			$this->link = $this->prependPluginsPath ( 'ngpluginparagraphprotecteddownload/download/?c=' . $this->code );
			
			$this->richtext = new NGRichText ();
			$this->richtext->previewMode = $this->previewMode;
			
			$this->instrutionswithlink = preg_replace_callback ( '/(\[(.*?)\])/', function ($match) {
				if (count ( $match ) === 3) {
					return sprintf ( '<a href="%s">%s</a>', $this->link, $match [2] );
				}
				return '';
			}, $this->richtext->parse ( $this->instructions ) );
			
			$this->template->assign ( 'link', $this->link );
			$this->template->assign ( 'delay', $this->previewMode ? 0 : $this->delay );
			$this->template->assign ( 'instructions', $this->instrutionswithlink );
			
			$this->output = $this->template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphprotecteddownload/tpl/layout.tpl' );
			
			$this->javaScripts ['NGPluginParagraphProtectedDownload'] = $this->prependPluginsPath ( 'ngpluginparagraphprotecteddownload/js/protecteddownload.js' );
			
			$this->dontCache = true;
		}
	}

	public function __construct() {
		parent::__construct ();
	}
}