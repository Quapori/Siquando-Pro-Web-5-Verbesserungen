HTML {
	background: {{$settings->background|ngbackground}};
{{if $settings->background|ngisstretchpicture}}
	-webkit-background-size: 100%;
	-moz-background-size: 100%;
	-o-background-size: 100%;
	background-size: 100%;
{{/if}}
{{if $settings->background|ngisfixpicture}}
	background-attachment: fixed;
{{/if}}
}

BODY {
	margin: {{$settings->margin|ngmargin}};	
}

#navouterbox {
{{if $settings->navfill!=''}}
	background: {{$settings->navfill|ngbackground}};
{{/if}}
{{if $settings->navlinetop|ngisline}}
	border-top: {{$settings->navlinetop|ngline}};
{{/if}}
{{if $settings->navlinebottom|ngisline}}
	border-bottom: {{$settings->navlinebottom|ngline}};
{{/if}}
{{if $settings->navposition=='fixed'}}
	position: fixed;
	top: 0;
	width: 100%;
	z-index: 1000;
{{/if}}
}

#nav
{
	position: relative;
	width: {{$settings->width-$settings->navExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->navmargin|ngmargincenter}};
{{else}}
	margin: {{$settings->navmargin|ngmargin}};
{{/if}}
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

#eyecatcherouterbox {
{{if $settings->eyecatcherfill!=''}}
	background: {{$settings->eyecatcherfill|ngbackground}};
{{/if}}
{{if $settings->eyecatcherlinetop|ngisline}}
	border-top: {{$settings->eyecatcherlinetop|ngline}};
{{/if}}
{{if $settings->eyecatcherlinebottom|ngisline}}
	border-bottom: {{$settings->eyecatcherlinebottom|ngline}};
{{/if}}
}

#eyecatcher
{
	width: {{$settings->width-$settings->eyecatcherExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->eyecatchermargin|ngmargincenter}};
{{else}}
	margin: {{$settings->eyecatchermargin|ngmargin}};
{{/if}}
	padding: {{$settings->eyecatcherpadding|ngmargin}};
{{if $settings->eyecatcherbackground!=''}}
	background: {{$settings->eyecatcherbackground|ngbackground}};
{{/if}}
{{if $settings->eyecatcherborderwidth!=''}}
	border-color: #{{$settings->eyecatcherbordercolor}};
	border-width: {{$settings->eyecatcherborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->eyecatcherroundedcorners!='0'}}
	border-radius: {{$settings->eyecatcherroundedcorners|ngmargin}};
{{/if}}
{{if $settings->eyecatchershadow|ngisshadow}}
	box-shadow: {{$settings->eyecatchershadow|ngshadow}};
{{/if}}
}

#headerouterbox {
{{if $settings->headerfill!=''}}
	background: {{$settings->headerfill|ngbackground}};
{{/if}}
{{if $settings->headerlinetop|ngisline}}
	border-top: {{$settings->headerlinetop|ngline}};
{{/if}}
{{if $settings->headerlinebottom|ngisline}}
	border-bottom: {{$settings->headerlinebottom|ngline}};
{{/if}}
}

#header
{
	width: {{$settings->width-$settings->headerExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->headermargin|ngmargincenter}};
{{else}}
	margin: {{$settings->headermargin|ngmargin}};
{{/if}}
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

#containermainouterbox {
{{if $settings->containermainfill!=''}}
	background: {{$settings->containermainfill|ngbackground}};
{{/if}}
{{if $settings->containermainlinetop|ngisline}}
	border-top: {{$settings->containermainlinetop|ngline}};
{{/if}}
{{if $settings->containermainlinebottom|ngisline}}
	border-bottom: {{$settings->containermainlinebottom|ngline}};
{{/if}}
}

#containermain
{
	width: {{$settings->width-$settings->containermainExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->containermainmargin|ngmargincenter}};
{{else}}
	margin: {{$settings->containermainmargin|ngmargin}};
{{/if}}
	padding: {{$settings->containermainpadding|ngmargin}};
{{if $settings->containermainbackground!=''}}
	background: {{$settings->containermainbackground|ngbackground}};
{{/if}}
{{if $settings->containermainborderwidth!=''}}
	border-color: #{{$settings->containermainbordercolor}};
	border-width: {{$settings->containermainborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->containermainroundedcorners!='0'}}
	border-radius: {{$settings->containermainroundedcorners|ngmargin}};
{{/if}}
{{if $settings->containermainshadow|ngisshadow}}
	box-shadow: {{$settings->containermainshadow|ngshadow}};
{{/if}}
}

