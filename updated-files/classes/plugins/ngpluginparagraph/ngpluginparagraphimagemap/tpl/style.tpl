{foreach $items as $item}

#ngimagemapi{$uid}{$item@index} {
	background-image: url('{$item->getFilename()}');
}

#ngimagemapp{$uid}{$item@index} {
	width: {$item->getPopupWidth()}px;
	background-color: #{$item->popupcolor};
{if ($item->bordercolor !== '')}
	border: 1px solid #{$item->bordercolor};
{/if}
{if ($item->popupborderradius>0)}
	border-radius: {$item->popupborderradius}px;
{/if}
{if $item->popupanimate}
	transition: opacity 0.2s, transform 0.2s;
	-webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
{if ($item->popupposition==NGImageMapStageItem::PopupPositionRight)}
	-webkit-transform: translate(10px,0);
	transform: translate(10px,0);
{/if}
{if ($item->popupposition==NGImageMapStageItem::PopupPositionLeft)}
	-webkit-transform: translate(-10px,0);
	transform: translate(-10px,0);
{/if}
{if ($item->popupposition==NGImageMapStageItem::PopupPositionTop)}
	-webkit-transform: translate(0,-10px);
	transform: translate(0,-10px);
{/if}
{if ($item->popupposition==NGImageMapStageItem::PopupPositionBottom)}
	-webkit-transform: translate(0,10px);
	transform: translate(0,10px);
{/if}
{/if}
	
}

#ngimagemapp{$uid}{$item@index}>p, #ngimagemapp{$uid}{$item@index}>p a {
	color: #{$item->textcolor} !important;
}

#ngimagemapa{$uid}{$item@index} {
	background: url('{$item->getArrowFilename()}') no-repeat;
}

{/foreach}