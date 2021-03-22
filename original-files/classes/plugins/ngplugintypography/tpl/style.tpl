{{foreach $fonts as $import}}
@import url("{{$import}}.css");
{{/foreach}}

input:focus,
button:focus,
select:focus,
textarea:focus {
    outline: none;
}

.sqpnavicon {
    width: 1.1em;
    height: 1.1em;
    display: inline-block;
    vertical-align: -0.18em;
    margin-right: 0.5em;
    border: 0;
    padding: 0;
}

.sqplinkicon {
    width: 1em;
    height: 1em;
    display: inline-block;
    vertical-align: -0.2em;
    margin-right: 0.2em;
    border: 0;
    padding: 0;
}


BODY {
	margin: 0;
	font: {{$settings->defaultfont|ngfont}};
	color: #{{$settings->defaultfont|ngfontcolor}};
{{if $settings->defaultfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
}

.clearfix {
	clear: both;
}

h1 {
	font: {{$settings->headline1font|ngfont}};
	color: #{{$settings->headline1font|ngfontcolor}};
{{if $settings->headline1font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline1margin|ngparagraphmargin}};
	line-height: {{$settings->headline1lineheight/100}};
}

h2 {
	font: {{$settings->headline2font|ngfont}};
	color: #{{$settings->headline2font|ngfontcolor}};
{{if $settings->headline2font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline2margin|ngparagraphmargin}};
	line-height: {{$settings->headline2lineheight/100}};
}

h3, h3>a {
	font: {{$settings->headline3font|ngfont}};
	color: #{{$settings->headline3font|ngfontcolor}};
{{if $settings->headline3font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline3margin|ngparagraphmargin}};
	line-height: {{$settings->headline3lineheight/100}};
	text-decoration: none;
}

h4 {
	font: {{$settings->headline4font|ngfont}};
	color: #{{$settings->headline4font|ngfontcolor}};
{{if $settings->headline4font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline4margin|ngparagraphmargin}};
	line-height: {{$settings->headline4lineheight/100}};
}

h5 {
	font: {{$settings->headline5font|ngfont}};
	color: #{{$settings->headline5font|ngfontcolor}};
{{if $settings->headline5font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline5margin|ngparagraphmargin}};
	line-height: {{$settings->headline5lineheight/100}};
}

h6 {
	font: {{$settings->headline6font|ngfont}};
	color: #{{$settings->headline6font|ngfontcolor}};
{{if $settings->headline6font|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	margin: {{$settings->headline6margin|ngparagraphmargin}};
	line-height: {{$settings->headline6lineheight/100}};
}

p {
	margin: {{$settings->defaultmargin|ngparagraphmargin}};
	line-height: {{$settings->defaultlineheight/100}};
}

p a, .ngcontent a, a.nglink {
{{if $settings->linkfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{/if}}	
{{if $settings->linkfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{/if}}	
{{if $settings->linkfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{/if}}	
	color: #{{$settings->linkfontstyle|ngfontstylecolor}};
	text-decoration: {{$settings->linkunderline|ngunderline}};
}

p a:hover, .ngcontent a:hover, a.nglink:hover {
{{if $settings->linkhoverfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{else}}
	font-weight: normal;
{{/if}}	
{{if $settings->linkhoverfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{else}}
	font-style: normal;
{{/if}}	
{{if $settings->linkhoverfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}	
	color: #{{$settings->linkhoverfontstyle|ngfontstylecolor}};
	text-decoration: {{$settings->linkhoverunderline|ngunderline}};
}

h3 a:hover {
	color: #{{$settings->linkhoverfontstyle|ngfontstylecolor}};
	text-decoration: {{$settings->linkhoverunderline|ngunderline}};
}

img.picture {
	display: block;
	border: 0;
}


.paragraph {
	margin-bottom: 10px;
}