body, html {
	background-color: #{{$config['palette.background']}};
}

#eyecatcher {
	position: relative;
	overflow: hidden;
	background-color: #{{$config['palette.navback']}};
}

#eyecatcher img {
	display: block;
	position: absolute;
	opacity: 0;
	border: 0;
	transition: opacity 1s;
	-webkit-transition: opacity 1s;
}

#eyecatcher h1 {
	display: block;
	margin: 0;
	padding: 0;
	position: absolute;
	width: 480px;
	left: 50px;
	top: 50px;
	opacity: 0;
	transform:translateX(-50px);
	-ms-transform:translateX(-50px);
	-webkit-transform:translateX(-50px);
	transition:transform 1s, -ms-transform 1s, opacity 1s;
	-webkit-transition: -webkit-transform 1s, opacity 1s;
	text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

#eyecatcher h1.loaded {
	opacity: 1;
	transform:translateX(0);
	-ms-transform:translateX(0);
	-webkit-transform:translateX(0);
}

#eyecatcher>div {
	width: 70px;
	height: 70px;
	position: absolute;
	bottom: 50px;
	right: 50px;
	background: url(./../../styles/orlando/img/down.png) no-repeat top left;
	cursor: pointer;
	opacity: 0;
	transition: opacity 1s;
	-webkit-transition: opacity 1s;
}

#eyecatcher>div:hover {
	background-position: bottom left;
}

#eyecatcher>div.loaded {
	opacity: 1;
	-webkit-animation: bounce 3s;
	animation: bounce 3s; 
}

@-webkit-keyframes bounce {
	0%, 40%, 60%, 80%, 100% {-webkit-transform: translateY(0);}
	45%, 65%, 85% {-webkit-transform: translateY(7px);}
}
@keyframes bounce {
	0%, 40%, 60%, 80%, 100% {transform: translateY(0);}
	45%, 65%, 85% {transform: translateY(7px);}
}

#nav, #navfixed {
	background-color: #{{$config['palette.navback']}};
	width:100%;
	z-index: 1000;
}

#nav>div, #navfixed>div {
	width: 960px;
	margin: 0 auto;
	position: relative;
}

.logo {
	position: absolute;
	right: 0;
	top: 0px;
}

.logo img {
	border: 0;
}

#nav ul, #navfixed ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

#nav li, #navfixed li {
	list-style: none;
	margin: 0;
	padding: 46px 50px 44px 0;
	display: block;
	float: left;
}

#nav ul a, #navfixed ul a {
	display: block;
	padding: 4px 0 4px 0;
	color: #ffffff;
	text-transform: uppercase;
	text-decoration: none;
	font-size: 15px;
	border-bottom: 2px solid transparent;
	transition: border-color 0.3s;
}

#nav ul li:hover a,
#nav ul li.active a,
#navfixed ul li:hover a,
#navfixed ul li.active a
{
	border-bottom: 2px solid #ffffff;
}

#navfixed {
	display: none;
	position: fixed;
	top: 0;
}

#center {
	width: 960px;
	margin: 40px auto;
}

#header {
	width: 960px;
	margin-bottom: 50px;
}

#sidebarleft {
	float: left;
	margin-right: 50px;
	min-height: 1px;
}

#content {
	float: left;
}

#sidebarright {
	float: left;
	margin-left: 50px;
	min-height: 1px;
}

#footer {
	width: 960px;
	margin-top: 50px;
}
