#ngpara{$uid} { border: 1px solid #{$colorborder} }
#ngpara{$uid}>a { background-color: #{$colorbuttons} }
#ngpara{$uid} a:hover { background-color: #{$colorbuttonshover} }
#ngpara{$uid} a.ngpicturebandprev { background-image: url({$prev}) }
#ngpara{$uid} a.ngpicturebandnext { background-image: url({$next}) }
#ngpara{$uid} li { border-right: 1px solid #{$colorborder}; }
#ngpara{$uid} li:last-child { border-right: 0 }
#ngpara{$uid} span { background-color: #{$colorbackgroundcaption}; color: #{$colortextcaption};}
#ngpara{$uid} li:hover span { background-color: #{$colorbackgroundcaptionhover} }
{if $responsive}
@media screen and (max-width: 767px) { #ngpara{$uid} span { display: none } }
@media screen and (max-width: 1023px) { .sqrmobilefullwidth #ngpara{$uid} { border-left-width: 0;border-right-width: 0; } }
{/if}