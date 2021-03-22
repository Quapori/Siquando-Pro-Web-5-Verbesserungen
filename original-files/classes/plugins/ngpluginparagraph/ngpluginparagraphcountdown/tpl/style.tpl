#ngparacountdown{$uid} .ngparacountdowndigit > div > div > div { color: #{$colorface}; background-color: #{$colorbackground}; text-shadow: 0 0 3px rgba(0,0,0,{$shadowface}); border-radius: {$borderradius}em; }
{if $colorgap!==''}
#ngparacountdown{$uid} .ngparacountdowndigit::after { border-bottom: 1px solid #{$colorgap} }
{/if}
#ngparacountdown{$uid} .ngparacountdowndigit { font-size: {$fontsize}px; box-shadow: 0 0 0.05em rgba(0, 0, 0, {$shadowbackground}); background-color: #{$colorbackground}; perspective: {ceil($fontsize*1.5)}px; }
#ngparacountdown{$uid} .ngparacountdowndigit:first-child { border-radius: {$borderradius}em 0 0 {$borderradius}em }
#ngparacountdown{$uid} .ngparacountdowndigit:last-child { border-radius: 0 {$borderradius}em {$borderradius}em 0 }
{if $colorcaption!==''}
#ngparacountdown{$uid} ul > li > span { color: #{$colorcaption} }
{/if}
{if $fontsizemobile>-1}
@media (max-width: 767px) { #ngparacountdown{$uid} .ngparacountdowndigit { font-size: {$fontsizemobile}px } #ngparacountdown{$uid} ul > li > ul { margin: 0 0.2em; } }
{/if}
