body {
	background: #{{$config['palette.background']}} url(./../../styles/poughkeepsie/img/back.png);
	margin: 0;
	padding: 0;
}

h1 {
	text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
}

h2 {
	text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}

#navfader {
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	background-color: #{{$config['palette.dark']}};
	opacity: 0;
	-webkit-transition: all 0.6s;
	transition: all 0.6s;
	visibility: hidden;
	z-index: 1000;
}

#navfader.on {
	opacity: 0.5;
	visibility: visible;
}

#navigation {
{{if $config['options.animate']==='true'}}
	-webkit-transition: all 0.4s;
 	-webkit-transition-timing-function: cubic-bezier(0.6, 0, 0.4, 1);
	transition: all 0.4s;
 	transition-timing-function: cubic-bezier(0.6, 0, 0.4, 1);
	-webkit-perspective: 600px;
	perspective: 600px;
	-webkit-transform: translateY(-481px);
	transform: translateY(-481px);
	top:0;
{{else}}
	top:-481px;
{{/if}}
	display: block;
	position: fixed;
	width: 100%;
	height: 538px;
	z-index: 1001;
}

#nava {
	position: absolute;
	width: 50%;
	background-color: #{{$config['palette.dark']}};
	top: 0;
	left: 0;
	height: 480px;
}

#navb {
	position: absolute;
	width: 50%;
	right: 0;
	top: 0;
	background-color: #{{$config['palette.medium']}};
	height: 480px;
}

#navigation ul {
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
	height: 480px;
}

#nava ul {
	border-right: 1px solid #{{$config['palette.bright']}};
}

#navtoggle {
	height: 36px;
	width: 100%;
	border-top: 1px solid #{{$config['palette.bright']}};
	border-bottom: 1px solid #{{$config['palette.bright']}};
	background-color: #{{$config['palette.dark']}};
	z-index: 1003;
	position: relative;
}

#navbutton {
	width: 114px;
	height: 57px;
	cursor: pointer;
	background: url(./../../styles/poughkeepsie/img/menu.png) no-repeat left top;
	position: absolute;
	bottom: 0;
    left:0;
    right:0;
    margin-left:auto;
    margin-right:auto;
	z-index: 1004;
}

.open #navbutton {
	background-position: left bottom;
}

#navshadow {
	height: 20px;
	background: url(./../../styles/poughkeepsie/img/shadow.png) repeat-x;
	width: 100%;
}

#navtoggle img 
{
	display: block;
	position: absolute;
	left: 8px;
	top: 0;
	border: 0;
}

#nava {
	text-align: right;
}

#nava a {
	display: block;
	padding: 14px 20px 14px 20px;
}

#navb a {
	display: block;
	padding: 14px 20px 14px 20px;
}

{{if $config['options.animate']==='true'}}
#navigation li {
	transition: background-color 0.2s;
	-webkit-transition: background-color 0.2s;
}
{{/if}}

#navigation ul li a {
	text-decoration: none;
	text-transform: uppercase;
	color: #ffffff;
{{if $config['options.animate']==='true'}}	
	transition: all 0.2s;
	-webkit-transition: all 0.2s;
{{/if}}
}

#nava ul li:hover, #nava ul li.active {
	background-color: #{{$config['palette.medium']}};
}

#nava ul li:hover a {
	padding-right: 30px;
}

#navb ul li:hover {
	background-color: #{{$config['palette.dark']}};
}

#nava ul li.active, #navb ul li.active {
	font-weight: bold;
}

#navb ul li:hover a {
	padding-left: 30px;
}

{{if $config['options.animate']==='true'}}
#navigation.open #navtop 
{
 	-webkit-transform: rotateX(0) ;
 	transform: rotateX(0) ;
}

{{/if}}

#navigation.open {
{{if $config['options.animate']==='true'}}
	-webkit-transform: translateY(0);
	transform: translateY(0);
{{else}}
	top: 0;
{{/if}}
}


#navigation #navtop {
{{if $config['options.animate']==='true'}} 	-webkit-transform: rotateX(65deg);
 	-webkit-transition-timing-function: cubic-bezier(0.6, 0, 0.4, 1);
	-webkit-transition: all 0.6s;
 	transform: rotateX(65deg);
 	transition-timing-function: cubic-bezier(0.6, 0, 0.4, 1);
	transition: all 0.6s;
{{/if}}
 	z-index: 1002; 
 	height: 480px;
}


#navtoggle form {
	width: 210px;
	height: 24px;
	display: block;
	position: absolute;
	top: 6px;
	right: 6px;
	background-color: #ffffff;
	border-radius: 2px;
}

#navtoggle form input {
	width: 180px;
	display: block;
	position: absolute;
	top: 4px;
	left: 26px;
	background-color: transparent;
	border: 0;
	padding: 0;
	margin: 0;
	color: #444444;
	font: 14px "Corbel", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
}

#navtoggle button {
	background: url(./../../styles/poughkeepsie/img/searchbutton.png) no-repeat;
	display: block;
	width: 20px;
	height: 20px;
	border: none;
	position: absolute;
	top: 2px;
	left: 2px;
}

input:focus{
    outline: 0;
}

#center {
	width: 960px;
	margin: 100px auto 40px auto;
}

#eyecatcher {
	background: url(./../../styles/poughkeepsie/img/frame.png);
	margin: -20px;
	padding: 30px;
}

#eyecatcher img {
	display: block;
	border: 0;
}

#header {
	width: 960px;
	margin-bottom: 50px;
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
	width: 960px;
	margin-top: 40px;
}

#common {
	border-top: 1px solid #{{$config['palette.bright']}};
	padding: 6px;
	color: #{{$config['palette.bright']}};
	text-align:center;
	margin-top: 20px;
}

#common a {
	font-size: 90%;
	color: #888888;
	text-decoration: none;
	-webkit-transition: all 0.2s;
	transition: all 0.2s;
}

#common a:hover {
	color: #000000;
}