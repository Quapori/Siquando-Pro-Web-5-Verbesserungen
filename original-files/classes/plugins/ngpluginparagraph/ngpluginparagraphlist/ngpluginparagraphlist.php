<?php

class NGPluginParagraphList extends NGPluginParagraph {
	const ObjectTypePluginParagraphText = 'NGPluginParagraphList';
	const Product = 'SIQUANDO Pro 5';
	
	const DomainParagraphList = "paragraphlist";

	public $items=array();
	public $pluginstyle = '';
	public $coloricon = '555555';
	
	private $richText;
	
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
		
		$this->propertiesMapped[]=new NGPropertyMapped('items', NGProperty::TypeText,self::DomainParagraphList,'items',NGPropertyMapped::MultiplicityList,true,null,false);
		$this->propertiesMapped[]=new NGPropertyMapped('pluginstyle', NGProperty::TypeString,self::DomainParagraphList,'pluginstyle', NGPropertyMapped::MultiplicityScalar, false, 'default');
		$this->propertiesMapped[]=new NGPropertyMapped('coloricon', NGProperty::TypeString,self::DomainParagraphList,'coloricon', NGPropertyMapped::MultiplicityScalar, false, '555555');
	}
	
	public function render() 
	{
		$this->richText->previewMode=$this->previewMode;	
		
		if (substr($this->pluginstyle, -4)=='.svg') {
			$imagePath = NGUtil::prependRootPath(sprintf('classes/plugins/ngpluginparagraph/ngpluginparagraphlist/styles/img/?f=%s&c=%s', substr($this->pluginstyle,0,-4), $this->coloricon ));
		} else {
			$imagePath = NGUtil::prependRootPath(sprintf('classes/plugins/ngpluginparagraph/ngpluginparagraphlist/styles/%s.png', $this->pluginstyle));
		}
				
		$this->output=sprintf('<ul class="list" style="list-style: url(%s)">', $imagePath);
		
		foreach ($this->items as $item) {
			$this->output.='<li>'.$this->richText->parse($item).'</li>';
		}
		
		$this->output.='</ul>';		

		$this->styleSheets=Array(
			'NGPluginParagraphList' => $this->prependPluginsPath('ngpluginparagraphlist/css/style.css')
		);
		
	}
	
	public function __construct() {
		parent::__construct();
		$this->richText=new NGRichText();
	}
}