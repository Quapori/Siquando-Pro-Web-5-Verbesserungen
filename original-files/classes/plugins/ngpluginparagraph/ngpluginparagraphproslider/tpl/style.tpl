.ngparaproslider {
    width: 100%;
    position: relative;
}

.ngparaproslider ul {
    margin: 0;
    padding: 0;
    display: block;
    list-style: none;
    overflow: hidden;
    width: 100%;
    position: relative;
}

.ngparaproslider ul > li {
    margin: 0;
    padding: 0;
    display: block;
    list-style: none;
    position: absolute;
}

.ngparaproslider ul > li > img {
    width: 100%;
    height: auto;
    user-select: none;
}

.ngparaproslider .ngparaproslidernext,
.ngparaproslider .ngparaprosliderprev {
    z-index: 1;
    cursor: pointer;
    position: absolute;
    top: 0;
}

.ngparaproslider .ngparaproslidernext {
    right: 0;
}

.ngparaproslider .ngparaprosliderprev {
    left: 0;
}

.ngparaproslider .ngparaproslidernext > img,
.ngparaproslider .ngparaprosliderprev > img {
    width: 40px;
    height: 40px;
    position: absolute;
    display: block;
    opacity: 0.8;
    transition: opacity 0.2s;
    user-select: none;
}

.ngparaproslider .ngparaproslidernext > img {
    left: 0;
}

.ngparaproslider .ngparaprosliderprev > img {
    right: 0;
}

.ngparaprosliderbullets {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.ngparaprosliderbullets div {
    width: 20px;
    height: 20px;
    background-repeat: no-repeat;
    opacity: 0.3;
    transition: opacity 0.2s;
}

.ngparaprosliderbullets div.ngparaprosliderbulletcurrent {
    opacity: 0.8;
}

.ngparaproslidermore a
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
    float: right;
    -webkit-appearance: none;
    margin-top: 20px;
    text-decoration: none;
}

.ngparaproslidermore:after {
    content: "";
    display: table;
    clear: both;
}

.ngparaproslidermore a:hover
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