#containerleft
{
	width: {{$settings->width-$settings->containerleftExtraWidth()}}px;
	margin: {{$settings->containerleftmargin|ngmargin}};
	padding: {{$settings->containerleftpadding|ngmargin}};
{{if $settings->containerleftbackground!=''}}
	background: {{$settings->containerleftbackground|ngbackground}};
{{/if}}
{{if $settings->containerleftborderwidth!=''}}
	border-color: #{{$settings->containerleftbordercolor}};
	border-width: {{$settings->containerleftborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->containerleftroundedcorners!='0'}}
	border-radius: {{$settings->containerleftroundedcorners|ngmargin}};
{{/if}}
{{if $settings->containerleftshadow|ngisshadow}}
	box-shadow: {{$settings->containerleftshadow|ngshadow}};
{{/if}}
}

#containerright
{
	width: {{$settings->width-$settings->containerrightExtraWidth()}}px;
	margin: {{$settings->containerrightmargin|ngmargin}};
	padding: {{$settings->containerrightpadding|ngmargin}};
{{if $settings->containerrightbackground!=''}}
	background: {{$settings->containerrightbackground|ngbackground}};
{{/if}}
{{if $settings->containerrightborderwidth!=''}}
	border-color: #{{$settings->containerrightbordercolor}};
	border-width: {{$settings->containerrightborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->containerrightroundedcorners!='0'}}
	border-radius: {{$settings->containerrightroundedcorners|ngmargin}};
{{/if}}
{{if $settings->containerrightshadow|ngisshadow}}
	box-shadow: {{$settings->containerrightshadow|ngshadow}};
{{/if}}
}

#sidebarleft
{
	width: {{$settings->leftwidth}}px;
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

#sidebarright
{
	width: {{$settings->rightwidth}}px;
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

#containerleft, #containerright {
	min-height: 1px;
	float: left;
}


#content
{
	min-height: 1px;
	float: left;
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

{{if $settings->contentborderbreadcrumbs!=''}}
#content .breadcrumbs {
	border-bottom: 1px solid #{{$settings->contentborderbreadcrumbs}};
}
{{/if}}



#navleft
{
	width: {{$settings->navleftwidth}}px;
	margin: {{$settings->navleftmargin|ngmargin}};
	padding: {{$settings->navleftpadding|ngmargin}};
{{if $settings->navleftbackground!=''}}
	background: {{$settings->navleftbackground|ngbackground}};
{{/if}}
{{if $settings->navleftborderwidth!=''}}
	border-color: #{{$settings->navleftbordercolor}};
	border-width: {{$settings->navleftborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->navleftroundedcorners!='0'}}
	border-radius: {{$settings->navleftroundedcorners|ngmargin}};
{{/if}}
{{if $settings->navleftshadow|ngisshadow}}
	box-shadow: {{$settings->navleftshadow|ngshadow}};
{{/if}}
}

#navright
{
	width: {{$settings->navrightwidth}}px;
	margin: {{$settings->navrightmargin|ngmargin}};
	padding: {{$settings->navrightpadding|ngmargin}};
{{if $settings->navrightbackground!=''}}
	background: {{$settings->navrightbackground|ngbackground}};
{{/if}}
{{if $settings->navrightborderwidth!=''}}
	border-color: #{{$settings->navrightbordercolor}};
	border-width: {{$settings->navrightborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->navrightroundedcorners!='0'}}
	border-radius: {{$settings->navrightroundedcorners|ngmargin}};
{{/if}}
{{if $settings->navrightshadow|ngisshadow}}
	box-shadow: {{$settings->navrightshadow|ngshadow}};
{{/if}}
}


{{if $settings->searchleftvisible}}
#searchleft
{
	width: {{$settings->searchleftwidth}}px;
	margin: {{$settings->searchleftmargin|ngmargin}};
	padding: {{$settings->searchleftpadding|ngmargin}};
{{if $settings->searchleftbackground!=''}}
	background: {{$settings->searchleftbackground|ngbackground}};
{{/if}}
{{if $settings->searchleftborderwidth!=''}}
	border-color: #{{$settings->searchleftbordercolor}};
	border-width: {{$settings->searchleftborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->searchleftroundedcorners!='0'}}
	border-radius: {{$settings->searchleftroundedcorners|ngmargin}};
{{/if}}
{{if $settings->searchleftshadow|ngisshadow}}
	box-shadow: {{$settings->searchleftshadow|ngshadow}};
{{/if}}
}

#searchleft form {
{{if $settings->searchleftsearchborderwidth!=''}}
	border-color: #{{$settings->searchleftsearchbordercolor}};
	border-width: {{$settings->searchleftsearchborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$settings->searchleftsearchbackground|ngbackground}};
	{{if $settings->searchleftsearchroundedcorners!='0'}}
		border-radius: {{$settings->searchleftsearchroundedcorners|ngmargin}};
	{{/if}}
}

#searchleft form input {
	color: #{{$settings->searchleftsearchcolor}};
	width: {{$settings->searchleftwidth-40}}px;
	font-size: 13px;
}

#searchleft button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$settings->searchleftsearchstyle}}.png) no-repeat;
}
{{/if}}

