html, body {
	background: #{{$config['palette.background']}} url(./../../styles/underwood/img/noise.png);
}

#center {
	width: 960px;
	margin: 20px auto;
	background: #{{$config['palette.navbackground']}} url(./../../styles/underwood/img/content.png);
	border-radius: 4px;
}

#leftcolumn {
	width: 720px;
	float: left;
}

#rightcolumn {
	width: 240px;
	float: left;
}

#rightcolumn img {
	border: 0;
}

#common {
	margin: 20px 20px 0 20px;
	color: #{{$config['palette.bright']}};
	font-size: 90%;
}

#common a {
	color: #{{$config['palette.navfill']}};
	text-decoration: none;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#common a:hover {
	color: #{{$config['palette.bright']}};
}

#caption {
	margin: 20px 0px 0px -20px;
	background-color: #{{$config['palette.bright']}};
	padding-left: 40px;
}

#edge {
	margin: 0 0 10px -20px;
	width: 20px;
	height: 10px;
	background: url(./../../styles/underwood/img/edge/?c={{$config['palette.dark']}});
}

#breadcrumbs {
	margin: 0 20px 20px 20px;
	color: #{{$config['palette.bright']}};
	font-size: 90%;
}

#breadcrumbs a {
	color: #{{$config['palette.navfill']}};
	text-decoration: none;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#breadcrumbs a:hover {
	color: #{{$config['palette.bright']}};
}

#eyecatcher img {
	display: block;
	border: 0;
	-webkit-transition: opacity 0.5s;
	transition: opacity 0.5s;
}

#eyecatcher a:hover img {
	opacity: 0.8;
}

#header {
	padding: 20px 20px 0 20px;
}

#main {
	padding: 20px;
}

#sidebarleft {
	float: left;
	margin-right: 40px;
	min-height: 1px;
}

#content {
	float: left;
}

#sidebarright {
	float: left;
	margin-left: 40px;
	min-height: 1px;
}

#footer {
	padding: 0 20px 20px 20px;
}


#rightcolumn form {
	width: 200px;
	height: 24px;
	border: 1px #{{$config['palette.navborder']}} solid;
	background-color: #{{$config['palette.navfill']}};
	margin: 20px;
	position: relative;
}

#rightcolumn form input {
	border: 0;
	width: 170px;
	padding: 0;
	margin: 0;
	top: 3px;
	left: 3px;
	background-color: transparent;
	font: 15px "Calibri", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
	color: #{{$config['palette.navtext']}};
	position: absolute;
}

#rightcolumn button {
	background: url(./../../styles/underwood/img/searchbutton.png) no-repeat top left;
	display: block;
	width: 20px;
	height: 20px;
	border: none;
	position: absolute;
	top: 2px;
	right: 2px;
	cursor: pointer;
}

#rightcolumn input:focus{
    outline: 0;
}

#rightcolumn input::-webkit-input-placeholder 
{
	color:#{{$config['palette.navtext']}};
}

#rightcolumn input:-moz-placeholder {
    color:#{{$config['palette.navtext']}};
}

#rightcolumn input:-ms-input-placeholder {
    color:#{{$config['palette.navtext']}};
}

#rightcolumn ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

#rightcolumn>ul {
	margin: 40px 0;
}

#rightcolumn>ul li {
	display: block;
	border-bottom: 1px solid #{{$config['palette.navfill']}};
	position: relative;
}

#rightcolumn>ul li.active {
	background-color: #{{$config['palette.navfill']}};
}


#rightcolumn>ul li>a {
	padding: 20px;
	color: #{{$config['palette.navtext']}};
	text-decoration: none;
	text-transform: uppercase;
	display: block;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#rightcolumn>ul li>ul>li>a {
	padding: 20px;
}


#rightcolumn>ul li:hover>a {
	color: #{{$config['palette.bright']}};
}

#rightcolumn>ul ul {
	display: block;
	position: absolute;
	top: 0;
	left: -9999px;
	width: 240px;
	background-color: #{{$config['palette.navbackground']}};
	opacity: 0;
	z-index: 1000;

{{if $config['options.animate']==='true'}}
	transition: opacity 0.3s, transform 0.3s;
	transform-origin: 100% 50%;
	transform: perspective(500px) rotateY(-30deg);
	
	-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
	-webkit-transform-origin: 100% 50%;
	-webkit-transform: perspective(500px) rotateY(-30deg);
{{else}}
	transition: opacity 0.3s;
	-webkit-transition: opacity 0.3s;
{{/if}}
}

#rightcolumn>ul li:hover>ul {
	left: -240px;
	opacity: 1;
{{if $config['options.animate']==='true'}}
	transform: perspective(500px) rotateY(0deg);
	-webkit-transform: perspective(500px) rotateY(0deg);
{{/if}}
}