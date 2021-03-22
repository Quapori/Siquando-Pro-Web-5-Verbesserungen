{if isset($next)}
#{$id} .ngpluginslidernext { background-image: url({$next});}
#{$id} .ngpluginsliderprev { background-image: url({$prev});}
{/if}
{if isset($bullet)}
#{$id} .ngpluginslidercontrols a { background-image: url({$bullet}); }
{/if}
{if $captionbackground}
#{$id} .ngpluginsliderh1 span { background: {$captionbackground}; padding: 0 {$captionpad}px }
{/if}
{if $subcaptionbackground}
#{$id} .ngpluginsliderh2 span { background: {$subcaptionbackground}; padding: 0 {$subcaptionpad}px }
{/if}
#{$id} .ngpluginsliderh1 { 	font: {{$captionfont|ngfont}}; color: #{{$captionfont|ngfontcolor}}; {{if $captionfont|ngfontisuppercase}} text-transform: uppercase; {{/if}} {if $captionshadow}text-shadow: 1px 1px 3px #000000;{/if}  }
#{$id} .ngpluginsliderh2 {	font: {{$subcaptionfont|ngfont}}; color: #{{$subcaptionfont|ngfontcolor}}; {{if $subcaptionfont|ngfontisuppercase}}	text-transform: uppercase;{{/if}} {if $subcaptionshadow}text-shadow: 1px 1px 3px #000000;{/if} padding-top: {$subcaptionpad}px; }
#{$id} .ngpluginslidercaptions { padding: {$margin}px;  }