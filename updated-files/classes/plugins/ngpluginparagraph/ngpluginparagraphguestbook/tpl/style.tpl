.ngbusy {
	background: url(../img/busy.gif) no-repeat center center;
}

.ngbusy>* {
	opacity: 0.2;
}


.ngparaguestbook button:disabled {
	opacity: 0.2;
	cursor: wait;
}

.ngparaguestbook .ngparaguestbookcaptcha {
	margin-bottom: 20px;
}

.ngparaguestbookpost {
	margin-bottom: 20px;
}

.ngparaguestbook .ngparaguestbookformerror {
	font: {{$typo->fieldcaptionfont|ngfont}};
	color: #{{$typo->fieldcaptionerrorcolor}};
{{if $typo->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	padding: 10px;
	text-align: center;
	display: none;
}

.ngparaguestbook .ngguestbookthanks {
	padding: 10px;
	text-align: center;
}

.ngparaguestbook .ngparaguestbookconsent {
    margin: 0 0 20px 0;
    padding: 0;
    line-height: {{$typo->defaultlineheight/100}};
}

.ngparaguestbook input[type="checkbox"] {
    margin: 0;
    padding: 0;
}

.ngparaguestbook form {
	margin: 0 0 20px 0;
}

.ngparaguestbook input[type="text"], .ngparaguestbook input[type="email"], .ngparaguestbook textarea
{
	box-sizing: border-box;
	border-color: #{{$typo->fieldbordercolor}};
	border-width: {{$typo->fieldborderwidth|ngmargin}};
	border-style: solid;
	margin: 0 0 10px 0;
	padding: {{$typo->fieldpadding|ngmargin}};
{{if $typo->fieldbackground!==''}}
	background: {{$typo->fieldbackground|ngbackground}};
{{else}}
	background: transparent;
{{/if}}
	font: {{$typo->fieldfont|ngfont}};
	color: #{{$typo->fieldfont|ngfontcolor}};
{{if $typo->fieldfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $typo->fieldshadow!==''}}
	box-shadow: {{$typo->fieldshadow|ngshadow}};
{{/if}}
	border-radius: {{$typo->fieldroundedcorners|ngmargin}};
	-webkit-appearance: none;
	box-sizing: border-box;
	width: 100%;
}

.ngparaguestbook textarea {
	min-height: 160px;
}

.ngparaguestbook label
{
	font: {{$typo->fieldcaptionfont|ngfont}};
	color: #{{$typo->fieldcaptionfont|ngfontcolor}};
{{if $typo->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	display: block;
	padding: 5px 5px 5px 0;
}

.ngparaguestbook label.ngparaguestbookerror {
	color: #{{$typo->fieldcaptionerrorcolor}};
}


.ngparaguestbook button
{	
	margin: 0;
	text-decoration: none;
	border-color: #{{$typo->submitbordercolor}};
	border-width: {{$typo->submitborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$typo->submitpadding|ngmargin}};
{{if $typo->submitbackground!==''}}
	background: {{$typo->submitbackground|ngbackground}};
{{/if}}
	font: {{$typo->submitfont|ngfont}};
	color: #{{$typo->submitfont|ngfontcolor}};
{{if $typo->submitfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $typo->submitshadow!==''}}
	box-shadow: {{$typo->submitshadow|ngshadow}};
{{/if}}
{{if $typo->submitroundedcorners!='0'}}
	border-radius: {{$typo->submitroundedcorners|ngmargin}};
{{/if}}
	display: block;
	cursor: pointer;
    outline: none;
    float: right;
    -webkit-appearance: none;
}

.ngparaguestbook button:hover
{	
	border-color: #{{$typo->submithoverbordercolor}};
{{if $typo->submithoverbackground!==''}}
	background: {{$typo->submithoverbackground|ngbackground}};
{{/if}}
{{if $typo->submithoverfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{else}}
	font-weight: normal;
{{/if}}	
{{if $typo->submithoverfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{else}}
	font-style: normal;
{{/if}}	
{{if $typo->submithoverfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}	
	color: #{{$typo->submithoverfontstyle|ngfontstylecolor}};	
}

.ngparaguestbook .ngparaguestbookpagination {
	padding: 10px;
	display: none;
	text-align: center;
}

.ngparaguestbook .ngparaguestbookpagination a {
	text-decoration: none;
	font-weight: normal;
	font-style: normal;
	color: #{{$typo->linkfontstyle|ngfontstylecolor}};
	padding: 0 3px;
}

.ngparaguestbook .ngparaguestbookpagination a.ngparaguestbookcurrent {
	font-weight: bold;
}

.ngparaguestbook .ngparaguestbookreply {
	padding-left: {{ceil($settings->getReplyPictureSize()*1.2)}}px;
{{if isset($replypicture)}}
	background: url({{$replypicture}}) 0 4px no-repeat;
{{else}}
	background: url(../img/reply/?f={{$settings->reply}}&c={{$settings->colorreply}}&s={{$settings->getReplyPictureSize()}}) 0 4px no-repeat;
{{/if}}
	min-height: {{ceil($settings->getReplyPictureSize()*1.2)}}px;
}

.ngparaguestbook .ngparaguestbookstars {
	margin: 0 0 10px 0;
}

.ngparaguestbook .ngparaguestbookstars a {
	float: left;
	display: block;
	width: 20px;
	height: 20px;
	background: url(../img/stars/?f={{$settings->star}}&ca={{$settings->colorstarinactivestroke}}&cb={{$settings->colorstarinactivefill}}&cc={{$settings->colorstaractivestroke}}&cd={{$settings->colorstaractivefill}}) 0 0 no-repeat;
}

.ngparaguestbook .ngparaguestbookstars a.hover {
	background-position: 0 -20px;
}

.ngparaguestbook .ngparaguestbookstars a.selected {
	background-position: 0 -40px;
}

.ngparaguestbook .ngparaguestbookpost h3 img {
	width: {{$typo->headline3font|ngfontsize}}px;
	height: {{$typo->headline3font|ngfontsize}}px;
	padding-left: 5px;
}

.ngparaguestbook td {
	white-space: nowrap;
	padding: 0 6px 6px 0;
	vertical-align: middle;
	text-align: left;
}

.ngparaguestbook table {
	margin-bottom: 10px;
	border: 0;
	border-spacing: 0;
}

.ngparaguestbook td>div {
	width: 100%;
	background-color: #{{$settings->colorbarbackground}};
}

.ngparaguestbook td>div>div {
	background-color: #{{$settings->colorbarforeground}};
	height: 10px;
}

.ngparaguestbook .ngguestbooktotal {
	width: 100px;
	background: url(../img/stars/?f={{$settings->star}}&ca={{$settings->colorstarinactivestroke}}&cb={{$settings->colorstarinactivefill}}&cc={{$settings->colorstaractivestroke}}&cd={{$settings->colorstaractivefill}}) 0 0 repeat-x;
	margin-bottom: 10px;
}

.ngparaguestbook .ngguestbooktotal div {
	height: 20px;
	background: url(../img/stars/?f={{$settings->star}}&ca={{$settings->colorstarinactivestroke}}&cb={{$settings->colorstarinactivefill}}&cc={{$settings->colorstaractivestroke}}&cd={{$settings->colorstaractivefill}}) 0 -40px repeat-x;
}