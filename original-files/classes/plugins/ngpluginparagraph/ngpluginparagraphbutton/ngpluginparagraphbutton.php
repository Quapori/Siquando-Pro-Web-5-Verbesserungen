<?php

class NGPluginParagraphButton extends NGPluginParagraph {
	const ObjectTypePluginParagraphButton = 'NGPluginParagraphButton';
	const Product='SIQUANDO Pro 5';
	const DomainParagraphButton = "paragraphbutton";
	
	public $alignment = 'Center';
	public $link = '';
	public $linktitle = '';
	public $texta = '';
	public $buttonimage = '';
	public $buttonwidth = 0;
	public $buttonheight = 0;
	
	/**
	 * 
	 * File state
	 * @var NGFileState
	 */
	public $buttonimageState = null;
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'alignment', NGProperty::TypeString, self::DomainParagraphButton, 'alignment', NGPropertyMapped::MultiplicityScalar, false, 'Center', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'link', NGProperty::TypeString, self::DomainParagraphButton, 'link', NGPropertyMapped::MultiplicityScalar, false, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'linktitle', NGProperty::TypeText, self::DomainParagraphButton, 'linktitle', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'texta', NGProperty::TypeText, self::DomainParagraphButton, 'texta', NGPropertyMapped::MultiplicityScalar, true, '', false );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonimage', NGProperty::TypeFile, self::DomainParagraphButton, 'buttonimage', NGPropertyMapped::MultiplicityScalar, false, '', false, 'buttonimageState' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonwidth', NGProperty::TypeFile, self::DomainParagraphButton, 'buttonwidth', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'buttonheight', NGProperty::TypeFile, self::DomainParagraphButton, 'buttonheight', NGPropertyMapped::MultiplicityScalar, false, 0 );
	}
	
	public function render() {
		
		if ($this->buttonwidth > 0) {
			
			$template = new NGTemplate ();
			$template->assign ( 'source', NGUtil::prependStorePath ( $this->buttonimageState->path . $this->buttonimage ) );
			$template->assign ( 'align', strtolower ( $this->alignment ) );
			
			if ($this->buttonwidth > $this->renderWidth) {
				$template->assign ( 'width', $this->renderWidth );
				$template->assign ( 'height', floor ( $this->renderWidth / $this->buttonwidth * $this->buttonheight ) );
			} else {
				$template->assign ( 'width', $this->buttonwidth );
				$template->assign ( 'height', $this->buttonheight );
			}
			$template->assign ( 'alt', $this->texta );
			
			$link = new NGLink ( $this->previewMode );
			$link->parseURL ( $this->link );
			$template->assign ( 'link', $link->getURL () );
			$template->assign ( 'linktitle', $this->linktitle );
			
			switch ($link->linkType) {
				case NGLink::LinkPicture :
					$template->assign ( 'linkclass', 'gallery' );
					break;
				case NGLink::LinkPagePopup :
				case NGLink::LinkTopicPopup :
					$template->assign ( 'linkclass', 'galleryiframe' );
					break;
				case NGLink::LinkWWW :
					$template->assign('linktarget', '_blank');
			}
			
			$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphbutton/tpl/template.tpl' );
		}
	}

}