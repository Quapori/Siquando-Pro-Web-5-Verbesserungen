.lightbox {
	position: fixed;
	background-color: #{{$settings->background}};
	border: 1px solid #{{$settings->border}};
	top: 0;
	left: 0;
	display: none;
	z-index: 2010;
	box-shadow: 5px 5px 10px rgba(0,0,0,0.2);
}

.lightbox img {
	display: block;
	position: absolute;
	margin: 8px;
	cursor: pointer;
}

.lightbox em {
	display: block;
	bottom: 0px;
	position: absolute;
	margin: 8px;
	color: #{{$settings->foreground}};
	font-style: normal;
}

.closer, .closeriframe {
	width: 32px;
	height: 32px;
	background: url(./../styles/{{$closer}}) no-repeat;
	position: absolute;
	z-index: 2020;
	cursor: pointer;
}

.closer {
	top: -17px;
	right: -17px;
}

.closeriframe 
{
	top: -32px;
	right: -32px;
}

.fader {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: none;
	background-color: #{{$settings->fader}};
	z-index: 2000;
}

.nextitem, .previtem
{
	display: block;
	position: absolute;
	width: 70px;
	top:0;
	bottom:0;
	cursor: pointer;
	background: url(./../navstyles/clearpixel.png);
}

.nextitem {
	right:0;
}

.nextitem:hover {
	background: url(./../navstyles/{{$next}}) right center no-repeat;
}

.previtem
{
	left:0;
}

.previtem:hover {
	background: url(./../navstyles/{{$prev}}) left center no-repeat;
}


.lightboxpopup {
	position: fixed;
	background-color: #{{$settings->background}};
	border: 1px solid #{{$settings->border}};
	padding: 20px;
	top: 20px;
	left: 20px;
	right: 20px;
	margin-left: auto;
	margin-right: auto;
	width: 720px;
	display: none;
	z-index: 2010;
	box-shadow: 5px 5px 10px rgba(0,0,0,0.2);
	box-sizing: border-box;
	color: #{{$settings->foreground}};
	transition: transform ease 0.3s;
}

@media (max-width: 767px) {
	.lightboxpopup {
		width: 100%;
		top: 0;
		left: 0;
		right: 0;
	}
}

.lightboxpopupwithpicture img {
	display: block;
	float: left;
	width: 18%;
	height: auto;
}

.lightboxpopupwithicon svg {
	display: block;
	float: left;
	width: 48px;
	height: 48px;
}

.lightboxpopupwithpicture .lightboxpopupmessage {
	float: right;
	width: 78%;
	min-height: 130px;
}

.lightboxpopupmessage pre {
    display: block;
    width: 100%;
    max-height: 200px;
    overflow: scroll;
    font: 13px monospace;
    padding: 10px;
    box-sizing: border-box;
}


.lightboxpopupwithicon .lightboxpopupmessage {
	float: right;
	width: calc(100% - 68px);
}

.lightboxpopup .lightboxpopupmessage p {
	margin-top: 0;
	margin-bottom: 10px;
}


.lightboxpopup .lightboxpopupbuttons {
	padding-top: 20px;
	text-align: right;
	clear: both;
}

.lightboxpopup .lightboxpopupbuttons > a,
.lightboxpopup .lightboxpopupbuttons > button
 {

	border-color: #{{$typographysettings->submitbordercolor}};
	border-width: {{$typographysettings->submitborderwidth|ngmargin}};
	border-style: solid;
	padding: {{$typographysettings->submitpadding|ngmargin}};
{{if $typographysettings->submitbackground!==''}}
	background: {{$typographysettings->submitbackground|ngbackground}};
{{/if}}
	font: {{$typographysettings->submitfont|ngfont}};
	color: #{{$typographysettings->submitfont|ngfontcolor}};
{{if $typographysettings->submitfont|ngfontisuppercase}}
	text-transform: uppercase;
{{/if}}
{{if $typographysettings->submitshadow!==''}}
	box-shadow: {{$typographysettings->submitshadow|ngshadow}};
{{/if}}
{{if $typographysettings->submitroundedcorners!='0'}}
	border-radius: {{$typographysettings->submitroundedcorners|ngmargin}};
{{/if}}
	display: inline-block;
	cursor: pointer;
    outline: none;
    -webkit-appearance: none;
    margin-left: 20px;
    text-decoration: none;
    box-sizing: border-box;
    text-align: center;
}

@media (max-width: 767px) {
	.lightboxpopup .lightboxpopupbuttons > a,
	.lightboxpopup .lightboxpopupbuttons > button {
		display: block;
		margin-left: 0;
		margin-top: 10px;
		width: 100%;
	}
}

.lightboxpopup .lightboxpopupbuttons > a:hover,
.lightboxpopup .lightboxpopupbuttons > button:hover
{
	border-color: #{{$typographysettings->submithoverbordercolor}};
{{if $typographysettings->submithoverbackground!==''}}
	background: {{$typographysettings->submithoverbackground|ngbackground}};
{{/if}}
{{if $typographysettings->submithoverfontstyle|ngfontstyleisbold}}
	font-weight: bold;
{{else}}
	font-weight: normal;
{{/if}}
{{if $typographysettings->submithoverfontstyle|ngfontstyleisitalic}}
	font-style: italic;
{{else}}
	font-style: normal;
{{/if}}
{{if $typographysettings->submithoverfontstyle|ngfontstyleisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
	color: #{{$typographysettings->submithoverfontstyle|ngfontstylecolor}};
	text-decoration: none;
}


@media (hover: none) and (min-width: 768px) {
	.nextitem {
		background: url(./../navstyles/{{$next}}) right center no-repeat;
	}

	.previtem {
		background: url(./../navstyles/{{$prev}}) left center no-repeat;
	}
}

@media (hover: none) and (max-width: 767px) {
	.nextitem:hover, .previtem:hover {
		background: none;	
	}
}