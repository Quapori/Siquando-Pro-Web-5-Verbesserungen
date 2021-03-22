<?php

$doc = new DOMDocument ( '1.0', 'UTF-8' );
$root = $doc->createElement ( 'styles' );
$doc->appendChild ( $root );

$files = scandir ( '.' );

foreach ( $files as $file ) {
	
	if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'xml') {

						
					$in = new DOMDocument ( '1.0', 'UTF-8' );
					$in->load ( './' . $file );
					
					foreach ( $in->documentElement->childNodes as $node ) {
						/* @var $node DOMNode */
						
						if ($node->nodeType == XML_ELEMENT_NODE) {
							
							
							$doc->documentElement->appendChild ( $doc->importNode($node, true));
							
						}
					}
										
		
	
	}
}

header ( 'Content-Type:text/xml; charset=utf-8' );

echo ($doc->saveXML ());