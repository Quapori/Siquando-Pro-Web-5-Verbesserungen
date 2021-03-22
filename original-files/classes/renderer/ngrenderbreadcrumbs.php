<?php

class NGRenderBreadcrumbs {
	public static function render($currentTopicUID, $previewMode) {
		$out = '';
		
		$breadcrumbs = Array ();
		
		$home = NGSession::getInstance ()->getNavRootHome ();
		
		if ($home !== null) {
			
			$breadcrumb = $home->findByUID ( $currentTopicUID );
			
			while ( $breadcrumb != null ) {
				$breadcrumbs [] = $breadcrumb;
				if ($breadcrumb->objectUID === NGUtil::ObjectUIDRootHome)
					break;
				$breadcrumb = $breadcrumb->parent;
			}
			
			if (count($breadcrumbs)===0) $breadcrumbs[] = $home;
			
			$breadcrumbs = array_reverse ( $breadcrumbs );
			
			$renderA = new NGRenderA ();
			
			foreach ( $breadcrumbs as $breadcrumb ) {
				/* @var NGNavItem $breabcrumb */
				$renderA->href = $breadcrumb->fullURL ( $previewMode );
				$renderA->content = $breadcrumb->caption;
				if ($out != '')
					$out .= ' » ';
				$out .= $renderA->render ();
			}
		}
		
		return $out;
	}
}