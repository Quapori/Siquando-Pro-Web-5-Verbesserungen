<?php

class NGPluginParagraphAudio extends NGPluginParagraph {
	const ObjectTypePluginParagraphPicture = 'NGPluginParagraphAudio';
	const Product='SIQUANDO Pro 5';
	const DomainParagraphAudio = 'paragraphaudio';
	
	const TagAudioOpen = '<audio%s>';
	const TagSource = '<source src="%s" type="%s" />';
	const TagAudioClose = '</audio>';
	
	public $mp3 = '';
	public $ogg = '';
	public $autoplay = false;
	public $loop = false;
	public $controls = false;
	public $boilerplate = '';
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'mp3', NGProperty::TypeUID, self::DomainParagraphAudio, 'mp3', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'ogg', NGProperty::TypeUID, self::DomainParagraphAudio, 'ogg', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'autoplay', NGProperty::TypeBool, self::DomainParagraphAudio, 'autoplay', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'loop', NGProperty::TypeBool, self::DomainParagraphAudio, 'loop', NGPropertyMapped::MultiplicityScalar, false, false, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'controls', NGProperty::TypeBool, self::DomainParagraphAudio, 'controls', NGPropertyMapped::MultiplicityScalar, false, true, false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'boilerplate', NGProperty::TypeText, self::DomainParagraphAudio, 'boilerplate', NGPropertyMapped::MultiplicityScalar, false, '', false );
	}
	
	public function render() {
		$controller = new NGDBAdapterObject ();
		
		/* @var $mp3download NGDownload */
		$mp3download = null;
		
		/* @var $mp3download NGDownload */
		$oggdownload = null;
		
		$this->output = '';
		
		if ($this->mp3 !== "") {
			$mp3download = $controller->loadObject ( $this->mp3, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
		}
		
		if ($this->ogg !== "") {
			$oggdownload = $controller->loadObject ( $this->ogg, NGDownload::ObjectTypeDownload, NGDownload::ObjectTypeDownload );
		}
		
		if ($this->responsive) {
			$attributes = ' style="width:100%;display:block;box-sizing:border-box;outline:none"';
		} else {
			$attributes = sprintf(' style="width:%spx"',$this->renderWidth);
		}
		
		if ($this->controls)
			$attributes .= ' controls="controls"';
		if ($this->loop)
			$attributes .= ' loop="loop"';
		if ($this->autoplay)
			$attributes .= ' autoplay="autoplay"';
		
		$this->output .= sprintf ( self::TagAudioOpen, $attributes );
		
		if ($mp3download != null) {
			$this->output .= sprintf ( self::TagSource, NGUtil::prependStorePath ( $mp3download->pathToFile () ), 'audio/mpeg' );
		}
		if ($oggdownload != null) {
			$this->output .= sprintf ( self::TagSource, NGUtil::prependStorePath ( $oggdownload->pathToFile () ), 'audio/ogg' );
		}
		
		$this->output .= $this->boilerplate;
		
		$this->output .= self::TagAudioClose;
	
	}

}