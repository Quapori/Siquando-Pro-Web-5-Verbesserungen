body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

#navcontainer {
	background-color: #{{$config['palette.navbackground']}};
}

#nav {
	width: 900px;
	height: 84px;
	margin: 0 auto;
	position: relative;
}

#nav img {
	float: left;
	margin-right: 20px;
	border: 0;
}

#nava, #navb {
	list-style: none;
	height: 42px;
	margin: 0;
}

#nava li, #navb li {
	display: block;
	float: left;
}

#nava li a, #navb li a {
	text-decoration: none;
	display: block;
	font-size:  14px;
	line-height: 18px;
	text-transform: uppercase;
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
}

#nava li a {
	color: #ffffff;
	padding: 12px 20px;
}

#nava li a:hover, #nava li.active a {
	background-color: #{{$config['palette.nav']}};
}

#navb li a {
	color: #{{$config['palette.nav']}};
	padding: 12px 20px 12px 0;
}

#navb li a:hover, #navb li.active a {
	color: #ffffff;
}

#nav form {
	width: 160px;
	height: 25px;
	display: block;
	position: absolute;
	top: 9px;
	right: 0px;
	background-color: #222222;
}

#nav form input {
	width: 130px;
	display: block;
	position: absolute;
	top: 5px;
	left: 6px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #e0e0e0;
	font: 14px "Calibri", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#nav button {
	background: url(./../../styles/quantico/img/searchbutton.png) no-repeat;
	display: block;
	width: 19px;
	height: 19px;
	border: none;
	position: absolute;
	top: 3px;
	right: 4px;
}

#nav input:focus{
    outline: 0;
}



#center {
	width: 900px;
	padding: 0 40px;
	background: #{{$config['palette.background']}} url(./../../styles/quantico/img/shadow.png) repeat-y;
	margin: 0 auto;
}

#eyecatcher {
	position: relative;
	overflow: hidden;
}

#eyecatcher img {
	position: absolute;
	display: block;
	border: 0;
	left: 0;
{{if $config['options.animate']==='true'}}
	opacity: 0;
	-webkit-transform: scale(1.2,1.2);
	-webkit-transition: all 0.8s;
	transform: scale(1.2,1.2);
	transition: all 0.8s;
{{/if}}
}

{{if $config['options.animate']==='true'}}
#eyecatcher.loaded img {
	-webkit-transform: scale(1,1);
	transform: scale(1,1);
	opacity: 1;
}
{{/if}}


#bottom {
	width: 900px;
	height: 60px;
	padding: 0 40px;
	background: #{{$config['palette.background']}} url(./../../styles/quantico/img/bottom.png) no-repeat;
	margin: 0 auto;
}

#caption {
	background-color: black;
	margin: 0;
	padding: 10px 40px;
}

#breadcrumbs {
	margin: 0;
	padding: 0;
	color: #dddddd;
	font-size: 90%;
}

#breadcrumbs a {
	text-decoration: none;
	color: #{{$config['palette.nav']}}; 
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
}

#breadcrumbs a:hover {
	color: #dddddd; 
}

#header {
	margin: 0;
	padding: 10px 40px;	
	background: #{{$config['palette.header']}};
}

#main {
	background: #{{$config['palette.main']}};
	padding: 10px 40px;
}

#sidebarleft {
	float: left;
	margin-right: 40px;
	min-height: 1px;
}

#sidebarright {
	float: left;
	margin-left: 40px;
	min-height: 1px;
}

#content {
	float: left;	
}

#footer {
	margin: 0;
	padding: 10px 40px;	
	background: #{{$config['palette.footer']}};
}

#common {
	padding: 20px 20px 0 20px;
	color: #e0e0e0;
	text-align: center;
	font-size: 14px;
	text-transform: uppercase;
}

#common a {
	color: #e0e0e0;
	text-decoration: none;
}

#common a:hover {
	color: #ffffff;
}