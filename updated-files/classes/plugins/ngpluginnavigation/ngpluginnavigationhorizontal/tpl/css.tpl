#{{$target}} ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#{{$target}}>ul>li {
	float:left;
	margin: 0;
	padding: 0;
	position:relative;
	cursor: pointer;
}


#{{$target}} a {
	color: #{{$config[1]}};
	padding: {{$config[11]|ngmargin}};
	text-decoration: none;
	display: block;
	font-size: {{$config[5]}}px; 
	font-family: {{$config[4]}};
{{if $config[6]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[7]=='true'}}
	font-style: italic;
{{/if}}
{{if $config[8]=='true'}}
	text-transform: uppercase;
{{/if}}

{{if $config[2]!==''}}
	border-right: 1px solid #{{$config[2]}};
{{/if}}

}

#{{$target}} li.active a 
{
{{if $config[23]!==''}} 
	color: #{{$config[23]}};
{{/if}}
{{if $config[22]!==''}} 
	background: {{$config[22]|ngbackground}};
{{/if}}		
	text-decoration: none;
}

#{{$target}} a:hover 
{
{{if $config[3]!==''}} 
	color: #{{$config[3]}} !important;
{{/if}}
{{if $config[10]!==''}} 
	background: {{$config[10]|ngbackground}} !important;
{{/if}}		
	text-decoration: none !important;
}

{{if $config[12]=='true'}}

#{{$target}} form {
{{if $config[16]!=''}}
	border-color: #{{$config[15]}};
	border-width: {{$config[16]|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$config[14]|ngbackground}};
{{if $config[17]!='0'}}
	border-radius: {{$config[17]|ngmargin}};
{{/if}}
	position: absolute;
	top: {{$config[19]}}px;
	right: {{$config[20]}}px;
	display: block;
	padding: 4px;
	width: {{$config[21]}}px;
}

#{{$target}} form input {
	color: #{{$config[13]}};
	width: {{$config[21]-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
	font-size: {{$config[5]}}px; 
	font-family: {{$config[4]}};
{{if $config[6]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[7]=='true'}}
	font-style: italic;
{{/if}}
	
}

#{{$target}} button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$config[18]}}.png) no-repeat;
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