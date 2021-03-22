.paragraphborder_{{$uid}}
{
	min-height: 1px;
	margin: {{$settings->margin|ngmargin}};
	padding: {{$settings->padding|ngmargin}};
{{if $settings->background!=''}}
	background: {{$settings->background|ngbackground}};
{{/if}}
{{if $settings->borderwidth!=''}}
	border-color: #{{$settings->bordercolor}};
	border-width: {{$settings->borderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->roundedcorners!='0'}}
	border-radius: {{$settings->roundedcorners|ngmargin}};
{{/if}}
{{if $settings->shadow|ngisshadow}}
	box-shadow: {{$settings->shadow|ngshadow}};
{{/if}}
}

.sqrallwaysfullwidth>.paragraph>.paragraphborder_{{$uid}} {
	border-left-width: 0;
	border-right-width: 0;
	padding: 0;	
}

@media screen and (max-width: 1023px) {
	.sqrmobilefullwidth>.paragraph>.paragraphborder_{{$uid}} {
		border-left-width: 0;
		border-right-width: 0;
		padding: 0;	
	}
}