.ngcookiewarning {
  position: fixed;
  z-index: 3000;
  left: 0;
  right: 0;
  background-color: #{{$backgroundcolor}};
  padding: 30px;
  display: none;
  box-sizing: border-box;
  box-shadow: 0 0 5px rgba(0,0,0,0.4);
}

.ngcookiewarningtop {
	top: 0;
}

.ngcookiewarningbottom {
	bottom: 0;
}


.ngcookiewarning>button {
    float: right;
    margin: 0 0 10px 15px;
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
    -webkit-appearance: none;
}

.ngcookiewarning>button:hover
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

.ngcookiewarning>p {
  margin: 0;
  max-width: 60%;
  float: left;
}

a.ngcookieallow
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
	display: inline-block;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    text-decoration: none;
}

a.ngcookieallow:hover
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

@media screen and (max-width: 767px) {
    .ngcookiewarning>p {
        max-width: 100%;
        float: none;
        margin: 0 0 20px 0;
    }

    .ngcookiewarning>button {
        display: block;
        width: 100%;
        float: none;
        margin: 10px 0 0 0;
   }
}