<?php

class NGPluginParagraphUnknown extends NGPluginParagraph {
	const ObjectTypePluginParagraphHTML = 'NGPluginParagraphUnknown';	
	const Product = 'SIQUANDO Pro 5';
	
	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();		
	}
	
	
	public function render() 
	{		
		$this->output=sprintf('<p>Das Plugin <i>„%s“</i> ist nicht installiert …</p>', $this->pluginName);
	}	
}