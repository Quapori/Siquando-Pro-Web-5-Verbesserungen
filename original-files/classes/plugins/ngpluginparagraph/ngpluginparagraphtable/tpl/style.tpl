div.tablecontainer {
	overflow: auto;
}

table.paragraphtable svg.paragraphtableicon {
    display: block;
    margin: 0 auto;
    border: 0;
    color: #{{$settings->cellfont|ngfontcolor}};
}

table.paragraphtable ul {
    margin: 0;
    padding:5px 0 5px 20px;
}

table.paragraphtable li {
    margin: 0;
}

table.paragraphtable a.paragraphtablebutton {
    display: inline-block;
    margin: 6px;
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
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    text-decoration: none;
}

table.paragraphtable a.paragraphtablebutton:hover {
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

table.paragraphtable
{
	border-collapse: collapse;
	margin-bottom: 10px;	
}

table.paragraphtable span.paragraphtablecheck {
	width: 15px;
	background: url(../img/?f=check&c={{$settings->cellfont|ngfontcolor}});
	display: inline-block;
	vertical-align: middle;
	height: 15px;
}

table.paragraphtable td,
table.paragraphtable th 
{
	border-color: #{{$settings->cellbordercolor}};
	border-width: {{$settings->cellborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->cellpadding|ngmargin}};
{{if $settings->cellbackground!==''}}
	background: {{$settings->cellbackground|ngbackground}};
{{/if}}
	line-height: 100%;
	text-align: left;
	vertical-align: top;
	font: {{$settings->cellfont|ngfont}};
	color: #{{$settings->cellfont|ngfontcolor}};
{{if $settings->cellfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
	
}

{{if $settings->cellaltbackground!==''}}

table.paragraphtable td.alt {
	background: {{$settings->cellaltbackground|ngbackground}};
}

{{/if}}

table.paragraphtable td.header,
table.paragraphtable th.header
{
	border-color: #{{$settings->cellheaderbordercolor}};
	border-width: {{$settings->cellheaderborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->cellheaderpadding|ngmargin}};
{{if $settings->cellheaderbackground!==''}}
	background: {{$settings->cellheaderbackground|ngbackground}};
{{/if}}
	font: {{$settings->cellheaderfont|ngfont}};
	color: #{{$settings->cellheaderfont|ngfontcolor}};
{{if $settings->cellheaderfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
}

table.paragraphtable p {
	margin: 0;
	padding: 0;
}

table.paragraphtable a img {
	border: none;
	display: block;
}


@media screen and (max-width: 767px) {
  .sqr .paragraphtablepivot thead {
    display: none;
  }
  .sqr .paragraphtablepivot td {
    display: block;
    width: 100% !important;
	border-color: #{{$settings->cellbordercolor}};
	border-width: {{$settings->cellborderwidth|ngmargin}};
	border-style: solid;
	border-top: none;
	box-sizing: border-box;
	text-align: left !important;
  }
  
  .sqr .paragraphtablepivot img {
    margin-top: 6px;
  }
  
  .sqr .paragraphtablepivot td:before {
    content: attr(data-header) ": ";
    font-style: italic;
    display: block;
  }
  .sqr .paragraphtablepivot tr {
    display: block;
    border: none;
  }
  .sqr .paragraphtablepivot td:first-child {
	border-color: #{{$settings->cellheaderbordercolor}};
	border-width: {{$settings->cellheaderborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settings->cellheaderpadding|ngmargin}};
{{if $settings->cellheaderbackground!==''}}
	background: {{$settings->cellheaderbackground|ngbackground}};
{{/if}}
	font: {{$settings->cellheaderfont|ngfont}};
	color: #{{$settings->cellheaderfont|ngfontcolor}};
{{if $settings->cellheaderfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
  }
  .sqr .paragraphtablepivot td:last-child {
    border-bottom: none;
  }
  
  .sqr .paragraphtablepivot {
 	border-bottom-color: #{{$settings->cellbordercolor}};
	border-bottom-width: {{$settings->cellborderwidth|ngmargin}};
	border-bottom-style: solid;
  }
  
  .sqr .paragraphtablepivot td:first-child:before {
    content: '';
  }

}