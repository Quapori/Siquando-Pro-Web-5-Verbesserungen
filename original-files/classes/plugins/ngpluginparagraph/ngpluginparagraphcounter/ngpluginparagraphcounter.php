<?php

class NGPluginParagraphCounter extends NGPluginParagraph {
	const ObjectTypePluginParagraphCounter = 'NGPluginParagraphCounter';
	const DomainParagraphCounter = "paragraphcounter";
	const Product = 'SIQUANDO Pro 5';
	
	public $style = '_default';
	public $digits = 8;
	public $offset = 0;
	public $coloricon = '555555';
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped ();
		
		$this->propertiesMapped [] = new NGPropertyMapped ( 'style', NGProperty::TypeString, self::DomainParagraphCounter, 'style', NGPropertyMapped::MultiplicityScalar, false, '_default' );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'digits', NGProperty::TypeInt, self::DomainParagraphCounter, 'digits', NGPropertyMapped::MultiplicityScalar, false, 8 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'offset', NGProperty::TypeInt, self::DomainParagraphCounter, 'offset', NGPropertyMapped::MultiplicityScalar, false, 0 );
		$this->propertiesMapped [] = new NGPropertyMapped ( 'coloricon', NGProperty::TypeString, self::DomainParagraphCounter, 'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555' );
	}
	
	public function render() {
		$template = new NGTemplate ();
		$template->assign ( 'src', NGUtil::prependRootPath ( 'classes/plugins/ngpluginparagraph/ngpluginparagraphcounter/images/?u=' . $this->objectUID ) );
		
		$this->output = $template->fetchPluginTemplate ( 'ngpluginparagraph/ngpluginparagraphcounter/tpl/template.tpl' );
	}
}

class NGPluginParagraphCounterViews extends NGObjectMapped {
	const DomainParagraphCounterViews = "paragraphcounterviews";
	const ObjectTypePluginParagraphCounterViews = 'NGPluginParagraphCounterViews';
	
	public $views = 0;
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		$this->propertiesMapped [] = new NGPropertyMapped ( 'views', NGProperty::TypeInt, self::DomainParagraphCounterViews, 'views', NGPropertyMapped::MultiplicityScalar, false, 0 );
	}
	
	public function __construct() {
		parent::__construct ();
		$this->class = NGPluginParagraph::ObjectTypePluginParagraph;
	}
}