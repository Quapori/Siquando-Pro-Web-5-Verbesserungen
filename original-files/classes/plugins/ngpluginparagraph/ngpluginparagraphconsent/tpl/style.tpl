.ngparaconsent>ul {
    display: block;
    margin: 0 0 20px 0;
    padding: 0;
    list-style: none;
}

.ngparaconsent>ul>li {
    display: block;
    margin: 0;
    padding: 0 0 20px 0;
    list-style: none;
}

.ngparaconsent>ul>li>div {
    display: flex;
    justify-content: space-between;
    align-items: center;
}


.ngparaconsent>ul>li>div>.ngparaconsenttoggleconsent {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    color: #{{$settingstypo->defaultfont|ngfontcolor}};
    user-select: none;
    padding-left: 20px;
    flex-shrink: 0;
}

.ngparaconsent>ul>li>div>a>span.ngparaconsentlabelactive {
    display: none;
}

.ngparaconsent>ul>li>div>a>span.ngparaconsentlabelnotactive {
    display: block;
}

.ngparaconsent>ul>li>div>a.ngparaconsentactive>span.ngparaconsentlabelactive {
    display: block;
}

.ngparaconsent>ul>li>div>a.ngparaconsentactive>span.ngparaconsentlabelnotactive {
    display: none;
}

.ngparaconsent>ul>li>div>.ngparaconsenttoggleconsent>div {
    height: 24px;
    width: 36px;
    background-color: #{{$settings->coloroff}};
    border-radius: 12px;
    position: relative;
    margin-left: 20px;

}

.ngparaconsenttoggleconsentanimate>div {
    transition: background-color 0.3s ease;
}

.ngparaconsent>ul>li>div>.ngparaconsenttoggleconsent>div>div {
    height: 20px;
    width: 20px;
    background-color: #{{$settings->colorknob}};
    border-radius: 10px;
    position: absolute;
    top: 2px;
    left: 2px;
}

.ngparaconsenttoggleconsentanimate>div>div {
    transition: left 0.3s ease;
}


.ngparaconsent>ul>li>div>a.ngparaconsentactive>div {
    background-color: #{{$settings->coloron}};
}

.ngparaconsent>ul>li>div>div.ngparaconsenttoggleconsent>div {
    background-color: #{{$settings->coloressential}};
}

.ngparaconsent>ul>li>div>a.ngparaconsentactive>div>div,
.ngparaconsent>ul>li>div>div.ngparaconsenttoggleconsent>div>div {
    left: 14px;
}

.ngparaconsent>div {
    display: flex;
    justify-content: flex-end;
}

.ngparaconsent button
{
	border-color: #{{$settingstypo->submitbordercolor}};
	border-width: {{$settingstypo->submitborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$settingstypo->submitpadding|ngmargin}};
{{if $settingstypo->submitbackground!==''}}
	background: {{$settingstypo->submitbackground|ngbackground}};
{{/if}}
	font: {{$settingstypo->submitfont|ngfont}};
	color: #{{$settingstypo->submitfont|ngfontcolor}};
{{if $settingstypo->submitfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $settingstypo->submitshadow!==''}}
	box-shadow: {{$settingstypo->submitshadow|ngshadow}};
{{/if}}
	border-radius: {{$settingstypo->submitroundedcorners|ngmargin}};
	display: block;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    margin: 0 0 10px 10px;
}

.ngparaconsent button:hover
{
	border-color: #{{$settingstypo->submithoverbordercolor}};
{{if $settingstypo->submithoverbackground!==''}}
	background: {{$settingstypo->submithoverbackground|ngbackground}};
{{/if}}
{{if $settingstypo->submithoverfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{else}}
	font-weight: normal;
{{/if}}
{{if $settingstypo->submithoverfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{else}}
	font-style: normal;
{{/if}}
{{if $settingstypo->submithoverfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
	color: #{{$settingstypo->submithoverfontstyle|ngfontstylecolor}};
}