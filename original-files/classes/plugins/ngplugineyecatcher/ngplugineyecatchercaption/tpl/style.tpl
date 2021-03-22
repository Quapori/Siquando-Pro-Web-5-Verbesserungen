#{{$id}} span {
	font: {$font|ngfont};
	color: #{$font|ngfontcolor};
	display: block;
	padding: {$paddingcaption|ngmargin};
	float: left;
{{if $font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}	
{{if $captionshadow|ngisshadow}}
	text-shadow: {$captionshadow|ngshadow};
{{/if}}
}
{{if isset($source)}}
#{{$id}} img {
	display: block;
	border: 0;
	padding: {$paddinglogo|ngmargin};
	float: left;	
}
{{/if}}
