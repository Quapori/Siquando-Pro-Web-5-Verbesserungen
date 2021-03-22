.tabs_{{$uid}} .tabcontainer {
	border: 1px solid {{$border}};
	padding: 20px;
	clear: both;
	margin-bottom: 20px;
}

.tabs_{{$uid}} .tab {
	list-style: none;
	padding: 0;
}

.tabs_{{$uid}} .tab li {
	display: inline;
	z-index: 0;
}

.tabs_{{$uid}} .tab li a {
	color: {{$text}};
	float: left;
	display: block;
	padding: {{$paddingvertical}}px {{$paddinghorizontal}}px;
	position: relative;
{{if $tabborder }}
	border-top: 1px solid {{$border}};
	border-left: 1px solid {{$border}};
	border-right: 1px solid {{$border}};
	margin-left: -1px;
	left: 1px;
{{/if}}
	background-color: {{$background}};
	text-decoration: none;

{{if $roundedcorners > 0 }}
	border-top-left-radius: {{$roundedcorners}}px;
	border-top-right-radius: {{$roundedcorners}}px;
{{/if}}
	outline: none;
}

.tabs_{{$uid}} .tab li a.tabselected {
	background-color: {{$backgroundactive}};
	color: {{$textactive}};
	border-top-color: {{$borderactive}};
	border-left-color: {{$borderactive}};
	border-right-color: {{$borderactive}};
	z-index: 1;
}

.tabs_{{$uid}} .tab li a:hover {
	background-color: {{$backgroundhover}};
	color: {{$texthover}};
	border-top-color: {{$borderhover}};
	border-left-color: {{$borderhover}};
	border-right-color: {{$borderhover}};
	z-index: 2;
}

.tabs_{{$uid}} .tabareaclosed {
	display: none;
}

@media screen and (max-width: 1023px) {
	.tabcontainer {
		border-width: 1px 0 1px 0;
	}
	.tabcontainer {
		padding-left: 0 !important;
		padding-right: 0 !important;
	}
	.tabs_{{$uid}} .tabcontainer {
		border-left: 0;
		border-right: 0;
	}
}