ul.sqwpluginfacts {
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
}

ul.sqwpluginfacts > li {
    display: block;
    list-style: none;
    margin: 0 4% 20px 0;
    padding: 0;
    float: left;
    box-sizing: border-box;
}

ul.sqwpluginfacts > li:last-child {
    margin-right: 0;
}

ul.sqwpluginfacts:after {
    content: '';
    display: table;
    clear: both;
}

ul.sqwpluginfacts1cols > li {
    width: 100%;
}

ul.sqwpluginfacts2cols > li {
    width: 46%;
}

ul.sqwpluginfacts3cols > li {
    width: 30.666%;
}

ul.sqwpluginfacts4cols > li {
    width: 22%;
}

ul.sqwpluginfacts5cols > li {
    width: 16.8%;
}

ul.sqwpluginfacts img {
    display: block;
    width: 30%;
    height: auto;
    max-width: 100px;
    margin: 0 auto 20px auto;
    border: 0;
}

ul.sqwpluginfacts img.sqwpluginfactsbubble {
    border-radius: 50%;
}

ul.sqwpluginfactsanim img {
    opacity: 0;
    transform: scale3d(0, 0, 1);
    transition: opacity 0.8s cubic-bezier(0.175, 0.885, 0.320, 1.275), transform 0.8s cubic-bezier(0.175, 0.885, 0.320, 1.275);
}

ul.sqwpluginfactsanim img.sqwpluginfactappear {
    opacity: 1;
    transform: scale3d(1, 1, 1);
}

ul.sqwpluginfacts .sqwpluginfactslink {
    padding: 20px 0 10px 0;
}

ul.sqwpluginfacts .sqwpluginfactslink a {
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

ul.sqwpluginfacts .sqwpluginfactslink a:hover {
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

@media (max-width: 1024px) {
    ul.sqwpluginfacts4cols > li {
        width: 48%;
    }

    ul.sqwpluginfacts4cols > li:nth-child(2n) {
        margin-right: 0;
    }

    ul.sqwpluginfacts4cols > li:nth-child(2n+1) {
        clear: both;
    }
}

@media (max-width: 767px) {
    ul.sqwpluginfacts2cols > li,
    ul.sqwpluginfacts3cols > li,
    ul.sqwpluginfacts4cols > li,
    ul.sqwpluginfacts5cols > li {
        width: 100%;
        margin: 0 0 40px 0;
        float: none;
    }
}