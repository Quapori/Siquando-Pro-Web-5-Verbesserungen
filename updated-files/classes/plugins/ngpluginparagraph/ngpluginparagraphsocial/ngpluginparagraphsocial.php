<?php

class NGPluginParagraphSocial extends NGPluginParagraph {
	const ObjectTypePluginParagraphSocial = 'NGPluginParagraphSocial';
	const Product='SIQUANDO Pro 5';
	const DomainParagraphSocial = "paragraphsocial";
	
	public $showfacebook = true;
	public $showtwitter = true;
	public $showgoogleplus = true;
	
	public $permfacebook = true;
	public $permtwitter = true;
	public $permgoogleplus = true;
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showfacebook', NGProperty::TypeBool, self::DomainParagraphSocial, 'showfacebook', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showtwitter', NGProperty::TypeBool, self::DomainParagraphSocial, 'showtwitter', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'showgoogleplus', NGProperty::TypeBool, self::DomainParagraphSocial, 'showgoogleplus', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'permfacebook', NGProperty::TypeBool, self::DomainParagraphSocial, 'permfacebook', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'permtwitter', NGProperty::TypeBool, self::DomainParagraphSocial, 'permtwitter', NGPropertyMapped::MultiplicityScalar, false, true );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'permgoogleplus', NGProperty::TypeBool, self::DomainParagraphSocial, 'permgoogleplus', NGPropertyMapped::MultiplicityScalar, false, true );
	}
	
	public function render() {
		
		$div = new NGRenderTag ();
		
		$div->tag = 'div';
		$div->class = 'ngpluginparagraphsocial';
		$div->style->selectors['max-width'] =$this->renderWidth.'px';
		
		if ($this->showfacebook) {
			$div->attributes ['data-showfacebook'] = 'on';
			if ($this->permfacebook) {
				$div->attributes ['data-permfacebook'] = 'on';
			}
		}
		
		if ($this->showtwitter) {
			$div->attributes ['data-showtwitter'] = 'on';
			if ($this->permtwitter) {
				$div->attributes ['data-permtwitter'] = 'on';
			}
		}
		
		if ($this->showgoogleplus) {
			$div->attributes ['data-showgplus'] = 'on';
			if ($this->permgoogleplus) {
				$div->attributes ['data-permgplus'] = 'on';
			}
		}
		
		$this->output = $div->render (). '<div class="clearfix"></div>' ;
		
		$this->styleSheets = Array ('NGPluginParagraphSocial' => $this->prependPluginsPath ( 'ngpluginparagraphsocial/css/style.css' ) );
		
		$this->javaScripts = Array ('NGPluginParagraphSocial' => $this->prependPluginsPath ( 'ngpluginparagraphsocial/js/' ), 'jquery.cookie' => $this->prependPluginsPath ( 'ngpluginparagraphsocial/js/jquery.cookie.js' ) )

		;
	
	}

}