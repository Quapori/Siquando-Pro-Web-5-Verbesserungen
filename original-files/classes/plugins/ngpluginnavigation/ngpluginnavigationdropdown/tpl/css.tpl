#{{$target}} ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#{{$target}} a:hover {
	text-decoration: none;
}

#{{$target}} a {
	color: #{{$config[1]|ngfontcolor}};
	padding: {{$config[15]|ngmargin}};
	text-decoration: none;
	display: block;
	font: {{$config[1]|ngfont}};
{{if $config[1]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
 	
}

#{{$target}} li li a {
	color: #{{$config[9]|ngfontcolor}};
	font: {{$config[9]|ngfont}};
{{if $config[9]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
}

#{{$target}} li.active, #{{$target}} li.active>a 
{
{{if $config[5]!==''}} 
	color: #{{$config[5]}};
{{/if}}
{{if $config[4]!==''}} 
	background: {{$config[4]|ngbackground}};
{{/if}}		
}

#{{$target}} li:hover, #{{$target}} li:hover>a 
{
{{if $config[3]!==''}} 
	color: #{{$config[3]}};
{{/if}}
{{if $config[2]!==''}} 
	background: {{$config[2]|ngbackground}};
{{/if}}		
}

#{{$target}} li li:hover, #{{$target}} li li:hover>a 
{
{{if $config[11]!==''}} 
	color: #{{$config[11]}};
{{/if}}
{{if $config[10]!==''}} 
	background: {{$config[10]|ngbackground}};
{{/if}}		
}



#{{$target}}>ul>li {
	float:left;
	margin: 0;
	padding: 0;
	position:relative;
	cursor: pointer;
{{if $config[6]!=''}}
	border-right: 1px solid #{{$config[6]}};
{{/if}}
}

#{{$target}}>ul>li>a {
	line-height: {{($config[1]|ngfontsize)+4}}px;
}

#{{$target}}>ul ul {
	position:absolute;
	list-style:none;
	left:-9999px;
	margin: 0;
	border: 1px solid #{{$config[7]}};
	background: {{$config[8]|ngbackground}};
	padding: 0;
	width: {{$config[-1]->totalWidth()+200}}px;
	z-index: 1000;
}

#{{$target}}>ul>li>ul{
	top: {{$config[-1]->totalHeight()+($config[1]|ngfontsize)+4}}px ;
}

#{{$target}}>ul>li>ul>li>ul{
	top: -1px;
}

#{{$target}}>ul>li>ul>li, #{{$target}}>ul>li>ul>li>ul>li {
	padding: 0;
	margin: 0;
	position: relative;
}

#{{$target}}>ul>li>ul>li>a, #{{$target}}>ul>li>ul>li>ul>li>a {
	width: 200px;
}

#{{$target}}>ul>li:hover>ul
{ 
	left:0; 
}

#{{$target}}>ul>li:hover>ul>li:hover>ul
{ 
	left: {{$config[-1]->totalWidth()+200}}px;
}

{{if $config[16]=='true'}}

#{{$target}} form {
{{if $config[18]!=''}}
	border-color: #{{$config[19]}};
	border-width: {{$config[20]|ngmargin}};
	border-style: solid;
{{/if}}
	background: {{$config[18]|ngbackground}};
{{if $config[19]!='0'}}
	border-radius: {{$config[21]|ngmargin}};
{{/if}}
	position: absolute;
	top: {{$config[23]}}px;
	right: {{$config[24]}}px;
	display: block;
	padding: 4px;
	width: {{$config[25]}}px;
}

#{{$target}} form input {
	color: #{{$config[17]}};
	width: {{$config[25]-40}}px;	
	border: 0;
	background: transparent;
	outline: 0;
	margin: 0;
	padding: 0;
	font: {{$config[1]|ngfont}};
{{if $config[3]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
}

#{{$target}} button {
	background: url(./../../../ngpluginparagraph/ngpluginparagraphsearch/styles/{{$config[22]}}.png) no-repeat;
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

#{{$target}} img {
	display: block;
	position:relative;
	border: none;
}

#{{$target}} li.logo {
	padding: {{$config[27]|ngmargin}};
	cursor: auto;
}

#{{$target}} li.logo:hover, #{{$target}} li.logo:hover>a
{
	background: none;
}

#{{$target}} li.logo a
{
	padding: 0;
}