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

#{{$target}} li li>a {
	color: #{{$config[9]|ngfontcolor}};
	font: {{$config[9]|ngfont}};
{{if $config[9]|ngfontisuppercase}}
	text-transform: uppercase;
{{else}}
	text-transform: none;
{{/if}}
{{if $config[12]=='true'}}
	padding-top: 0;
	padding-bottom: 0;
	-webkit-transition: padding 0.2s;
	transition: padding 0.2s;
{{/if}}
}

{{if $config[12]=='true'}}
#{{$target}} li:hover>ul>li>a {
	padding: {{$config[15]|ngmargin}};
}
{{/if}}

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

#{{$target}}>ul li {
	margin: 0;
	padding: 0;
	position:relative;
	cursor: pointer;
}

{{if $config[6]!==''}} 
#{{$target}}>ul>li {
	border-top: 1px solid #{{$config[6]}}; 
}
#{{$target}}>ul>li:first-child {
	border-top: 0; 
}
{{/if}}

{{if $config[17]!==''}} 
#{{$target}} ul ul li {
	border-top: 1px solid #{{$config[17]}}; 
}
#{{$target}} ul ul li:first-child {
	border-top: 0; 
}
{{/if}}


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

#{{$target}}>ul>li ul{
	top: -1px;
}

#{{$target}}>ul li:hover>ul
{ 
{{if $config[16]=='true'}}
	left:-{{$config[-1]->totalWidth()+202}}px;
{{else}}
	left:100%; 
{{/if}}
}