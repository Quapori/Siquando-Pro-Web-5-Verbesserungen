{if ($framecolor!=='')} 
#ngpluginparagraphpanorama{$uid}>.ngpluginparagraphpanoramaimage {	border: 1px solid #{$framecolor}; }
{/if}
@media screen and (min-width: 1024px) { #ngpluginparagraphpanorama{$uid}>div>p,	#ngpluginparagraphpanorama{$uid}>div>h3, #ngpluginparagraphpanorama{$uid}>div a { color: #{$captioncolor}; } }