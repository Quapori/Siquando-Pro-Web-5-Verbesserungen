body {
	margin: 0;
	padding: 0;
}

#captioncontainer {
	padding-bottom: 2px;
	padding-top: 2px;
}

#headercontainer {
	background-color: #{{$config['palette.background.header']}};
	padding-bottom: 1px;
	padding-top: 1px;
}

#maincontainer {
	background-color: #{{$config['palette.background']}};
	padding-bottom: 1px;
	padding-top: 1px;
}

#footercontainer {
	background-color: #{{$config['palette.background.footer']}};
	padding-bottom: 1px;
	padding-top: 1px;
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

.sqrtotop {
	margin: 6px 0;	
}

.sqrtotop:after {
   	visibility: hidden;
   	display: block;
   	font-size: 0;
   	content: " ";
   	clear: both;
   	height: 0;
}

.sqrtotop>a {
	height: 24px;
	width: 24px;
	float: right;
	background: url(./../../styles/sarajevo/img/?f={{$config['options.upstyle']}}&c={{$config['palette.up']}}) 0 0 no-repeat;
	display: block;
}


@media screen and (min-width: 1024px) {
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 20px;
		padding-right: 20px;
		max-width: 1100px;
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

.sqrcommon {
	background-color: #{{$config['palette.common.background']}};
	margin: 0;
  	padding: 20px 0 0 0;
}

.sqrcommonnav,
.sqrfootertext {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px 20px 20px;
  box-sizing: border-box;
}
.sqrfootertext {
  color: #{{$config['palette.common.font']}};
}


.sqrcommonnav a,
.sqrfootertext a
 {
  text-decoration: none;
  color: #{{$config['palette.common.link']}};
  transition: color 0.3s;
  text-decoration: none;
  font-weight: normal;
}

.sqrcommonnav a:hover,
.sqrfootertext a:hover
 {
  color: #{{$config['palette.common.hover']}};
  text-decoration: none;
  font-weight: normal;
}

.sqrcommonnav
{
	display: block;
	list-style: none;
}

.sqrcommonnav>li
 {
	display: block;
	box-sizing: border-box;
	list-style: none;
	padding: 0 20px 5px 0;
	float: left;
}

.sqrcommonnav:after {
   	visibility: hidden;
   	display: block;
   	font-size: 0;
   	content: " ";
   	clear: both;
   	height: 0;
}


@media screen and (min-width: 1024px) {	
	 .sqrdesktophidden {
	 	display: none;
	 }
}

.sqrnav {
  display: block;
  margin: 0;
  padding: 0;
  z-index: 1000;
  -webkit-user-select: none;
  user-select: none;
  line-height: 21px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: rgba({{$config['palette.nav.dark']|ngrgb}},0.5);
  transition: background-color 1s;
  -webkit-transition: background-color 1s;
}

.sqrnav.sqrnavalt {
	background-color: #{{$config['palette.nav.dark']}};
}

.sqrnav a {
  display: block;
  margin: 0;
  padding: 14px 22px;
  color: #ffffff;
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
  line-height: 22px;
  text-transform: uppercase;
}
.sqrnav>ul li {
  display: block;
  margin: 0;
  padding: 0;
  position: relative;
}

.sqrnav a.sqrnavactive {
  background-color: #{{$config['palette.nav.active']}};
  transition: background-color 300ms;
}

@media screen and (max-width: 1023px) {
  .sqrnav a {
    border-bottom: 1px solid rgba(255, 255, 255, 0.075);
  }
  .sqrnav a.sqrnavshow, .sqrnav a.sqrnavhide {
    background: url(./../../styles/sarajevo/img/?f=menu&c={{$config['palette.nav.bright']}}) right center no-repeat;
  }
  .sqrnav .sqrnavshow {
    display: block;
  }
  .sqrnav .sqrnavhide {
    display: none;
  }
  .sqrnavopen>a.sqrnavshow {
    display: none;
  }
  .sqrnavopen>a.sqrnavhide {
    display: block;
  }
  .sqrnav li.sqrnavopen>ul {
    display: block;
  }
  .sqrnav ul {
    display: none;
    margin: 0 auto;
    padding: 0;
    list-style: none;
  }
  .sqrnavopen>ul {
    display: block;
  }
  .sqrnav {
    background-color: #{{$config['palette.nav.dark']}};
  }
  .sqreyecatcher {
  	margin-top: 51px;
  }
  .sqrnav>ul li.sqrnavlogo {
  	display: none;
  }
  
  .sqrnav img {
  	display: block;
  }
  
  .sqrnoeyecatcher {
  	height: 51px;
	background-color: #{{$config['palette.background']}};
  }
  
}
@media screen and (min-width: 1024px) {
  .sqrnav>a {
    display: none;
  }
  .sqrnav>ul {
    box-sizing: border-box;
    display: block;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    width: 100%;
  }
  .sqrnav>ul:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
  }
  .sqrnav>ul>li {
    float: left;
  }
  .sqrnav a {
  	transition: background-color 0.2s;
  }
  
  .sqrnoeyecatcher {
  	height: 64px;
	background-color: #{{$config['palette.background']}};
  }
  
  .sqrnav img {
	display: block;
    padding: 20px;
  }
  
  
  .sqrnav a {
    padding: 20px;
  }
}

.sqreyecatcher {
	background-color: #{{$config['palette.background']}};
}

.sqreyecatcher img, .sqreyecatcher video {
	display: block;
	width: 100%;
	height: auto;
}

.sqreyecatcherstage img {
	position: absolute;
}

.sqreyecatcherstage {
	position: relative;
	background-color: #{{$config['palette.nav.dark']}};
	height: 0;
	padding-bottom: 33.3333333%;
}

.sqreyecatchercontainer {
	overflow: hidden;
}

.sqreyecatchernav a {
	width: 24px;
	height: 24px;
	display: block;
	float: left;
	background: url(./../../styles/sarajevo/img/?f={{$config['options.navstyle']}}&c={{$config['palette.bullets']}}) 0 0 no-repeat;	
}

.sqreyecatchernav a.sqreyecatchernavselected {
	background-position: 0 -24px;	
}

.sqreyecatchernav {
	height: 24px;
	margin: 0 auto;
	padding: 6px 0;
}