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

#{{$target}} li li {
	margin-left: 16px;
}


#{{$target}} a {
	color: #{{$config[1]}};
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
{{if $config[8]!==''}}
	background: url(./../styles/{{$config[8]}}.png) 4px center no-repeat;
	padding: {{$config[10]|ngmargin:16}};
{{else}}
	padding: {{$config[10]|ngmargin}};
{{/if}}
}

#{{$target}} li:last-child a {
	border-bottom: none;
}

#{{$target}} a:hover 
{
{{if $config[3]!==''}} 
	color: #{{$config[2]}};
{{/if}}
	text-decoration: none;
}

#{{$target}} li.active>a 
{
{{if $config[11]!==''}} 
	color: #{{$config[11]}};
{{/if}}
}