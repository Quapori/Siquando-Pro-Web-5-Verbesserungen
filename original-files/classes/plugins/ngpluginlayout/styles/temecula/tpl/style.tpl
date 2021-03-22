html {
	background-color: #{{$config['palette.background']}};
	background-image: -moz-radial-gradient(center, circle farthest-corner, #{{$config['palette.alt']}} 0%, #{{$config['palette.background']}} 100%);
	background-image: -webkit-radial-gradient(center, circle farthest-corner, #{{$config['palette.alt']}} 0%, #{{$config['palette.background']}} 100%);
	background-image: radial-gradient(circle farthest-corner at center, #{{$config['palette.alt']}} 0%, #{{$config['palette.background']}} 100%);
}

.center {
	width: 960px;
	margin: 0 auto;
	padding: 20px 0;
	
}

#nav {
	width: 960px;
	height: 60px;
	position: relative;
	background: url(./../../styles/temecula/img/bottom.png) no-repeat;
}

#nav ul {
	margin: 0 0 0 10px;
	padding: 0;
	list-style: none;
	position: absolute;
	overflow: hidden;
	width: 950px;
	height: 60px;
}

#nav li {
	display: block;
	float: left;
	margin-left: 4px;
	margin-top: 10px;
	-webkit-transition: all 0.2s;
	transition: all 0.2s;
}

#nav li:hover, #nav li.active {
	margin-top: 0;
}

#nav li a {
	padding: 10px 20px 100px 20px;
	background-color: #ffffff;
	display: block;
	border-radius: 6px;
	text-decoration: none;
	-webkit-transition: all 0.2s;
	transition: all 0.2s;
	color: #{{$config['palette.background']}};
}

#nav li a:hover {
	color: #{{$config['palette.alt']}};
}

#nav form {
	width: 200px;
	height: 24px;
	background-color: #{{$config['palette.alt']}};
	border-radius: 6px;
	position: absolute;
	bottom: 10px;
	right: 20px;
}

#nav form input {
	border: 0;
	width: 170px;
	position: absolute;
	left: 6px;
	top: 3px;
	padding: 0;
	margin: 0;
	background-color: transparent;
	font: 15px "Calibri", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
	color: #ffffff;
}

#nav button {
	background: url(./../../styles/temecula/img/searchbutton.png) no-repeat top left;
	display: block;
	width: 20px;
	height: 20px;
	border: none;
	position: absolute;
	top: 2px;
	right: 2px;
	cursor: pointer;
}

#nav input:focus{
    outline: 0;
}

#nav input::-webkit-input-placeholder 
{
	color:#ffffff;
}

#nav input:-moz-placeholder {
    color:#ffffff;
}

#nav input:-ms-input-placeholder {
    color:#ffffff;
}

#home {
	background: url(./../../styles/temecula/img/home.png) no-repeat top left;
	background-color: #{{$config['palette.alt']}};
	width: 16px;
	height: 16px;
	display: block;
	font-size: 1px;
	position: absolute;
	left: 20px;
	top: 16px;
	-webkit-transition: all 0.4s;
	transition: all 0.4s;
}

#home:hover {
	background-color: #{{$config['palette.background']}};
}

#eyecatcher {
	position: relative;
	background-color: #ffffff;
}

#eyecatcher .mask {
	width: 960px;
	height: 320px;
	background: url(./../../styles/temecula/img/mask.png) no-repeat;
	position: absolute;
	top: 0;
	left: 0;
}

#eyecatcher ul {
	display: block;
	list-style: none;
	text-align: right;
	position: absolute;
	width: 960px;
	margin: 0;
	padding: 0;
	right: 20px;
	bottom: 0;
	height: 26px;
	
}

#eyecatcher li {
	display: block;
	float: right;
	border-right: 1px solid #ffffff;
	background-color: #{{$config['palette.alt']}};
	-webkit-transition: all 0.4s;
	transition: all 0.4s;
	font-size: 12px;
	
}

#eyecatcher li:last-child {
	border-radius: 6px 0 0 6px;
}

#eyecatcher li:first-child {
	border-radius: 0 6px 6px 0;
}

#eyecatcher ul a {
	display: block;
	color: #ffffff;
	text-decoration: none;
	padding: 4px 10px;
	text-transform: uppercase;
}

#eyecatcher li:hover {
	background-color: #{{$config['palette.background']}};
}


#caption {
	padding: 0 40px 0 40px;
	background-color: #ffffff;
}

#header {
	padding: 1px 40px 20px 40px;
	background-color: #ffffff;
}

#main {
	padding: 1px 40px;
	background-color: #ffffff;
}

#sidebarleft {
	float: left;
	width: 220px;
	margin-right: 40px;
	min-height: 1px;
}

#content {
	float: left;
}

#sidebarright {
	float: left;
	width: 220px;
	margin-left: 40px;
	min-height: 1px;
}

#footer {
	padding: 20px 40px 0 40px;
	background-color: #ffffff;
}

#bottom {
	width: 940px;
	height: 20px;
	background: url(./../../styles/temecula/img/top.png) no-repeat;
	text-align: right;
	padding: 40px 20px 0 0;
	text-transform: uppercase;
}

#bottom a {
	color: #ffffff;
	text-decoration: none;
	-webkit-transition: all 0.4s;
	transition: all 0.4s;
}

#bottom a:hover {
	color: #{{$config['palette.alt']}};
}
