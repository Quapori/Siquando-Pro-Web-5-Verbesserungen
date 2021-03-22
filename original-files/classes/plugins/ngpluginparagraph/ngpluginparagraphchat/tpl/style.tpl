.ngparachat label {
	font: {{$typo->fieldcaptionfont|ngfont}};
	color: #{{$typo->fieldcaptionfont|ngfontcolor}};
{{if $typo->fieldcaptionfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
    display: block;
    box-sizing: border-box;
    width: 100%;
    margin: 10px 0 3px 0;
}

.ngparachat form input[type=text] {
 	border-color: #{{$typo->fieldbordercolor}};
	border-width: {{$typo->fieldborderwidth|ngmargin}};
	border-style: solid;
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
{{if $typo->fieldroundedcorners!='0'}}
	border-radius: {{$typo->fieldroundedcorners|ngmargin}};
{{else}}
    border-radius: 0;
{{/if}}
    display: block;
    box-sizing: border-box;
    width: 100%;
    margin: 3px 0;
    -webkit-appearance: none;
}

.ngparachat form .ngparachatconsent {
    display: block;
    margin: 15px 0 5px 0;
}

.ngparachat form input[type=submit] {
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
	float: right;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
}

.ngparachat form .ngparachaterror
{
	color: #{{$typo->fieldcaptionerrorcolor}};
}

.ngparachat form input[type=submit]:hover
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

.ngparachat .ngparachatoutput {
    list-style: none;
    padding: 0;
    margin: 0;
    overflow-y: scroll;
 	border-color: #{{$typo->fieldbordercolor}};
	border-width: {{$typo->fieldborderwidth|ngmargin}};
	border-style: solid;
}

.ngparachat .ngparachatoutput .ngparachatemoji {
    width: 1.2em;
    height: 1.2em;
    background-size: 1.2em 1.2em;
    background-repeat: no-repeat;
    display: inline-block;
    vertical-align: -0.3em;
}

.ngparachat .ngparachatoutput .ngparachatbigemoji {
    width: 3em;
    height: 3em;
    background-size: 3em 3em;
    background-repeat: no-repeat;
    display: block;
}

.ngparachat .ngparachatwink { background-image: url(../img/wink.svg); }
.ngparachat .ngparachatsad { background-image: url(../img/sad.svg); }
.ngparachat .ngparachatdead { background-image: url(../img/dead.svg); }
.ngparachat .ngparachathappy { background-image: url(../img/happy.svg); }
.ngparachat .ngparachatlol { background-image: url(../img/lol.svg); }
.ngparachat .ngparachatsurprise { background-image: url(../img/surprise.svg); }
.ngparachat .ngparachatlove { background-image: url(../img/love.svg); }
.ngparachat .ngparachatangry { background-image: url(../img/angry.svg); }

.ngparachat .ngparachatoutput li {
    margin: 10px 20px 10px 10%;
    padding: 14px 18px;
    border-radius: 12px;
    display: block;
    position: relative;
    line-height: {{$lineheight}}px;
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.ngparachat .ngparachatoutput li.ngparachatmy {
    margin: 10px 10% 10px 20px;
}

.ngparachat .ngparachatoutput li strong {
    display: block;
    font-weight: bold;
}

.ngparachat .ngparachatoutput li span {
    display: block;
    margin-top: 3px;
}

.ngparachat .ngparachatoutput li small {
    display: block;
    margin-bottom: 3px;
    font-size: 80%;
    -webkit-text-size-adjust: 100%;
    text-align: right;
}

.ngparachat form {
    display: none;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.ngparachat form:after {
  content: "";
  display: table;
  clear: both;
}

.ngparachat .ngparachatemojis {
    float: left;
    margin-bottom: 10px;
}

.ngparachat>form>div {
    margin-top: 20px;
}

.ngparachat .ngparachatemojis a {
    display: inline-block;
    width: 20px;
    height: 20px;
    background-size: 20px 20px;
    background-repeat: no-repeat;
}

.ngparachat .ngparachatemojis a span {
    display: none;
}