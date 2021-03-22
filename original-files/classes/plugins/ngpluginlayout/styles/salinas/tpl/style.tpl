body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

#center {
	background-color: #ffffff;
	width: 960px;
	margin: 0 auto;
}

#top {
	background-color: #{{$config['palette.top']}};
	position: fixed;
	width: 960px;
	z-index: 1000;
}

#top img {
	display: block;
	border: 0;
}

#top form {
	width: 260px;
	height: 32px;
	background-color: #{{$config['palette.search']}};
	display: block;
	position: absolute;
	top: 0;
	right: 0;
}

#top form input {
	width: 220px;
	display: block;
	position: absolute;
	top: 5px;
	left: 8px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #ffffff;
	font: 16px "Calibri", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#top button {
	background: url(./../../styles/salinas/img/searchbutton.png) no-repeat;
	display: block;
	width: 32px;
	height: 32px;
	border: none;
	position: absolute;
	top: 0px;
	right: 0px;
	cursor: pointer;
}

#top input:focus{
    outline: 0;
}

#top input::-webkit-input-placeholder 
{
	color:#ffffff;
}
#top input:-moz-placeholder {
    color:#ffffff;
}

#top input:-ms-placeholder {
    color:#ffffff;
}

#nav {
	padding-top: 32px;
}

#nav ul {
	display: block;
	margin: 0;
	padding: 0 0 0 10px;
	list-style: none;
}

#nav li {
	display: block;
	float: left;
	padding: 20px 0px 10px 0;
}

#nav li a {
	color: #666666;
	background-color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	padding: 4px 10px;
	-webkit-transition: all 0.2s;
	transition: all 0.2s;
}

#nav li a:hover {
	color: #ffffff;
	background-color: #{{$config['palette.search']}};
}


#breadcrumbs {
	color: #666666;
	padding: 10px 10px 10px 10px;
}

#breadcrumbs a {
	text-decoration: none;
	color: #{{$config['palette.top']}};
	text-transform: uppercase;
	padding: 4px 10px;
	-webkit-transition: all 0.2s;
	transition: all 0.2s;
}

#breadcrumbs a:hover {
	color: #ffffff;
	background-color: #{{$config['palette.search']}};
}

#eyecatcher {
	border-bottom: 1px solid #e0e0e0;
	border-top: 1px solid #e0e0e0;
	margin: 10px 0 0 0;
}

#eyecatcher img {
	display: block;
	border: 0;
}

#caption {
	padding: 0 20px;
}

#header {
	padding: 10px 20px;
	border-bottom: 1px solid #e0e0e0;
}

#main {
	margin: 10px 20px;
}

#sidebarleft {
	float: left;
	width: 220px;
	margin-right: 40px;
	min-height: 1px;
}

#sidebarright {
	float: left;
	width: 220px;
	margin-left: 40px;
	min-height: 1px;
}

#content {
	float: left;
}


#footer {
	padding: 10px 20px;
	border-top: 1px solid #e0e0e0;
}

#common {
	padding: 20px 20px 60px 20px;
	background-color: #{{$config['palette.background']}};
	text-align:center;
}

#common a {
	color: #666666;
	text-decoration: none;
}

#common a:hover {
	color: #000000;
}