body {
	background-color: #{{$config['palette.common.background']}};
	margin: 0;
	padding: 0;
}

header {
	position: relative;
	overflow: hidden;
	padding: 0;
	background-color: #{{$config['palette.background']}};
}

header img, header video {
	width: 100%;
	display: block;
	border: 0;
	position: absolute;
	height: 100%;
}

header img.headersliderpri {
	z-index: 1;
	transition: none;
	-webkit-transition: none;
	opacity: 1;
}

header img.headerslidersec {
	z-index: 2;
	transition: none;
	-webkit-transition: none;
	opacity: 0;
}

header img.headerslidersecout {
	transition: opacity 0.5s;
	-webkit-transition: opacity 0.5s;
	opacity: 1;
}

#headercontainer {
	position: absolute;
}

#sqrheaderbottombox {
	position: absolute;
	z-index: 10;
	width: 100%;
	bottom: 0px;
	padding: 0;
	margin: 0;
	background: url(./../../styles/zagreb/img/?f=fadeup) left top repeat-x;
}

#sqrheadertopbox {
	position: absolute;
	z-index: 9;
	width: 100%;
	top: 0px;
	padding: 0;
	margin: 0;
	background: url(./../../styles/zagreb/img/?f=fadedown) left bottom repeat-x;
	height: 150px;
}

#sqrheaderbottombox>div {
	margin: 0 auto;
	max-width: 1100px;
	padding: 30px;
	box-sizing: border-box;
}

#sqrheaderbottombox>div:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

#headersliderbullets {
	float: left;
	margin-top: 30px;
}

#headersliderbullets a {
	width: 24px;
	height: 24px;
	background: url(./../../styles/zagreb/img/?f={{$config['options.navstyle']}}&ca={{$config['palette.overlay.bright']}}&cb={{$config['palette.overlay.dark']}}) no-repeat left top;
	float: left;
}

#headersliderbullets a.active {
	background-position: left bottom;
}


#sqrtobottom {
	height: 32px;
	width: 32px;
	background: url(./../../styles/zagreb/img/?f={{$config['options.downstyle']}}&ca={{$config['palette.overlay.bright']}}&cb={{$config['palette.overlay.dark']}}) right center no-repeat;
	cursor: pointer;
	display: block;
	float: right;
	margin-top: 30px;
}


#sqrheaderbottombox h1 {
	color: #{{$config['palette.overlay.bright']}};
	font-size: 64px;
	margin: 0 0 16px 0;
	padding: 0;
	box-sizing: border-box;
	text-shadow: 2px 2px 2px rgba({{$config['palette.overlay.dark']|ngrgb}},0.5);
	font-weight: 300;
}

#sqrheaderbottombox p {
	color: #{{$config['palette.overlay.bright']}};
	margin: 0 0 16px 0;
	padding: 0;
	box-sizing: border-box;
	text-shadow: 2px 2px 2px rgba({{$config['palette.overlay.dark']|ngrgb}},0.5);
	max-width: 800px;
}


@media screen and (max-width: 767px) {
	#sqrheaderbottombox h1 {
		font-size: 32px;
	}
}


#eyecatcherwait {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 48px;
    height: 48px;
    margin:-24px 0 0 -24px;
    z-index: 3;
    background: url(./../../styles/zagreb/img/?f={{$config['options.waitstyle']}}&ca={{$config['palette.overlay.bright']}}&cb={{$config['palette.overlay.dark']}}) no-repeat center center;
    opacity: 0;
}

@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

header.loading #eyecatcherwait {
    -webkit-animation:spin 1s linear infinite;
    -moz-animation:spin 1s linear infinite;
    animation:spin 1s linear infinite;
    display: block;
    opacity: 1;
	transition: opacity 1s;
	-webkit-transition: opacity 1s;    
}




#topcontainer {
	background-color: #{{$config['palette.background.header']}};
	padding-bottom: 0.1px;
	padding-top: 0.1px;
}

#maincontainer {
	background-color: #{{$config['palette.background']}};
	padding-bottom: 0.1px;
	padding-top: 0.1px;
}

#footercontainer {
	background-color: #{{$config['palette.background.footer']}};
	padding-bottom: 0.1px;
	padding-top: 0.1px;
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
	background: url(./../../styles/zagreb/img/?f={{$config['options.upstyle']}}&ca={{$config['palette.up']}}) 0 0 no-repeat;
	display: block;
}


@media screen and (min-width: 1024px) {
	.sqrallwaysboxed, 
	.sqrmobilefullwidth,
	.sqrdesktopboxed
	{
		box-sizing: border-box;
		padding-left: 30px;
		padding-right: 30px;
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
		padding-left: 30px;
		padding-right: 30px;
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
		padding-left: 30px !important;
		padding-right: 30px !important;
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
  margin: 0;
  padding: 30px 0 0 0;
}

.sqrcommonnav,
.sqrfootertext {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 30px 30px 30px;
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
	padding: 0 30px 5px 0;
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
  transition: background-color 1s;
  -webkit-transition: background-color 1s;
  box-sizing: border-box;
}

.sqrnav.sqrnavalt {
	background-color: #{{$config['palette.nav.dark']}};
}

.sqrnav a {
  display: block;
  margin: 0;
  padding: 12px 22px;
  color: #{{$config['palette.nav.bright']}};
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
    border-bottom: 1px solid rgba({{$config['palette.nav.bright']|ngrgb}}, 0.075);
  }
  .sqrnav a.sqrnavshow, .sqrnav a.sqrnavhide {
    background: url(./../../styles/zagreb/img/?f=menu&ca={{$config['palette.nav.bright']}}) right center no-repeat;
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
	
  .sqrnav {
    padding: 0 30px;
  }	
	
  .sqrnav>a {
    display: none;
  }
  .sqrnav>ul {
    box-sizing: border-box;
    display: block;
    max-width: 1040px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    width: 100%;
    border-bottom: 1px solid rgba({{$config['palette.nav.bright']|ngrgb}}, 0.5);
  }
  
    .sqrnav>ul {
    padding-top: 20px;
    transition: padding 0.2s;
  }
  .sqrnav.sqrscrolled>ul {
  	border-bottom: 0;
    padding-top: 0;
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
    padding: 12px 12px 12px 0;
  }
  
  
}