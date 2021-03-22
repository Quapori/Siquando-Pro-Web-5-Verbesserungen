form.parasearch {
	border-color: #{{$settings->fieldbordercolor}};
	border-width: {{$settings->fieldborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->fieldpadding|ngmargin}};
{{if $settings->fieldbackground!==''}}
	background: {{$settings->fieldbackground|ngbackground}};
{{else}}
	background: transparent;
{{/if}}
{{if $settings->fieldshadow!==''}}
	box-shadow: {{$settings->fieldshadow|ngshadow}};
{{/if}}
{{if $settings->fieldroundedcorners!='0'}}
	border-radius: {{$settings->fieldroundedcorners|ngmargin}};
{{/if}}
	margin: 20px 0;
	position: relative;
}

form.parasearch input {
	font: {{$settings->fieldfont|ngfont}};
	color: #{{$settings->fieldfont|ngfontcolor}};
{{if $settings->fieldfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	border: 0;
	background: transparent;
	color: #444444;
	outline: 0;
	margin: 0;
	padding: 0;
}

.sqr  form.parasearch input {
	width: 100%;
	box-sizing: border-box;
	padding-right: 28px;
}

form.parasearch button {
	position: absolute;
	right: 6px;
	top: 50%;
	margin-top: -8px;
	width: 16px;
	height: 16px;
	border: 0;
	cursor: pointer;
}

p.parasearchresult {
	font-weight: bold;
	font-size: 120%;
}

p.parasearchresult a:hover {
	font-weight: bold;
}

p.parasearchpagination {
	text-align: center;
}

a.parasearchcurrent {
	font-weight: bold;
}

img.searchimage {
	display: block;
	float: left;
	margin: 5px 20px 20px 0;
}