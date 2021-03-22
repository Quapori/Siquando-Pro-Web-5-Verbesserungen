.ngform .ngformcolumn
{
	float: left;
}

.ngform .ngformcolumns1 .ngformcolumn {
	width: 100%;
}

.ngform .ngformlabel
{
	font: {{$settings->fieldcaptionfont|ngfont}};
	color: #{{$settings->fieldcaptionfont|ngfontcolor}};
{{if $settings->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	padding: 5px 5px 0 0;
}

.ngform label.ngformright 
{
	font: {{$settings->fieldcaptionfont|ngfont}};
	color: #{{$settings->fieldcaptionfont|ngfontcolor}};
{{if $settings->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	padding: 5px 0 0 0;
}


.ngform .ngformerror
{
	color: #{{$settings->fieldcaptionerrorcolor}};
	padding: 10px;
	text-align: center;
	font-weight: bold;
	margin: 5px 0 20px 0;
}

.ngform label.ngerror
{
	color: #{{$settings->fieldcaptionerrorcolor}};
}


.ngform label.ngmandatory
{
	font-weight: bold;
}

.ngform .ngformnopad
{
	padding: 5px 0 0 0;
}

.ngform input[type=text], .ngform input[type=password], .ngform input[type=email], .ngform textarea, .ngform input[type=number] 
{
	-webkit-appearance: none;	
}

.ngform .ngformspacer {
    height: 32px;
    margin-bottom: 10px;
}

.ngform .ngformline {
    border: 0;
    padding: 6px 0;
    margin-bottom: 10px;
}

.ngform .ngformline hr {
    border: 0;
    height: 1px;
    background-color: #{{$settings->fieldbordercolor}};
}


.ngform input[type=text], .ngform input[type=password], .ngform input[type=email], .ngform select, .ngform textarea, .ngform input[type=number], .ngform input[type=date], .ngform input[type=time]
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
	border-radius: {{$settings->fieldroundedcorners|ngmargin}};
}

.ngform select {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   background-image: url("data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2225%22%20height%3D%2216%22%20viewBox%3D%220%200%2025.00%2016.00%22%20enable-background%3D%22new%200%200%2025.00%2016.00%22%20xml%3Aspace%3D%22preserve%22%3E%3Cpath%20fill%3D%22%23{{$settings->fieldfont|ngfontcolor}}%22%20d%3D%22M%206.36396%2C12.7782L%204.94975%2C11.364L%200%2C6.41422L%201.41421%2C5L%206.36396%2C9.94975L%2011.3137%2C5L%2012.7279%2C6.41421L%207.77817%2C11.364L%206.36396%2C12.7782%20Z%20%22%2F%3E%3C%2Fsvg%3E");
   background-repeat: no-repeat;
   background-position: right center;
   padding-right: 30px;
}

.ngform select::-ms-expand {
    display: none;
}

.ngform img {
    display: block;
    height: auto;
}

.ngform input[type=number]
{
	min-width: 100px;
}

.ngform input[type=checkbox],
.ngform input[type=radio]
{
 	margin:0;
	padding: 0;
}

.ngform input[type=submit]
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
	float: right;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    margin-top: 20px;
}

.ngform input[type=submit]:hover
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


.ngform .ngradiogroup
{
	margin-bottom: 4px;
	display: block;
}

.ngform textarea 
{
	height: 100px;
}

input::-webkit-calendar-picker-indicator{
    display: inline;
}

.ngform .ngformright,
.ngform .ngformleft
{
		display: block;
		margin: 0 0 10px 0;
		box-sizing: border-box;
}

.ngform .ngformright
{
	float: left;
	width: 65%;
}
.ngform .ngformleft
{
	float: left;
	width: 35%;
}
	
.ngform .ngformcolumns2 .ngformcolumn {
	width: 49%;
}

.ngform .ngformcolumns2 .ngformcolumn:first-child {
	margin-right: 2%;
}


@media screen and (max-width: 1023px) 
{
	.ngform .ngformcolumns2 .ngformcolumn {
		width: 100%;
		margin-right: 0;
	}
}

@media screen and (max-width: 767px) {
	.sqr .ngform .ngformright
	{
		width: 100%;
		float: none;
	}
	.sqr .ngform .ngformleft
	{
		width: 100%;
		float: none;
	}	
} 