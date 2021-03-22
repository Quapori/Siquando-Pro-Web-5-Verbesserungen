body {
	background-color: #{{$config['palette.background']}};
}

#nav {
	list-style: none;
	margin: 0 auto;
	padding: 0;
	height: 80px;
	z-index: 1000;
}

#nav>li {
	display: block;
	width: 160px;
	height: 76px;
	float: left;
	text-align: center;
	border-top: 4px solid #{{$config['palette.background']}};
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
	position: relative;
}

#nav>li>a {
	color: #eeeeee;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 14px;
	line-height: 20px;
	padding: 26px 0 30px 0;
	display: block;
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
}

#nav>li:hover, #nav li.active {
	border-top: 4px solid #{{$config['palette.signal']}};	
}

#nav>li:hover>a, #nav li.active>a {
	color: #{{$config['palette.signal']}};
}

#nav ul {
	position: absolute;
	background: #{{$config['palette.background']}};
	width: 160px;
	margin: 0;
	padding: 0;
	z-index: 1000;
	left: -9999px;
	opacity: 0;
	-webkit-transition: opacity 0.2s;
	transition: opacity 0.2s;
}

#nav li:hover>ul {
	left: 0;
	opacity: 1;
}

#nav ul li:hover>ul {
	left: 100%;
}


#nav ul ul {
	top: 0;
}


#nav ul li {
	display: block;
	position: relative;
	background-color: #{{$config['palette.background']}};
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
}

#nav ul li:hover {
	background-color: #{{$config['palette.signal']}};
}

#nav ul a {
	color: #eeeeee;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 14px;
	line-height: 20px;
	padding: 0 0;
	display: block;
	-webkit-transition: padding 0.2s;
	transition: padding 0.2s;
}

#nav li:hover>ul>li>a {
	padding: 10px 0;
}


#center {
	width: 960px;
	margin: 0 auto;
}

#eyecatcher {
	width: 960px;
	height: 320px;
	position: relative;
}

#eyecatcher img {
	position: absolute;
	left: 0;
	top: 0;
	border: 0;
	width: 960px;
	height: 320px;
}

#mask {
	width: 960px;
	height: 320px;
	background: url(./../../styles/rochester/img/mask.png) no-repeat;
	position: absolute;	
}

#caption {
	width: 960px;
	background: #ffffff;
	text-align: center;
	padding: 10px 0;
	border-radius: 10px 10px 0px 0px;
	border-bottom: 1px solid #ffffff;
}

#breadcrumbs {
	margin: 0;
	padding: 0px 50px;	
	background: #ffffff;
	text-align: center;
	color: #{{$config['palette.signal']}};
	font-size: 90%;
}

#breadcrumbs a {
	color: #444444;
	text-decoration: none;
}

#breadcrumbs a:hover {
	color: #000000;
}

#search {
	margin: 0;
	padding: 40px 0 10px 0;	
	background: #ffffff;
}

#search form {
	background: #{{$config['palette.search']}};
	position: relative;
	height: 48px;
	padding: 0 50px;
}

#search form input {
	width: 800px;
	display: block;
	position: absolute;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	top: 8px;
	left: 50px;
	color: #888888;
	font: 28px "Corbel", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#search button {
	background: url(./../../styles/rochester/img/searchbutton.png) no-repeat;
	display: block;
	width: 32px;
	height: 32px;
	border: none;
	position: absolute;
	top: 8px;
	right: 50px;
	cursor: pointer;
}

#search input:focus{
    outline: 0;
}


#header {
	margin: 0;
	padding: 20px 50px;	
	background: #ffffff;
}

#main {
	background: #ffffff;
	padding: 20px 50px;
}

#sidebarleft {
	float: left;
	margin-right: 50px;
	min-height: 1px;
}

#sidebarright {
	float: left;
	margin-left: 50px;
	min-height: 1px;
}

#content {
	float: left;	
}

#bottom {
	width: 960px;
	background: #ffffff;
	border-width: 0;
	border-radius: 0 0 10px 10px;
	height: 10px;
	border-top: 1px solid #ffffff;
}


#footer {
	margin: 0;
	padding: 20px 50px;	
	background: #ffffff;
}

#common {
	padding: 20px;
	color: #eeeeee;
	text-align: center;
}

#common a {
	color: #eeeeee;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 90%;
}