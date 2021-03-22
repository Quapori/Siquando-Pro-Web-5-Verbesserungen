.sqwpluginbuttons {
   display: flex;
   flex-wrap: wrap;
   margin: 0 -10px;
}

.sqwpluginbuttonsright {
    justify-content: flex-end;
}

.sqwpluginbuttonsleft {
    justify-content: flex-start;
}

.sqwpluginbuttonscenter {
    justify-content: center;
}

.sqwpluginbuttonsjustify {
    justify-content: space-between;
}


.sqwpluginbuttons a
{
	border-color: #{{$settings->submitbordercolor}};
	border-width: {{$settings->submitborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->submitpadding|ngmargin}};
{{if $settings->submitbackground!==''}}
	background: {{$settings->submitbackground|ngbackground}};
{{/if}}
	font: {{$settings->submitfont|ngfont}};
	color: #{{$settings->submitfont|ngfontcolor}};
{{if $settings->submitfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $settings->submitshadow!==''}}
	box-shadow: {{$settings->submitshadow|ngshadow}};
{{/if}}
	border-radius: {{$settings->submitroundedcorners|ngmargin}};
	display: block;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    text-decoration: none;
    margin: 10px;
}

.sqwpluginbuttons a:hover
{
	border-color: #{{$settings->submithoverbordercolor}};
{{if $settings->submithoverbackground!==''}}
	background: {{$settings->submithoverbackground|ngbackground}};
{{/if}}
{{if $settings->submithoverfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{else}}
	font-weight: normal;
{{/if}}
{{if $settings->submithoverfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{else}}
	font-style: normal;
{{/if}}
{{if $settings->submithoverfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
	color: #{{$settings->submithoverfontstyle|ngfontstylecolor}};
	text-decoration: none;
}