{{if $settings->searchrightvisible}}
#searchright
{
	width: {{$settings->searchrightwidth}}px;
	margin: {{$settings->searchrightmargin|ngmargin}};
	padding: {{$settings->searchrightpadding|ngmargin}};
{{if $settings->searchrightbackground!=''}}
	background: {{$settings->searchrightbackground|ngbackground}};
{{/if}}
{{if $settings->searchrightborderwidth!=''}}
	border-color: #{{$settings->searchrightbordercolor}};
	border-width: {{$settings->searchrightborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->searchrightroundedcorners!='0'}}
	border-radius: {{$settings->searchrightroundedcorners|ngmargin}};
{{/if}}
{{if $settings->searchrightshadow|ngisshadow}}
	box-shadow: {{$settings->searchrightshadow|ngshadow}};
{{/if}}
}

#searchright form {
{{if $settings->searchrightsearchborderwidth!=''}}
	border-color: #{{$settings->searchrightsearchbordercolor}};
	border-width: {{$settings->searchrightsearchborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$settings->searchrightsearchbackground|ngbackground}};
{{if $settings->searchrightsearchroundedcorners!='0'}}
	border-radius: {{$settings->searchrightsearchroundedcorners|ngmargin}};
{{/if}}
}

#searchright form input {
	color: #{{$settings->searchrightsearchcolor}};
	width: {{$settings->searchrightwidth-40}}px;
	font-size: 13px;
}

#searchright button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$settings->searchrightsearchstyle}}.png) no-repeat;
}
{{/if}}

{{if $settings->searchleftvisible || $settings->searchrightvisible}}
#searchleft form, #searchright form 
{
	position: relative;
	padding: 6px;
}

#searchleft input, #searchright input {
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
}

#searchleft button, #searchright button 
{
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

#footerouterbox {
{{if $settings->footerfill!=''}}
	background: {{$settings->footerfill|ngbackground}};
{{/if}}
{{if $settings->footerlinetop|ngisline}}
	border-top: {{$settings->footerlinetop|ngline}};
{{/if}}
{{if $settings->footerlinebottom|ngisline}}
	border-bottom: {{$settings->footerlinebottom|ngline}};
{{/if}}
}

#footer
{
	width: {{$settings->width-$settings->footerExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->footermargin|ngmargincenter}};
{{else}}
	margin: {{$settings->footermargin|ngmargin}};
{{/if}}
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

#commonouterbox {
{{if $settings->commonfill!=''}}
	background: {{$settings->commonfill|ngbackground}};
{{/if}}
{{if $settings->commonlinetop|ngisline}}
	border-top: {{$settings->commonlinetop|ngline}};
{{/if}}
{{if $settings->commonlinebottom|ngisline}}
	border-bottom: {{$settings->commonlinebottom|ngline}};
{{/if}}
}


#common
{
	width: {{$settings->width-$settings->commonExtraWidth()}}px;
{{if $settings->center}}
	margin: {{$settings->commonmargin|ngmargincenter}};
{{else}}
	margin: {{$settings->commonmargin|ngmargin}};
{{/if}}
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

#logoleft
{
	width: {{$settings->logoleftwidth}}px;
	margin: {{$settings->logoleftmargin|ngmargin}};
	padding: {{$settings->logoleftpadding|ngmargin}};
{{if $settings->logoleftbackground!=''}}
	background: {{$settings->logoleftbackground|ngbackground}};
{{/if}}
{{if $settings->logoleftborderwidth!=''}}
	border-color: #{{$settings->logoleftbordercolor}};
	border-width: {{$settings->logoleftborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->logoleftroundedcorners!='0'}}
	border-radius: {{$settings->logoleftroundedcorners|ngmargin}};
{{/if}}
{{if $settings->logoleftshadow|ngisshadow}}
	box-shadow: {{$settings->logoleftshadow|ngshadow}};
{{/if}}
}

#logoleft img {
	display: block;
	border: 0;
}

#logoright
{
	width: {{$settings->logorightwidth}}px;
	margin: {{$settings->logorightmargin|ngmargin}};
	padding: {{$settings->logorightpadding|ngmargin}};
{{if $settings->logorightbackground!=''}}
	background: {{$settings->logorightbackground|ngbackground}};
{{/if}}
{{if $settings->logorightborderwidth!=''}}
	border-color: #{{$settings->logorightbordercolor}};
	border-width: {{$settings->logorightborderwidth|ngmargin}};
	border-style: solid;
{{/if}}
{{if $settings->logorightroundedcorners!='0'}}
	border-radius: {{$settings->logorightroundedcorners|ngmargin}};
{{/if}}
{{if $settings->logorightshadow|ngisshadow}}
	box-shadow: {{$settings->logorightshadow|ngshadow}};
{{/if}}
}

#logoright img {
	display: block;
	border: 0;
}


.logo 
{
	display: block;
}