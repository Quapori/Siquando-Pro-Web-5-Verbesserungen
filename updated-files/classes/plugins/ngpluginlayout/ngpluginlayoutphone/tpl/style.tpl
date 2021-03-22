HTML {
	background: {{$settings->background|ngbackground}};
}

BODY {
	margin: 0;	
	padding: {{$settings->padding|ngmargin}};
	-webkit-text-size-adjust: 100%;
}

#main {
	width: {{$settings->mainWidth()}}px;
}

{{if $settings->navvisible}}
#nav
{
	margin: {{$settings->navmargin|ngmargin}};
	padding: {{$settings->navpadding|ngmargin}};
{{if $settings->navbackground!=''}}
	background: {{$settings->navbackground|ngbackground}};
{{/if}}
{{if $settings->navborderwidth!=''}}
	border-color: #{{$settings->navbordercolor}};
	border-width: {{$settings->navborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->navroundedcorners!='0'}}
	border-radius: {{$settings->navroundedcorners|ngmargin}};
{{/if}}
{{if $settings->navshadow|ngisshadow}}
	box-shadow: {{$settings->navshadow|ngshadow}};
{{/if}}
}

#eyecatcher img {
	display: block;
}

#nav ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#nav li {
	margin: 0;
	position:relative;
	cursor: pointer;
	padding: {{$settings->navnavpadding|ngmargin}};
{{if $settings->navseparator|ngisline}}
	border-bottom: {{$settings->navseparator|ngline}};
{{/if}}
}

#nav a {
	text-decoration: none;
	display: block;
	background: url(./../styles/{{$settings->navstyle}}.png) center right no-repeat;
	font: {{$settings->navfont|ngfont}};
	color: #{{$settings->navfont|ngfontcolor}};
{{if $settings->navfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}	
}

#shownav a, #hidenav a {
	background: url(./../styles/{{$settings->navshownavstyle}}.png) center right no-repeat;
}

#hidenav, #shownav
{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

#nav li:last-child {
	border-bottom: none;
}

{{/if}}

{{if $settings->searchvisible}}
#search
{
	margin: {{$settings->searchmargin|ngmargin}};
	padding: {{$settings->searchpadding|ngmargin}};
{{if $settings->searchbackground!=''}}
	background: {{$settings->searchbackground|ngbackground}};
{{/if}}
{{if $settings->searchborderwidth!=''}}
	border-color: #{{$settings->searchbordercolor}};
	border-width: {{$settings->searchborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->searchroundedcorners!='0'}}
	border-radius: {{$settings->searchroundedcorners|ngmargin}};
{{/if}}
{{if $settings->searchshadow|ngisshadow}}
	box-shadow: {{$settings->searchshadow|ngshadow}};
{{/if}}
}

#search form {
{{if $settings->searchsearchborderwidth!=''}}
	border-color: #{{$settings->searchsearchbordercolor}};
	border-width: {{$settings->searchsearchborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$settings->searchsearchbackground|ngbackground}};
	{{if $settings->searchsearchroundedcorners!='0'}}
		border-radius: {{$settings->searchsearchroundedcorners|ngmargin}};
	{{/if}}
	position: relative;
	padding: 6px;
}

#search form input {
	color: #{{$settings->searchsearchcolor}};
	width: {{$settings->mainWidth()-$settings->searchExtraWidth()-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
}

#search button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$settings->searchsearchstyle}}.png) no-repeat;
	position: absolute;
	right: 6px;
	top: 50%;
	margin-top: -8px;
	width: 16px;
	height: 16px;
	border: 0;
	cursor: pointer;
}
{{/if}}

#header
{
	margin: {{$settings->headermargin|ngmargin}};
	padding: {{$settings->headerpadding|ngmargin}};
{{if $settings->headerbackground!=''}}
	background: {{$settings->headerbackground|ngbackground}};
{{/if}}
{{if $settings->headerborderwidth!=''}}
	border-color: #{{$settings->headerbordercolor}};
	border-width: {{$settings->headerborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->headerroundedcorners!='0'}}
	border-radius: {{$settings->headerroundedcorners|ngmargin}};
{{/if}}
{{if $settings->headershadow|ngisshadow}}
	box-shadow: {{$settings->headershadow|ngshadow}};
{{/if}}
}

#choose
{
	margin: {{$settings->choosemargin|ngmargin}};
	padding: {{$settings->choosepadding|ngmargin}};
{{if $settings->choosebackground!=''}}
	background: {{$settings->choosebackground|ngbackground}};
{{/if}}
{{if $settings->chooseborderwidth!=''}}
	border-color: #{{$settings->choosebordercolor}};
	border-width: {{$settings->chooseborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->chooseroundedcorners!='0'}}
	border-radius: {{$settings->chooseroundedcorners|ngmargin}};
{{/if}}
{{if $settings->chooseshadow|ngisshadow}}
	box-shadow: {{$settings->chooseshadow|ngshadow}};
{{/if}}
	display: none;
}

