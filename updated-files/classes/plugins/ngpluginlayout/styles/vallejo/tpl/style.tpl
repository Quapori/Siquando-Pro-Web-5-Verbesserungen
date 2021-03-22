html, body {
	background: #{{$config['palette.background']}} url(./../../styles/vallejo/img/noise.png);
}

#center {
	width: 960px;
	margin: 20px auto;
}

#nav {
	width: 160px;
	background-color: #{{$config['palette.navigation']}};
	float: left;
	border-radius: 5px 0 0 5px;
}

#logo {
	border-bottom: 1px solid #{{$config['palette.background']}};
}

#logo img {
	display: block;
	border: 0;
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
	display: block;
	border-top: 1px solid #{{$config['palette.background']}};
}

#nav ul li:first-child {
	border-top: 0;
}

#nav ul a {
	color: #eeeeee;
	text-decoration: none;
	padding: 10px 10px;
	display: block;
	z-index: 1000; 
	text-transform: uppercase;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#nav li.active>a, #nav li:hover>a
{
	color: #{{$config['palette.alt']}};
}

#nav>ul li>ul>li>a {
	-webkit-transition: padding 0.2s;
	transition: padding 0.2s;
	padding: 0 10px;
}

#nav>ul li:hover>ul>li>a {
	padding: 10px 10px;
}

#nav>ul>li ul 
{
	display: block;
	position: absolute;
	left: -9999px;
	top: 0;
	width: 160px;
	background-color: #{{$config['palette.navigation']}};
	box-shadow: 2px 2px 7px rgba(0,0,0,0.3);
	opacity: 0;
	-webkit-transition: opacity 0.3s;
	transition: opacity 0.3s;
}

#nav>ul li:hover>ul 
{
	opacity: 1;
	left: 160px;
}


#maincolumn {
	width: 800px;
	background: #{{$config['palette.main']}} url(./../../styles/vallejo/img/noise.png);
	float: left;
	border-radius: 0 5px 5px 5px;
}

#breadcrumbs {
	background-color: #ffffff;
	color: #{{$config['palette.background']}};
	padding: 14px 10px;
	border-bottom: 1px solid #e5e5e5;
	border-radius: 0 5px 0 0;
	margin-bottom: 9px;
	position: relative;
}

#breadcrumbs a {
	color: #{{$config['palette.alt']}};
	text-decoration: none;
}

#breadcrumbs a:hover {
	text-decoration: underline;
}


#breadcrumbs form {
	width: 200px;
	height: 26px;
	background: #{{$config['palette.alt']}} url(./../../styles/vallejo/img/searchform.png) no-repeat;
	position: absolute;
	right: 10px;
	top: 10px;
}

#breadcrumbs form input {
	border: 0;
	width: 165px;
	padding: 0;
	margin: 0;
	top: 4px;
	left: 5px;
	background-color: transparent;
	font: 15px / 18px Calibri,Candara,'Segoe','Segoe UI',Optima,Arial,sans-serif;
	color: #{{$config['palette.background']}};
	position: absolute;
}

#breadcrumbs button {
	background: url(./../../styles/vallejo/img/searchbutton.png) no-repeat top left;
	display: block;
	width: 26px;
	height: 26px;
	border: none;
	position: absolute;
	top: 0;
	right: 0;
	cursor: pointer;
}

#breadcrumbs input:focus{
    outline: 0;
}

#breadcrumbs input::-webkit-input-placeholder 
{
	color:#aaaaaa;
}

#breadcrumbs input:-moz-placeholder {
    color:#aaaaaa;
}

#breadcrumbs input:-ms-input-placeholder {
    color:#aaaaaa;
}


#eyecatcher {
	width: 780px;
	border: 1px solid #e5e5e5;
	border-radius: 3px;
	overflow: hidden;
}

#eyecatcher img {
	display: block;
	border: 0;
}

#header, #sidebarleft, #sidebarright, #content, #footer
{
	padding: 10px 20px;
	background-color: #ffffff;
	border: 1px solid #e5e5e5;
	border-radius: 3px;
}

#headercontainer, #footercontainer, #eyecatchercontainer {
	margin: 0 9px 0 9px;
}

#maincontainer {
	margin: 0 9px;
}

#sidebarleftcontainer {
	float: left;
	margin: 0 9px 0 0;
	min-height: 1px;
	width: 202px;
}

#contentcontainer {
	float: left;
}

#sidebarrightcontainer {
	float: left;
	margin: 0 0 0 9px;
	min-height: 1px;
	width: 202px;
}

.shadow782 {
	width: 782px;
	height: 16px;
	background: url(./../../styles/vallejo/img/shadow782.png) no-repeat;
}

.shadow202 {
	width: 202px;
	height: 16px;
	background: url(./../../styles/vallejo/img/shadow202.png) no-repeat;
}

.shadow360 {
	width: 360px;
	height: 16px;
	background: url(./../../styles/vallejo/img/shadow360.png)  no-repeat;
}

.shadow571 {
	width: 571px;
	height: 16px;
	background: url(./../../styles/vallejo/img/shadow571.png) no-repeat;
}


#common {
	background-color: #ffffff;
	padding: 14px 10px;
	border-top: 1px solid #e5e5e5;
	border-radius: 0 0 5px 5px;
	text-align: right;
	color: #{{$config['palette.background']}}; 
	text-transform: uppercase;
}

#common a {
	color: #{{$config['palette.background']}};
	text-decoration: none;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#common a:hover {
	color: #{{$config['palette.alt']}};
}