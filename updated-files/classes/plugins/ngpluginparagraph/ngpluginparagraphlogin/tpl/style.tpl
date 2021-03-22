.nglogin label
{
	font: {{$settings->fieldcaptionfont|ngfont}};
	color: #{{$settings->fieldcaptionfont|ngfontcolor}};
{{if $settings->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	float: left;
	display: block;
	padding: 5px 5px 5px 0;
	box-sizing: border-box;
	width: 35%;
}

.nglogin .ngloginerror
{
	color: #{{$settings->fieldcaptionerrorcolor}};
	padding: 10px;
	text-align: center;
	font-weight: bold;
	margin: 5px 0 20px 0;
	color: #{{$settings->fieldcaptionerrorcolor}};
}


.nglogin input[type=email], .nglogin input[type=password]
{
	border-color: #{{$settings->fieldbordercolor}};
	border-width: {{$settings->fieldborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->fieldpadding|ngmargin}};
{{if $settings->fieldbackground!==''}}
	background: {{$settings->fieldbackground|ngbackground}};
{{else}}
	background: transparent;
{{/if}}
	font: {{$settings->fieldfont|ngfont}};
	color: #{{$settings->fieldfont|ngfontcolor}};
{{if $settings->fieldfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $settings->fieldshadow!==''}}
	box-shadow: {{$settings->fieldshadow|ngshadow}};
{{/if}}
{{if $settings->fieldroundedcorners!='0'}}
	border-radius: {{$settings->fieldroundedcorners|ngmargin}};
{{/if}}

	display: block;
	float: left;
	margin: 0 0 10px 0;
	-webkit-appearance: none;	
	box-sizing: border-box;
	width: 65%;
}

.nglogin .ngloginconsent div {
	margin: 0 0 10px 0;
}



.nglogin input[type=submit]
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
{{if $settings->submitroundedcorners!='0'}}
	border-radius: {{$settings->submitroundedcorners|ngmargin}};
{{/if}}
	display: block;
	float: right;
	cursor: pointer;
    outline: none;
}

.nglogin input[type=submit]:hover
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
}


@media screen and (max-width: 767px) {
	.sqr .nglogin label,
	.sqr .nglogin input[type=email], .nglogin input[type=password]
	{
		width: 100%;
		float: none;
	}
} 