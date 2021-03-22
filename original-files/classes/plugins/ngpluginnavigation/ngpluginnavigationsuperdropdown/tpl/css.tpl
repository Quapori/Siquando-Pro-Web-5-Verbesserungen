#{{$target}} ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#{{$target}} li>a:hover {
	text-decoration: none;
}

#{{$target}} li>a, .ngsuperdropdownsummary {
	color: #{{$config[1]}};
	padding: {{$config[13]|ngmargin}};
	text-decoration: none;
	display: block;
	font-size: {{$config[8]}}px; 
	font-family: {{$config[7]}};
{{if $config[9]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[10]=='true'}}
	font-style: italic;
{{/if}}
{{if $config[11]=='true'}}
	text-transform: uppercase;
{{/if}}
}

#{{$target}} h3 {
	margin: 0 0 5px 0; 
}

#{{$target}} li.active>a 
{
{{if $config[33]!==''}} 
	color: #{{$config[33]}};
{{/if}}
{{if $config[32]!==''}} 
	background: {{$config[32]|ngbackground}};
{{/if}}		
}


#{{$target}} li:hover>a 
{
{{if $config[4]!==''}} 
	color: #{{$config[4]}};
{{/if}}
{{if $config[3]!==''}} 
	background: {{$config[3]|ngbackground}};
{{/if}}		
}


#{{$target}}>ul>li {
	float:left;
	margin: 0;
	padding: 0;
	position:relative;
	display: block;
	line-height: {{$config[8]+4}}px;
}

#{{$target}}>ul>li>div {
	position:absolute;
	list-style:none;
	left: -9999px;
	margin: 0;
	border: 1px solid #{{$config[2]}};
	padding: 0;
	width: 600px;
	background: {{$config[14]|ngbackground}};
	z-index: 1000;
	box-shadow: 2px 2px 2px rgba(0,0,0,0.1);
}

.ngsuperdropdownimage {
	display: block;
	float: left;
}

.ngsuperdropdownnoimage {
	width: 200px;
	height: 200px;
	background: url(./noimage.png) no-repeat;
}

.ngsuperdropdownimage img 
{
	display: block;
	border: 0;
}

#{{$target}}>ul>li>div>ul{
	display: block;
	float: left;
	width: 200px;	
}

.ngsuperdropdownsummary {
	float: left;
	width: {{200-$config[-1]->totalWidth()}}px;
	text-transform: none;
}

.ngsuperdropdropheadline {
	color: #{{$config[21]}};
	font-size: {{$config[16]}}px; 
	font-family: {{$config[15]}};
{{if $config[17]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[18]=='true'}}
	font-style: italic;
{{/if}}
{{if $config[19]=='true'}}
	text-transform: uppercase;
{{/if}}
margin: 0 0 6px 0;
}

#

#{{$target}}>ul>li>ul>li {
	padding: 0;
	margin: 0;
	position: relative;
}

#{{$target}}>ul>li:hover>div
{ 
	left:0px; 
}

#{{$target}}>ul>li.ar:hover>div
{ 
	left:-400px; 
}

{{if $config[22]=='true'}}

#{{$target}} form {
{{if $config[26]!=''}}
	border-color: #{{$config[25]}};
	border-width: {{$config[26]|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$config[24]|ngbackground}};
{{if $config[27]!='0'}}
	border-radius: {{$config[27]|ngmargin}};
{{/if}}
	position: absolute;
	top: {{$config[29]}}px;
	right: {{$config[30]}}px;
	display: block;
	padding: 4px;
	width: {{$config[31]}}px;
}

#{{$target}} form input {
	color: #{{$config[23]}};
	width: {{$config[31]-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
	font-size: {{$config[8]}}px; 
	font-family: {{$config[7]}};
{{if $config[9]=='true'}}
	font-weight: bold;
{{/if}} 
{{if $config[10]=='true'}}
	font-style: italic;
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