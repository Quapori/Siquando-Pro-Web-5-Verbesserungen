<?php

class NGPluginParagraphLogout extends NGPluginParagraph {
	const ObjectTypePluginParagraphLogin = 'NGPluginParagraphLogout';
	const Product = 'SIQUANDO Pro 5';

	/**
	 * (non-PHPdoc)
	 * @see NGPluginParagraph::render()
	 */
	public function render() {
		
		$this->dontCache = true;
		
		NGUtil::startSession ();

        $ngaccess = new NGAccess ();
        $ngaccess->previewMode = $this->previewMode;

        $ngaccess->logoutUser();
    }
	
}