#choose button
{
	margin: {{$settings->choosemarginlink|ngmargin}};
	padding: {{$settings->choosepaddinglink|ngmargin}};
	background: {{$settings->choosebackgroundlink|ngbackground}};
	border-color: #{{$settings->choosebordercolorlink}};
	border-width: {{$settings->chooseborderwidthlink|ngmargin}};
	border-style: solid;
{{if $settings->chooseroundedcornerslink!='0'}}
	border-radius: {{$settings->chooseroundedcornerslink|ngmargin}};
{{/if}}
{{if $settings->choosefontlink|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}	
	width: {{$settings->chooseButtonWidth()}}px;
	font: {{$settings->choosefontlink|ngfont}};
	color: #{{$settings->choosefontlink|ngfontcolor}};
	outline:none;
}

#choose p {
	font: {{$settings->choosefonttext|ngfont}};
	color: #{{$settings->choosefonttext|ngfontcolor}};
{{if $settings->choosefonttext|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}	
	margin: 0;	
}

#sidebarleft
{
	margin: {{$settings->leftmargin|ngmargin}};
	padding: {{$settings->leftpadding|ngmargin}};
{{if $settings->leftbackground!=''}}
	background: {{$settings->leftbackground|ngbackground}};
{{/if}}
{{if $settings->leftborderwidth!=''}}
	border-color: #{{$settings->leftbordercolor}};
	border-width: {{$settings->leftborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->leftroundedcorners!='0'}}
	border-radius: {{$settings->leftroundedcorners|ngmargin}};
{{/if}}
{{if $settings->leftshadow|ngisshadow}}
	box-shadow: {{$settings->leftshadow|ngshadow}};
{{/if}}
}

#content
{
	margin: {{$settings->contentmargin|ngmargin}};
	padding: {{$settings->contentpadding|ngmargin}};
{{if $settings->contentbackground!=''}}
	background: {{$settings->contentbackground|ngbackground}};
{{/if}}
{{if $settings->contentborderwidth!=''}}
	border-color: #{{$settings->contentbordercolor}};
	border-width: {{$settings->contentborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->contentroundedcorners!='0'}}
	border-radius: {{$settings->contentroundedcorners|ngmargin}};
{{/if}}
{{if $settings->contentshadow|ngisshadow}}
	box-shadow: {{$settings->contentshadow|ngshadow}};
{{/if}}
}

#sidebarright
{
	margin: {{$settings->rightmargin|ngmargin}};
	padding: {{$settings->rightpadding|ngmargin}};
{{if $settings->rightbackground!=''}}
	background: {{$settings->rightbackground|ngbackground}};
{{/if}}
{{if $settings->rightborderwidth!=''}}
	border-color: #{{$settings->rightbordercolor}};
	border-width: {{$settings->rightborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->rightroundedcorners!='0'}}
	border-radius: {{$settings->rightroundedcorners|ngmargin}};
{{/if}}
{{if $settings->rightshadow|ngisshadow}}
	box-shadow: {{$settings->rightshadow|ngshadow}};
{{/if}}
}

#footer
{
	margin: {{$settings->footermargin|ngmargin}};
	padding: {{$settings->footerpadding|ngmargin}};
{{if $settings->footerbackground!=''}}
	background: {{$settings->footerbackground|ngbackground}};
{{/if}}
{{if $settings->footerborderwidth!=''}}
	border-color: #{{$settings->footerbordercolor}};
	border-width: {{$settings->footerborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->footerroundedcorners!='0'}}
	border-radius: {{$settings->footerroundedcorners|ngmargin}};
{{/if}}
{{if $settings->footershadow|ngisshadow}}
	box-shadow: {{$settings->footershadow|ngshadow}};
{{/if}}
}

{{if $settings->commonvisible}}
#common
{
	margin: {{$settings->commonmargin|ngmargin}};
	padding: {{$settings->commonpadding|ngmargin}};
{{if $settings->commonbackground!=''}}
	background: {{$settings->commonbackground|ngbackground}};
{{/if}}
{{if $settings->commonborderwidth!=''}}
	border-color: #{{$settings->commonbordercolor}};
	border-width: {{$settings->commonborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->commonroundedcorners!='0'}}
	border-radius: {{$settings->commonroundedcorners|ngmargin}};
{{/if}}
{{if $settings->commonshadow|ngisshadow}}
	box-shadow: {{$settings->commonshadow|ngshadow}};
{{/if}}
}

#common ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#common li {
	margin: 0;
}

#common a {
	text-decoration: none;
	display: block;
	font: {{$settings->commonfontpages|ngfont}};
	color: #{{$settings->commonfontpages|ngfontcolor}};
	padding: {{$settings->commonnavpadding|ngmargin}};
{{if $settings->commonfontpages|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
}

#common span {
	display: block;
	font: {{$settings->commonfontfolders|ngfont}};
	padding: {{$settings->commonnavpadding|ngmargin}};
	color: #{{$settings->commonfontfolders|ngfontcolor}};
{{if $settings->commonfontfolders|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}	
}
	
{{/if}}