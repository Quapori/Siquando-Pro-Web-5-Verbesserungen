<?php

class NGPluginPageDefault extends NGPluginPage {
	const ObjectTypePluginPageDefault = 'NGPluginPageDefault';
	const Product = 'SIQUANDO Pro 5';

	/**
	 *
	 * Gutter between columns
	 * 
	 * @var int
	 */
	public $gutter = 30;

	public function prepare() {
		$this->hiddenParagraphStreamsNames = explode ( ',', $this->hiddenParagraphStreams );
		
		$controller = new NGDBAdapterObject ();
		
		$paragraphStreams = $controller->loadChildObjects ( $this->objectUID, NGParagraphStream::ObjectTypeParagraphStream, NGParagraphStream::ObjectTypeParagraphStream, '', true, false, false, false );
		
		foreach ( $paragraphStreams as $paragraphStream ) {
			/* @var $paragraphStream NGParagraphStream */
			$this->paragraphStreams [$paragraphStream->name] = $paragraphStream;
		}
		
		foreach ( $this->paragraphStreams as $paragraphStream ) {
			$paragraphStream->isVisible = ! in_array ( $paragraphStream->name, $this->hiddenParagraphStreamsNames );
		}
	}

	public function render() {
		$this->ftsData = '';
		
		foreach ( $this->paragraphStreams as $paragraphStream ) {
			$this->renderParagraphStream ( $paragraphStream );
		}
		
		if ($this->previewMode) {
			if (! array_key_exists ( 'ngui', $this->styleSheets )) {
				$this->styleSheets ['ngui'] = NGUtil::prependRootPath ( 'classes/model/simple/css/ui.css' );
			}
		}
	}

	/**
	 *
	 * Renders a paragraph stream
	 * 
	 * @param string $streamName
	 *        	Name of stream
	 * @param NGParagraphStreamInfo $streamInfo
	 *        	info
	 * @param bool $previewMode        	
	 */
	public function renderParagraphStream(NGParagraphStream $paragraphStream, NGPluginPage $masterPage = null) {
		if ($paragraphStream->isVisible) {
			
			if ($masterPage === null)
				$masterPage = $this;
			
			$paragraphStream->previewMode = $masterPage->previewMode;
			$paragraphStream->currentPage = $masterPage;
			$paragraphStream->render ();
			
			foreach ( $paragraphStream->styleSheets as $id => $stylesheet ) {
				if (! array_key_exists ( $id, $masterPage->styleSheets ))
					$masterPage->styleSheets [$id] = $stylesheet;
			}
			foreach ( $paragraphStream->styles as $id => $style ) {
				if (! array_key_exists ( $id, $masterPage->styles ))
					$masterPage->styles [$id] = $style;
			}
			foreach ( $paragraphStream->javaScripts as $id => $javaScript ) {
				if (! array_key_exists ( $id, $masterPage->javaScripts ))
					$masterPage->javaScripts [$id] = $javaScript;
			}
			foreach ( $paragraphStream->metaTags as $id => $metaTag ) {
				$masterPage->metaTags [$id] = $metaTag;
			}
			
			if ($paragraphStream->keywords !== '') {
				if (array_key_exists ( 'keywords', $masterPage->metaTags )) {
					$masterPage->metaTags ['keywords'] = NGUtil::joinCommaSeparatedValues ( $masterPage->metaTags ['keywords'], $paragraphStream->keywords );
				} else {
					$masterPage->metaTags ['keywords'] = $paragraphStream->keywords;
				}
			}
			
			$masterPage->nextScheduledChange = NGUtil::nextDate ( $masterPage->nextScheduledChange, $paragraphStream->nextScheduledChange );
			
			if (! $masterPage->previewMode)
				$masterPage->ftsData .= trim ( preg_replace ( '/[\r\n\t ]+|<p.*?>|<\/p>|<br\/>/', ' ', (strip_tags ( $paragraphStream->output, '<p><br><br/>' )) ) ) . ' ';
			
			if ($paragraphStream->dontCache)
				$masterPage->dontCache = true;
		}
	}
}