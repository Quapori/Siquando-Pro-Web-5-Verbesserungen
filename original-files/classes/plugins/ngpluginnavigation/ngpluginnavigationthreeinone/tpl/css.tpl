#{{$target}} .pluginnavigationthreeinonecontainer {
	height: {{$config[1]}}px;
	position: relative;
}

#{{$target}} img {
	display: block;
	padding:{{$config[4]|ngmargin}};
	border: 0; 
	position: absolute;
	top: 0;
{{if $config[3]=='Left'}}
	left: 0;
{{else}}
	right: 0;
{{/if}}
}

{{if $config[5]=='true'}}

#{{$target}} ul.pluginnavigationthreeinonedropdown {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
	position: absolute;
	bottom: 0;
	z-index: 1000;
}

#{{$target}} ul.pluginnavigationthreeinonedropdown li {
	display: block;
	position: relative;
}

#{{$target}} ul.pluginnavigationthreeinonedropdown>li {
	float: left;
}

#{{$target}} ul.pluginnavigationthreeinonedropdown a {
	color: #{{$config[10]|ngfontcolor}};
	padding: {{$config[9]|ngmargin}};
	text-decoration: none;
	display: block;
	font: {{$config[10]|ngfont}};
	position: relative;
	z-index: 1001;
{{if $config[10]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}	
}

#{{$target}} ul.pluginnavigationthreeinonedropdown li li a {
	color: #{{$config[15]}};
}

#{{$target}} ul.pluginnavigationthreeinonedropdown>li>a {
{{if $config[12]!=''}}
	border-top: 1px solid transparent; 
	border-left: 1px solid transparent; 
	border-right: 1px solid transparent;
{{/if}} 
{{if $config[13]!='0'}}
	border-radius: {{$config[-1][0]}}px {{$config[-1][1]}}px 0 0;
{{/if}}	
}

#{{$target}} ul.pluginnavigationthreeinonedropdown>li>a:only-child {
{{if $config[12]!=''}}
	border-bottom: 1px solid transparent;
{{/if}} 
{{if $config[13]!='0'}}
	border-radius: {{$config[13]|ngmargin}};
{{/if}}
}


#{{$target}} ul.pluginnavigationthreeinonedropdown>li:hover>a {
{{if $config[12]!=''}}
	border-color: #{{$config[12]}};
{{/if}} 
	background-color: #{{$config[11]}};
	color: #{{$config[15]}}; 
}

#{{$target}} ul.pluginnavigationthreeinonedropdown ul li:hover>a {
	background-color: #{{$config[14]}};
}


#{{$target}} ul.pluginnavigationthreeinonedropdown ul {
	list-style: none;
	padding: 0;
	display: block;
	position: absolute;
	width: 240px;
	background-color: #{{$config[11]}};
	border: 1px solid #{{$config[12]}};
	z-index: 1000;
	left: -9999px;
}

{{if $config[12]!=''}} 
#{{$target}} ul.pluginnavigationthreeinonedropdown>li>ul {
	margin: -1px 0 0 0;
}
{{/if}}

#{{$target}} ul.pluginnavigationthreeinonedropdown>li:hover>ul {
	left: 0;
}

#{{$target}} ul.pluginnavigationthreeinonedropdown li li:hover>ul {
	left: 100%;
	top: -1px;
}

{{/if}}

{{if $config[16]=='true'}}

#{{$target}} ul.pluginnavigationthreeinonecommon {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
	position: absolute;
	top: 0;
{{if $config[3]=='Left'}}
	right: 0;
{{else}}
	left: 0;
{{/if}}
}

#{{$target}} ul.pluginnavigationthreeinonecommon>li {
	display: block;
	float: left;
}

#{{$target}} ul.pluginnavigationthreeinonecommon a {
	color: #{{$config[18]|ngfontcolor}};
	padding: {{$config[19]|ngmargin}};
	text-decoration: none;
	display: block;
	font: {{$config[18]|ngfont}};
	position: relative;
{{if $config[18]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}	
	border: 1px solid transparent; 	
{{if $config[30]!='0'}}
	border-radius: {{$config[30]|ngmargin}};
{{/if}}
}

#{{$target}} ul.pluginnavigationthreeinonecommon a:hover {
{{if $config[20]!==''}}
	background-color: #{{$config[20]}};
	border-color: #{{$config[31]}};
{{/if}}
	color: #{{$config[21]}};
}

{{/if}}

{{if $config[22]=='true'}}
#{{$target}} form {
{{if $config[25]!=''}}
	border-color: #{{$config[25]}};
	border-width: {{$config[26]|ngmargin}};
	border-style: solid;
{{/if}}
	margin: {{$config[32]|ngmargin}};
	background: {{$config[24]|ngbackground}};
{{if $config[27]!='0'}}
	border-radius: {{$config[27]|ngmargin}};
{{/if}}
	position: absolute;
{{if $config[3]=='Left'}}
	right: 0;
{{else}}
	left: 0;
{{/if}}
	display: block;
	padding: 4px;
	width: {{$config[29]}}px;
}

#{{$target}} form input {
	color: #{{$config[23]}};
	width: {{$config[29]-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
	font: {{$config[10]|ngfont}};
{{if $config[10]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
}

#{{$target}} button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$config[28]}}.png) no-repeat;
	position: absolute;
	right: 4px;
	top: 50%;
	margin-top: -8px;
	width: 16px;
	height: 16px;
	border: 0;
	cursor: pointer;
}
{{/if}}