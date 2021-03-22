#sqrfactpano{$uid} p { color:#{$colorforeground};font-size:{$textsize}px; }
#sqrfactpano{$uid} h2 { color:#{$colorforeground};font-size:{$captionsize}px; }
{if isset($overlay)}#sqrfactpano{$uid} .sqrfactpanooverlay { background-color:{$overlay}; }
{/if}
#sqrfactpano{$uid} .sqrfactpanoback { background-color:#{$colorimagebackground}; }
#sqrfactpano{$uid} .sqrfactpanoitems a { color:#{$colorforeground};background-color:rgba({$colorbackground|ngrgb},0.3);padding:{$paddingvertical}px {$paddinghorizontal}px;{if $framethickness>0}border:{$framethickness}px solid rgba({$colorframe|ngrgb},0.8);{/if}{if $round>0}border-radius:{$round}px;{/if}font-size:{$textsize}px; }
#sqrfactpano{$uid} .sqrfactpanoitems a:hover { background-color:#{$colorbackground}; }
#sqrfactpano{$uid} .sqrfactpanoitems img { width:{$textsize}px;height:{$textsize}px;margin-left:{ceil($textsize/2)}px; }
@media screen and (max-width: 767px) { 
.sqr #sqrfactpano{$uid} .sqrfactpanostage>h2 { font-size:22px;padding:10px 20px; }
.sqr #sqrfactpano{$uid} .sqrfactpanostage>p { font-size:16px;padding:10px 20px; }
.sqr #sqrfactpano{$uid} .sqrfactpanoitems a { font-size:16px; }
.sqr #sqrfactpano{$uid} .sqrfactpanoitems img { width:16px;height:16px;margin-left:8px; }
}