#{{$target}} a, #{{$target}} p {
	color: #{{$config[1]}};
	font-size: {{$config[4]}}px; 
	font-family: {{$config[3]}};
	font-weight: {{if $config[5]=='true'}}bold{{else}}normal{{/if}}; 
	font-style: {{if $config[6]=='true'}}italic{{else}}normal{{/if}};
	text-transform: {{if $config[7]=='true'}}uppercase{{else}}none{{/if}};
}

#{{$target}} p {
	text-align: {{$config[9]}};
	margin: 0;
	padding: 0;
}

#{{$target}} a {
	text-decoration: none;
}

#{{$target}} a:hover 
{
	color: #{{$config[2]}};
	text-decoration: {{if $config[8]=='true'}}underline{{else}}none{{/if}};	

}