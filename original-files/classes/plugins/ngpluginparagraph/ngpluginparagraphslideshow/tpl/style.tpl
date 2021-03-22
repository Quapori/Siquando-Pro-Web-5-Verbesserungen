#{$id} { background-color: #{$colorframe} }
{if $navigationstyle=='Thumbnail'}
#{$id} .ngslideshowthumbnail a { background-color: #{$colorbackground}; color: #{$colortext}}
{/if}
{if $navigationstyle=='Caption'}
#{$id} .ngslideshowcaption a { background-color: #{$colorbackground}; color: #{$colortext} }
#{$id} .ngslideshowcaption a:hover { border: 1px solid #{$colorframehover};  background-color: #{$colorbackgroundhover}; color: #{$colortexthover} }
#{$id} .ngslideshowcaption a.ngslideshowselected { border: 1px solid #{$colorframeselected}; background-color: #{$colorbackgroundselected}; color: #{$colortextselected} }
{/if}
{if $navigationstyle=='Bullet'}
#{$id} .ngslideshowbullet { width: {$picturecount*20-4}px; }
#{$id} .ngslideshowbullet a { background-color: #{$colorbackground}; border: 1px solid #{$colorframe} }
#{$id} .ngslideshowbullet a:hover { background-color: #{$colorbackgroundhover}; border: 1px solid #{$colorframehover} }
#{$id} .ngslideshowbullet a.ngslideshowselected { background-color: #{$colorbackgroundselected}; border: 1px solid #{$colorframeselected} }
{/if}
