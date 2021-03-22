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
}

#{{$target}} em {
	color: #{{$config[1]}};
	text-decoration: none;
	display: block;
	padding: 0 0 4px 0;
	margin: 0;
	font-size: {{$config[3]}}px; 
	font-family: {{$config[2]}};
	font-weight: {{if $config[4]=='true'}}bold{{else}}normal{{/if}}; 
	font-style: {{if $config[5]=='true'}}italic{{else}}normal{{/if}};
	text-transform: {{if $config[6]=='true'}}uppercase{{else}}normal{{/if}};
}

#{{$target}} a {
	color: #{{$config[8]}};
	padding: 0 0 4px 0;
	text-decoration: none;
	display: block;
	font-size: {{$config[10]}}px; 
	font-family: {{$config[9]}};
font-weight: {{if $config[11]=='true'}}bold{{else}}normal{{/if}}; 
font-style: {{if $config[12]=='true'}}italic{{else}}normal{{/if}};
text-transform: {{if $config[13]=='true'}}uppercase{{else}}none{{/if}};
}

#{{$target}}>ul>li>ul>li>a:hover {
{{if $config[14]!==''}}
	color: #{{$config[14]}};
{{/if}}
{{if $config[15]==='true'}}
	text-decoration: underline;
{{/if}}
}