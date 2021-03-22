body {
	background-color: #{{$config['palette.background']}};
	margin: 0;
	padding: 0;
}

nav.sqrnav {
	box-sizing: border-box;
	max-width: {{$config['options.width']}}px;
	margin: 0 auto;
	padding: 30px 20px 10px 20px;	
}

nav.sqrnav>ul {
	list-style: none;
	margin: 0;
	padding: 0;
	display: block;
}

nav.sqrnav>ul:after {
   	visibility: hidden;
   	display: block;
   	font-size: 0;
   	content: " ";
   	clear: both;
   	height: 0;
}


nav.sqrnav>ul>li {
	display: block;
	float: left;
	margin: 0;
	padding: 0;
}

nav.sqrnav>ul>li>a {
	float: left;
	padding: 8px 10px 8px 0;
	text-transform: uppercase;
	text-decoration: none;
	font-weight: bold;
	letter-spacing: -1px;
	line-height: 20px;
	color: #{{$config['palette.nav']}};
	transition: color 0.2s;	
}

nav.sqrnav>ul li em.ngshopcartindicator {
	display: none;
	background-color: #{{$config['palette.nav.active']}};
	color: #ffffff;
	font-style: normal;
	padding-right: 8px;
	padding-left: 8px;
	border-radius: 3px;
	margin-left: 8px;
	font-weight: normal;
}

nav.sqrnav>ul li em.ngshopcartindicatoractive {
	display: inline-block;
}

nav.sqrnav>ul>li.sqrnavlogo>a {
	padding: 0 10px 0 0;
}

nav.sqrnav>ul>li.sqrnavlogo>a>img {
	display: block;
	border: none;
}

nav.sqrnav>ul>li>a:hover {
	color: #{{$config['palette.nav.hover']}};	
}


nav.sqrnav>ul>li.active>a {
	color: #{{$config['palette.nav.active']}};
}


header.sqrheader {
	box-sizing: border-box;
	max-width: {{$config['options.width']}}px;
	margin: 0 auto;
	padding: 0 20px;
}

header.sqrheader>h1 {
	letter-spacing: -1px;
}

header.sqrheader>h1>span {
	font-weight: normal;
	color: #{{$config['palette.title']}};
}


#maincontainer {
	padding: 1px 0;
}

#sidebarleft,
#content,
#sidebarright {
	min-height: 1px;
}


#header {
	padding: 20px 0 0 0;
}

#footer {
	padding: 0 0 20px 0;
}

#main {
	padding: 20px 0;
}


@media screen and (min-width: 1024px) {
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 20px;
		padding-right: 20px;
		max-width: {{$config['options.width']}}px;
		margin-left: auto;
		margin-right: auto;
	}
	
	.sqrallwaysboxed .sqrallwaysboxed,
	.sqrdesktopboxed .sqrdesktopboxed,
	.sqrmobilefullwidth .sqrallwaysboxed,
	.sqrdesktopboxed .sqrallwaysboxed,
	.sqrdesktopboxed .sqrmobilefullwidth,
	.sqrdesktopremovebox .sqrallwaysboxed,
	.sqrdesktopremovebox .sqrmobilefullwidth
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 		
	.sqrmain2col>div {
    	box-sizing: border-box;
    	width: 48%;
    	float: left;
    	margin-right: 4%;
  	}
  	.sqrmain2col>div:last-child {
    	margin-right: 0;
  	}
  	.sqrmain3col>div {
    	box-sizing: border-box;
    	width: 30.6666666666%;
    	float: left;
    	margin-right: 4%;
  	}
  	.sqrmain3col>div:last-child {
    	margin-right: 0;
  	}
  	.sqrmain3collr>div {
    	box-sizing: border-box;
    	width: 50%;
    	float: left;
  	}
  	.sqrmain3collr>div:first-child {
    	width: 21%;
    	margin-right: 4%;
  	}
  	.sqrmain3collr>div:last-child {
    	width: 21%;
    	margin-left: 4%;
  	}
  	.sqrmain2coll>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2coll>div:first-child {
    	width: 21%;
    	margin-right: 4%;
  	}
  	.sqrmain2colr>div {
    	box-sizing: border-box;
    	width: 75%;
    	float: left;
  	}
  	.sqrmain2colr>div:last-child {
    	width: 21%;
    	margin-left: 4%;
  	}
  	
  	
	.sqrmain3col:after, 
	.sqrmain2col:after,
	.sqrmain3collr:after,
	.sqrmain2coll:after,
	.sqrmain2colr:after
	 {
    	visibility: hidden;
    	display: block;
    	font-size: 0;
    	content: " ";
    	clear: both;
    	height: 0;
  	}
  	
  	.sqrallwaysfullwidth .sqrsuppressborders {
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
  	
}

@media screen and (max-width: 1023px) {
	.sqrallwaysboxed,
	.sqrmobileboxed 
	{
		box-sizing: border-box;
		padding-left: 20px;
		padding-right: 20px;
	}
	.sqrallwaysboxed>.sqrallwaysboxed,
	.sqrallwaysboxed>.nguiparagraphcontainer>.sqrallwaysboxed
	 {
		padding-left: 0;
		padding-right: 0;
		margin-left: 0;
		margin-right: 0;
	 }
	 .sqrmobileboxedimportant {
		padding-left: 20px !important;
		padding-right: 20px !important;
	 }	
	 .sqrmobilehidden {
	 	display: none;
	 }
	 
	 .sqrallwaysfullwidth .sqrsuppressborders,
	 .sqrmobilefullwidth .sqrsuppressborders
  	{
  		border-left: 0 !important;
  		border-right: 0 !important;
  	}
}

footer.sqrcommon {
	max-width: {{$config['options.width']}}px;
	margin: 0 auto;
	padding: 20px 20px 0 20px;
	box-sizing: border-box;
}

footer.sqrcommon>ul {
	list-style: none;
	margin: 0;
	padding: 0 0 20px 0;
	display: block;
}

footer.sqrcommon>ul:after {
   	visibility: hidden;
   	display: block;
   	font-size: 0;
   	content: " ";
   	clear: both;
   	height: 0;
}


footer.sqrcommon>ul>li {
	display: block;
	float: left;
	margin: 0;
	padding: 0;
}

footer.sqrcommon>ul>li>a {
	float: left;
	padding: 0 10px 0 0;
	text-transform: uppercase;
	text-decoration: none;
	letter-spacing: -1px;
	color: #{{$config['palette.nav']}};	
}

footer.sqrcommon>ul>li>a:hover {
	color: #{{$config['palette.nav.hover']}};	
}

footer.sqrcommon>div {
	padding: 0 0 20px 0;
}