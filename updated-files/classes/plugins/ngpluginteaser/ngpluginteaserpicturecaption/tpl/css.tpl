#ngpara{$uid} li { border: {$borderwidth}px solid #{$bordercolor} }

{if $columns>2 && $responsive}
@media screen and (min-width: 1024px) {
#ngpara{$uid} li { margin-right: {$gutter}%; margin-bottom: {$gutter}%; width:{$picturewidth}% }
#ngpara{$uid} li:nth-child({$columns}n+0) { margin-right: 0 }
}
@media screen and (max-width: 1023px) {
#ngpara{$uid} li { margin-right: {$gutter}%; margin-bottom: {$gutter}%; width:{$picturewidthtwo}% }
#ngpara{$uid} li:nth-child(2n+0) { margin-right: 0 }
}
{else}
#ngpara{$uid} li { margin-right: {$gutter}%; margin-bottom: {$gutter}%; width:{$picturewidth}% }
#ngpara{$uid} li:nth-child({$columns}n+0) { margin-right: 0 }
{/if}


#ngpara{$uid} span { color: #{$foreground}; background-color: #{$background}; }
#ngpara{$uid} li:hover { border-color: #{$bordercolorhover} }
#ngpara{$uid} li:hover span { color: #{$foregroundhover}; background-color: #{$backgroundhover} }