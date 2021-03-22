<?php
class NGIndex {
	public static function printIndex($indexFilename = 'index.xml') {
		include_once (dirname ( __FILE__ ) . '/ngutil.php');
		
		$doc = new DOMDocument ( '1.0', 'UTF-8' );
		$root = $doc->createElement ( 'items' );
		$doc->appendChild ( $root );
		
		$files = scandir ( '.' );
		
		foreach ( $files as $file ) {
			
			if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'xml') {
				$itemNode = $doc->createElement ( 'item', $file );
				$root->appendChild ( $itemNode );
			}
		}
		
		NGUtil::XMLHeader ();
		echo ($doc->saveXML ());
	}
	public static function printLayoutIndex() {
		include_once (dirname ( __FILE__ ) . '/ngutil.php');
		
		$doc = new DOMDocument ( '1.0', 'UTF-8' );
		$root = $doc->createElement ( 'styles' );
		$doc->appendChild ( $root );
		
		$folders = scandir ( '.' );
		
		foreach ( $folders as $folder ) {
			if ($folder != '.' && $folder != '..' && is_dir ( './' . $folder )) {
				if (file_exists ( './' . $folder . '/meta.xml' )) {
					$nodeOut = $doc->createElement ( 'style' );
					
					$in = new DOMDocument ( '1.0', 'UTF-8' );
					$in->load ( './' . $folder . '/meta.xml' );
					
					foreach ( $in->documentElement->childNodes as $node ) {
						/* @var $node DOMNode */
						
						if ($node->nodeType == XML_ELEMENT_NODE) {
							switch ($node->nodeName) {
								case 'id' :
									$nodeOut->setAttribute ( 'id', $node->nodeValue );
									break;
								case 'preview' :
									$nodeOut->setAttribute ( 'preview', $node->nodeValue );
									break;
								case 'type' :
									$nodeOut->setAttribute ( 'type', $node->nodeValue );
									break;
								case 'author' :
									$nodeOut->setAttribute ( 'author', $node->nodeValue );
									break;
								case 'product' :
									$nodeOut->setAttribute ( 'product', $node->nodeValue );
									break;
								case 'initialversion' :
									$nodeOut->setAttribute ( 'initialversion', $node->nodeValue );
									break;
								case 'responsive' :
									$nodeOut->setAttribute ( 'responsive', $node->nodeValue );
									break;
								case 'caption' :
									$nodeOut->nodeValue = $node->nodeValue;
									break;
							}
						}
					}
					
					$attr = $doc->createAttribute ( 'url' );
					$attr->value = $folder;
					$nodeOut->appendChild ( $attr );
					
					$doc->documentElement->appendChild ( $nodeOut );
				}
			}
		}
		
		NGUtil::XMLHeader ();
		echo ($doc->saveXML ());
	}
}