html {
	background-color: #ffffff;
	overflow-y: scroll;
}

#audioopen, #audioclose {
	display: none;
}

#nav {
	background-color: #{{$config['palette.medium']}};
}

#navpri {
	width: 960px;
	margin: 0 auto;
	position: relative;
}

#navpri img {
	display: block;
	border: 0;
	float: left;
}

#navpri>ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: block;
	float: left;
}

#navpri>ul>li {
	display: block;
	float: left;
}

#navpri>ul>li>a {
	padding: 20px;
	text-decoration: none;
	color: #666666;
	text-transform: uppercase;
	display: block;
	background-position: center bottom;
	background-repeat: no-repeat;
	background-color: #{{$config['palette.medium']}};
	line-height: 18px;
	-webkit-transition: background-color 0.2s;
	transition: background-color 0.2s;
}

#navpri>ul>li>a:hover, #navpri>ul>li>a.active {
	background-color: #{{$config['palette.bright']}};
}

#navpri>ul>li>a.navmore:hover {
	background-image: url(./../../styles/wichita/img/more.png);
}

#navpri>ul>li>a.navopen {
	background-image: url(./../../styles/wichita/img/open.png) !important;
}

#navpri form {
	background-color: #ffffff;
	border-radius: 4px;
	width: 200px;
	height: 26px;
	position: absolute;
	right: 0;
	top: 16px;	
}

#navpri button {
	background: #{{$config['palette.dark']}} url(./../../styles/wichita/img/searchbutton.png) no-repeat center center;
	display: block;
	width: 26px;
	height: 26px;
	border: none;
	position: absolute;
	top: 0;
	right: 0;
	cursor: pointer;
	border-radius: 0 4px 4px 0;
}

#navpri form input {
	border: 0;
	width: 160px;
	padding: 0;
	margin: 0;
	top: 4px;
	left: 7px;
	background-color: transparent;
	font: 15px / 18px Calibri,Candara,'Segoe','Segoe UI',Optima,Arial,sans-serif;
	position: absolute;
	color: #666666;
}

#navpri input:focus{
    outline: 0;
}

#navpri input::-webkit-input-placeholder 
{
	color:#bbbbbb;
}

#navpri input:-moz-placeholder {
    color:#bbbbbb;
}

#navpri input:-ms-input-placeholder {
    color:#bbbbbb;
}


#navsec>ul {
	width: 960px;
	margin: 0 auto;
	padding: 0;
	height: 0;
	display: block;
	list-style: none;
	height: 200px;
	display: none;
}

#navsec>ul.navopen {
	display: block;
}

#navsec {
	background: url(./../../styles/wichita/img/shadow.png) repeat-x top left;
	height: 0;
	overflow: hidden;
	-webkit-transition: height 0.5s;
	transition: height 0.5s;
}

#navsec.navopen {
	height: 200px;
}

#navsec>ul li {
	display: block;
	margin: 0;
	padding: 0;
}

#navsec>ul>li {
	float: left;
	width: 192px;
}

#navsec>ul>li>a
{
	padding: 10px 10px 10px 0;
	color: #{{$config['palette.dark']}};
	text-decoration: none;
	display: block;
	font-size: 120%;
	text-transform: uppercase;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#navsec>ul ul {
	margin: 0;
	padding: 0;
}

#navsec>ul>li li>a
{
	padding: 5px 10px;
	color: #888888;
	text-decoration: none;
	display: block;
	background: url(./../../styles/wichita/img/bullet.png) no-repeat left center;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#navsec a:hover {
	color: #000000;
}

#eyecatcher {
	background-color: #{{$config['palette.bright']}};
	border-bottom: 1px solid #{{$config['palette.medium']}};
	border-top: 1px solid #{{$config['palette.medium']}};
}


#eyecatcher img {
	width: 960px;
	height: 320px;
	border: 0;
	margin: 0 auto;
	display: block;
}

#center {
	width: 960px;
	margin: 0 auto;
	padding: 40px 0;
}

#header {
	margin-bottom: 20px;
}

#footer {
	margin-top: 20px;
}


#sidebarleft {
	width: 220px;
	margin-right: 40px;
	min-height: 1px;
}

#sidebarright {
	width: 220px;
	margin-left: 40px;
	min-height: 1px;
}


#sidebarleft, #sidebarright, #content {
	float: left;
}

#common {
	background-color: #{{$config['palette.bright']}};
	border-top: 1px solid #{{$config['palette.medium']}}; 
}

#common div {
	width: 960px;
	margin: 0 auto;
	padding: 20px 0;
	text-align: center;
	color: #{{$config['palette.dark']}};
	text-transform: uppercase;
}

#common a {
	color: #666666;
	text-decoration: none;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#common a:hover {
	color: #000000;
}

#breadcrumbs {
	margin: 0 0 20px 0;
	color: #666666;
	font-size: 90%;
}

#breadcrumbs a {
	color: #{{$config['palette.dark']}};
	text-decoration: none;
	-webkit-transition: color 0.2s;
	transition: color 0.2s;
}

#breadcrumbs a:hover {
	color: #000000;
}