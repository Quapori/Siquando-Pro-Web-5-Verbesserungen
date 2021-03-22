html {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}


#topnav {
	height: 58px;
	width: 100%;
	background-color: #{{$config['palette.topbar']}};
	z-index: 1001;
	border-bottom: 1px solid #000000;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
	position: fixed;
}

#topnav img {
	display: block;
	float: left;
	border: 0;
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
	padding: 20px 10px;
	display: block;
	text-decoration: none;
	text-transform: uppercase;
	line-height: 18px;
}

#topnav form {
	width: 240px;
	height: 30px;
	display: block;
	position: absolute;
	top: 14px;
	right: 10px;
	background: url(./../../styles/knoxville/img/searchform.png) no-repeat;
}

#topnav form input {
	width: 176px;
	display: block;
	position: absolute;
	top: 7px;
	left: 10px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #ffffff;
	font: 14px "Corbel", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

input:focus{
    outline: 0;
}

input::-webkit-input-placeholder 
{
	color:#ffffff;
}
input:-moz-placeholder {
    color:#ffffff;
}

input:-ms-placeholder {
    color:#ffffff;
}


#topnav button {
	background: url(./../../styles/knoxville/img/searchbutton.png) no-repeat;
	display: block;
	width: 30px;
	height: 30px;
	border: none;
	position: absolute;
	top: 0px;
	right: 0px;
}


#nav {
	width: 220px;
	height: 100%;
	background: white;
	position: fixed;
	box-shadow: 1px 0 3px rgba(0,0,0,0.2);
	top:0;
	z-index: 1000;
}

#nav img {
	display: block;
	padding: 10px;
	border: 0;
	border-bottom: 1px solid #d9d9d9;
}


#header, #footer, #sidebarleft, #sidebarright, #content, #eyecatcher {
	background: #ffffff;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
	border-radius: 3px;
	padding: 20px;
}

#eyecatcher img {
	border: 0;
}

#header, #eyecatcher {
	width: 920px;
	margin-bottom: 20px;
}

#footer {
	width: 920px;
	margin-top: 20px;
}


#sidebarleft {
	width: 220px;
	margin-right: 20px;
	min-height: 1px;
}

#sidebarright {
	width: 220px;
	margin-left: 20px;
	min-height: 1px;
}


#sidebarleft, #sidebarright, #content {
	float: left;
}

#maincontainer {
	margin-left: 220px;
	border: 1px solid transparent;
}

#maincenter {
	width: 960px;
	margin: 0 auto;
	padding: 20px 0;
}

#nav ul {
	list-style:none;
	margin: 0;
	padding: 0;
	display: block;
	z-index: 1000;
}

#nav ul li {
	position: relative;
}

#nav ul a {
	position: relative;
	color: #{{$config['palette.leftbartext']}};
	text-transform: uppercase;
	text-decoration: none;
	padding: 20px 10px;
	display: block;
	z-index: 1000; 
}

#nav>ul>li 
{
	display: block;
	border-bottom: 1px solid #d9d9d9;
	position: relative;
}

#nav li.active>a
{
	background-color: #{{$config['palette.leftbaractive']}};
}

#nav>ul>li ul 
{
	display: block;
	position: absolute;
	left: -9999px;
	top: 0;
	width: 220px;
	background: #ffffff;
	border-top: 1px solid #d9d9d9;
	border-left: 1px solid #d9d9d9;
	border-right: 1px solid #d9d9d9;
	box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}

#nav>ul li:hover>ul 
{
	left: 220px;
}

#nav>ul ul li a
{
	display: block;
	padding: 10px 10px;
	text-decoration: none;
	color: #333333;
	border-bottom: 1px solid #d9d9d9;
}