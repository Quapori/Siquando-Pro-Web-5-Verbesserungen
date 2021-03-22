html, body {
	background-color: #{{$config['palette.navback']}};
}

#logo a {
	display: block;
	margin: 0 auto;
}

#logo img {
	border: 0;
	display: block;
}


#navigation {
	text-align: center;
	margin: 0 0 20px 0;
}

#navigation ul {
	display: inline-block;
	list-style: none;
    margin: 0;
    padding: 0;
}

#navigation li {
	float: left;
    margin: 0 10px;
    display: block;
    border-bottom: 4px solid transparent;
    transition: border-bottom 0.2s;
	-webkit-transition: border-bottom 0.2s; 
}

#navigation li:hover, #navigation li.active {
	border-bottom: 4px solid #{{$config['palette.active']}};
}

#navigation a {
	text-decoration: none;
	color: #{{$config['palette.navtext']}};
	font-size: 14px;
	text-transform: uppercase;
    padding: 5px 0px;
    display: block;
}

#eyecatcher {
	height:360px;	
	overflow: hidden;
	position: relative;
}

#eyecatcher>img {
	position: absolute;
 }

.shadow {
	position: absolute;
	width: 100%;
	height: 24px;
	background: url(./../../styles/nashville/img/shadow.png) repeat-x left top;
}

#eyecatcher .caption {
	width: 960px;
	height: 360px;
	margin: 0 auto;
	position: relative;
}

#eyecatcher div h1 {
	position: absolute;
	width: 480px;
	bottom: 20px;
	left: 0px;
	text-shadow: 4px 4px 16px rgba(0,0,0,0.3);
}

#header {
	background-color: #{{$config['palette.header']}};
}

#header>div {
	width: 960px;
	margin: 0 auto;
	padding: 40px 0;
	position: relative;
}

#main {
	background-color: #{{$config['palette.main']}};
}

#main>div {
	width: 960px;
	margin: 0 auto;
	padding: 40px 0;
	position: relative;
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
	background-color: #{{$config['palette.footer']}};
}

#footer>div {
	width: 960px;
	margin: 0 auto;
	padding: 40px 0;
}

@-webkit-keyframes bounce {
	0%, 40%, 60%, 80%, 100% {-webkit-transform: translateY(0);}
	45%, 65%, 85% {-webkit-transform: translateY(7px);}
}
@keyframes bounce {
	0%, 40%, 60%, 80%, 100% {transform: translateY(0);}
	45%, 65%, 85% {transform: translateY(7px);}
}


.ngrolldown {
	width: 28px;
	height: 28px;
	position: absolute;
	right: 0;
	bottom: 20px;
	display: block;
	background: url(./../../styles/nashville/img/down.png) no-repeat center top;
	cursor: pointer;
	-webkit-animation: bounce 3s;
	animation: bounce 3s; 
}