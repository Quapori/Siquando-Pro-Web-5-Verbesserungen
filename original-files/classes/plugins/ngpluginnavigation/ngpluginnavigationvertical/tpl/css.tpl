#{{$target}} ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
}

#{{$target}} li {
	margin: 0;
	padding: 0;
	position:relative;
	cursor: pointer;
}

#{{$target}} a {
	color: #{{$config[1]}};
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
	border-bottom: 1px solid #{{$config[2]}};
{{/if}}
{{if $config[9]!==''}}
	background: url(./../styles/{{$config[9]}}.png) 4px center no-repeat;
	padding: {{$config[12]|ngmargin:16}};
{{else}}
	padding: {{$config[12]|ngmargin}};
{{/if}}
}

#{{$target}} li:last-child a {
	border-bottom: none;
}

{{if $config[14]!==''}} 
#{{$target}} li.active a 
{
	color: #{{$config[14]}};
}
{{/if}}
{{if $config[13]!==''}} 
#{{$target}} li.active
{
	background: {{$config[13]|ngbackground}};
}
{{/if}}	

#{{$target}} a:hover 
{
{{if $config[3]!==''}} 
	color: #{{$config[3]}} !important;
{{/if}}
	text-decoration: none;
}

{{if $config[11]!==''}} 
#{{$target}} li:hover
{
	background: {{$config[11]|ngbackground}};
}
{{/if}}		