html, body {
	background-color: #ffffff;
}

#center {
	width: 1280px;
	margin: 20px auto;
}

#logo
{
	height: 44px;
	margin: 30px 0;
	position: relative;
}

#logo img {
	border: 0;
}

#logo ul 
{
	display: block;
	position: absolute;
	left: 400px;
	top: 0;
	width: 500px;
	margin: 0;
	padding: 0;
	list-style: none;
}

#logo li {
	display: block;
	float: left;
	margin: 0;
	padding: 0;
}

#logo li a {
	font: 14px/18px Signika,Tahoma,Helvetica,sans-serif;
	color: #666666;
	text-decoration: none;
	display: block;
	padding: 13px;
	background-color: #ffffff;
	letter-spacing:1px;
	-webkit-transition: background-color 0.4s;
	transition: background-color 0.4s;
}

#logo li a:hover {
	background-color: #{{$config['palette.a']}};
	color: #ffffff;
}


#logo form {
	background: url(./../../styles/xenia/img/searchform.png);
	width: 300px;
	height: 44px;
	position: absolute;
	right: 0;
	top: 0px;	
}

#logo button {
	background: #{{$config['palette.a']}} url(./../../styles/xenia/img/searchbutton.png) no-repeat center center;
	display: block;
	width: 44px;
	height: 44px;
	border: none;
	position: absolute;
	top: 0;
	right: 0;
	cursor: pointer;
}

#logo form input {
	border: 0;
	width: 230px;
	padding: 0;
	margin: 0;
	top: 13px;
	left: 10px;
	background-color: transparent;
	font: 15px / 18px Calibri,Candara,'Segoe','Segoe UI',Optima,Arial,sans-serif;
	position: absolute;
	color: #666666;
}

#logo input:focus{
    outline: 0;
}

#logo input::-webkit-input-placeholder 
{
	color:#999999;
}

#logo input:-moz-placeholder {
    color:#999999;
}

#logo input:-ms-input-placeholder {
    color:#999999;
}


#navigation {
	background-color: #7a7a7a;	
}

#navigation ul {
	list-style: none;
	margin: 0;
	padding: 0;
	display: block;
}

#navigation li {
	display: block;
	float: left;
	margin: 0;
	padding: 0;
}

#navigation li a {
	padding: 13px 20px;
	display: block;
	color: #ffffff;
	text-decoration: none;
	background-color: #7a7a7a;	
	font: 16px/24px Signika,Tahoma,Helvetica,sans-serif;
	letter-spacing:1px;
	-webkit-transition: background-color 0.4s;
	transition: background-color 0.4s;	
}

#navigation li a:hover {
	background-color: #555555;	
}

#navigation li.active a {
	background-color: #{{$config['palette.b']}};
}

#home span {
	display: none;
}

#home {
	width: 24px;
	height: 24px;
	background: url(./../../styles/xenia/img/home.png) no-repeat center center;
}

#maincontainer {
	margin: 30px 0;
}

#subnav {
	width: 300px;
	float: right;
}

#subnav ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

#subnav li {
	display: block;	
}

#subnav a.subnavheader {
	margin-bottom: 20px;
	min-height: 18px;
	display: block;
	font: 16px/20px Signika,Tahoma,Helvetica,sans-serif;
	padding: 10px 20px;
	color: #ffffff;
	text-decoration: none;	
	background-color: #{{$config['palette.a']}};
	letter-spacing:1px;
}

#subnav a.subnavindex {
	padding: 10px;
	display: block;
	background-color: #{{$config['palette.b']}};
	font: bold 16px/20px Signika,Tahoma,Helvetica,sans-serif;
	color: #ffffff;
	text-decoration: none;
	width: 18px;
	height: 18px;
	float: left;
	text-align: center;
	display: block;
}



#subnav a.subnavcaption {
	margin-bottom: 10px;
	min-height: 18px;
	margin-left: 46px;
	display: block;
	font: 16px/20px Signika,Tahoma,Helvetica,sans-serif;
	padding: 10px;
	color: #666666;
	text-decoration: none;
	background-color: #ffffff;
	-webkit-transition: background-color 0.4s;
	transition: background-color 0.4s;
	letter-spacing:1px;
}

#subnav li:hover a.subnavcaption {
	background-color: #{{$config['palette.a']}};
	color: #ffffff;
}

#main {
	width: 930px;
	float: left;
}

#header {
	margin-bottom: 30px;
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
	margin-top: 30px;
}


#breadcrumbs {
	margin-bottom: 30px;
}

#breadcrumbs a {
	color: #{{$config['palette.a']}};
	text-decoration: none;
	padding: 0 4px;	
}

#breadcrumbs a:hover {
	color: #ffffff;
	background-color: #{{$config['palette.a']}};
	text-decoration: none;	
}

#eyecatcher {
	margin-bottom: 30px;
	width: 930px;
	height: 310px;
	position: relative;
}

#eyecatcher img {
	display: block;
	border: 0;
	position: absolute;
	top: 0;
	left: 0;
}

#eyecatcher h1
{
	width: 900px;
	position: absolute;
	left: 0;
	bottom: 40px;
	color: #ffffff;
}

#eyecatcher h1 span {
	padding: 0 10px;
	background-color: rgba(0,0,0,0.5);
}
