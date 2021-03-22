html {
	background: url(./../../styles/louisville/img/background.jpg);
	margin: 0;
	padding: 0;
	min-width: 1180px;
}

#topnav {
	background-color: #{{$config['palette.topbar']}};
	position: relative;
}

#topnav ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
	float: left;
}

#topnav li {
	display: block;
	float: left;
}

#topnav ul a {
	color: #ffffff;
	padding: 10px 20px;
	display: block;
	text-decoration: none;
	text-transform: uppercase;
}

#topnav ul a:hover {
	background-color: #{{$config['palette.topbarhover']}};
}

#topnav form {
	width: 220px;
	height: 22px;
	display: block;
	position: absolute;
	top: 7px;
	right: 20px;
	background: url(./../../styles/louisville/img/searchform.png) no-repeat;
}

#topnav form input {
	width: 190px;
	display: block;
	position: absolute;
	top: 3px;
	left: 5px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #444444;
	font: 14px "Corbel", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#topnav input:focus{
    outline: 0;
}

#topnav button {
	background: url(./../../styles/louisville/img/searchbutton.png) no-repeat;
	display: block;
	width: 22px;
	height: 22px;
	border: none;
	position: absolute;
	top: 0px;
	right: 3px;
}

#center {
	width: 1140px;
	margin: 40px auto;
}

#nav {
	width: 220px;
	float: left;
}

#nav ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
	width: 220px;
}

#nav li ul {
	display: none;
}

#nav li.active ul {
	display: block;
}


#nav li a {
	display: block;
	background-color: rgba(0,0,0,0.1);
	padding: 10px 20px;
	text-decoration: none;
	color: #333333;
	margin-bottom: 1px;
}

#nav li li a {
	padding: 10px 20px 10px 40px;
}

#nav li a:hover, #nav li.active>a {
	background-color: rgba(0,0,0,0.3);
}

#nav img {
	display: block;
	border: 0;
	margin-bottom: 30px;
}

#sidebarleft {
	margin-bottom: 40px;
	width: 220px;
	min-height: 1px;
}

#content {
	padding: 20px;
	float: left;
}

#header {
	padding: 20px;
	width: 840px;
}

#footer {
	padding: 20px;
	width: 840px;
	background-color: #{{$config['palette.footer']}};
	border-top: 1px solid #dddddd;
}


#sidebarright {
	margin-left: 20px;
	width: 220px;
	padding: 20px;
	float: left;
	min-height: 1px;
}


#main {
	width: 880px;
	background-color: #ffffff;
	box-shadow: 0 0 3px rgba(0,0,0,0.1);
	float: right;
}

#maincaption, #maincaptionfixed {
	background-color: #{{$config['palette.caption']}};
	padding: 20px;
	width: 840px;	
}

#maincaptionfixed {
	position: fixed;
	top: 0;
	z-index: 1000;
}

#eyecatcher {
	display: block;
	border: 0;
	border-bottom: 1px solid #dddddd;
}