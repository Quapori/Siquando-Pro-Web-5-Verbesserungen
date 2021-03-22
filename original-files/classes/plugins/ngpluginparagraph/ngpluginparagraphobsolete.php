<?php

class NGPluginParagraphObsolete extends NGPluginParagraph {
	const ObjectTypePluginParagraphHTML = 'NGPluginParagraphUnknown';


	/* (non-PHPdoc)
	 * @see NGObjectMapped::getPropertiesMapped()
	 */
	protected function getPropertiesMapped() {
		parent::getPropertiesMapped();
	}


	public function render()
	{
		$this->output=sprintf('<p>Das Plugin <i>„%s“</i> ist nicht mit der aktuellen Version von SIQUANDO Pro Web kompatibel …</p>', $this->pluginName);
	}
}