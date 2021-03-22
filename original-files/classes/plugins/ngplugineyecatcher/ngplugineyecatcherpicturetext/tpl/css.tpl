#{{$id}} .stage {
	overflow: hidden; 
	position: relative;
	background-position: top left;
	background-repeat: no-repeat;
}

{{foreach $items as $item}}
#{{$id}} .eycatcheritem{{$item->id}} {
	left: {{$item->left}}px;
	top: {{$item->top}}px;
	width: {{$item->width}}px;
{{if $item->type!=='search'}}
	height: {{$item->height}}px;
{{/if}}
	position: absolute;
{{if isset($item->color)}}
	color: #{{$item->color}};
{{/if}}
{{if isset($item->fontfamily)}}
	font-family: {{$item->fontfamily}};
{{/if}}
{{if isset($item->fontsize)}}
	font-size: {{$item->fontsize}}px;
{{/if}}
{{if isset($item->fontweight)}}
	font-weight: {{$item->fontweight}};
{{/if}}
{{if isset($item->fontstyle)}}
	font-style: {{$item->fontstyle}};
{{/if}}
{{if isset($item->fill)}}
	background: {{$item->fill|ngbackground}};
{{/if}}
{{if isset($item->opacity)}}
	opacity: {{$item->opacity/100}};
{{/if}}
{{if isset($item->shadow)}}
{{if $item->shadow|ngisshadow}}
	box-shadow: {{$item->shadow|ngshadow}};
{{/if}}
{{/if}}
{{if ($item->type==='picture')}}
	border: 0;
{{/if}}
}

{{if isset($item->hyperlinkcolor)}}
#{{$id}} .eycatcheritem{{$item->id}} a {
	color: #{{$item->hyperlinkcolor}};
	text-decoration: none;
}
#{{$id}} .eycatcheritem{{$item->id}} a:hover {
	text-decoration: underline;
}
{{/if}}

{{if ($item->type==='search')}}

#{{$id}} .eycatcheritem{{$item->id}} {
{{if $item->borderwidth!=''}}
	border-color: #{{$item->bordercolor}};
	border-width: {{$item->borderwidth|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$item->background|ngbackground}};
{{if $item->roundedcorners!='0'}}
	border-radius: {{$item->roundedcorners|ngmargin}};
{{/if}}
	padding: 4px;
}

#{{$id}} .eycatcheritem{{$item->id}} input {
	color: #{{$item->color}};
	width: {{$item->width-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;	
	font-family: {{$item->fontfamily}};
	font-size: {{$item->fontsize}}px;
	font-weight: {{$item->fontweight}};
	font-style: {{$item->fontstyle}};
	min-height: 16px;
}

#{{$id}} .eycatcheritem{{$item->id}} button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$item->style}}.png) no-repeat;
	position: absolute;
	right: 4px;
	top: 50%;
	margin-top: -8px;
	width: 16px;
	height: 16px;
	border: 0;
	cursor: pointer;
}

{{/if}}

{{/foreach}}