#{{$target}} ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#{{$target}} ul li {
	margin: 0;
	padding: 0;
}

#{{$target}}>ul>li {
	float:left;
	width: 160px;
}

#{{$target}}>ul>li>a {
	color: #{{$config[1]}};
	padding: {{$config[16]|ngmargin}};
	text-decoration: none;
	display: block;
	font-size: {{$config[4]}}px; 
	font-family: {{$config[3]}};
{{if $config[5]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[6]=='true'}}
	font-style: italic;
{{/if}}
{{if $config[7]=='true'}}
	text-transform: uppercase;
{{/if}}
}

#{{$target}}>ul>li.active>a {
	color: #{{$config[28]}};
}

{{if $config[2]!==''}}
#{{$target}}>ul>li>a:hover {
	color: #{{$config[2]}};
}
{{/if}}

#{{$target}}>ul>li>ul>li>a {
	color: #{{$config[8]}};
	padding: {{$config[17]|ngmargin}};
	text-decoration: none;
	display: block;
	font-size: {{$config[11]}}px; 
	font-family: {{$config[10]}};
{{if $config[12]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[13]=='true'}}
	font-style: italic;
{{/if}}
{{if $config[14]=='true'}}
	text-transform: uppercase;
{{/if}}
}

#{{$target}}>ul>li>ul>li.active>a {
	color: #{{$config[29]}};
}


#{{$target}}>ul>li>ul>li>a:hover {
{{if $config[9]!==''}}
	color: #{{$config[9]}};
{{/if}}
}

{{if $config[18]=='true'}}

#{{$target}} form {
{{if $config[22]!=''}}
	border-color: #{{$config[21]}};
	border-width: {{$config[22]|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$config[20]|ngbackground}};
{{if $config[23]!='0'}}
	border-radius: {{$config[23]|ngmargin}};
{{/if}}
	position: absolute;
	top: {{$config[25]}}px;
	right: {{$config[26]}}px;
	display: block;
	padding: 4px;
	width: {{$config[27]}}px;
}

#{{$target}} form input {
	color: #{{$config[19]}};
	width: {{$config[27]-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
	font-size: {{$config[4]}}px; 
	font-family: {{$config[3]}};
{{if $config[5]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[6]=='true'}}
	font-style: italic;
{{/if}}
	
}

#{{$target}} button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$config[24]}}.png) no-repeat;
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