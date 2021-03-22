body, html {
	background: #{{$config['palette.background']}} url(./../../styles/miami/img/background.png) no-repeat center top;
}

#mainwrap {
	margin: 0 auto;
	width: 1280px;
	position: relative;
}

#common {
	margin: 0;
	padding: 30px 70px 30px;
	text-align: right;
	color: #aaaaaa;
}

#common a {
	color: #444444;
	text-decoration: none;
	text-transform: uppercase;
}

#common a:hover {
	color: #aaaaaa;
}

#eyecatcher {
	position: relative;
}

#eyecatcher img {
	border-radius: 4px;
	box-shadow: 0 2px 10px rgba(0,0,0,0.4);
	border: 0;
}

#eyecatcher form {
	width: 210px;
	height: 36px;
	display: block;
	position: absolute;
	top: 20px;
	right: 20px;
	background: url(./../../styles/miami/img/searchform.png) no-repeat;
}

#eyecatcher form input {
	width: 176px;
	display: block;
	position: absolute;
	top: 8px;
	left: 10px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #444444;
	font: 14px "Corbel", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#eyecatcher button {
	background: url(./../../styles/miami/img/searchbutton.png) no-repeat;
	display: block;
	width: 32px;
	height: 32px;
	border: none;
	position: absolute;
	top: 0px;
	right: 0px;
}

input:focus{
    outline: 0;
}

input::-webkit-input-placeholder 
{
	color:#666666;
}
input:-moz-placeholder {
    color:#666666;
}

input:-ms-placeholder {
    color:#666666;
}


#navbar {
	position: absolute;
	width: 260px;
	left: 50px;
	top: 0;
	z-index: 1000;
}

#navbar img {
	border: 0;
}


#nav {
	width: 210px;
	min-height: 800px;
	padding: 0 25px;
	background: url(./../../styles/miami/img/navfill.png) repeat-y; 
}


#navbottom {
	height: 40px;
	width: 260px;
	background: url(./../../styles/miami/img/navbottom.png);
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
	background: url(./../../styles/miami/img/edge.png) repeat-x left top;
	padding-top: 2px;
}

#nav ul li:first-child {
	background: none;
	padding-top: 0;
}

#nav ul a {
	position: relative;
	color: #{{$config['palette.color']}};
	text-transform: uppercase;
	text-decoration: none;
	padding: 10px 20px;
	display: block;
	z-index: 1000; 
}

#nav>ul>li 
{
	display: block;
	position: relative;
}

#nav li.active>a, #nav li:hover>a
{
	background-color: rgba({{$config['palette.color']|ngrgb}},0.1);
}

#nav>ul>li ul 
{
	display: block;
	position: absolute;
	left: -9999px;
	top: -1px;
	width: 210px;
	background: url(./../../styles/miami/img/navcolor.png);
	border: 1px solid #B4B7B8;
	box-shadow: 1px 1px 5px rgba(0,0,0,0.3);
}

#nav>ul li:hover>ul 
{
	left: 210px;
}


#main {
	margin: 20px 0 20px 320px;
	width: 890px;
}

#header {
	margin-bottom: 40px;
	width: 890px;
}

#footer {
	margin-top: 40px;
	width: 890px;
	border-top: 1px solid rgba({{$config['palette.color']|ngrgb}},0.2);
}

#content, #sidebarleft, #sidebarright 
{
	float: left;
	min-height: 1px;
}

#sidebarleft
{
	margin-right: 40px;
}

#sidebarright
{
	margin-left: 40px;
}