{if $backgroundfill!==''}#ngteasercascade{$uid} { background-color:#{$backgroundfill} } {/if}
#ngteasercascade{$uid}>ul>li>ul>li>ul>li { background-color:#{$background} }
#ngteasercascade{$uid}>ul>li>ul>li>ul>li>a, #ngteasercascade{$uid}>ul>li>ul>li>ul>li>a>div>h3 { color:#{$foreground} }
#ngteasercascade{$uid} { padding:{$padding}px {$halfpadding}px 0 {$halfpadding}px }
#ngteasercascade{$uid}>ul>li>ul>li>ul { padding:0 {$halfpadding}px }
#ngteasercascade{$uid}>ul>li>ul>li>ul>li { margin:0 0 {$padding}px 0{if $shadow};box-shadow:0 0 {$halfpadding}px rgba(0,0,0,0.2){/if} }
#ngteasercascade{$uid}>ul>li>ul>li>ul>li>a>div { padding:{$innerpadding}px; }
{if isset($settings)}
#ngteasercascade{$uid}>div>button { border-color:#{$settings->submitbordercolor};border-width:{$settings->submitborderwidth|ngmargin};border-style:solid;padding:{$settings->submitpadding|ngmargin};{if $settings->submitbackground!==''}background:{$settings->submitbackground|ngbackground};{/if}font:{$settings->submitfont|ngfont};color: #{$settings->submitfont|ngfontcolor};{if $settings->submitfont|ngfontisuppercase}text-transform:uppercase;{/if}{if $settings->submitshadow!==''}box-shadow:{$settings->submitshadow|ngshadow};{/if}{if $settings->submitroundedcorners!='0'}border-radius:{$settings->submitroundedcorners|ngmargin};{/if}cursor:pointer;outline:none;-webkit-appearance:none }
#ngteasercascade{$uid}>div>button:hover { border-color:#{$settings->submithoverbordercolor};{if $settings->submithoverbackground!==''}background:{$settings->submithoverbackground|ngbackground};{/if}{if $settings->submithoverfontstyle|ngfontstyleisbold}font-weight:bold;{else}font-weight:normal;{/if}{if $settings->submithoverfontstyle|ngfontstyleisitalic}font-style:italic;{else}font-style:normal;{/if}{if $settings->submithoverfontstyle|ngfontstyleisuppercase}text-transform:uppercase;{else}text-transform:none;{/if}color:#{$settings->submithoverfontstyle|ngfontstylecolor} }
{/if}